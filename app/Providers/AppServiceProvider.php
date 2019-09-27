<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; /* Lecture 16 */

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Lecture 16 */
        // placeholder = path to the actual image
        View::composer('frontend.*', function ($view) {
            $view->with('placeholder', asset('images/placeholder.jpg'));
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Lecture 13 */
        $this->app->bind(\App\Enjoythetrip\Interfaces\FrontendRepositoryInterface::class,function()
        {
            return new \App\Enjoythetrip\Repositories\FrontendRepository;
        });


        /* Lecture 27 */
        $this->app->bind(\App\Enjoythetrip\Interfaces\BackendRepositoryInterface::class,function()
        {
            return new \App\Enjoythetrip\Repositories\BackendRepository;
        });
    }
}
