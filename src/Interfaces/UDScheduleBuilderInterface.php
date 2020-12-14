<?php


namespace Futur\UDSchedule\Interfaces;


interface UDScheduleBuilderInterface
{
    public function forScheduler(UDSchedulerInterface $scheduler) : UDScheduleBuilderInterface;

    public function withSchedulable(string $schedulable) : UDScheduleBuilderInterface;

    public function monthly(string $value);

    public function weekly(string $value);
}
