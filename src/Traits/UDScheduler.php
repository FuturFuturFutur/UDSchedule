<?php


namespace Futur\UDSchedule\Traits;

use Futur\UDSchedule\Models\Expression;
use Futur\UDSchedule\Facades\UDSchedule;

trait UDScheduler
{
    public function expressions()
    {
        return $this->morphMany(Expression::class, 'scheduler');
    }

    public function setUDSchedule(string $schedulable, string $type, string $value = null){
        $expression = new Expression([
            'expression' => UDSchedule::generateExpression($type, $value),
            'schedulable' => $schedulable
        ]);

        $this->expressions()->save($expression);
    }
}
