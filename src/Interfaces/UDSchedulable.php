<?php


namespace Futur\UDSchedule\Interfaces;


interface UDSchedulable
{
    public function doUDScheduled(UDSchedulerInterface $UDScheduler);
}
