<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//View
Route::get('/flush', function(){
    $exitCode = Artisan::call('config:cache');
    //Cache::flush();
    dd('Cache cleared');
});
Route::get('/about', 'HomeController@about')->name('about_index');

Route::post('ipn/notify','PaymentController@postNotify');

Route::get('api/get-state-list','TutorController@getStateList');
Route::get('api/get-city-list','TutorController@getCityList');
Route::get('api/get-code-list','TutorController@getCountryCode');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/auth', 'HomeController@auth_view')->name('auth_view');
Route::get('/notes', 'HomeController@notes_view')->name('notesView');
Route::post('/register', 'Auth\AuthController@create')->name('signup');
Route::post('/signin', 'Auth\AuthController@access')->name('signin');
Route::get('/verifyemail/{token}', 'Auth\AuthController@verifyEmail')->name('verifyemail');
Route::get('/social_shared/{token}', 'HomeController@social_shared')->name('social_shared');
//Route::get('/signin', 'HomeController@login_view')->name('signinView');
Route::post('/register', 'Auth\AuthController@create')->name('signup');
Route::post('/signin', 'Auth\AuthController@access')->name('signin');

Route::post('/forgotPass', 'Auth\AuthController@forgot_pass')->name('forgotPass');
Route::get('/updatePassView/{token}', 'Auth\AuthController@updatePassView')->name('updatePassView');
Route::post('/updatePass', 'Auth\AuthController@updatePass')->name('updatePass');

