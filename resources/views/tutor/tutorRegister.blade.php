@extends('masterlayout')
@section('content')



<div class="container-fluid text-center trans-text">
  <h3>Become A Tutor</h3>
</div>

	  <div class="container">
    <div class="col-md-12">
    <div id="logbox" class="signup fullwidth">
      <form id="tutor_form" method="post" action="{{route('tutorRegister')}}" class="form-horizontal">
        <h1>Tutor Registration</h1>

        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Tutor Unique Identity</label>
        	<div class="col-lg-8">
        	 <input type="text" class="form-control" id="tutor_name" name="tutor_name" placeholder="Tutor Unique Name">
         	</div>
        </div>
        <div class="form-group sel-box country col-md-12">
        	<label class="control-label col-lg-4">Country</label>
            <div class="col-lg-8">
                <select name="tutor_country" id="country" class="form-control">
                    <option selected disabled>Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}"><?php echo strtoupper($country->name)?></option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group sel-box country col-md-12">
        	<label class="control-label col-lg-4">State</label>
            <div class="col-lg-8">
                <select disabled id="state" name="tutor_state" class="form-control">
                    <option selected>Select Country First</option>

                </select>
            </div>
        </div>
        <div class="form-group sel-box country col-md-12">
        	<label class="control-label col-lg-4">City</label>
            <div class="col-lg-8">
                <select id="city" class="form-control" disabled name="tutor_city">
                    <option selected>Select State First</option>

                </select>
            </div>
        </div>
        <div class="form-group sel-box country phone col-md-12">
            <label class="control-label col-lg-4">Phone</label>
            <div class="col-lg-2">
                <input type="text" class="form-control" id="phonecode" name="tutor_phoneCode" placeholder="Phone code">
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="tutor_phone" name="tutor_phone" placeholder="Phone no.">
            </div>
        </div>

        <div class="form-group sel-box country col-md-12">
        	<label class="control-label col-lg-4">Native Language</label>
            <div class="col-lg-8">
                <select name="tutor_lanuage" class="form-control">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"><?php echo strtoupper($language->name)?></option>
                    @endforeach
                </select>
            </div>
        </div>
          <div class="form-group col-md-12">
              <label class="control-label col-lg-4">Other Languages</label>
              <div class="col-lg-8">
                  <input type="text" name="tutor_other_lang" class="form-control" id="tutor_other_lang" placeholder="example : german,Spanish">
              </div>
          </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Tutor Qualification</label>
        	<div class="col-lg-8">
         		<input type="text" name="tutor_qualification" class="form-control" id="tutor_qualification" placeholder="example : bscs">
        	</div>
        </div>
        <div class="form-group sel-box country col-md-12">
        	<label class="control-label col-lg-4">Gender</label>
            <div class="col-lg-8">
                <select name="tutor_gender" class="form-control">
                    <option name="male">Male</option>
					<option name="female">Female</option>
                    <option name="other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Majors</label>
        	<div class="col-lg-8">
         		<input type="text" name="tutor_majors" class="form-control" id="tutor_majors" placeholder="Tutor Majors">
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Skills</label>
        	<div class="col-lg-8">
         		<input type="text" name="tutor_skills" class="form-control" id="tutor_skills" placeholder="Tutor Skills">
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Charges Per Hour</label>
        	<div class="col-lg-8">
         		<input type="text" name="per_hour_charges" class="form-control" id="per_hour_charges" placeholder="Charges Per Hour">
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Profile Pic</label>
        	<div class="col-lg-8">
         		<input type="file" name="profile_pic" class="upload-file">
        	</div>
        </div>
          <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Upload Transcript</label>
        	<div class="col-lg-8">
         		<input type="file" name="tutor_transcript" required class="upload-file">
                <small>(upload your transcript to prove your education)</small>
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Short Description about me</label>
        	<div class="col-lg-8">
         		<textarea placeholder="Something about you" class="form-control" row="4" id="description" name="tutor_about"></textarea>
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">Introductory Video Link (If Any)</label>
        	<div class="col-lg-8">
         		<input type="text" class="form-control" name="video_link" id="videolink" placeholder="only youtube link">
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<label class="control-label col-lg-4">What You Teach</label>
        	<div class="col-lg-8">
                <textarea row="4" required class="form-control" name="lesson_desc" id="lesson" placeholder="Lesson Detail"></textarea>
         		{{--<input type="text" class="form-control" name="lesson_desc" id="lesson" placeholder="Lesson Detail">--}}
        	</div>
        </div>
        <div class="form-group col-md-12">
        	<div class="col-md-4">&nbsp;</div>
        	<div class="col-md-8">
    <input type="submit" class="btn btn-primary edits sends" name="submit" value="Become Tutor"/>
    <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" />
<!--            	<a href="#" class="btn btn-primary edits sends">Signup </span></a> -->
        	</div>
        </div>


      </form>
    </div>
   </div>
    <!--col-md-6-->
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
                        $('#state').prop('disabled', false);
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
                                        $('#phonecode').prop('disabled', true);
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
                            $('#city').prop('disabled', false);
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
$("#LoaderGif").hide();
        $("#info_message_error").hide();
        $("#tutor_form").on('submit', function(e){
            e.preventDefault();
//        base_url  = '/ukshortlets/';
            var url = $(this).attr('action');
       $("#LoaderGif").show();
            var formData = new FormData(this);
               // console.log();
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
                  $("#LoaderGif").hide();
                    console.log(data);
//                $("#LoaderGif").hide();
                    $("#info_message_suc").show();
//                $("#createAccountHeading").hide();
//                $(".para_create").hide();
                    toastr.success(data.msg);
                    setTimeout(function(){
                        window.location.href = "{{ route('profile_index') }}";
                    }, 1500);

                    $(".formbox").html(data.html);
                },
                error:function( data ) {
                  $("#LoaderGif").hide();
                    var errors = data.responseJSON;
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
    })
</script>

@endsection
