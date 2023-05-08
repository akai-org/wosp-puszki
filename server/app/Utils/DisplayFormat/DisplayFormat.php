<?php

namespace App\Utils\DisplayFormat;

use App\Utils\DisplayFormat\Format\MoneyFormat;

interface DisplayFormat
{
    public function display(MoneyFormat $moneyFormat): string;
}
