<?php

namespace App\Lib\Rates;

class Rates
{
    private const USD_NAME = 'USD';
    private const EUR_NAME = 'EUR';
    private const GBP_NAME = 'GBP';

    // TODO można jakoś hintować typy tych zmiennych? Czy z api i configa lecą te same typy?
    private $gbp;
    private $eur;
    private $usd;

    public function __construct($usd, $eur, $gbp)
    {
        $this->usd = $usd;
        $this->eur = $eur;
        $this->gbp = $gbp;
    }

    public function toArray(): array
    {
        return [
            self::USD_NAME => $this->usd,
            self::EUR_NAME => $this->eur,
            self::GBP_NAME => $this->gbp
        ];
    }
}