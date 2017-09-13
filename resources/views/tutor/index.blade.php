{{--<h1>Tutors</h1>--}}
{{--@foreach($tutors as $tutor)--}}
    {{--<h4>{{$tutor->tutor_id}}</h4>--}}
    {{--<p>{{$tutor->tutor_unique}} <span><button class="book_btn" book_id="{{$tutor->tutor_id}}">Book Lesson</button></span></p>--}}
    {{--<hr>--}}
{{--@endforeach--}}
@extends('masterlayout')
@section('content')
<div class="container-fluid text-center banner-text banner-tutor">
    <h3>TUTORS</h3>
</div>



<!-- / SEARCH NOTES BLOCK -->

<div class="meet-with tutors-area">
    <div class="container-fluid">

        <div class="text-center">
            <h2>SEARCH TUTOR HERE</h2>
        </div>

        <div class="main-search tutor-list">


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
                                    <option selected disabled>Select Ratings</option>
                                    <option data-id="ratting" value="4">Five Star Tutors</option>
                                    <option data-id="ratting" value="3">Four Star Tutors</option>
                                    <option data-id="ratting" value="2">Three Star Tutors</option>
                                    <option data-id="ratting" value="1">Two Star Tutors</option>
                                    <option data-id="ratting" value="0">One Star Tutors</option>
                                </select>
                            </div>
                            <div class="col-md-3 sel-box">
                                <select id="searchMajorName" name="searchMajorName" class="form-control">
                                    <option selected disabled>Select Language</option>
                                    @foreach($languages as $language)
                                        <option data-id="majors" value="{{ $language->id }}">{{ $language->name }}</option>
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




