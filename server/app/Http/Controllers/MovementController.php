<?php

namespace App\Http\Controllers;

use App\CharityBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MovementController extends Controller
{
    /**
     * Mark station as ready_deployed
     *
     * @param Request $request
     * @param int $stationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function markStationReadyDeployed(Request $request, $stationId)
    {
        try {
            // Find the charity box with status 'ready' for this station
            $box = CharityBox::where('counting_user_id', $stationId)
                ->where('is_counted', false)
                ->where('is_confirmed', false)
                ->whereNotNull('time_given')
                ->orderBy('time_given', 'desc')
                ->first();

            if (!$box) {
                return response()->json([
                    'success' => false,
                    'message' => 'No ready box found for this station'
                ], 404);
            }

            $currentStatus = Cache::get("station_{$stationId}_status", 'unavailable');

            if ($currentStatus !== 'ready') {
                return response()->json([
                    'success' => false,
                    'message' => 'Station is not in ready status'
                ], 400);
            }

            Cache::put("station_{$stationId}_status", 'ready_deployed', now()->addHours(24));
            Cache::put("station_{$stationId}_timestamp", now()->toIso8601String(), now()->addHours(24));

            return response()->json([
                'success' => true,
                'message' => 'Station marked as ready_deployed',
                'station' => $stationId,
                'status' => 'ready_deployed',
                'box_id' => $box->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating station status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all stations with their current status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStations()
    {
        try {
            $stations = [];

            // Get status for all 28 stations
            for ($i = 1; $i <= 28; $i++) {
                $status = Cache::get("station_{$i}_status", 'unavailable');
                $timestamp = Cache::get("station_{$i}_timestamp", null);

                $stations[] = [
                    'station' => $i,
                    'status' => $status,
                    'time' => $timestamp
                ];
            }

            return response()->json($stations);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching stations',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

