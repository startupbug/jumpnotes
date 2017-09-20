@extends('masterlayout')
@section('content')

<meta name="_token" content="{{ Session::token() }}"/>
<h2 class="formbox">

</h2>
<div id="info_message_error" style="color: red"></div>

<form id="register_form" role="form" method="post" action="{{route('signup')}}">
    <span style="color:red" class="username"></span>
    <input type="text" name="username" placeholder="username" />
    <span style="color:red" class="email"></span>
    <input type="email" name="email" placeholder="email"/>
    {{--<input type="text" name="institute" placeholder="institute"/>--}}
    <span style="color:red" class="institute"></span>    
    <select name="institute" required>
@foreach($institutes as $institute)
        <option value="{{$institute->institute_id}}"><?php echo strtoupper($institute->institute_name)?></option>
    @endforeach
        <option value="other">other</option>
    </select>
    <div class="other">
        <input type="text" name="otherInstitute" value=""/>
    </div>
    <span style="color:red" class="password"></span>   
    <input type="password" name="password" placeholder="pass"/>
    <input type="password" name="password2"  placeholder="Re-enter Password"/>
    <input type="submit" name="submit" value="submit"/>  <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" />

</form>





<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('#LoaderGif').hide();
    $('document').ready(function(){
        $('.other').hide();
        $('select[name=institute]').on('change',function(){
           if($(this).val() == "other"){
               $('.other').show();
           }
           else{
               $('.other').hide();
           }
        });

        $("#info_message_error").hide();

    $("#register_form").on('submit', function(e){
        e.preventDefault();
        $("#LoaderGif").show();
//        base_url  = '/ukshortlets/';
        var url = $(this).attr('action');
        //alert(url)
//        $("#LoaderGif").show();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        });
        $.ajax({
            url: url,// $("#register_form :input[name!=password2]").serializeArray()
            type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function( data ) {
//                $("#LoaderGif").hide();
                //$("#info_message_suc").show();
                toastr.success('Successfully Registered')
//                $("#createAccountHeading").hide();
//                $(".para_create").hide();
               // $(".formbox").html(data.html);
                $("#LoaderGif").hide();
                setTimeout(function(){
                    window.location = "{{route('home')}}";
                },1500);
            },
            error:function( data ) {
//                $("#LoaderGif").hide();
                toastr.error('Unable to Signup due to some errors');
                $("#LoaderGif").hide();
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