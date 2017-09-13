<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller{

	public function __construct(){
       parent::__construct();
    }
    
    public function inbox_index(){
    	return view('message.inbox')
    	->with('your_note_count', $this->your_note_count)
    	->with('logo_file', $this->logo_file)->with('tutor_flag',  $this->tutor_flag);
    }

}
