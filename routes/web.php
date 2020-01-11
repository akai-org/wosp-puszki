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


//TODO
//Dodać log wszystkich akcji użytkowników, jakby się coś spierdoliło

//Strona główna, wyświetla tylko liczbę hajsu
//TODO
Route::get('/', ['uses' => 'AmountDisplayController@display']);
Route::get('api', ['uses' => 'AmountDisplayController@displayApi']);

//Strona główna, wyświetla tylko liczbę hajsu (Sama cyfra, bez bajerów)
Route::get('/raw', ['as' => 'display.raw','uses' => 'AmountDisplayController@getTotalRawWithForeign']);
Route::get('/raw/pln', ['as' => 'display.raw.pln', 'uses' => 'AmountDisplayController@getTotalRawPln']);
Route::get('/raw/all', ['as' => 'display.raw.all', 'uses' => 'AmountDisplayController@getTotalRawWithForeign']);


//API
//Zwracamy dane z głównej strony w formie JSON
Route::get('/api/stats', ['uses' => 'AmountDisplayController@displayRawJson']);


//Interfejsy admina i superadmina, pod adresem /liczymy
Route::prefix('liczymy')->group(function () {

    //Logowanie

    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    //Panel główny
    Route::get('/', ['as' => 'main', 'uses' => 'MainController@index']);

    //Pobieranie kursu z NBP (Do wklejenia w .env)
    Route::get('rates', ['as' => 'rates', 'uses' => 'AmountDisplayController@getRates'])->middleware('admin');


    //Dodawanie użytkowników (dla adminów i superadminów)
    //Edycja użytkowników(dla adminów i superadminów)
    //Zmiana hasła(dla adminów i superadminów)
    Route::prefix('user')->middleware('admin')->group(function () {
       Route::get('create', ['as' => 'user.create', 'uses' => 'UserController@getCreate']);
       Route::post('create', ['as' => 'user.create.post', 'uses' => 'UserController@postCreate']);

       Route::get('password/{user}', ['as' => 'user.password', 'uses' => 'UserController@getPassword'])->middleware('superadmin');
       Route::post('password/{user}', ['as' => 'user.password.post', 'uses' => 'UserController@postPassword'])->middleware('superadmin');

       Route::get('list', ['as' => 'user.list', 'uses' => 'UserController@getList']);
    });

    //Zbieracze (collector)
    //Dla administratorów
    Route::prefix('collector')->group(function (){
        //Dodawanie wolontariusza
        //Formularz
        Route::get('create', ['as' => 'collector.create', 'uses' => 'CollectorController@getCreate'])->middleware('admin');
        //Dodawanie do bazy
        Route::post('create', ['as' => 'collector.create.post', 'uses' => 'CollectorController@postCreate'])->middleware('admin');

        //Lista wolontariuszy (dla administratorów)
        Route::get('list', ['as' => 'collector.list', 'uses' => 'CollectorController@getList'])->middleware('collectorcoordinator');

    });
    //Puszki
    Route::prefix('box')->group(function (){


        //Dodawanie puszki
        //Formularz
        Route::get('create', ['as' => 'box.create', 'uses' => 'CharityBoxController@getCreate'])->middleware('collectorcoordinator');
        //Dodanie do bazy
        Route::post('create', ['as' => 'box.create.post', 'uses' => 'CharityBoxController@postCreate'])->middleware('collectorcoordinator');


        //Przeliczenie puszki
        //Znajdź puszkę
        Route::get('find', ['as' => 'box.find', 'uses' => 'CharityBoxController@getFind']);
        //Sprawdź z identyfikatorem
        Route::post('find', ['as' => 'box.find.post', 'uses' => 'CharityBoxController@postFind']);
        //Potwierdź
        Route::post('findConfirm', function (\Illuminate\Http\Request $request){
            //SilentAlarm
            //Sprawdzamy czy checkbox jest wciśnięty
            if($request->has('silentalarm')) {
                //Zapisujemy do logów

                $event = new \App\BoxEvent();
                $event->type = 'alarm';
                $event->box_id = request()->input('boxID');
                $event->user_id = $request->user()->id;
                $event->comment = '';
                $event->save();
                //Jeżeli tak, generujemy alarm
                //TODO powiadomić kogoś
                //I 404 żeby nie wzbudzać podejrzeń
                return abort(500);
            } else {
                //Jeżeli nie ma alarmu to przechodzimy do rozliczenia
                return redirect()->route('box.count', ['boxID' => request()->input('boxID')]);
            }
        })->name('box.findConfirm')->middleware('auth');
        //Przelicz pieniądze i wprowadź
        Route::get('count/{boxID}', ['as' => 'box.count', 'uses' => 'CharityBoxController@getCount']);

        //Wyślij (tutaj przedstawiamy do sprawdzenia)
        Route::post('count/{boxID}', ['as' => 'box.count.post', 'uses' => 'CharityBoxController@postCount']);
        //Potwierdź (wyślij puszkę do Admina)
        Route::post('count/{boxID}/confirm', ['as' => 'box.count.confirm', 'uses' => 'CharityBoxController@confirm']);

        //Zatwierdzenie puszki (przez administratora)
        //Lista puszek do zatwierdzenia
        Route::get('verify/list', ['as' => 'box.verify.list', 'uses' => 'CharityBoxController@getVerifyList'])->middleware('admin');

        //Lista nierozliczonych puszek
        //getListAway
        Route::get('list/away', ['as' => 'box.list.away', 'uses' => 'CharityBoxController@getListAway'])->middleware('collectorcoordinator');

        //Zatwierdzenie puszki
        //Podgląd
        //Route::get('verify/{boxNumber}', ['as' => 'box.verify', 'uses' => 'CharityBoxController@getVerify'])->middleware('admin');
        //POST
        Route::post('verify', ['as' => 'box.verify.post', 'uses' => 'CharityBoxController@postVerify'])->middleware('admin');

        //Lista puszek dla administratora
        Route::get('list', ['as' => 'box.list', 'uses' => 'CharityBoxController@getList'])->middleware('admin');

        //Wyświetl pojedynczą puszkę dla administratora
        Route::get('display/{boxID}', ['as' => 'box.display', 'uses' => 'CharityBoxController@getDisplay'])->middleware('admin');

        //Modyikuj puszkę (dla administratora)
        Route::get('modify/{boxID}', ['as' => 'box.modify', 'uses' => 'CharityBoxController@getModify'])->middleware('admin');
        //Modyikuj puszkę (dla administratora)
        Route::post('modify/{boxID}', ['as' => 'box.modify.post', 'uses' => 'CharityBoxController@postModify'])->middleware('admin');

        //Drukowanie
        //TODO




    });

    //Logi
    Route::prefix('logs')->group(function (){
        Route::get('all', ['as' => 'logs.all', 'uses' => 'LogsController@getAll']);

        Route::get('box/{boxID}', ['as' => 'logs.box', 'uses' => 'LogsController@getBox']);

    });

    //API
    Route::prefix('api')->group(function (){
        Route::prefix('box')->group(function (){
            //Lista puszek do potwierdzenia
            Route::get('verify/list', ['as' => 'api.box.verify.list', 'uses' => 'CharityBoxApiController@getVerifyList'])->middleware('admin');

            //Lista puszek zatwierdzonych
            Route::get('verified', ['as' => 'api.box.verified', 'uses' => 'CharityBoxApiController@getVerifiedBoxes'])->middleware('admin');

            //Anulowanie zatwierdzenia puszek
            Route::post('unverify', ['as' => 'api.box.unverify', 'uses' => 'CharityBoxApiController@postUnVerify'])->middleware('admin');

        });

        Route::prefix('logs')->group(function (){
            Route::get('all', ['as' => 'api.logs.all', 'uses' => 'LogsApiController@getAll']);
            Route::get('box/{boxID}', ['as' => 'api.logs.box', 'uses' => 'LogsApiController@getBox']);
        });
    });


    //Podgląd puszek na żywo
    //TODO
    //Stream eventów


    //Testowe
    Route::prefix('test')->group(function() {
        Route::get('admin', function (){
            echo 'Admin';
        })->middleware('auth', 'admin');
        Route::get('superadmin', function (){
            echo 'SuperAdmin';
        })->middleware('auth', 'superadmin');
    });

});

