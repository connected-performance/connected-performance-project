<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDropdown extends Model
{
    use HasFactory;
    protected $table = 'form_dropdowns';
    protected $guarded = [];

    public function formfield(){
        return $this->belongsTo(FormField::class, 'form_field_id');
    }
}
