@extends('masterlayout')
@section('content')
<div class="container-fluid text-center trans-text">
  <h3>YOUR PROFILE</h3>
</div>
@if(Session::has('flasherror'))
    <script>
    toastr.error( '{{Session::get("flasherror")}}');
    </script>
    {{ Session::forget('flasherror') }}
@endif

@if(!empty($flash))
    <script>
        toastr.success('{{$flash}}<br><br>');
    </script>
@endif

@if(Session::has('status'))
<script>
    toastr.success("{{Session::get('status')}}" + '<br><br>');
</script>
{{ Session::forget('status') }}
@endif
<div class="profile-page">
  <div class="container">
    <div id="myModaltransaction" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pay To Become Featured Tutor</h4>
          </div>
          <div class="modal-body">
            <form id="transaction" method="post" role="form" action="{{route('brainTest')}}">
              <div class="row">
                <div class="col-md-12">
                  <h4>Good Luck, Your tutor profile will be featured only in $3.99/Month !!</h4>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="fname" name="fname" required placeholder="FIRST NAME">
                </div>
                <input type="hidden" name="plan_id" value="4s96" />
                <input type="hidden" name="amount" value="3.99" />
                <input type="hidden" name="subscription" value="1" />
                <input type="hidden" name="pay_from" value="tutor_subscription" />
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="card-no" required name="card-no" placeholder="CARD NUMBER">
                </div>
                <div class="form-group col-md-6">
                  <span style="color:red" class="note_title"></span>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="ex-date" name="ex-date" required placeholder="EXPIRY DATE  example : 7/17">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="phone" name="phone" required placeholder="PHONE NUMBER">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="cvv" name="cvv" required placeholder="CVC/CVV">
                </div>
                <div class="form-group col-md-12">
                  <input type="text" class="form-control" id="email" name="email" required placeholder="EMAIL">
                </div>
                {{csrf_field()}}
                <div class="form-group notes-detail col-md-12 text-center">
                  <input type="submit" class="btn btn-primary " value="Pay" />
                </div>

                {{--
                <div class="form-group col-md-12 text-center">--}} {{--
                  <hr/>OR
                  <div id="paypal-container"></div>--}} {{--
                </div>--}}
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>


      </div>
    </div>
    <div class="profile-text">
      <div class="row">
        <div class="col-lg-12 col-md-12 profile no-margin-top">
          <div class="row">


          </div>
		<!------ NEW ROW FOR PROFILE -->
		<div class="col-lg-12 no-pad-left no-pad-right timeline-pic">
			<img src="{{ asset('public/images/profile-banner.jpg') }}" />
			<div class="full-width-profile">
			<div class="col-lg-2 float extra-css">

          <!-- <div class="col-lg-2 col-md-2 col-md-offset-0 col-sm-4 col-sm-offset-4 col-sm-offset-right-4 text-center pro-col" style="display:none;"> -->

            @if(empty($tutor->profile_pic) || !isset($tutor->profile_pic))
			@if(Auth::user()->profile_pic == Null)
            <div class="profile-pic pic extra-pic masking">
              <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224">
			  <div class="mask">
				<div class="text">
					<form enctype="multipart/form-data" id="profile_upload" method="post" role="form" action="{{route('std_profile_pic')}}">
      <label for="std_profile" class="choose_file">
        <span style="display:none;">Choose File</span>
                <input type="file" name="std_profile" id="std_profile" class="form-control">
      </label>
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <input type="submit" value="upload" class="form-control upload_pic_btn" />
            </form>
            	</div>
			  </div>
			</div>

            @else
            <div class="profile-pic pic extra-pic masking">
              <img src="{{ asset('public/profile_pics/'.Auth::user()->profile_pic) }}" height="226" width="224">
				<div class="mask">
					<div class="text">
						<form enctype="multipart/form-data" id="profile_upload" method="post" role="form" action="{{route('std_profile_pic')}}">
      <label for="std_profile" class="choose_file">
        <span style="display:none;">Choose File</span>
                <input type="file" name="std_profile" id="std_profile" class="form-control std_upload_pic">
      </label>
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <input type="submit" value="upload" class="form-control upload_pic_btn" />
            </form>
            		</div>
			  	</div>
			</div>

            @endif @else
