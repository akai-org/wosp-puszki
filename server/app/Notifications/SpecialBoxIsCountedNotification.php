<?php

namespace App\Notifications;

use App\CharityBox;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Webhook\WebhookChannel;
use NotificationChannels\Webhook\WebhookMessage;

class SpecialBoxIsCountedNotification extends Notification
{
    use Queueable;

    private string $username;

    private CharityBox $box;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $username, CharityBox $box)
    {
        $this->username = $username;
        $this->box = $box;
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
                'content' => '⭐ Puszka specjalna pojawiła się w sztabie',
                'embeds' => [
                    [
                        'description' => "Użytkownik {$this->username} liczy puszkę wolontariusza {$this->box->collector->identifier}",
                        'color' => 7506394,
                        'timestamp' => Carbon::now()->toIso8601String(), // Decimal color code (not Hex)
                        'fields' => $this->getFields(),
                    ],
                ]])
            ->header('Content-Type', 'application/json');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getFields(): array
    {
        if (preg_match('/(\d{2})$/', $this->username, $matches)) {
            return [
                [
                    'name' => 'Stanowisko',
                    'value' => $matches[1],
                    'inline' => true,
                ],
            ];
        }

        return [[]];
    }
}
