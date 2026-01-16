<?php

namespace App\Http\Controllers;

use App\Lib\Rates\RatesFetcher;
use Illuminate\Support\Facades\Storage;

class AmountDisplayController extends Controller
{
    private RatesFetcher $ratesFetcher;

    public function __construct(RatesFetcher $fetcher)
    {
        $this->ratesFetcher = $fetcher;
    }

    public function getRates()
    {
        // Wyświetla Stawki do wklejenia do pliku
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    // Wyświetl zliczoną ilość pieniędzy
    public function display()
    {
        $data = \App\totalCollectedReal();

        return view('amount')->with('data', $data);
    }

    // Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    public function displayFromStoredJson()
    {
        $data = json_decode(Storage::get('raw2.txt'), true);

        return view('amount_simplest')->with('data', $data);
    }

    // Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    public function displayFromStoredJsonGreen()
    {
        $data = json_decode(Storage::get('raw2.txt'), true);

        return view('amount_simplest_green')->with('data', $data);
    }

    public function displayApi()
    {
        $data = \App\totalCollectedReal();

        return response()->json($data);
    }

    public function getTotalRawPln()
    {
        return \App\totalCollected();
    }

    public function getTotalRawWithForeign()
    {
        return \App\totalCollectedWithForeign();
    }

    public function displayRawJson()
    {
        $data = \App\totalCollectedArray();

        return response()->json($data);
    }
}
