<?php

namespace App\Http\Controllers;

use App\CharityBox;
use App\BoxEvent;
use Illuminate\Http\Request;

class CharityBoxApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //Lista puszek do potwierdzenia (dla administratora)
    public function getVerifyList(){
        $boxesToConfirm = CharityBox::with('collector')
            ->unconfirmed()
            ->orderBy('time_counted', 'desc')
            ->get();
        return response()->json($boxesToConfirm);
    }

    public function getVerifiedBoxes() {
        //Puszki potwierdzone
        $boxesConfirmed = CharityBox::with('collector')
            ->confirmed()
            ->orderBy('time_confirmed', 'desc')
            ->get();

        return response()->json($boxesConfirmed);
    }

    public function postUnVerify(Request $request) {
        $box = CharityBox::where('id', '=', $request->boxID)->first();
        $box->is_confirmed = false;
        $box->user_confirmed_id = null;
        $box->time_confirmed = null;
        $box->save();

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
