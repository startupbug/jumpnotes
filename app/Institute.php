<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = [
        'institute_id', 'institute_name','created_at','updated_at'
    ];

}