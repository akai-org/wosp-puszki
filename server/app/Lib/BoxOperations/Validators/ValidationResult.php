<?php

namespace App\Lib\BoxOperations\Validators;

class ValidationResult
{
    public const FAILED = true;
    public const SUCCEED = false;

    private bool $status;
    private string $message;

    public function __construct(bool $status, string $message = "")
    {
        $this->status = $status;
        $this->message = $message;
    }

    public function failed(): bool
    {
        return $this->status;
    }

    public function errorMessage(): string
    {
        return $this->message;
    }
}
