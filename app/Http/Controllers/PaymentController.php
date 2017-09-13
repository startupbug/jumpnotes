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
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

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

           		return Redirect::route('profile_index');
           }else{
           	    $request->session()->flash('payment_danger', 'Tutor Succesfully Payed!');
           		return Redirect::route('profile_index');
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
