<?php

namespace App;

class WebhookNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    public function routeNotificationForWebhook($notification)
    {
        return config('services.discord.webhook');
    }
}
