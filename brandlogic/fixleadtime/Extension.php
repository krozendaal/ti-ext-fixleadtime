<?php 

namespace Brandlogic\FixLeadTime;

use Event;
use Igniter\Flame\Exception\ApplicationException;
use System\Classes\BaseExtension;
use Igniter\Local\Facades\Location;
use Carbon\Carbon;

/**
 * Fix LeadTime Extension Information File
 */
class Extension extends BaseExtension
{
    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {   
        Event::listen('igniter.workingSchedule.timeslotValid', function ($workingSchedule, $timeslot) {
            $orderLeadTime = Location::current()->getOption($workingSchedule->getType() . '_lead_time');
            return !(Carbon::now()->diffInMinutes($timeslot) < $orderLeadTime);
        });
    }
}