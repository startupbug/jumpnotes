$(document).ready(function(){

	function events(){

		
	}
	var abcd = $.get('scheduleGet', function(response) {
	    // handle your response here
			console.log(response);
		})
	console.log(abcd);
	var abc = [
				{
					title: 'All Day Event',
					start: '2017-09-01'
				},
				{
					title: 'Long Event',
					start: '2017-09-07',
					end: '2017-09-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-09T19:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-09T20:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-09T21:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-09T23:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2017-09-12T10:30:00',
					end: '2017-09-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2017-09-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2017-09-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2017-09-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2017-09-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2017-09-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2017-09-28'
				},
				{
					title: 'new testing',
					
					start: '2017-09-29'
				}
			];
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title'
		},
		defaultView: 'basicWeek',
		defaultDate: '2017-09-11',
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: abc
	});

});

jQuery('#datepick').click(function(){
	var startWeek = jQuery('#startWeek').val();
	var endWeek = jQuery('#endWeek').val();
	$.ajaxSetup({
	    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	});
	$.ajax({
		url: "set-schedule/ajax",
		type: "POST",
		data: { 'startWeek': startWeek, 'endWeek': endWeek},
		success: function(data){
			console.log(data);
		}

	})
})

