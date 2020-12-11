<?php


namespace Futur\UDSchedule\Tests\Unit;


use Futur\UDSchedule\Facades\UDSchedule;
use Futur\UDSchedule\Models\Expression;
use Futur\UDSchedule\Tests\Models\Scheduler;
use Futur\UDSchedule\Tests\Scheduled\UDScheduledObject;
use Futur\UDSchedule\Tests\TestCase;

class ListenUDScheduledTest extends TestCase
{
    public function testListenUDScheduledTest()
    {
        $scheduler = Scheduler::first();
        $scheduler->expressions()->save(new Expression([
            'expression' => '* * * * *',
            'schedulable' => UDScheduledObject::class
        ]));

        ob_start();
        UDSchedule::listenExpressions();
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(
            $result === 'Successfully processed UDScheduled task for scheduler with email - ' . $scheduler->email
        );
    }

    public function testListenUDScheduledTestWithNotDueExpression()
    {
        $scheduler = Scheduler::first();
        $scheduler->expressions()->save(new Expression([
            'expression' => '59 23 4 * 2',
            'schedulable' => UDScheduledObject::class
        ]));

        ob_start();
        UDSchedule::listenExpressions();
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(
            $result !== 'Successfully processed UDScheduled task for scheduler with email - ' . $scheduler->email
        );
    }
}
