<?php

namespace App\Http\Controllers;

use App\CharityBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AmountDisplayController extends Controller
{
//    //Przelicz ilość pieniędzy z puszek (łącznie z kursem obcych walut)
//    function calculateMoney() {
//
//    }

    function getRatesArray($forceCurrent = false) {
        //Pobiera kursy z NBP, albo zwraca zacache'owane
        //Po 11:30

        // W pliku .env można ustawić stawki na sztywno,
        // żeby nie obciążać się zapytaniami do NBP
        if (config('rates.static-rates') && !$forceCurrent) {
            $rates = [
                'USD' => config('rates.usd'),
                'EUR' => config('rates.eur'),
                'GBP' => config('rates.gbp')
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

        $data = \App\totalCollectedReal();

        return view('amount')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJson() {

        $data = json_decode(Storage::get('raw2.txt'), true);

        return view('amount_simplest')->with('data', $data);
    }

    //Wyświetl zliczoną ilość pieniędzy - przesłaną z zewnątrz
    function displayFromStoredJsonGreen() {

        $data = json_decode(Storage::get('raw2.txt'), true);

        return view('amount_simplest_green')->with('data', $data);
    }

    function displayApi() {

        $data = \App\totalCollectedReal();

        return response()->json($data);
    }

    function getTotalRawPln() {
        return \App\totalCollected();
    }

    function getTotalRawWithForeign() {
        return \App\totalCollectedWithForeign();
    }

    function displayRawJson() {
        $data = \App\totalCollectedArray();
        return response()->json($data);
    }
}
