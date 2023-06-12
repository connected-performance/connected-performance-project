<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $table = "trainers";
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
