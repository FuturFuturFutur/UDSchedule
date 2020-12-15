<?php
namespace Futur\UDSchedule\Tests\Unit;

use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class SetUDScheduleTest extends TestCase
{
    public function testSetUDScheduleMonthly()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->monthly(3)
            ->set();

        $this->assertTrue(! $scheduler->udScheduled->isEmpty());
    }

    public function testSetUDScheduleWeekly()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekly('Sunday')
            ->set();

        $this->assertTrue(! $scheduler->udScheduled->isEmpty());
    }

    public function testSetUDScheduleLastDayOfMonthAtLaunch()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->lastDayOfMonth()
            ->at('12:00')
            ->set();

        $this->assertTrue($scheduler->udScheduledBySchedulable(UDScheduledObject::class)->expression === '00 12 LAST_DAY_OF_MONTH');
    }

    public function testSetUDScheduleCustomExpression()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->custom('* * * * *')
            ->set();

        $this->assertTrue($scheduler->udScheduledBySchedulable(UDScheduledObject::class)->expression === '* * * * *');
    }

    public function testSetUDScheduleMonthlyWithWrongValue()
    {
        $scheduler = Scheduler::first();

        try {
            UDSchedule::schedule()
                ->forScheduler($scheduler)
                ->withSchedulable(UDScheduledObject::class)
                ->monthly(50)
                ->set();
        }catch (\Exception $exception){
            $this->assertTrue(
                'Wrong day of month' === $exception->getMessage()
            );
        }
    }

    public function testSetUDScheduleWeeklyWithWrongValue()
    {
        $scheduler = Scheduler::first();

        try {
            UDSchedule::schedule()
                ->forScheduler($scheduler)
                ->withSchedulable(UDScheduledObject::class)
                ->weekly('Doesntexistsday')
                ->set();
        }catch (\Exception $exception){
            $this->assertTrue(
                'Wrong day of week' === $exception->getMessage()
            );
        }
    }
}
