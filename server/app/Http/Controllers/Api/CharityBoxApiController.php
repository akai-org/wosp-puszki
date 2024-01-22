<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\BoxEvent;
use App\CharityBox;
use App\Http\Requests\Api\BoxCharityBoxRequest;
use App\Http\Requests\Api\UpdateCountingCharityBoxRequest;
use App\Http\Resources\Api\CharityBoxResource;
use App\Lib\BoxOperator\BoxOperator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

/**
 * @author kabix09
 *
 * @OA\Tag(
 *     name="CharityBoxes",
 *     description="API Endpoints of Charity Boxes"
 * )
 **/
final class CharityBoxApiController extends ApiController
{
    public function __construct()
    {
        parent::__construct(CharityBox::class);
    }

    /**
     * @OA\Get(
     *      path="/charityBoxes",
     *      operationId="getCharityBoxList",
     *      tags={"CharityBoxes"},
     *      summary="Get list of charity boxes",
     *      description="Returns list of charity boxes",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBoxResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * @return CharityBoxResource
     */
    public function index()
    {
        return new CharityBoxResource(CharityBox::with('collector')->get());
    }

    /**
     * @OA\Get(
     *      path="/charityBoxes/{id}",
     *      operationId="getCharityBoxById",
     *      tags={"CharityBoxes"},
     *      summary="Get charity box information",
     *      description="Returns chrity box data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function show(CharityBox $charityBox)
    {
        return new CharityBoxResource($charityBox
            ->load(['collector'])
            ->load(['givenToCollectorUser'])
            ->load(['countingUser'])
        );
    }

    /**
     * @OA\Put(
     *     path="/charityBoxes/{id}",
     *     operationId="updateCharityBox",
     *      tags={"CharityBoxes"},
     *      summary="Update charity box",
     *      description="Returns information about modified charity box",
     *      @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCharityBoxRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @param UpdateCountingCharityBoxRequest $request
     * @param int $id
     * @return CharityBoxResource|JsonResponse
     */
    public function update(UpdateCountingCharityBoxRequest $request, int $id)
    {
        $bo = new BoxOperator((string)$request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($id, $request);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error_message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        // Flash input in case user wants to go back
        $request->flash();

        return new CharityBoxResource($box);
    }


//    //Znajdź puszkę (formularz)
//    public function postFind(Request $request) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->findLatestUncountedByCollectorIdentifier($request->input('collectorIdentifier'));
//        } catch (\Exception $e) {
//            return redirect()->route('box.find')
//                ->with('error', 'Wszystkie puszki wolontariusza są rozliczone.');
//        }
//
//        return view('liczymy.box.found')->with('box', $box);
//    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    //     *      @OA\Parameter(
//     *          name="Authorization",
//     *          in="header",
//     *          description="Enter token in format (Basic base64(username:password))",
//     *          @OA\Schema(type="basic"),
//     *      ),

    /**
     * @OA\Get(
     *      path="/charityBoxes/unverified",
     *      operationId="getUnverifiedList",
     *      tags={"CharityBoxes"},
     *      summary="Get list of unverified charity boxes",
     *      description="Returns list of charity boxes",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBoxResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getUnverifiedList() : JsonResponse
    {
        $boxesToConfirm = CharityBox::with('collector')
            ->unconfirmed()
            ->orderBy('time_counted', 'desc')
            ->get();

        return new JsonResponse($boxesToConfirm);
    }

    /**
     * @OA\Get(
     *      path="/charityBoxes/verified",
     *      operationId="getVerifiedList",
     *      tags={"CharityBoxes"},
     *      summary="Get list of verified charity boxes",
     *      description="Returns list of charity boxes",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBoxResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getVerifiedList(): JsonResponse
    {
        $confirmedBoxes = CharityBox::with('collector')
            ->confirmed()
            ->orderBy('time_confirmed', 'desc')
            ->get();

        return new JsonResponse($confirmedBoxes);
    }

    /**
     * @OA\Post(
     *     path="/charityBoxes/verified/{id}",
     *     operationId="postVerifyCharityBoxById",
     *     tags={"CharityBoxes"},
     *     summary="Verify Charity Box",
     *     description="Return message of operation result",
     *     @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status_code", type="integer", example="200"),
     *              @OA\Property(property="data",type="object")
     *          ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function postVerifyCharityBox(Request $request, int $id): JsonResponse
    {
        $box = CharityBox::where('id', '=', $id)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = $request->user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        $event = new BoxEvent();
        $event->type = 'verified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        return new JsonResponse([
            'message' => sprintf('Puszka nr %s zatwierdzona (%szł)', $box->id, $box->amount_PLN),
            'status' => Response::HTTP_OK
        ]);
    }


    /**
     * @OA\Post(
     *     path="/charityBoxes/unverified/{id}",
     *     operationId="postUnverifyCharityBoxById",
     *     tags={"CharityBoxes"},
     *     summary="Unverify Charity Box",
     *     description="Return message of operation result",
     *     @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(property="message",type="string", example="Puszka nr XX anulowano zatwierdzenie (100zł)")
     *          ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function postUnverifyCharityBox(Request $request, int $id): JsonResponse
    {
        $box = CharityBox::where('id', '=', $id)->first();
        $box->is_confirmed = false;
        $box->user_confirmed_id = null;
        $box->time_confirmed = null;
        $box->save();

        $event = new BoxEvent();
        $event->type = 'unverified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        return new JsonResponse([
            'message' => sprintf('Puszka nr %s anulowano zatwierdzenie (%szł)', $box->id, $box->amount_PLN),
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @OA\Post(
     *     path="/charityBoxes/{id}/startCounting",
     *     operationId="stratCountngCharityBoxById",
     *     tags={"CharityBoxes"},
     *     summary="Start counting Charity Box",
     *     description="Return charity box instance",
     *     @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function startCounting(Request $request, int $id)
    {
        $bo = new BoxOperator((string)$request->user()->id);

        try {
            $box = $bo->startCountByBoxID($id);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error_message' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return new CharityBoxResource($box);
    }

    /**
     * @OA\Post(
     *     path="/charityBoxes/{id}/finishCounting",
     *     operationId="finishCountngCharityBoxById",
     *     tags={"CharityBoxes"},
     *     summary="Finish counting Charity Box (Confirm by volunteer)",
     *     description="Return charity box instance",
     *     @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CharityBox")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @param BoxCharityBoxRequest $request
     * @return JsonResponse
     */
    public function confirm(Request $request, int $id)
    {
        $bo = new BoxOperator((string)$request->user()->id);

        try {
            $box = $bo->confirmBoxByBoxID($id);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error_message' => 'ERROR',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return new CharityBoxResource($box);
    }

    /**
     * @OA\Post(
     *     path="/charityBoxes/{id}/verify",
     *     operationId="verifyCharityBoxByAdmin",
     *     tags={"CharityBoxes"},
     *     summary="Verify Charity Box (Confirm by admin)",
     *     description="Verify Charity Box (Confirm by admin)",
     *     @OA\Parameter(
     *          name="id",
     *          description="Charity box id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(property="message",type="string", example="Puszka nr XX potwierdzona (100zł)")
     *          ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function verify(Request $request, int $id)
    {
        $box = CharityBox::where('id', '=', $id)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = $request->user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        //Drukuj potwierdzenie?
        //TODO
        //Zapisujemy event do bazy

        $event = new BoxEvent();
        $event->type = 'verified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        //BoxConfirmed::dispatch();

        return new JsonResponse([
            'message' => sprintf('Puszka nr %s potwierdzona (%szł)', $box->id, $box->amount_PLN),
            'status' => Response::HTTP_OK
        ]);
    }
}
