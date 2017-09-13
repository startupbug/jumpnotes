@extends('masterlayout')
@section('content')
    <div class="container-fluid text-center banner-text">
        <h3>NOTES</h3>
    </div>
    <div class="meet-with">
        <div class="container-fluid">
    {{--<meta name="_token" content="{{ Session::token() }}"/>--}}
{{--<a href="#" id="addnew">Add Notes</a>--}}
        <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 upload-file">
            <div class="row" id="fileupload">
                <div class="no-marg-top">Upload your notes to the #1 marketplace for students notes </div>
                <div class="addnewnote"><button id="addnew" type="button" data-toggle="modal" data-target="#myModal">Add New Note</button></div>
            </div>
        </div>
        </div>

    {{--<button id="addnew" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">ADD NEW</button>--}}
<div id="uploadedNotes">
<h3>Your Notes</h3>
    <div class="row">
        <?php $note_file = "" ?>
    @foreach($notes as $note)
            <div style="margin-bottom: 4%" data-id="{{$note->notes_id}}" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 main-text col-md-offset-0">
                <span data-id="{{$note->notes_id}}">
                <div class="pos-left details detail-home">
                    <div class="desc-dv title views-no col-md-12" data-id="{{$note->notes_id}}">
						<h2><a class="note_main_title" href="{{route('single_note',['id' => $note->notes_id])}}" title="{{$note->note_title}}">@if(strlen($note->note_title)>20)<?php echo substr($note->note_title,0,20)?>...@else {{$note->note_title}}@endif</a></h2>
                    </div>
                    <div class="pull-left col-md-12 file-ico">
                        @if($note->file_type)
                            <?php $img = explode(',',$note->note_file)?>
                            <img src="{{asset('/public/notes/')}}/{{$img[0]}}">
                        @else
                            @if(empty($note_file))
                                <?php $note_file = $note->note_file?>
                                @endif
                                @if(!empty($note->note_thumb))
                                    <img src="{{asset('/public/notes/thumnail')}}/{{$note->note_thumb}}">
                                @else
                                    <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i>
                                @endif
                            {{--<span class="text-center"><i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></span>--}}
                        @endif
                        <div class="overlay"></div>
                        <div class="button left-button"><a href="#" class="editNote" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-pencil fa-fw fa-2x"></i>
                            </a></div>
                        <div class="button right-button"><a href="#" class="deleteNote">
                                <i class="fa fa-trash-o fa-fw fa-2x"></i>
                            </a></div>

                    </div>
                    <input type="hidden" class="single_note_detail" name="details" value="{{$note->note_detail}}"/>
                    <div class="desc-dv title-desc col-md-12">
                        <h4>Auhor : {{Auth::user()->username}} <small class="pull-right">Rating:
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

                        <p class="pull-left ">Subject: <span class="note_sub">{{$note->note_subject}}</span></p>
                        <p class="pull-right ">Level: <span class="note_level">{{$note->note_class}}</span></p>



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
                    </span>
            </div>
        {{-------------old------------}}
    @endforeach
</div>
<div class="row">
        <div class="col-md-12 pull-right">
            {{ $notes->links() }}    
        </div>
    </div>
    {{--@foreach($notes as $note)--}}
        {{--<div data-id="{{$note->notes_id}}">--}}
       {{--<lable>Note Title: <span class="note_title">{{$note->note_title}}</span></lable>--}}
        {{--<p>Details: <span class="note_detail">{{$note->note_detail}}</span></p>--}}
        {{--<small>File: <span class="note_file">{{$note->note_file}}</span></small>--}}
        {{--<a href="#" class="editNote">edit</a>--}}
        {{--<a href="#" class="deleteNote">delete</a>--}}
        {{--</div>--}}
        {{--<hr>--}}
    {{--@endforeach--}}
</div>
<br>


{{--<div id="screeshot">--}}
{{--<!-- Iframe view -->--}}
{{--@if(substr($note_file,-3)=='pdf')--}}
                        {{--PDF SECTION--}}
                        {{--<div id="pdf-view">--}}
                            {{--<div id="DIVinPage"></div>--}}
                            {{----}}
                        {{--</div>--}}
                        {{--PDF SECTION END--}}
						{{--@elseif(substr($note_file,-3)!='jpg' || substr($note_file,-3)!='png' || substr($note_file,-3)!='peg')--}}
						{{----}}
			{{--<iframe src="http://docs.google.com/gview?url={{asset('/public/notes/')}}/{{$note_file}}&embedded=true" width="100%" height="600px"></iframe>			--}}
    {{--@endif--}}
{{--<!-- Iframe view end -->--}}
{{--</div>--}}
<div id="newNotes">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Notes</h4>
                </div>
                <div class="modal-body">
                    <form id="notes_form" method="post" role="form" action="{{route('noteUplaod')}}">
                        <div class="row">
                            <div class="form-group note-title col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Note Title </h4>
                            </div>
                            <div class="form-group note-title col-md-6">
                                <span style="color:red" class="note_title"></span>
                                <input type="text" name="note_title" class="form-control" id="note_title" placeholder="Note Title">
                            </div>
                            <div class="form-group upload-notes col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Upload Note Thumbnail </h4>
                            </div>
                            <div class="form-group upload-notes col-md-6">
                                <input type="file" name="note_thumb" multiple/>
                            </div>
                            <div class="form-group upload-notes col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Upload Note's </h4>
                            </div>
                            <div class="form-group upload-notes col-md-6">
                                <input type="hidden" name="notes_id" value="0">
                                <input type="file" name="note_file[]" multiple/>
                            </div>
                            <div class="form-group note-rel-subj col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Note Related Subject: </h4>
                            </div>
                            <div class="form-group note-rel-subj col-md-6">
                                <input type="text" name="note_subject" class="form-control" id="note_subject" placeholder="example : Mathematics">
                            </div>
                            <div class="form-group class-level col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Class Level : </h4>
                            </div>
                            <div class="form-group class-level col-md-6">
                                <input type="text" name="note_class" class="form-control" id="note_class" placeholder="Example : 3rd Semester">
                            </div>
                            <div class="form-group notes-detail col-md-6">
                                <h4 class="no-marg-top no-marg-bottom">Notes Detail : </h4>
                            </div>
                            <div class="form-group notes-edit-detail col-md-6">
                                <span style="color:red" class="note_detail"></span>
                                <textarea type="text" name="note_detail" rows="6" /></textarea>
                            </div>
                            <div class="form-group notes-edit-detail col-md-6 ">
                                &nbsp;
								<img id="LoaderGif" style="max-width:50%" class="img-responsive" src="{{ asset('public/images/clock-loading.gif') }}" />
                            </div>
                            <div class="form-group notes-detail col-md-6 ">
                                <input type="submit" class="btn btn-primary pull-right" value="submit"/>
                            </div>



                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>


        </div>
    </div>

    {{--<h3>Add New Notes</h3>--}}
    {{--<form id="notes_form" method="post" role="form" action="{{route('noteUplaod')}}">--}}
        {{--<label>Note Title</label>--}}
        {{--<span style="color:red" class="note_title"></span>            --}}
        {{--<input type="text" name="note_title"/>--}}
        {{--<br>       --}}
        {{--<input type="hidden" name="notes_id" value="0">--}}
        {{--<label>Upload Notes</label>--}}
        {{--<input type="file" name="note_file"/>--}}
        {{--<br>--}}
        {{--<label>Notes Details</label>--}}
        {{--<span style="color:red" class="note_detail"></span>         --}}
        {{--<input type="text" name="note_detail"/>--}}
        {{--<br>--}}
        {{--<input type="submit" value="submit"/>--}}
    {{--</form>--}}
</div>
<br>
<div id="recentViewedNotes">
    <hr>
</div>
    </div>
    </div>
{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>--}}
<script>
    $( '#DIVinPage' ).ready(function(){
        html2canvas($('#DIVinPage'), {
            onrendered: function(canvas) {
                document.body.appendChild(canvas);
                console.log(canvas);
            }
        });
    });
    $('document').ready(function(){
$('#LoaderGif').hide();
//        $('#newNotes').hide();
         $('.deleteNote').on('click',function (e) {
            e.preventDefault();
            var note_id = $(this).closest('span').attr('data-id');
            var url = "notes/notedelete/"+note_id;
            $.get(url,function(data){
                toastr.success('Note Successfully removed');
                location.reload();
            })
        });

         $('.editNote').on('click',function(e){
            e.preventDefault();
//            $('#newNotes').show();
            var note_id = $(this).closest('span').attr('data-id');
            var note_title = $(this).closest('span').find('.note_main_title').text();
            var note_detail = $(this).closest('span').find('.single_note_detail').val();
            var note_subject = $(this).closest('span').find('.note_sub').text();
            var note_level = $(this).closest('span').find('.note_level').text();
            $('#notes_form').find('input[name=notes_id]').val(note_id);
            $('#notes_form').find('input[name=note_title]').val(note_title);
            $('#notes_form').find('input[name=note_subject]').val(note_subject);
            $('#notes_form').find('input[name=note_class]').val(note_level);
            $('#notes_form').find('textarea[name=note_detail]').val(note_detail);
            $(this).val($('#notes_form').find('input[name=notes_id]'));
        });
//        $('#addnew').on('click',function(){
//            $('#newNotes').show();
//        });

        $("#notes_form").on('submit', function(e){
            e.preventDefault();
			$("#LoaderGif").show();
            var url = $(this).attr('action');
            var formData = new FormData(this);
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
					$("#LoaderGif").hide();
                    $('#myModal').modal('hide');
                    toastr.success('Operation Successfully Completed')
                    setTimeout(function(){
                        window.location = '{{route('notesView')}}'
                    }, 1000);
                    

                },
                error:function( data ) {
					$("#LoaderGif").hide();
                    var errors = data.responseJSON;
					er = errors.error;
					console.log('error:'+er);
                    toastr.error(errors.error);
                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                    });
                }
            });
        })
    });
</script>
    <script type="text/x-javascript">

    $(function() {
    $('#DIVinPage').html('<iframe id="MyIFRAME" src="{{asset('/public/notes/')}}/{{$note_file}}" width="100%"  height="600" frameborder="0" scrolling="no" style="overflow-x: hidden;"></iframe>');
    $('#MyIFRAME').unbind('load');
        {{--alert('will alert when all elements in the frame are done');--}}
    });
        </script>
    <script type="text/javascript" src="{{asset('/public/js/html2canvas.js') }}"></script>

@endsection