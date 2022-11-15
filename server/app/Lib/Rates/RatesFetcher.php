<?php

namespace App\Lib\Rates;

interface RatesFetcher
{
    public function fetchRates(): array;
}