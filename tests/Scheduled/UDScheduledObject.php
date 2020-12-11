<?php
namespace Futur\UDSchedule\Tests\Scheduled;


use Futur\UDSchedule\Interfaces\UDSchedulable;
use Futur\UDSchedule\Interfaces\UDSchedulerInterface;

class UDScheduledObject implements UDSchedulable
{
    public function doUDScheduled(UDSchedulerInterface $UDScheduler)
    {
        echo 'Successfully processed UDScheduled task for scheduler with email - ' . $UDScheduler->email;
    }
}
