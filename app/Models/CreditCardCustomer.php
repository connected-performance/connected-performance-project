<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['ccnumber', 'ccexp'];
}
