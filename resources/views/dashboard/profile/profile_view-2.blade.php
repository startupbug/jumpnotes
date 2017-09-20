@extends('dashboard.masterDashboardLayout')
@section('content')
  <h1>My Profile</h1>
  <a href="{{ route('editprofile_index') }}">Edit Profile</a>
   <a href="{{route('dashboard')}}">Dashboard</a>   

   <p>Unique Identity: @if(isset($tutor->tutor_unique))  {{ $tutor->tutor_unique }} @endif </p>
   <p>Country: @if(isset($tutor->country_name))  {{ $tutor->country_name }}@endif </p>
   <p>State : @if(isset($tutor->state_name))  {{ $tutor->state_name }}@endif  </p> 
   <p>City :@if(isset($tutor->city_name)) {{ $tutor->country_name }}  @endif </p>  
   <p>Native language : @if(isset($tutor->languages_name))  {{ $tutor->languages_name }}@endif </p>
   <p>Qualification: @if(isset($tutor->tutor_qualification)) {{ $tutor->tutor_qualification }} @endif </p> 
   <p>Major: @if(isset($tutor->tutor_majors))  {{ $tutor->tutor_majors }}@endif </p>
   <p>Charges per Hour:@if(isset($tutor->per_hour_charges))  {{ $tutor->per_hour_charges }}@endif </p> 
  
   <p>Video: @if(isset($tutor->intro_video_link))  {{ $tutor->intro_video_link }}@endif </p>
   <p>Lesson: @if(isset($tutor->lesson_desc)) {{ $tutor->lesson_desc }} @endif </p>
@stop