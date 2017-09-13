<?php

namespace App\Http\Controllers\Auth;

use App\Tutor;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\User_activation;
use App\Institute;
use Validator;
use Mail;
use Auth;
use App\Chat_group;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\On_trail;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        $email = "";

        $this->validate($request, [
            'username' => 'required|',
            'email' => 'required|unique:users,email',
            'institute' => 'required',
            'password' =>  'required|min:4|max:10|same:password2',
        ]);

        if($request->ajax()) {
            $email = $request->input('email');
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            if($request->input('institute') != 'other'){
                $user->institute_id = $request->input('institute');
            }
            else{
                $otherInstitute = strtolower($request->input('otherInstitute'));
                $newInstituteID = Institute::firstOrCreate(['institute_name' => $otherInstitute]);
                $user->institute_id = $newInstituteID->id;
            }

            $user->password = bcrypt( $request->input('password') );
            $response = $user->save();

            if($user->save()){
                if($request->input('institute') != 'other'){
                    $institute_name = Institute::select('institute_name')->where('institute_id',$request->input('institute'))->first();
                    $chat_group = Chat_group::where('group_name',$institute_name->institute_name)->first();
                    $temp = $chat_group->user_ids.','.$user->id;
                    $chat_update = Chat_group::where('group_id',$chat_group->group_id)->update(['user_ids' => $temp]);
                }
                else{
                    $chat_group = new Chat_group();
                    $chat_group->group_name = $request->input('otherInstitute');
                    $chat_group->user_ids = $user->id;
                    $chatSave = $chat_group->save();
                }

//                $seller_role = Role::find($request->input('usertype'));
//                $user->attachRole($seller_role);
                $token = str_random(30);
                $user_activation = new User_activation();
                $user_activation->user_id = $user->id;
                $user_activation->_token = $token;

                if($user_activation->save()){

                    $request_username = $request->username;
                    $request_email = $request->email;
                    Mail::send('emails.verification', ['token' => $token, 'request' => $request->all()], function ($m) use ($request_email) {
                        $m->from('shahzaib.imran.aimviz@gmail.com', 'ROD');
                        $m->to($request_email)->subject('Jumpnotes Helper for your study');
                    });
                    return \Response::json(array('success' => true, 'last_insert_id' => $user->id,
                        'html' => '<div class="success_message">
                           <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                              <strong>Congratulations!</strong> You have been successfully registered at ROD.
                               <br>
                            </div>
                            <p><b>Note: </b>We Send you and an Email to Verify your Email. Kindly Click on import
                                to verify your account.</p>
                        </div>'), 200);
                }else{
                    return \Response::json(array('success' => false, 'last_insert_id' => $user->id), 400);
                }

            }else{
                return response()->json($response);
            }

        }
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
    }

//    public function verifyEmail($token){
//        $activated_user = User_activation::where('_token', $token)->first();
//
//        if($activated_user){
//            $id = $activated_user->user_id;
//            $user_activated = User::where('id', $id)->update(['activation_status' => 1]);
//            $activated_user_del = User_activation::where('user_id', $id)->delete();
//            if($activated_user_del){
//                return redirect()->route('home')->with('success_email', 'Congratz! Email Succesfully Verified!');
//            }else{
//                // dd("Email not Verified!");
//                return redirect()->route('home')->with('error_email', 'Error! Email Couldnot Verified!');
//            }
//
//        }else{
//            //dd("Email not Verified!");
//            return redirect()->route('home')->with('error', 'Error! Email Couldnot Verified!');
//        }
//        return $activated_user;
//    }

    public function verifyEmail($token){
        $activated_user = User_activation::where('_token', $token)->first();

        if($activated_user){
            $id = $activated_user->user_id;
            $user_activated = User::where('id', $id)->update(['activation_status' => 1]);
            $activated_user_del = User_activation::where('user_id', $id)->delete();
            if($activated_user_del){
                return redirect()->route('home')->with('success_email', 'Congratz! Email Succesfully Verified!');
            }else{
                // dd("Email not Verified!");
                return redirect()->route('home')->with('error_email', 'Error! Email Couldnot Verified!');
            }

        }else{
            //dd("Email not Verified!");
            return redirect()->route('home')->with('error', 'Error! Email Couldnot Verified!');
        }
        return $activated_user;
    }

    public function access(Request $request){
        $this->validate($request, [
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password] ,true)) {
            // Authentication passed...
            $user = Auth::user();
            //$responseText = '<div class="alert alert-success"> <p>Hi, '.$username.' You have Succesfully Logged In</p></div>';
            $responseText = $user->username;

            return \Response::json(array('success' => true, 'responseText' => $responseText), 200);
            return 'logged In';

        }else{
            $responseText = '<div class="alert alert-danger"> <p>Error! Invalid Email or Password </p></div>';
            return \Response::json(array('success' => false, 'responseText' => $responseText), 400);

        }
    }

    public function logout(){


        if(Auth::check()){
            $logout = Auth::logout();
            return redirect()->route('home');
        }
        else{
            return redirect()->route('home');
        }
    }
    public function updatePass(Request $request){
        $pass = bcrypt($request->input('new_password'));
        if(User::where('remember_token', '=', Input::get('rem_token'))->update(['password' => $pass])){
//            return view('auth.signup_signin')->with('flash','your password has been updated successfully');
            $data['institutes'] = Institute::all();
            return view('auth.signup_signin')->with($data)->with('your_note_count', $this->your_note_count)

                ->with('logo_file',  $this->logo_file)->with('flash','your password has been updated successfully');
        }
        else{
            return view('auth.signup_signin')->with('flash','Could not update your password');
        }
    }

    public function updatePassView($token){

        $user = User::where('remember_token', '=', $token)->first();
        if($user !== null){
            //return \Redirect::to('authentication/updatePass')->with('token',$token);
            return view('auth.updatePass')->with('token',$token);
//            User::where('remember_token', '=', $token)->update(['password' => 'newpass']);
        }
        else{
            return view('home.index')->with('flasherror','Request Expired');
        }
    }

    public function forgot_pass(Request $request){
//        dd("asas");
        $user = User::where('email', '=', $request->input('forgot_email'))->first();
        //dd($user);
        //exit();
        if ($user === null) {
            session()->put('flasherror', 'Email not exist. Please create your account to login');
            return redirect()->route('auth_view');
        }
        else{
            $token = str_random(30);
            User::where('email', '=', Input::get('forgot_email'))->update(['remember_token' => $token]);
            $email = Input::get('forgot_email');
            Mail::send('emails.forgotPass', ['token' => $token, 'email' => $email,'user'=>$user ], function ($m) use ($user, $request) {
                $m->from('shahzaib.imran.aimviz@gmail.com', 'JUMPNOTES');
                $m->to($request->input('forgot_email'))->subject('JUMPNOTES Forgot Password alert');
            });
            $request->session()->put('flashS','please check your email for password update');
            return redirect()->route('auth_view');
//            return view('home.index')->with('flash','please check your email for password update');
//            return redirect()->action('HomeController@index',['flash','please check your email for password update']);
        }

    }

    public function getSocialAuth($provider=null)
    {
//        return \Socialize::with('facebook')->redirect();
        return \Socialize::driver('facebook')->redirect();
//        return Socialite::driver('facebook')->redirect();
    }
    public function getSocialAuthCallback($provider=null)
    {
        $user = \Socialize::with('facebook')->user();

        //now we have user details in the $user array
        dd($user);
    }



}
