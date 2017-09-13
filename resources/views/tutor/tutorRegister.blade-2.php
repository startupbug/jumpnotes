<meta name="_token" content="{{ Session::token() }}"/>
<h2 class="formbox">

</h2>

<div id="info_message_error" style="color: red"></div>

<form id="tutor_form" role="form" method="post" action="{{route('tutorRegister')}}">
    <h2>Personal Info</h2>
    <label>Tutor Unique Identity:</label>
    <input type="text" name="tutor_name" placeholder="tutor unique name"/><br>
    <label>Country:</label>
    <select name="tutor_country">
        @foreach($countries as $country)
            <option value="{{$country->id}}"><?php echo strtoupper($country->name)?></option>
        @endforeach
    </select><br>
    <label>State:</label>
    <select name="tutor_state">
        @foreach($states as $state)
            <option value="{{$state->id}}"><?php echo strtoupper($state->name)?></option>
        @endforeach
    </select><br>
    <label>City:</label>
    <select name="tutor_city">
        @foreach($cities as $city)
            <option value="{{$city->id}}"><?php echo strtoupper($city->name)?></option>
        @endforeach
    </select><br>

    <label>Native Language:</label>
    <select name="tutor_lanuage">
        @foreach($languages as $language)
            <option value="{{$language->id}}"><?php echo strtoupper($language->name)?></option>
        @endforeach
    </select><br>
    <label>Tutor Qualification:</label>
    <input type="text" name="tutor_qualification" placeholder="example: bscs"/>
    <br>
    <label>Gender</label>
    <select name="tutor_gender">
        <option name="male">Male</option>
        <option name="female">Female</option>
        <option name="other">Other</option>
    </select>
    <br>
    <lable>Major</lable>
    <input type="text" name="tutor_majors" placeholder="Tutor Majors"/>
    <br>
    <lable>Skills</lable>
    <input type="text" name="tutor_skills" placeholder="Tutor Skills"/>
    <br>
    <lable>Charges Per Hour</lable>
    <input type="number" name="per_hour_charges" placeholder="Charges per hour"/>
    <br>
    <label>Profile Pic</label>
    <input type="file" name="profile_pic"/>
    <br>
    <label>Short discription about you as tutor</label>
    <textarea rows="3" name="tutor_about">

    </textarea>
    <br>
    <lable>Introductory Video link: (if any)</lable>
    <input type="text" name="video_link" placeholder="only you tube link"/><br/>

    <br>
    <lable>Lesson details</lable>
    <input type="text" name="lesson_desc" placeholder="lesson detail"/><br/>

    <input type="submit" name="submit" value="submit"/>
</form>





<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('document').ready(function(){

        $("#info_message_error").hide();
        $("#tutor_form").on('submit', function(e){
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
                    $("#info_message_suc").show();
//                $("#createAccountHeading").hide();
//                $(".para_create").hide();
                    $(".formbox").html(data.html);
                },
                error:function( data ) {
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