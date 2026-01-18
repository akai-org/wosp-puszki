<?php

namespace App\Listeners;

use App\Events\HelpRequested;
use App\Notifications\HelpRequestedNotification;
use App\WebhookNotifiable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDiscordHelpRequest implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(HelpRequested $event): void
    {
        (new WebhookNotifiable())->notify(new HelpRequestedNotification($event->userName));
    }
}
