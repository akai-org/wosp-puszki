<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class WebhookNotifiable
{
    use Notifiable;

    public function routeNotificationForWebhook(Notification $notification): string
    {
        return config('services.discord.webhook');
    }
}
