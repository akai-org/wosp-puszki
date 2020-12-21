<?php

namespace App;

use App\Http\Controllers\AmountDisplayController;

function totalCollected() {
    $data = totalCollectedArray();
    return number_format($data['amount_PLN'], 2, ',', ' ');
}

function totalCollectedArray() {
    //Zliczamy rozliczone PLN z puszek
    $amount_PLN = round(CharityBox::where('is_confirmed', '=', 1)->sum('amount_PLN'), 2);
    $amount_PLN_unconfirmed = round(CharityBox::all()->sum('amount_PLN'),2);

    //Zliczamy Inne waluty
    //EUR
    $amount_EUR = CharityBox::where('is_confirmed', '=', 1)->sum('amount_EUR');
    //USD
    $amount_USD = CharityBox::where('is_confirmed', '=', 1)->sum('amount_USD');
    //GBP
    $amount_GBP = CharityBox::where('is_confirmed', '=', 1)->sum('amount_GBP');

    //Pobieranie kursu
    $controller = new AmountDisplayController();
    $rates = $controller->getRatesArray();

    //Policzenie sumy całości
    $total_PLN = array_sum(
        [
            round($amount_PLN, 2),
            round($amount_USD*$rates['USD'], 2),
            round($amount_EUR*$rates['EUR'], 2),
            round($amount_GBP*$rates['GBP'], 2)
        ]
    );

    $collectors_in_city = CharityBox::where('is_counted', '=', 0)->count();

    $data = [
        'amount_PLN' => $amount_PLN,
        'amount_PLN_unconfirmed' => $amount_PLN_unconfirmed-$amount_PLN,
        'amount_EUR' => $amount_EUR,
        'amount_GBP' => $amount_GBP,
        'amount_USD' => $amount_USD,
        'rates' => $rates,
        'amount_total_in_PLN' => $total_PLN,
        'collectors_in_city' => $collectors_in_city
    ];

    return $data;
}

//Sup up all counted boxes
function totalCollectedReal() {
    $amount_PLN = CharityBox::where('is_counted', '=', 1)->sum('amount_PLN');

    //Zliczamy Inne waluty
    //EUR
    $amount_EUR = CharityBox::where('is_counted', '=', 1)->sum('amount_EUR');
    //USD
    $amount_USD = CharityBox::where('is_counted', '=', 1)->sum('amount_USD');
    //GBP
    $amount_GBP = CharityBox::where('is_counted', '=', 1)->sum('amount_GBP');

    //Pobieranie kursu
    $controller = new AmountDisplayController();
    $rates = $controller->getRatesArray();

    //Policzenie sumy całości
    $total_PLN = array_sum(
        [
            $amount_PLN,
            $amount_USD*$rates['USD'],
            $amount_EUR*$rates['EUR'],
            $amount_GBP*$rates['GBP'],
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
        'collectors_in_city' => $collectors_in_city
    ];

    return $data;
}

function wantedFormat(float $amount) {
    return number_format($amount, 2, ',', ' ');
}

function totalCollectedWithForeign() {
    $data = totalCollectedArray();
    return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
}