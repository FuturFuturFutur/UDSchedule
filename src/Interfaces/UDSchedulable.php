<?php


namespace Futur\UDSchedule\Interfaces;


interface UDSchedulable
{
    public function sendUDScheduled(UDSchedulerInterface $UDScheduler);
}
