@extends('masterlayout')
@section('content')
		<!-- / NOTES BANNER  -->
<div class="container-fluid text-center banner-text">
  <h3>NOTES</h3>
</div>

	<!-- / SEARCH NOTES BLOCK -->

<div class="meet-with">
<div class="container-fluid">

<div class="text-center">
  <h2>SEARCH NOTES HERE</h2>
</div>

<div class="main-search">
    <form id="searchNote" action="{{ route('noteTextSearch') }}" >
   <div class="input-group col-md-12">

          <input type="text" name="searchText" id="searchText" placeholder="Search By Note Title" class="  search-query form-control" placeholder="" />
       <span class="input-group-btn">
           <input type="submit" value="SEARCH" name="noteSearch" class="btn btn-primary btn-lg" /></span>
       {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-primary btn-lg" type="button">--}}
                                        {{--<span>SEARCH</span>--}}
                                    {{--</button>--}}
                                {{--</span>--}}
   </div>
    </form>
    <div class="main-form">
        <div class="container-fluid">
         <form>
                <div class="row">

                    <div class="col-md-3 sel-box">
                        <select id="searchInstituteName" name="searchInstituteName" class="form-control">
						<option selected disabled>Select Institute/School</option>
        				 	@foreach($institutes as $institute)
        				 	<option data-id="institute" value="{{ $institute->institute_id }}">{{ $institute->institute_name }}</option>
        				 	@endforeach
                        </select>
                    </div>
                   <div class="col-md-3 sel-box">
                        <select id="searchProfessorName" name="searchProfessorName" class="form-control">
						<option selected disabled>Select Author</option>
        				 	@foreach($professors as $professor)
        				 	<option data-id="professor" value="{{ $professor->tutor_id }}">{{ $professor->username }}</option>
        				 	@endforeach
                        </select>
                    </div>
                    <div class="col-md-3 sel-box">
                        <select id="searchStarwise" name="searchStarwise" class="form-control">
						<option selected disabled>Select Most Rated Notes</option>
        				 	<option data-id="ratting" value="4">Five Star Notes</option>
        				 	<option data-id="ratting" value="3">Four Star Notes</option>
        				 	<option data-id="ratting" value="2">Three Star Notes</option>
        				 	<option data-id="ratting" value="1">Two Star Notes</option>
        				 	<option data-id="ratting" value="0">One Star Notes</option>
                        </select>
                    </div>
                   <div class="col-md-3 sel-box">
                        <select id="searchMajorName" name="searchMajorName" class="form-control">
						<option selected disabled>Select Subject</option>
        			 	@foreach($professors as $professor)
        			 	<option data-id="majors" value="{{ $professor->tutor_majors }}">{{ $professor->tutor_majors }}</option>
        			 	@endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


 <!-- / FIRST ROW -->

<div class="first-row" id="searchList">
  <?php $num = 0;?>
    @foreach($notes as $note)
	<div data-id="{{$note->notes_id}}" class="col-lg-4 col-md-12 col-sm-12 col-xs-12 main-text col-md-offset-0">
        <div class="pos-left details detail-home">
            <div class="desc-dv title views-no col-md-12">
				<h2><a href="{{route('single_note',['id' => $note->notes_id])}}" title="{{$note->note_title}}">@if(strlen($note->note_title)>15)<?php echo substr($note->note_title,0,15)?>...@else {{$note->note_title}}@endif</a></h2>
            </div>
            <a href="{{route('single_note',['id' => $note->notes_id])}}" class="pull-left col-md-12 file-ico">
                                        @if($note->file_type)
                                            <?php $img = explode(',',$note->note_file)?>
                                        <img src="{{asset('/public/notes/')}}/{{$img[0]}}">
                                            @else

                                            @if(!empty($note->note_thumb))
                    <img src="{{asset('/public/notes/thumnail')}}/{{$note->note_thumb}}">
                    @else

                    <div class="overlay-viewnotes"></div>
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
                <p class="pull-right "><b>Level:</b> <span class="note_level" >@if(strlen($note->note_class)>19) {{substr($note->note_class,0,10)}}... @else {{$note->note_class}} @endif</span></p>


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
    {{ $notes->links() }}
    <!-- @if($num > 8) -->

    <!-- @endif -->
</div>
</div>

   <!-- SEARCH NOTES BLOCK  END-->


<!-- FOOTER BLOCK -->

    </div>

@endsection


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){

    $("#searchProfessorName").select2();

	$("#searchNote").submit(function(e){
		//SearchNote
		console.log("Search note");
            e.preventDefault();

            var formData = new FormData(this);
            url = $(this).attr('action');

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: formData,
                processData: false,
                contentType: false,
                cache: true,
                success: function( data ) {
                    console.log(data);
                    $("#searchList").html(data.html);
                    //window.location = '{{route('notesView')}}'
                },
                error:function( data ) {
                	console.log(data);
                }
            });
	});

    $('#searchInstituteName, #searchProfessorName, #searchMajorName , #searchStarwise').change(function(e){
        e.preventDefault();
        var value = $(this).val();
        var name =  $(this).find(':selected').data('id');
        console.log("institute==" + value);
        console.log("name==" + name);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            url = "{{ route('noteDropSearch') }}";

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: {'name': name, 'value': value},
                cache: true,
                success: function( data ) {
                    console.log(data);
                    $("#searchList").html(data.html);
                    //window.location = '{{route('notesView')}}'
                },
                error:function( data ) {
                    console.log(data);
                }
            });

    });
    window.oncontextmenu = function () {
       return false;
     }
     document.onkeydown = function (e) {
       	if (window.event.keyCode == 123 || e.button==2)
        	return false;
        }
});

</script>
