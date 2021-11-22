<?php

use App\Websockets\QueueSystemWebsocketsHandler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmountDisplayController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CharityBoxApiController;
use App\Http\Controllers\CharityBoxController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\LogsApiController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// TODO Dodać log wszystkich akcji użytkowników, jakby się coś spierdoliło
// TODO Strona główna, wyświetla tylko liczbę hajsu
//Route::get('/', ['uses' => 'AmountDisplayController@display']);
Route::get('/', [AmountDisplayController::class, 'display']);

//API
Route::prefix('api')->group(function() {
    Route::get('/', [AmountDisplayController::class, 'displayApi']);
    Route::get('/stats', [AmountDisplayController::class, 'displayRawJson']);
});

Route::prefix('outside')->group(function() {
    Route::get('/', [AmountDisplayController::class, 'displayFromStoredJsonGreen']);
    Route::get('/green', [AmountDisplayController::class, 'displayFromStoredJsonGreen']);
    Route::get('/normal', [AmountDisplayController::class, 'displayFromStoredJson']);
});

Route::prefix('raw')->group(function() {
    Route::get('/', [AmountDisplayController::class, 'getTotalRawWithForeign'])->name('display.raw');
    Route::get('/pln', [AmountDisplayController::class, 'getTotalRawPln']);
    Route::get('/all', [AmountDisplayController::class, 'getTotalRawWithForeign']);
});

Route::prefix('liczymy')->group(function () {

    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('main');

        Route::middleware('admin')->group(function(){
            //Pobieranie kursu z NBP (Do wklejenia w .env)
            Route::get('rates', [AmountDisplayController::class, 'getRates'])->middleware('admin')->name('rates');

            Route::prefix('user')->group(function () {
                Route::get('create', [UserController::class, 'getCreate'])->name('user.create');
                Route::post('create', [UserController::class, 'postCreate'])->name('user.create.post');

                Route::get('list', [UserController::class, 'getList'])->name('user.list');

                Route::middleware('superadmin')->group(function(){
                    Route::get('password/{user}', [UserController::class, 'getPassword'])->name('user.password');
                    Route::post('password/{user}', [UserController::class, 'postPassword'])->name('user.password.post');
                });
            });

            Route::prefix('logs')->group(function (){
                Route::get('all', [LogsController::class, 'getAll'])->name('logs.all');
                Route::get('box/{boxID}', [LogsController::class, 'getBox'])->name('logs.box');
            });
        });

        Route::prefix('collector')->group(function (){
            Route::middleware('admin')->group(function(){
                Route::get('create', [CollectorController::class, 'getCreate'])->name('collector.create');
                Route::post('create', [CollectorController::class, 'postCreate'])->name('collector.create.post');
            });
            Route::get('list', [CollectorController::class, 'getList'])->name('collector.list')->middleware('collectorcoordinator');
        });

        Route::prefix('box')->group(function (){
            Route::middleware('collectorcoordinator')->group(function(){
                Route::get('create', [CharityBoxController::class, 'getCreate'])->name('box.create');
                Route::post('create', [CharityBoxController::class, 'postCreate'])->name('box.create.post');
            });

            Route::get('find', [CharityBoxController::class, 'getFind'])->name('box.find');
            Route::post('find', [CharityBoxController::class, 'postFind'])->name('box.find.post');

            Route::post('findConfirm', function (){
                return redirect()->route('box.count', ['boxID' => request()->input('boxID')]);
            })->name('box.findConfirm')->middleware('auth');

            Route::prefix('count')->group(function () {
                Route::get('{boxID}', [CharityBoxController::class, 'getCount'])->name('box.count');
                Route::post('{boxID}', [CharityBoxController::class, 'postCount'])->name('box.count.post');
                Route::post('{boxID}/confirm', [CharityBoxController::class, 'confirm'])->name('box.count.confirm');
            });

            Route::prefix('list')->middleware('collectorcoordinator')->group(function() {
                Route::get('/', [CharityBoxController::class, 'getList'])->name('box.list');
                Route::get('away', [CharityBoxController::class, 'getListAway'])->name('box.list.away');
            });

            Route::middleware('admin')->group(function(){
                Route::get('verify/list', [CharityBoxController::class, 'getVerifyList'])->name('box.verify.list')->middleware('admin');
                //Preview
                //Route::get('verify/{boxNumber}', ['as' => 'box.verify', 'uses' => 'CharityBoxController@getVerify'])->middleware('admin');
                Route::post('verify', [CharityBoxController::class, 'postVerify'])->name('box.verify.post');
                Route::get('display/{boxID}', [CharityBoxController::class, 'getDisplay'])->name('box.display');
                Route::get('modify/{boxID}', [CharityBoxController::class, 'getModify'])->name('box.modify');
                Route::post('modify/{boxID}', [CharityBoxController::class, 'postModify'])->name('box.modify.post');
            });
        });
    });

    //API
    Route::prefix('api')->middleware('admin')->group(function (){
        Route::prefix('box')->group(function (){
            Route::get('verify/list', [CharityBoxApiController::class, 'getVerifyList'])->name('api.box.verify.list');
            Route::get('verified', [CharityBoxApiController::class, 'getVerifiedBoxes'])->name('api.box.verified');
            Route::post('unverify', [CharityBoxApiController::class, 'postUnVerify'])->name('api.box.unverify');
        });
        Route::prefix('logs')->group(function (){
            Route::get('all', [LogsApiController::class, 'getAll'])->name('api.logs.all');
            Route::get('box/{boxID}', [LogsApiController::class, 'getBox'])->name('api.logs.box');
        });
    });
});

//Websockets
WebSocketsRouter::webSocket('/ws/queue', QueueSystemWebsocketsHandler::class);

