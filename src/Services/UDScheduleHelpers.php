<?php


namespace Futur\UDSchedule\Services;


class UDScheduleHelpers
{
    public static function getDayOfWeekByNumber($number)
    {
        switch ($number){
            case 0:
                return 'Sunday';
            case 1:
                return 'Monday';
            case 2:
                return 'Tuesday';
            case 3:
                return 'Wednesday';
            case 4:
                return 'Thursday';
            case 5:
                return 'Friday';
            case 6:
                return 'Saturday';
            default:
                throw new \Exception('Wrong day of week');
        }
    }

    public static function getNumberByDayOfWeek($dayOfWeek)
    {
        switch ($dayOfWeek){
            case 'Sunday':
                return 0;
            case 'Monday':
                return 1;
            case 'Tuesday':
                return 2;
            case 'Wednesday':
                return 3;
            case 'Thursday':
                return 4;
            case 'Friday':
                return 5;
            case 'Saturday':
                return 6;
            default:
                throw new \Exception('Wrong day of week');
        }
    }
}
