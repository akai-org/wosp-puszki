<?php

namespace App\Http\Controllers;

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

    public function getAll()
    {
        return view('logs.box.display')
            ->with('ApiUrl', route('api.logs.list'))
            ->with('enableRefresh', true);
    }

    //Logi puszki
    public function getBox($boxID)
    {
        return view('logs.box.display')
            ->with('ApiUrl', route('api.logs.box', ['boxID' => $boxID]))
            ->with('enableRefresh', false);
    }

    //Logi użytkownika, powiązane z logami puszki

}
