<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    /* Lecture 54 */
    protected $listen = [
        'App\Events\OrderPlacedEvent' => [
            'App\Listeners\OrderPlacedEventListener',
        ],
        'App\Events\ReservationConfirmedEvent' => [
            'App\Listeners\ReservationConfirmedListener',
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

        //
    }
}
