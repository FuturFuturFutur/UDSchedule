<?php


namespace Futur\UDSchedule;

use Futur\UDSchedule\Interfaces\UDScheduleBuilderInterface;
use Futur\UDSchedule\Interfaces\UDScheduleListenerInterface;
use Futur\UDSchedule\Services\UDSchedulerExpressionInterpreter;

class UDSchedule
{
    /**
     * @var UDScheduleBuilderInterface
     */
    private $UDScheduleBuilder;

    /**
     * @var UDScheduleListenerInterface
     */
    private $UDScheduleListener;

    public function __construct(
        UDScheduleBuilderInterface $UDScheduleBuilder,
        UDScheduleListenerInterface $UDScheduleListener
    )
    {
        $this->UDScheduleBuilder = $UDScheduleBuilder;
        $this->UDScheduleListener = $UDScheduleListener;
    }

    public function schedule() : UDScheduleBuilderInterface
    {
        return $this->UDScheduleBuilder;
    }

    public function listenScheduled()
    {
        $this->UDScheduleListener->listen();
    }

    public function interpretExpression($expression)
    {
        return UDSchedulerExpressionInterpreter::interpreter($expression);
    }
}
