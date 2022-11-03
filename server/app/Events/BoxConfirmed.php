<?php

namespace App\Events;

use App\CharityBox;
use App\Http\Controllers\AmountDisplayController;
use App\Http\Controllers\CharityBoxController;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BoxConfirmed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $total;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->total = \App\totalCollectedReal();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('box-confirmations');
    }
}
