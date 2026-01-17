<?php

namespace App;

use App\Lib\AppStatusManager;
use App\Lib\Rates\CurrentRatesFetcher;
use App\Lib\Rates\RatesFetcher;
use App\Lib\Rates\StaticRatesFetcher;
use Illuminate\Support\Facades\Cache;

// TODO jeżeli ten skrypt będzie refaktoryzowany, to te metode trzeba bedzie zastpic DI
function resolveRatesFetcher(): RatesFetcher
{
    if (config('rates.static-rates')) {
        return new StaticRatesFetcher;
    }

    return new CurrentRatesFetcher;
}

function totalCollected()
{
    $data = totalCollectedArray();

    return number_format($data['amount_PLN'], 2, ',', ' ');
}

function totalCollectedArray()
{
    // Eskarbonka
    $amount_PLN_eskarbonka = AppStatusManager::readStatusValue(AppStatusManager::MONEYBOX_VALUE, '0');
    //Zliczamy rozliczone PLN z puszek
    $amount_PLN = round(CharityBox::where('is_confirmed', '=', 1)->sum('amount_PLN'), 2);
    $amount_PLN_unconfirmed = round(CharityBox::all()->sum('amount_PLN'), 2);

    // Zliczamy Inne waluty
    // EUR
    $amount_EUR = round(CharityBox::where('is_confirmed', '=', 1)->sum('amount_EUR'), 2);
    // USD
    $amount_USD = round(CharityBox::where('is_confirmed', '=', 1)->sum('amount_USD'), 2);
    // GBP
    $amount_GBP = round(CharityBox::where('is_confirmed', '=', 1)->sum('amount_GBP'), 2);

    // Pobieranie kursu
    $fetcher = resolveRatesFetcher();
    $rates = $fetcher->fetchRates();

    // Policzenie sumy całości
    $total_PLN = array_sum(
        [
            (float) $amount_PLN_eskarbonka,
            round($amount_PLN, 2),
            round($amount_USD * $rates['USD'], 2),
            round($amount_EUR * $rates['EUR'], 2),
            round($amount_GBP * $rates['GBP'], 2),
        ]
    );

    $collectors_in_city = CharityBox::where('is_counted', '=', 0)->count();

    $data = [
        'amount_PLN' => $amount_PLN,
        'amount_PLN_unconfirmed' => $amount_PLN_unconfirmed - $amount_PLN,
        'amount_PLN_eskarbonka' => (float) $amount_PLN_eskarbonka,
        'amount_EUR' => $amount_EUR,
        'amount_GBP' => $amount_GBP,
        'amount_USD' => $amount_USD,
        'rates' => $rates,
        'amount_total_in_PLN' => round($total_PLN, 2),
        'collectors_in_city' => $collectors_in_city,
        'amount_allegro' => Cache::get('allegro_sum'),
    ];

    return $data;
}

// Sup up all counted boxes
function totalCollectedReal()
{
    $amount_PLN = CharityBox::where('is_counted', '=', 1)->sum('amount_PLN');

    // Zliczamy Inne waluty
    // EUR
    $amount_EUR = CharityBox::where('is_counted', '=', 1)->sum('amount_EUR');
    // USD
    $amount_USD = CharityBox::where('is_counted', '=', 1)->sum('amount_USD');
    // GBP
    $amount_GBP = CharityBox::where('is_counted', '=', 1)->sum('amount_GBP');

    // Pobieranie kursu
    $fetcher = resolveRatesFetcher();
    $rates = $fetcher->fetchRates();

    // Policzenie sumy całości
    $total_PLN = array_sum(
        [
            $amount_PLN,
            $amount_USD * $rates['USD'],
            $amount_EUR * $rates['EUR'],
            $amount_GBP * $rates['GBP'],
        ]
    );

    $collectors_in_city = CharityBox::where('is_counted', '=', 0)->count();

    $data = [
        'amount_PLN' => wantedFormat($amount_PLN),
        'amount_EUR' => wantedFormat($amount_EUR),
        'amount_GBP' => wantedFormat($amount_GBP),
        'amount_USD' => wantedFormat($amount_USD),
        'rates' => $rates,
        'amount_total_in_PLN' => wantedFormat($total_PLN),
        'collectors_in_city' => $collectors_in_city,
    ];

    return $data;
}

function wantedFormat(float $amount)
{
    return number_format($amount, 2, ',', ' ');
}

function totalCollectedWithForeign()
{
    $data = totalCollectedArray();

    return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
}
