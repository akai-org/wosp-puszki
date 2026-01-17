<?php

namespace App\Http\Controllers;

use App\Lib\Rates\RatesFetcher;
use Illuminate\Support\Facades\Storage;
use function App\totalCollected;
use function App\totalCollectedArray;
use function App\totalCollectedReal;
use function App\totalCollectedWithForeign;

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

    //Wyświetl zliczoną ilość pieniędzy
    function display()
    {
        $data = totalCollectedReal();
        return view('amount')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJson()
    {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJsonGreen()
    {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest_green')->with('data', $data);
    }

    function displayApi()
    {
        $data = totalCollectedReal();
        return response()->json($data);
    }

    function getTotalRawPln()
    {
        return totalCollected();
    }

    function getTotalRawWithForeign()
    {
        return totalCollectedWithForeign();
    }

    function displayRawJson()
    {
        $data = totalCollectedArray();
        return response()->json($data);
    }
}
