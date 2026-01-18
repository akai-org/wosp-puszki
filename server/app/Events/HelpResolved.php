<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HelpResolved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }
}
