<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic_content extends Model
{
    protected $fillable = [
        'name', 'content','created_at','updated_at'
    ];

	public function get_logo_file(){
		return $this->where('name', 'logo')->pluck('content');
	} 
}
