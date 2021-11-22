<?php

namespace App\Http\Controllers;

use App\Helpers\AmountHelpers;
use App\Models\CharityBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AmountDisplayController extends Controller
{

    function getRatesArray() {
        //Pobiera kursy z NBP, albo zwraca zacache'owane
        //Po 11:30

        // W pliku .env można ustawić stawki na sztywno,
        // żeby nie obciążać się zapytaniami do NBP
        if (env('STATIC_RATES')) {
            $rates = [
                'USD' => env('RATE_USD'),
                'EUR' => env('RATE_EUR'),
                'GBP' => env('RATE_GBP')
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

        $data = AmountHelpers::totalCollectedReal();

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

        $data = AmountHelpers::totalCollectedReal();

        return response()->json($data);
    }

    function getTotalRawPln(): string
    {
        return AmountHelpers::totalCollected();
    }

    function getTotalRawWithForeign(): string
    {
        return AmountHelpers::totalCollectedWithForeign();
    }

    function displayRawJson(): \Illuminate\Http\JsonResponse
    {
        $data = AmountHelpers::totalCollectedArray();
        return response()->json($data);
    }
}
