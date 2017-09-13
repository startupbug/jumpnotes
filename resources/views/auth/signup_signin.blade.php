@extends('masterlayout')
@section('content')
<div class="container-fluid text-center trans-text">
    <h3>Signup / Login</h3>
</div>


@if(Session::has('flasherror'))
    <script>
    toastr.error( 'Wrong email address' + '<br><br>');
    </script>
    {{ Session::forget('flasherror') }}
@endif

@if(Session::has('flashS'))
    <script>
        toastr.success("Your request has been sent please check your email" + '<br><br>');
    </script>
    {{ Session::forget('flashS') }}
@endif


@if(!empty($flash))
    <script>
        toastr.success('{{$flash}}<br><br>');
    </script>
@endif


<style>
    .formerror{
        color: #d90000;
    }
</style>

<div class="container no-padding">
    <!--signup-->
    <div class="col-lg-5 col-md-12 col-sm-12 float-left-sign no-padding">
        <h2 class="formbox">

        </h2>
        <div id="info_message_error" style="color: red">
        </div>
        <div id="logbox" class="signup">
            <form id="register_form" method="post" action="{{route('signup')}}" role="form" class="form-horizontal">
                <h1>Create an account</h1>

                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                        <input type="email" required class="form-control" name="email" id="email" placeholder="Email">
                        <span class="formerror email"></span>
                    </div>
                </div>
                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Full Name</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Full Name">
                        <span class="formerror username"></span>
                    </div>
                </div>
                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <span class="formerror password"></span>
                    </div>
                </div>
                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Confrim Password</label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" name="password2" id="cpassword" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="form-group user-name sel-box country col-md-12 hg">
                    <label class="control-label col-lg-3">Institute</label>
                    <div class="col-lg-9">
                        <span class="formerror institute"></span>
                        <select name="institute" required class="form-control" >
                            @foreach($institutes as $institute)
                                <option value="{{$institute->institute_id}}"><?php echo strtoupper($institute->institute_name)?></option>
                            @endforeach
                            <option value="other">other</option>
                        </select>
                        <div class="other">
                            <input class="form-control" type="text" name="otherInstitute" value="" placeholder="other" />
                        </div>
                        {{--<select class="form-control">--}}
                            {{--<option>Institute 1</option>--}}
                            {{--<option>Institute 2</option>--}}
                            {{--<option>Institute 3</option>--}}
                        {{--</select>--}}
                    </div>
                </div>
                <div class="form-group col-md-12 float-left-sign">
                    <div class="col-lg-3 col-md-0">&nbsp;</div>
                    <div class="col-lg-9 col-md-12">
                        {{--<a href="#" class="btn btn-primary sends">Signup </a>--}}
                        <input type="submit" class="btn btn-primary sends" name="submit" value="submit"/>
                        <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" />
                    </div>
                </div>
                <div class="form-group col-md-12 float-left-sign">
                    <div class="col-lg-3 col-md-0">&nbsp;</div>
                    <div class="col-lg-9 col-md-12">
                        <h4>Login via Facebook, <a href="{{asset('/login')}}">Login</a></h4>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!--col-md-6-->

    <div class="col-lg-2 col-md-12 col-sm-12 float-left-sign none">
        <div class="wrapper">
            <div class="line"></div>
            <div class="wordwrapper">
                <div class="word">or</div>
            </div>
        </div>
    </div>
    <!--signin-->
    <div class="col-lg-5 col-md-12 col-sm-12">
        <div id="logbox" class="signup">
            <form id="signin_form" role="form" method="post" action="{{ route('signin')}}" class="form-horizontal">
                <h1>Login to Your Account</h1>
                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                        <input type="email" name="login_email" class="form-control" id="login_email" placeholder="Email">
                        <span class="formerror login_email"></span>
                    </div>
                </div>
                <div class="form-group user-name col-md-12">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" name="login_password" id="password" placeholder="Password">
                        <span class="formerror login_password"></span>
                    </div>
                </div>
                <div class="form-group  col-md-12 float-left-sign">
                    <div class="col-lg-3 col-md-0">&nbsp;</div>
                    <div class="col-lg-9 col-md-12">
                        {{--<a href="#" class="btn btn-primary sends">Login</a>--}}
                        <input type="submit" class="btn btn-primary sends" name="submit" value="Log In"/>
                    </div>
                </div>
                <div class="form-group col-md-12 float-left-sign">
                   <div class="col-lg-3 col-md-0">&nbsp;</div>
                    <div class="col-lg-9 col-md-12">
                        <h4>Forgot your password, <a href="#forgotModel" data-toggle="modal" data-target="#forgotModel">Click here</a></h4>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="forgotModel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Forget Password</h4>
            </div>
            <div class="modal-body">
                <label>Enter your Email address: </label>
                <form method="post" action="{{route('forgotPass')}}">
                    <input type="email" class="input-lg" name="forgot_email" placeholder="example@example.com"/><br/><br/>
                    <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                    <input type="submit" class="btn btn-primary" name="forgot_submit" value="submit"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
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
                    toastr.success('Successfully Logged In')
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
                        window.location = "{{route('auth_view')}}";
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
