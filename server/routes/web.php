<?php

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

use App\Http\Controllers\AllegroController;
use App\Http\Controllers\AmountDisplayController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CharityBoxApiController;
use App\Http\Controllers\CharityBoxController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

// Amounts and currencies
Route::get('/raw', [AmountDisplayController::class, 'getTotalRawWithForeign'])->name('display.raw');
Route::get('/raw/pln', ['as' => 'display.raw.pln', 'uses' => 'AmountDisplayController@getTotalRawPln']);
Route::get('/raw/all', ['as' => 'display.raw.all', 'uses' => 'AmountDisplayController@getTotalRawWithForeign']);
Route::get('/allegro', [AllegroController::class, 'setAuthToken']);
Route::get('/allegro/init', [AllegroController::class, 'initAllegro']);

// Log in
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Main view
Route::get('/', [MainController::class, 'index'])->name('main');

Route::middleware('admin')->group(function () {
    // Downloading NBP current rates (to paste in .env file)
    Route::get('rates', [AmountDisplayController::class, 'getRates'])->middleware('admin')->name('rates');

    // User management
    Route::prefix('user')->group(function () {
        Route::get('create', [UserController::class, 'getCreate'])->name('user.create');
        Route::post('create', [UserController::class, 'postCreate'])->name('user.create.post');
        Route::get('list', [UserController::class, 'getList'])->name('user.list');

        Route::middleware('superadmin')->group(function () {
            Route::get('password/{user}', [UserController::class, 'getPassword'])->name('user.password');
            Route::post('password/{user}', [UserController::class, 'postPassword'])->name('user.password.post');
        });
    });
});

// Collectors
Route::prefix('collector')->group(function () {
    Route::middleware('collectorcoordinator')->group(function () {
        Route::get('create', [CollectorController::class, 'getCreate'])->name('collector.create');
        Route::post('create', [CollectorController::class, 'postCreate'])->name('collector.create.post');
    });
    Route::get('list', [CollectorController::class, 'getList'])->name('collector.list')->middleware('collectorcoordinator');
});

// Boxes
Route::prefix('box')->group(function () {
    Route::middleware('collectorcoordinator')->group(function () {
        Route::get('create', [CharityBoxController::class, 'getCreate'])->name('box.create');
        Route::post('create', [CharityBoxController::class, 'postCreate'])->name('box.create.post');
    });

    Route::get('find', [CharityBoxController::class, 'getFind'])->name('box.find');
    Route::post('find', [CharityBoxController::class, 'postFind'])->name('box.find.post');

    Route::post('findConfirm', function () {
        return redirect()->route('box.count', ['boxID' => request()->input('boxID')]);
    })->name('box.findConfirm')->middleware('auth');

    Route::get('count/{boxID}', [CharityBoxController::class, 'getCount'])->name('box.count');
    Route::post('count/{boxID}', [CharityBoxController::class, 'postCount'])->name('box.count.post');

    Route::post('count/{boxID}/confirm', [CharityBoxController::class, 'confirm'])->name('box.count.confirm');

    Route::middleware('collectorcoordinator')->group(function () {
        Route::get('list/away', [CharityBoxController::class, 'getListAway'])->name('box.list.away');
        Route::get('list', [CharityBoxController::class, 'getList'])->name('box.list');
    });

    Route::middleware('admin')->group(function () {
        Route::get('verify/list', [CharityBoxController::class, 'getVerifyList'])->name('box.verify.list');
        Route::post('verify', [CharityBoxController::class, 'postVerify'])->name('box.verify.post');

        Route::get('display/{boxID}', [CharityBoxController::class, 'getDisplay'])->name('box.display');

        Route::get('modify/{boxID}', [CharityBoxController::class, 'getModify'])->name('box.modify');
        Route::post('modify/{boxID}', [CharityBoxController::class, 'postModify'])->name('box.modify.post');

    });
});

// Logs
Route::prefix('logs')->middleware('admin')->group(function () {
    Route::get('all', [LogsController::class, 'getAll'])->name('logs.all');
    Route::get('box/{boxID}', [LogsController::class, 'getBox'])->name('logs.box');
});

// API
Route::get('api', ['uses' => 'AmountDisplayController@displayApi']);
Route::prefix('api')->middleware('admin')->group(function () {
    Route::prefix('box')->group(function () {
        Route::get('verify/list', [CharityBoxApiController::class, 'getVerifyList'])->name('api.box.verify.list');
        Route::get('verified', [CharityBoxApiController::class, 'getVerifiedBoxes'])->name('api.box.verified');
        Route::post('unverify', [CharityBoxApiController::class, 'postUnVerify'])->name('api.box.unverify');
    });
});
