<?php


namespace Futur\UDSchedule;

use Futur\UDSchedule\Interfaces\UDScheduleBuilderInterface;
use Futur\UDSchedule\Interfaces\UDScheduleListenerInterface;
use Futur\UDSchedule\Interfaces\UDSchedulerInterface;
use Futur\UDSchedule\Models\Expression;
use Futur\UDSchedule\Services\UDScheduleBuilder;

class UDSchedule
{
    /**
     * @var UDScheduleBuilderInterface
     */
    private UDScheduleBuilderInterface $UDScheduleBuilder;

    /**
     * @var UDScheduleListenerInterface
     */
    private UDScheduleListenerInterface $UDScheduleListener;

    public function __construct(
        UDScheduleBuilderInterface $UDScheduleBuilder,
        UDScheduleListenerInterface $UDScheduleListener
    )
    {
        $this->UDScheduleBuilder = $UDScheduleBuilder;
        $this->UDScheduleListener = $UDScheduleListener;
    }

    public function setSchedule() : UDScheduleBuilderInterface
    {
        return $this->UDScheduleBuilder;
    }

    public function listenScheduled()
    {
        $this->UDScheduleListener->listen();
    }
}
