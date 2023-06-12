<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    use HasFactory;

    protected $table = "form_responses";
    protected $fillable = [
        'form_builder_id',
        'response',
    ];
}
