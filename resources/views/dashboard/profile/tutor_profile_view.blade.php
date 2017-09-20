@extends('masterlayout')
@section('content')
<div class="container-fluid text-center trans-text">
  <h3>Tutor Profile</h3>
</div>

@if(Session::has('payment_danger'))
<script>

toastr.error('{{Session::get('payment_danger')}}');
</script>
{{ Session::forget('payment_danger') }}
@endif
@if(Session::has('payment_success'))
<script>

toastr.success('{{Session::get('payment_success')}}');
{{ Session::forget('payment_success') }}
</script>
@endif
<div class="profile-page">
<div class="container">
<div class="profile-text">



<div class="row">
	<!-- new row for profile -->
<div class="col-lg-12 col-md-12 profile no-margin-top">
          <div class="row">


          </div>
		<!------ NEW ROW FOR PROFILE -->
		<div class="col-lg-12 no-pad-left no-pad-right timeline-pic">
			<img src="{{ asset('public/images/profile-banner.jpg') }}" />
			<div class="full-width-profile">
			<div class="col-lg-2 float extra-css">


				@if(empty($tutor->profile_pic) || !isset($tutor->profile_pic))
                @if(Auth::user()->profile_pic == Null)
              <div class="profile-pic pic extra-pic masking">
				<img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224">
					<div class="mask">
				<div class="text">
                        <form enctype="multipart/form-data" id="profile_upload" method="post" role="form" action="{{route('std_profile_pic')}}">
                            <input type="file" name="std_profile" class="form-control" placeholder="Upload profile pic">
                            <input type="hidden" value="{{csrf_token()}}" name = "_token"/>
                            <input type="submit" value="upload"/>
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
                            <input type="file" name="std_profile" class="form-control" placeholder="Upload profile pic">
                            <input type="hidden" value="{{csrf_token()}}" name = "_token"/>
                            <input type="submit" value="upload"/>
                        </form>
					</div>
			  </div>
			</div>
                    @endif
            @else
				<div class="profile-pic pic extra-pic masking">
              <img src="{{ asset('public/profile_pics/'.$tutor->profile_pic) }}" height="226" width="224">
				</div>
            @endif
          <!-- <div class="col-lg-2 col-md-2 col-md-offset-0 col-sm-4 col-sm-offset-4 col-sm-offset-right-4 text-center pro-col" style="display:none;"> -->






                	<!-- <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224"> -->
              <!-- </div> -->
			</div>
			<div class="col-lg-2 float no-pad-left no-pad-right">
                  <h3 class="title">
  							        @if(isset($tutor->tutor_unique))  {{ $tutor->tutor_unique }} @endif
  						     </h3>
			</div>
			<div class="col-lg-8 chat-section-tabs float" style="display:none;">
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

				<h4 class="twitter">@if(isset($tutor->tutor_unique))  {{ '@'.$tutor->tutor_unique }} @endif</h4>


				<ul class="pro-detail">
                	<li class="gender"><i class="fa fa-user size" aria-hidden="true"></i>Gender : <span>@if(isset($tutor->tutor_gender)){{$tutor->tutor_gender}}@endif</span></li>
                    <li class="location"><i class="fa fa-map-marker size" aria-hidden="true"></i>Location : <span>@if(isset($tutor->state_name))  {{ $tutor->state_name }}@endif, @if(isset($tutor->country_name))  {{ $tutor->country_name }} @endif</span></li>
                    <li class="school"><i class="fa fa-graduation-cap size" aria-hidden="true"></i>Institute : <span>@if(isset($my_institute->institute_name)){{$my_institute->institute_name}}@endif</span></li>
                    <li class="charges"><i class="fa fa-hourglass size" aria-hidden="true"></i>Tutoring Fee Per Hour: <span>$@if(isset($tutor->per_hour_charges))  {{ $tutor->per_hour_charges }}@endif</span></li>
                    <li class="expertise"><i class="fa fa-forumbee size" aria-hidden="true"></i>Major : <span>@if(isset($tutor->tutor_majors)){{$tutor->tutor_majors}}@endif</span></li>
                    <li class="expertise"><i class="fa fa-television" aria-hidden="true"></i>Favorite TV Characters : <span>@if(isset($tutor->tv_character)){{$tutor->tv_character}}@endif</span></li>
                    <li class="ratings"><i class="fa fa-heart size" aria-hidden="true"></i>Ratings :    @if(isset($tutor->tutor_rating))
                                                     @for($i=0; $i<round($tutor->tutor_rating); $i++)
                                                        <span class="glyphicon glyphicon-star"></span>
                                                     @endfor
                                                    @endif</li>

                </ul>



              </div>
			  <div class="col-md-7 col-sm-7 no-pad-left  no-pad-right detail without-pad">
				<div class="col-lg-12 float payment-buttons">


				<!---------------------->
                @if($tutor_globalflag) @if($tutor->users_id == Auth::user()->id)
				<!-- <a href="{{ route('editprofile_index') }}" class="btn btn-primary edits">EDIT Profile</a> -->
                <a href="{{ route('editprofile_index') }}" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="">Edit Profile</a>
                  @endif @else
                <!-- <a href="#" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="text-decoration:none; margin-right:0;" data-toggle="modal" data-target="#myModal">Edit Profile</a> -->
                 @endif
				@if($tutor->users_id != Auth::user()->id)
                      @if(!$subscription_check)
                      <a href="#download_payment" data-toggle="modal" data-target="#download_payment" class="btn btn-default btn-lg subscribe edit-button new-edit edits free-trial subscribed-button edit-profile">Subscribe</a>
                      @else
                      <a class="btn btn-default btn-lg subscribe edit-button new-edit edits free-trial subscribed-button edit-profile" disabled>Subscribed</a>
                      @endif
                    @endif

				<a href="{{ route('editprofile_index') }}" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="display:none;">Book Now</a>

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
                      <p>@if(isset($tutor->tutor_about)){{$tutor->tutor_about}}@endif
                      </p>
                    </div>
                  </li>
				</ul>

