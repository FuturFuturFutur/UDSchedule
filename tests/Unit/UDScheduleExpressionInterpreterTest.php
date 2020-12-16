<?php


namespace Futur\UDSchedule\Tests\Unit;


use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class UDScheduleExpressionInterpreterTest extends TestCase
{
    public function testInterpreter()
    {
        $scheduler = Scheduler::first();

        UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->monthly(3)
            ->set();

        $scheduled = UDSchedule::interpretExpression(
            $scheduler
                ->udScheduledBySchedulable(UDScheduledObject::class)
                ->expression
        );

        $this->assertTrue($scheduled === [
            'type' => 'monthly',
            'value' => '3'
        ]);
    }
}
