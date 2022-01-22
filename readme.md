# wosp-puszki


### wymagania
 - PHP 7.3

### instalacja

```
//kopiujemy plik .env.example do .env
//uzupełniamy danymi plik .env, według komentarzy

//instalujemy zależności

composer install

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

## Testy
`php artisan test`

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
```
$table->string('type');
$table->integer('box_id');
$table->integer('user_id');
$table->string('comment');
```

give - wydanie puszki wolontariuszowi
found - znalezienie puszki
startedCounting - rozpoczął rozliczenie puszki
endedCounting - zakończył liczenie (nie potwierdził jeszcze)
confirmed - puszka została przeliczona i wysłana do potwierdzenia
//pRZECHODZIMY do admina
verified - administrator zatwierdził
modified - administrator zmodyfikował
unverified - administrator od-zatwierdził

alarm- uruchomiony silent alarm



//USER
alreadyCounted - event usera



//Zapisujemy event do bazy

$event = new BoxEvent();
$event->type = 'give';
$event->box_id = $box->id;
$event->user_id = $request->user()->id;
$event->comment = 'Collector: ' . $collector->display;
$event->save();

$collector->display . $box->display_id

### Websockets

https://github.com/beyondcode/laravel-websockets/issues/102
https://github.com/beyondcode/laravel-websockets/issues/266
https://alex.bouma.dev/posts/installing-laravel-websockets-on-forge/
https://github.com/beyondcode/laravel-websockets/issues/92#issuecomment-455192084
https://beyondco.de/docs/laravel-websockets/basic-usage/starting
https://github.com/beyondcode/laravel-websockets/issues/148
https://laracasts.com/discuss/channels/laravel/laravel-nuxt-nginx-websocket-is-closed-before-the-connection-is-established



### Import wolontariuszy

Należy pobrać plik `wolontariusze.csv` z systemu fundacji, a następnie zaimpoerować komendą `php artisan import:collectors`