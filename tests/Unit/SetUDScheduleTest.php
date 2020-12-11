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

        $scheduler->setUDSchedule(UDScheduledObject::class, 'weekly', 2);

        $this->assertTrue(! $scheduler->expressions->isEmpty());
    }

    public function testSetUDScheduleWithWrongType()
    {
        $scheduler = Scheduler::first();

        try {
            $scheduler->setUDSchedule(UDScheduledObject::class, 'wrong', 2);
        }catch (\Exception $exception){
            $this->assertTrue(
                'Wrong schedule type' === $exception->getMessage()
            );
        }
    }

    public function testSetUDScheduleWithWrongValue()
    {
        $scheduler = Scheduler::first();

        try {
            $scheduler->setUDSchedule(UDScheduledObject::class, 'weekly', 50);
        }catch (\Exception $exception){
            $this->assertTrue(
                'Wrong value range' === $exception->getMessage()
            );
        }
    }
}