<div class="profile-pic pic extra-pic masking">
            <img src="{{ asset('public/profile_pics/'.$tutor->profile_pic) }}" height="226" width="224"></div>
			@endif




                	<!-- <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224"> -->
              <!-- </div> -->
			</div>
			<div class="col-lg-2 float no-pad-left no-pad-right">
                  <h3 class="title">
  							        {{Auth::user()->username}}
  						     </h3>
			</div>
			<div class="col-lg-8 chat-section-tabs float">
				<ul class="nav nav-tabs no-bd-bt">
                  <li class="active popup"><a data-toggle="tab" href="#home">Chats <strong>({{Config::get('unread_msgs')}})</strong></a></li>
                  <li><a data-toggle="tab" href="#menu1">Chat Groups</a></li>
                  @if(!$tutor_globalflag)
                  <li><a href="{{route('tutorRegisterView')}}">Become Tutor</a></li>
                  @endif
                  <li class="popup"><a href="{{ route('notesView') }}">My Notes <strong>({{$your_note_count }})</strong></a></li>
                  @if($tutor_globalflag)
                  <li><a href="{{route('tutorbookings')}}">Student Requests</a></li>
                  @endif
                  <li><a href="{{ route('requestsView') }}">Your Requests</a></li>

                </ul>
			</div>
			</div>

		</div>
		<!------ NEW ROW FOR PROFILE -->
		<div class="col-lg-12 bg-profile float">
			<div class="col-md-5 col-sm-5 no-pad-left no-pad-right detail">
                @if(isset($tutor))
				<h4 class="twitter">@if(isset($tutor->tutor_unique))  {{ '@'.$tutor->tutor_unique }} @endif</h4>
                 @endif
            @if($tutor_globalflag)
                <ul class="pro-detail">
                  <li class="gender"><i class="fa fa-user size" aria-hidden="true"></i>Gender : <span>@if(isset($tutor->tutor_gender)){{$tutor->tutor_gender}}@endif</span></li>
                  <li class="location"><i class="fa fa-map-marker size" aria-hidden="true"></i>Location : <span>@if(isset($tutor->state_name)) {{ $tutor->state_name }}@endif, @if(isset($tutor->country_name)) {{ $tutor->country_name }} @endif</span></li>
                  <li class="school"><i class="fa fa-graduation-cap size" aria-hidden="true"></i>Institute : <span>@if(isset($my_institute->institute_name)){{$my_institute->institute_name}}@endif</span></li>
                  <li class="charges"><i class="fa fa-hourglass-half size" aria-hidden="true"></i>Tutoring Fee Per Hour: <span>$@if(isset($tutor->per_hour_charges))  {{ $tutor->per_hour_charges }}@endif</span></li>
                  <li class="expertise"><i class="fa fa-forumbee size" aria-hidden="true"></i>Major : <span>@if(isset($tutor->tutor_majors)){{$tutor->tutor_majors}}@endif</span></li>
                  <li class="ratings"><i class="fa fa-heart size" aria-hidden="true"></i>Ratings : @if(isset($tutor->tutor_rating)) @for($i=0; $i
                    <round($tutor->tutor_rating); $i++)
                      <span class="glyphicon glyphicon-star"></span> @endfor @endif
                  </li>
				  <li class="expertise"><i class="fa fa-television" aria-hidden="true"></i>Favorite TV Characters : <span>@if(isset(Auth::user()->tv_character) && !empty(Auth::user()->tv_character)) {{ Auth::user()->tv_character }} @else --- @endif</span></li>

                  <li class="aboutme" style="display:none;">
                    <p>About Me: <span>@if(isset($tutor->tutor_about)){{$tutor->tutor_about}}@endif</span>
                    </p>
                  </li>
                </ul>
                @else
                <!-- maaz -->
                <ul class="pro-detail">
                  <li class="gender"><i class="fa fa-user size" aria-hidden="true"></i>Gender : <span>@if(isset(Auth::user()->gender) && !empty(Auth::user()->gender)){{Auth::user()->gender}} @else --- @endif</span></li>
                  <li class="location"><i class="fa fa-map-marker size" aria-hidden="true"></i>Location : <span>@if(isset(Auth::user()->location) && !empty(Auth::user()->location)) {{ Auth::user()->location }} @else --- @endif</span></li>
				  <li class="expertise"><i class="fa fa-forumbee size" aria-hidden="true"></i>Favorite TV Characters : <span>@if(isset(Auth::user()->tv_character) && !empty(Auth::user()->tv_character)) {{ Auth::user()->tv_character }} @else --- @endif</span></li>
                </ul>
                @endif

              </div>
			  <div class="col-md-7 col-sm-7 no-pad-left  no-pad-right detail without-pad">
				<div class="col-lg-12 float payment-buttons">


				<!---------------------->
                @if($tutor_globalflag)
					@if($tutor->users_id == Auth::user()->id)
				<!-- <a href="{{ route('editprofile_index') }}" class="btn btn-primary edits">EDIT Profile</a> -->
                <a href="{{ route('editprofile_index') }}" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="">Edit Profile</a>
					<!-- @if($tutor->is_paid == 0)  -->
						<a href="{{ route('payment_post') }}" class="btn btn-primary edit-button new-edit edit-profile">Payment</a>
                	<!--<a href="{{ route('payment_post') }}" href="#myModaltransaction" data-toggle="modal" data-target="#myModaltransaction" class="btn btn-primary btn-md edit-button new-edit edit-profile">Payment</a>-->
                	<!-- @endif -->
  				@endif
				@else
                <a href="#" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="text-decoration:none; margin-right:0;" data-toggle="modal" data-target="#myModal">Edit Profile</a> @endif



				<!-------------------------->
                @if(isset($tutor->intro_video_link) && $tutor->intro_video_link!=Null)

                <a href="#" class="btn btn-default btn-lg btn-md watch-intro free-trial" data-toggle="modal" data-target="#watchVideo">Watch My Introduction</a> @else
                <iframe src="https://www.youtube.com/embed/E2rBBA-CfZ0?ecver=2" width="100%" style="display:none;" height="280" frameborder="0" allowfullscreen>No video</iframe>
                @endif

                <!-- <div class="intro col-lg-8 col-md-8 col-sm-12" style="display:none;">
                        <video width="100%" autoplay loop>
                          <source src="{{ asset('public/images/animated-explainer-video.mp4') }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                      </div> -->
