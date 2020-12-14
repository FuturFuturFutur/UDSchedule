<?php


namespace Futur\UDSchedule\Services;


use Futur\UDSchedule\Interfaces\UDScheduleListenerInterface;
use Futur\UDSchedule\Models\UDScheduledExpression;

class UDScheduleListener implements UDScheduleListenerInterface
{
    public function listen()
    {
        UDScheduledExpression::all()->filter(function($expression)
        {
            return $expression->isDue();
        })->each(function($expression){
            $schedulable_type = $expression->schedulable;
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
