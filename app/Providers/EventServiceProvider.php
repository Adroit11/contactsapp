<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Api\ValidationFailed' => [
            'App\Listeners\Api\ReturnValidationErrors',
        ],
        'App\Events\Api\ObjectCreated' => [
            'App\Listeners\Api\ReturnCreated'
        ],
        'App\Events\Api\ObjectFound' => [
            'App\Listeners\Api\ReturnFound',
        ],
        'App\Events\Api\ObjectUpdated' => [
            'App\Listeners\Api\ReturnUpdated',
        ],
        'App\Events\Api\ObjectDeleted' => [
            'App\Listeners\Api\ReturnOk',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