</div>
<div class="col-lg-12 float about-box">

				<ul class="pro-detail">
                <li class="aboutme"><i class="fa fa-pencil-square-o size" aria-hidden="true"></i>
                    About Me:
                    <div class="about">
                      <p>@if(isset($tutor->tutor_about) && !empty($tutor->tutor_about))
                        {{$tutor->tutor_about}}
                        @else
                        {{Auth::user()->about}}
                        @endif
                      </p>
                    </div>
                  </li>
				</ul>

</div>

			  </div>
		</div>
        </div>
        <div class="col-lg-12 col-md-12 profile no-mg" style="float:left; width:100%;">

          <!--///////////////////////////////// INBOX CODE ///////////////////////////////////////////-->
          <div class="row mg-bt">
            <div class="col-lg-12 col-md-12 ">


              <div class="container-fluid no-mg no-padding">

                <ul class="nav nav-tabs no-bd-bt" style="display:none;">
                  <li class="active popup"><a data-toggle="tab" href="#home">Chats <strong>({{Config::get('unread_msgs')}})</strong></a></li>
                  <li><a data-toggle="tab" href="#menu1">Chat Groups</a></li>
                  @if(!$tutor_globalflag)
                  <li><a href="{{route('tutorRegisterView')}}">Become Tutor</a></li>
                  @endif
                  <li class="popup"><a href="{{ route('notesView') }}">My Notes <strong>({{$your_note_count }})</strong></a></li>
                  @if($tutor_globalflag)
                  <li><a href="{{route('tutorbookings')}}">Student Requests</a></li>
                  @endif
                  <li><a href="{{ route('requestsView') }}">Your Requests</a></li>

                </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">


                    <div class="col-sm-4 chat_sidebar">

                      <div class="row">
                        <div class="member_list single-chat-page">
                          <ul class="list-unstyled">
                            @foreach($groups_detail as $single_detail)
                            <?php $user_count = explode(',',$single_detail->user_ids);?>

                            @if(sizeof($user_count)<3)
                            <a href="#" class="get_group_data" url="{{route('get_msg',['id'=>$single_detail->group_id])}}" group_id="{{$single_detail->group_id}}">
                              <li class="left clearfix">
                                @if(sizeof($user_count) == 1)
                                <div class="chat_single_img">
                                  <span class="chat-img pull-left">
              						         @foreach ($profile_pic as $key => $value)

                                    @if(in_array($key, $user_count))
                                        @if(empty($value->profile_pic) || !isset($value->profile_pic) || $value->profile_pic == Null)
                                            <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" class="img-responsive img-circle">
                                        @else
                                            <img src="{{ asset('public/profile_pics/'.$value->profile_pic) }}" class="img-responsive img-circle">
                                            <?php break;?>
                                        @endif
                                      @endif
                                    @endforeach
                                </span>
                                </div>
                                @else
                                <div class="chat_two_img">
                                                  @foreach ($profile_pic as $key => $value)
                                                  <span class="chat-img pull-left">
                                                            @if(in_array($key, $user_count))
                                                                @if(empty($value->profile_pic) || !isset($value->profile_pic) || $value->profile_pic == Null)
                                                                    <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" class="img-responsive img-circle">
                                                                @else
                                                                    <img src="{{ asset('public/profile_pics/'.$value->profile_pic) }}" class="img-responsive img-circle">
                                                                @endif
                                                              @endif
                                                              </span>
                                                            @endforeach
                                </div>
                                @endif
                                <div class="chat-body clearfix">
                                  <div class="header_sec">
                                    <strong class="primary-font">
								{{$single_detail->group_name}}
                            <?php $count = 0; ?>
                            @if($unread_chat != '0')
                                @foreach($unread_chat as $ur_chat)
                                    @if($ur_chat->grp_id == $single_detail->group_id)
                                        <?php $count++?>
                                    @endif
                                @endforeach
                            @endif
							</strong>
                                    <strong class="pull-right"></strong>
                                  </div>
                                  <div class="contact_sec">
                                    <strong class="primary-font">one on one chat</strong> <span class="badge pull-right">{{$count}}</span>
                                  </div>
                                </div>
                              </li>
                              </a>
                              @endif @endforeach
                          </ul>
                        </div>
                      </div>

                    </div>
                    <!--chat_sidebar-->


                    <div class="col-sm-8 message_section">
                      <div class="row">
                        <!-- new_message_head -->
                        <div class="new_message_head">
                          <div class="pull-left">
                            <a href="#" class="pull-left btn btn-link btn-xs add_usr hidee" data-toggle="modal" data-target="#userModal"><span class="fa fa-plus"></span>add new user</a>
                          </div>

                          <div class="pull-left" style="text-align:center; width:65%;">
                            <h3 class="text-center blck chatroom" style="margin-top:0;">Chat Room</h3>
                          </div>
                          <div class="pull-right">
                            <div class="dropdown">
                              <small class="dropdown navbar-right usr_list hidee">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right">
						<i class="fa fa-users"></i> Group members
					</a>
					<ul class="dropdown-menu users">

                    </ul>
                </small>
                            </div>
                          </div>
                        </div>
                        <!--new_message_head-->
                        <div class="chat chat_area">
                          <ul class="list-unstyled">
