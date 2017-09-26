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
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Subscription;

class PaymentController extends Controller
{

    public function __construct(){
      parent::__construct();
      $this->middleware('auth');
      

   }

   public function postNotify(Request $request)
{
    // Import the namespace Srmklive\PayPal\Services\ExpressCheckout first in your controller.
    $provider = new ExpressCheckout;
    $response = (string) $provider->verifyIPN($request);

    if ($response === 'VERIFIED') {
      $data = [];

$data['items'] = [
  [
      'name'  => "Monthly Subscription",
      'price' => 0,
      'qty'   => 1,
  ],
];

$data['subscription_desc'] = "Monthly Subscription #1";
$data['invoice_id'] = 1;
$data['invoice_description'] = "Monthly Subscription #1";
$data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
$data['cancel_url'] = url('/');

$total = 0;
foreach ($data['items'] as $item) {
  $total += $item['price'] * $item['qty'];
}

$data['total'] = $total;

$amount = 9.99;
$description = "Monthly Subscription #1";
$response = $provider->createMonthlySubscription($token, $amount, $description);

// To create recurring yearly subscription on PayPal
$response = $provider->createYearlySubscription($token, $amount, $description);
    }

}

    public function index(){
    	return view('dashboard.payment.index')
      ->with('your_note_count', $this->your_note_count)
      ->with('logo_file', $this->logo_file);
    }

    public function payment_post(Request $request){

             \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

              $customer = $customer = \Stripe\Customer::create(array(
                "description" => "Customer for ".$request->input('stripeEmail'),
                "source" => 'tok_visa',
              ));
              
              $customer_id = $customer->id;
              //dd($customer_id);

              $subcription = \Stripe\Subscription::create(array(
                "customer" => $customer_id,
                "items" => array(
                  array(
                    "plan" => "tutorSubscription",
                  ),
                )
              ));

              if($subcription->id){
                  $request->session()->flash('payment_success', 'Tutor Succesfully Payed!');
                  /* Updating Tutor Table */
                  $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['is_paid' => 1, 'subs_return' => $subcription->id]);
                  $tutor_update = Tutor::where('users_id', Auth::user()->id)->update(['expiry_date' => Carbon::now()->addYear() ]);
                  $tutor_update = On_trail::where('user_id', Auth::user()->id)->delete();

                  if(!$tutor_update){
                      $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
                      return Redirect::route('payment_index');
                  }

                return Redirect::route('profile_index');
             }else{
                  $request->session()->flash('payment_tab_cancel', 'Tutor Payment Cancelled!');
                  return Redirect::route('payment_index');
             }

              /*dd($subcription);

             return Redirect::to( $redirectUrl );

    	       return view('dashboard.payment.index')
             ->with('your_note_count', $this->your_note_count)
             ->with('logo_file', $this->logo_file);
             ;*/
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

           		return Redirect::route('profile_index');
           }else{
           	    $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
           		return Redirect::route('profile_index');
           }
    }

    public function getPaypalPaymentCancel(Request $request){
      $request->session()->flash('payment_tab_cancel', 'Tutor Payment Cancelled!');
      return Redirect::route('payment_index');
    }
}
