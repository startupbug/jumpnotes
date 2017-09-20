<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'lesson_id', 'tutor_id','lesson_desc'
    ];

    protected $primaryKey = 'lesson_id';
}