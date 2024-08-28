<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $fillable = ['id','name','created_at','updated_at'];

    /**
     * Get the fields for the form.
     */
    public function fields()
    {
        return $this->hasMany(FormField::class);
    }
}
