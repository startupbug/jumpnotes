<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus_testimonial extends Model
{
  protected $fillable = [
      'client_name', 'client_pic','client_quote'
  ];
}
