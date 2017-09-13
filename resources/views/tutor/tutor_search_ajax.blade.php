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
                    <a href="{{route('notes_index',['author_id'=>$tutor->users_id])}}" class="btn btn-primary edits">VIEW NOTES</a>
                    <a href="#" class="btn btn-primary edits sendMsg" id="{{$tutor->users_id}}">SEND MESSAGE</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 bg"  id="hover-video_{{$tutor->tutor_id}}" style="">
            <?php $video_link = $tutor->intro_video_link; ?>

            {{--<p><video width="100%" height="auto" control autoplay loop>--}}
            {{--<source src="http://110.37.221.34:7777/joana_phase2/themes/joanamartins/assets/images/intro-video.mp4" type="video/mp4">--}}
            <iframe  src="{{$tutor->intro_video_link}}" frameborder="0" allowfullscreen></iframe>
            {{--<iframe src="https://www.youtube.com/embed/e3Nl_TCQXuw" frameborder="0" allowfullscreen></iframe>--}}
            {{--<source src="{{$tutor->intro_video_link}}" type="video/mp4">--}}
            {{--</video>--}}
            {{--</p>--}}
            <h4>title</h4>
        </div>
    @endif
@endforeach