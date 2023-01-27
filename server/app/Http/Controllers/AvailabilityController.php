<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

const STATUS_UNKNOWN = 0;
const STATUS_READY = 1;
const STATUS_BUSY = 2;
const STALE_TIMEOUT_IN_SECONDS = 300;
class AvailabilityController extends Controller
{
    public function getList() {
        $output = [];
        for ($i = 1; $i < 40; $i++) {
            $st = Cache::get('station_' . $i . '_status');
            if($st === STATUS_READY || $st === STATUS_BUSY) {
                $t = Cache::get('station_' . $i . '_timestamp');
                if(time() - (int)$t > STALE_TIMEOUT_IN_SECONDS) {
                    $this->setStationStatus($i, STATUS_UNKNOWN);
                }
            }

            $output[] = [
                's' => $i,
                'st' => Cache::get('station_' . $i . '_status') ?? STATUS_UNKNOWN,
                't' => Cache::get('station_' . $i . '_timestamp')
            ];
        }

        return response()->json($output);
    }

    public function postReady(Request $request, int $id) {
        $this->setStationStatus($id, STATUS_READY);

    }
    public function postBusy(Request $request, int $id) {
        $this->setStationStatus($id, STATUS_BUSY);
    }
    public function postUnknown(Request $request, int $id) {
        $this->setStationStatus($id, STATUS_UNKNOWN);
    }

    private function setStationStatus(int $id, int $status){
        Cache::set('station_' . $id . '_status', $status);
        Cache::set('station_' . $id . '_timestamp', time());
    }

}
