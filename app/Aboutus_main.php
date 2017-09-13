<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus_main extends Model
{
  protected $fillable = [
      'sec1_heading', 'sec1_content','sec1_file','sec2_heading','sec2_subheading','sec3_heading','sec3_subheading'
  ];
}
