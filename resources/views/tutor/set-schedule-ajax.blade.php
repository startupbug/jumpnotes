<?php $ar;?>
@foreach($data as $da)
	<?php $ar[] = $da?>
@endforeach
<?php $a = count($ar); ?>
<table>
	<tr>
		@for($i=0; $i<=$a;)
			<td>{{$ar[$i]->time}}</td>
			<?php $i = $i + 48?>
		@endfor
	</tr>
	
</table>
