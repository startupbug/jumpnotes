<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutor_booking;
use App\Http\Requests;
use Auth;
use App\Tutor;
use Paypal;
use Carbon\Carbon;
use Redirect;
use Datatables;
use App\Transaction;
use App\Contact;
use App\User;
use Mail;
use App\Tutor_earning;
use App\Aboutus_main;
use App\Aboutus_team;
use App\Aboutus_testimonial;

class DashboardController extends Controller
{


    public function __construct(){
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

       parent::__construct();
    }

    public function tutor_list_datatable(){
        $tutors = Tutor::join('users','users.id','=','tutors.users_id')->where('admin_approval','!=','2')->get();
        return Datatables::of($tutors)->addColumn('status',
function($tutors){
  if($tutors->admin_approval){
    return'
    <span class="label bg-success heading-text">Approved</span>
    ';
  }
  else{
    return '
    <span class="label bg-danger heading-text">Pending</span>
    ';
  }
})->addColumn('action',
            function($tutors){
                return '
            <a tutor_id='.$tutors->tutor_id.' url='.route('getTutor').' class="btn btn-xs btn-warning btn-rounded tutorRecord"  data-toggle="modal" data-target="#viewTutor">View</a>
            ';

            })->editColumn('data', $tutors)->make(true);
    }

