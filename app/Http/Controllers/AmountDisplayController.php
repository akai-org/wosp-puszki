<?php

namespace App\Http\Controllers;

use App\CharityBox;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AmountDisplayController extends Controller
{
    //Przelicz ilość pieniędzy z puszek (łącznie z kursem obcych walut)
    function calculateMoney() {
        //Zliczamy rozliczone PLN z puszek
        $amount_PLN = CharityBox::where('is_confirmed', '=', 1)->sum('amount_PLN');
        $amount_PLN_unconfirmed = CharityBox::all()->sum('amount_PLN');

        //Zliczamy Inne waluty
        //EUR
        $amount_EUR = CharityBox::where('is_confirmed', '=', 1)->sum('amount_EUR');
        //USD
        $amount_USD = CharityBox::where('is_confirmed', '=', 1)->sum('amount_USD');
        //GBP
        $amount_GBP = CharityBox::where('is_confirmed', '=', 1)->sum('amount_GBP');

        //Pobieranie kursu
        $rates = $this->getRatesArray();

        //Policzenie sumy całości
        $total_PLN = array_sum(
            [
                $amount_PLN,
                round($amount_USD*$rates['USD'], 2),
                round($amount_EUR*$rates['EUR'], 2),
                round($amount_GBP*$rates['GBP'], 2)
            ]
        );

        $data = [
            'amount_PLN' => $amount_PLN,
            'amount_PLN_unconfirmed' => $amount_PLN_unconfirmed-$amount_PLN,
            'amount_EUR' => $amount_EUR,
            'amount_GBP' => $amount_GBP,
            'amount_USD' => $amount_USD,
            'rates' => $rates,
            'amount_total_in_PLN' => $total_PLN
        ];

        return $data;
    }

    function getRatesArray() {
        //Pobiera kursy z NBP, albo zwraca zacache'owane
        //Po 11:30

        // W pliku .env można ustawić stawki na sztywno,
        // żeby nie obciążać się zapytaniami do NBP
        if (env('STATIC_RATES')) {
            $rates = [
                'USD' => env('USD_RATE'),
                'EUR' => env('EUR_RATE'),
                'GBP' => env('GBP_RATE')
            ];
        } else {
            //Pobieramy kurs z tabeli A Narodowego Banku Polskiego
            //Jest to średni kurs z godziny 11:00
            //EUR
            $array_EUR = json_decode(file_get_contents('https://api.nbp.pl/api/exchangerates/rates/A/EUR/?format=json'), true);
            $rates['EUR'] = $array_EUR['rates'][0]['mid'];
            //USD
            //http://api.nbp.pl/api/exchangerates/rates/A/USD/?format=json
            $array_USD = json_decode(file_get_contents('https://api.nbp.pl/api/exchangerates/rates/A/USD/?format=json'), true);
            $rates['USD'] = $array_USD['rates'][0]['mid'];
            //GBP
            //http://api.nbp.pl/api/exchangerates/rates/A/GBP/?format=json
            $array_GBP = json_decode(file_get_contents('https://api.nbp.pl/api/exchangerates/rates/A/GBP/?format=json'), true);
            $rates['GBP'] = $array_GBP['rates'][0]['mid'];
        }

        return $rates;
    }

    function getRates() {
        //Wyświetla Stawki do wklejenia do pliku
        return view('rates')->with('rates', $this->getRatesArray());
    }

    //Wyświetl zliczoną ilość pieniędzy
    function display() {

        $data = $this->calculateMoney();

        return view('amount')->with('data', $data);
    }

    function getTotalRaw() {
        $data = $this->calculateMoney();
        return $data['amount_total_in_PLN'].'zł';
    }
}
