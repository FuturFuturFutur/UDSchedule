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
}
