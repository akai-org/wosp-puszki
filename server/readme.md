# wosp-puszki

## Setup

### no-docker

#### wymagania
- PHP >= 8.0
- Baza MySQL lub kompatybilna (Może też Postgres, ale nie testowane)

#### instalacja

```
//kopiujemy plik .env.example do .env
//uzupełniamy danymi plik .env, według komentarzy

//instalujemy zależności

composer install

// Instalacja drivera do przeglądarki
vendor/bin/bdi detect drivers

//generujemy nowy klucz, jeżeli to świeża instalacja

php artisan key:generate

//Tworzymy strukturę bazy
//Czysta baza
php artisan migrate

//Baza testowa (z wolo, adminem i superadminem)
php artisan migrate --seed

//Permissiony do storage
sudo chmod -R 755 storage/


Usupełniamy kursy walut w pliku .env, odwiedzając
http://localhost:8000/liczymy/rates i wklejając poniżej
UWAGA, jeżeli nie są ustawione kursy, to STATIC_RATES musi być false
```

### docker

#### wymagania
- docker-compose

#### instalacja
- uruchomić aplikację poleceniem:
```bash
docker compose up 
```
- jeżeli to pierwsze uruchomienie na maszynie, można uruchomić skrypt `script/first_launch.sh`
lub ręcznie wykonać wybrane komendy z tego skryptu


## Testy
Testy wymagają zainstalowania zgodnie z powyższą instrukcją.

`php artisan test`
lub dla dockera `./script/run_tests.sh`

Nowe testy dodajemy w folderze `tests/`.

## Dev guidelines

Hard:

