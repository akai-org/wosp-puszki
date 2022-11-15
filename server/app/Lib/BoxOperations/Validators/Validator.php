<?php

namespace App\Lib\BoxOperations\Validators;

abstract class Validator
{
    protected ?Validator $next;

    public function validate(ValidationContext $context): ValidationResult {
        $result = $this->
        resolve($context);
        if ($result->failed()) {
            return $result;
        }
        if (!is_null($this->next)) {
            return $this->next->validate($context);
        }
        return $result;
    }

    public function setNext(Validator $validator): void {
        $this->next = $validator;
    }

    abstract protected function resolve(ValidationContext $context): ValidationResult;
}