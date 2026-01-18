<?php

namespace App\Http\Controllers;

use App\Lib\Rates\RatesFetcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

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

    public function getRates(): Factory|View|\Illuminate\View\View
    {
        return view('rates')->with('rates', $this->ratesFetcher->fetchRates());
    }

    public function displayApi(): JsonResponse
    {
        $data = totalCollectedReal();

        return response()->json($data);
    }

    public function getTotalRawPln(): string
    {
        return totalCollected();
    }

    public function getTotalRawWithForeign(): string
    {
        return totalCollectedWithForeign();
    }

    public function displayRawJson(): JsonResponse
    {
        $data = totalCollectedArray();

        return response()->json($data);
    }
}
