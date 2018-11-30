<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ClockInServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('App\DiInterfaces\ClockInDiInterface', 'App\DiServices\ClockInDiService');

    }
}