</div>

			  </div>
		</div>
        </div>
	<!-- new row for profile -->



<div id="watchVideo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                   @if(isset($tutor->intro_video_link) && $tutor->intro_video_link!=Null && !empty($tutor->intro_video_link))
          <iframe src="{{$tutor->intro_video_link}}" width="100%" height="280" frameborder="0" allowfullscreen></iframe>

                      @else
                      <iframe src="https://www.youtube.com/embed/E2rBBA-CfZ0?ecver=2" width="100%" height="280" frameborder="0" allowfullscreen>No video</iframe>
                  @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

                </div>


            </div>
        </div>
	</div>
</div>

<!-- Std_subscription -->
<div class="modal fade" id="download_payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Student Subscription</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 col-md-offset-1">
                        <form id="std_subscription" method="post" action="{{route('download_payment')}}" role="form">
                        <!-- <form id="std_subscription" method="post" action="{{route('brainTest')}}" role="form"> -->
                            <div class="form-group">
                                <h4>You will be able to access and download all Notes of the Tutor <b>"{{$tutor->tutor_unique}}"</b> for Just $1.99/Month !!</h4>
                                <input type="hidden" name="author_id" class="tutor_id" value="{{$tutor->users_id}}"/>
                                <input type="hidden" name="note_id" class="std_id" value="0"/>
                                <input type="hidden" value="{{ Session::token() }}" name="_token" />
                            </div>
                            <div class="form-group">
                                {{--<form id="transaction" method="post" role="form" action="{{route('brainTest')}}">--}}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" required id="fname" name="fname" placeholder="FIRST NAME">
                                        </div>
                                        <input type="hidden" name="plan_id" value="mybw"/>
                                        <input type="hidden" name="amount" value="1.99"/>
                                        <input type="hidden" name="subscription" value="1"/>
                                        <input type="hidden" name="pay_from" value="std_subscription"/>
                                        <div class="form-group col-md-6 send-payment-box">
                                            <input type="text" required class="form-control" id="card-no" name="card-no" placeholder="CARD NUMBER">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <span style="color:red" class="note_title"></span>
                                            <input type="text" required class="form-control" id="lname" name="lname" placeholder="LAST NAME">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" required class="form-control" id="ex-date" name="ex-date" placeholder="EXPIRY DATE  example : 8/18">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="PHONE NUMBER">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVC/CVV">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" required class="form-control" id="email" name="email" placeholder="EMAIL">
                                        </div>
                                        <div class="form-group notes-detail col-md-12 text-center">
                                            {{--<input type="submit" class="btn btn-primary " value="submit"/>--}}
                                        </div>
                                        {{csrf_field()}}

                                        {{--<div class="form-group col-md-12 text-center">--}}
                                            {{--<hr/>OR<div id="paypal-container"></div>--}}
                                        {{--</div>--}}











                                    </div>
                                <!-- <h6> <b>Please note</b> : The subscription will only be applied to the author you are subscribing to. After one month your subscription will be automatically cancelled.</h6> -->
                                {{--</form>--}}
                                <div class="col-md-8 col-md-offset-1">
                                <input type="submit" class="btn btn-warning pull-right form-group" style="padding: 6% 15%" name="subscribe" value="Subscribe"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
<!-- subscripotion end -->







</div>
<!-- TUTOR INFO -->
</div>

</div>
@endsection
