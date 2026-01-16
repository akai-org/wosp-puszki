# WOŚP Puszki Backend

## Setup

### Without docker

#### Requirements

-   PHP >= 8.3
- Composer
-   Baza Postgres
-   Node (tested 20.11.0 lts)

#### Installation

```
// Copy .env.example to .env file
// Fill file .env, according to the comments

// Install dependencies
composer install

// Install driver browser
vendor/bin/bdi detect drivers

// Generate app key (only for new instance)
php artisan key:generate

// Create database structure
php artisan migrate

// Create test database (with wolo, adminem i superadminem)
php artisan migrate --seed

// Add Storage permissions
sudo chmod -R 755 storage/

// Run websocket server
php artisan reverb:start

// Run main server
php artisan serve

// Fill currencies in the .env fille by opening
// http://localhost:8000/rates and pasting below
// IMPORTANT: If static currencies are not set, STATIC_RATES needs to be false

// Install frontend dependencies
npm install

// Run frontend for dev work
npm run dev

// Run frontend for production
npm run build
```

### Docker

#### Requirements

- docker-compose

#### instalacja

- Run app with the command:

```bash
docker compose up
```

- If that's a first run, trigger `script/first_launch.sh` or manually trigger commands from the script

## Tests

To trigger tests locally run
`php artisan test`

To trigger tests on docker run
`./script/run_tests.sh`

## Dev guidelines

After changing the models, run the following command to provide better IDE support

```
php artisan ide-helper:models
```

### Events saved in the database

| Nazwa eventu    | Opis eventu                                         |
|-----------------|-----------------------------------------------------|
| give            | Giving box to the volunteer                         |
| found           | Finding box                                         |
| startedCounting | Started counting a box                              |
| endedCounting   | Finishing counting a box (without confirmation)     |
| confirmed       | Box has been counted and awaits for beind confirmed |
| verified        | Administrator verified box                          |
| modified        | Administrator modified box                          |
| unverified      | Administrator unverified box                        |

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

### Import volunteers

You need to download `wolontariusze.csv` file from the WOŚP foundation system,
and import them using `php artisan import:collectors` command.

### Fetching eSkarbonka state

eSkarbonka ID needs to be set in the .env file (MONEYBOX_ID).
The ID can be set based on the URL address eg. for the `https://eskarbonka.wosp.org.pl/he9yxj` the id is `he9yxj`.

To fetch it periodically, you need to trigger

```
php artisan schedule:work
```

### API

OpenApi docummentation got described [here](./doc/Api/api.md)

Process flos [is available here](./doc/Api/workflow.md)

### Linter

To clear all the code, use Laravel Pint

```
./vendor/bin/pint
```
