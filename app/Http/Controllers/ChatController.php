<?php

namespace App\Http\Controllers;

use App\Institute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chat_group;
use App\Chat_msg;
use Auth;
use App\User;
use App\Unread_msg;
use App\Tutor;
use Illuminate\Support\Facades\Input;
class ChatController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function inbox_index(){
        $userID = Auth::user()->id;
        $data['unread_chat'] = 0;
        $data['groups_detail'] = Chat_group::whereRaw("find_in_set('{$userID}',user_ids)")->orderBy('group_id', 'desc')->get();
        if(Unread_msg::where('user_id',Auth::user()->id)->exists()){
            $data['unread_chat'] = Unread_msg::where('user_id',Auth::user()->id)->get();
        }
$profile_pic[0] = "";
        foreach($data['groups_detail'] as $grp_detail){

          $ids = explode(',',$grp_detail->user_ids);
          if(sizeof($ids)<3){
            foreach($ids as $user_id){
              $profile_pic[$user_id] = User::select('profile_pic')->where('id',$user_id)->first();
            }
          }
        }
          return view('message.inbox')->with($data)
              ->with('your_note_count', $this->your_note_count)
              ->with('logo_file', $this->logo_file)
              ->with('tutor_globalflag',  $this->tutor_globalflag)
              ->with('tutor_earning', $this->tutor_earning)
              ->with('profile_pic',$profile_pic);
    }
    public function ajax_get_chat_msg($id){
        $data = Chat_msg::where('group_id',$id)->get();
        if(Unread_msg::where('user_id',Auth::user()->id)->exists()){
            Unread_msg::where('user_id',Auth::user()->id)->delete();
        }
        $users_all = Chat_group::where('group_id',$id)->first();
        $inst_flag = Institute::where('institute_name',$users_all->group_name)->exists();
        $users_all = explode(',',$users_all->user_ids);
        $user = '';

        //Group Users add Dropdown Creation
          $institutes = array();
          $users = array();
            foreach($users_all as $users){
                if($users != Auth::user()->id){
                    $username = User::select('username')->where('id',$users)->first();
                    $user .= '<li><a href="#">'.$username->username.'</a></li>';
                }
                //Getting Group users institute id
                $institute = User::select('institute_id')->where('id',$users)->first();
                if(!in_array($institute->institute_id, $institutes)){
                    array_push($institutes,$institute->institute_id);
                }
            }

            //Getting other users of given Institute in current group chat.
             $other_users = User::select('users.email', 'users.id')
                                ->whereIn('institute_id', $institutes)
                                ->whereNotIn('users.id', $users_all)
                                ->get();
        $html = '';
        $group_id = $id;
      if(!empty($data) && isset($data)){
        foreach($data as $msg){
            if($msg->user_id != Auth::user()->id){//other user
                $user_msg = User::select('username','profile_pic')->where('id',$msg->user_id)->first();
                if($user_msg->profile_pic == null || empty($user_msg->profile_pic) || !isset($user_msg->profile_pic)){
                  if($msg->file == 1){
                    $file_path = asset('/public/chat_attachments/').'/'.$msg->attachment;
                    $download_path = route('download_file',$msg->attachment);

                    $html .= '<li class="left clearfix">
                     			<span class="chat-img1 pull-left">
                     			<img src="'.asset('/public/images/chat_user.png').'" alt="User Avatar" class="img-circle">
                     			</span>
                     			<div class="chat-body1 clearfix">
                        			<p>'.$msg->msg_text.'
                              <br>
                                <samll><a href="'.$file_path.'" download="'.$download_path.'">'.$msg->attachment.' <i class="fa fa-download"></i></a></samll></p>
								</div>
                  			  </li>';


                  }
                  else{

                    $html .= '<li class="left clearfix">
                     			<span class="chat-img1 pull-left">
                     			<img src="'.asset('/public/images/chat_user.png').'" alt="User Avatar" class="img-circle">
                     			</span>
                     			<div class="chat-body1 clearfix">
                        		<p>	'.$msg->msg_text.'</p>
                                </div>
                  			  </li>';

                  }

                         }
                         else{
                           if($msg->file == 1){
                             $file_path = asset('/public/chat_attachments/').'/'.$msg->attachment;
                             $download_path = route('download_file',$msg->attachment);

                             $html .= '
							<li class="left clearfix">
                     			<span class="chat-img1 pull-left">
                     			<img src="'.asset('/public/profile_pics/').'/'.$user_msg->profile_pic.'" alt="User Avatar" class="img-circle">
                     			</span>
                     			<div class="chat-body1 clearfix">
                        			<p>'.$msg->msg_text.'
                              <br>
								<samll><a href="'.$file_path.'" download="'.$download_path.'">'.$msg->attachment.' <i class="fa fa-download"></i></a></samll></p>
                                </div>
                  			  </li>
										';

                           }
                           else{

                           $html .= '
<li class="left clearfix">
                     			<span class="chat-img1 pull-left">
                     			<img src="'.asset('/public/profile_pics/').'/'.$user_msg->profile_pic.'" alt="User Avatar" class="img-circle">
                     			</span>
                     			<div class="chat-body1 clearfix">
                        			<p>'.$msg->msg_text.'</p>

                                </div>
                  			  </li>';

                                      }
                         }
            }//other user end
            else{
              if(Auth::user()->profile_pic == null || empty(Auth::user()->profile_pic) || !isset(Auth::user()->profile_pic)){
                if($msg->file == 1){
                  $file_path = asset('/public/chat_attachments/').'/'.$msg->attachment;
                  $download_path = route('download_file',$msg->attachment);
                  $html .= '<li class="left clearfix admin_chat_color">
                  <span class="chat-img1 pull-right">
                  <img src="'.asset('/public/images/chat_user.png').'" alt="User Avatar" class="img-circle">
                  </span>
                          <div class="chat-body1 clearfix">
                              <p>'.$msg->msg_text.'
                              <br>
                               <samll><a href="'.$file_path.'" download="'.$download_path.'">'.$msg->attachment.' <i class="fa fa-download"></i></a></samll></p>
                  </div>
                          </li>';

                }
                else{
                  $html .= '<li class="left clearfix admin_chat_color">
                  <span class="chat-img1 pull-right">
                  <img src="'.asset('/public/images/chat_user.png').'" alt="User Avatar" class="img-circle">
                  </span>
                          <div class="chat-body1 clearfix">
                                <p>'.$msg->msg_text.'</p>
                              </div>
                          </li>';
                }

                       }
              else{
              if($msg->file == 1){
                $file_path = asset('/public/chat_attachments/').'/'.$msg->attachment;
                $download_path = route('download_file',$msg->attachment);
                $html .= '<li class="left clearfix admin_chat_color">
                <span class="chat-img1 pull-right">
                <img src="'.asset('/public/profile_pics/').'/'.Auth::user()->profile_pic.'" alt="User Avatar" class="img-circle">
                </span>
                     		<div class="chat-body1 clearfix">
                        		<p>'.$msg->msg_text.'
                            <br>
                             <samll><a href="'.$file_path.'" download="'.$download_path.'">'.$msg->attachment.' <i class="fa fa-download"></i></a></samll></p>
							</div>
                  			</li>';

              }
              else{

                $html .= '<li class="left clearfix admin_chat_color">
                <span class="chat-img1 pull-right">
                <img src="'.asset('/public/profile_pics/').'/'.Auth::user()->profile_pic.'" alt="pic here" class="img-circle">
                </span>
                     		<div class="chat-body1 clearfix">
                        			<p>'.$msg->msg_text.'</p>
                            </div>
                  			</li>';
                    }
                    }
            }
          }// end foreach
        }
        else{
          $html .= '<li class="text-center">
                <div class="chat-body1 clearfix">
                    <p>No chat available</p>
      </div>
                </li>';
        }

        return \Response::json(array('success' => true,'inst_flag'=>$inst_flag,'otherUsers'=>$other_users,'group_id'=> $group_id,'users'=>$user, 'html'=> $html, 'data' => 'Chat Successfully Added'), 200);
        exit();
    }

    public function create_group(Request $request){

        $chat_group = new Chat_group();
        $chat_group->group_name = $request->input('group_name');
        $chat_group->user_ids = $request->input('tutor_id');
        $chat_group->user_ids .= ',';
        $chat_group->user_ids .= Auth::user()->id;

        if($chat_group->save()){
            return \Response::json(array('success' => true, 'msg' => 'Chat Successfully Added'), 200);
        }else{
            return \Response::json(array('success' => false, 'msg' => 'Chat Couldnot be Added'), 422);
        }
    }

    public function newMsgPost(Request $request){
        $new_chat_msg = new Chat_msg();
        $new_chat_msg->group_id = $request->input('group_id');
        $new_chat_msg->msg_text = $request->input('chatmsg');
        $new_chat_msg->user_id = Auth::user()->id;

        if(Input::hasFile('attachment')) {

            $file = Input::file('attachment');
                //is image
                //return 'maaz';
                $finalpath = "";
                $file = Input::file('attachment');
                $tmpFilePath = '/chat_attachments/';
                $tmpFileName = time() . '-' . $file->getClientOriginalName();
                $tmpFileName = preg_replace('/\s+/', '', $tmpFileName);
                $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                $path = $tmpFileName;
                $finalpath .= $path;
                /*if ($i != $count_file - 1) {
                    $finalpath .= ',';
                }*/

                $new_chat_msg->attachment = $finalpath;
                $new_chat_msg->file = 1;
            }

        if($new_chat_msg->save()){
            $msg_id = $new_chat_msg->id;
            $gr_id = $request->input('group_id');
            $user_ids = Chat_group::select('user_ids')->where('group_id',$gr_id)->first();
            $user_ids = explode(',',$user_ids->user_ids);
            foreach($user_ids as $user_id){
                if($user_id != Auth::user()->id){
                    \DB::table('unread_msgs')->insert([
                        ['grp_id' => $gr_id, 'user_id' => $user_id]
                    ]);
                }
            }
            return \Response::json(array('success' => true, 'msg' => 'Chat Successfully Added'), 200);
        }else{
            return \Response::json(array('success' => false, 'msg' => 'Chat Could not be Added'), 422);
        }
    }
    public function newGroupUsr(Request $request){
        $userid = $_POST['new_usr'];
        $gr_id = $_POST['gr_id'];
        $model = Chat_group::where('group_id',$gr_id)->first();
        $model->user_ids .= ','.$userid;
        $values = array('user_ids' => $model->user_ids);
        $update = Chat_group::where('group_id', $gr_id)->update($values);
        if($update){
          $request->session()->flash('status', 'New user added successfully!');
            // return redirect(route('inbox_index'));
            return redirect(route('profile_index'));
            print_r('all set');
        }
        else{
         print_r('something went wrong');
        }
    }
}
