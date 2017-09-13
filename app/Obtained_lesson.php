<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obtained_lesson extends Model
{
    protected $fillable = [
        'id', 'lesson_id','tutor_id','user_id','obt_dates_id','lesson_status','pay_status','dispute_status'
    ];

}