<?php

namespace App\Http\Controllers;

use App\Collector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
        //Tylko admini dodają zbieraczy (a lista powinna być zaimportowana wcześniej, żeby nie napierdalać tego ręcznie)
        $this->middleware('admin');
    }

    //Dodawanie zbieracza (formularz)
    public function getCreate(){
        return view('liczymy.collector.create');
    }

    //Dodawanie zbieracza
    public function postCreate(Request $request){
        //Walidacja danych

        $request->validate([
            'collectorIdentifier' => 'required|alpha_num|between:1,255',
            'firstName' => 'required|alpha|between:1,255',
            'lastName' => 'required|alpha|between:1,255',
        ]);
        //Sprawdzenie czy wolontariusza nie ma już w bazie (po ID)
        $collectorExists = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->exists();
        if($collectorExists) {
            return view('liczymy.collector.create')->with('error', 'Istnieje już wolontariusz o podanym numerze w systemie');
        }
        //Dodanie wolontariusza
        $collector = new Collector();
        $collector->identifier = $request->input('collectorIdentifier');
        $collector->firstName = $request->input('firstName');
        $collector->lastName = $request->input('lastName');
        $collector->save();

        Log::info(Auth::user()->name . " dodał/a wolontariusza: " . $collector->firstName . " " . $collector->lastName . " ("
            . $collector->identifier . ")");

        return redirect()->route('collector.create')->with('message',
            'Dodano wolontariusza ' . $collector->show());
    }

    //Wyświetlanie wszystkich wolontariuszy (dla Adminów i superadminów)
    public function getList(){
        $collectors = Collector::all();
        return view('liczymy.collector.list')->with('collectors', $collectors);
    }

}
