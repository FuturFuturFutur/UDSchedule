<?php


namespace Futur\UDSchedule;


use App\Models\User;
use Futur\UDSchedule\Models\Expression;

class UDSchedule
{
    public function generateExpression($type, $value = null){
        $templates = [
            'monthly' => [
                'value' => true,
                'temp' => '0 12 %d * *',
                'value_validation' => '1-31',
            ],
            'weekly' => [
                'value' => true,
                'temp' => '0 12 * * %d',
                'value_validation' => '0-6',
            ],
            'last_day_of_month' => [
                'value' => false,
                'temp' => 'LAST_DAY_OF_MONTH',
            ],
        ];

        throw_if(!isset($templates[$type]), new \Exception('Wrong schedule type'));

        if($templates[$type]['value']) {
            $rules = explode('-', $templates[$type]['value_validation']);
            throw_if($value < $rules[0] || $value > $rules[1], new \Exception('Wrong value range'));
        }

        return
            $templates[$type]['value']
                ? sprintf($templates[$type]['temp'], $value)
                : $templates[$type]['temp'];
    }

    public function listenExpressions()
    {
        Expression::all()->filter(function($expression)
        {
            return $expression->isDue();
        })->each(function($expression){
            $schedulable_type = $expression->getSchedulable();
            try {
                $schedulable = new $schedulable_type;
            }catch (\Exception $exception){
                throw new \Exception('Wrong schedulable entity was provided');
            }
            try {
                $schedulable->doUDScheduled($expression->scheduler);
            }catch (\Exception $exception){
                throw new \Exception('No valid UDScheduled method was provided for schedulable entity');
            }
        });
    }
}
