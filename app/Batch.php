<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
    	'class_name_id'. 'name', 'student_capacity', 'status',
    ];
}
