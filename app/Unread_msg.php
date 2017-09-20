<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unread_msg extends Model
{
    protected $fillable = [
        'id','msg_id','user_id'
    ];

    protected $primaryKey = 'id';
}
