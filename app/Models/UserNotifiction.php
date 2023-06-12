<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotifiction extends Model
{
    use HasFactory;
    protected $table = 'user_notifications';
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function notifications()
    {
        return $this->belongsTo(Notification::class, 'notification_id')->with('user');
    }

}
