@extends('masterlayout')
@section('content')

<div class="container-fluid text-center trans-text">
  <h3>Edit Profile</h3>
</div>

<div class="profile-page">

<div class="container">

   <div class="profile-text">

      <div class="row">
	     <div class="col-lg-12 col-md-12 profile">
		   <div class="row">
        	<div class="col-lg-3 col-md-12 text-center profile-pic no-padding-pic">
            @if(empty($editTutor->profile_pic) || !isset($editTutor->profile_pic))
              <img src="{{ asset('public/profile_pics/dummy_profile.png') }}" height="226" width="224">
            @else
              <img src="{{ asset('public/profile_pics/'.$editTutor->profile_pic) }}" height="226" width="224">
            @endif
            </div>

            <div class="col-lg-9 col-md-12 detail">
            	<div class="row">
            		<div class="col-lg-3">
            			<h3 class="title">@if(isset($tutor->tutor_unique))  {{ $tutor->tutor_unique }} @endif</h3>
                		<!--<h4 class="twitter">@jason123</h4> -->
                	</div>
                    <div class="col-lg-9 text-right links">
                    <a href="{{ route('profile_index') }}" class="btn btn-primary edits">My Profile</a>
                    <!--<a href="#" class="btn btn-primary edits">FOLLOW</a>
                    <a href="#" class="btn btn-primary edits unfollow">UNFOLLOW</a> -->
                    {{--<a href="#" class="btn btn-primary edits">SEND MESSAGE</a>--}}
                    </div>
                </div>
               <!-- Edit Form -->

					<h2 class="formbox">

					</h2>

					<div id="info_message_error" style="color: red"></div>

					<form id="tutor_edit_form" role="form" method="post" action="{{route('editprofile_post')}}">
                    	<h2>Personal Info</h2>
                    	<div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Tutor Unique Identity:</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="tutor_name"></span>
					    <input type="text" name="tutor_name" class="form-control" value="@if(isset($editTutor->tutor_unique)){{$editTutor->tutor_unique}}@endif" placeholder="tutor unique name"/>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Country:</label>
        					<div class="col-lg-7">
								<select name="tutor_country" id="country" class="form-control">
									@foreach($countries as $country)
										<option @if($country->id == $editTutor->country_id) selected="selected" @endif value="{{ $country->id }}">{{ $country->name }}</option>
									@endforeach
								</select>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">State:</label>
        					<div class="col-lg-7">
        	 					<select readonly id="state" name="tutor_state" class="form-control">
					      @foreach($states as $state)
					              <option @if($state->id == $editTutor->state_id) selected="selected" @endif value="{{ $state->id }}">{{ $state->name }}</option>
					      @endforeach
					    		</select>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">City:</label>
        					<div class="col-lg-7">
        	 					<select id="city" readonly name="tutor_city" class="form-control">
					      @foreach($cities as $city)
					              <option @if($city->id == $editTutor->city_id) selected="selected" @endif value="{{ $city->id }}">{{ $city->name }}</option>
					      @endforeach
					    </select>
         					</div>
        				</div>
						<div class="form-group col-md-12">
							<label class="control-label col-lg-5">Gender</label>
							<div class="col-lg-7">
								<span style="color:red" class="tutor_gender"></span>
								<select class="form-control" name="tutor_gender" >
									<option @if($editTutor->tutor_grnder == 'Male') selected @endif>Male</option>
									<option @if($editTutor->tutor_grnder == 'Female') selected @endif>Female</option>
									<option @if($editTutor->tutor_grnder == 'Other') selected @endif>Other</option>
								</select>
							</div>
						</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Native Language:</label>
        					<div class="col-lg-7">
        	 					<select name="tutor_lanuage" class="form-control">
					      @foreach($languages as $language)
					              <option @if($language->id == $editTutor->languag_id) selected="selected" @endif value="{{ $language->id }}">{{ $language->name }}</option>
					      @endforeach
					    </select>
         					</div>
        				</div>
						<div class="form-group col-md-12">
							<label class="control-label col-lg-5">Other Languages:</label>
							<div class="col-lg-7">
								<span style="color:red" class="tutor_name"></span>
								<input type="text" name="tutor_other_lang" class="form-control" value="@if(isset($editTutor->other_languages)){{$editTutor->other_languages}}@endif" placeholder="example: german, spanish"/>
							</div>
						</div>
            <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Tutor Qualification:</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="tutor_qualification"></span>
					               <input type="text" name="tutor_qualification" class="form-control" value="@if(isset($editTutor->tutor_qualification)){{$editTutor->tutor_qualification}}@endif" placeholder="example: bscs"/>
         					</div>
        		</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Major</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="tutor_majors"></span>
					    <input type="text" name="tutor_majors" class="form-control" value="@if(isset($editTutor->tutor_majors)){{$editTutor->tutor_majors}}@endif" placeholder="Tutor Majors"/>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Skills</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="tutor_skills"></span>
					    <input type="text" name="tutor_skills" class="form-control" value="@if(isset($editTutor->tutor_skills)){{$editTutor->tutor_skills}}@endif" placeholder="Tutor Skills"/>
         					</div>
        				</div>

                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Charges Per Hour</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="per_hour_charges"></span>
					    <input type="number" step="any" class="form-control" name="per_hour_charges" value="@if(isset($editTutor->per_hour_charges)){{$editTutor->per_hour_charges}}@endif" placeholder="Charges per hour"/>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Profile Pic</label>
        					<div class="col-lg-7">
        	 					<input type="file" name="profile_pic"/>
         					</div>
        				</div>
                <div class="form-group col-md-12">
            					<label class="control-label col-lg-5">Favorite TV Characters:</label>
            					<div class="col-lg-7">
            	 					<span style="color:red" class="tutor_qualification"></span>
    					               <input type="text" name="tv_character" class="form-control" value="@if(isset(Auth::user()->tv_character) && !empty(Auth::user()->tv_character)){{Auth::user()->tv_character}}@endif" placeholder="Micheal Jackson"/>
             					</div>
            		</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Short discription about you as tutor</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="tutor_about"></span>
					    <textarea rows="3" class="form-control" name="tutor_about">@if(isset($editTutor->tutor_about)){{$editTutor->tutor_about}}@endif</textarea>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Introductory Video link: (if any)</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="video_link"></span>
					    <input type="text" name="video_link" class="form-control"  value="@if(isset($editTutor->intro_video_link)){{$editTutor->intro_video_link}}@endif" placeholder="only you tube link"/>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">Lesson details</label>
        					<div class="col-lg-7">
        	 					<span style="color:red" class="lesson_desc"></span>
					    <input type="text" name="lesson_desc" class="form-control" placeholder="lesson detail" value="{{$editTutor->lesson_desc}}"/><br/>
					    <input type="hidden" value="{{$editTutor->tutor_id}}" name="tutor_id"/>
         					</div>
        				</div>
                        <div class="form-group col-md-12">
        					<label class="control-label col-lg-5">&nbsp;</label>
        					<div class="col-lg-7">
        	 					<input type="submit" name="submit" value="submit" class="btn btn-primary edits sends"/>
         					</div>
        				</div>











					</form>

               <!--/ profile_index -->
            </div>
        </div>
	</div>
