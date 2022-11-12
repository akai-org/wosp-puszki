<?php

namespace App\Http\Controllers;

use App\CharityBox;
use App\Lib\Rates\RatesFetcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AmountDisplayController extends Controller
{
    private RatesFetcher $ratesFetcher;

    public function __construct(RatesFetcher $fetcher)
    {
        $this->ratesFetcher = $fetcher;
    }

    function getRates() {
        //Wyświetla Stawki do wklejenia do pliku
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    //Wyświetl zliczoną ilość pieniędzy
    function display() {
        $data = \App\totalCollectedReal();
        return view('amount')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJson() {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJsonGreen() {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest_green')->with('data', $data);
    }

    function displayApi() {
        $data = \App\totalCollectedReal();
        return response()->json($data);
    }

    function getTotalRawPln() {
        return \App\totalCollected();
    }

    function getTotalRawWithForeign() {
        return \App\totalCollectedWithForeign();
    }

    function displayRawJson() {
        $data = \App\totalCollectedArray();
        return response()->json($data);
    }
}
