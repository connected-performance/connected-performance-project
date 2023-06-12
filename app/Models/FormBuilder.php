<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    use HasFactory;
    protected $table = 'form_builders';
    protected $guarded = [];

    public function formfields()
    {
        return $this->hasMany(FormField::class);
    }

    public function lead()
    {
        return $this->hasOne(Lead::class);
    }
}
