<?php


namespace Futur\UDSchedule\Tests\Unit;


use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class GetUDScheduledTest extends TestCase
{
    public function testGetSheduledBySchedulableAfterSetUDScheduleWeekly()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekly('Sunday')
            ->set();

        $this->assertTrue(! empty($scheduler->udScheduledBySchedulable(UDScheduledObject::class)));
    }
}
