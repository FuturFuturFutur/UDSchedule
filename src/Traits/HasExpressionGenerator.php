<?php


namespace Futur\UDSchedule\Traits;


use Futur\UDSchedule\Services\UDScheduleHelpers;

trait HasExpressionGenerator
{
    protected $expression = ['*', '*', '*', '*', '*'];

    public function monthly($dayOfMonth)
    {
        throw_if(
            !is_numeric($dayOfMonth)
            || ($dayOfMonth < 1) || ($dayOfMonth > 31),
            new \Exception('Wrong day of month')
        );

        $this->expression = [
            '*', '*', $dayOfMonth, '*', '*'
        ];

        return $this;
    }

    public function lastDayOfMonth()
    {
        $this->expression = [
            '*', '*', 'LAST_DAY_OF_MONTH'
        ];

        return $this;
    }

    public function weekly($dayOfWeek)
    {
        $this->expression = [
            '*', '*', '*', '*', UDScheduleHelpers::getNumberByDayOfWeek($dayOfWeek)
        ];

        return $this;
    }

    public function weekdays()
    {
        $this->expression = [
            '*', '*', '*', '*', '1-5'
        ];

        return $this;
    }

    public function weekends()
    {
        $this->expression = [
            '*', '*', '*', '*', '6,0'
        ];

        return $this;
    }

    public function daily($time)
    {
        $this->expression = [
            '*', '*', '*', '*', '*'
        ];

        return $this->at($time);
    }

    public function at($time)
    {
        throw_if(
            !preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time),
            new \Exception('Wrong time format')
        );
        $time = explode(':', $time);
        $this->expression[0] = $time[1];
        $this->expression[1] = $time[0];

        return $this;
    }

    public function custom($expression)
    {
        $this->expression = explode(' ', $expression);

        return $this;
    }
}
