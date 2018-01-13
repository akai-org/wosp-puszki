<?php

namespace App\Http\Controllers;

use App\BoxEvent;
use Illuminate\Http\Request;

class LogsApiController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
        //Tylko admini dodają zbieraczy (a lista powinna być zaimportowana wcześniej, żeby nie napierdalać tego ręcznie)
        $this->middleware('admin');
    }

    //Wszystkie logi
    public function getAll(){
        //Json z logami zwracamy
        $logs = BoxEvent::with('user')
            ->with('box')
            ->orderBy('created_at', 'desc')
            ->get([
                'type', 'comment', 'created_at', 'user_id', 'box_id'
            ]);

        return response()->json($logs);
    }

    //Logi puszki
    public function getBox($boxID) {
        //Json z logami zwracamy
        $logs = BoxEvent::with('user')
            ->with('box')
            ->where('box_id', '=', $boxID)
            ->orderBy('created_at', 'desc')
            ->get([
                'type', 'comment', 'created_at', 'user_id', 'box_id'
            ]);

        return response()->json($logs);
    }

    //Logi użytkownika, powiązane z logami puszki

}
