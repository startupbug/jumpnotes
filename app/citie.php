<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citie extends Model
{
    protected $fillable = [
        'id', 'name','state_id'
    ];
}
