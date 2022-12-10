<?php

namespace App\Lib\BoxOperator;

use App\BoxEvent;
use App\CharityBox;
use App\Collector;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BoxOperator {
    private int $operatingUserId;

    public function __construct(string $operatingUserId) {
        $this->operatingUserId = $operatingUserId;
    }

    public function giveByCollectorIdentifier(string $identifier): CharityBox {
        $collector = Collector::where('identifier', '=', $identifier)->first();

        $box = new CharityBox();
        $box->collectorIdentifier = $collector->identifier;
        $box->collector_id = $collector->id;
        $box->is_given_to_collector = true;
        $box->given_to_collector_user_id = $this->operatingUserId;
        $box->time_given = Carbon::now();
        $box->save();

        $box = $box->fresh()->load('collector');

        $event = new BoxEvent();
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
    public function findLatestUncountedByCollectorIdentifier(string $identifier): CharityBox {
        //Wyszukujemy użytkownika
        //Podajemy dane do sprawdzenia
        Validator::make(['identifier' => $identifier], [
            'identifier' => 'required|exists:collectors,identifier|alpha_num|between:1,255'
        ],
            [
                'identifier.exists' => 'Wolontariusz o takim ID nie istnieje.'
            ])->validate();

        $collector = Collector::where('identifier', '=', $identifier)->first();

        //Puszki zbieracza
        $boxes = $collector->boxes()->orderBy('id', 'desc')->with('collector')->notCounted()->get();

        if(count($boxes) == 0) {
            throw new \Exception('Wszystkie puszki wolontariusza ' . $collector->display . ' są rozliczone.');
        }

        $event = new BoxEvent();
        $event->type = 'found';
        $event->box_id = $boxes[0]->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = 'Collector: ' . $collector->display;
        $event->save();

        return $boxes[0]->load('collector');
    }

    public function startCountByBoxID(int $boxID) : CharityBox {
        $box = CharityBox::where('id', '=', $boxID)->first();

        if($box->isCounted) {
            throw new \Exception('Puszka została już rozliczona, numer puszki: ' . $box->id . 'Wolontariusz: '.
                $box->collectorIdentifier);
        }

        $event = new BoxEvent();
        $event->type = 'startedCounting';
        $event->box_id = $box->id;
        $event->user_id = $this->operatingUserId;
        $event->comment = 'Collector: ' . $box->collector->display;
        $event->save();

        return $box;
    }


    protected function validateBox() {

    }

}
