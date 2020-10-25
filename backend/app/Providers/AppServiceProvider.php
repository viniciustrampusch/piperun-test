<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\UserServiceInterface',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CalendarRepositoryInterface',
            'App\Repositories\Eloquent\CalendarRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\CalendarServiceInterface',
            'App\Services\CalendarService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
