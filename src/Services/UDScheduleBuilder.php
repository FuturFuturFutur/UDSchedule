<?php


namespace Futur\UDSchedule\Services;

use Futur\UDSchedule\Interfaces\UDScheduleBuilderInterface;
use Futur\UDSchedule\Interfaces\UDSchedulerInterface;
use Futur\UDSchedule\Models\UDScheduledExpression;

class UDScheduleBuilder implements UDScheduleBuilderInterface
{
    private $generator;

    private $scheduler;
    private $schedulable;

    private $expression;

    public function __construct(ExpressionGenerator $generator)
    {
        $this->generator = $generator;
    }

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

    public function monthly(string $value)
    {
        $this->expression = $this->generator->generate('monthly', $value);

        $this->setSchedule();
    }

    public function weekly(string $value)
    {
        $this->expression = $this->generator->generate('weekly', $value);

        $this->setSchedule();
    }

    private function setSchedule()
    {
        $expression = new UDScheduledExpression([
            'expression' => $this->expression,
            'schedulable' => $this->schedulable,
        ]);

        $this->scheduler->udScheduledExpressions()->save($expression);
    }
}
