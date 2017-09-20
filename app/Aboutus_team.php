<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus_team extends Model
{
  protected $fillable = [
      'name', 'designation','about','file'
  ];
}
