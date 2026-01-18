<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use NotificationChannels\Webhook\WebhookChannel;
use NotificationChannels\Webhook\WebhookMessage;

class HelpRequestedNotification extends Notification
{
    private string $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(): array
    {
        return [WebhookChannel::class];
    }

    public function toWebhook(): WebhookMessage
    {
        return WebhookMessage::create()
            ->data(['username' => 'WOŚP Helper Bot',
                'content' => "🚨 **Nowa prośba o pomoc!**",
                'embeds' => [
                    [
                        'description' => "Użytkownik {$this->userName} woła o pomoc!",
                        'color' => 7506394,
                        'timestamp' => Carbon::now()->toIso8601String(),// Decimal color code (not Hex)
                        'fields' => $this->getFields()
                    ]
                ]])
            ->header('Content-Type', 'application/json');
    }

    private function getFields(): array
    {
        if (preg_match('/(\d{2})$/', $this->userName, $matches)) {
            return [
                [
                    'name' => 'Stanowisko',
                    'value' => $matches[1],
                    'inline' => true
                ]
            ];
        }
        return [];
    }
}
