<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCharge extends Model
{
    use HasFactory;
    protected $table = 'ectra_charges';
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