</div>

</div>
<!-- TUTOR INFO -->
</div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('document').ready(function(){
        $('#country').change(function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('api/get-state-list')}}?country_id="+countryID,
                    success:function(res){
                        if(res){
                            $("#state").empty();
                            $('#state').prop('readonly', false);
                            $("#state").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#state").append('<option value="'+key+'">'+value+'</option>');
                            });
                            $.ajax({
                                type:"GET",
                                url:"{{url('api/get-code-list')}}?country_id="+countryID,
                                success:function(res){
                                    if(res){
                                        $("#phonecode").empty();
                                        $('#phonecode').prop('readonly', true);
                                        $('#phonecode').val('+'+res.phonecode);

                                    }else{
                                        $("#phonecode").empty();
                                    }
                                }
                            });

                        }else{
                            $("#state").empty();
                        }
                    }
                });

            }else{

                $("#state").empty();
                $("#phonecode").empty();
                $("#city").empty();
            }
        });
        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                    type:"GET",
                    url:"{{url('api/get-city-list')}}?state_id="+stateID,
                    success:function(res){
                        if(res){
                            $("#city").empty();
                            $('#city').prop('readonly', false);
                            $.each(res,function(key,value){
                                $("#city").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#city").empty();
                        }
                    }
                });
            }else{
                $("#city").empty();
            }

        });

        $("#info_message_error").hide();

        $("#tutor_edit_form").on('submit', function(e){
            e.preventDefault();
//        base_url  = '/ukshortlets/';
            var url = $(this).attr('action');
//        $("#LoaderGif").show();
            var formData = new FormData(this);
              // console.log(formData);

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
//                $("#LoaderGif").hide();
                    toastr.success('Profile Successfully Edited')
                    setTimeout(function(){
                        window.location = '{{route('profile_index')}}'
                    }, 1500);

                    $("#info_message_suc").show();
//                $("#createAccountHeading").hide();
//                $(".para_create").hide();
                    $(".formbox").html(data.html);
                  //  location.reload();
                },
                error:function( data ) {
                    $("#LoaderGif").hide();
                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        console.log(index+':'+ value);
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                    });
                }
            });
        })
    });
</script>


@endsection
