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
php artisan migrate --seed

//Baza testowa (z wolo, adminem i superadminem)
php artisan migrate --seed

```

