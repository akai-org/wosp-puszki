<?php
declare(strict_types=1);

namespace App\Utils\MoneyCounter;

use Money\Money as PhpMoney;

interface Counter
{
    public function count(): PhpMoney;
}