Route::group(['middleware' => ['auth']], function () { //////////////////////////////////////////////------------------------Middleware

  //Auth middleware will do the Authentication check on told Routes.
Route::post('/std_profile', 'ProfileController@std_profile_edit')->name('std_profile_completion');
Route::post('/std_profile_pic', 'ProfileController@std_profile_pic')->name('std_profile_pic');

Route::get('/becomeTutor', 'HomeController@tutor_register_view')->name('tutorRegisterView');


Route::get('/single_note/{id}', 'NotesController@view_single_note')->name('single_note');


Route::get('/notes_view', 'HomeController@notes_view')->name('notesView');
Route::get('/bookings', 'DashboardController@booking_requests')->name('requestsView');

Route::get('download/{path}','HomeController@download')->name('download_file');
Route::get('transcript_download/{path}','HomeController@transcript_download')->name('transcript_download');
Route::get('/tutor_approval/{id}','DashboardController@tutor_approval')->name('tutor_approval');
Route::get('/deleteTutor/{id}','DashboardController@deleteTutor')->name('deleteTutor');
Route::get('/dashboard/cacenlsubscription/{id}','PaymentController@cancelSubscription')->name('cancelsubs');
Route::get('/dashboard/withdraw_cash_view', 'DashboardController@cash_withdraw_view' )->name('cash_withdraw_view');
Route::get('/dashboard/withdraw_cash', 'DashboardController@withdraw_datatable' )->name('cash_withdraw');
Route::get('/dashboard/changepaystatus/{id}', 'DashboardController@updatePaystatus' )->name('cash_payed');

//testing
    Route::post('/testbraintree', 'PaymentController@addOrder')->name('brainTest');
//    testing end
  //Tutor process


Route::post('/becomeTutor', 'TutorController@tutor_registeration')->name('tutorRegister');
Route::get('/stdBookings', 'TutorController@tutor_bookings')->name('tutorbookings');
Route::get('/tutorBookings_data', 'TutorController@tutorBooking_datatable')->name('tutorbooking_datatable');
Route::post('/tutorRatting', 'DashboardController@tutor_ratting')->name('tutorRatting');
Route::post('/tutorRattingSubmit', 'DashboardController@tutor_ratting_2')->name('tutor_ratting_2');

Route::post('/tutorRattingupdate', 'DashboardController@tutor_rating_update')->name('tutor_rating_update');
  //Auth

Route::get('/verifyemail/{token}', 'Auth\AuthController@verifyEmail')->name('verifyemail');
Route::get('/social_shared/{token}', 'HomeController@social_shared')->name('social_shared');

  //notes
  Route::post('/notes', 'NotesController@uploadNotes')->name('noteUplaod');
  Route::get('/notes/notedelete/{id}', 'NotesController@deleteNote')->name('deleteNote');

  Route::post('/notesrating', 'NotesController@note_rating')->name('note_rating');

  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('/dashboard/transaction', 'DashboardController@transactionsView')->name('dashboardTransaction');
  Route::get('/dashboard/transaction_list', 'DashboardController@transaction_datatable')->name('transaction_datatable');
  Route::get('/dashboard/std_transaction_list', 'DashboardController@std_transaction_datatable')->name('std_transaction_datatable');
  Route::get('/dashboard/booking_transaction_list', 'DashboardController@note_booking_transaction_datatable')->name('note_transaction_datatable');
  Route::post('/dashboard/getTutor', 'DashboardController@getTutor')->name('getTutor');
  Route::get('/dashboard/tutor_list', 'DashboardController@tutor_list_datatable')->name('tutor_list');
  Route::get('/profile', 'ProfileController@profile_index')->name('profile_index');
  Route::get('/editprofile', 'ProfileController@editprofile_index')->name('editprofile_index');
  Route::post('/editprofile', 'ProfileController@editprofile_post')->name('editprofile_post');

  /*Student Profile view */
  Route::get('/profile_view/{id}', 'ProfileController@public_profile_view')->name('profile_view');

  /* Payment Routes */
  Route::get('/tutorPayment', 'PaymentController@index')->name('payment_index');
  Route::get('/payment_post', 'PaymentController@payment_post')->name('payment_post');

  Route::get('/getPaymentDone', 'PaymentController@getPaypalPaymentDone')->name('getPaypalPaymentDone');
  Route::get('/getPaymentCancel', 'PaymentController@getPaypalPaymentCancel')->name('getPaypalPaymentCancel');;

  /*Tutor Controller*/

  Route::get('/tutors', 'TutorController@tutor_index')->name('tutorsView');
  Route::post('/booktutor', 'TutorController@book_tutor')->name('bookTutor');

  Route::get('/inbox', 'ChatController@inbox_index')->name('inbox_index');

  /* Booking Payment */
Route::post('/booking_payment', 'DashboardController@book_payment')->name('booking_payment');
Route::post('/subscription_payment', 'NotesController@download_payment')->name('download_payment');
Route::get('/getTutorLessonPayDone', 'DashboardController@getPaypalPaymentDone')->name('getLessonPaymentDone');
Route::get('/getTutorLessonPayCancel', 'DashboardController@getPaypalPaymentCancel')->name('getLessonPaymentCancel');
Route::get('/downloadPaymentReceived', 'NotesController@downloadPaymentReceived')->name('getstdSubscriptionDone');
Route::get('/downloadPaymentCancel', 'NotesController@downloadPaymentCancel')->name('getStdSubscriptionCancel');
Route::post('single_note/multi_download/{arr}', 'NotesController@multi_download')->name('multi_download');
Route::get('dashbaord/aboutusedit1', 'HomeController@aboutus_edit_sec1')->name('edit_sec1');

});////////////////////////////////////////////////////--------------------------------------------------Middleware

//logout
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

//Middleware
Route::post('/signin', 'Auth\AuthController@access')->name('signin');

Route::post('/addNewUsr', 'ChatController@newGroupUsr')->name('new_group_usr');

/* Notes Controller */
Route::get('/notes', 'NotesController@notes_index')->name('notes_index');

//Route::get('/single-notes/{id}', 'NotesController@single_note_index')->name('single_notes_index');

Route::post('/note_search', 'NotesController@noteSearch')->name('noteTextSearch');
Route::post('/commentpost', 'NotesController@notecomment')->name('notecommentpost');
Route::get('/loadcomments/{id}/{note_id}', 'NotesController@getcomments')->name('loadcomments');
Route::get('/tutor_notes/{id}', 'NotesController@tutor_notes')->name('tutor_notes');

Route::post('/note_drop', 'NotesController@noteDrop')->name('noteDropSearch');

