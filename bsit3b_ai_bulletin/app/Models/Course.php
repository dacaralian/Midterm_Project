<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'title', 'instructor', 'image'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
