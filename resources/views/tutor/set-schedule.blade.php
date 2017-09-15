@extends('masterlayout')
@section('content')


<div class="container-fluid text-center trans-text">
    <h3>Set Your Schedule</h3>

    <form method="post" action="{{route('submitShedule')}}">
    	<input type="date" name="startWeek" id="startWeek" data-date-format="yyyy/mm/dd">
    	<input type="date" name="endWeek" id="endWeek" data-date-format="yyyy/mm/dd">
    	<div id="datepick">click</div>
		<div id="schedule"></div>
		
		<input type="hidden" name="_token" value="{{Session::token()}}">
    </form>
</div>

@endsection



