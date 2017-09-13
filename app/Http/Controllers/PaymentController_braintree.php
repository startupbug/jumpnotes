<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Paypal;
use Carbon\Carbon;
use Auth;
use Redirect;
use App\Tutor;
use App\On_trail;
use Braintree_Transaction;
use Braintree_Customer;
use Braintree_WebhookNotification;
use Braintree_Subscription;
use Braintree_CreditCard;
use App\Std_subscription;
use App\Tutor_booking;
use App\Transaction;

class PaymentController extends Controller
{

    public function __construct(){
       parent::__construct();
      $this->_apiContext = Paypal::ApiContext('Ae7ZZW-AvpehkfcJThodJvZoVu5ilr1Mxg1pQIDU2h7dupVG2Lmz_7mr7lO3iewAqfRkyJIVwN0_n3f7',
          'EKMVlkDsnqHOSDP2Ye8Olho535mvfYXNUinZGYPsu9DzhM8hoCaabk1JTrMfPdIZOcMbyJqXQvnknX1C');

      $this->_apiContext->setConfig(array(
        'mode' => 'sandbox',
        'service.EndPoint' => 'https://api.sandbox.paypal.com',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'FINE'
      ));

   }

//******************Braintree Code**************
    public function addOrder(Request $request)
    {
        $card_num = $request->input('card-no');
        $card_ex = $request->input('ex-date');
        $card_cvv = $request->input('cvv');
        $card_email = $request->input('email');
        $card_fname = $request->input('fname');
        $card_lname = $request->input('lname');
        $card_phone = $request->input('phone');
        $card_subscription = $request->input('subscription');
        $card_plan = $request->input('plan_id');
        $card_amount = $request->input('amount');
        $pay_from = $request->input('pay_from');
//        $input = Input::all();
        if(empty($card_num) || empty($card_ex) || empty($card_email) || empty($card_fname)){
            $request->session()->flash('payment_danger', 'Please fill all the fields');
        }
        if(1)
        {
            $subscribed= true;
        }
        else{
            $subscribed= false;
        }
        if($pay_from == "booking_pay"){
            $booking_id = $request->input('id');
            //dd($booking_id);
            //Setting Session
            $request->session()->flash('cur_booking_id', $booking_id);

//        $booking_id = \Session::get('cur_booking_id');
//        dd($booking_id);

            $user_hours = $request->input('hours_study');
            $booking_update = Tutor_booking::where('id', $booking_id)->update(['pay_status' => 1]);
            $tutor_booking = Tutor_booking::join('tutors','tutors.tutor_id','=','tutor_bookings.tutor_id')
                ->where('tutor_bookings.id', $booking_id)->first();
            $per_hour_charges = $tutor_booking->per_hour_charges;
            $final_price = $user_hours*$per_hour_charges;
            $card_amount = $final_price;
            if($card_amount != 0 && !empty($card_amount)){
              $transaction = new Transaction;
              $transaction->user_id = Auth::user()->id;
              $transaction->pay_for = 'Tutor Booking Payment';
              $transaction->amount = $card_amount;
              $transaction->save();
            }
            if(!$booking_update){
                $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
                $customer_id = $this->registerUserOnBrainTree($card_fname,$card_lname,$card_email,$card_phone);
                echo 'customer id - '.$customer_id;/// Create card token
                $card_token = $this->getCardToken($customer_id,$card_num,$card_ex,$card_cvv);
                echo 'card_token - '.$card_token;
        /// gateway will provide this plan id whenever you creat plans there
                $plan_id = $card_plan;
                $transction_id = $this->createTransaction($card_token,$customer_id,$plan_id,$subscribed,$card_amount);

                return redirect()->back();
            }
            else{
              return redirect()->back();
            }

        }


        if($pay_from == 'tutor_subscription') {
            if ($transction_id) {
                $request->session()->flash('payment_success', 'Tutor Succesfully Payed!');
                /* Updating Tutor Table */
                $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['is_paid' => 1]);
                $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['expiry_date' => Carbon::now()->addMonth()]);
                $tutor_update = On_trail::where('user_id', Auth::user()->id)->delete();

                if (!$tutor_update) {
                    $request->session()->flash('payment_danger', 'Something went wrong!');
                    return Redirect::route('profile_index');
                }
                $transaction = new Transaction;
                $transaction->user_id = Auth::user()->id;
                $transaction->pay_for = 'Tutor Registration';
                $transaction->amount = '$3.99';
                $transaction->save();

                $customer_id = $this->registerUserOnBrainTree($card_fname,$card_lname,$card_email,$card_phone);
                echo 'customer id - '.$customer_id;/// Create card token
                $card_token = $this->getCardToken($customer_id,$card_num,$card_ex,$card_cvv);
                echo 'card_token - '.$card_token;
        /// gateway will provide this plan id whenever you creat plans there
                $plan_id = $card_plan;
                $transction_id = $this->createTransaction($card_token,$customer_id,$plan_id,$subscribed,$card_amount);

                return Redirect::route('profile_index');
            } else {
                $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
                return Redirect::route('profile_index');
            }
        }
        else if($pay_from == 'std_subscription'){
            $note_id = $request->input('note_id');
            $subs_id = '';

                $author_id = $request->input('author_id');
                $request->session()->flash('payment_success', 'Author Successfully Payed!');
                /* Updating Tutor Table */
                $std_id = Auth::user()->id;
                $std_subscription =  new Std_subscription();
                $std_subscription->author_id = $author_id;
                $std_subscription->std_id = $std_id;
                $std_subscription->expiry_date = Carbon::now()->addDays(30);
//                dd($std_subscription);
                if($std_subscription->save()){
                  $customer_id = $this->registerUserOnBrainTree($card_fname,$card_lname,$card_email,$card_phone);
                  echo 'customer id - '.$customer_id;/// Create card token
                  $card_token = $this->getCardToken($customer_id,$card_num,$card_ex,$card_cvv);
                  echo 'card_token - '.$card_token;
          /// gateway will provide this plan id whenever you creat plans there
                  $plan_id = $card_plan;
                  $subs_id = sprintf("%06d", $std_subscription->id);
                  $transction_id = $this->createTransaction($card_token,$customer_id,$plan_id,$subscribed,$card_amount,$subs_id);
                    $request->session()->flash('payment_success', 'Author Successfully Payed!!');
                    // return Redirect::route('single_note',['id' => $note_id]);
                }
                $transaction = new Transaction;
                $transaction->user_id = Auth::user()->id;
                $transaction->pay_for = 'Student Subscription';
                $transaction->amount = '$1.99';
                $transaction->save();

                if($note_id != 0){
                return Redirect::route('single_note',['id' => $note_id]);
                }
                else{
                  return Redirect::route('profile_view',['id' => $author_id]);
                }

                // $request->session()->flash('payment_danger', 'Author Successfully Payed!!');
                if($note_id != 0){
                return Redirect::route('single_note',['id' => $note_id]);
                }
                else{
                  return Redirect::route('profile_view',['id' => $author_id]);
                }

        }

        // $customer = Braintree_Customer::find($transction_id->customer->id);
    }


    public function registerUserOnBrainTree($card_fname,$card_lname,$card_email,$card_phone) {
        $result = Braintree_Customer::create(array(
            'firstName' => $card_fname,
            'lastName' => $card_lname,
            'email' => $card_email,
            'phone' => $card_phone
        ));
        if ($result->success) {
            return $result->customer->id;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error) {
                $errorFound .= $error->message . "<br />";
            }
            echo $errorFound ;
        }
    }


    public function getCardToken($customer_id,$cardNumber,$cardExpiry,$cardCVC)
    {
        $card_result = Braintree_CreditCard::create(array(
//'cardholderName' => mysql_real_escape_string($_POST['full_name']),
            'number' => $cardNumber,
            'expirationDate' => trim($cardExpiry),
            'customerId' => $customer_id,
            'cvv' => $cardCVC
        ));
        if($card_result->success)
        {
            return $card_result->creditCard->token;
        }
        else {
            return false;
        }
    }


    public function createTransaction($creditCardToken,$customerId,$planId,$subscribed,$card_amount,$sub_id = NULL){
        if($subscribed)
        {
            $subscriptionData = array(
                'paymentMethodToken' => $creditCardToken,
                'planId' => $planId,
                'id' => $sub_id
            );
            //$this->cancelSubscription();
            $subscription_result = Braintree_Subscription::create($subscriptionData);
            // echo 'Subscription id'. $subscription_result->subscription->id;
        }
        else {
            $this->cancelSubscription();
        }
        $result = Braintree_Transaction::sale(
            [
                'customerId' => $customerId,
                'amount' => $card_amount,
                'orderId' => $sub_id
            ]
        );
        if ($result->success) {
            return $result;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error1) {
                $errorFound .= $error1->message . "<br />";
            }
        }
    }


    public function cancelSubscription($id)
    {
      $id = trim($id);
      // dd($id);
        $gateway_subscription_id = $id;
        if($gateway_subscription_id!='')
        {
          $dataid = ltrim($id, '0');
          if(Braintree_Subscription::cancel($gateway_subscription_id)){
          $deletedRows = Std_subscription::where('id', $dataid)->delete();
          return('success');
          }
          return('faild');
        }
        else{
          dd('nothing return');
        }
    }


