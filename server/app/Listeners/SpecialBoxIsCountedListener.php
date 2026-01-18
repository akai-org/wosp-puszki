<?php

namespace App\Listeners;

use App\Events\SpecialBoxIsCounted;
use App\Notifications\SpecialBoxIsCountedNotification;
use App\WebhookNotifiable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpecialBoxIsCountedListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(SpecialBoxIsCounted $event): void
    {
        (new WebhookNotifiable())->notify(new SpecialBoxIsCountedNotification($event->userName, $event->box));
    }
}
