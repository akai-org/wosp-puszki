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

Route::group(['middleware' => ['auth:sanctum', 'collectorcoordinator']], function (){
    Route::get('health', function() {
        return response()->json(['hello' => 'world']);
    });

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
