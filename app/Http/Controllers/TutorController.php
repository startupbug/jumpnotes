<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;
use App\Http\Requests;
use App\Country;
use App\City;
use App\State;
use App\Language;
use App\Lesson;
use Auth;
use Validator;
use App\Tutor;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\On_trail;
use App\Tutor_booking;
use App\User;
use Mail;
use Twilio as Twilio;
use DB;
use App\Chat_group;
use Datatables;

class TutorController extends Controller
{

    public function __construct(){
       parent::__construct();
    }

    public function tutor_index(Request $request){

        $tutors = Tutor::select('users.profile_pic as user_profile_pic','users.*','tutors.*','languages.id as lang_id','languages.*')
            ->join('users','users.id','=','tutors.users_id')
            ->join('languages','languages.id','=','tutors.languag_id')
            ->where('tutors.is_paid' , 1)
            ->where('tutors.admin_approval',1)
            ->paginate(5);
        $data['institutes'] = Institute::get(['institute_id', 'institute_name']);
        $data['professors'] = Tutor::join('users', 'tutors.users_id','=', 'users.id')->where('is_paid', 1)->get(['tutor_id', 'username', 'tutor_majors']);
        $data['languages'] = Language::all();
        return view('tutor.index')->with('tutors', $tutors)->with($data)
                                  ->with('your_note_count', $this->your_note_count)
                                  ->with('logo_file', $this->logo_file)
            ->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning);
    }

    public function group_user_check($id){
        $current_user = Auth::user()->id;
        $exist = Chat_group::whereRaw("find_in_set('{$id}',user_ids)")->whereRaw("find_in_set('{$current_user}',user_ids)")->exists();
        if($exist){
        $get = Chat_group::whereRaw("find_in_set('{$id}',user_ids)")->whereRaw("find_in_set('{$current_user}',user_ids)")->get();
        foreach($get as $row){
            $count_user = explode(',',$row->user_ids);
            if(count($count_user) == 2){
                return \Response::json(array('success' => true, 'status' => true, 'group_id' => $row->group_id), 200);
//                break;
            }
            else{
                continue;
            }
        }
        return \Response::json(array('success' => true,'tutor_id' => $id, 'status' => false), 200);
        }
        else{
            return \Response::json(array('success' => true,'tutor_id' => $id, 'status' => false), 200);
        }
    }
    public function tutorSearch(Request $request){
         //return $request->input();
        if($request->has('name') && $request->has('value')){
            $entity_name = $request->input('name');
            $value = $request->input('value');

            if($entity_name == "institute"){
                $tutors = User::select('users.profile_pic as user_profile_pic','users.*','tutors.*')->join('tutors', 'tutors.users_id', '=', 'users.id')
                    ->join('languages','languages.id','=','tutors.languag_id')
                    ->where('users.institute_id', $value)
                    ->where('tutors.is_paid', 1)
                    ->paginate(5);

                if(count($tutors) == 0){
                    $returnHTML = '<br>No Tutor Found for the Searched Term';
                }else{
                    $returnHTML = \View::make('tutor.tutor_Search_ajax')->with('tutors', $tutors)->render();
                }

                return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }else if($entity_name == "professor"){

                $tutors = Tutor::select('users.profile_pic as user_profile_pic','users.*','tutors.*')->join('users', 'tutors.users_id', '=', 'users.id')
                    ->join('languages','languages.id','=','tutors.languag_id')
                    ->where('tutors.tutor_id', $value)
                    ->where('tutors.is_paid', 1)
                    ->paginate(5);

                if(count($tutors) == 0){
                    $returnHTML = '<br>No Tutor Found for the Searched Term';
                }else{
                    $returnHTML = \View::make('tutor.tutor_Search_ajax')->with('tutors', $tutors)->render();
                }

                return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }else if($entity_name == "majors"){

                $tutors = Tutor::select('users.profile_pic as user_profile_pic','users.*','tutors.*')->join('users', 'tutors.users_id', '=', 'users.id')
                    ->join('languages','languages.id','=','tutors.languag_id')
                    ->where('tutors.languag_id', $value)
                    ->where('tutors.is_paid', 1)
                    ->paginate(5);

                if(count($tutors) == 0){
                    $returnHTML = '<br>No Tutor Found for the Searched Term';
                }else{
                    $returnHTML = \View::make('tutor.tutor_search_ajax')->with('tutors', $tutors)->render();
                }

                return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }
            else if($entity_name == "ratting"){

                $tutors = Tutor::select('users.profile_pic as user_profile_pic','users.*','tutors.*')->
                leftjoin('users','users.id','=','tutors.users_id')
                    ->join('languages','languages.id','=','tutors.languag_id')
                    ->where('tutor_rating','>',$value)->where('tutor_rating','<',$value+1)
                    ->where('tutors.is_paid', 1)
                    ->paginate(5); //
                if(count($tutors) == 0){
                    $returnHTML = '<br>No Tutor Found for the Searched Term';
                }else{
                    $returnHTML = \View::make('tutor.tutor_search_ajax')->with('tutors', $tutors)->render();
                }

                return \Response::json(array('success' => true, 'html' => $returnHTML), 200);
            }


        }else{
            return \Response::json(array('success' => true), 422);
        }
    }

    public function book_tutor(Request $request){
        $user = Auth::user();
        if($request->ajax()){
            $booking = new Tutor_booking();
            $booking->tutor_id = $request->input('tutor_id');
            $booking->student_id = $user->id;
            $booking->student_email = $request->input('contact_email');
            $booking->student_skype = $request->input('contact_skype');
            $booking->notes_id = $request->input('note_id');
//            $note_title = $request->input('note_title');
        }
        if($booking->save()){
            $tutor_email = Tutor::select('users.email','users.username', 'tutors.tutor_phone')->join('users','users.id','=','tutors.users_id')
            ->where('tutor_id',$request->input('tutor_id'))->first();
            Mail::send('emails.bookingRequest', ['tutor'=>$tutor_email->username,'user'=> $user->username,'request' => $request->all()], function ($m) use ($tutor_email) {
                $m->from('shahzaib.imran.aimviz@gmail.com', 'ROD');
                $m->to($tutor_email->email)->subject('ROD student request notification');
            });

            /*  Send SMS Using Twilio */
            // try {
                 // Your Account Sid and Auth Token from twilio.com/user/account
            try {
             // Your Account Sid and Auth Token from twilio.com/user/account
            $sid = 'AC3e595b70abb09a692b538d42a798c2d2';
            $token = '762ec7f9dbbd64b05294a4faa84661a3';

            $client = new \Services_Twilio($sid, $token);

            $message = $client->account->messages->sendMessage(
                '+15803660904 ',  // From a valid Twilio number
               $tutor_email->tutor_phone, // Text this number
                "Hi ".$tutor_email->username." New Lesson Booked!" // message
            );

              $check = Twilio::message($tutor_email->tutor_phone, "Test Message");

            } catch (\Services_Twilio_RestException $e) {
               return \Response::json(array('success' => true, 'last_insert_id' => $booking->id, 'msg'=>'Your request has been sent you will get notification soon' ), 200);
            }


            // }catch (Exception $e) {
            //       echo $check;
            // }


        }
        exit();
    }

    public function tutor_registeration(Request $request){

        $user = Auth::user();

       // return $request->input();
        $this->validate($request, [
            'tutor_name' => 'required',
            'tutor_country' => 'required',
            'tutor_lanuage' => 'required',
            'tutor_majors' => 'required',
            'tutor_skills' => 'required',
            'per_hour_charges' => 'required',
            'tutor_about' => 'required',
        ]);

        if($request->ajax()) {
            $newTutor = new Tutor();
            $video = $request->input('video_link');
            if (strpos($video, 'embed') !== false) {
                $video_link = $video;
            }
            else{
              $video_code = substr($video, strpos($video, "=") + 1);
              $video_link = "https://www.youtube.com/embed/".$video_code."?ecver=2";
            }
            $newTutor->users_id = $user->id;
            $newTutor->tutor_unique = $request->input('tutor_name');
            $newTutor->country_id = $request->input('tutor_country');
            $newTutor->state_id = $request->input('tutor_state');
            $newTutor->city_id = $request->input('tutor_city');
            $newTutor->tutor_phone = $request->input('tutor_phoneCode') . $request->input('tutor_phone');
            $newTutor->languag_id = $request->input('tutor_lanuage');
            $newTutor->other_languages = $request->input('tutor_other_lang');
            $newTutor->tutor_about = $request->input('tutor_about');
            $newTutor->tutor_qualification = $request->input('tutor_qualification');
            $newTutor->intro_video_link = $video_link;
            $newTutor->tutor_gender = $request->input('tutor_gender');
            $newTutor->tutor_majors = $request->input('tutor_majors');
            $newTutor->tutor_skills = $request->input('tutor_skills');
            $newTutor->is_paid = 0;
            $newTutor->per_hour_charges = $request->input('per_hour_charges');
            $newTutor->tutor_rating = '5';

            if(Input::hasFile('profile_pic')) {
                $file = Input::file('profile_pic');
                $tmpFilePath = '/profile_pics/';
                $tmpFileName = preg_replace('/\s+/', '', (time() . '-' . $file->getClientOriginalName()));
                $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                $path =   $tmpFileName;
                $profile_finalpath = $path;
                $newTutor->profile_pic = $profile_finalpath;
            }

            if(Input::hasFile('tutor_transcript')) {
                $file = Input::file('tutor_transcript');
                $tmpFilePath = '/tutor_transcripts/';
                $tmpFileName = preg_replace('/\s+/', '', (time() . '-' . $file->getClientOriginalName()));
                $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                $path =   $tmpFileName;
                $finalpath = $path;
                $newTutor->tutor_transcript = $finalpath;
            }

            //$response = $newTutor->save();
            if($newTutor->save()){
                    User::where('id',Auth::user()->id)->update(['profile_pic'=>$profile_finalpath]);
                  /* Inserting Lesson */
                    $tutor = Tutor::where('tutor_id', $newTutor->tutor_id)->first(['users_id']);
                    $tutor_email = User::where('id', $tutor->users_id)->first(['email']);
                    $tutor_email = $tutor_email->email;

                    $lesson = new Lesson();
                    $lesson->tutor_id = $newTutor->tutor_id;
                    $lesson->lesson_desc = $request->input('lesson_desc');

                    if($lesson->save()){

                     /* Inserting in On Trail */
                    $on_trail = new On_trail();
                    $on_trail->user_id = Auth::user()->id;
                    $on_trail->expiry_date = Carbon::now()->addDays(5);

                        if($on_trail->save()){
                            Mail::send('emails.tutor_email', ['token' => 123], function ($m) use ($tutor_email) {
                                $m->from('shahzaib.imran.aimviz@gmail.com', 'ROD');
                                $m->to($tutor_email)->subject('ROD Helper for your study');
                            });

                            return \Response::json(array('success' => true, 'last_insert_id' => $on_trail->trail_id, 'msg'=>'You are on 5 day trail Please Pay to become a full memeber. Kindly check
                                Your Mail' ), 200);
                        }

                    }
            }
            else{
                //return response()->json($response);
            }
        }

    }
    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->lists("name","id");
        return response()->json($states);
    }
    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->lists("name","id");
        return response()->json($cities);
    }
    public function getCountryCode(Request $request)
    {
        $cities = DB::table("countries")
            ->select('phonecode')
            ->where("id",$request->country_id)
            ->first();
        return response()->json($cities);
    }
    public function subscribed_tutors(){

    }

    public function tutor_bookings(){
      return view('tutor.tutor_bookings')->with('tutor_globalflag',  $this->tutor_globalflag)
      ->with('tutor_earning', $this->tutor_earning)
      ->with('your_note_count', $this->your_note_count);
    }
    public function tutorBooking_datatable(){
      $tutor_id = Tutor::select('tutor_id')->where('users_id',Auth::user()->id)->first();
      $tutor_bookings = Tutor_booking::select('tutor_bookings.created_at as booking_date','tutor_bookings.*','users.*','notes.note_title','tutors.*')
      ->join('users','users.id','=','tutor_bookings.student_id')
      ->join('notes','notes.notes_id','=','tutor_bookings.notes_id')
      ->join('tutors','tutors.tutor_id','=','tutor_bookings.tutor_id')
      ->where('tutor_bookings.tutor_id',$tutor_id->tutor_id)
      ->orderBy('tutor_bookings.id', 'desc')->get();
      return Datatables::of($tutor_bookings)->addColumn('status',
      function($tutor_bookings){
        if($tutor_bookings->pay_status){
          return'
            <span class="label bg-success heading-text">Payed</span>
            ';
          }
          else{
            return '
              <span class="label bg-danger heading-text">Pending</span>
              ';
            }
          })
          ->addColumn('action',
          function($tutor_bookings){
              return'
                <a href="#" username="'.$tutor_bookings->username.'" email="'.$tutor_bookings->email.'"  class="btn btn-info btn-xs sendmail"><i class="glyphicon glyphicon-envelope"></i>Mail</a>
                <a id="'.$tutor_bookings->id.'" href="#" class="btn btn-primary btn-xs sendMsg"><i class="glyphicon glyphicon-tag"></i>Chat</a>
                ';
              })
              ->editColumn('data', $tutor_bookings)->make(true);
    }
    public function std_reply(Request $request){
        $email = $request->input('email');
        $msg = $request->input('msg');
        $fname = $request->input('fname');
        $email_sender = $request->input('email_sender');
        $subject = $request->input('subject');

        Mail::send('emails.tutor_student',['fname'=>$fname,'msg'=>$msg], function ($m) use($request) {
            $m->from($request->input('email_sender'), 'JumpNotes Tutor');
            $m->to($request->input('email'))->subject($request->input('subject'));
          });
          return redirect(route('tutorbookings'));
    }
}
