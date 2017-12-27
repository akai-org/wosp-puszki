<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmountDisplayController extends Controller
{
    //Przelicz ilość pieniędzy z puszek (łącznie z kursem obcych walut)
    function recalculate() {

    }
    //Wyświetl zliczoną ilość pieniędzy
    function display() {
        $data = [
            'amount_PLN' => 200,
            'amount_EUR' => 200,
            'amount_GBP' => 50,
            'amount_USD' => 200,
            'amount_PLN_total' => 5000,
        ];

        return view('amount')->with('data', $data);
    }
}
