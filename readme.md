# wosp-puszki

### instalacja

```
//kopiujemy plik .env.example do .env
//uzupełniamy danymi plik .env, według komentarzy

//instalujemy zależności

composer install --no-dev

//generujemy nowy klucz, jeżeli to świeża instalacja

php artisan key:generate

//Tworzymy strukturę bazy
//Czysta baza
php artisan migrate

//Baza testowa (z wolo, adminem i superadminem)
php artisan migrate --seed


Usupełniamy kursy walut w pliku .env, odwiedzając
http://localhost:8000/liczymy/rates i wklejając poniżej
UWAGA, jeżeli nie są ustawione kursy, to STATIC_RATES musi być false
```

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