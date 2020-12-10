<?php


namespace Futur\UDSchedule\Interfaces;


interface UDSchedulerInterface
{
    public function expressions();

    public function setUDSchedule(string $schedulable, string $type, string $value = null);
}
