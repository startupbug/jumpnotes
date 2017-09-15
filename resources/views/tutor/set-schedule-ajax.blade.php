<?php 
	$date = new DateTime('00:00:00');
	$i = 0;
?>
@for ($i= 1; $i <= 48; $i++)
	<?php $date->add(new DateInterval('PT30M')); ?>
	<span>{{$date->format('H:i')}}</span>
	<input type="checkbox" name="timing[]" class="border-right border-bottom" value="{{$date->format('H:i')}}">
@endfor
<input type="hidden" name="date" value="{{$sDate}}">
<button type="submit"  class="full-schedule" name="">Submit</button>