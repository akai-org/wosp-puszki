<?php

namespace App\Lib\BoxOperations\Validators;

use App\Collector;

class ValidationContext
{
    private ?int $collectorID;
    private ?Collector $collector;

    public function __construct(int $collectorID)
    {
        $this->collectorID = $collectorID;
    }

    public function getCollectorID(): ?int
    {
        return $this->collectorID;
    }

    public function getCollector(): ?Collector
    {
        return $this->collector;
    }

    public function setCollector(Collector $collector): void
    {
        $this->collector = $collector;
    }
}
