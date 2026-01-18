<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use function App\totalCollectedReal;

class BoxConfirmed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array{amount_PLN: string, amount_EUR: string, amount_GBP: string, amount_USD: string, rates: float[], amount_total_in_PLN: string, collectors_in_city: int}
     */
    public array $total;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->total = totalCollectedReal();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('box-confirmations');
    }
}
