<?php

use App\Http\Controllers\API\CsvDumpController;
use App\Lib\BoxOperator\BoxOperator;
use App\Http\Controllers\Api\AvailabilityApiController;
use App\Http\Controllers\Api\CharityBoxApiController;
use App\Http\Controllers\Api\CollectorApiController;
use App\Http\Controllers\Api\CountedBoxApiController;
use App\Http\Controllers\Api\LogsApiController;
use App\Http\Controllers\Api\RatesApiController;
use App\Http\Controllers\Api\UserApiController;
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

//API
//Zwracamy dane z głównej strony w formie JSON
Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {
    Route::get('users', [UserApiController::class, 'index'])->name('users.list')->middleware('admin');
    Route::get('users/{id}', [UserApiController::class, 'show'])->name('users.show')->middleware('admin');
    Route::post('users', [UserApiController::class, 'create'])->name('users.create')->middleware('admin');

    // TODO add password/{user} with superadmin middleware
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {


    //Not Implemented
    Route::get('charityBoxes/count/collected', [CountedBoxApiController::class, 'collected'])->name('api.box.count.collected');
    Route::get('charityBoxes/count/collected/sum', [CountedBoxApiController::class, 'collectedAmountOfMoney'])->name('api.box.count.collected.sum');
    Route::get('charityBoxes/count/collected/{currency}', [CountedBoxApiController::class, 'collectedAmountOfMoneyByCurrency'])->name('api.box.count.collected.currency');
    Route::get('charityBoxes/count/confirmed/', [CountedBoxApiController::class, 'confirmed'])->name('api.box.count.confirmed.currency');
    Route::get('charityBoxes/count/confirmed/sum', [CountedBoxApiController::class, 'confirmedAmountOfMoney'])->name('api.box.count.confirmed.currency');
    Route::get('charityBoxes/count/confirmed/{currency}', [CountedBoxApiController::class, 'confirmedAmountOfMoneyByCurrency'])->name('api.box.count.confirmed.currency');



    // add nonstandard requests (other than CRUD)
    Route::get('charityBoxes/verified', [CharityBoxApiController::class, 'getVerifiedList'])->name('api.box.verified');;
    Route::get('charityBoxes/unverified', [CharityBoxApiController::class, 'getUnverifiedList'])->name('api.box.unverified');
    Route::post('charityBoxes/verified/{id}', [CharityBoxApiController::class, 'postVerifyCharityBox'])->name('api.box.verify');
    Route::post('charityBoxes/unverified/{id}', [CharityBoxApiController::class, 'postUnverifyCharityBox'])->name('api.box.unverify');
    Route::post('charityBoxes/{id}/startCounting', [CharityBoxApiController::class, 'startCounting'])->name('api.box.count.start');
    Route::post('charityBoxes/{id}/finishCounting', [CharityBoxApiController::class, 'confirm'])->name('api.box.count.finish');

    Route::apiResource('charityBoxes', CharityBoxApiController::class);
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {
    Route::get('logs', [LogsApiController::class, 'index'])->name('api.logs.list')->middleware('admin');
    Route::get('logs/box/{id}', [LogsApiController::class, 'getBox'])->name('api.logs.box')->middleware('admin');
});

Route::get('/stats', ['uses' => 'AmountDisplayController@displayRawJson']);


//Not Implemented
Route::group(['as' => 'api', 'middleware' => ['web', 'auth.basic:,name']], function() {
    Route::apiResource('currency/rates', RatesApiController::class);
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function (){
    //Zbieracze (collector)

    //Lista wolontariuszy (dla administratorów)
    Route::get('collectors', [CollectorApiController::class, 'index'])->name('collector.list')->middleware('collectorcoordinator');
    Route::get('collectors/{id}', [CollectorApiController::class, 'show'])->name('collector.show')->middleware('collectorcoordinator');
    // Formularz dodawania wolontariusza
    Route::post('collectors', [CollectorApiController::class, 'create'])->name('collector.create.post')->middleware('admin');
    // Stworzenie puszki dla wolontariusza
    Route::post('collectors/{collectorIdentifier}/box/create', [CollectorApiController::class, 'createBoxForCollector'])->name('collector.create.box')->middleware(['collectorcoordinator']);
    // Chwycenie ostatniej nierozliczonej puszki wolontariusza
    Route::get('collectors/{collectorIdentifier}/box/latestUncounted', [CollectorApiController::class, 'getCollectorLatUncountedBox'])->name('collector.get.uncountedBox');
});

Route::group(['middleware' => ['auth.basic:,name']], function (){
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
    })->middleware(['collectorcoordinator']);

    Route::get('/collectors/{collectorIdentifier}/boxes/latestUncounted', function(Request $request, string $collectorIdentifier) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->findLatestUncountedByCollectorIdentifier($collectorIdentifier);
        } catch (\Exception $e) {
            return Response::json('', 404);
        }

        return Response::json($box, 200);
    });

    Route::post('/boxes/{boxID}/startCounting', function(Request $request, string $boxID) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->startCountByBoxID($boxID);
        } catch (\Exception $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 400);
        }

        return Response::json($box, 200);
    });

    Route::post('/boxes/{boxID}', function(Request $request, string $boxID) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($boxID, $request);
        } catch (\Exception $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 400);
        }

        return Response::json($box, 200);
    });

    Route::post('/boxes/{boxID}/finishCounting', function(Request $request, string $boxID) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->confirmBoxByBoxID($boxID);
        } catch (\Exception $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], 400);
        }

        return Response::json($box, 200);
    });
    Route::get('charityBoxes/createCsv', [CsvDumpController::class,'getDataForCSV'])->name('api.box.create-csv')->middleware(['collectorcoordinator']);
});



Route::group(['as' => 'api.', 'middleware' => ['web']], function () {
    Route::get('/stations', [AvailabilityApiController::class, 'index']);
    Route::get('/stations/status', [AvailabilityApiController::class, 'getStatusList']);
    Route::post('/stations/{id}/ready', [AvailabilityApiController::class, 'postReady']);
    Route::post('/stations/{id}/busy', [AvailabilityApiController::class, 'postBusy']);
    Route::post('/stations/{id}/unknown', [AvailabilityApiController::class, 'postUnknown']);
});
