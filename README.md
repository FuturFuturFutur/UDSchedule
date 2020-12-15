### UDSchedule
User Definable Schedule is the laravel package which allows you to create user defined schedule tasks.
```Futur with love <3```

## Installation
Install via composer <br>
```composer require futur/udschedule```

Migrate package migration with expressions table<br>
```php artisan migrate```

Define scheduler model
<pre>
...

use Futur\UDSchedule\Interfaces\UDSchedulerInterface;
use Futur\UDSchedule\Traits\UDScheduler;

class User extends Authenticatable <u><b>implements UDSchedulerInterface</b></u>
{
    use HasFactory, Notifiable, <u><b>UDScheduler</b></u>;

    ...
</pre>

Define scheduled class, could be any class implementing UDSchedulable interface, such a model or class stored in ```app\Scheduled``` folder, etc

<pre>
...

use Futur\UDSchedule\Interfaces\UDSchedulable;
use Futur\UDSchedule\Interfaces\UDSchedulerInterface;

class Report <u><b>implements UDSchedulable</b></u>
{
    public function doUDScheduled(UDSchedulerInterface $UDScheduler)
    {
        //Define anything you want to shedule here
        //Sending email reminders, etc.
    }

    ...
}
</pre>

## Usage
After installation, everything you need is setting user defined schedules using UDSchedule facade:
```
UDSchedule::setSchedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->...;
``` 

Available schedule types:
- <b>monthly</b> as a type and <b>any day of a month</b> as a value<br>
```
UDSchedule::setSchedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->monthly(23);
``` 
- <b>weekly</b> as a type and <b>any day of a week</b> as a value, where 0 is for Sunday and 6 is for Saturday<br>
```
UDSchedule::setSchedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekly(5);
``` 
