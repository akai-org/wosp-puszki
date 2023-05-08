<?php
declare(strict_types=1);

namespace App\Utils\RatesConverter;

interface RatesConverter
{
    public function convert(): self;

    //public function getAmount(): Money;
}
