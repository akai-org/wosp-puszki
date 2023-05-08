<?php
declare(strict_types=1);

namespace App\Utils\DisplayFormat\Format;

use App\Utils\Money;
use \Money\Money as PhpMoney;
use Webmozart\Assert\Assert;

/**
 * @author kabix09
 */
abstract class CurrencyFormat implements MoneyFormat
{
    /** @var int $money */
    private int $money;

    private int $decimals;
    private string $decimalSeparator;
    private string $thousandsSeparator;

    public function __construct(Money|PhpMoney $money, int $decimals, string $decimalSeparator, string $thousandsSeparator)
    {
        Assert::length($decimalSeparator, 1, 'The decimal separator must be single character');
        Assert::length($thousandsSeparator, 1, 'The thousands separator must be single character');

        $this->decimals = $decimals;
        $this->decimalSeparator = $decimalSeparator;
        $this->thousandsSeparator = $thousandsSeparator;

        if($money instanceof Money)
            $this->money = (int)$money->getMoney()->getAmount(); // ?? new Money(0, new Currency(config('rates.default-currency')));
        elseif($money instanceof PhpMoney)
            $this->money = (int)$money->getAmount();
    }


    /**
     * Return callback which will return string after passing float price to display
     *
     * @return callable
     */
    public function format(): callable
    {
        return fn(float $amount) => number_format($amount, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
    }

    public function __toString(): string
    {
        return $this->format()($this->money / 100);
    }
}
