<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Reservation' => 'App\Policies\ReservationPolicy', /* Part 35 */
        'App\Photo' => 'App\Policies\PhotoPolicy', /* Part 39 */
        'App\TouristObject' => 'App\Policies\ObjectPolicy', /* Part 43 */
        'App\Article' => 'App\Policies\ArticlePolicy', /* Part 45 */
        'App\Room' => 'App\Policies\RoomPolicy' /* Part 47 */
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
