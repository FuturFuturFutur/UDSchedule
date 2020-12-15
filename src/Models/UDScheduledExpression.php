<?php

namespace Futur\UDSchedule\Models;

use Cron\CronExpression;
use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UDScheduledExpression extends Model
{
    use HasFactory, ManagesFrequencies;

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

        return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
    }
}
