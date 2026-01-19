<?php

namespace App\Lib\BoxOperator;

use App\BoxEvent;
use App\CharityBox;
use App\Collector;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class BoxOperator
{
    private int $operatingUserId;

    public function __construct(int $operatingUserId)
    {
        $this->operatingUserId = $operatingUserId;
    }

    public function giveByCollectorIdentifier(string $identifier): CharityBox
    {
        $collector = Collector::where('identifier', '=', $identifier)->first();

        $box = new CharityBox;
        $box->collectorIdentifier = $collector->identifier;
        $box->collector_id = $collector->id;
        $box->is_given_to_collector = true;
        $box->given_to_collector_user_id = $this->operatingUserId;
        $box->time_given = Carbon::now();
        $box->save();

        $box = $box->fresh()->load('collector');

        $event = new BoxEvent;
        $event->type = 'give';
        $event->box_id = $box->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = 'Collector: ' . $collector->display;
        $event->save();

        return $box;
    }

    /**
     * @throws ValidationException
     */
    public function findLatestUncountedByCollectorIdentifier(string $identifier): CharityBox
    {
        Validator::make(['identifier' => $identifier], [
            'identifier' => 'required|exists:collectors,identifier|alpha_num|between:1,255',
        ],
            [
                'identifier.exists' => 'Wolontariusz o takim ID nie istnieje.',
            ])->validate();

        $collector = Collector::where('identifier', '=', $identifier)->first();

        $boxes = $collector->boxes()->orderBy('id', 'desc')->with('collector')->notCounted()->get();

        if (count($boxes) == 0) {
            throw new Exception('Wszystkie puszki wolontariusza ' . $collector->display . ' są rozliczone.');
        }

        $event = new BoxEvent;
        $event->type = 'found';
        $event->box_id = $boxes[0]->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = 'Collector: ' . $collector->display;
        $event->save();

        return $boxes[0]->load('collector');
    }

    public function startCountByBoxID(Request $request, int $boxID): CharityBox
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        if ($box->is_counted) {
            throw new Exception('Puszka została już rozliczona, numer puszki: ' . $box->id . 'Wolontariusz: ' .
                $box->collectorIdentifier);
        }

        if ($request->user()->hasRole('volounteer') && $box->counting_user_id != null && $box->counting_user_id != $this->operatingUserId) {
            throw new Exception('Puszka jest już w trakcie liczenia. Proszę zgłosić to do koordynatora rozliczenia.');
        }

        $event = new BoxEvent;
        $event->type = 'startedCounting';
        $event->box_id = $box->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = 'Collector: ' . $box->collector->display;
        $event->save();

        $box->counting_user_id = $this->operatingUserId;
        $box->save();

        return $box;
    }

    public function updateBoxByBoxID(Request $request, int $boxID): CharityBox
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        if ($box->is_confirmed) {
            throw new Exception('Nie można modyfikować zatwierdzonej puszki.');
        }

        $box->is_counted = true;

        // If this is the first time the box is being counted, set the counting user.
        if ($box->counting_user_id === null) {
            $box->counting_user_id = $this->operatingUserId;
        }

        $data = $this->getBoxDataFromRequest($request);

        // Add money
        $box->count_1gr = $data['count_1gr'];
        $box->count_2gr = $data['count_2gr'];
        $box->count_5gr = $data['count_5gr'];
        $box->count_10gr = $data['count_10gr'];
        $box->count_20gr = $data['count_20gr'];
        $box->count_50gr = $data['count_50gr'];
        $box->count_1zl = $data['count_1zl'];
        $box->count_2zl = $data['count_2zl'];
        $box->count_5zl = $data['count_5zl'];
        $box->count_10zl = $data['count_10zl'];
        $box->count_20zl = $data['count_20zl'];
        $box->count_50zl = $data['count_50zl'];
        $box->count_100zl = $data['count_100zl'];
        $box->count_200zl = $data['count_200zl'];
        $box->count_500zl = $data['count_500zl'];
        $box->amount_PLN = $data['amount_PLN'];
        $box->amount_EUR = $data['amount_EUR'];
        $box->amount_USD = $data['amount_USD'];
        $box->amount_GBP = $data['amount_GBP'];
        $box->comment = $data['comment'];
        if (isset($data['additional_comment'])) {
            $box->additional_comment = $data['additional_comment'];
        }

        // Add counted by data
        if (isset($data['first_counted_by_name'], $data['first_counted_by_phone'], $data['second_counted_by_name'], $data['second_counted_by_phone'])) {
            $box->first_counted_by_name = $data['first_counted_by_name'];
            $box->first_counted_by_phone = $data['first_counted_by_phone'];
            $box->second_counted_by_name = $data['second_counted_by_name'];
            $box->second_counted_by_phone = $data['second_counted_by_phone'];
        }

        $box->time_counted = Carbon::now();

        $box->save();

        $box = $box->fresh()->load('collector');

        $event = new BoxEvent;
        $event->type = 'updated';
        $event->box_id = $box->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = '';
        $event->save();

        return $box;
    }

    /**
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    private function getBoxDataFromRequest(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            // PLN
            'count_1gr' => 'required|integer|between:0,15000',
            'count_2gr' => 'required|integer|between:0,15000',
            'count_5gr' => 'required|integer|between:0,10000',
            'count_10gr' => 'required|integer|between:0,10000',
            'count_20gr' => 'required|integer|between:0,10000',
            'count_50gr' => 'required|integer|between:0,10000',
            'count_1zl' => 'required|integer|between:0,10000',
            'count_2zl' => 'required|integer|between:0,10000',
            'count_5zl' => 'required|integer|between:0,10000',
            'count_10zl' => 'required|integer|between:0,10000',
            'count_20zl' => 'required|integer|between:0,10000',
            'count_50zl' => 'required|integer|between:0,10000',
            'count_100zl' => 'required|integer|between:0,10000',
            'count_200zl' => 'required|integer|between:0,10000',
            'count_500zl' => 'required|integer|between:0,10000',

            // Waluty obce
            'amount_EUR' => 'required|numeric|between:0,10000',
            'amount_USD' => 'required|numeric|between:0,10000',
            'amount_GBP' => 'required|numeric|between:0,10000',
            'comment' => '',
            'additional_comment' => '',

            // Counted by data
            'first_counted_by_name' => 'string|nullable|max:255',
            'first_counted_by_phone' => 'string|nullable|max:12',
            'second_counted_by_name' => 'string|nullable|max:255',
            'second_counted_by_phone' => 'string|nullable|max:12',
        ]);

        if ($validator->fails()) {
            throw new Exception('Błąd walidacji puszki ' . $validator->errors()->first());
        }

        return array_merge(
            $validator->validated(),
            [
                'amount_PLN' => $this->formatMoney($this->getTotalPLN($request)),
            ]
        );

    }

    private function formatMoney(Money $money): string
    {
        $currencies = new ISOCurrencies;

        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money); // outputs 1.00 (decimal)
    }

    private function getTotalPLN(Request $request): Money
    {
        $total = Money::PLN(0);
        $total = $total->add(Money::PLN($request->input('count_1gr')));
        $total = $total->add(Money::PLN($request->input('count_2gr') * 2));
        $total = $total->add(Money::PLN($request->input('count_5gr') * 5));
        $total = $total->add(Money::PLN($request->input('count_10gr') * 10));
        $total = $total->add(Money::PLN($request->input('count_20gr') * 20));
        $total = $total->add(Money::PLN($request->input('count_50gr') * 50));
        $total = $total->add(Money::PLN($request->input('count_1zl') * 100)); // 1zł=100gr
        $total = $total->add(Money::PLN($request->input('count_2zl') * 200));
        $total = $total->add(Money::PLN($request->input('count_5zl') * 500));
        $total = $total->add(Money::PLN($request->input('count_10zl') * 1000));
        $total = $total->add(Money::PLN($request->input('count_20zl') * 2000));
        $total = $total->add(Money::PLN($request->input('count_50zl') * 5000));
        $total = $total->add(Money::PLN($request->input('count_100zl') * 10000));
        $total = $total->add(Money::PLN($request->input('count_200zl') * 20000));
        $total = $total->add(Money::PLN($request->input('count_500zl') * 50000));

        return $total;
    }

    // Format money to string

    public function confirmBoxByBoxID(int $boxID): CharityBox
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        $box->is_counted = true;
        $box->counting_user_id = $this->operatingUserId;

        $box->time_counted = Carbon::now();

        $box->save();

        $box = $box->fresh()->load('collector');

        $event = new BoxEvent;
        $event->type = 'confirmed';
        $event->box_id = $box->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = '';
        $event->save();

        return $box;
    }

    /**
     * @return Collection<int, CharityBox>
     */
    public function getAll(): Collection
    {
        return CharityBox::with('collector')->orderByRaw('CAST("charity_boxes"."collectorIdentifier" AS NUMERIC)')->get();
    }

    public function lastChangedBox(): CharityBox
    {
        return CharityBox::with('collector')->orderBy('updated_at')->first();
    }
}
