<?php

use App\Http\Controllers\API\DataDumpController;
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
    Route::get('health', function(Request $request) {
        $roles = auth()->user()->roles()->get()->map(fn($role) => $role->name);
        return response()->json(['user' => auth()->user()->name, 'roles' => $roles]);
    });
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {
    Route::get('users', [UserApiController::class, 'index'])->name('users.list')->middleware('admin');
    Route::get('users/{id}', [UserApiController::class, 'show'])->name('users.show')->middleware('admin');
    Route::post('users', [UserApiController::class, 'create'])->name('users.create')->middleware('admin');

    // TODO add password/{user} with superadmin middleware
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {

    Route::get('charityBoxes/count/collected', [CountedBoxApiController::class, 'collected'])->name('api.box.count.collected');
    Route::get('charityBoxes/count/collected/sum', [CountedBoxApiController::class, 'collectedAmountOfMoney'])->name('api.box.count.collected.sum');
    Route::get('charityBoxes/count/collected/{currency}', [CountedBoxApiController::class, 'collectedAmountOfMoneyByCurrency'])->name('api.box.count.collected.currency');

    Route::get('charityBoxes/count/confirmed/', [CountedBoxApiController::class, 'confirmed'])->name('api.box.count.confirmed');
    Route::get('charityBoxes/count/confirmed/sum', [CountedBoxApiController::class, 'confirmedAmountOfMoney'])->name('api.box.count.confirmed.sum');
    Route::get('charityBoxes/count/confirmed/{currency}', [CountedBoxApiController::class, 'confirmedAmountOfMoneyByCurrency'])->name('api.box.count.confirmed.currency');

    // Potwierdź puszkę (dla administratora)
    Route::post('charityBoxes/{id}/verify', [CharityBoxApiController::class, 'verify'])->name('api.box.verify1')->middleware('collectorcoordinator');

    // add nonstandard requests (other than CRUD)
    Route::middleware('collectorcoordinator')->group(function () {
        Route::get('charityBoxes/verified', [CharityBoxApiController::class, 'getVerifiedList'])->name('api.box.verified');
        Route::get('charityBoxes/unverified', [CharityBoxApiController::class, 'getUnverifiedList'])->name('api.box.unverified');
        Route::post('charityBoxes/unverified/{id}', [CharityBoxApiController::class, 'postUnverifyCharityBox'])->name('api.box.unverify');
        Route::post('charityBoxes/verified/{id}', [CharityBoxApiController::class, 'postVerifyCharityBox'])->name('api.box.verify');

    });


    Route::post('charityBoxes/{id}/startCounting', [CharityBoxApiController::class, 'startCounting'])->name('api.box.count.start');
    Route::post('charityBoxes/{id}/finishCounting', [CharityBoxApiController::class, 'confirm'])->name('api.box.count.finish');

    Route::get('charityBoxes/csv', [DataDumpController::class,'getCharityBoxesCSV'])->name('box.create-csv')->middleware(['collectorcoordinator']);
    Route::get('charityBoxes/xlsx', [DataDumpController::class,'getCharityBoxesXLSX'])->name('box.create-xlsx')->middleware(['collectorcoordinator']);

    Route::apiResource('charityBoxes', CharityBoxApiController::class);
});

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function () {
    Route::get('logs', [LogsApiController::class, 'index'])->name('logs.list')->middleware('admin');
    Route::get('logs/box/{id}', [LogsApiController::class, 'getBox'])->name('logs.box')->middleware('admin');
});

Route::group(['as' => 'api', 'middleware' => ['web', 'auth.basic:,name']], function() {
    Route::apiResource('currency/rates', RatesApiController::class);
});

//API
//Zwracamy dane z głównej strony w formie JSON
Route::get('/stats', ['uses' => 'AmountDisplayController@displayRawJson']);

Route::group(['as' => 'api.', 'middleware' => ['web', 'auth.basic:,name']], function (){
    //Zbieracze (collector)

    //Lista wolontariuszy (dla administratorów)
    Route::get('collectors', [CollectorApiController::class, 'index'])->name('collector.list')->middleware('collectorcoordinator');
    Route::get('collectors/{id}', [CollectorApiController::class, 'show'])->name('collector.show')->middleware('collectorcoordinator');
    // Formularz dodawania wolontariusza
    Route::post('collectors', [CollectorApiController::class, 'create'])->name('collector.create.post')->middleware('collectorcoordinator');
    // Stworzenie puszki dla wolontariusza
    Route::post('collectors/{collectorIdentifier}/box/create', [CollectorApiController::class, 'createBoxForCollector'])->name('collector.create.box')->middleware(['collectorcoordinator']);
    // Chwycenie ostatniej nierozliczonej puszki wolontariusza
    Route::get('collectors/{collectorIdentifier}/box/latestUncounted', [CollectorApiController::class, 'getCollectorLatUncountedBox'])->name('collector.get.uncountedBox');
});

Route::group(['as' => 'api.', 'middleware' => ['web']], function () {
    Route::get('/stations', [AvailabilityApiController::class, 'index']);
    Route::get('/stations/status', [AvailabilityApiController::class, 'getStatusList']);
    Route::post('/stations/{id}/ready', [AvailabilityApiController::class, 'postReady']);
    Route::post('/stations/{id}/busy', [AvailabilityApiController::class, 'postBusy']);
    Route::post('/stations/{id}/unknown', [AvailabilityApiController::class, 'postUnknown']);
});
