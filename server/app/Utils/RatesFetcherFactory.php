<?php
declare(strict_types=1);

namespace App\Utils;

use App\Lib\Rates\CurrentRatesFetcher;
use App\Lib\Rates\RatesFetcher;
use App\Lib\Rates\StaticRatesFetcher;
use InvalidArgumentException;

class RatesFetcherFactory
{
    private static RatesFetcherEnum $enum;

    private function __construct(RatesFetcherEnum $enum)
    {
        self::$enum = $enum;
    }

    public static function config(): RatesFetcherFactory
    {
        return new RatesFetcherFactory(RatesFetcherEnum::getRatesType(config('rates.static-rates')));
    }

    public static function build(): RatesFetcher
    {
        switch (self::$enum)
        {
            case RatesFetcherEnum::Static:
            {
                return new StaticRatesFetcher();
            }

            case RatesFetcherEnum::Current:
            {
                return new CurrentRatesFetcher();
            }

            default:
            {
                throw new InvalidArgumentException(sprintf('There is no RatesFetcher class matching to `%s`', $enum->name));
            }
        }
    }
}
