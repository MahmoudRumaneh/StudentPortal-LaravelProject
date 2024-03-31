<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'theoretical_section',
        'practical_section',
        'lecture_time_and_room_number',
        'teacher',
        'hours',
        'level',
        'days'

    ];

    public $timestamps = false;

    public function users()
    {

        return $this->belongsToMany(User::class, 'user_courses');
    }
}
