<?php


namespace Futur\UDSchedule\Traits;

use Futur\UDSchedule\Models\UDScheduledExpression;
use Futur\UDSchedule\Facades\UDSchedule;

trait UDScheduler
{
    public function udScheduledExpressions()
    {
        return $this->morphMany(UDScheduledExpression::class, 'scheduler');
    }
}
