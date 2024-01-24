<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\StationResource;
use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use ReflectionClass;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *   schema="Stations",
 *   title="Stations",
 *   @OA\Property(title="data", property="data", type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Station"),
 *   )
 * )
 *
 * @OA\Tag(
 *     name="Stations",
 *     description="API Endpoints of Stations"
 * )
 **/
class AvailabilityApiController extends ApiController
{
    public const STATUS_UNKNOWN = 0;
    public const STATUS_READY = 1;
    public const STATUS_BUSY = 2;
    public const STALE_TIMEOUT_IN_SECONDS = 300;

    public function __construct()
    {
    }

    /**
     * @OA\Get(
     *  path="/api/stations",
     *  operationId="getStationsList",
     *  tags={"Stations"},
     *  summary="Get list of Sttions",
     *  description="Returns list of Stations",
     *  @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *      @OA\JsonContent(ref="#/components/schemas/Stations")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Stations
     * @return StationResource
     */
    public function index(): StationResource
    {
        return $this->getList();
    }

    /**
     * @OA\Post(
     *  path="/api/stations/{id}/ready",
     *  operationId="reayStation",
     *  tags={"Stations"},
     *  summary="Set Station status to ready",
     *  description="Set Station status to ready",
     *  @OA\Parameter(
     *      in="path",
     *      name="id",
     *      required=true,
     *      description="Station id",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     *  ),
     *  @OA\Response(
     *     response="201",
     *     description="Station set to ready",
     *     @OA\JsonContent(ref="#/components/schemas/Station"),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return StationResource
     */
    public function postReady(Request $request, int $id): StationResource
    {
        $this->setStationStatus($id, self::STATUS_READY);

        return new StationResource($this->getStationStatus($id));
    }

    /**
     * @OA\Post(
     *  path="/api/stations/{id}/busy",
     *  operationId="busyStation",
     *  tags={"Stations"},
     *  summary="Set Station status to busy",
     *  description="Set Station status to busy",
     *  @OA\Parameter(
     *      in="path",
     *      name="id",
     *      required=true,
     *      description="Station id",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     *  ),
     *  @OA\Response(
     *     response="201",
     *     description="Station set to busy",
     *     @OA\JsonContent(ref="#/components/schemas/Station"),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return StationResource
     */
    public function postBusy(Request $request, int $id): StationResource
    {
        $this->setStationStatus($id, self::STATUS_BUSY);

        return new StationResource($this->getStationStatus($id));
    }

    /**
     * @OA\Post(
     *  path="/api/stations/{id}/unknown",
     *  operationId="unknownStation",
     *  tags={"Stations"},
     *  summary="Set Station status to unknown",
     *  description="Set Station status to unknown",
     *  @OA\Parameter(
     *      in="path",
     *      name="id",
     *      required=true,
     *      description="Station id",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     *  ),
     *  @OA\Response(
     *     response="201",
     *     description="Station set to busy",
     *     @OA\JsonContent(ref="#/components/schemas/Station"),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return StationResource
     */
    public function postUnknown(Request $request, int $id): StationResource
    {
        $this->setStationStatus($id, self::STATUS_UNKNOWN);

        return new StationResource($this->getStationStatus($id));
    }

    /**
     * @OA\Get(
     *  path="/api/stations/status",
     *  operationId="getStationsStatusesList",
     *  tags={"Stations"},
     *  summary="Get list of Sttions statuses",
     *  description="Returns list of Stations statuses",
     *  @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *      @OA\JsonContent(
     *          @OA\Property(title="data", property="data", type="array",
     *              @OA\Items(
     *                  @OA\Property(property="name", type="string", example="STATUS_READY"),
     *                  @OA\Property(property="value",type="int", example="1")
     *              )
     *          )
     *      ),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Stations
     * @return JsonResponse
     */
    public function getStatusList()
    {
        $reflector = new ReflectionClass(self::class);
        $array = array_filter($reflector->getConstants(), function (string $key) { return str_starts_with($key, 'STATUS_'); }, ARRAY_FILTER_USE_KEY);
        $array = array_map(function ($key, $value) {
            return [
                'name' => $key,
                'value' => $value
            ];
        }, array_keys($array), $array);

        return new JsonResponse($array);
    }

    /**
     * @return StationResource
     */
    private function getList(): StationResource
    {
        $output = [];
        for ($i = 1; $i < 40; $i++) {
            $st = Cache::get('station_' . $i . '_status');
            if($st === self::STATUS_READY || $st === self::STATUS_BUSY) {
                $t = Cache::get('station_' . $i . '_timestamp');
                if(time() - (int)$t > self::STALE_TIMEOUT_IN_SECONDS) {
                    $this->setStationStatus($i, self::STATUS_UNKNOWN);
                }
            }

            $output[] = [
                'station' => $i,
                'status' => Cache::get('station_' . $i . '_status') ?? self::STATUS_UNKNOWN,
                'time' => Cache::get('station_' . $i . '_timestamp')
            ];
        }

        return new StationResource($output);
    }



    private function setStationStatus(int $id, int $status): void
    {
        Cache::set('station_' . $id . '_status', $status);
        Cache::set('station_' . $id . '_timestamp', time());
    }

    private function getStationStatus(int $id): array
    {
        return [
            'station' => $id,
            'status' => Cache::get('station_' . $id . '_status'),
            'time' => Cache::get('station_' . $id . '_timestamp'),
        ];
    }
}
