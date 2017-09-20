@extends('masterlayout')
@section('content')

<meta name="_token" content="{{ Session::token() }}"/>
<h2 class="formbox">

</h2>
<div id="info_message_error" style="color: red"></div>

<form id="signin_form" role="form" method="post" action="{{ route('signin')}}">
    <span style="color:red" class="login_email"></span>    
    <b>Email: </b><input type="email" name="login_email" placeholder="email" required/>
    <br><br>
    <span style="color:red" class="login_password"></span>    
    <b>Password: </b> <input type="password" name="login_password" placeholder="pass" required/>
    <br><br>
    <input type="submit" name="submit" value="Log In"/>
    <br><br>    
</form>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#signin_form").on('submit', function(e){
            e.preventDefault();
//            base_url  = '/ukshortlets/';
            var url = $(this).attr('action');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.ajax({
                url: url, // $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: new FormData(this),
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    toastr.success('Successfully Loggged In')
                    setTimeout(function(){
                        window.location =  "{{route('home')}}"}, 1000);
                },
                error:function( data ) {
                    console.log("error" + data);
                    toastr.error('Error! Invalid Username/Password');

                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                        console.log( index + ": " + value );
                    });

                    console.log(errors);
                }
        });
    });
    });
</script>
@endsection