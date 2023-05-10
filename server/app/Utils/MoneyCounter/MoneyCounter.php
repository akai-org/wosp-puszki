<?php
declare(strict_types=1);

namespace App\Utils\MoneyCounter;

use App\Lib\Rates\RatesFetcher;
use App\Utils\CurrencyEnum;
use App\Utils\Money;
use App\Utils\RatesConverter\Converters\{ConvertEurToPln, ConvertGbpToPln, ConvertUsdToPln};
use App\Utils\RatesFetcherFactory;
use Money\Currency;
use Money\Money as PhpMoney;

abstract class MoneyCounter implements Counter
{
    protected const COLUMN_PREFIX = 'amount_';

    /**
     * Default currency configured in project
     * @see config/rates.php
     *
     * @var CurrencyEnum
     */
    protected CurrencyEnum $currency;

    /**
     * Class to fetch rates of currencies used in project
     *
     * @var RatesFetcher
     */
    private RatesFetcher $ratesFetcher;

    private Money $pln;
    private ConvertEurToPln $eur;
    private ConvertUsdToPln $usd;
    private ConvertGbpToPln $gbp;

    /**
     * @param Money $pln
     * @param Money $eur
     * @param Money $usd
     * @param Money $gbp
     */
    public function __construct(Money $pln, Money $eur, Money $usd, Money $gbp)
    {
        $this->ratesFetcher = RatesFetcherFactory::config()::build();

        $this->currency = CurrencyEnum::defaultCurrency();

        $this->pln = $pln;
        $this->eur = ConvertEurToPln::create($eur, $this->ratesFetcher);
        $this->usd = ConvertUsdToPln::create($usd, $this->ratesFetcher);
        $this->gbp = ConvertGbpToPln::create($gbp, $this->ratesFetcher);
    }

    /**
     * Method to fetch sum of different currencies from db
     *
     * @return array
     */
    protected abstract static function init(): array;

    /**
     * Function to count total collected amount
     *
     * @return PhpMoney
     */
    public function count(): PhpMoney
    {
        /** @var PhpMoney $total */
        $total = new PhpMoney(0, new Currency($this->currency->value));

        // add to total value PLN amount
        return $total
            ->add($this->pln->getMoney())
            ->add($this->usd->convert()->getMoney())    // add to total value usd amount multiplied by current USD rates
            ->add($this->eur->convert()->getMoney())    // add to total value eur amount multiplied by current EUR rates
            ->add($this->gbp->convert()->getMoney())    // add to total value gbp amount multiplied by current GBP rates
        ;
    }

    /**
     * @return Money
     */
    public function getPln(): Money
    {
        return $this->pln;
    }

    /**
     * @return Money
     */
    public function getEur(): Money
    {
        return $this->eur;
    }

    /**
     * @return Money
     */
    public function getUsd(): Money
    {
        return $this->usd;
    }

    /**
     * @return Money
     */
    public function getGbp(): Money
    {
        return $this->gbp;
    }

    private static function toMoney(int $value): PhpMoney
    {
        return new PhpMoney($value, new Currency(CurrencyEnum::defaultCurrency()->value));
    }
}