<!-- <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" /> -->
                          </ul>
                        </div>
                        <!-- chat messages -->
                        <!-- send messages -->
                        <div class="message_write">
                          <form class="newMsg" action=" {{ route('newMsgPost') }}">
                            <div class="col-lg-10 col-md-11 col-sm-11 col-xs-12 no-pad-left fleft attach-margin">
                              <div class="form-group card-nos enter-msg no-pad-left res col-md-12" style="margin-left:0; margin-bottom:0;">
                                <input type="hidden" value="" name="group_id" class="group_id" />
                                <input type="text" class="form-control fleft-input new_msg" name="chatmsg" placeholder="Enter Message" style="display:none;">
                                <textarea class="form-control fleft-input new_msg" name="chatmsg" placeholder="Enter Message" style="height:50px; width:100%;"></textarea>
                                <label for="upload" class="attachment">
      <span class="fa fa-paperclip fa-2x" aria-hidden="true"></span>
      <input type="file" id="upload" name="attachment" style="display:none;">
    </label>
                                <div class="file_attached"></div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-1 col-xs-12 res-send send-button fleft no-pad-left no-pad-right">
                              <input type="submit" class="btn btn-primary edits unfollow send-button-msg" value="SEND" /> {{--
                              <a href="#" class="btn btn-primary edits unfollow"><span>SEND</span></a> --}}

                            </div>
                          </form>


                        </div>
                        <!-- send messages -->
                      </div>
                    </div>



                  </div>
                  <div id="menu1" class="tab-pane fade">

                    <div class="col-sm-4 chat_sidebar">

                      <div class="row">
                        <div class="member_list">
                          <ul class="list-unstyled">
                            @foreach($groups_detail as $single_detail)
                            <?php $user_count = explode(',',$single_detail->user_ids);?>
                            @if(sizeof($user_count)>2)
                            <a href="#" class="get_group_data" url="{{route('get_msg',['id'=>$single_detail->group_id])}}" group_id="{{$single_detail->group_id}}">
                              <li class="left clearfix">

                                <div class="chat_four_img">
                                  <?php $counter = 1;?>
                                  @foreach ($profile_pic as $key => $value)
                                            @if(in_array($key, $user_count))
                                            <?php $counter++;?>
                                            <span class="chat-img pull-left">
                                                @if(empty($value->profile_pic) || !isset($value->profile_pic) || $value->profile_pic == Null || $value->profile_pic == "")
                                                    <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" class="img-responsive img-circle">
                                                @else
                                                    <img src="{{ asset('public/profile_pics/'.$value->profile_pic) }}" class="img-responsive img-circle">
                                                @endif
                                                </span>
                                              @endif
                                          @if($counter ==4)
                                          <?php break;?>
                                          @endif
                                            @endforeach
                                            <span class="chat-img pull-left">
                                            									<span class="count img-responsive img-circle">+{{sizeof($user_count)}}</span>
                                            								</span>

                                </div>




                                <div class="chat-body clearfix">
                                  <div class="header_sec">
                                    <strong class="primary-font">
										{{$single_detail->group_name}}
									</strong>
                                  </div>
                                  <div class="contact_sec">
                                    <strong class="primary-font">Chat Group</strong>
                                  </div>
                                </div>
                              </li>
                            </a>
                            @endif @endforeach
                          </ul>
                        </div>
                      </div>

                    </div>
                    <!--chat_sidebar-->
                    <div class="col-sm-8 message_section">
                      <div class="row">
                        <!-- new_message_head -->
                        <div class="new_message_head">
                          <div class="pull-left">
                            <a href="#" class="pull-left btn btn-link btn-xs add_usr hidee" data-toggle="modal" data-target="#userModal">add new user</a>
                          </div>

                          <div class="pull-left" style="text-align:center; width:65%;">
                            <h3 class="text-center blck chatroom" style="margin-top:0;">Chat Room</h3>
                          </div>
                          <div class="pull-right">
                            <div class="dropdown">
                              <small class="dropdown navbar-right usr_list hidee">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" class="pull-right">
						<i class="fa fa-users"></i> Group members
					</a>
					<ul class="dropdown-menu users">

                    </ul>
                </small>
                            </div>
                          </div>
                        </div>
                        <!--new_message_head-->
                        <div class="chat chat_area">
                          <ul class="list-unstyled">
                            <!-- <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" /> -->
                          </ul>
                        </div>
                        <style>
                          .chat {
                            max-height: 300px;
                            overflow: hidden;
                            overflow-y: auto;
							min-height:300px;
                          }

                          .modal {
                            text-align: center;

                          }



                          .modal-dialog {
                            display: inline-block;
                            text-align: left;
                            vertical-align: middle;
                          }
                        </style>

                        <!-- send messages -->
                        <div class="message_write">
                          <form class="newMsg" action=" {{ route('newMsgPost') }}">
                            <div class="col-lg-10 col-md-11 col-sm-11 col-xs-12 no-pad-left fleft attach-margin">
                              <div class="form-group card-nos enter-msg no-pad-left res col-md-12" style="margin-left:0; margin-bottom:0;">
                                <input type="hidden" value="" name="group_id" class="group_id" />
                                <input type="text" class="form-control fleft-input new_msg" name="chatmsg" placeholder="Enter Message" style="display:none;">
                                <textarea class="form-control fleft-input new_msg" name="chatmsg" placeholder="Enter Message" style="height:50px; width:100%;"></textarea>
                                <label for="grp_upload" class="attachment">
      <span class="fa fa-paperclip fa-2x" aria-hidden="true"></span>
      <input type="file" id="grp_upload" name="attachment" style="display:none;">
    </label>
                                <div class="file_attached"></div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-1 col-xs-12 res-send send-button fleft no-pad-left no-pad-right">
                              <input type="submit" class="btn btn-primary edits unfollow send-button-msg" value="SEND" /> {{--
                              <a href="#" class="btn btn-primary edits unfollow"><span>SEND</span></a> --}}

                            </div>
                          </form>


                        </div>
                        <!-- send messages -->
                      </div>
                    </div>


                  </div>


                </div>

              </div>
            </div>
            <script src="https://use.fontawesome.com/45e03a14ce.js"></script>


            <div class="clearfix">&nbsp;</div>




          </div>
        </div>
        <div id="userModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New User</h4>
              </div>
              <div class="modal-body">
                <form id="notes_form" method="post" role="form" action="{{route('new_group_usr')}}">
                  <div class="form-group">
                    <select name="new_usr" class="form-control newusrs_list">

                        </select>
                  </div>
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <input type="hidden" name="gr_id" value="" class="gr_id" />
                  <input type="submit" name="submit" value="submit" class="btn btn-primary" />
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- INBOX CODE END -->


        <div id="watchVideo" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

              <div class="modal-body">
                @if(isset($tutor->intro_video_link) && $tutor->intro_video_link!=Null)
                <iframe src="{{$tutor->intro_video_link}}" width="100%" height="280" frameborder="0" allowfullscreen></iframe> @else
                <iframe src="https://www.youtube.com/embed/E2rBBA-CfZ0?ecver=2" width="100%" style="display:none;" height="280" frameborder="0" allowfullscreen>No video</iframe> @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- INBOX CODE END -->
      </div>
    </div>

  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Complete/Edit Profile</h4>
        </div>
        <div class="modal-body">
          <form id="std_form" method="post" role="form" action="{{route('std_profile_completion')}}">
            <div class="row">
              <div class="form-group note-title col-md-6">
                <h4 class="no-marg-top no-marg-bottom">Gender: </h4>
              </div>
              <div class="form-group note-title col-md-6">
                <span style="color:red" class="note_title"></span> Male: <input type="radio" name="std_gender" value="male" @if(Auth::user()->gender != 'male') selected @endif class="" placeholder="Gender" required>
                <span style="color:red" class="note_title"></span> Female:
                <input type="radio" name="std_gender" value="female" @if(Auth::user()->gender != 'female') selected @endif class="" placeholder="Gender" required>
              </div>
              <div class="form-group upload-notes col-md-6">
                <h4 class="no-marg-top no-marg-bottom">Favorite TV Characters: </h4>
              </div>
              <div class="form-group note-title col-md-6">
                <span style="color:red" class="note_title"></span>
                <input type="text" name="tv_character" class="form-control" @if(Auth::user()->tv_character != Null) value="{{Auth::user()->tv_character}}" @else value="" @endif required placeholder="Micheal Jackson">
              </div>
              <div class="form-group upload-notes col-md-6">
                <h4 class="no-marg-top no-marg-bottom">Location: </h4>
              </div>
              <div class="form-group note-title col-md-6">
                <span style="color:red" class="note_title"></span>
                <input type="text" name="std_location" class="form-control" @if(Auth::user()->location != Null) value="{{Auth::user()->location}}" @else value="" @endif id="std_location" required placeholder="Address">
              </div>
              <div class="form-group notes-detail col-md-6">
                <h4 class="no-marg-top no-marg-bottom">About : </h4>
              </div>
              <div class="form-group notes-edit-detail col-md-6">
                <span style="color:red" class="std_about"></span>
                <textarea type="text" name="std_about" class="from-control" rows="3" required /> @if(Auth::user()->about != Null) {{trim(Auth::user()->about)}} @endif
                </textarea>
              </div>
              <div class="form-group notes-edit-detail col-md-6 ">
                &nbsp;
              </div>
              <div class="form-group notes-detail col-md-6 ">
                <input type="submit" class="btn btn-primary pull-right" value="submit" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- TUTOR INFO -->
