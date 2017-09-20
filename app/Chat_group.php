<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat_group extends Model
{
    protected $fillable = [
        'group_name', 'user_ids'
    ];
}
