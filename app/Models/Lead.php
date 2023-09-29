<?php

namespace App\Models;

use App\Enums\LeadLossReasonEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = "leads";
    protected $casts = [
        'loss_reason' => LeadLossReasonEnum::class
    ];
    public function services(){
        return $this->belongsTo(Service::class, 'fk_service_id');
    }

    public function form()
    {
        return $this->belongsTo(FormBuilder::class, 'form_builder_id');
    }
}
