<?php

namespace App\Listeners;

use App\Events\BoxConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class onBoxConfirmed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BoxConfirmed  $event
     * @return void
     */
    public function handle(BoxConfirmed $event)
    {
        //
    }
}