</div>

</div>
@if((!isset(Auth::user()->gender) || !isset(Auth::user()->location) || !isset(Auth::user()->about))&& !$tutor_globalflag)
<script>
  $('#myModal').modal('show');
</script>
@endif

<script>
$('#LoaderGif').hide();
  $('.c_profile').on('click', function() {
    $('#myModal').modal('toggle');
  });

  $("#std_form").on('submit', function(e) {
    e.preventDefault();
    $("#LoaderGif").show();
    var url = $(this).attr('action');
    var formData = new FormData(this);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    $.ajax({
      url: url, // $("#register_form :input[name!=password2]").serializeArray()
      type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
      data: formData,
      processData: false,
      contentType: false,
      cache: true,
      success: function(data) {
        console.log(data);
        $('#myModal').modal('hide');
        toastr.success('Operation Successfully Completed')
        $('#LoaderGif').hide();
        setTimeout(function() {
          window.location = "{{route('profile_index')}}";
        }, 1000);


      },
      error: function(data) {
$('#LoaderGif').hide();
        var errors = data.responseJSON;
        toastr.error(errors.error);
        //                $("#LoaderGif").hide();
        var errors = data.responseJSON;
        $("#info_message_error").show();
        $.each(errors, function(index, value) {
          $("input[name='" + index + "']").css("border-color", 'red');
          $("." + index).text(value);
        });
      }
    });
  })
