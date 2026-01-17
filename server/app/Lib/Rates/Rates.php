<?php

namespace App\Lib\Rates;

class Rates
{
    private const USD_NAME = 'USD';

    private const EUR_NAME = 'EUR';

    private const GBP_NAME = 'GBP';

    private float $gbp;
    private float $eur;
    private float $usd;

    public function __construct(float $usd, float $eur, float $gbp)
    {
        $this->usd = $usd;
        $this->eur = $eur;
        $this->gbp = $gbp;
    }

    /**
     * @return float[]
     */
    public function toArray(): array
    {
        return [
            self::USD_NAME => $this->usd,
            self::EUR_NAME => $this->eur,
            self::GBP_NAME => $this->gbp,
        ];
    }
}