    public function index(){

      if(Auth::user()->id == 1){

         $newUserCount = User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();
         $allUserCount = User::all();
         $totalTutors  = Tutor::all();
         $subsCount = \DB::table('std_subscriptions')->get();

    	return view('dashboard.index')->with('your_note_count', $this->your_note_count)
                                      ->with('logo_file',  $this->logo_file)
            ->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning)
            ->with('allUserCount',  count($allUserCount))
            ->with('newUserCount', $newUserCount)
            ->with('totalTutors', count($totalTutors))
            ->with('subsCount', count($subsCount));

          //  ->with('newUserCount',  $newUserCount);
            }
            else{
              return Redirect::route('home');
            }
    }

    public function getTutor(Request $request){
		$id = $request->input('id');
		$tutor = Tutor::select('tutors.*','users.email')->where('tutor_id',$id)
    ->join('users','users.id','=','tutors.users_id')
    ->first();
		return \Response::json(array('success' => true, 'tutorRecord' => $tutor), 200);
    }
	public function tutor_approval($id){
			$values = array('admin_approval' => 1);
      $update = Tutor::where('tutor_id', $id)->update($values);
      $tutor_email = Tutor::select('users.email')
      ->join('users','users.id','=','tutors.users_id')
      ->where('tutor_id', $id)
      ->first();
      if($update){
      Mail::send('emails.tutor_approval',[], function ($m) use ($tutor_email) {
          $m->from('shahzaib.imran.aimviz@gmail.com', 'ROD');
          $m->to($tutor_email->email)->subject('ROD Tutor approval notification');
        });
      }
			return \Response::json(array('success' => true), 200);
	}
	public function deleteTutor($id){
		$values = array('admin_approval' => 2);
            $update = Tutor::where('tutor_id', $id)->update($values);
			return \Response::json(array('success' => true), 200);
	}

    public function booking_requests(){
        $user = Auth::user();
        $data['requests'] = Tutor_booking::join('tutors','tutors.tutor_id','=','tutor_bookings.tutor_id')
            ->join('notes','notes.notes_id','=','tutor_bookings.notes_id')
            ->where('tutor_bookings.student_id',$user->id)
            ->orderBy('tutor_bookings.id', 'desc')
             ->paginate(10);

        return view('dashboard.studentActions.bookingRequestes')->with($data)
            ->with('your_note_count', $this->your_note_count)
            ->with('logo_file',  $this->logo_file)->with('tutor_globalflag',  $this->tutor_globalflag)
            ->with('tutor_earning', $this->tutor_earning);
    }

    public function cash_withdraw_datatable(){

    }

    public function tutor_ratting(Request $request){

        if($request->ajax()){
            $tutor_id = $request->input('tutorID');
            $tutor_ratting = $request->input('avgRate');
            $request_id = $request->input('id');
            $values = array('tutor_rating' => $tutor_ratting);
            $update = Tutor::where('tutor_id', $tutor_id)->update($values);
            if($update){
                Tutor_booking::where('id', $request_id)->update(array('ratting_status'=>1));
                return \Response::json(array('success' => true, 'update_status' => $update), 200);
            }else{
                return \Response::json(array('success' => false, 'update_status' => $update), 400);
            }
        }else{
                return \Response::json(array('success' => false, 'update_status' => $update), 422);
        }
    }

    public function tutor_ratting_2(Request $request){

        if($request->ajax()){

            $booking_id = $request->input('bookingId');
            $tutor_current_rating = $request->input('tutor_rated');
            $tutor_booking = Tutor_booking::where('id', $booking_id)->first(['tutor_id']);
            $tutor = Tutor::where('tutor_id', $tutor_booking->tutor_id)->first(['tutor_rating']);
            $tutor_old_rating = $tutor->tutor_rating;
            //return "pass2::".$tutor;

            // $tutor_new_rated = $request->input('tutor_rated');
            // $tutor_id = $request->input('tutor_id'); //tutor_rating
            // $tutor_old_rating = $request->input('tutor_old_rating');
            // $booking_id = $request->input('booking_id');

            // $tutor_id = $request->input('tutorID');
            // $tutor_ratting = $request->input('avgRate');
            // $request_id = $request->input('id');

            $new_rating = ($tutor_current_rating + $tutor_old_rating)/2;
            //$values = array('tutor_rating' => $new_rating);
            //return 'idzzzz'.$tutor_id;
            $update = Tutor::where('tutor_id', $tutor_booking->tutor_id)->update(['tutor_rating' => $new_rating]);
            if($update){
                Tutor_booking::where('id', $booking_id)->update(array('ratting_status' => 1));
                return \Response::json(array('success' => true, 'update_status' => $update), 200);
            }else{
                return \Response::json(array('success' => false, 'update_status' => $update), 422);
            }

        }else{
                return \Response::json(array('success' => false, 'update_status' => false), 400);
        }
    }

    public function tutor_rating_update(Request $request){

        if($request->ajax()){
                return \Response::json(array('success' => true, 'msg' => 'Rating couldnot be Updated'), 200);
        }
    }

    /* Booking Request Payment */
    public function book_payment(Request $request){
        $booking_id = $request->input('id');
        //dd($booking_id);
         //Setting Session
        $request->session()->flash('cur_booking_id', $booking_id);

//        $booking_id = \Session::get('cur_booking_id');
//        dd($booking_id);

        $user_hours = $request->input('hours_study');
        $tutor_booking = Tutor_booking::join('tutors','tutors.tutor_id','=','tutor_bookings.tutor_id')
                            ->where('tutor_bookings.id', $booking_id)->first();
        $per_hour_charges = $tutor_booking->per_hour_charges;
        $final_price = $user_hours*$per_hour_charges;
        //dd($final_price);

        /* Paypal Payment Code */
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $itemItemPrice = $final_price;
        $item = PayPal::Item();
        $item->setQuantity(1);
        $item->setName('Tutor Lesson');
        $item->setPrice($itemItemPrice);
        $item->setCurrency('USD');

        $itemList = PayPal::ItemList();
        $itemList->setItems(array($item));

        $totalAmount = $final_price;
        $amount = PayPal::Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($totalAmount);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList);
        $transaction->setDescription('Tutor Lesson');

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('DashboardController@getPaypalPaymentDone'));
        $redirectUrls->setCancelUrl(action('DashboardController@getPaypalPaymentCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to( $redirectUrl );

        return view('dashboard.payment.index');
    }

    public function getPaypalPaymentDone(Request $request){

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
            $request->session()->flash('payment_success', 'Tutor Succesfully Payed!');
            /* Updating Tutor Table */
            $booking_id = \Session::get('cur_booking_id');
            $booking_update = Tutor_booking::where('id', $booking_id)->update(['pay_status' => 1]);
            /* $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['expiry_date' => Carbon::now()->addMonth() ]);
            $tutor_update = On_trail::where('user_id', Auth::user()->id)->delete();
            \Session::forget('cur_booking_id'); */
            if(!$booking_update){
                $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
                return Redirect::route('requestsView');
            }

            return Redirect::route('requestsView');
        }else{
            $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
            return Redirect::route('requestsView');
        }

    }
    public function transactionsView(){
        return view('dashboard.transaction');
    }
    public function transaction_datatable(){
      $transactions = Transaction::select('users.username','users.email','transactions.*')
      ->join('users','users.id','=','transactions.user_id')->where('pay_type',1)->get();
      return Datatables::of($transactions)->make(true);
    }
    public function std_transaction_datatable(){
      $transactions = Transaction::select('users.username','users.email','transactions.*')
      ->join('users','users.id','=','transactions.user_id')->where('pay_type',2)->get();
      return Datatables::of($transactions)->make(true);
    }
    public function note_booking_transaction_datatable(){
      $transactions = Transaction::select('users.username','users.email','transactions.*')
      ->join('users','users.id','=','transactions.user_id')->where('pay_type',3)->get();
      return Datatables::of($transactions)->make(true);
    }

    public function getPaypalPaymentCancel(Request $request){
        dd('Some problem with payment');
    }

    public function dashboard_contact(){
      return view('dashboard.contacts');
    }
    public function contact_datatable(){
      $contacts = Contact::all();
      return Datatables::of($contacts)->addColumn('action',
                  function($contacts){
                      return '
                  <a email="'.$contacts->email.'" fname="'.$contacts->fname.'" lanme="'.$contacts->lname.'" class="btn btn-xs btn-info btn-xs btn-rounded single_contact">Reply <i class="icon icon-reply"></i></a>
                  ';

                })->editColumn('data', $contacts)->make(true);
    }
    public function contact_reply(Request $request){
        $email = $request->input('email');
        $msg = $request->input('msg');
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $subject = $request->input('subject');

        Mail::send('emails.admin_reply',['fname'=>$fname,'lname'=>$lname,'msg'=>$msg], function ($m) use($request) {
            $m->from('shahzaib.imran.aimviz@gmail.com', 'JumpNotes');
            $m->to($request->input('email'))->subject($request->input('subject'));
          });
          return redirect(route('dashboard_contact'));
    }
    public function cash_withdraw_view(){
        return view('dashboard.cashwithdraw');
    }

    public function withdraw_datatable(){
      $transactions = Tutor_earning::select('tutor_earnings.id as te_id', 'tutor_earnings.*', 'users.*')->join('users','users.id','=','tutor_earnings.user_id')->get();
      return Datatables::of($transactions)->addColumn('action',
                  function($transactions){
  if($transactions->pay_status == 0){
                      return
                    '<a data-id="'.$transactions->te_id.'" class="btn btn-xs btn-warning btn-rounded payed">Done</a>';
                  }
                  else{
                    return '
                    <label class="label label-success label-xs"> Payed</label>
                    ';
                  }

                  })->editColumn('data', $transactions)->make(true);
    }
    public function updatePaystatus($id){

        $update = Tutor_earning::where('id', $id)->update(array('pay_status'=>1));
        if($update){
          echo \Response::json(array('success' => true), 200);
        }
    }

    public function admin_aboutus(){
      $data['maincontent'] = $aboutmain[0];
      $data['team'] = Aboutus_team::all();
      $data['testimonials'] = Aboutus_testimonial::all();
      return view('dashboard.contents.aboutus_admin')
      ->with($data);
    }
    public function aboutcontent_post(){
      
    }
}
