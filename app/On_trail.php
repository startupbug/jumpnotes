<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class On_trail extends Model
{
    protected $fillable = [
        'user_id', 'created_at','updated_at','expiry_date'
    ];

    protected $primaryKey = 'trail_id';
        
}
