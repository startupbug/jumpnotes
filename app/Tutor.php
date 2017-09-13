<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
	
    protected $fillable = [
        'tutor_id', 'user_id','country_id','state_id','city_id', 'tutor_phone', 'languag_id','other_languages','tutor_unique',
        'profile_pic','tutor_about','tutor_qualification','intro_video_link','tutor_gender','tutor_majors',
        'tutor_skills','per_hour_charges','is_paid','tutor_rating', 'has_shared', 'expiry_date'
    ];

    protected $primaryKey = 'tutor_id';
}