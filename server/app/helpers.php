<?php

namespace App;

use App\Lib\AppStatusManager;
use App\Lib\Rates\CurrentRatesFetcher;
use App\Lib\Rates\RatesFetcher;
use App\Lib\Rates\StaticRatesFetcher;
use Illuminate\Support\Facades\Cache;

function resolveRatesFetcher(): RatesFetcher
{
    if (config('rates.static-rates')) {
        return new StaticRatesFetcher;
    }

    return new CurrentRatesFetcher;
}

function totalCollected(): string
{
    $data = totalCollectedArray();

    return number_format($data['amount_PLN'], 2, ',', ' ');
}

/**
 * @return array<string, mixed>
 */
function totalCollectedArray(): array
{
    $amount_PLN_eskarbonka = AppStatusManager::readStatusValue(AppStatusManager::MONEYBOX_VALUE, '0');
    $amount_PLN = round((float) CharityBox::where('is_confirmed', '=', 1)->sum('amount_PLN'), 2);
    $amount_PLN_unconfirmed = round(CharityBox::all()->sum('amount_PLN'), 2);

    $amount_EUR = round((float) CharityBox::where('is_confirmed', '=', 1)->sum('amount_EUR'), 2);
    $amount_USD = round((float) CharityBox::where('is_confirmed', '=', 1)->sum('amount_USD'), 2);
    $amount_GBP = round((float) CharityBox::where('is_confirmed', '=', 1)->sum('amount_GBP'), 2);

    $fetcher = resolveRatesFetcher();
    $rates = $fetcher->fetchRates();

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

/**
 * @return array{amount_PLN: string, amount_EUR: string, amount_GBP: string, amount_USD: string, rates: float[], amount_total_in_PLN: string, collectors_in_city: int}
 */
function totalCollectedReal(): array
{
    $amount_PLN = (float) CharityBox::where('is_counted', '=', 1)->sum('amount_PLN');
    $amount_EUR = (float) CharityBox::where('is_counted', '=', 1)->sum('amount_EUR');
    $amount_USD = (float) CharityBox::where('is_counted', '=', 1)->sum('amount_USD');
    $amount_GBP = (float) CharityBox::where('is_counted', '=', 1)->sum('amount_GBP');

    $fetcher = resolveRatesFetcher();
    $rates = $fetcher->fetchRates();

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

function wantedFormat(float $amount): string
{
    return number_format($amount, 2, ',', ' ');
}

function totalCollectedWithForeign(): string
{
    $data = totalCollectedArray();

    return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
}
