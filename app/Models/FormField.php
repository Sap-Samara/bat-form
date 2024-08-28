<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $table = 'form_fields';

    // Specify the attributes that are mass assignable
    protected $fillable = ['form_id', 'label', 'name', 'type', 'values', 'required'];

    /**
     * Get the form that owns the form field.
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
