<?php
declare(strict_types=1);

namespace App\Utils;

use App\Lib\Rates\RatesFetcher;
use App\Utils\RatesConverter\RatesConverter;
use Money\Currency;
use Money\Money as PhpMoney;
use Webmozart\Assert\Assert;

class Money implements RatesConverter
{
    protected const CURRENCY_ENUM = CurrencyEnum::PLN_NAME;

    /** @var PhpMoney */
    private PhpMoney $amount;

    /** @var RatesFetcher */
    private RatesFetcher $ratesFetcher;

    /**
     * @param PhpMoney $amount
     * @param RatesFetcher|null $ratesFetcher
     */
    public function __construct(int $amount, Currency $currency, ?RatesFetcher $ratesFetcher = null)
    {
        $this->amount = new \Money\Money($amount, $currency);       // new Currency(CurrencyEnum::defaultCurrency()->value)

        if($ratesFetcher == null)
            $ratesFetcher = RatesFetcherFactory::config()::build();

        $this->ratesFetcher = $ratesFetcher;

//        if(static::CURRENCY_ENUM != CurrencyEnum::defaultCurrency())
//            Assert::keyExists(
//                array: iterator_to_array($this->ratesFetcher->fetchRates(), true),
//                key: static::CURRENCY_ENUM->value,
//                message: sprintf('This currency `%s`dont exists in fetched rates!!!', static::CURRENCY_ENUM->value)
//            );
    }

    public static function create(Money $money, ?RatesFetcher $ratesFetcher = null): self
    {
        return new static((int)$money->getMoney()->getAmount(), $money->getMoney()->getCurrency(), $ratesFetcher);
    }

    /**
     * @return PhpMoney
     */
    public function getMoney(): PhpMoney
    {
        return $this->amount;
    }

    /**
     * Function returning rates of currency
     *
     * @return float
     */
    public function getRates(): float
    {
        return array_values($this->ratesFetcher->fetchRates(static::CURRENCY_ENUM)->current())[0];
    }

    /**
     * Function converting current currency to PLN
     *
     * Because we convert from other currency to PLN, returned instance must be `Money` class with `CURRENCY_ENUM = CurrencyEnum::PLN_NAME`
     *
     * @return Money
     */
    public function convert(): self
    {
        // add to total value to amount multiplied by current rates
        $myMoney = $this->amount->multiply((string)$this->getRates());

        return new self((int)$myMoney->getAmount(), $myMoney->getCurrency());
    }
}
