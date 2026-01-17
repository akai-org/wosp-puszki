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
use App\Http\Controllers\HelpController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

Route::get('/', ['uses' => 'AmountDisplayController@display']);
Route::get('/outside', ['uses' => 'AmountDisplayController@displayFromStoredJsonGreen']);
Route::get('/outside/green', ['uses' => 'AmountDisplayController@displayFromStoredJsonGreen']);
Route::get('/outside/normal', ['uses' => 'AmountDisplayController@displayFromStoredJson']);
Route::get('api', ['uses' => 'AmountDisplayController@displayApi']);

Route::get('/raw', [AmountDisplayController::class, 'getTotalRawWithForeign'])->name('display.raw');
Route::get('/raw/pln', ['as' => 'display.raw.pln', 'uses' => 'AmountDisplayController@getTotalRawPln']);
Route::get('/raw/all', ['as' => 'display.raw.all', 'uses' => 'AmountDisplayController@getTotalRawWithForeign']);
Route::get('/allegro', [AllegroController::class, 'setAuthToken']);

Route::prefix('liczymy')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('/request-help', [HelpController::class, 'store']);
    Route::middleware(['auth', 'collectorcoordinator'])->group(function () {
        Route::post('/resolve-help', [HelpController::class, 'resolve']);
    });

    //Panel główny
    Route::get('/', [MainController::class, 'index'])->name('main');

    Route::middleware('admin')->group(function () {
        //Pobieranie kursu z NBP (Do wklejenia w .env)
        Route::get('rates', [AmountDisplayController::class, 'getRates'])->middleware('admin')->name('rates');

        //Dodawanie użytkowników (dla adminów i superadminów)
        //Edycja użytkowników(dla adminów i superadminów)
        //Zmiana hasła(dla adminów i superadminów)
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

    //Zbieracze (collector)
    //Dla administratorów
    Route::prefix('collector')->group(function () {
        //Dodawanie wolontariusza
        //Formularz
        Route::middleware('collectorcoordinator')->group(function () {
            Route::get('create', [CollectorController::class, 'getCreate'])->name('collector.create');
            //Dodawanie do bazy
            Route::post('create', [CollectorController::class, 'postCreate'])->name('collector.create.post');
        });


        //Lista wolontariuszy (dla administratorów)
        Route::get('list', [CollectorController::class, 'getList'])->name('collector.list')->middleware('collectorcoordinator');

    });
    //Puszki
    Route::prefix('box')->group(function () {

        //Dodawanie puszki
        //Formularz
        Route::middleware('collectorcoordinator')->group(function () {
            Route::get('create', [CharityBoxController::class, 'getCreate'])->name('box.create');

            //Dodanie do bazy
            Route::post('create', [CharityBoxController::class, 'postCreate'])->name('box.create.post');

        });


        //Przeliczenie puszki
        //Znajdź puszkę
        Route::get('find', [CharityBoxController::class, 'getFind'])->name('box.find');
        //Sprawdź z identyfikatorem
        Route::post('find', [CharityBoxController::class, 'postFind'])->name('box.find.post');
        //Potwierdź

        //TODO przerobić
        Route::post('findConfirm', function (\Illuminate\Http\Request $request) {
            return redirect()->route('box.count', ['boxID' => request()->input('boxID')]);

        })->name('box.findConfirm')->middleware('auth');

        //Przelicz pieniądze i wprowadź
        Route::get('count/{boxID}', [CharityBoxController::class, 'getCount'])->name('box.count');

        //Wyślij (tutaj przedstawiamy do sprawdzenia)
        Route::post('count/{boxID}', [CharityBoxController::class, 'postCount'])->name('box.count.post');
        //Potwierdź (wyślij puszkę do Admina)
        Route::post('count/{boxID}/confirm', [CharityBoxController::class, 'confirm'])->name('box.count.confirm');


        //Lista nierozliczonych puszek
        //getListAway
        Route::get('list/away', [CharityBoxController::class, 'getListAway'])->name('box.list.away')->middleware('collectorcoordinator');


        //Lista puszek dla administratora
        Route::get('list', [CharityBoxController::class, 'getList'])->name('box.list')->middleware('collectorcoordinator');

        Route::middleware('admin')->group(function () {

            //Zatwierdzenie puszki (przez administratora)
            //Lista puszek do zatwierdzenia
            Route::get('verify/list', [CharityBoxController::class, 'getVerifyList'])->name('box.verify.list')->middleware('admin');
            //Zatwierdzenie puszki
            //Podgląd
            //Route::get('verify/{boxNumber}', ['as' => 'box.verify', 'uses' => 'CharityBoxController@getVerify'])->middleware('admin');
            //POST
            Route::post('verify', [CharityBoxController::class, 'postVerify'])->name('box.verify.post');

            //Wyświetl pojedynczą puszkę dla administratora
            Route::get('display/{boxID}', [CharityBoxController::class, 'getDisplay'])->name('box.display');
            //Modyikuj puszkę (dla administratora)
            Route::get('modify/{boxID}', [CharityBoxController::class, 'getModify'])->name('box.modify');

            //Modyikuj puszkę (dla administratora)
            Route::post('modify/{boxID}', [CharityBoxController::class, 'postModify'])->name('box.modify.post');

        });
    });

    Route::prefix('logs')->middleware('admin')->group(function () {
        Route::get('all', [LogsController::class, 'getAll'])->name('logs.all');

        Route::get('box/{boxID}', [LogsController::class, 'getBox'])->name('logs.box');
    });

    Route::prefix('api')->middleware('admin')->group(function () {
        Route::prefix('box')->group(function () {
            Route::get('verify/list', [CharityBoxApiController::class, 'getVerifyList'])->name('api.box.verify.list');
            Route::get('verified', [CharityBoxApiController::class, 'getVerifiedBoxes'])->name('api.box.verified');
            Route::post('unverify', [CharityBoxApiController::class, 'postUnVerify'])->name('api.box.unverify');

        });
    });
});
