<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="_token" content="{{ Session::token() }}"/>
    <title>Jumping Notes</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,600i,700,700i,800,900,900i">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{asset('/public/css/style.css') }}" rel="stylesheet">

    <link href="{{asset('/public/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/public/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('/public/css/star-rating.css')}}" media="all" type="text/css"/>
    <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Toastr CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- <link href="{{asset('/public/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{asset('/public/css/jquery.sharebox.css')}}">


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->

    <!-- Select2 css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- <script src="https://js.braintreegateway.com/v2/braintree.js"></script> -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        // braintree.setup("@braintreeClientToken", "<integration>", options);

    </script>
    <!-- <script type="text/javascript" src="{{asset('/public/js/bootstrap-datetimepicker.js')}}"></script> -->


</head>
<body class="home">

<nav class="main-nav navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="{{route('home')}}"><img src="{{asset('/public/dynamic_assets/1495873280-j_logo.png')}}" alt=""/></a>
        </div>
        <div class="collapse navbar-collapse " id="myNavbar">
            <ul class="nav navbar-nav nav-right navbar-right">
                <li><a href="{{ route('about_index') }}">About Us</a></li>
                @if(Auth::check())
                <li><a href="{{route('profile_index')}}">Profile</a></li>
                @endif
                {{--<li><a href="#">Transaction</a></li>--}}
                <li><a href="{{route('notes_index')}}">Notes</a></li>
                <li><a href="{{route('tutorsView')}}">Find Tutor</a></li>
                @if(Auth::check())
                   <!-- <li><a href="{{route('logout')}}">Log Out</a></li> -->
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">@if($tutor_globalflag) <i class="fa fa-suitcase"></i> @else <i class="fa fa-graduation-cap"></i> @endif {{strtoupper(Auth::user()->username)}} <span class="caret"></span></a>

                      <ul class="dropdown-menu" role="menu">

                        {{--<li><a href="{{ route('notesView') }}">Your Notes</a></li>--}}
                        {{--<li><a href="{{ route('inbox_index') }}">Messages</a></li>--}}
                        <li class="popup"><a href="{{ route('notesView') }}">Your Notes <span>{{$your_note_count }}</span></a></li>
                        <!-- <li class="popup"><a href="{{ route('inbox_index') }}">Chat Room <span>{{Config::get('unread_msgs')}}</span></a></li> -->
                        <li class="popup"><a href="{{route('profile_index')}}">Chat Room <span>{{Config::get('unread_msgs')}}</span></a></li>
                          @if(!$tutor_globalflag)
                          <li><a href="{{route('tutorRegisterView')}}">Become Tutor</a></li>
                          @endif
                          @if(Auth::user()->id == 1)
                          <li><a href="{{route('dashboard')}}">Admin Dashboard</a></li>
                          @endif

                        <li><a href="{{ route('requestsView') }}">Your Requests</a></li>
                        @if($tutor_globalflag)
                        <li><a href="{{route('tutorbookings')}}">Student Requests</a></li>
                        <li>
						<!--<a href="#withdrawModal" data-toggle="modal" data-target="#withdrawModal">Earned: $ {{$tutor_earning}}</a>-->
						<a>Earned: $ {{$tutor_earning}}</a>
						</li>
                        @endif

						</li>
                        <li><a href="{{route('logout')}}">Logout</a></li>

                      </ul>
                    </li>
                @else
                <li><a href="{{route('auth_view')}}">Login/Sign Up</a></li>
                @endif
            </ul>

        </div>
    </div>
</nav>
@if(Session::has('headerflasherror'))
    <script>
    toastr.error( '{{Session::get("flasherror")}}');
		toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

    </script>
    {{ Session::forget('headerflasherror') }}
@endif

@if(Session::has('headerflash'))
    <script>
    toastr.success( '{{Session::get("headerflash")}}');
    </script>
    {{ Session::forget('headerflash') }}
@endif
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Do you want to withdraw your money</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-8 col-md-offset-2 thumbnail">
                    <form id="paypal_email" method="post" action="{{route('paypal_email')}}" role="form">
                        <div class="form-group">
                                <label>Set your paypal email address</label>
                            <input type="text" name="paypal_email" class="form-control" required/>
                            <input type="hidden" value="{{ Session::token() }}" name="_token" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit"/>
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
