<?php


namespace Futur\UDSchedule\Services;


class UDSchedulerExpressionInterpreter
{
    public static function interpreter($expression)
    {
        $export = [];
        $elements = explode(' ', $expression);

        if(strpos($expression, 'LAST_DAY_OF_MONTH') !== false){
            $export['type'] = 'lastDayOfMonth';
        }elseif($elements[2] !== '*'){
            $export['type'] = 'monthly';
            $export['value'] = $elements[2];
        }elseif($elements[4] !== '*'){
            if($elements[4] === '1-5'){
                $export['type'] = 'weekdays';
            }elseif ($elements[5] === '6,0'){
                $export['type'] = 'weekends';
            }else{
                $export['type'] = 'weekly';
                $export['value'] = UDScheduleHelpers::getDayOfWeekByNumber($elements[4]);
            }
        }elseif ($elements[2] === '*' && $elements[3] === '*' && $elements[4] === '*')
        {
            $export['type'] = 'daily';
        }else{
            $export['type'] = 'Unknown';
            $export['expression'] = $expression;
        }

        if($elements[0] !== '*' && $elements[1] !== '*'){
            $export['at'] = $elements[1] . ':' .$elements[0];
        }

        return $export;
    }
}
