<?php
namespace Futur\UDSchedule\Tests\Unit;

use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class SetUDScheduleTest extends TestCase
{
    public function testSetUDSchedule()
    {
        $scheduler = Scheduler::first();

        UDSchedule::setSchedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->monthly(3);

        $this->assertTrue(! $scheduler->expressions->isEmpty());
    }


    public function testSetUDScheduleWithWrongValue()
    {
        $scheduler = Scheduler::first();

        try {
            UDSchedule::setSchedule()
                ->forScheduler($scheduler)
                ->withSchedulable(UDScheduledObject::class)
                ->monthly(50);
        }catch (\Exception $exception){
            $this->assertTrue(
                'Wrong value range' === $exception->getMessage()
            );
        }
    }
}
