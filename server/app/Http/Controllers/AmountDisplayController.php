<?php

namespace App\Http\Controllers;

use App\Lib\Rates\RatesFetcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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

    function getRates(): Factory|View|\Illuminate\View\View
    {
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    function display(): Factory|View|\Illuminate\View\View
    {
        $data = totalCollectedReal();
        return view('amount')->with('data', $data);
    }

    function displayFromStoredJson(): Factory|View|\Illuminate\View\View
    {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest')->with('data', $data);
    }

    function displayFromStoredJsonGreen(): Factory|View|\Illuminate\View\View
    {
        $data = json_decode(Storage::get('raw2.txt'), true);
        return view('amount_simplest_green')->with('data', $data);
    }

    function displayApi(): JsonResponse
    {
        $data = totalCollectedReal();
        return response()->json($data);
    }

    function getTotalRawPln(): string
    {
        return totalCollected();
    }

    function getTotalRawWithForeign(): string
    {
        return totalCollectedWithForeign();
    }

    function displayRawJson(): JsonResponse
    {
        $data = totalCollectedArray();
        return response()->json($data);
    }
}
