<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\ClientToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

use App\Http\Requests;

class Subscription extends Controller
{
    public function form(){
        $clientToken = ClientToken::generate();
		    return view('subscription.join', ['clientToken' => $clientToken ]);
    }
    public function join() {
		//check that we have nonce and plan in the incoming HTTP request
		if( empty( Input::get( 'payment_method_nonce' ) ) || empty( Input::get( 'plan' ) ) ){
			return redirect( '/subscription?success=false&message=' . urlencode( 'Invalid request' ), 400 );
		}
		//set user
		$user = Auth::user();
		try {
			//Try to create subscription
			$subscription = $user->newSubscription( 'main', Input::get( 'plan' ) )->create( Input::get( 'payment_method_nonce' ), [
				'email' => $user->email
			] );
		} catch ( \ Exception $e ) {
			//get message from caught error
			$message = $e->getMessage();
			//send back error message to view
			return redirect( '/subscription/join?success=false&message=' . urlencode( $message ) );
		}
		//Go to subscription manage view beacuse all is well
		return redirect( '/subscription/manage?success=true' );
	}
	public function cancel()
	{
		$user = Auth::user();
		$subscription =  $user->subscription('main')->cancel();
		return redirect( '/subscription/manage?success=true' );
	}
	public function manage()
	{
		$user = Auth::user();
		$subscriptions = $user->getSubscription();
		return view('subscription-manage', ['subscriptions' => $subscriptions, ]);
	}
}
