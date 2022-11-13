<?php

namespace App\Lib\BoxOperations;

interface BoxOperation
{
    public function proceed(): void;
    public function result(): BoxOperationResult;
}