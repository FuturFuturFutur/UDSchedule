<?php


namespace Futur\UDSchedule\Interfaces;


interface UDSchedulerInterface
{
    public function udScheduled();

    public function udScheduledBySchedulable(string $schedulable);
}
