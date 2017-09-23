<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Std_subscription extends Model
{
    //
    protected $fillable = ['std_id' , 'author_id', 'expiry_date', 'subs_return'];
}
