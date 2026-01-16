<?php

namespace App\Providers;

use App\Events\HelpRequested;
use App\Events\HelpResolved;
use App\Listeners\SendDiscordHelpRequest;
use App\Listeners\SendDiscordHelpResolved;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        HelpRequested::class => [
            SendDiscordHelpRequest::class
        ],
        HelpResolved::class => [
            SendDiscordHelpResolved::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
