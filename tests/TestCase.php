<?php

namespace Futur\UDSchedule\Tests;

use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\UDScheduleServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\DB;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadMigrationsFrom(__DIR__ . '../Tests/Migrations');
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->seedDataBase();
    }

    protected function getPackageProviders($app)
    {
        return [
            UDScheduleServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    private function seedDataBase()
    {
        $scheduler = new Scheduler([
            'name' => 'Scheduler',
            'email' => 'scheduler@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'askj34ju3ij2kkdsod22',
        ]);
        $scheduler->save();
    }
}
