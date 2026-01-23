<?php

namespace App\Events;

use App\CharityBox;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DuplicateBoxFound
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $collectorIdentifier;

    /**
     * @var Collection<int, CharityBox>
     */
    public Collection $givenBoxes;

    /**
     * @param  Collection<int, CharityBox>  $givenBoxes
     */
    public function __construct(string $collectorIdentifier, Collection $givenBoxes)
    {
        $this->collectorIdentifier = $collectorIdentifier;
        $this->givenBoxes = $givenBoxes;
    }
}
