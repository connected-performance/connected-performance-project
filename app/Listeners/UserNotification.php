<?php

namespace App\Listeners;

use App\Events\Notificaion;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotifiction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserNotification
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
     * @param  \App\Events\Notification  $event
     * @return void
     */
    public function handle(Notificaion $event)
    {
        //
// dd($event->notification);
        $notifiction = new Notification();
        $notifiction->user_id = $event->notification['user_id'];
        $notifiction->title = $event->notification['title'];
        $notifiction->description = $event->notification['description'];
        $notifiction->save();
        $admin = User::where('is_admin',true)->get();
        foreach($admin as $value){
            $user = new UserNotifiction();
            $user->user_id =  $value->id;
            $user->notification_id = $notifiction->id;
            $user->save();
        }
    
    }
}
