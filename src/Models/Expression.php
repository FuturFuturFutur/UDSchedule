<?php

namespace Futur\UDSchedule\Models;

use App\Models\User;
use Cron\CronExpression;
use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Expression extends Model
{
    use HasFactory, ManagesFrequencies;

    protected $fillable = ['expression', 'schedulable'];

    public function scheduler()
    {
        return $this->morphTo();
    }

    public function getSchedulable()
    {
        return $this->schedulable;
    }

    public function isDue(){
        switch ($this->expression){
            case 'LAST_DAY_OF_MONTH':
                return gmdate('H:i t') == '12:00 ' . gmdate('d');
            default:
                $date = Carbon::now();
                return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
        }
    }
}
