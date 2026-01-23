<?php

namespace App\Providers;

use App\Events\DuplicateBoxFound;
use App\Events\HelpRequested;
use App\Events\HelpResolved;
use App\Events\SpecialBoxIsCounted;
use App\Listeners\DuplicateBoxFoundListener;
use App\Listeners\SendDiscordHelpRequest;
use App\Listeners\SendDiscordHelpResolved;
use App\Listeners\SpecialBoxIsCountedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        HelpRequested::class => [
            SendDiscordHelpRequest::class,
        ],
        HelpResolved::class => [
            SendDiscordHelpResolved::class,
        ],
        SpecialBoxIsCounted::class => [
            SpecialBoxIsCountedListener::class,
        ],
        DuplicateBoxFound::class => [
            DuplicateBoxFoundListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
