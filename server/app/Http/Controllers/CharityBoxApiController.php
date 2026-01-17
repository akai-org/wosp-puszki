<?php

namespace App\Http\Controllers;

use App\BoxEvent;
use App\CharityBox;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Api dla ajaxa
 *
 * Features moved to /Api/CharityBoxApiController
 * Class to delete after checking functionality
 */
class CharityBoxApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function getVerifyList(): JsonResponse
    {
        $boxesToConfirm = CharityBox::with('collector', 'countingUser')
            ->unconfirmed()
            ->orderBy('time_counted', 'desc')
            ->get();
        return response()->json($boxesToConfirm);
    }

    public function getVerifiedBoxes(): JsonResponse
    {
        $boxesConfirmed = CharityBox::with('collector', 'countingUser')
            ->confirmed()
            ->orderBy('time_confirmed', 'desc')
            ->get();

        return response()->json($boxesConfirmed);
    }

    public function postUnVerify(Request $request): false|string
    {
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
                'message' => 'Puszka nr ' . $box->id . ' anulowano zatwierdzenie (' . $box->amount_PLN . 'zł)',
                'status' => 'success'
            ]
        );
    }

}
