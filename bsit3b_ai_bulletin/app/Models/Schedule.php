<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    protected $fillable = [
        'course_id',
        'day',
        'time',
        'building',
        'room',
        'course_code',
        'course_name',
        'instructor'
    ];
}

