<?php


namespace Futur\UDSchedule\Traits;


trait HasExpressionGenerator
{
    protected $expression = ['*', '*', '*', '*', '*'];

    public function monthly($dayOfMonth)
    {
        throw_if(
            !is_numeric($dayOfMonth) || !preg_match("/[^1-31]/", $dayOfMonth),
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
    }

    public function weekly($dayOfWeek)
    {
        switch ($dayOfWeek){
            case 'Sunday':
                $dayOfWeek = 0;
                break;
            case 'Monday':
                $dayOfWeek = 1;
                break;
            case 'Tuesday':
                $dayOfWeek = 2;
                break;
            case 'Wednesday':
                $dayOfWeek = 3;
                break;
            case 'Thursday':
                $dayOfWeek = 4;
                break;
            case 'Friday':
                $dayOfWeek = 5;
                break;
            case 'Saturday':
                $dayOfWeek = 6;
                break;
            default:
                throw new \Exception('Wrong day of week');
        }

        $this->expression = [
            '*', '*', '*', '*', $dayOfWeek
        ];

        return $this;
    }

    public function weekdays()
    {
        $this->expression = [
            '*', '*', '*', '*', '1-5'
        ];
    }

    public function weekends()
    {
        $this->expression = [
            '*', '*', '*', '*', '6,0'
        ];
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
