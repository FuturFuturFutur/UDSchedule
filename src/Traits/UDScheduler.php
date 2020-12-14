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
}
