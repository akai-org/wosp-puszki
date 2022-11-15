<?php

namespace App\Lib\BoxOperations;

class BoxOperationResult
{
    public const KIND_ERROR = "error";
    public const KIND_MESSAGE = "message";
    public const NO_EXECUTION = "no_execution";

    private string $kind;
    private string $message;

    public function __construct(string $kind, string $message = "")
    {
        $this->kind = $kind;
        $this->message = $message;
    }

    public function kind(): string
    {
        return $this->kind;
    }

    public function message(): string
    {
        return $this->message;
    }
}
