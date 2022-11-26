<?php

namespace App\Lib\BoxOperator;

use App\BoxEvent;
use App\CharityBox;
use App\Collector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BoxOperator {
    private int $operatingUserId;

    public function __construct(string $operatingUserId) {
        $this->operatingUserId = $operatingUserId;
    }


    /**
     * @throws ValidationException
     */
    public function findByCollectorIdentifier(string $identifier): CharityBox {
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
}
