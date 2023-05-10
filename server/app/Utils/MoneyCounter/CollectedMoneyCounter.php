<?php
declare(strict_types=1);

namespace App\Utils\MoneyCounter;

use App\CharityBox;
use App\Utils\CurrencyEnum;
use App\Utils\Money;
use Money\Currency;

/**
 * @author kabix09
 *
 * Class counting money from @see counted charity boxes
 */
class CollectedMoneyCounter extends MoneyCounter
{
    public function __construct()
    {
        $collectedCurrencies = self::init();

        parent::__construct(
            $collectedCurrencies[CurrencyEnum::PLN_NAME->value],
            $collectedCurrencies[CurrencyEnum::EUR_NAME->value],
            $collectedCurrencies[CurrencyEnum::USD_NAME->value],
            $collectedCurrencies[CurrencyEnum::GBP_NAME->value]
        );
    }

    protected static function init(): array
    {
        // zliczamy zebrane złotówki i inne waluty: EUR, USD, GBP

        return array_reduce(CurrencyEnum::values(), function ($prevIterResult, $item) {

            $currentColumnName = sprintf('%s%s', self::COLUMN_PREFIX, strtoupper($item));

            return array_merge(
                $prevIterResult,
                [
                    $item => new Money((int)(CharityBox::where('is_counted', '=', 1)->sum($currentColumnName) * 100),
                        new Currency(CurrencyEnum::defaultCurrency()->value) // PLN
                    )
                ]
            );
        }, []);
    }
}
