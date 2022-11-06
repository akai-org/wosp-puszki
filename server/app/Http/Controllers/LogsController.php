<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
        //Tylko admini dodają zbieraczy (a lista powinna być zaimportowana wcześniej, żeby nie napierdalać tego ręcznie)
        $this->middleware('collectorcoordinator');
    }

    //Wszystkie logi

    public function getAll(){
        return view('liczymy.logs.box.display')
            ->with('ApiUrl', route('api.logs.all'))
            ->with('enableRefresh', true);
    }

    //Logi puszki
    public function getBox($boxID){
        return view('liczymy.logs.box.display')
            ->with('ApiUrl', route('api.logs.box', ['boxID' => $boxID]))
            ->with('enableRefresh', false);
    }

    //Logi użytkownika, powiązane z logami puszki

}
