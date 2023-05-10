<?php

namespace App\Lib\Rates;

use App\Utils\CurrencyEnum;

interface RatesFetcher
{
    public function fetchRates(?CurrencyEnum $currencyEnum = null): \Generator;

    //public function fetchApiRates();
}
