<?php

namespace App;

use App\Http\Controllers\AmountDisplayController;

function totalCollected() {
    $controller = new AmountDisplayController();
    $data = $controller->calculateMoney();
    return $data['amount_total_in_PLN'];
}