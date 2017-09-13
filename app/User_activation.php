<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_activation extends Model
{
  protected $fillable = [
      'user_id', 'token',
  ];

  public function users(){
    return $this->hasOne('App\User', 'id');
  }
}
