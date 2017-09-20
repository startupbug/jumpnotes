<?php $num = 0;?>
@foreach($notes as $note)
	<div data-id="{{$note->notes_id}}" class="col-lg-4 col-md-12 col-sm-12 col-xs-12 main-text col-md-offset-0">
		<div class="pos-left details detail-home">
			<div class="desc-dv title views-no col-md-12">
				<h2><a href="{{route('single_note',['id' => $note->notes_id])}}" title="{{$note->note_title}}">@if(strlen($note->note_title)>20)<?php echo substr($note->note_title,0,20)?>...@else {{$note->note_title}}  @endif</a></h2>
			</div>
			<a href="{{route('single_note',['id' => $note->notes_id])}}" class="pull-left col-md-12 file-ico">
				<div class="overlay-viewnotes"></div>
				@if($note->file_type)
                    <?php $img = explode(',',$note->note_file)?>
					<img src="{{asset('/public/notes/')}}/{{$img[0]}}">
				@else

					@if(!empty($note->note_thumb))
						<img src="{{asset('/public/notes/thumnail')}}/{{$note->note_thumb}}">
					@else
						<iframe src="http://docs.google.com/gview?url={{asset('/public/notes/')}}/{{$note->note_file}}&embedded=true" width="100%" height="600px"></iframe>
					@endif

				@endif
			</a>
			<div class="desc-dv title-desc col-md-12">
				<h4>Auhor : {{$note->username}} <small class="pull-right">Rating:

                        <?php $ratting = round($note->note_rating);?>
						@for($i=0;$i<5;$i++)
							@if($ratting!=0)
								<span class="glyphicon glyphicon-star"></span>
                                <?php $ratting--;?>
							@else
								<span class="glyphicon glyphicon-star-empty"></span>
							@endif
						@endfor
					</small></h4>

				<p class="pull-left "><b>Subject:</b> <span class="note_sub" >@if(strlen($note->note_subject)>10) {{substr($note->note_subject,0,10)}}... @else {{$note->note_subject}} @endif</span></p>
				<p class="pull-right "><b>Level:</b> <span class="note_level" >@if(strlen($note->class)>10) {{substr($note->note_class,0,10)}}... @else {{$note->note_class}} @endif</span></p>


				{{--<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium...<p>--}}
			</div>
			<div class="desc-dv views-no col-md-12 col-sm-12 col-xs-12">
				No of View: {{$note->view_count}}

				<div class="rating pull-right">
					<a style="color: #ffffff" href="{{route('single_note',['id' => $note->notes_id])}}">READ MORE  &#10095;</a>
					{{--<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">--}}
					{{--</span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">--}}
					{{--</span><span class="glyphicon glyphicon-star-empty"></span>--}}
				</div>

			</div>


		</div>

	</div>
	<?php $num++?>
@endforeach
@if($num > 8)
{{ $notes->links() }}
@endif
