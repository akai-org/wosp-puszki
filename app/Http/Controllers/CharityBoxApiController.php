<?php

namespace App\Http\Controllers;
use App\Models\CharityBox;
use Illuminate\Support\Facades\Log;
use App\Models\BoxEvent;

use Illuminate\Http\Request;

class CharityBoxApiController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
        //Tylko administratorzy
        $this->middleware('admin');
    }

    //Lista puszek do potwierdzenia (dla administratora)
    public function getVerifyList(){
        //puszki do potwierdzenia
        $boxesToConfirm = CharityBox::with('collector')   // remove n+1 problem
        ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', true)
            ->where('is_confirmed', '=', false)
            ->orderBy('time_counted', 'desc')
            //todo zapytać tutaj czy nie asc przypadkiem, najdawniej policzone na górze
            ->get();


        return response()->json($boxesToConfirm);
    }

    public function getVerifiedBoxes() {
        //Puszki potwierdzone
        $boxesConfirmed = CharityBox::with('collector')   // remove n+1 problem
        ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', true)
            ->where('is_confirmed', '=', true)
            ->orderBy('time_confirmed', 'desc')
            ->get();

        return response()->json($boxesConfirmed);
    }

    public function postUnVerify(Request $request) {
        //Sprawdź status TODO
        $box = CharityBox::where('id', '=', $request->boxID)->first();
        //Zmień status
        $box->is_confirmed = false;
        $box->user_confirmed_id = null;
        //Usuń datę
        $box->time_confirmed = null;
        $box->save();

        //TODO
        $event = new BoxEvent();
        $event->type = 'unverified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        return json_encode(
            [
                'message' => 'Puszka nr ' . $box->id . ' anulowano zatwierdzenie ('.$box->amount_PLN.'zł)',
                'status' => 'success'
            ]
        );
    }

}
