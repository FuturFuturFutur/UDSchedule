<?php

namespace Futur\UDSchedule;

use Futur\UDSchedule\Interfaces\UDScheduleBuilderInterface;
use Futur\UDSchedule\Interfaces\UDScheduleListenerInterface;
use Futur\UDSchedule\Services\UDScheduleBuilder;
use Futur\UDSchedule\Services\UDScheduleListener;
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
        $this->app->bind(UDScheduleBuilderInterface::class, UDScheduleBuilder::class);
        $this->app->bind(UDScheduleListenerInterface::class, UDScheduleListener::class);
        $this->app->bind('UDSchedule', UDSchedule::class);
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
                UDSchedule::listenScheduled();
            })->everyMinute();
        });
    }
}
