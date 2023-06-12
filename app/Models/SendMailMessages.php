<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMailMessages extends Model
{
    use HasFactory;
    protected $table = "mail_messages_jobs";
    protected $guarded = [];
    
}
