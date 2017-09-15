$(document).ready(function(){

	$.get('scheduleGet', function(response) {
    // handle your response here
		events = response;
	})
});

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
	events: window.events
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
			$('#schedule').html(data);
		}

	})
})