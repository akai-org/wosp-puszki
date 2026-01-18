<?php

namespace App\Http\Controllers;

use App\Lib\Rates\RatesFetcher;

class AmountDisplayController extends Controller
{
    private RatesFetcher $ratesFetcher;

    public function __construct(RatesFetcher $fetcher)
    {
        $this->ratesFetcher = $fetcher;
    }

    function getRates()
    {
        //Wyświetla Stawki do wklejenia do pliku
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    function displayApi()
    {
        $data = \App\totalCollectedReal();
        return response()->json($data);
    }

    function getTotalRawPln()
    {
        return \App\totalCollected();
    }

    function getTotalRawWithForeign()
    {
        return \App\totalCollectedWithForeign();
    }

    function displayRawJson()
    {
        $data = \App\totalCollectedArray();
        return response()->json($data);
    }
}
