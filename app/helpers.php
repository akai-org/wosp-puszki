<?php

namespace App;

use App\Http\Controllers\AmountDisplayController;

function totalCollected() {
    $controller = new AmountDisplayController();
    $data = $controller->calculateMoney();
    return number_format($data['amount_PLN'], 2, ',', ' ');
}

function totalCollectedWithForeign() {
    $controller = new AmountDisplayController();
    $data = $controller->calculateMoney();
    return number_format($data['amount_total_in_PLN'], 2, ',', ' ');
}