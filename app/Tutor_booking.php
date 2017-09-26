<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor_booking extends Model
{
    protected $fillable = [
        'id','tutor_id', 'student_id','student_email','notes_id','student_skype','is_paid','created_at'
    ];

}