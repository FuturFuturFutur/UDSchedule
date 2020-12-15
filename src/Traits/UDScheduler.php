<?php


namespace Futur\UDSchedule\Traits;

use Futur\UDSchedule\Models\UDScheduledExpression;
use Futur\UDSchedule\Facades\UDSchedule;

trait UDScheduler
{
    public function udScheduled()
    {
        return $this->morphMany(UDScheduledExpression::class, 'scheduler');
    }

    public function udScheduledBySchedulable(string $schedulable)
    {
        return $this->udScheduled()->where('schedulable', $schedulable)->get();
    }
}
