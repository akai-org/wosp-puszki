<?php
declare(strict_types=1);

namespace App\Utils;

use phpDocumentor\Reflection\Element;

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

    public static function getRatesType(bool $param): RatesFetcherEnum
    {
        return $param ? RatesFetcherEnum::Static : RatesFetcherEnum::Current;
    }
}
