<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class WebhookItNotifiable
{
    use Notifiable;

    public function routeNotificationForWebhook(Notification $notification): string
    {
        return config('services.discord.it_webhook');
    }
}
