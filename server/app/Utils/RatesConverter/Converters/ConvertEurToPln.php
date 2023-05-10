<?php
declare(strict_types=1);

namespace App\Utils\RatesConverter\Converters;

use App\Utils\CurrencyEnum;
use App\Utils\Money;

final class ConvertEurToPln extends Money
{
    protected const CURRENCY_ENUM = CurrencyEnum::EUR_NAME;
}
