<?php

namespace App\Utils\DisplayFormat\Format;

interface MoneyFormat
{
    public function format(): callable;
}
