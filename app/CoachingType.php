<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachingType extends Model
{
    protected $fillable = [
    	'class_name_id', 'coaching_type', 'status',
    ];
}
