<?php

namespace App;

use Illuminate\Support\Facades\Notification;

class WebhookNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    public function routeNotificationForWebhook(Notification $notification): string
    {
        return config('services.discord.webhook');
    }
}
