# wosp-puszki

## Setup

### no-docker

#### wymagania

- PHP >= 8.3
- Baza Posggres
- Node (tested 20.11.0 lts)

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

//Serwer websocketów Laravel Reverb
php artisan reverb:start


Usupełniamy kursy walut w pliku .env, odwiedzając
http://localhost:8000/rates i wklejając poniżej
UWAGA, jeżeli nie są ustawione kursy, to STATIC_RATES musi być false

// Frontend:
npm install

// For dev work
npm run dev

// For prod
npm run build
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

Dokumentacja OpenApi zastosowana w projekcie jak i zbiór endpointów opisane zostały [tutaj](./doc/Api/api.md)

Przepływ procesu [dostępny tu](./doc/Api/workflow.md)