</script>

<!-- INBOX SCRIPT -->
<script>
  $(document).ready(function() {
// $('.upload_pic_btn').hide();
$('.std_upload_pic').on('change',function(){
  if($(this).val() != ""){
    $('.upload_pic_btn').show();
  }
});


    //$('.add_usr').hide();
    //$('.usr_list').hide();
    var global_group_id = '';
    var checkloop = 0;
    $('.newMsg').hide();
    $('.get_group_data').on('click', function(e) {
      e.preventDefault();
$('#LoaderGif').show();
      $('.newMsg').show();
      var id = $(this).attr('group_id');
      var url = $(this).attr('url');
      $('a').removeClass('active');
      $(this).closest('a').addClass('active');
      $.ajax({
        url: url, // $("#register_form :input[name!=password2]").serializeArray()
        type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        cache: true,
        success: function(data) {
          $html = data.html;
          $users = data.users;
          $otherusers = data.otherUsers
          $new_users = data.new_users;
          $(".group_id").val(data.group_id);
          global_group_id = data.group_id;
          $('.chat').html($html);
          $('.users').html($users);
          console.log(data.inst_flag);
          var $target = $('.chat');
          $('#LoaderGif').hide();
          $target.animate({
            scrollTop: 4200
          }, 1000);
          if (!data.inst_flag) {
            //$('.add_usr').show();
            $('.add_usr').removeClass("hidee");
          } else {
            //$('.add_usr').hide();
            $('.add_usr').addClass("hidee");
          }
          //$('.usr_list').show();
          $('.usr_list').removeClass("hidee");
          $useroptions = '';
          if($otherusers != ""){
          $.each($otherusers, function(key, val) {
            $useroptions += '<option value="' + val.id + '">' + val.email + '</option>';
          });
          }
          else{
            $useroptions += '<option selected disabled>No more users for your institute</option>';
          }
          $('.newusrs_list').html($useroptions);
          $('#userModal').find('.gr_id').val(global_group_id);
          $('.chat').scrollTop($('.chat')[0].scrollHeight);
          if(checkloop == 0){
            initiateChatLoop();
          }
        },
        error: function(data) {
          $('#LoaderGif').hide();
          console.log(data);
        }
      });
    });

    function getChatLog(groupId) {
      //    console.log("groupId" + groupId);
      var url = 'group_msg/' + global_group_id; //
      $('#LoaderGif').show();
      $.ajax({
        url: url, // $("#register_form :input[name!=password2]").serializeArray()
        type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        cache: true,
        success: function(data) {
          //            console.log(data.html);
          $html = data.html;
          $(".group_id").val(data.group_id);
          $('.chat').html($html);
          $('#LoaderGif').hide();
          //            $('.chat').scrollTop($('.chat')[0].scrollHeight);
        },
        error: function(data) {
          $('#LoaderGif').hide();
          console.log(data);
        }
      });

    }

    /* New Chat Message Form */
    $('.newMsg').submit(function(e) {
      e.preventDefault();
      $('#LoaderGif').show();
      var formData = new FormData(this);
      //        console.log(formData);
      var group_id = $(".group_id").val();
      var url = $(this).attr('action');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });

      $.ajax({
        url: url, // $("#register_form :input[name!=password2]").serializeArray()
        type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        data: formData,
        processData: false,
        contentType: false,
        cache: true,
        success: function(data) {
          getChatLog(group_id);
          $('.new_msg').val('');
          $('.file_attached').html('');
          $('input[type=file]').val('');
          var $target = $('.chat');
          var height = 4600;
          $('#LoaderGif').hide();
          $target.animate({
            scrollTop: height
          }, 1000);
        },
        error: function(data) {
          console.log(data);
          $('#LoaderGif').hide();
        }
      });
    });

    function initiateChatLoop() {
      checkloop = 1;
       setInterval(function() {
         getChatLog(global_group_id);
       }, 5000);
    }

    $('input[type=file]').on('change', function() {
      $(this).closest('.enter-msg').find('.file_attached').html('<p id="file_status" style="color:#1D7B97">File attached</p>')
      // alert($(this).val());
    });

  });
$('#watchVideo').on('hidden.bs.modal', function () {
    $(".modal-body iframe").attr("src", $(".modal-body iframe").attr("src"));
});
</script>
<!-- INBOX SCRIPT END -->

@endsection
