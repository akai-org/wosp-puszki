<?php
declare(strict_types=1);

namespace App\Utils\RatesConverter\Converters;

use App\Utils\CurrencyEnum;
use App\Utils\Money;

final class ConvertGbpToPln extends Money
{
    protected const CURRENCY_ENUM = CurrencyEnum::GBP_NAME;
}
