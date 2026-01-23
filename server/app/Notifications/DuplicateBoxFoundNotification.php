<?php

namespace App\Notifications;

use App\CharityBox;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;
use NotificationChannels\Webhook\WebhookChannel;
use NotificationChannels\Webhook\WebhookMessage;

class DuplicateBoxFoundNotification extends Notification
{
    use Queueable;

    private string $collectorIdentifier;

    /**
     * @var Collection<int, CharityBox>
     */
    private Collection $givenBoxes;

    /**
     * Create a new notification instance.
     *
     * @param  Collection<int, CharityBox>  $givenBoxes
     */
    public function __construct(string $collectorIdentifier, Collection $givenBoxes)
    {
        $this->collectorIdentifier = $collectorIdentifier;
        $this->givenBoxes = $givenBoxes;
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
            ->data(['username' => 'WOŚP IT Alert',
                'content' => '⚠️ **Wydano wiele puszek dla wolontariusza!**',
                'embeds' => [
                    [
                        'description' => "Wolontariuszowi $this->collectorIdentifier wydano więcej niż 1 puszkę na raz!",
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
        return $this->givenBoxes->map(function ($box) {
            return [
                'name' => 'Godzina wydania',
                'value' => $box->time_given,
                'inline' => true,
            ];
        })->toArray();
    }
}
