<?php


namespace Futur\UDSchedule\Interfaces;


interface UDScheduleBuilderInterface
{
    public function forScheduler(UDSchedulerInterface $scheduler) : UDScheduleBuilderInterface;

    public function withSchedulable(string $schedulable) : UDScheduleBuilderInterface;

    public function monthly($dayOfMonth);

    public function lastDayOfMonth();

    public function weekly($dayOfWeek);

    public function weekdays();

    public function weekends();

    public function daily($time);

    public function at($time);

    public function custom($expression);

    public function timezone($timezone);
}
