<?php


namespace Futur\UDSchedule\Tests\Unit;


use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Models\UDScheduledExpression;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class ListenUDScheduledTest extends TestCase
{
    public function testListenUDScheduled()
    {
        $scheduler = Scheduler::first();

        $scheduler->udScheduled()->save(new UDScheduledExpression([
            'expression' => '* * * * *',
            'schedulable' => UDScheduledObject::class
        ]));

        ob_start();
        UDSchedule::listenScheduled();
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(
            $result === 'Successfully processed UDScheduled task for scheduler with email - ' . $scheduler->email
        );
    }

    public function testListenUDScheduledWithTimeZone()
    {
        $scheduler = Scheduler::first();

        $scheduler->udScheduled()->save(new UDScheduledExpression([
            'expression' => '* * * * *',
            'schedulable' => UDScheduledObject::class,
            'timezone' => 'MST'
        ]));

        ob_start();
        UDSchedule::listenScheduled();
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(
            $result === 'Successfully processed UDScheduled task for scheduler with email - ' . $scheduler->email
        );
    }

    public function testListenUDScheduledTestWithNotDueExpression()
    {
        $scheduler = Scheduler::first();
        $scheduler->udScheduled()->save(new UDScheduledExpression([
            'expression' => '59 23 4 * 2',
            'schedulable' => UDScheduledObject::class
        ]));

        ob_start();
        UDSchedule::listenScheduled();
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(
            $result !== 'Successfully processed UDScheduled task for scheduler with email - ' . $scheduler->email
        );
    }
}
