<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'photo', 'title', 'description', 'status',
    ];


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
