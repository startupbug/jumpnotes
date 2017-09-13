<?php
namespace App\Http\ViewComposer;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Auth;
use App\User;
use App\Unread_msg;
class MasterComposer {

    protected $users;
    public function __construct(UserRepository $users) {
        if(Auth::check()) {
            $this->unread_msgs = 0;
            if(Unread_msg::where('user_id',Auth::user()->id)->exists()){
                $this->unread_msgs = Unread_msg::where('user_id',Auth::user()->id)->count();
            }
        }
    }
    public function compose(View $view)
    {
        $view->with('unread_msgs', $this->unread_msgs);
    }

}



