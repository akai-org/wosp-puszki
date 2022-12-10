<?php

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

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('health', function() {
        return response()->json(['hello' => 'world']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'collectorcoordinator']], function (){
    Route::post('/collectors/{collectorIdentifier}/boxes', function(Request $request, string $collectorIdentifier) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->giveByCollectorIdentifier($collectorIdentifier);
        } catch (\Exception $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 400);
        }

        return Response::json($box, 200);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'collectorcoordinator']], function (){
    Route::get('/collectors/{collectorIdentifier}/boxes/latestUncounted', function(Request $request, string $collectorIdentifier) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->findByCollectorIdentifier($collectorIdentifier);
        } catch (\Exception $e) {
            return Response::json('', 404);
        }

        return Response::json($box, 200);
    });
});
