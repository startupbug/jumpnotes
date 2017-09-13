<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obt_date extends Model
{
    protected $fillable = [
        'id', 'tutor_id','dates'
    ];

    protected $primaryKey = 'lesson_id';
}