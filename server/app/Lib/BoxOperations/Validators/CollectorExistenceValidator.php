<?php

namespace App\Lib\BoxOperations\Validators;

use App\Collector;

class CollectorExistenceValidator extends Validator
{
    public function resolve(ValidationContext $context): ValidationResult
    {
        // nice to have: wynieść query do bazy do innej klasy i w ogóle nie opierać się na Eloquencie w walidacji
        $collector = Collector::where('identifier', '=', $context->getCollectorID());
        if(!$collector->exists()){
            return new ValidationResult(ValidationResult::FAILED, 'Brak wolontariusza o takim identyfikatorze.');
        }
        $context->setCollector($collector->first());
        return new ValidationResult(ValidationResult::SUCCEED);
    }
}
