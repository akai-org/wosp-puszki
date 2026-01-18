<?php

namespace App\Listeners;

use App\Events\HelpResolved;
use App\Notifications\HelpResolvedNotification;
use App\WebhookNotifiable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDiscordHelpResolved implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(HelpResolved $event): void
    {
        (new WebhookNotifiable)->notify(new HelpResolvedNotification($event->userName));
    }
}
