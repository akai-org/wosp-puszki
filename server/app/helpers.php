<?php

namespace App;

use App\Lib\AppStatusManager;
use App\Utils\DisplayFormat\Format\CurrencyWithCommaFormat;
use App\Utils\Money;
use App\Utils\MoneyCounter\CollectedMoneyCounter;
use App\Utils\MoneyCounter\ConfirmedMoneyCounter;
use Money\Currency;

// TODO jeżeli ten skrypt będzie refaktoryzowany, to te metode trzeba bedzie zastpic DI
// di - dependency injection
// Function replaced by RatesFetcherFactory - remove code after test passing
//function resolveRatesFetcher(): RatesFetcher {
//    if (config('rates.static-rates')) {
//        return new StaticRatesFetcher();
//    }
//    return new CurrentRatesFetcher();
//}

function totalCollected() {
    $data = totalCollectedArray();
    return number_format($data['amount_PLN'], 2, ',', ' ');
}

function totalCollectedArray() {
    $mc = new ConfirmedMoneyCounter();

    $amount_PLN_eskarbonka = AppStatusManager::readStatusValue(AppStatusManager::MONEYBOX_VALUE, 0);
    $amount_PLN_eskarbonka = new Money($amount_PLN_eskarbonka, new Currency('PLN'));

    $amount_PLN_unconfirmed = CharityBox::all()->sum('amount_PLN');
    $amount_PLN_unconfirmed = new Money($amount_PLN_unconfirmed, new Currency('PLN'));

    /** @var \Money\Money $total_with_eskarbonka */
    $total_with_eskarbonka = $mc
        ->count()
        ->add($amount_PLN_eskarbonka->getMoney())
    ;

    $collectors_in_city = CharityBox::where('is_counted', '=', 0)->count();

    $data = [
        'amount_PLN' => $mc->getPln()->getMoney()->getAmount(),
        'amount_PLN_unconfirmed' => $amount_PLN_unconfirmed->getMoney()->subtract($mc->getPln()->getMoney())->getAmount(),
        'amount_PLN_eskarbonka' => $amount_PLN_eskarbonka->getMoney()->getAmount(),
        'amount_EUR' => $mc->getEur()->getMoney()->getAmount(),
        'amount_GBP' => $mc->getGbp()->getMoney()->getAmount(),
        'amount_USD' => $mc->getUsd()->getMoney()->getAmount(),
        'rates' => [
            'USD' => $mc->getUsd()->getRates(),
            'EUR' => $mc->getEur()->getRates(),
            'GBP' => $mc->getGbp()->getRates(),
        ],
        'amount_total_in_PLN' =>  $total_with_eskarbonka->getAmount(),
        'collectors_in_city' => $collectors_in_city
    ];

    return $data;
}

//Sup up all counted boxes
function totalCollectedReal() {
    $mc = new CollectedMoneyCounter();

    $collectors_in_city = CharityBox::where('is_counted', '=', 0)->count();

    return [
        'amount_PLN' => (string)(new CurrencyWithCommaFormat($mc->getPln())), // wantedFormat($amount_PLN),
        'amount_EUR' => (string)(new CurrencyWithCommaFormat($mc->getEur())),
        'amount_GBP' => (string)(new CurrencyWithCommaFormat($mc->getGbp())),
        'amount_USD' => (string)(new CurrencyWithCommaFormat($mc->getUsd())),
        'rates' => [
            'USD' => $mc->getUsd()->getRates(),
            'EUR' => $mc->getEur()->getRates(),
            'GBP' => $mc->getGbp()->getRates(),
        ],
        'amount_total_in_PLN' => (string)(new CurrencyWithCommaFormat($mc->count())),
        'collectors_in_city' => $collectors_in_city
    ];
}


// Old function used currently only in tests
// Instead this function let's use CurrencyWithCommaFormat
// TODO after rewritting test check and remove function
function wantedFormat(float $amount) {
    return number_format($amount, 2, ',', ' ');
}

function totalCollectedWithForeign() {
    $data = totalCollectedArray();
    return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
}
