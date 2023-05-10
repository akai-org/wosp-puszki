<?php
declare(strict_types=1);

namespace App\Utils;

/**
 * @author kabix09
 *
 * Enum class representing rates fetcher type based on parameter
 * @see 'rates.static-rates' - defined in  config/rates.php
 *
 * After changing configurations type, matching function should be refactored according to changes
 */
enum RatesFetcherEnum
{
    case Static;
    case Current;

    public static function getRatesType($param): RatesFetcherEnum
    {
        return match($param) {
            $param == true => RatesFetcherEnum::Static,
            $param !== true => RatesFetcherEnum::Current,
            default => RatesFetcherEnum::Static,
        };
    }
}
