<?php

namespace App\Http\Controllers;

use App\Events\HelpRequested;
use App\Events\HelpResolved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HelpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'station_number' => 'required|integer',
        ]);

        $stationNumber = (int) $request->input('station_number');
        $currentList = Cache::get('stations_needing_help', []);

        if (! in_array($stationNumber, $currentList)) {
            $currentList[] = $stationNumber;
            Cache::forever('stations_needing_help', $currentList);
            HelpRequested::dispatch($stationNumber);
        }

        return response()->json(['status' => 'Help requested!']);
    }

    public function resolve(Request $request)
    {
        $request->validate([
            'station_number' => 'required|integer',
        ]);

        $stationNumber = (int) $request->input('station_number');
        $currentList = Cache::get('stations_needing_help', []);

        $updatedList = array_values(array_filter($currentList, function ($value) use ($stationNumber) {
            return $value != $stationNumber;
        }));

        Cache::forever('stations_needing_help', $updatedList);
        HelpResolved::dispatch((int) $stationNumber);

        return response()->json(['status' => 'Resolved']);
    }
}
