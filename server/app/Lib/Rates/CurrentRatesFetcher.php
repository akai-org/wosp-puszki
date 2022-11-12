<?php

namespace App\Lib\Rates;

class CurrentRatesFetcher implements RatesFetcher
{
    // TODO warto rozważyć wyniesienie linków do configa
    private const EUR_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/EUR/?format=json';
    private const USD_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/USD/?format=json';
    private const GBP_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/GBP/?format=json';

    public function fetchRates(): array
    {
        $eur = $this->fetchApiRates(self::EUR_ENDPOINT);
        $usd = $this->fetchApiRates(self::USD_ENDPOINT);
        $gbp = $this->fetchApiRates(self::GBP_ENDPOINT);
        return (new Rates($usd, $eur, $gbp))->toArray();
    }

    private function fetchApiRates(string $endpoint) // TODO jaki typ wychodzi z tego api? Można jakoś zhintować?
    {
        $result = json_decode(file_get_contents($endpoint), true);
        return $result['rates'][0]['mid'];
    }
}