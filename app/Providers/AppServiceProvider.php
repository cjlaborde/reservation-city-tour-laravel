<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; /* Part 16 */
use Illuminate\Support\Facades\App; /* Part 34 */

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Part 49 */
        View::composer('backend.*', '\App\Enjoythetrip\ViewComposers\BackendComposer');


        /* Part 16 */
        // placeholder = path to the actual image
        View::composer('frontend.*', function ($view) {
            $view->with('placeholder', asset('images/placeholder.jpg'));
            });

        /* Part 34 */
        if (App::environment('local'))
        {

           View::composer('*', function ($view) {
            $view->with('novalidate', 'novalidate');
            });

        }
        else
        {
            View::composer('*', function ($view) {
            $view->with('novalidate', null);
            });
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /* Part 55 */
        if (App::environment('local'))
        {

            /* Part 13 */
            $this->app->bind(\App\Enjoythetrip\Interfaces\FrontendRepositoryInterface::class,function()
            {
                return new \App\Enjoythetrip\Repositories\FrontendRepository;
            });

        }
        else
        {

            $this->app->bind(\App\Enjoythetrip\Interfaces\FrontendRepositoryInterface::class,function()
            {
                return new \App\Enjoythetrip\Repositories\CachedFrontendRepository;
            });

        }


        /* Part 27 */
        $this->app->bind(\App\Enjoythetrip\Interfaces\BackendRepositoryInterface::class,function()
        {
            return new \App\Enjoythetrip\Repositories\BackendRepository;
        });
    }
}
