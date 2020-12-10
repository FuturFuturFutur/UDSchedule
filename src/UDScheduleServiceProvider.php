<?php

namespace Futur\UDSchedule;

use Futur\UDSchedule\Models\Expression;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class UDScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Futur\UDSchedule\UDSchedule');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->call(function () {
                UDSchedule::listenExpressions();
            })->everyMinute();
        });
    }
}
