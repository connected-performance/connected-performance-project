<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    function getService(){
      return $this->hasOne(Lead::class ,'fk_service_id');
    }

    public function invoice_details(){
    return $this->hasMany(InvoiceDetail::class);
    }
}
