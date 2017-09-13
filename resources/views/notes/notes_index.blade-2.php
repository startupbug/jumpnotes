@extends('masterlayout')
@section('content')
{{--<meta name="_token" content="{{ Session::token() }}"/>--}}

<div id="uploadedNotes">
<h3>Notes</h3>
<b>Search</b>
<form id="searchNote" action="{{ route('noteTextSearch') }}" >
 <input type="text" name="searchText" id="searchText" placeholder="Search Title" value="" />
 <input type="submit" value="Search" name="noteSearch"/>
</form>
 <br>
 <select id="searchInstituteName" name="searchInstituteName">
 	@foreach($institutes as $institute)
 	<option data-id="institute" value="{{ $institute->institute_id }}">{{ $institute->institute_name }}</option>
 	@endforeach
 </select>

 <select id="searchProfessorName" name="searchProfessorName">
 	@foreach($professors as $professor)
 	<option data-id="professor" value="{{ $professor->tutor_id }}">{{ $professor->username }}</option>
 	@endforeach
 </select>

 <select id="searchMajorName" name="searchMajorName">
 	@foreach($professors as $professor)
 	<option data-id="majors" value="{{ $professor->tutor_majors }}">{{ $professor->tutor_majors }}</option>
 	@endforeach
 </select>

    <div id="searchList">
      <?php $num = 0;?>
    @foreach($notes as $note)
        <div data-id="{{$note->notes_id}}">
       <lable>Note Title: <span class="note_title"><a href="{{ route('single_note', ['id' => $note->notes_id]) }}">{{$note->note_title}}</a></span></lable>
        <p>Details: <span class="note_detail">{{$note->note_detail}}</span></p>
        <small>File: <span class="note_file">{{$note->note_file}}</span></small>
        <p>Note Posted On <?php echo date("F jS, Y", strtotime($note->created_at)); ?></p>
        </div>
        <hr>
        <?php $num++?>
    @endforeach
   </div>
</div>

{{ $notes->links() }}

@endsection


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){


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

    $('#searchInstituteName, #searchProfessorName, #searchMajorName').change(function(e){
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
});

</script>
