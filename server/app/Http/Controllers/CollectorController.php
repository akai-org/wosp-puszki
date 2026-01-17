<?php

namespace App\Http\Controllers;

use App\Collector;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CollectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('collectorcoordinator');
    }

    public function getCreate(): Factory|View|\Illuminate\View\View
    {
        $this->middleware('admin');
        return view('liczymy.collector.create');
    }

    public function postCreate(Request $request): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $this->middleware('admin');

        $request->validate([
            'collectorIdentifier' => 'required|alpha_num|between:1,255',
            'firstName' => 'required|alpha|between:1,255',
            'lastName' => 'required|alpha|between:1,255',
            'phoneNumber' => 'nullable|alpha_num|between:9,16'
        ]);

        $collectorExists = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->exists();
        if ($collectorExists) {
            return view('liczymy.collector.create')->with('error', 'Istnieje już wolontariusz o podanym numerze w systemie');
        }

        $collector = new Collector();
        $collector->identifier = $request->input('collectorIdentifier');
        $collector->firstName = $request->input('firstName');
        $collector->lastName = $request->input('lastName');
        $collector->phoneNumber = $request->input('phoneNumber');
        $collector->save();

        Log::info(Auth::user()->name . " dodał/a wolontariusza: " . $collector->firstName . " " . $collector->lastName . " ("
            . $collector->identifier . ")");

        return redirect()->route('collector.create')->with('message',
            'Dodano wolontariusza ' . $collector->show());
    }

    public function getList(): Factory|View|\Illuminate\View\View
    {
        $this->middleware('collectorcoordinator');
        $collectors = Collector::with('boxes')->get();

        $status = [];

        foreach ($collectors as $collector) {
            $boxesGiven = $collector->boxes()->count();

            $boxesCounted = $collector->boxes()->where('is_counted', '=', 1)->count();

            $boxesConfirmed = $collector->boxes()->where('is_confirmed', '=', 1)->count();

            if ($boxesGiven === 0) {
                $status[$collector->identifier]['color'] = '#FFFFFF';
                $status[$collector->identifier]['message'] = 'Brak puszek';
            } else if ($boxesGiven == $boxesConfirmed) {
                $status[$collector->identifier]['color'] = '#82CA9D';
                $status[$collector->identifier]['message'] = 'Rozliczony';
            } else if ($boxesGiven == $boxesCounted) {
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
