@extends('dashboard.masterDashboardLayout')
@section('content')
  <h1>Edit Profile</h1>
  <a href="{{ route('profile_index') }}">My Profile</a>
   <a href="{{route('dashboard')}}">Dashboard</a>


<h2 class="formbox">

</h2>

<div id="info_message_error" style="color: red"></div>

<form id="tutor_edit_form" role="form" method="post" action="{{route('editprofile_post')}}">
    <h2>Personal Info</h2>
    <label>Tutor Unique Identity:</label>
        <span style="color:red" class="tutor_name"></span>      
    <input type="text" name="tutor_name" value="@if(isset($editTutor->tutor_unique)){{$editTutor->tutor_unique}}@endif" placeholder="tutor unique name"/><br>
    <label>Country:</label>
    <select name="tutor_country">
      @foreach($countries as $country)
              <option @if($country->id == $editTutor->country_id) selected="selected" @endif value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select><br>
    <label>State:</label>
    <select name="tutor_state">    	
      @foreach($states as $state)
              <option @if($state->id == $editTutor->state_id) selected="selected" @endif value="{{ $state->id }}">{{ $state->name }}</option>
      @endforeach
    </select><br>
    <label>City:</label>
    <select name="tutor_city">        	
      @foreach($cities as $city)
              <option @if($city->id == $editTutor->city_id) selected="selected" @endif value="{{ $city->id }}">{{ $city->name }}</option>
      @endforeach
    </select><br> other_languages

    <label>Native Language:</label>
    <select name="tutor_lanuage">
      @foreach($languages as $language)
              <option @if($language->id == $editTutor->other_languages) selected="selected" @endif value="{{ $language->id }}">{{ $language->name }}</option>
      @endforeach
    </sel`ect><br>
    <label>Tutor Qualification:</label>
        <span style="color:red" class="tutor_qualification"></span>      
    <input type="text" name="tutor_qualification" value="@if(isset($editTutor->tutor_qualification)){{$editTutor->tutor_qualification}}@endif" placeholder="example: bscs"/>
    <br>

    <lable>Major</lable>
        <span style="color:red" class="tutor_majors"></span>      
    <input type="text" name="tutor_majors" value="@if(isset($editTutor->tutor_majors)){{$editTutor->tutor_majors}}@endif" placeholder="Tutor Majors"/>
    <br>
    <lable>Skills</lable>
        <span style="color:red" class="tutor_skills"></span>      
    <input type="text" name="tutor_skills" value="@if(isset($editTutor->tutor_skills)){{$editTutor->tutor_skills}}@endif" placeholder="Tutor Skills"/>
    <br>
    
    <lable>Charges Per Hour</lable>
        <span style="color:red" class="per_hour_charges"></span>      
    <input type="number" step="any" name="per_hour_charges" value="@if(isset($editTutor->per_hour_charges)){{$editTutor->per_hour_charges}}@endif" placeholder="Charges per hour"/>
    <br>
    <label>Profile Pic</label>
    <input type="file" name="profile_pic"/>
    <br>
    <label>Short discription about you as tutor</label>
        <span style="color:red" class="tutor_about"></span>      
    <textarea rows="3" name="tutor_about">@if(isset($editTutor->tutor_about)){{$editTutor->tutor_about}}@endif</textarea>
    <br>
    <lable>Introductory Video link: (if any)</lable>
        <span style="color:red" class="video_link"></span>      
    <input type="text" name="video_link"  value="@if(isset($editTutor->intro_video_link)){{$editTutor->intro_video_link}}@endif" placeholder="only you tube link"/><br/>

    <br>
    <lable>Lesson details</lable>
        <span style="color:red" class="lesson_desc"></span>      
    <input type="text" name="lesson_desc" placeholder="lesson detail" value="{{$editTutor->lesson_desc}}"/><br/>
    <input type="hidden" value="{{$editTutor->tutor_id}}" name="tutor_id"/>
    <input type="submit" name="submit" value="submit"/>
</form>





<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('document').ready(function(){

        $("#info_message_error").hide();

        $("#tutor_edit_form").on('submit', function(e){
            e.preventDefault();
//        base_url  = '/ukshortlets/';
            var url = $(this).attr('action');
//        $("#LoaderGif").show();
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
                    console.log(data);
//                $("#LoaderGif").hide();
                    toastr.success('Profile Successfully Edited')
                    setTimeout(function(){
                        window.location = '{{route('editprofile_index')}}'
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

@stop