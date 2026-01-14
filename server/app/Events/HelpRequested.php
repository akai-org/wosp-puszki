<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HelpRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stationNumber;

    public function __construct(int $stationNumber)
    {
        $this->stationNumber = $stationNumber;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('help-center'),
        ];
    }
}