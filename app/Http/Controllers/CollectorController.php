<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
        $this->middleware('collectorcoordinator');
    }

    //Dodawanie zbieracza (formularz)
    public function getCreate(){
        $this->middleware('admin');
        return view('liczymy.collector.create');
    }

    //Dodawanie zbieracza
    public function postCreate(Request $request){
        $this->middleware('admin');
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
        $this->middleware('collectorcoordinator');
        $collectors = Collector::with('boxes')->get();

        //Wnioskowanie statusu
        $status = [];

        foreach ($collectors as $collector) {
            $boxesGiven = $collector->boxes()->count();

            $boxesCounted = $collector->boxes()->where('is_counted', '=', 1)->count();

            $boxesConfirmed = $collector->boxes()->where('is_confirmed', '=', 1)->count();

            if ($boxesGiven === 0) {
                //Brak puszek
                $status[$collector->identifier]['color'] = '#FFFFFF';
                $status[$collector->identifier]['message'] = 'Brak puszek';
            } else if ($boxesGiven == $boxesConfirmed) {
                //Wszystko rozliczone
                $status[$collector->identifier]['color'] = '#82CA9D';
                $status[$collector->identifier]['message'] = 'Rozliczony';
            } else if ($boxesGiven == $boxesCounted){
                //Oczekuje na zatwierdzenie
                $status[$collector->identifier]['color'] = '#FF8400';
                $status[$collector->identifier]['message'] = 'Oczekuje na zatwierdzenie';
            } else {
                $status[$collector->identifier]['color'] = '#bae1ff';
                $status[$collector->identifier]['message'] = 'Kwestuje';
            }

        }

        return view('liczymy.collector.list')
            ->with('collectors', $collectors)
            ->with('status', $status);
    }

}