//// for subscription Braintree_WebhookNotification
    public function subscription()
    {
        try{
            if(isset($_POST["bt_signature"]) && isset($_POST["bt_payload"])) {
                $webhookNotification = Braintree_WebhookNotification::parse(
                    $_POST["bt_signature"], $_POST["bt_payload"]
                );// $message =
// "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
// . "Kind: " . $webhookNotification->kind . " | "
// . "Subscription: " . $webhookNotification->subscription->id . "\n";Log::info("msg " . Log::info("subscription " . json_encode($webhookNotification->subscription));
                Log::info("transactions " . json_encode($webhookNotification->subscription->transactions));
                Log::info("transactions_id " . json_encode($webhookNotification->subscription->transactions[0]->id));
                Log::info("customer_id " . json_encode($webhookNotification->subscription->transactions[0]->customerDetails->id));
                Log::info("amount " . json_encode($webhookNotification->subscription->transactions[0]->amount));
            }
        }
        catch (\Exception $ex) {
            Log::error("PaymentController::subscription() " . $ex->getMessage());
        }
    }

//**********************Braintree code end*****************
    public function index(){
    	return view('dashboard.payment.index')
      ->with('your_note_count', $this->your_note_count)
      ->with('logo_file', $this->logo_file);
    }

    public function payment_post(){

             $payer = PayPal::Payer();
             $payer->setPaymentMethod('paypal');

             $itemItemPrice = 3.99;
             $item = PayPal::Item();
             $item->setQuantity(1);
             $item->setName('Tutor Month Plan ');
             $item->setPrice($itemItemPrice);
             $item->setCurrency('USD');

             $itemList = PayPal::ItemList();
             $itemList->setItems(array($item));

             $totalAmount = 3.99;
             $amount = PayPal::Amount();
             $amount->setCurrency('USD');
             $amount->setTotal($totalAmount);

             $transaction = PayPal::Transaction();
             $transaction->setAmount($amount);
             $transaction->setItemList($itemList);
             $transaction->setDescription('Tutor Monthly Plan');

             $redirectUrls = PayPal:: RedirectUrls();
             $redirectUrls->setReturnUrl(action('PaymentController@getPaypalPaymentDone'));
             $redirectUrls->setCancelUrl(action('PaymentController@getPaypalPaymentCancel'));

             $payment = PayPal::Payment();
             $payment->setIntent('sale');
             $payment->setPayer($payer);
             $payment->setRedirectUrls($redirectUrls);
             $payment->setTransactions(array($transaction));

             $response = $payment->create($this->_apiContext);
             $redirectUrl = $response->links[1]->href;

             return Redirect::to( $redirectUrl );

    	       return view('dashboard.payment.index')
             ->with('your_note_count', $this->your_note_count)
             ->with('logo_file', $this->logo_file);
             ;
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
                $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['is_paid' => 1]);
                $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['expiry_date' => Carbon::now()->addMonth() ]);
                $tutor_update = On_trail::where('user_id', Auth::user()->id)->delete();

                if(!$tutor_update){
                    $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
                    return Redirect::route('payment_index');
                }

           		return Redirect::route('payment_index');
           }else{
           	    $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
           		return Redirect::route('payment_index');
           }
      /*   if($executePayment){
             if(session('paymentTab_prop_id')){
                 $prop_id = session('paymentTab_prop_id');
                 $property_bought = Propertie::find($prop_id);
                 $property_bought->is_paid = 1;
                 //$property_bought->transaction_id = $id;
                 if($property_bought->update()){
                     \Session::forget('paymentTab_prop_id');
                     $request->session()->flash('payment_tab_success', 'Tutor Succesfully Payed!');
                     return Redirect::route('payment_index');
                 }else{
                     $request->session()->flash('payment_tab_error', 'TutorCouldnot be Bought!');
                     return Redirect::route('payment_index');
                 }
             }else{
               $request->session()->flash('payment_tab_error', 'Tutor Couldnot be Bought!');
               return Redirect::route('payment_index');
             }

         }else{
           $request->session()->flash('payment_tab_error', 'TutorCouldnot be Bought!');
           return Redirect::route('payment_index');
         } */

    }

    public function getPaypalPaymentCancel(Request $request){
      $request->session()->flash('payment_tab_cancel', 'Tutor Payment Cancelled!');
      return Redirect::route('payment_index');
    }
}