Route::post('/tutor_search', 'TutorController@tutorSearch')->name('tutorSearch');
Route::get('/group_user_check/{id}', 'TutorController@group_user_check')->name('group_user_check');


Route::get('/faqs', 'HomeController@faq_index')->name('faq_index');
Route::get('/terms_conditions', 'HomeController@terms_index')->name('terms');
Route::get('/privacy', 'HomeController@privacy_index')->name('privacy');
Route::get('/contact', 'HomeController@contact_index')->name('contact');
Route::post('/contactus', 'HomeController@contact_post')->name('contact_post');
Route::post('/contact_reply', 'DashboardController@contact_reply')->name('contact_reply');
Route::post('/std_reply', 'TutorController@std_reply')->name('std_reply');
Route::get('/dashboard_contact', 'DashboardController@dashboard_contact')->name('dashboard_contact');
Route::get('/contact_datatable', 'DashboardController@contact_datatable')->name('contact_datatable');

/* Inbox HTML */
Route::post('/create-group', 'ChatController@create_group')->name('create_group');
Route::get('/group_msg/{id}', 'ChatController@ajax_get_chat_msg')->name('get_msg');
Route::post('/newMsg', 'ChatController@newMsgPost' )->name('newMsgPost');
Route::post('/paypalemail', 'PaymentController@set_paypal_email' )->name('paypal_email');
Route::post('/withdraw_datatable', 'DashboardController@set_paypal_email' )->name('paypal_email');


/* Data Dynamic Routes */
//Header
Route::get('/header-logo', 'DynamicController@logo_index')->name('logo_index');

Route::post('/header-logo', 'DynamicController@logo_post')->name('logo_post');

//Slider Update
Route::get('/slider-update', 'DynamicController@slider_index')->name('slider_index');
//Slider Update
Route::post('/slider-update', 'DynamicController@slider_post')->name('slider_post');

//Route::get('/single-notes/{id}', 'NotesController@single_note_index')->name('single_notes_index');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '/';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '/';
});

//Clear Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '/';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '/';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '/';
});
use Twilio as Twilio;

Route::get('/sms', function () {




//echo phpinfo();
//die();

    $check ="";

    try {
// Your Account Sid and Auth Token from twilio.com/user/account

        $sid = 'AC3e595b70abb09a692b538d42a798c2d2';
        $token = '762ec7f9dbbd64b05294a4faa84661a3';

        $client = new \Services_Twilio($sid, $token);

        $message = $client->account->messages->sendMessage(
            '+15803660904 ',  // From a valid Twilio number
            '+923012121189', // Text this number
            "New Lesson Booked!" // message
        );

        $check = Twilio::message(+923012121189, "Test Message");

    } catch (Exception $e) {

        echo $check;
    }

    dd('Sent');

});

/*use Twilio as Twilio;

Route::get('/sms', function () {

//echo phpinfo();
//die();

$check ="";

try {
 // Your Account Sid and Auth Token from twilio.com/user/account

$sid = 'AC767c1e7c4a42b16cfe263c480a6737c4';
$token = '53aa43b0dfdbadc8573b37d33e967e07';

$client = new \Services_Twilio($sid, $token);

$message = $client->account->messages->sendMessage(
    '+12519294976 ',  // From a valid Twilio number
   '+923012121189', // Text this number
    "New Lesson Booked!" // message
);

  $check = Twilio::message(+923012121189, "Test Message");

  } catch (Exception $e) {

    echo $check;
  }

  dd('Sentz');

});
<<<<<<< HEAD
*/


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/login/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuth',
    'as'   => 'auth.signup_signin'
]);


Route::get('/login/callback/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);




//schedule
Route::get('tutor/schedule', 'TutorController@tutorSchedule');
Route::get('tutor/set-schedule', 'TutorController@tutorSetSchedule');
Route::post('tutor/set-schedule/ajax', 'TutorController@tutorSetScheduleAjax');
Route::get('tutor/scheduleGet', 'TutorController@arrObj');

Route::post('tutor/submitShedule', 'TutorController@submitShedule')->name('submitShedule');
