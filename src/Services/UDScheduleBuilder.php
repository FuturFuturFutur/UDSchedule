<?php


namespace Futur\UDSchedule\Services;

use Futur\UDSchedule\Interfaces\UDScheduleBuilderInterface;
use Futur\UDSchedule\Interfaces\UDSchedulerInterface;
use Futur\UDSchedule\Models\UDScheduledExpression;
use Futur\UDSchedule\Traits\HasExpressionGenerator;

class UDScheduleBuilder implements UDScheduleBuilderInterface
{
    use HasExpressionGenerator;

    private $scheduler;
    private $schedulable;

    protected $expression = ['*', '*', '*', '*', '*'];
    protected $timezone = null;

    public function forScheduler(UDSchedulerInterface $scheduler): UDScheduleBuilderInterface
    {
        $this->scheduler = $scheduler;
        return $this;
    }

    public function withSchedulable(string $schedulable): UDScheduleBuilderInterface
    {
        $this->schedulable = $schedulable;
        return $this;
    }

    public function timezone($timezone)
    {
        $this->timezone = $timezone;
    }

    public function set()
    {
        $this->scheduler->udScheduled()->updateOrCreate([
            'schedulable' => $this->schedulable,
        ], [
            'expression' => implode(' ', $this->expression),
            'timezone' => $this->timezone,
        ]);
    }
}
