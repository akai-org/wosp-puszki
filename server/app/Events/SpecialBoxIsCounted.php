<?php

namespace App\Events;

use App\CharityBox;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpecialBoxIsCounted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $userName;

    public CharityBox $box;

    /**
     * Create a new event instance.
     */
    public function __construct(string $userName, CharityBox $box)
    {
        $this->userName = $userName;
        $this->box = $box;
    }
}
