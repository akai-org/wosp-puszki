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

    public function getRates()
    {
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    public function displayApi()
    {
        $data = totalCollectedReal();

        return response()->json($data);
    }

    public function getTotalRawPln()
    {
        return totalCollected();
    }

    public function getTotalRawWithForeign()
    {
        return totalCollectedWithForeign();
    }

    public function displayRawJson()
    {
        $data = totalCollectedArray();

        return response()->json($data);
    }
}
