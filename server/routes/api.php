<?php

use App\Http\Controllers\Api\CharityBoxCountApiController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\CharityBoxApiController;
use App\Lib\BoxOperator\BoxOperator;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth.basic:,name']], function (){
    Route::get('health', function() {
        return response()->json(['hello' => 'world']);
    });
});

Route::group(['as' => 'api.', 'middleware' => ['auth:api']], function () {
    //Route::apiResource('charityBoxes', CharityBoxCountApiController::class);
    Route::apiResource('charityBoxes', CharityBoxApiController::class);

    // add nonstandard requests (other than CRUD)
    ROUTE::get('charityBoxes/verified', [CharityBoxApiController::class, 'getVerifiedList'])->name('api.box.verified');;
    ROUTE::get('charityBoxes/unverified', [CharityBoxApiController::class, 'getUnverifiedList'])->name('api.box.unverified');
});
//
////API
////Zwracamy dane z głównej strony w formie JSON
//Route::get('/stats', ['uses' => 'AmountDisplayController@displayRawJson']);
//
//Route::group(['middleware' => ['auth.basic:,name']], function (){
//    Route::post('/collectors/{collectorIdentifier}/boxes', function(Request $request, string $collectorIdentifier) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->giveByCollectorIdentifier($collectorIdentifier);
//        } catch (\Exception $e) {
//            return Response::json([
//                'error' => $e->getMessage()
//            ], 400);
//        }
//
//        return Response::json($box, 200);
//    })->middleware(['collectorcoordinator']);
//
//    Route::get('/collectors/{collectorIdentifier}/boxes/latestUncounted', function(Request $request, string $collectorIdentifier) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->findLatestUncountedByCollectorIdentifier($collectorIdentifier);
//        } catch (\Exception $e) {
//            return Response::json('', 404);
//        }
//
//        return Response::json($box, 200);
//    });
//
//    Route::post('/boxes/{boxID}/startCounting', function(Request $request, string $boxID) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->startCountByBoxID($boxID);
//        } catch (\Exception $e) {
//            return Response::json([
//                'error' => $e->getMessage()
//            ], 400);
//        }
//
//        return Response::json($box, 200);
//    });
//
//    Route::post('/boxes/{boxID}', function(Request $request, string $boxID) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->updateBoxByBoxID($boxID, $request);
//        } catch (\Exception $e) {
//            return Response::json([
//                'error' => $e->getMessage()
//            ], 400);
//        }
//
//        return Response::json($box, 200);
//    });
//
//    Route::post('/boxes/{boxID}/finishCounting', function(Request $request, string $boxID) {
//        $bo = new BoxOperator($request->user()->id);
//
//        try {
//            $box = $bo->confirmBoxByBoxID($boxID);
//        } catch (\Exception $e) {
//            return Response::json([
//                'error' => $e->getMessage()
//            ], 400);
//        }
//
//        return Response::json($box, 200);
//    });
//
//});
//
//
//Route::get('/stations', [AvailabilityController::class, 'getList']);
//Route::post('/stations/{id}/ready', [AvailabilityController::class, 'postReady']);
//Route::post('/stations/{id}/busy', [AvailabilityController::class, 'postBusy']);
//Route::post('/stations/{id}/unknown', [AvailabilityController::class, 'postUnknown']);
