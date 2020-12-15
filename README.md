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
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->...
            ->set();
``` 

Available schedule methods:
- <b>monthly</b> with <b>any day of a month</b> as a value<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->monthly(23)
            ->set();
``` 
- <b>weekly</b> with <b>any day of a week</b> as a value<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekly('Sunday')
            ->set();
``` 
- <b>daily</b> with <b>time (HH:MM)</b> as a value<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->daily('12:05')
            ->set();
``` 
- <b>at</b> with <b>time (HH:MM)</b> as a value, to specify time of schedule<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekly('Monday')
            ->at('14:23')
            ->set();
``` 
- <b>weekdays</b><br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekdays()
            ->set();
``` 
- <b>weekends</b><br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->weekends()
            ->set();
``` 
- <b>lastDayOfMonth</b><br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->lastDayOfMonth()
            ->set();
``` 
- <b>custom</b> expression if you want to specify cron expression by your own<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->custom('00 23 * * *')
            ->set();
``` 
- <b>timezone</b> specify timezone of user defining schedule<br>
```
UDSchedule::schedule()
            ->forScheduler($scheduler)
            ->withSchedulable(UDScheduledObject::class)
            ->custom('00 23 * * *')
            ->timezone('MST')
            ->set();
``` 
