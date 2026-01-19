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
            $currentStatus = Cache::get("station_{$stationId}_status", 0);

            if ($currentStatus !== 1 && $currentStatus !== '1' && $currentStatus !== 'ready') {
                return response()->json([
                    'success' => false,
                    'message' => 'Station is not in ready status',
                    'current_status' => $currentStatus
                ], 400);
            }

            $box = CharityBox::where('counting_user_id', $stationId)
                ->where('is_counted', false)
                ->where('is_confirmed', false)
                ->whereNotNull('time_given')
                ->orderBy('time_given', 'desc')
                ->first();

            Cache::put("station_{$stationId}_status", 3, now()->addHours(1));
            Cache::put("station_{$stationId}_timestamp", time(), now()->addHours(1));

            $response = [
                'success' => true,
                'message' => 'Station marked as ready_deployed',
                'station' => $stationId,
                'status' => 3,
                'status_name' => 'ready_deployed',
            ];

            if ($box) {
                $response['box_id'] = $box->id;
            }

            return response()->json($response);

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

            for ($i = 1; $i <= 31; $i++) {
                $status = Cache::get("station_{$i}_status", 0);
                $timestamp = Cache::get("station_{$i}_timestamp", null);

                if (is_string($status)) {
                    $status = match ($status) {
                        'ready', 'available' => 1,
                        'occupied', 'busy' => 2,
                        'ready_deployed' => 3,
                        default => 0
                    };
                }

                $stations[] = [
                    'station' => $i,
                    'status' => (int)$status,
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
