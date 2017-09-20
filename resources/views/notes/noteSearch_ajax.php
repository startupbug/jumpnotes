    @foreach($notes as $note)
        <div data-id="{{$note->notes_id}}">
       <lable>Note Title: <span class="note_title"><a href="{{ route('single_notes_index', ['id' => $note->notes_id]) }}">{{$note->note_title}}</a></span></lable>
        <p>Details: <span class="note_detail">{{$note->note_detail}} maaz 2</span></p>
        <small>File: <span class="note_file">{{$note->note_file}}</span></small>
        <p>Note Posted On {{ date("F jS, Y", strtotime($note->created_at)) }} </p>
        </div>
        <hr>
    @endforeach