<div class="col-md-4 col-md-offset-5">
		<img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" />
		</div>
            @foreach($tutors as $tutor)
                @if($tutor->users_id != Auth::user()->id)
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 no-pad-left bg no-pad-right margin-botom">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 main-text note-det-img no-pad-left">
                    @if(isset($tutor->profile_pic) && !empty($tutor->profile_pic))
                    <img src="{{asset('/public/profile_pics/').'/'.$tutor->profile_pic}}">
                        @else
                        <img src="{{asset('/public/images/').'/profile-icon.png'}}">
                    @endif
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-pad-left no-pad-right" onmouseover='$("#hover-video").show();' onmouseout='$("#hover-video").hide();'>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 no-pad-left no-pad-right">
                        <div class="desc-dv title-desc col-md-12 no-pad-left no-pad-right note-det-text">
                            <h4>{{$tutor->username}}</h4>
                            <p class="lang">
                                {{--<img src="images/language.png">--}}
                                <small>Native Language: <b>{{$tutor->name}}</b></small></p>
                            <p>
                                @if(strlen($tutor->tutor_about)>210)
                                {{substr($tutor->tutor_about,0,210)}}...
                                    @else
                                    {{$tutor->tutor_about}}
                                @endif
                            </p>
                        </div>
                        <div class="desc-dv views-no no-pad-bottom col-md-12 col-sm-12 col-xs-12 no-pad-left no-pad-right">
                            <a href="{{route('profile_view',['id' => $tutor->users_id ])}}" class="read-more">READ MORE ></a>
                            <div class="rating pull-right right">
                                @if(isset($tutor->tutor_rating))
                                    <?php $rating = round($tutor->tutor_rating);?>
                                    @for($i=0; $i<5; $i++)
                                        @if($rating !=0)
                                                <span class="glyphicon glyphicon-star"></span>
                                            <?php $rating--;?>
                                        @else
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                            @endif
                                        @endfor
                                        @endif
                                {{--<br/>23 Reviews--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-right links tutor-view">
                        <a tutor-name="{{$tutor->username}}" tutor-about = "{{$tutor->tutor_about}}" tutor-pic="{{$tutor->profile_pic}}" tutor-native = "{{$tutor->name}}" tutor-id = "{{$tutor->tutor_id}}" href="#tutorbooking" data-toggle="modal" data-target="#tutorbooking" class="lessonBook btn btn-primary edits">BOOK TUTOR</a>
                        <a href="{{route('tutor_notes',['author_id'=>$tutor->users_id])}}" class="btn btn-primary edits">VIEW NOTES</a>
                        <a href="#" class="btn btn-primary edits sendMsg" id="{{$tutor->users_id}}">SEND MESSAGE</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 bg"  id="hover-video_{{$tutor->tutor_id}}" style="">
                <?php $video_link = $tutor->intro_video_link; ?>
                        @if(!isset($video_link) || empty($video_link))
                          <h4>No video available for this tutor</h4>
                          <br><br><br>
                        @else
                        <iframe  src="{{$tutor->intro_video_link}}" frameborder="0" allowfullscreen></iframe>
                        @endif
            </div>
                @endif
            @endforeach
            <div class="col-md-12">
            {{ $tutors->links() }}
            </div>
            <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Start Chat</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 thumbnail">
                                    <form id="groupForm" method="post" action="{{route('create_group')}}" role="form">
                                        <div class="form-group">
                                            <label>Chat Title/Subject</label>
                                            <input type="text" name="group_name" class="form-control" required/>
                                            <input type="hidden" name="tutor_id" class="tutor_id"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="Submit"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <!-- FIRST BLOCK END -->
    </div>
</div>
<div class="modal fade" id="tutorbooking" tabindex="-1" role="dialog" aria-labelledby="tutorbookingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Want to Book this Tutor</h4>
            </div>
            <div class="modal-body">
              <div class="text-center" style="align-content: center">
                  <img id="tutor_img" src="" width="140" height="140" border="0" class="img-circle"></a>

                  <a id="tutor_id" href=""><h3 id="tutor_name" class="media-heading"></h3></a>
                  <span><strong>Native language: </strong></span>
                          <span id="native_lang" class="label label-warning"></span>
              </div>
              <hr>
              <div class="text-center" style="align-content: center">
                  <p class="text-left"><strong>What I Teach: </strong><br>
                      <span id="tutor_about"></span>
                  </p>
                  <br>
              </div>
            </div>
            <div class="modal-footer">
              <form id="bookForm" role="form" method="post" action="{{route('bookTutor')}}" >
                <div class="text-center" style="align-content: center">
                  <div class="text-center" style="align-content: center">
                        <div class="form-group">
                            <label class="text-info">Your Active Email</label>
                            <input type="email" placeholder="email address" id="contact_email" required name="contact_email" class="form-control input-xs" />
                        </div>
                        <div class="form-group">
                            <label class="text-info">Your Active Skype</label>
                            <input type="text" class="form-control input-xs" id="contact_skype" required name="contact_skype" placeholder="skype id"/>
                        </div>
                        <input type="hidden" value="" name="tutor_id"/>
                        <input type="hidden" value="0" name="note_id"/>
                        <input type="hidden" value="" name="note_title"/>
                        <img id="LoaderGifmodal" src="{{ asset('public/images/loader.gif') }}" />
                        <input type="submit" class="btn btn-default bookSlot" value="Book Your Slot">
                  </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
<script>
    $(document).ready(function() {
      $('#LoaderGifmodal').hide();
$('body').on('click','.lessonBook',function(){
  var id = $(this).attr('tutor-id');
  var tutorname = $(this).attr('tutor-name');
  var tutorabout = $(this).attr('tutor-about');
  var tutorlang = $(this).attr('tutor-native');
  var tutorpic = $(this).attr('tutor-pic');
  $('#tutorbooking').find('#tutor_img').attr('src',"{{asset('/public/profile_pics/')}}/"+tutorpic);
  $('#tutor_id').attr('href',"{{ asset('/')}}/profile_view/"+ id);
  $('#native_lang').html(tutorlang);
  $('#tutor_about').html(tutorabout);
  $('#tutor_name').html(tutorname);
  $('#tutorbooking').find('input[name=tutor_id]').val(id);
});
$('#bookForm').on('submit', function(e){
    e.preventDefault();
//            var form = $(this).closest('form');
    var url = $(this).attr('action');
    console.log(url);
    var formData = $('#bookForm').serialize();//new FormData(this);
    console.log(formData);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
$('#LoaderGifmodal').show();
    $.ajax({
        url: url,// $("#register_form :input[name!=password2]").serializeArray()
        type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
        data: formData,
     //   processData: false,
//                contentType: false,
        cache: true,
        success: function( data ) {
            console.log(data);
            $('#LoaderGif').hide();
            toastr.success('Your request has been sent to tutor he/she will contact you soon!');
            $('#tutorbooking').modal('hide');
            // window.location.href = "{{route('requestsView')}}";

        },
        error:function( data ) {
            // window.location.href = "{{route('requestsView')}}";
            $('#LoaderGif').hide();
          toastr.error('Something went wrong!');
        }

    });
    // window.location.href = "{{route('requestsView')}}";
});

$('#LoaderGif').hide();
        $("#searchProfessorName").select2();
        $("#searchInstituteName").select2();
        $("#searchMajorName").select2();


        $('.sendMsg').on('click',function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            {{--url = "{{ route('group_user_check') }}";--}}
            var url = 'group_user_check/' + id; //
            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                cache: true,
                success: function( data ) {
                if(data.status == true){
                    console.log(data.status);
                    window.location.href = "{{route('profile_index')}}";
                }
                else{
                    console.log(data.status);
                    var tutor_id = data.tutor_id;
                    $('.tutor_id').val(tutor_id);
                    $('#groupModal').modal('show');
                }
                },
                error:function( data ) {
                    console.log(data);
                }

        })
        });
        $('#groupForm').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var formData = $('#groupForm').serialize();//new FormData(this);
            console.log(formData);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: formData,
                cache: true,
                success: function( data ) {
                    console.log(data);
                    toastr.success("ChatGroup Successfully Created");
//                    $('#groupForm').modal('hide');
                    setTimeout(function(){
                        window.location.href = "{{route('profile_index')}}";
                    },1000)
                },
                error:function( data ) {
                    console.log(data);
                    toastr.error("ChatGroup Couldnot be made");
                }
            });
        })
        $('#searchInstituteName, #searchProfessorName, #searchMajorName , #searchStarwise').change(function(e){
            e.preventDefault();
			$('#LoaderGif').show();
            var value = $(this).val();
            var name =  $(this).find(':selected').data('id');
            console.log("institute==" + value);
            console.log("name==" + name);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            url = "{{ route('tutorSearch') }}";

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: {'name': name, 'value': value},
                cache: true,
                success: function( data ) {
                    console.log(data);
                    $("#searchList").html(data.html);
                    //window.location = '{{route('notesView')}}'
					$('#LoaderGif').hide();
                },
                error:function( data ) {
					$('#LoaderGif').hide();
                    console.log(data);
                }
            });

        });
    });
</script>

@endsection
