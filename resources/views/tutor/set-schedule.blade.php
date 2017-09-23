@extends('masterlayout')
@section('content')


<div class="container-fluid text-center trans-text">
    <h3>Set Your Schedule</h3>

    <form method="post" action="{{route('submitSheduleAjax')}}" class="set-schedule">
    	<input type="date" name="startWeek" id="startWeek" data-date-format="yyyy/mm/dd" class="form-control" required="">
    	<input type="date" name="endWeek" id="endWeek" data-date-format="yyyy/mm/dd" class="form-control" required="">
    	<input type="submit" name="submit" value="Generate Dates" class="form-control btn btn-primary edits">
		
		<input type="hidden" name="_token" value="{{Session::token()}}">
    </form>

    @foreach($data as $da)
        <?php $ar[] = $da; ?>
    @endforeach
    @if(!empty($ar))
        
	<style>
	section.button_info{
		max-width:50%;
		margin:0px auto 10px;
		text-align:center;
	}

section.button_info .nan span{
    width:100px;
    height:20px;
    display:block;
    background:red;
}
section.button_info label{
    margin:0px 5px;
    text-align:center;
	text-indent: 3px;
}
section.button_info .booked span{
    width:100px;
    height:20px;
    display:block;
    background:#1f7f9f;
}
section.button_info .avl span{
    width:100px;
    height:20px;
    display:block;
    background:green;
}
	</style>
	<section class="button_info">
	<label class="nan">Not Available<span></span></label>
	<label class="booked">Booked<span></span></label>
	<label class="avl">Available<span></span></label>
	</section>
    <form method="post" action="{{route('submitShedule')}}" class="schedule-list">    
        <div class="table-responsive">
            <table class="table schedule-table tutor">
                <tr>
                    <?php 
                        $b = count($ar); 
                        $x = $b/48;
                    ?>
                    <td></td>
                    @for($a=0; $a<$b;)
                        <td>{{ $ar[$a]->date }}</td>
                       <?php $a = $a + 48; ?>   
                    @endfor
                </tr>
                @for($i=0;$i<=47;$i++)
                    <tr>
                        <td width="10%">{{ $ar[$i]->time }}</td>
                        @for($a=$i; $a<$b;)
                            <td width="10%" style="position:relative;"><input data-stat="{{ $ar[$a]->status }}" class="without-bg" type="text" name="sch[]" data-id="{{ $ar[$a]->id }}" data-state="{{ $ar[$a]->status }}" value="{{ $ar[$a]->id }},{{ $ar[$a]->status }}" readonly>
							<div style="position:absolute;width:100px;height:20px;top:0px;left:0; right:0; margin:0 auto;" class="<?php echo $ar[$a]->status == 2 ? 'blue' : ($ar[$a]->status == 1 ? 'green':'red') ?>" data-toggle="tooltip"  title="<?php echo $ar[$a]->status == 2 ? 'Booked' : ($ar[$a]->status == 1 ? 'Available' : 'Not Available')?>: {{ $ar[$a]->date }}, {{ $ar[$a]->time }}"></div>
						</td>
                           <?php $a = $a + 48; ?>   
                        @endfor
                    </tr>
                @endfor

            </table>
				<div style="width:60%; margin:auto;">{{ $data->links() }}</div>
        </div>
        <div class="row">
        <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-primary edits">Save</button>
		</div>
    </form>
    @endif
</div>
@endsection



