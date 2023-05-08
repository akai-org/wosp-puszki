<?php
declare(strict_types=1);

namespace App\Utils;

enum CurrencyEnum : string
{
    case PLN_NAME = 'PLN';
    case USD_NAME = 'USD';
    case EUR_NAME = 'EUR';
    case GBP_NAME = 'GBP';

    public static function defaultCurrency(): CurrencyEnum
    {
        $currency = config('rates.default-currency');

        return match($currency)
        {
            self::PLN_NAME->value == $currency => CurrencyEnum::PLN_NAME,
            self::USD_NAME->value == $currency => CurrencyEnum::USD_NAME,
            self::EUR_NAME->value == $currency => CurrencyEnum::EUR_NAME,
            self::GBP_NAME->value == $currency => CurrencyEnum::GBP_NAME,
            default => CurrencyEnum::PLN_NAME,
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
