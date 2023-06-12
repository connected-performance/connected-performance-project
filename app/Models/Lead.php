<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = "leads";
    public function services(){
        return $this->belongsTo(Service::class, 'fk_service_id');
    }

    public function form()
    {
        return $this->belongsTo(FormBuilder::class, 'form_builder_id');
    }
}
