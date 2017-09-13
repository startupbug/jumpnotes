<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notecomment extends Model
{
    protected $fillable = ['id','user_id','note_id','comment'];
}
