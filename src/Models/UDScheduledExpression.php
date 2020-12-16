<?php

namespace Futur\UDSchedule\Models;

use Cron\CronExpression;
use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UDScheduledExpression extends Model
{
    use ManagesFrequencies;

    protected $table = 'udscheduled_expressions';

    protected $fillable = ['expression', 'schedulable', 'timezone'];

    public function scheduler()
    {
        return $this->morphTo();
    }

    public function schedulable()
    {
        return $this->schedulable;
    }

    public function isDue(){
        $date = Carbon::now();

        if ($this->timezone) {
            $date->setTimezone($this->timezone);
        }

        if(strpos($this->expression, 'LAST_DAY_OF_MONTH') !== false){
            $expression = explode(' ', $this->expression);
            $lastDayOfMonth = (new Carbon('last day of last month'))
                ->setTime($expression[1], $expression[0])
                ->setTimezone($this->timezone);
            return $lastDayOfMonth->equalTo($date);
        }

        return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
    }
}
