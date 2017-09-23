<?php

namespace App\Http\Controllers;

use App\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Institute;
use App\Http\Requests;
use App\Country;
use App\Citie;
use App\State;
use App\Language;
use App\Lesson;
use App\User;
use DB;
use App\On_trail;
use Auth;
use App\Tutor;
use Zipper;
use Redirect;
use App\Std_subscription;
use Paypal;
use App\Notecomment;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Subscription;
use Illuminate\Support\Facades\Input;


class NotesController extends Controller
{

    public function __construct(){
       parent::__construct();
       $this->middleware('auth');
        /*$this->_apiContext = Paypal::ApiContext('Ae7ZZW-AvpehkfcJThodJvZoVu5ilr1Mxg1pQIDU2h7dupVG2Lmz_7mr7lO3iewAqfRkyJIVwN0_n3f7',
            'EKMVlkDsnqHOSDP2Ye8Olho535mvfYXNUinZGYPsu9DzhM8hoCaabk1JTrMfPdIZOcMbyJqXQvnknX1C');

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));*/
    }

    public function uploadNotes(Request $request){


        $this->validate($request, [
            'note_title' => 'required',
            'note_detail' => 'required',
        ]);

        $user = Auth::user();
        if($request->input('notes_id') != '0'){
            if($request->ajax()) {
                $note_title = $request->input('note_title');
                $note_detail = $request->input('note_detail');
                $note_id = $request->input('notes_id');
                $note_file = '';
                if(Input::hasFile('note_file')) {

                    $file = Input::file('note_file');
                    $count_file = count($file);

                    $fileName = substr($file[0]->getClientOriginalName(), -4);
                    if($fileName == '.jpg' || $fileName == 'jpeg' || $fileName == '.png') {
                        //is image
                        //return 'maaz';
                        $finalpath = "";
                        for($i=0; $i<$count_file; $i++){
                            $file = Input::file('note_file')[$i];
                            $tmpFilePath = '/notes/';
                            $tmpFileName = time() . '-' . $file->getClientOriginalName();
                            $tmpFileName = preg_replace('/\s+/', '', $tmpFileName);
                            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                            $path = $tmpFileName;
                            $finalpath .= $path;
                            if($i != $count_file-1){
                                $finalpath .= ',';
                            }
                        }
                        $note_file = $finalpath;
                        $file_type = '1';
                    }
					else if($fileName == '.csv'){
						return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'CSV formate not supported. Suggestion: you can convert it to .xls and upload'), 400);
					}
					else if($fileName == '.pdf' || $fileName == '.docx' || $fileName == '.doc' || $fileName == '.xls'){
                        //is file
                        $tmpFilePath = '/notes/';
                        $tmpFileName = preg_replace('/\s+/', '', (time() . '-' . $file->getClientOriginalName()));
                        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                        $path =   $tmpFileName;
                        $finalpath = $path;
                        $note_file = $finalpath;
                        $file_type = '0';
                    }
					else if($fileName == '.xlsx'){
						return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'formate .XLSX not supported. Suggestion: you can use .xls to upload file'), 400);
					}
                    else{
                        return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'Something went wrong, Please use appropriate file formate.'), 400);
                    }
                }


                if(Input::hasFile('note_file')){
                    $values = array('note_title' => $note_title, 'note_detail' => $note_detail,'note_file'=>$note_file,'file_type'=>$file_type);
                }
                else{
                    $values = array('note_title' => $note_title, 'note_detail' => $note_detail);
                }
                $update = Note::where('notes_id', $note_id)->update($values);
                if($update){
                    return \Response::json(array('success' => true, 'update_status' => $update), 200);
                }else{
                    return \Response::json(array('success' => false, 'update_status' => $update,'error'=>'Something went wrong, Please try again.'), 400);
                }
            }
        }
        else{
        if($request->ajax()) {
            $newNote = new Note();
            $newNote->user_id = $user->id;
            $newNote->note_title = $request->input('note_title');
            $newNote->note_detail = $request->input('note_detail');
            $newNote->note_subject = $request->input('note_subject');
            $newNote->note_class = $request->input('note_class');
            if(Input::hasFile('note_thumb')) {

                $file = Input::file('note_thumb');
                $fileName = substr($file->getClientOriginalName(), -4);
                if ($fileName == '.jpg' || $fileName == 'jpeg' || $fileName == '.png') {
                    //is image
                    //return 'maaz';
                    $finalpath = "";
                    $file = Input::file('note_thumb');
                    $tmpFilePath = '/notes/thumnail/';
                    $tmpFileName = time() . '-' . $file->getClientOriginalName();
                    $tmpFileName = preg_replace('/\s+/', '', $tmpFileName);
                    $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                    $path = $tmpFileName;
                    $finalpath .= $path;
                    /*if ($i != $count_file - 1) {
                        $finalpath .= ',';
                    }*/

                    $newNote->note_thumb = $finalpath;
                }
                else{
                  return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'Thumbnail should be image. Supported formate .jpg, .jpeg or .png'), 400);
                }
            }
            if(Input::hasFile('note_file')) {

                $file = Input::file('note_file');
                $count_file = count($file);
                $fileName = substr($file[0]->getClientOriginalName(), -4);
                if($fileName == '.jpg' || $fileName == 'jpeg' || $fileName == '.png') {
                    //is image
                    //return 'maaz';
                    $finalpath = "";
                    for($i=0; $i<$count_file; $i++){
                        $file = Input::file('note_file')[$i];
                        $tmpFilePath = '/notes/';
                        $tmpFileName = time() . '-' . $file->getClientOriginalName();
                        $tmpFileName = preg_replace('/\s+/', '', $tmpFileName);
                        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                        $path =  $tmpFileName;
                        $finalpath .= $path;
                        if($i != $count_file-1){
                            $finalpath .= ',';
                        }
                    }

                    $newNote->note_file = $finalpath;
                    $newNote->file_type = '1';
                }
				else if($fileName == '.csv'){
					return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'CSV formate not supported. Suggestion: you can convert it to .xls and upload'), 400);
				}
				else if(!empty($fileName)){
                    //is file
                    $tmpFilePath = '/notes/';
                    $tmpFileName = preg_replace('/\s+/', '', (time() . '-' . $file[0]->getClientOriginalName()));
                    $file = $file[0]->move(public_path() . $tmpFilePath, $tmpFileName);
                    $path =   $tmpFileName;
                    $finalpath = $path;
                    $newNote->note_file = $finalpath;
                }
                else{
                    return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'Something went wrong, Please try again.'), 400);
                }
            }
            else{
                return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'Please upload note documents'), 400);
            }
