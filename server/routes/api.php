<?php

use App\Http\Controllers\Api\CharityBoxApiController;
use App\Http\Controllers\Api\CollectorApiController;
use App\Http\Controllers\Api\CountedBoxApiController;
use App\Http\Controllers\Api\RatesApiController;
use App\Http\Controllers\AvailabilityController;
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

Route::group(['as' => 'api.', 'middleware' => ['auth.basic:,name']], function () {

    Route::get('charityBoxes/count/collected', [CountedBoxApiController::class, 'collected'])->name('api.box.count.collected');
    Route::get('charityBoxes/count/collected/sum', [CountedBoxApiController::class, 'collectedAmountOfMoney'])->name('api.box.count.collected.sum');
    Route::get('charityBoxes/count/collected/{currency}', [CountedBoxApiController::class, 'collectedAmountOfMoneyByCurrency'])->name('api.box.count.collected.currency');

    Route::get('charityBoxes/count/confirmed/', [CountedBoxApiController::class, 'confirmed'])->name('api.box.count.confirmed.currency');
    Route::get('charityBoxes/count/confirmed/sum', [CountedBoxApiController::class, 'confirmedAmountOfMoney'])->name('api.box.count.confirmed.currency');
    Route::get('charityBoxes/count/confirmed/{currency}', [CountedBoxApiController::class, 'confirmedAmountOfMoneyByCurrency'])->name('api.box.count.confirmed.currency');



    // add nonstandard requests (other than CRUD)
    Route::get('charityBoxes/verified', [CharityBoxApiController::class, 'getVerifiedList'])->name('api.box.verified');;
    Route::get('charityBoxes/unverified', [CharityBoxApiController::class, 'getUnverifiedList'])->name('api.box.unverified');
    Route::post('charityBoxes/unverified/{id}', [CharityBoxApiController::class, 'postUnverifyCharityBox'])->name('api.box.unverify');
    Route::post('charityBoxes/{id}/startCounting', [CharityBoxApiController::class, 'startCounting'])->name('api.box.count.start');
    Route::post('charityBoxes/{id}/finishCounting', [CharityBoxApiController::class, 'confirm'])->name('api.box.count.finish');

    Route::apiResource('charityBoxes', CharityBoxApiController::class);
});

Route::group(['as' => 'api', 'middleware' => ['auth.basic:,name']], function() {
    Route::apiResource('currency/rates', RatesApiController::class);
});

//API
//Zwracamy dane z głównej strony w formie JSON
Route::get('/stats', ['uses' => 'AmountDisplayController@displayRawJson']);

Route::group(['as' => 'api.', 'middleware' => ['auth.basic:,name']], function (){
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


Route::get('/stations', [AvailabilityController::class, 'getList']);
Route::post('/stations/{id}/ready', [AvailabilityController::class, 'postReady']);
Route::post('/stations/{id}/busy', [AvailabilityController::class, 'postBusy']);
Route::post('/stations/{id}/unknown', [AvailabilityController::class, 'postUnknown']);
