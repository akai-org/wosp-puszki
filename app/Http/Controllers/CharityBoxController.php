<?php

namespace App\Http\Controllers;

use App\BoxEvent;
use App\CharityBox;
use App\Collector;
use Auth;
use Illuminate\Http\Request;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CharityBoxController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
    }

    //Dodaj nową puszkę (formularz)
    public function getCreate(){
        return view('liczymy.box.create');
    }

    //Dodaj nową puszkę
    public function postCreate(Request $request){
        $error = '';
        //Sprawdź poprawność danych (id/puszka)
        $request->validate([
            'collectorIdentifier' => 'required|between:1,255'
        ]);

        $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'));
        //Sprawdź czy wolontariusz istnieje
        if(!$collector->exists()){
            $error = 'Brak wolontariusza o takim identyfikatorze.';
        } else if ($collector->first()->boxes()->count() != 0) {
            //Sprawdź czy w ciągu ostatnich 30 sekund nie wydano puszki temu wolontariuszowi
            $latestGiven = Collector::with('boxes')->where('identifier', '=', $request->input('collectorIdentifier'))->first()->boxes()->orderBy('time_given', 'desc')->first(['time_given']);
            $latestTimeGiven = $latestGiven->time_given;
            $carbon = Carbon::parse($latestTimeGiven);
            //TODO FIX to 3600, add admin bypass
            if($carbon->diffInSeconds(Carbon::now()) <= 10 ){
                $error = 'Limit wydawania puszek - jedna na godzinę na wolontariusza';
            }
        }

        //Dodaj puszkę
        if(empty($error)) {
            $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->first();

            //Brak błędów
            $box = new CharityBox();
            $box->collectorIdentifier = trim($request->input('collectorIdentifier'));
            $box->collector_id = $collector->id;
            $box->is_given_to_collector = true;
            $box->given_to_collector_user_id = Auth::user()->id;
            $box->time_given = Carbon::now();
            $box->save();

            //Zapisujemy event do bazy

            $event = new BoxEvent();
            $event->type = 'give';
            $event->box_id = $box->id;
            $event->user_id = $request->user()->id;
            $event->comment = 'Collector: ' . $collector->display;
            $event->save();

            //Redirect do dodawania kolejnej puszki
            return view('liczymy.box.create')->with('message',
                'Wydano puszkę wolontariuszowi ' .
                $collector->display . $box->display_id);

        } else {
            //Zwracamy błąd
            $request->flash();
            return view('liczymy.box.create')->with('error', $error);
        }
    }

    //Znajdź puszkę (formularz)
    public function getFind() {
        return view('liczymy.box.find');
    }

    //Znajdź puszkę (formularz)
    public function postFind(Request $request) {
        //Wyszukujemy użytkownika
        //Podajemy dane do sprawdzenia
        Validator::make($request->all(), [
            'collectorIdentifier' => 'required|exists:collectors,identifier|alpha_num|between:1,255'
        ],
        [
            'collectorIdentifier.exists' => 'Wolontariusz o takim ID nie istnieje.'
        ])->validate();

        $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->first();

        //Puszki zbieracza
        $boxes = $collector->boxes()->get();

        //Sprawdź czy wolontariusz ma nierozliczoną puszkę
        //iteracja po wszystkich puszkach TODO
        foreach ($boxes as $box) {
            if (!$box->is_counted) {
                //Zapisujemy event do bazy

                $event = new BoxEvent();
                $event->type = 'found';
                $event->box_id = $box->id;
                $event->user_id = $request->user()->id;
                $event->comment = 'Collector: ' . $collector->display;
                $event->save();

                return view('liczymy.box.found')->with('box', $box)->with('collector', $collector);
            }
        }

        //TODO log alreadyCounted  usera

        return redirect()->route('box.find')
            ->with('error', 'Wszystkie puszki wolontariusza ' . $collector->display . ' są rozliczone.');

    }

    //Rozlicz puszkę (formularz)
    public function getCount(Request $request, $boxID){
        //Sprawdź czy nie jest rozliczona
        $box = CharityBox::where('id', '=', $boxID)->first();

        Log::info(Auth::user()->name . " rozpoczął/ęła rozliczanie puszki : " . $box->id .
            "/" . $box->collectorIdentifier);

        if(!$box->isCounted) {
            $event = new BoxEvent();
            $event->type = 'startedCounting';
            $event->box_id = $box->id;
            $event->user_id = $request->user()->id;
            $event->comment = 'Collector: ' . $box->collector->display;
            $event->save();

            return view('liczymy.box.count')->with('box', $box);
        } else {
            return redirect()->route('box.find')
                ->with('error', 'Puszka została już rozliczona, numer puszki: ' . $box->id . 'Wolontariusz: '. $box->collectorIdentifier);
        }
    }

    //Weryfikator przysłanych puszek
    public function validateBox(Request $request) {
        $request->validate([
            //PLN
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
            //Waluty obce
            'amount_EUR' => 'required|numeric|between:0,10000',
            'amount_USD' => 'required|numeric|between:0,10000',
            'amount_GBP' => 'required|numeric|between:0,10000',
            'comment' => ''
        ]);
    }

    //Zlicz całość puszki
    public function getTotalPLN(Request $request) {
        $total = Money::PLN(0);
        $total = $total->add(Money::PLN($request->input('count_1gr')));
        $total = $total->add(Money::PLN($request->input('count_2gr') * 2));
        $total = $total->add(Money::PLN($request->input('count_5gr') * 5));
        $total = $total->add(Money::PLN($request->input('count_10gr') * 10));
        $total = $total->add(Money::PLN($request->input('count_20gr') * 20));
        $total = $total->add(Money::PLN($request->input('count_50gr') * 50));
        $total = $total->add(Money::PLN($request->input('count_1zl') * 100));//1zł=100gr
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

//    Sformatuj obiekt Money do wyświetlenia
    public function formatMoney(Money $money) {
        //Formatowanie
        $currencies = new ISOCurrencies();

        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money); // outputs 1.00 (decimal)
    }

    //Rozlicz puszkę
    public function postCount(Request $request, $boxID){
        //Sprawdzamy czy pola są wypełnione, i czy poprawnie?
        $this->validateBox($request);

        //Przeliczamy sumę hajsu
        //Ilości są w groszach
        $total = $this->getTotalPLN($request);

        $totalFormatted = $this->formatMoney($total);

        $totalWithForeign =  number_format(
            array_sum(
                array(
                    $totalFormatted,
                    $request->input('amount_EUR') * env('RATE_EUR'),
                    $request->input('amount_USD') * env('RATE_USD'),
                    $request->input('amount_GBP') * env('RATE_GBP')
                )
            ), 2, '.', ' ');

        $box = CharityBox::where('id', '=', $boxID)->first();
        //Kompilujemy dane
        $data = [
            'collectorIdentifier' => $box->collector->identifier,
            'boxID' => $boxID,
            'count_1gr' => $request->input('count_1gr'),
            'count_2gr' => $request->input('count_2gr'),
            'count_5gr' => $request->input('count_5gr'),
            'count_10gr' => $request->input('count_10gr'),
            'count_20gr' => $request->input('count_20gr'),
            'count_50gr' => $request->input('count_50gr'),
            'count_1zl' => $request->input('count_1zl'),
            'count_2zl' => $request->input('count_2zl'),
            'count_5zl' => $request->input('count_5zl'),
            'count_10zl' => $request->input('count_10zl'),
            'count_20zl' => $request->input('count_20zl'),
            'count_50zl' => $request->input('count_50zl'),
            'count_100zl' => $request->input('count_100zl'),
            'count_200zl' => $request->input('count_200zl'),
            'count_500zl' => $request->input('count_500zl'),
            //Waluty obce
            'amount_EUR' => $request->input('amount_EUR'),
            'amount_USD' => $request->input('amount_USD'),
            'amount_GBP' => $request->input('amount_GBP'),
            'comment' => $request->input('comment'),
            'amount_PLN' => $totalFormatted,
            'amount_PLN_with_foreign' => $totalWithForeign
        ];

        $event = new BoxEvent();
        $event->type = 'endedCounting';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = 'box: ' . json_encode($data);
        $event->save();

        //Zapisujemy dane w sesji
        session(['boxData' => $data]);

        // Flash input in case user wants to go back
        $request->flash();

        //Przedstawiamy do weryfikacji
        return view('liczymy.box.confirm')->with('data', $data);

    }

    //Potwierdź puszkę (dla wolontariusza)
    public function confirm(Request $request, $boxID){
        //Zapisz puszkę do bazy
        $box = CharityBox::where('id', '=', $boxID)->first();

        $box->is_counted=true;
        $box->counting_user_id = Auth::user()->id;
        //Add money
        $data = \Session::get('boxData');
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

        $box->time_counted = Carbon::now();

        $box->save();

        //Wyczyść sesję
        \Session::remove('boxData');

        $event = new BoxEvent();
        $event->type = 'confirmed';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        //Zwróć info że puszka zapisana
        return redirect()->route('box.find')
            ->with('message', 'Puszka wolontariusza ' . $box->collector->display . ' została przesłana do zatwierdzenia.' . '('  .$box->amount_PLN.'zł)');
    }

    //Lista puszek do potwierdzenia (dla administratora)
    public function getVerifyList(){
        //Używa API w CharityBoxApiController
        return view('liczymy.box.verifyList');
    }

    //Wyświetl pojedynczą puszkę
    public function getDisplay(Request $request, $boxID) {
        $box = CharityBox::where('id', '=', $boxID)->first();

        return view('liczymy.box.display')->with('box', $box);
    }

    //Potwierdź puszkę (dla administratora)
    public function getVerify(Request $request, $boxID){
        $box = CharityBox::where('id', '=', $boxID)->first();

        //Sprawdź czy puszka jest przeliczona
        if($box->is_given_to_collector && $box->is_counted && !$box->is_confirmed){
            return view('liczymy.box.verify')->with('box', $box);
        } else {
            return redirect()->route('main')->with('error', 'Puszka nie może być potwierdzona');
        }
    }

    //Potwierdź puszkę (dla administratora)
    public function postVerify(Request $request){
        $box = CharityBox::where('id', '=', $request->boxID)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = $request->user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        //Drukuj potwierdzenie?
        //TODO
        //Zapisujemy event do bazy

        $event = new BoxEvent();
        $event->type = 'verified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();


        return json_encode(
            [
                'message' => 'Puszka nr ' . $box->id . ' potwierdzona ('.$box->amount_PLN.'zł)',
                'status' => 'success'
            ]
        );
    }

    //Wyświetl wszystkie puszki (dla administratora)
    public function getList(){
        $boxes = CharityBox::with('collector')->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Wyświeltl puszki, które nie zostały rozliczone (dla administratora)
    public function getListAway(){
        $boxes = CharityBox::with('collector')->where('is_counted', '=', 0)->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Modyfikuj puszkę (dla administratora)
    public function getModify($boxID) {
        $box = CharityBox::where('id', '=', $boxID)->first();

        //TODO fix this nicer
        //abezpieczenie że zatwierdzonej puszki nie można modyfikować
        if($box->is_confirmed) {
            abort('404', 'Nie można modyfikować zatwierdzonej puszki.');
        }

        return view('liczymy.box.modify')->with('box', $box);
    }

    //Modyfikuj puszkę (dla administratora)
    public function postModify(Request $request, $boxID) {
        //TODO zabezpieczenie że zatwierdzonej puszki nie można modyfikować
        //Sprawdzamy czy pola są wypełnione, i czy poprawnie?
        $this->validateBox($request);

        //Przeliczamy sumę hajsu
        //Ilości są w groszach
        $total = $this->getTotalPLN($request);

        //Zapisz puszkę do bazy
        $box = CharityBox::where('id', '=', $boxID)->first();

        //TODO fix this nicer
        //abezpieczenie że zatwierdzonej puszki nie można modyfikować
        if($box->is_confirmed) {
            abort('404', 'Nie można modyfikować zatwierdzonej puszki.');
        }

        $box->count_1gr = $request->input('count_1gr');
        $box->count_2gr = $request->input('count_2gr');
        $box->count_5gr = $request->input('count_5gr');
        $box->count_10gr = $request->input('count_10gr');
        $box->count_20gr = $request->input('count_20gr');
        $box->count_50gr = $request->input('count_50gr');
        $box->count_1zl = $request->input('count_1zl');
        $box->count_2zl = $request->input('count_2zl');
        $box->count_5zl = $request->input('count_5zl');
        $box->count_10zl = $request->input('count_10zl');
        $box->count_20zl = $request->input('count_20zl');
        $box->count_50zl = $request->input('count_50zl');
        $box->count_100zl = $request->input('count_100zl');
        $box->count_200zl = $request->input('count_200zl');
        $box->count_500zl = $request->input('count_500zl');
        $box->amount_PLN = $this->formatMoney($total);
        $box->amount_EUR = $request->input('amount_EUR');
        $box->amount_USD = $request->input('amount_USD');
        $box->amount_GBP = $request->input('amount_GBP');
        $box->comment = $request->input('comment');

        $box->save();

        //Todo logging
        $event = new BoxEvent();
        $event->type = 'modified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = 'box:' . $box->toJson();
        $event->save();

        return redirect()->route('box.verify.list')->with('message', 'Zapisano puszkę wolontariusza ' . $box->collectorIdentifier . ', ID w bazie:' . $box->id . ' (' . $box->amount_PLN  . 'zł)');
    }
}
