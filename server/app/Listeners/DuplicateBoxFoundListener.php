<?php

namespace App\Listeners;

use App\Events\DuplicateBoxFound;
use App\Notifications\DuplicateBoxFoundNotification;
use App\WebhookItNotifiable;

class DuplicateBoxFoundListener
{
    /**
     * Handle the event.
     */
    public function handle(DuplicateBoxFound $event): void
    {
        (new WebhookItNotifiable)->notify(new DuplicateBoxFoundNotification($event->collectorIdentifier, $event->givenBoxes));
    }
}
