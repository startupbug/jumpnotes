@extends('dashboard.masterDashboardLayout')
@section('content')
  <a href="{{ route('editprofile_index') }}">Edit Profile</a>
  <a href="{{route('dashboard')}}">Dashboard</a>

  <h1 class="heading">Tutor Payment Form </h1>

  @if(Session::has('payment_success'))
	<div class="alert alert-success">
	  <strong>Success!</strong> {{ Session::get('payment_success') }}
	</div>
  @endif

  @if(Session::has('payment_danger'))
	<div class="alert alert-danger">
	  <strong>Error!</strong> {{  Session::get('payment_success') }}
	</div>
  @endif

  <br>
  <br>
  <p>Payment details</p>
   <a href="{{ route('payment_post') }}"><button class="btn ">Payment</button></a>
@stop