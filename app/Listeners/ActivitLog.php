<?php

namespace App\Listeners;

use App\Events\ActivityLog;
use App\Models\ActivityLog as ModelsActivityLog;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivitLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ActivityLog  $event
     * @return void
     */
    public function handle(ActivityLog $event)
    {
        //
        $mytime = Carbon::now();
        $date =   $mytime->toDateTimeString();
        $log = new ModelsActivityLog();
        $log->name = $event->acivity['name'];
        $log->user_id = $event->acivity['user_id'];
        $log->event_name = $event->acivity['event_name'];
        $log->actor = $event->acivity['actor'];
        $log->email = $event->acivity['email'];
        $log->url = $event->acivity['url'];
        $log->description = $event->acivity['description'];
        $log->date_time = $date;
        $log->save();

    }
}
