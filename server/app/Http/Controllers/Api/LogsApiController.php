<?php

namespace App\Http\Controllers\Api;

use App\BoxEvent;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *   schema="BoxEvents",
 *   title="BoxEvents",
 *   @OA\Property(title="data", property="data", type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/BoxEvent"),
 *   )
 * )
 *
 * @OA\Tag(
 *     name="BoxEvent",
 *     description="API Endpoints for charity box events - logs"
 * )
 **/
class LogsApiController extends ApiController
{
    public function __construct()
    {
        parent::__construct(BoxEvent::class);

        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        //Tylko admini dodają zbieraczy (a lista powinna być zaimportowana wcześniej, żeby nie napierdalać tego ręcznie)
        $this->middleware('collectorcoordinator');
    }

    /**
     * @OA\Get(
     *  path="/logs",
     *  operationId="getBoxEventsList",
     *  tags={"BoxEvent"},
     *  summary="Get list of box events - logs",
     *  description="Returns list of Logs",
     *  @OA\Response(
     *     response=200, description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/BoxEvents")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Box Events
     * @return JsonResponse
     */
    public function index()
    {
        //Json z logami zwracamy
        $logs = BoxEvent::with('user')
            ->with('box')
            ->orderBy('created_at', 'desc')
            ->get([
                'type', 'comment', 'created_at', 'user_id', 'box_id'
            ])->take(300);

        return response()->json($logs);
    }

    /**
     * @OA\Get(
     *  path="/logs/box/{id}",
     *  operationId="getBoxEventsByBox",
     *  tags={"BoxEvent"},
     *  summary="Get charity box events - logs",
     *  description="Returns charity box Logs",
     *  @OA\Parameter(
     *     name="id",
     *     description="Charity Box id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="integer",
     *         example="1"
     *     )
     *  ),
     *  @OA\Response(
     *     response=200, description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/BoxEvents")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Box Events
     * @return JsonResponse
     */
    public function getBox($id) {
        //Json z logami zwracamy
        $logs = BoxEvent::with('user')
            ->with('box')
            ->where('box_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get([
                'type', 'comment', 'created_at', 'user_id', 'box_id'
            ]);

        return response()->json($logs);
    }

    //Logi użytkownika, powiązane z logami puszki

}
