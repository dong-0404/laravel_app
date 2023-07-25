<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserActivityLogger;

class UserActivityLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\UserActivityLogger', function () {
            return new UserActivityLogger('user_activity.log');  // log name
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
