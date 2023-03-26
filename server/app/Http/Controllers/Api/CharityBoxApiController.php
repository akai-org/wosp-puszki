<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\CharityBox;
use App\Virtual\Resources\CharityBoxResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="CharityBoxes",
 *     description="API Endpoints of Charity Boxes"
 * )
 **/
final class CharityBoxApiController extends ApiController
{
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('admin');

        $this->__construct(CharityBox::class);
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.

    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function update(Request $request, int $id)
    {
        // TODO: Implement update() method.
    }

    public function create(Request $request, int $id)
    {
        // TODO: Implement create() method.
    }

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
     *     )
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
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Enter token in format (Basic base64(username:password))",
     *          @OA\Schema(type="basic"),
     *      ),
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
     *     )
     */
    public function getVerifiedList(): JsonResponse
    {
        $confirmedBoxes = CharityBox::with('collector')
            ->confirmed()
            ->orderBy('time_confirmed', 'desc')
            ->get();

        return new JsonResponse($confirmedBoxes);
    }
}