Soft:
- Używamy [gitmoji](https://gitmoji.dev/)

### Wyłączanie autofill formularza w chrome
```
How to Disable and Clear AutoFill Info in your Browser
In this article, we will tell you how to disable the autofill options in some of the most popular web browsers to prevent this information from being unintentionally saved or used in your browser.

Google Chrome Instructions
In Google Chrome, you will want to not only turn off autofill data, but also clear it. Instructions are listed below.

Turning Off Autofill in Chrome

Click the Chrome menu icon. (Three lines at top right of screen.)
Click on Settings.
At the bottom of the page, click “Show advanced Settings”
In the Passwords and Forms section, uncheck “Enable Autofill to fill out web forms in a single click”
Clearing Autofill Data in Chrome

Click the Chrome menu icon. (Three lines at top right of screen.)
Click on Tools.
Select Clear browsing data.
At the top, choose “the beginning of time” option to clear all saved data.
Make sure that the “Clear saved Autofill form data” option is checked.
Click Clear browsing data.
```
src: https://support.iclasspro.com/hc/en-us/articles/218569268-How-to-Disable-and-Clear-AutoFill-Info-in-your-Browser


### Wydarzenia zapisywane do bazy (BoxEvent)

| Nazwa eventu    | Opis eventu                                           |
|-----------------|-------------------------------------------------------|
| give            | wydanie puszki wolontariuszowi                        |
| found           | znalezienie puszki                                    |
| startedCounting | rozpoczął rozliczenie puszki                          |
| endedCounting   | zakończył liczenie (nie potwierdził jeszcze)          |
| confirmed       | puszka została przeliczona i wysłana do potwierdzenia |
| verified        | administrator zatwierdził                             |
| modified        | administrator zmodyfikował                            |
| unverified      | administrator od-zatwierdził                          |


#### Przykładowy kod dodawania eventu
```
//Zapisujemy event do bazy

$event = new BoxEvent();
$event->type = 'give';
$event->box_id = $box->id;
$event->user_id = $request->user()->id;
$event->comment = 'Collector: ' . $collector->display;
$event->save();
```

### Websockets

Websockets were previously used to display station availability, but they were replaced with a RESTish API.

Sample routes:
(See AvailabilityController for response description and data format)
```
Route::get('/stations', [AvailabilityController::class, 'getList']);
Route::post('/stations/{id}/ready', [AvailabilityController::class, 'postReady']);
Route::post('/stations/{id}/busy', [AvailabilityController::class, 'postBusy']);
Route::post('/stations/{id}/unknown', [AvailabilityController::class, 'postUnknown']);
```


### Import wolontariuszy

Należy pobrać plik `wolontariusze.csv` z systemu fundacji,
a następnie zaimpoerować komendą `php artisan import:collectors`

### Pobieranie stanu eSkarbonki

Identyfikator eSkarbonki, której stan należy pobierać jest zapisany w pliku .env
(klucz MONEYBOX_ID). Indentyfikator można określić na podstawie adresu URL skarbonki.
Na przykład dla `https://eskarbonka.wosp.org.pl/he9yxj` identyfikatorem jest `he9yxj`.

Aby okresowe pobieranie działało, należy stworzyć zadanie cron:
```
* * * * * cd /wosp-puszki && php artisan schedule:run >> /dev/null 2>&1
```
(więcej informacji: https://laravel.com/docs/9.x/scheduling#running-the-scheduler)


### API

API umożliwia wydanie i rozliczenie puszki. Pozostałe funkcjonalności są w trakcie tworzenia.

#### Wydanie puszki
Na początku finału wolontariusz zgłasza się do sztabu, gdzie jest mu wydawana puszka z identyfikatorem.

Wydanie puszki polega na wpisaniu numeru wolontariusza i kliknięciu "Wydaj puszkę".

UWAGA: `id` puszki jesy używane tylko wewnętrznie, do wyświetlania używamy `identifier` wolontariusza.

Operacja API: `POST  /api/collectors/{collectorIdentifier}/boxes`

Przykładowa zwrotka:
```json
{
    "id": 1,
    "collectorIdentifier": "774",
    "collector_id": 182,
    "is_given_to_collector": true,
    "given_to_collector_user_id": 1,
    "time_given": "2022-02-25 19:55:29",
    "is_counted": 0,
    "counting_user_id": null,
    "time_counted": null,
    "is_confirmed": 0,
    "user_confirmed_id": null,
    "time_confirmed": null,
    "count_1gr": 0,
    "count_2gr": 0,
    "count_5gr": 0,
    "count_10gr": 0,
    "count_20gr": 0,
    "count_50gr": 0,
    "count_1zl": 0,
    "count_2zl": 0,
    "count_5zl": 0,
    "count_10zl": 0,
    "count_20zl": 0,
    "count_50zl": 0,
    "count_100zl": 0,
    "count_200zl": 0,
    "count_500zl": 0,
    "amount_PLN": "0.00",
    "amount_EUR": "0.00",
    "amount_USD": "0.00",
    "amount_GBP": "0.00",
    "comment": "",
    "created_at": "2022-02-25T18:59:07.000000Z",
    "updated_at": "2022-02-25T18:59:07.000000Z",
    "is_special_box": 0,
    "collector": {
        "id": 182,
        "identifier": "774",
        "firstName": "Błażej",
        "lastName": "Górecka",
        "created_at": "2022-02-25T18:59:06.000000Z",
        "updated_at": "2022-02-25T18:59:06.000000Z"
    }
}
```

Możliwe błędy: `TODO`

Puszka może być wydana wielokrotnie w ciągu dnia (np. wolontariusz ją zapełnił, ale idzie dalej zbierać),
albo wielokrotnie na początku dnia, np. zbiórka stacjonarna skłąda się z 10 puszek, więc operacja wydawania jest
wykonywana 10 razy.

#### Rozliczenie puszki po zbieraniu

Po powrocie z kwesty wolontariusz siada do stanowiska rozliczeniowego.
Po kolei:
1. Puszka jest znajdowana w systemie poprzez identyfikator wolontariusza - `api/collectors/{collectorIdentifier}/boxes/latestUncounted`
2. Potwierdzane są dane i sygnalizowane jest rozpoczęcie liczenia - `/boxes/{boxID}/startCounting`
3. Wysyłane są dane dot. zawartości puszki - `TODO endpoint`
4. Pokazywany jest ekran potwierdzenia, i po zatwierdzeniu wysyłane kolejne potwierdzenie - `TODO endpoint`
5. Wolontariusz udaje się do koordynatora rozliczenia.
6. Ten wypisuje dokumenty i ostatecznie satwierdza puszkę w systemie - `TODO endpoint`

##### Puszka jest znajdowana w systemie poprzez identyfikator wolontariusza
Endpoint: `api/collectors/{collectorIdentifier}/boxes/latestUncounted`

Przykładowa zwrotka:
```json
{
    "id": 1,
    "collectorIdentifier": "774",
    "collector_id": 182,
    "is_given_to_collector": true,
    "given_to_collector_user_id": 1,
    "time_given": "2022-02-25 19:55:29",
    "is_counted": 0,
    "counting_user_id": null,
    "time_counted": null,
    "is_confirmed": 0,
    "user_confirmed_id": null,
    "time_confirmed": null,
    "count_1gr": 0,
    "count_2gr": 0,
    "count_5gr": 0,
    "count_10gr": 0,
    "count_20gr": 0,
    "count_50gr": 0,
    "count_1zl": 0,
    "count_2zl": 0,
    "count_5zl": 0,
    "count_10zl": 0,
    "count_20zl": 0,
    "count_50zl": 0,
    "count_100zl": 0,
    "count_200zl": 0,
    "count_500zl": 0,
    "amount_PLN": "0.00",
    "amount_EUR": "0.00",
    "amount_USD": "0.00",
    "amount_GBP": "0.00",
    "comment": "Puszka nr 0",
    "created_at": "2022-02-25T18:59:07.000000Z",
    "updated_at": "2022-02-25T18:59:07.000000Z",
    "is_special_box": 0,
    "collector": {
        "id": 182,
        "identifier": "774",
        "firstName": "Błażej",
        "lastName": "Górecka",
        "created_at": "2022-02-25T18:59:06.000000Z",
        "updated_at": "2022-02-25T18:59:06.000000Z"
    }
}
```

##### Potwierdzane są dane i sygnalizowane jest rozpoczęcie liczenia
Endpoint: `POST /boxes/{boxID}/startCounting`

Zwrotką jest box jak przy found.

##### Wysyłane są dane dot. zawartości puszki
Endpoint: `POST /boxes/{boxID}`

Dane:
Obiekt JSON z własnościamu spełniającymi wymagania:
```text
'count_1gr' => 'required|integer|between:0,15000',
'count_2gr' => 'required|integer|between:0,15000',
'count_5gr' => 'required|integer|between:0,10000',
'count_10gr' => 'required|integer|between:0,10000',
'count_20gr' => 'required|integer|between:0,10000',
'count_50gr' => 'required|integer|between:0,10000',
'count_1zl' => 'required|integer|between:0,10000',
'count_2zl' => 'required|integer|between:0,10000',
'count_5zl' => 'required|integer|between:0,10000',
'count_10zl' => 'required|integer|between:0,10000',
'count_20zl' => 'required|integer|between:0,10000',
'count_50zl' => 'required|integer|between:0,10000',
'count_100zl' => 'required|integer|between:0,10000',
'count_200zl' => 'required|integer|between:0,10000',
'count_500zl' => 'required|integer|between:0,10000',
//Waluty obce
'amount_EUR' => 'required|numeric|between:0,10000',
'amount_USD' => 'required|numeric|between:0,10000',
'amount_GBP' => 'required|numeric|between:0,10000',
'comment' => ''
```

##### Pokazywany jest ekran potwierdzenia, i po zatwierdzeniu wysyłane kolejne potwierdzenie

Endpoint: `POST /boxes/{boxID}/finishCounting`