//             $response = $newNote->save();
            if($newNote->save()){
                return \Response::json(array('success' => true, 'last_insert_id' => $newNote->notes_id,'error'=>'nothing'), 200);
            }else{
                return \Response::json(array('success' => false, 'last_insert_id' => $user->id,'error'=>'Something went wrong'), 400);
            }
        }
        }
        print_r($_POST);
        exit();
    }

    public function recent_notes(){
        $data['recent_notes'] = Note::orderBy('notes_id', 'desc')->take(6)->get();

    }
    public function deleteNote($id){
        $note_file = Note::where('notes_id', $id)->first();
        $deletedRows = Note::where('notes_id', $id)->delete();
        if($deletedRows){
            if($note_file->file_type != 0){
                $note_files = explode(',',$note_file->note_file);
                foreach($note_files as $note_file_name){
                    unlink(public_path('notes/'.$note_file_name));
                }
            }
            else{
                unlink(public_path('notes/'.$note_file->note_file));
            }

            return \Response::json(array('success' => true, 'status' => $deletedRows), 200);
        }
        else{
            return \Response::json(array('success' => false, 'status' => $deletedRows), 400);
        }
    }


    public function view_single_note($noteID, $sub_id=null){
    //dd($noteID);
//        $noteID = 11;
        $data['noteDetail'] = Note::where('notes_id',$noteID)->first();
        $userid = $data['noteDetail']->user_id;
        $data['tutorFlag'] = Tutor::where('users_id', $userid)->exists();
        $data['recent_notes'] = Note::orderBy('notes_id', 'desc')->take(5)->get();
        $data['ontrail'] = 0;
        if($data['tutorFlag']){
            $data['ontrail'] = On_trail::where('user_id',$userid)->exists();
            $data['authorDetail'] = Tutor::where('users_id', $userid)->first();
            $data['lesson'] = Lesson::where('tutor_id', $data['authorDetail']->tutor_id)->first();
        }
        else{
            $data['authorDetail'] = User::where('id', $userid)->first();
        }
        $note_view_count = $data['noteDetail']->view_count;
        $update = Note::where('notes_id', $noteID)->update(array('view_count'=>$note_view_count+1));
        $data['files'] = glob('public/images/dynamic_assets/*');
        $data['subscription_check'] = 0;
        $data['subscription_check'] = Std_subscription::where('std_id',Auth::user()->id)->where('author_id',$userid)->exists();

        if(Std_subscription::where('std_id',Auth::user()->id)->exists()){
          $sub_id = Std_subscription::select('id')->where('std_id',Auth::user()->id)->first();
          return view('notes.single_note')->with($data)->with('your_note_count', $this->your_note_count)
              ->with('tutor_globalflag',  $this->tutor_globalflag)
              ->with('tutor_earning', $this->tutor_earning)
              ->with('sub_id',sprintf("%06d", $sub_id->id));
        }
        return view('notes.single_note')->with($data)->with('your_note_count', $this->your_note_count)
            ->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning);
        }


    public function tutor_notes($id){
        $notes = Note::select('notes.created_at as noteDate','notes.*','users.*')->join('users','users.id','=','notes.user_id')
            ->where('notes.user_id',$id)
            ->orderBy('notes.notes_id', 'desc')->get();
        return view('notes.tutor_notes')->with('notes', $notes)
            ->with('your_note_count', $this->your_note_count)
            ->with('logo_file', $this->logo_file)->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning);
    }

    public function notes_index(){

        $notes = Note::select('notes.created_at as noteDate','notes.*','users.*')->join('users','users.id','=','notes.user_id')->
        //where('', )
		orderBy('notes.notes_id', 'desc')
        ->paginate(9);
        $data['institutes'] = Institute::get(['institute_id', 'institute_name']);
        $data['professors'] = Tutor::join('users', 'tutors.users_id','=', 'users.id')->get(['tutor_id', 'username', 'tutor_majors']);
        return view('notes.notes_index')->with('notes', $notes)->with($data)
        ->with('your_note_count', $this->your_note_count)
        ->with('logo_file', $this->logo_file)->with('tutor_globalflag',  $this->tutor_globalflag)
        ->with('tutor_earning', $this->tutor_earning);
    }


    public function single_note_index(){
        $notes = Note::paginate(5);
        return view('notes.notes_index')->with('notes', $notes)->with('your_note_count', $this->your_note_count);
    }

    public function noteSearch(Request $request){
        $searchText = $request->input('searchText');
        $notes = Note::select('notes.created_at as noteDate','notes.*','users.*')->join('users','users.id','=','notes.user_id')->where('note_title', 'LIKE' , '%'.$searchText.'%')->paginate(5); //

        if(count($notes) == 0){
           $returnHTML = '<br>No Notes Found for the Searched Term';
        }else{
           $returnHTML = \View::make('notes.noteSearch_ajax')->with('notes', $notes)->render();
        }

        return \Response::json(array('success' => true, 'html' => $returnHTML), 200);
    }

    public function noteDrop(Request $request){

        if($request->has('name') && $request->has('value')){
            $entity_name = $request->input('name');
            $value = $request->input('value');

            if($entity_name == "institute"){
                    $notes = User::join('notes', 'notes.user_id', '=', 'users.id')->where('institute_id', $value)->paginate(5);

                    if(count($notes) == 0){
                       $returnHTML = '<br>No Notes Found for the Searched Term';
                    }else{
                       $returnHTML = \View::make('notes.noteSearch_ajax')->with('notes', $notes)->render();
                    }

                    return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }else if($entity_name == "professor"){

                    $notes = Tutor::join('users', 'tutors.users_id', '=', 'users.id')->join('notes', 'notes.user_id', '=', 'users.id')
                    ->where('tutors.tutor_id', $value)->paginate(5);

                    if(count($notes) == 0){
                       $returnHTML = '<br>No Notes Found for the Searched Term';
                    }else{
                       $returnHTML = \View::make('notes.noteSearch_ajax')->with('notes', $notes)->render();
                    }

                    return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }else if($entity_name == "majors"){

                    $notes = Tutor::join('users', 'tutors.users_id', '=', 'users.id')->join('notes', 'notes.user_id', '=', 'users.id')
                    ->where('tutors.tutor_majors', $value)->paginate(5);

                    if(count($notes) == 0){
                       $returnHTML = '<br>No Notes Found for the Searched Term';
                    }else{
                       $returnHTML = \View::make('notes.noteSearch_ajax')->with('notes', $notes)->render();
                    }

                    return \Response::json(array('success' => true, 'html' => $returnHTML), 200);

            }
            else if($entity_name == "ratting"){
                $notes = Note::select('notes.created_at as noteDate','notes.*','users.*')->join('users','users.id','=','notes.user_id')->where('note_rating','>',$value)->where('note_rating','<',$value+1)->paginate(5); //
                if(count($notes) == 0){
                    $returnHTML = '<br>No Notes Found for the Searched Term';
                }else{
                    $returnHTML = \View::make('notes.noteSearch_ajax')->with('notes', $notes)->render();
                }

                return \Response::json(array('success' => true, 'html' => $returnHTML), 200);
            }


        }else{
            return \Response::json(array('success' => true), 422);
        }
    }

    public function note_rating(Request $request){

        if($request->ajax()){
            $note_id = $request->input('note_id');
            $note_user_id = $request->input('note_user_id');
            $cur_rate_note = $request->input('current_rate_note');

            $note = Note::where('notes_id', $note_id)->where('user_id', $note_user_id)->first(['note_rating']);

            $old_note_rating = $note->note_rating;
            $new_note_rating = ( $old_note_rating + $cur_rate_note )/2;

            $note_update = Note::where('notes_id', $note_id)->where('user_id', $note_user_id)->update(['note_rating' => $new_note_rating ]);

            if($note_update){
               return \Response::json(array('success' => true, 'update_status' => $note_update), 200);
            }else{
               return \Response::json(array('success' => false, 'update_status' => $note_update), 422);
            }

        }else{
               return \Response::json(array('success' => false, 'update_status' => $update), 422);
        }
    }

    public function multi_download($arr){
                $arrr = explode(',',$arr);
                $files = array();
                foreach($arrr as $arr){
                    $files[] = 'public/notes/'.$arr;
                }
//        $files = 'public/images/dynamic_assets/'.;
       // $files = glob('public/images/dynamic_assets/*');
//        dd($files);

                $success = \File::cleanDirectory('public/zip/');
        if($success){

                Zipper::make('public/zip/note.zip')->add($files)->close();
        }
    }

    public function downloadPaymentReceived(Request $request){
        $note_id = \Session::get('note_id');
        try{
            $id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');

            $payment = PayPal::getById($id, $this->_apiContext);
            $paymentExecution = PayPal::PaymentExecution();

            $paymentExecution->setPayerId($payer_id);
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        }catch(PayPalConnectionException $e){
            echo $e->getCode(); // Prints the Error Code
            echo $e->getData();
            die($e);
        }catch (Exception $ex) {
            die($ex);
        }

        if($executePayment){
            $request->session()->flash('payment_success', 'Author Successfully Payed!');
            /* Updating Tutor Table */
            $author_id = \Session::get('author_id');
            $std_id = Auth::user()->id;
            $std_subscription =  new Std_subscription();
            $std_subscription->author_id = $author_id;
            $std_subscription->std_id = $std_id;
            $std_subscription->expiry_date = Carbon::now()->addDays(30);
            if($std_subscription->save()){
				 if($note_id != 0){
                return Redirect::route('single_note',['id' => $note_id]);
                }
                else{
                  return Redirect::route('profile_view',['id' => $author_id]);
                }
                $request->session()->flash('payment_danger', 'Author Successfully Payed!!');
                return Redirect::route('single_note',['id' => $note_id]);
            }

            return Redirect::route('single_note',['id' => $note_id]);
        }else{
            $request->session()->flash('payment_danger', 'Something went wrong!!');
            return Redirect::route('single_note',['id' => $note_id]);
        }

    }
    public function downloadPaymentCancel(Request $request){
        $request->session()->flash('payment_tab_cancel', 'Payment Cancelled Due to some Reason Please Try Again!');
        return Redirect::route('notes_index');
    }
    public function download_payment(Request $request){

        //dd($request->stripeEmail);
        Stripe::setApiKey(config('services.stripe.secret'));
        $connected_account = \Stripe\Account::retrieve("acct_1B1re5By5xtIUy1A"); 
        $connected_account_id = $connected_account->id;


        $customer = \Stripe\Customer::create(array(
          "description" => "Customer for ".$request->email,
          "source" => 'tok_visa',//$cust_stripe_id // obtained with Stripe.js
        ),array('stripe_account' => $connected_account_id ));
        $customer_id = $customer->id;



        $subscription = \Stripe\Subscription::create(array(
          "customer" => $customer_id,
          "items" => array(
            array(
              "plan" => "student-subscription",
            ),
          ),
          "application_fee_percent" => 44.73,
        ), array("stripe_account" => $connected_account_id ));

        if($subscription->id){
            $subs = Std_subscription::create([
                'std_id' => Auth::user()->id,
                'author_id' => $request->author_id,
                'expiry_date' => '',
                'subs_return' => $subscription
            ]);
            return redirect()->back()->with('status', 'Subscription Successful.');;
        }
        else{
            return redirect()->back()->with('failed', 'Subscription failed.');;   
        }
        //$status = \Stripe\Subscription::retrieve($subscription->id);
        //dd($subscription);

    }

    public function notecomment(Request $request){
        $comment = $request->input('comment');
        $note_id = $request->input('note_id');
        $commentsSave = Notecomment::create(['comment'=>$comment, 'user_id'=>Auth::user()->id,'note_id'=>$note_id]);
        if($commentsSave->success){
          return Redirect::back();
        }
        else{
          return Redirect::back()->withErrors(['msg', 'Something went wrong']);
        }
    }
    public function getcomments($id,$note_id){
      if($id == 0){
        $getcomments = Notecomment::select('notecomments.*','users.username','users.profile_pic')
        ->join('users','users.id','=','notecomments.user_id')
        ->orderBy('notecomments.id', 'desc')
        ->where('notecomments.note_id',$note_id)->take(4)->get();
        }
        else{
          $getcomments = Notecomment::select('notecomments.*','users.username','users.profile_pic')
          ->join('users','users.id','=','notecomments.user_id')
          ->orderBy('id', 'desc')->take(4)
          ->where('notecomments.note_id',$note_id)->where('notecomments.id','>',$id)->get();
        }
        $html = '';
        if($getcomments){
          $html .= '<div class="col-lg-12 comments-title no-pad-left no-pad-right">
						<h3><span>'.count($getcomments).' Comments</span> <hr/></h3>
					</div>';
          foreach($getcomments as $comment){
            if(!empty($comment->profile_pic)){
              $html .= '
              <div class="col-lg-12 no-pad-left no-pad-right comments-section">
                <div class="col-lg-2">
                    <a><img class="img-responsive" src="'.asset('/public/profile_pics/').'/'.$comment->profile_pic.'" style="float:left; margin-right:15px;"></a>
                </div>
                <div class="col-lg-10">
                  <h3 class="title">'.ucwords($comment->username). ' <span> '.Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y at H:ia').'.</span></h3>
                  <p> '.$comment->comment.'</p>
                </div>
              </div>
              ';
            }
            else{
              $html .= '
              <div class="col-lg-12 no-pad-left no-pad-right comments-section">
                <div class="col-lg-2">
                    <a><img class="img-responsive" src="'.asset('/public/images/profile-icon.png').'" style="float:left; margin-right:15px;"></a>
                </div>
                <div class="col-lg-10">
                  <h3 class="title">'.ucwords($comment->username) .' <span> '.Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y at H:ia').'.</span></h3>
                  <p> '.$comment->comment.'</p>
                </div>
              </div>
              ';
            }
          }
        }
        return \Response::json(['status'=>'success' ,'html'=> $html ]);
    }

}
