<?php


namespace Futur\UDSchedule;


use App\Models\User;
use Futur\UDSchedule\Models\Expression;

class UDSchedule
{
    public static function generateExpression($type, $value = null){
        $templates = [
            'monthly' => [
                'ready' => false,
                'temp' => '0 12 %d * *',
            ],
            'weekly' => [
                'ready' => false,
                'temp' => '0 12 * * %d',
            ],
            'last_day_of_month' => [
                'ready' => true,
                'temp' => 'LAST_DAY_OF_MONTH',
            ],
        ];

        return
            $templates[$type]['ready']
                ? $templates[$type]['temp']
                : sprintf($templates[$type]['temp'], $value);
    }

    public static function listenExpressions()
    {
        Expression::all()->filter(function($expression)
        {
            return $expression->isDue();
        })->each(function($expression){
            $schedulable_type = $expression->getSchedulable();
            $schedulable = new $schedulable_type;
            $schedulable->sendUDScheduled($expression->scheduler);
        });
    }
}
