<?php

namespace App\Lib\Rates;

interface RatesFetcher
{
    /**
     * @return float[]
     */
    public function fetchRates(): array;
}
