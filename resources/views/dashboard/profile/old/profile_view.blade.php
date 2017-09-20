@extends('masterlayout')
@section('content')
<div class="container-fluid text-center trans-text">
  <h3>PROFILE PAGE</h3>
</div>
@if($errors->any())
<script>
toastr.warning( "{{$errors->first()}}" + '<br><br>');
</script>
@endif
<div class="profile-page">
<div class="container">
    <div id="myModaltransaction" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Make a Transaction through Brain Tree</h4>
                </div>
                <div class="modal-body">
                    <form id="transaction" method="post" role="form" action="{{route('brainTest')}}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="FIRST NAME">
                            </div>
                            <input type="hidden" name="plan_id" value="4s96"/>
                            <input type="hidden" name="amount" value="3.99"/>
                            <input type="hidden" name="subscription" value="1"/>
                            <input type="hidden" name="pay_from" value="tutor_subscription"/>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="card-no" name="card-no" placeholder="CARD NUMBER">
                            </div>
                            <div class="form-group col-md-6">
                                <span style="color:red" class="note_title"></span>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="ex-date" name="ex-date" placeholder="EXPIRY DATE  example : 7/17">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="PHONE NUMBER">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVC/CVV">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="EMAIL">
                            </div>
                            {{csrf_field()}}
                            <div class="form-group notes-detail col-md-12 text-center">
                                <input type="submit" class="btn btn-primary " value="submit"/>
                            </div>

                            {{--<div class="form-group col-md-12 text-center">--}}
                                {{--<hr/>OR<div id="paypal-container"></div>--}}
                            {{--</div>--}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>


        </div>
    </div>

    <!-- subscription modal -->


    <!-- subsciption modal end -->

<div class="profile-text">

<div class="row">
	<div class="col-lg-12 col-md-12 profile">
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-md-offset-0 col-sm-4 col-sm-offset-4 col-sm-offset-right-4 text-center">
            @if(empty($tutor->profile_pic) || !isset($tutor->profile_pic))
                @if(Auth::user()->profile_pic == Null)
              <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224">
                        <form enctype="multipart/form-data" id="profile_upload" method="post" role="form" action="{{route('std_profile_pic')}}">
                            <input type="file" name="std_profile" class="form-control" placeholder="Upload profile pic">
                            <input type="hidden" value="{{csrf_token()}}" name = "_token"/>
                            <input type="submit" value="upload"/>
                        </form>
                    @else
                        <img src="{{ asset('public/profile_pics/'.Auth::user()->profile_pic) }}" height="226" width="224">
                        <form enctype="multipart/form-data" id="profile_upload" method="post" role="form" action="{{route('std_profile_pic')}}">
                            <input type="file" name="std_profile" class="form-control" placeholder="Upload profile pic">
                            <input type="hidden" value="{{csrf_token()}}" name = "_token"/>
                            <input type="submit" value="upload"/>
                        </form>
                    @endif
            @else
              <img src="{{ asset('public/profile_pics/'.$tutor->profile_pic) }}" height="226" width="224">
            @endif
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 detail">
            	<div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-right links">
                      
                   @if($tutor_globalflag)
					              @if($tutor->users_id == Auth::user()->id)
                    <a href="{{ route('editprofile_index') }}" class="btn btn-primary edits">EDIT Profile</a>
                                @if($tutor->is_paid == 0)
                                    {{--<a href="{{ route('payment_post') }}" href="#myModaltransaction" data-toggle="modal" data-target="#myModaltransaction" class="btn btn-primary edits">Payment</a>--}}
                                    <a href="#myModaltransaction" data-toggle="modal" data-target="#myModaltransaction" class="btn btn-primary edits">Payment</a>
                                @endif
					              @endif
                   @else
                            <a href="#" class="btn btn-primary c_profile">Edit Profile</a>
                    @endif
                    <!--<a href="#" class="btn btn-primary edits">FOLLOW</a>
                    <a href="#" class="btn btn-primary edits unfollow">UNFOLLOW</a> -->
                    {{--<a href="#" class="btn btn-primary edits">SEND MESSAGE</a>--}}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 tutor-name">
            			<h3 class="title">@if(isset($tutor->tutor_unique))  {{ $tutor->tutor_unique }} @endif</h3><samll>
                    @if(Auth::user()->id == $tutor->users_id)
                    Subscribers:{{$total_subscribers}}</small>
                    @endif
                		<!--<h4 class="twitter">@jason123</h4> -->
                	</div>
                </div>
                @if($tutor_globalflag)
                <ul class="pro-detail">
                	<li class="gender">Gender : <span>@if(isset($tutor->tutor_gender)){{$tutor->tutor_gender}}@endif</span></li>
                    <li class="location">Location : @if(isset($tutor->state_name))  {{ $tutor->state_name }}@endif, @if(isset($tutor->country_name))  {{ $tutor->country_name }} @endif</li>
                    <li class="school">Institute : <span>@if(isset($my_institute->institute_name)){{$my_institute->institute_name}}@endif</span></li>
                    <li class="charges">Per Hrs.Charges : <span>$@if(isset($tutor->per_hour_charges))  {{ $tutor->per_hour_charges }}@endif</span></li>
                    <li class="expertise">Major : <span>@if(isset($tutor->tutor_majors)){{$tutor->tutor_majors}}@endif</span></li>
                    <li class="ratings">Ratings :    @if(isset($tutor->tutor_rating))
                                                     @for($i=0; $i<round($tutor->tutor_rating); $i++)
                                                        <span class="glyphicon glyphicon-star"></span>
                                                     @endfor
                                                    @endif</li>
                    <li class="aboutme">About Me :<br>
                    	<div class="about">
                        	<p>@if(isset($tutor->tutor_about)){{$tutor->tutor_about}}@endif</p>
                        </div>
                    </li>
                </ul>
                    @else
                    <ul class="pro-detail">
                        <li class="gender">Gender : <span>@if(isset(Auth::user()->gender)){{Auth::user()->gender}}@endif</span></li>
                        <li class="location">Location : @if(isset(Auth::user()->location))  {{ Auth::user()->location }} @endif</li>
                        <li class="school">Institute : <span>@if(isset($my_institute->institute_name)){{$my_institute->institute_name}}@endif</span></li>
                        <li class="aboutme">About Me :<br>
                            <div class="about">
                                <p>@if(isset(Auth::user()->about)){{Auth::user()->about}}@endif</p>
                            </div>
                        </li>
                    </ul>
                @endif
               @if(isset($tutor->intro_video_link) && $tutor->intro_video_link!=Null)
                <div class="intro col-lg-8 col-md-8 col-sm-12" style="display:none;">
                    <video width="100%" autoplay loop>
                        <source src="{{ asset('public/images/animated-explainer-video.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>

                <div class="intro col-lg-8 col-md-12 col-sm-12">
                    <iframe src="{{$tutor->intro_video_link}}" width="100%" height="360" frameborder="0" allowfullscreen></iframe>
                </div>
                    {{--https://www.youtube.com/embed/8LVN7WVgx0c?ecver=2--}}
                    @endif
            </div>
        </div>
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
                                <span style="color:red" class="note_title"></span>
                                Male: <input type="radio" name="std_gender" @if(Auth::user()->gender != Null) value="{{Auth::user()->gender}}" @else value="male" @endif  class="" placeholder="Gender" required>
                                <span style="color:red" class="note_title"></span>
                                Female:
                                <input type="radio" name="std_gender" @if(Auth::user()->gender != Null) value="{{Auth::user()->gender}}" @else value="male" @endif class="" placeholder="Gender" required>
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
                                 <textarea type="text"  name="std_about" class="from-control" rows="3" required />
                                @if(Auth::user()->about != Null)
                                    {{trim(Auth::user()->about)}}
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group notes-edit-detail col-md-6 ">
                                &nbsp;
                            </div>
                            <div class="form-group notes-detail col-md-6 ">
                                <input type="submit" class="btn btn-primary pull-right" value="submit"/>
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
        $('.c_profile').on('click',function(){
            $('#myModal').modal('toggle');
        });

        $("#std_form").on('submit', function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var formData = new FormData(this);
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
                    console.log(data);
                    $('#myModal').modal('hide');
                    toastr.success('Operation Successfully Completed')
                    setTimeout(function(){
                        window.location = '{{route('profile_index')}}'
                    }, 1000);


                },
                error:function( data ) {

                    var errors = data.responseJSON;
                    toastr.error(errors.error);
//                $("#LoaderGif").hide();
                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                    });
                }
            });
        })
    </script>
@endsection
