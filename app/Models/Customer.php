<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'is_converted',
        'convert_date',
        'convert_reason'
    ];


    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function referral()
    {
        return   $this->belongsTo(User::class,'referral_id','id');
       
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,);
    }

   
}
