<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Collector;
use App\Http\Requests\Api\CollectorRequest;
use App\Http\Resources\Api\CharityBoxResource;
use App\Http\Resources\Api\CollectorResource;
use App\Lib\BoxOperator\BoxOperator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenApi\Annotations as OA;
use Response;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *   schema="Collectors",
 *   title="Collectors",
 *   @OA\Property(title="data", property="data", type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Collector"),
 *   )
 * )
 *
 * @OA\Tag(
 *     name="Collectors",
 *     description="API Endpoints for Collector (volunteers)"
 * )
 **/
final class CollectorApiController extends ApiController
{
    public function __construct()
    {
        parent::__construct(Collector::class);
    }

    /**
     * @OA\Get(
     *  path="/collectors",
     *  operationId="getCollectorList",
     *  tags={"Collectors"},
     *  summary="Get list of Collectors",
     *  description="Returns list of Collectors",
     *  @OA\Response(
     *     response=200, description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Collectors")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display a listing of Collectors
     * @return CollectorResource
     */
    public function index()
    {
        return new CollectorResource(Collector::with('boxes')->get());
    }

    /**
     * @OA\Get(
     *  path="/collectors/{id}",
     *  operationId="getCollectorById",
     *  tags={"Collectors"},
     *  summary="Get collector information",
     *  description="Returns collector data",
     *  @OA\Parameter(
     *     name="id",
     *     description="Collector id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="integer",
     *         example="1"
     *     )
     *  ),
     *  @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Collector")
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Display Collectors data
     * @return CollectorResource
     **/
    public function show(int $id)
    {
        // TODO check why auto fetching dont work (Collector $collector)
        return new CollectorResource(Collector::query()
            ->with('boxes')
            ->find($id)
        );
    }

    /**
     * @OA\Post(
     *  path="/collectors",
     *  operationId="postCollector",
     *  tags={"Collectors"},
     *  summary="Insert a new Collector",
     *  description="Insert a new Collector",
     *  @OA\RequestBody(
     *     description="Collector to create",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CollectorRequest")
     *  ),
     *  @OA\Response(
     *     response="201",
     *     description="Collector created",
     *     @OA\JsonContent(ref="#/components/schemas/Collector"),
     *  ),
     *  @OA\Response(response="200",description="Collector exist",
     *     @OA\JsonContent(
     *        @OA\Property(property="status", type="string", example="error"),
     *        @OA\Property(property="message", type="string", example="Istnieje już wolontariusz o podanym numerze w systemie"),
     *     ),
     *  ),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     *  @OA\Response(response=422, description="Validation exception"),
     * )
     *
     * @param CollectorRequest $request
     * @return JsonResponse
     */
    public function create(CollectorRequest $request) {
        //Walidacja danych
        $request->validate([
            'collectorIdentifier' => 'required|alpha_num|between:1,255',
            'firstName' => 'required|alpha|between:1,255',
            'lastName' => 'required|alpha|between:1,255',
        ]);
        //Sprawdzenie czy wolontariusza nie ma już w bazie (po ID)
        $collectorExists = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->exists();
        if($collectorExists) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Istnieje już wolontariusz o podanym numerze w systemie'
            ]);
        }

        //Dodanie wolontariusza
        $collector = new Collector();
        $collector->identifier = $request->input('collectorIdentifier');
        $collector->firstName = $request->input('firstName');
        $collector->lastName = $request->input('lastName');
        $collector->save();

        Log::info(Auth::user()->name . " dodał/a wolontariusza: " . $collector->firstName . " " . $collector->lastName . " ("
            . $collector->identifier . ")");

        return new CollectorResource($collector);
    }

    /**
     * @OA\Post(
     *  path="/collectors/{collectorIdentifier}/box/create",
     *  operationId="giveCollectorBox",
     *  tags={"Collectors"},
     *  summary="Create Charity Box for Collector",
     *  description="Create Charity Box for Collector",
     *  @OA\Parameter(
     *      in="path",
     *      name="collectorIdentifier",
     *      required=true,
     *      description="Collector (volunteer) identifier id (number)",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     *  ),
     *  @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *  ),
     *  @OA\Response(response=400, description="Bad Request"),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Function to give a collector new box by his identifier id number
     * @return JsonResponse
     */
    public function createBoxForCollector(int $collectorIdentifier, Request $request)
    {
        $bo = new BoxOperator((string)$request->user()->id);

        try {
            $box = $bo->giveByCollectorIdentifier((string)$collectorIdentifier);
        } catch (\Exception $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 400);
        }

        return new CharityBoxResource($box);
    }

    /**
     * @OA\Get(
     *  path="/collectors/{collectorIdentifier}/box/latestUncounted",
     *  operationId="getCollectorUncountedBox",
     *  tags={"Collectors"},
     *  summary="Get last uncounted Collector's Charity Box",
     *  description="Get last uncounted Collector's Charity Box",
     *  @OA\Parameter(
     *      in="path",
     *      name="collectorIdentifier",
     *      required=true,
     *      description="Collector (volunteer) identifier id (number)",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     *  ),
     *  @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *  ),
     *  @OA\Response(response=400, description="Bad Request"),
     *  @OA\Response(response=401, description="Unauthenticated"),
     *  @OA\Response(response=403, description="Forbidden"),
     * )
     *
     * Function to get collector's uncounted charity box
     * @return JsonResponse
     */
    public function getCollectorLatUncountedBox(int $collectorIdentifier, Request $request)
    {
        $bo = new BoxOperator((string)$request->user()->id);

        try {
            $box = $bo->findLatestUncountedByCollectorIdentifier((string)$collectorIdentifier);
        } catch (\Exception $e) {
            return Response::json(sprintf('Error: Charity Box for Collector wit identifier: %s not found', (string)$collectorIdentifier), 404);
        }

        return Response::json($box, 200);
    }
}