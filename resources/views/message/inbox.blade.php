@extends('masterlayout')
@section('content')
<style>
    .active{
        background-color: rgba(48, 165, 255, 0.59);
        color:#FFFFFF;!important
    }
</style>
<div class="container-fluid text-center trans-text">
  <h3>INBOX</h3>
</div>



	<!-- / PAYMENT FORM BLOCK -->

<div class="courses-page">
<div class="container">

<div class="courses-text">

<div class="row mg-bt">
	<div class="col-lg-12 col-md-12 min-height">
		{{--<div class="row courses">--}}
        	{{--<div class="col-lg-12 col-sm-12 col-md-12 detail">--}}
            	{{--<h3 class="title">Maria Joseph</h3>--}}
            {{--</div>--}}
        	{{--<div class="col-lg-2 col-md-12 text-center">--}}
            {{--<img src="{{ asset('public/images/jason-bontan.png') }}">--}}
            {{--</div>--}}
            {{--<div class="col-lg-10 col-md-12 detail">--}}
            	{{--<h4 class="twitter">@jason123</h4>--}}
                {{--<ul class="pro-detail">--}}
                	{{--<li class="gender">Gender : <span>Female</span></li>--}}
                    {{--<li class="location">Location : Country.State</li>--}}
                    {{--<li class="school">School/College : <span>Neque Porro quisquam est qui dolorem</span></li>--}}
                    {{--<li class="charges">Per Hrs.Charges : <span>$50</span></li>--}}
                    {{--<li class="expertise">Major : <span>Effective Oral and written Communication</span></li>--}}
                 {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
        	{{--<div class="col-lg-12 col-sm-12 col-md-12 profile-menu">--}}
            	{{--<ul>--}}
                	{{--<li><a href="#">Activity</a></li>--}}
                    {{--<li><a href="#">Profile</a></li>--}}
                    {{--<li><a href="#">Notifications <span>0</span></a></li>--}}
                    {{--<li><a href="#" class="active">Messages <span>0</span></a></li>--}}
                    {{--<li><a href="#">Followers <span>0</span></a></li>--}}
                    {{--<li><a href="#">Groups <span>3</span></a></li>--}}
                    {{--<li><a href="#">Notes <span>2</span></a></li>--}}
                    {{--<li><a href="#">Settings</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="col-lg-12 col-sm-12 col-md-12 profile-menu">--}}
            	{{--<ul>--}}
                	{{--<li><a href="#"  class="active">Inbox</a></li>--}}
                    {{--<li><a href="#">Starred</a></li>--}}
                    {{--<li><a href="#">Sent</a></li>--}}
                    {{--<li><a href="#">Compose</a></li>--}}

                {{--</ul>--}}
            {{--</div>--}}


            <div class="container-fluid mg-top no-padding">

  <ul class="nav nav-tabs no-bd-bt">
    <li class="active"><a data-toggle="tab" href="#home">Chats</a></li>
    <li><a data-toggle="tab" href="#menu1">Chats' Group</a></li>
    <li><a href="{{ route('requestsView') }}">Your Requests</a></li>

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="col-lg-4 col-md-4 col-sm-12 inbox-items">
                @foreach($groups_detail as $single_detail)
                    <?php $user_count = explode(',',$single_detail->user_ids);?>
                    @if($single_detail->user_id != Auth::user()->id && sizeof($user_count)<3)
            	<div class="row bd">
                    <a href="#" class="get_group_data" url="{{route('get_msg',['id'=>$single_detail->group_id])}}" group_id="{{$single_detail->group_id}}">
                	<div class="col-lg-3 col-md-3 col-sm-2 col-xs-3 inbox-item-single inbox-pic">
                    	{{--<img src="{{ asset('public/images/inbox-pic.png') }}">--}}
                      @foreach ($profile_pic as $key => $value)
                      @if(Auth::user()->id != $key && in_array($key, $user_count))
                          @if(empty($value) || !isset($value) || $value == Null)
                              <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" class="img-responsive">
                          @else
                              <img src="{{ asset('public/profile_pics/'.$value->profile_pic) }}" class="img-responsive">
                              <?php break;?>
                          @endif
                        @endif
                      @endforeach

                        <!-- <i class="fa fa-users fa-3x" aria-hidden="true"></i> -->
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-10 col-xs-9 inbox-item-single no-padding">
                    	<h3 class="mgg-top10 no-marg-bottom popup">{{$single_detail->group_name}}
                            <?php $count = 0; ?>
                            @if($unread_chat != '0')
                                @foreach($unread_chat as $ur_chat)
                                    @if($ur_chat->grp_id == $single_detail->group_id)
                                        <?php $count++?>
                                    @endif
                                @endforeach
                            @endif
                        <span>{{$count}}</span>
                        </h3>
                        <p>one on one chat</p>

                    </div>
                    </a>
            	</div>
                    @endif
                @endforeach
             </div>
             <div class="col-lg-7 col-md-7 col-sm-12 inbox-items mg-lt mg-bt">
                <h3 class="text-center blck chatroom">
                    <a href="#" class="pull-left btn btn-link btn-xs add_usr" data-toggle="modal" data-target="#userModal">add new user</a>
                    Chat Room

                <small class="dropdown navbar-right usr_list">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right"><i class="fa fa-users"></i> Group members</a>
                    {{--<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">members--}}
                        {{--<span class="caret"></span></button>--}}
                    <ul class="dropdown-menu users">

                    </ul>
                </small>
                </h3>
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<li>--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right"><i class="fa fa-dot fa-2x">...</i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}

                                {{--<li>mzkhan</li>--}}
                                {{--<li>mzkhan</li>--}}
                                {{--<li>mzkhan</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
            	<div class="chat">

                </div>
                <style>
                    .chat{
                        max-height: 450px;
                        overflow: hidden;
                        overflow-y: auto;
                    }
                </style>
                <div class="row pd">
                    <form class="newMsg" action=" {{ route('newMsgPost') }}">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 fleft mg-rt">
                    <div class="form-group card-nos enter-msg col-md-12">
                        <input type="hidden" value="" name="group_id" class="group_id"/>
                        <input type="text" class="form-control fleft-input card-no"  name="chatmsg" placeholder="Enter Message">


                        {{--<a href="#"><img src="{{ asset('public/images/attachment.png') }}"></a>--}}
                         </div>
                     </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 send-button fleft">
                        <input type="submit" class="btn btn-primary edits unfollow" value="SEND"/>
                    	{{--<a href="#" class="btn btn-primary edits unfollow"><span>SEND</span></a> --}}

                    </div>
                    </form>
                </div>


            </div>

    </div>
    <div id="menu1" class="tab-pane fade">

      <div class="col-lg-4 col-md-4 inbox-items">
                @foreach($groups_detail as $single_detail)
				<?php $user_count = explode(',',$single_detail->user_ids);?>
                    @if($single_detail->user_id != Auth::user()->id && sizeof($user_count)>2)
            	<div class="row bd">
                    <a href="#" class="get_group_data" url="{{route('get_msg',['id'=>$single_detail->group_id])}}" group_id="{{$single_detail->group_id}}">
                	<div class="col-lg-3 col-md-3 inbox-item-single">
                    	{{--<img src="{{ asset('public/images/inbox-pic.png') }}">--}}
                        <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 inbox-item-single">
                    	<h3 class="mgg-top10 no-marg-bottom">{{$single_detail->group_name}}</h3>
                        <p>Chat Group</p>
                    </div>
                    </a>
            	</div>
                    @endif
                @endforeach
             </div>
             <div class="col-lg-7 col-md-7 inbox-items mg-lt mg-bt">
                <h3 class="text-center blck">
                    <a href="#" class="pull-left btn btn-link btn-xs add_usr" data-toggle="modal" data-target="#userModal">add new user</a>
                    Chat Room

                <small class="dropdown navbar-right usr_list">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right"><i class="fa fa-users"></i> Group members</a>
                    {{--<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">members--}}
                        {{--<span class="caret"></span></button>--}}
                    <ul class="dropdown-menu users">

                    </ul>
                </small>
                </h3>
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<li>--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right"><i class="fa fa-dot fa-2x">...</i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}

                                {{--<li>mzkhan</li>--}}
                                {{--<li>mzkhan</li>--}}
                                {{--<li>mzkhan</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
            	<div class="chat">

                </div>
                <style>
                    .chat{
                        max-height: 450px;
                        overflow: hidden;
                        overflow-y: auto;
                    }
                </style>
                <div class="row pd">
                    <form class="newMsg" action=" {{ route('newMsgPost') }}">
                    <div class="col-lg-10 col-md-10 fleft mg-rt">
                    <div class="form-group card-nos col-md-12">
                        <input type="hidden" value="" name="group_id" class="group_id"/>
                        <input type="text" class="form-control fleft-input card-no" name="chatmsg" placeholder="Enter Message">


                        {{--<a href="#"><img src="{{ asset('public/images/attachment.png') }}"></a>--}}
                         </div>
                     </div>
                    <div class="col-lg-2 col-md-2 fleft">
                        <input type="submit" class="btn btn-primary edits unfollow" value="SEND"/>
                    	{{--<a href="#" class="btn btn-primary edits unfollow"><span>SEND</span></a> --}}

                    </div>
                    </form>
                </div>


            </div>


    </div>

  </div>
</div>


            <div class="clearfix">&nbsp;</div>




        </div>
	</div>
</div>
    <div id="userModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New USer</h4>
                </div>
                <div class="modal-body">
                    <form id="notes_form" method="post" role="form" action="{{route('new_group_usr')}}">
                        <div class="form-group">
                        <select name="new_usr" class="form-control newusrs_list">

                        </select>
                        </div>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="gr_id" value="" class="gr_id"/>
                        <input type="submit" name="submit" value="submit" class="btn btn-primary"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- TUTOR INFO -->
</div>



</div>

</div>
</div>

   <!-- Payment Form BLOCK  END-->
<script>
    $(document).ready(function(){
        $('.add_usr').hide();
        $('.usr_list').hide();
        global_group_id = '';
        $('#newMsg').hide();
$('.get_group_data').on('click',function(e){
   e.preventDefault();
    $('#newMsg').show();
    var id = $(this).attr('group_id');
    var url = $(this).attr('url');
    $('.bd').removeClass('active');
    $(this).closest('div').addClass('active');
    $.ajax({
        url: url,// $("#register_form :input[name!=password2]").serializeArray()
        type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        cache: true,
        success: function( data ) {
            $html = data.html;
            $users = data.users;
            $otherusers = data.otherUsers
            $new_users = data.new_users;
            $(".group_id").val(data.group_id);
            global_group_id = data.group_id;
            initiateChatLoop();
            $('.chat').html($html);
            $('.users').html($users);
            console.log(data.inst_flag);
            if(!data.inst_flag){
                $('.add_usr').show();
            }
            else{
                $('.add_usr').hide();
            }
            $('.usr_list').show();
            $useroptions = '';
            $.each($otherusers,function(key,val){
               $useroptions += '<option value="'+val.id+'">'+val.email+'</option>';
            });
            $('.newusrs_list').html($useroptions);
            $('#userModal').find('.gr_id').val(global_group_id);
            $('.chat').scrollTop($('.chat')[0].scrollHeight);
        },
        error:function( data ) {
            console.log(data);
        }
    });
});

function getChatLog(groupId){
//    console.log("groupId" + groupId);
    var url = 'group_msg/' + groupId; //
    $.ajax({
        url: url,// $("#register_form :input[name!=password2]").serializeArray()
        type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        cache: true,
        success: function( data ) {
//            console.log(data.html);
            $html = data.html;
            $(".group_id").val(data.group_id);
            $('.chat').html($html);
//            $('.chat').scrollTop($('.chat')[0].scrollHeight);
        },
        error:function( data ) {
            console.log(data);
        }
    });

}

/* New Chat Message Form */
$('.newMsg').submit(function(e){
    e.preventDefault();
        var formData = new FormData(this);
//        console.log(formData);
        var group_id = $(".group_id").val();
        var url = $(this).attr('action');
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });

    $.ajax({
        url: url,// $("#register_form :input[name!=password2]").serializeArray()
        type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        data: formData,
        processData: false,
        contentType: false,
        cache: true,
        success: function( data ) {
//            console.log(data);
            getChatLog(group_id);
            $('.chat').scrollTop($('.chat')[0].scrollHeight);
            $('.card-no').val('');
        },
        error:function( data ) {
            console.log(data);
        }
    });
});

function initiateChatLoop() {
    setInterval(function () {
        getChatLog(global_group_id);
    }, 2500);
}

    });

</script>
@endsection
