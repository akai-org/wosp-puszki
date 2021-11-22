<?php


namespace App\Helpers;


use App\Http\Controllers\AmountDisplayController;
use App\Models\CharityBox;

class AmountHelpers
{
    static function totalCollected(): string
    {
        $data = AmountHelpers::totalCollectedArray();
        return number_format($data['amount_PLN'], 2, ',', ' ');
    }

    static function totalCollectedArray(): array
    {
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

    static function totalCollectedReal(): array
    {
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

        return [
            'amount_PLN' => AmountHelpers::wantedFormat($amount_PLN),
            'amount_EUR' => AmountHelpers::wantedFormat($amount_EUR),
            'amount_GBP' => AmountHelpers::wantedFormat($amount_GBP),
            'amount_USD' => AmountHelpers::wantedFormat($amount_USD),
            'rates' => $rates,
            'amount_total_in_PLN' => AmountHelpers::wantedFormat($total_PLN),
            'collectors_in_city' => $collectors_in_city
        ];
    }

    static function wantedFormat(float $amount): string
    {
        return number_format($amount, 2, ',', ' ');
    }

    static function totalCollectedWithForeign(): string
    {
        $data = AmountHelpers::totalCollectedArray();
        return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
    }

}
