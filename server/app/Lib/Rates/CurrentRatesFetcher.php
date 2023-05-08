<?php
declare(strict_types=1);

namespace App\Lib\Rates;

use App\Utils\CurrencyEnum;
use Generator;
use InvalidArgumentException;

class CurrentRatesFetcher implements RatesFetcher
{
    // TODO warto rozważyć wyniesienie linków do configa
    private const EUR_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/EUR/?format=json';
    private const USD_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/USD/?format=json';
    private const GBP_ENDPOINT = 'https://api.nbp.pl/api/exchangerates/rates/A/GBP/?format=json';

    /**
     * Function return array of currency rates
     * containing all or one specific rates (depends on passed parameter)
     *
     * @see format:
     * [
     *  'USD' => 4.35,
     *  'EUR' => 4.50,
     *  ...
     * ]
     *
     * @param CurrencyEnum|null $currencyEnum
     * @return array
     */
    public function fetchRates(?CurrencyEnum $currencyEnum = null): \Generator
    {
        return $currencyEnum === null ?
            yield from $this->fetchAllApiRates() :
            yield [$currencyEnum->value => $this->fetchApiRates($currencyEnum)]
        ;
    }

    public function getApiEndpointURL(CurrencyEnum $enum): string
    {
        switch ($enum)
        {
            case CurrencyEnum::EUR_NAME:
            {
                return self::EUR_ENDPOINT;
            }
            case CurrencyEnum::USD_NAME:
            {
                return self::USD_ENDPOINT;
            }
            case CurrencyEnum::GBP_NAME:
            {
                return self::GBP_ENDPOINT;
            }
            default:
            {
                throw new InvalidArgumentException(sprintf('There is no endpoint to fetch `%s` rates', $enum->value));
            }
        }
    }

    /**
     * Funkcje należy przepisac po przeniesieniu endpointów do config.php albo enum
     * @return Generator
     */
    private function fetchAllApiRates(): \Generator
    {
        foreach((new \ReflectionClass(__CLASS__))->getConstants() as $key => $apiEndpointUrl) {
            $currencyToken = strtoupper(explode('_', $key)[0]);

            /*
             * Based on local constant we decide which currencies from delcared in project fetch
             * Currently we have 4 (see CurrencyEnum) but we don't have PLN (and we didn't declared endpoint URL)
             *
             * We add new record with schema: [currency_name => currency rate]
             * eg:
             *  [
             *     'USD' => 4.56
             *  ]
            */
            yield [CurrencyEnum::tryFrom($currencyToken)->value => $this->fetchApiRates(CurrencyEnum::tryFrom($currencyToken))];
        }
    }

    private function fetchApiRates(CurrencyEnum $enum) // TODO jaki typ wychodzi z tego api? Można jakoś zhintować?
    {
        /** @var string $endpoint - url address to NBP api with current currency rate */
        $endpoint = $this->getApiEndpointURL($enum);

        $result = json_decode(file_get_contents($endpoint), true);
        return $result['rates'][0]['mid'];
    }
}
