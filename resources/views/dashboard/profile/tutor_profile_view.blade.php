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
    @if (session('status'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
        </div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('failed') }}
        </div>
    @endif
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
                      <!-- <a href="#download_payment" data-toggle="modal" data-target="#download_payment" class="btn btn-default btn-lg subscribe edit-button new-edit edits free-trial subscribed-button edit-profile">Subscribe</a> -->
                      
                        <form id="std_subscription" method="post" action="{{route('download_payment')}}" role="form">
                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                            <input type="hidden" name="author_id" class="tutor_id" value="{{$tutor->users_id}}"/>
                            <input type="hidden" name="note_id" class="std_id" value="0"/>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                               data-key="pk_test_W31xNmmJPBpIyyc3LxH89mGi"
                               data-amount="199"
                               data-name="Subscribe {{$tutor->tutor_unique}}"
                               data-image="http://site.startupbug.net:6999/rod/rod/public/dynamic_assets/1495873280-j_logo.png"
                               data-locale="auto">
                            </script>
                        </form>
                      
                      @else
                      <a class="btn btn-default btn-lg subscribe edit-button new-edit edits free-trial subscribed-button edit-profile" href="{{route('cancel_subscription_u', ['id' => $tutor->users_id]) }}">Unsubscribed</a>
                      @endif
                    @endif

				<a href="{{ route('editprofile_index') }}" class="btn btn-primary btn-md edit-button new-edit edit-profile" style="display:none;">Book Now</a>

				
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
    <div class="container-fluid text-center trans-text">
      <h3>Tutor Schedule</h3>
    </div>
    <div>
          @foreach($schedule as $da)
              <?php $ar[] = $da;?>
          @endforeach
      @if(!empty($ar))
          <style>
  section.button_info{
    max-width:50%;
    margin:0px auto 10px;
    text-align:center;
  }

section.button_info .nan span{
    width:100px;
    height:20px;
    display:block;
    background:red;
}
section.button_info label{
    margin:0px 5px;
    text-align:center;
  text-indent: 3px;
}
section.button_info .booked span{
    width:100px;
    height:20px;
    display:block;
    background:#1f7f9f;
}
section.button_info .avl span{
    width:100px;
    height:20px;
    display:block;
    background:green;
}
  </style>
  <section class="button_info">
  <label class="nan">Not Available<span></span></label>
  <label class="booked">Booked<span></span></label>
  <label class="avl">Available<span></span></label>
  </section>
          <form method="post" action="{{route('bookShedule')}}" class="schedule-list">    
             
              <div class="clearfix"></div>
              <div class="table-responsive">
                 <div class="form-group row scheduler-ids">
                  <div class="col-md-4">
                    <input type="text" name="contact_email" class="form-control" placeholder="Email ID" required="">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="contact_skype" class="form-control" placeholder="Skype ID" required="">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="hours" class="form-control" placeholder="Number of hours" required="">
                  </div>
                  <input type="hidden" name="tutor_id" value="{{$tutor->tutor_id}}">
                </div>
                  <table class="table schedule-table student">
                      <tr>
                          <?php 
                              $b = count($ar); 
                              $x = $b/48;
                          ?>
                          <td></td>
                          @for($a=0; $a<$b;)
                              <td>{{ $ar[$a]->date }}</td>
                             <?php $a = $a + 48; ?>   
                          @endfor
                      </tr>
                      @for($i=0;$i<=47;$i++)
                          <tr>
                              <td width="10%">{{ $ar[$i]->time }}</td>
                              @for($a=$i; $a<$b;)
                                @if($ar[$a]->status == 1)
                                  <td width="10%" style="position:relative;"><input data-stat="{{ $ar[$a]->status }}" class="without-bg" type="text" name="sch[]" data-id="{{ $ar[$a]->id }}" data-state="{{ $ar[$a]->status }}" value="{{ $ar[$a]->id }},{{ $ar[$a]->status }}" readonly>
                                  <div style="position:absolute;width:100px;height:20px;top:0px;left:0; right:0; margin:0 auto;" class="sch green" data-toggle="tooltip"  title="<?php echo $ar[$a]->status == 2 ? 'Booked' : ($ar[$a]->status == 1 ? 'Available' : 'Not Available')?>: {{ $ar[$a]->date }}, {{ $ar[$a]->time }}"></div>
                                @else
                                  <td width="10%" style="position:relative;">
                                    <div style="position:absolute;width:95%;height:20px;top:0px;left:0; right:0; margin:0 auto;" class="<?php echo $ar[$a]->status == 2 ? 'blue' : 'red' ?>" data-toggle="tooltip"  title="<?php echo $ar[$a]->status == 2 ? 'Booked' : ($ar[$a]->status == 1 ? 'Available' : 'Not Available')?>: {{ $ar[$a]->date }}, {{ $ar[$a]->time }}"></div>
                                  </td>
                                @endif
                  </td>
                                 <?php $a = $a + 48; ?>   
                              @endfor
                          </tr>
                      @endfor

                  </table>
              <div style="width:60%; margin:auto;">{{ $schedule->links() }}</div>
              </div>
              <div class="row save-button">
              <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
              {!! csrf_field() !!}
              <button type="submit" class="btn btn-primary edits">Save</button>
          </div>
          </form>
      @else
        <div>
          <h3 style="text-align: center;">No Schedule Available</h3>
        </div>
      @endif
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
                             <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                            <div class="form-group">
                                <h4>You will be able to access and download all Notes of the Tutor <b>"{{$tutor->tutor_unique}}"</b> for Just $1.99/Month !!</h4>
                                <input type="hidden" name="author_id" class="tutor_id" value="{{$tutor->users_id}}"/>
                                <input type="hidden" name="note_id" class="std_id" value="0"/>
                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                 data-key="pk_test_W31xNmmJPBpIyyc3LxH89mGi"
                                 data-amount="999"
                                 data-name="Subscribe Tutor"
                                 data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                 data-locale="auto">
                               </script>
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
