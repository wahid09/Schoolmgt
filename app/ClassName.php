<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    protected $fillable = [
    	'class_name', 'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
