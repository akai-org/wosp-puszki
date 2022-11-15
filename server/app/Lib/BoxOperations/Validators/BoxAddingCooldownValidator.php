<?php

namespace App\Lib\BoxOperations\Validators;

use App\Collector;
use Carbon\Carbon;
use TypeError;

class BoxAddingCooldownValidator extends Validator
{
    protected function resolve(ValidationContext $context): ValidationResult
    {
        if (is_null($context->getCollector())) {
            throw new TypeError("no collector has been given to context");
        }
        if ($context->getCollector()->boxes()->count() == 0) {
            return new ValidationResult(ValidationResult::SUCCEED);
        }

        $latestGiven = Collector::with('boxes')->where('identifier', '=', $context->getCollectorID())
            ->first()->boxes()->orderBy('time_given', 'desc')->first(['time_given']);
        $latestTimeGiven = $latestGiven->time_given;
        $carbon = Carbon::parse($latestTimeGiven);
        //TODO FIX to 3600, add admin bypass
        if($carbon->diffInSeconds(Carbon::now()) <= 10 ){
            return new ValidationResult(ValidationResult::FAILED, 'Limit wydawania puszek - jedna na godzinę na wolontariusza');
        }

        return new ValidationResult(ValidationResult::SUCCEED);
    }
}