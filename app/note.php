<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model 
{
    protected $fillable = [
        'notes_id', 'note_title','note_detail','note_file','user_id','thumbnail'
    ];

     protected $primaryKey = 'notes_id';

}     