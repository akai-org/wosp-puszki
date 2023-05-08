<?php
declare(strict_types=1);

namespace App\Utils\DisplayFormat\Format;

use \Money\Money as PhpMoney;
use App\Utils\Money;

class CurrencyWithCommaFormat extends CurrencyFormat
{
    public function __construct(Money|PhpMoney $money)
    {
        parent::__construct($money, 2, ',', ' ');
    }
}
