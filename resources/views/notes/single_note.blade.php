@extends('masterlayout')
@section('content')

@if(Session::has('payment_success'))
    <script>
    toastr.success( '{{Session::get("payment_success")}}');
    </script>
    {{ Session::forget('payment_success') }}
@endif

    <?php $user = Auth::user()?>
    {{--{{dd($authorDetail)}}--}}
{{--{{$noteDetail->created_at}}--}}
<div class="container-fluid text-center banner-text" style="margin-bottom: 2%">
    <h3>NOTE DETAIL</h3>
</div>

{{--static html--}}
<div class="notes-blog" style="margin-top: 5%">
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8 blog-main">
                <!-- Blog Post -->
                <div class="row">
                    <div class="col-lg-2">
                        <div class="notes-date"><p class="day">{{ $noteDetail->created_at->format('d')}}</p><p class="date">{{ $noteDetail->created_at->format('M, Y') }}</div>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-7 notes-title">
                                <!-- Title -->
                                <h1>{{$noteDetail->note_title}}</h1>
                                <p class="p-author">Posted by
                                  @if($tutorFlag)
                                  <a href="{{ route('profile_view', ['id' => $authorDetail->users_id ]) }}">
                                    {{$authorDetail->tutor_unique}}
                                  </a>
                                  @else
                                  <b>{{$authorDetail->username}}</b>
                                  @endif
                                </p>
                            </div>

                            <div class="col-lg-5">
                                    <div class=" pull-right col-md-12 text-right downloads">
                                        <p>
                                            <!--<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star-empty"></span> -->
                            @if(Auth::check() && $authorDetail->users_id != $user->id)
                              <input type="text" id="rate_note" name="rate_note" class="rating rating-loading"
                                 value="{{ round($noteDetail->note_rating) }}" data-size="xs" title="" />
                              <input type="hidden" value="{{ $noteDetail->user_id }}" id="note_user_id" name="note_user_id"/>
                              <input type="hidden" value="{{ $noteDetail->notes_id }}" id="notes_id" name="notes_id"/>
                             @endif
                            {{$noteDetail->view_count}} Views</p>
                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-12 mg-top">
               <hr>
			   </div>
                <!-- Date/Time -->

                <!-- Post Content -->
<div class="single-note-content">
<div class="col-lg-12">
                <p>{{$noteDetail->note_detail}}.</p>
				</div>
</div>
                {{--Note slider--}}
                <div class="row slides">
                    <div class="col-lg-12">



                    @if($noteDetail->file_type !=0)
                        <?php $files = explode(',',$noteDetail->note_file)?>
                        <div id="jssor_1"  class="jssor_slider">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="loading_jssor"></div>
                            <div data-u="slides"  class="jssor-slides">
                                @foreach($files as $file)
                                <div>
                                    <img data-u="image" src="{{asset('/public/notes')}}/{{$file}}" />
                                    <img data-u="thumb" src="{{asset('/public/notes')}}/{{$file}}" />
                                </div>
                                @endforeach

                            </div>

                            <!-- Thumbnail Navigator -->
                            <div data-u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:0px;width:600px;height:60px;" data-autocenter="1">
                                <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:#000;filter:alpha(opacity=30.0);opacity:0.3;"></div>
                                <!-- Thumbnail Item Skin Begin -->
                                <div data-u="slides" style="cursor: default;">
                                    <div data-u="prototype" class="p">
                                        <div class="w">
                                            <div data-u="thumbnailtemplate" class="t"></div>
                                        </div>
                                        <div class="c"></div>
                                    </div>
                                </div>
                                <!-- Thumbnail Item Skin End -->
                            </div>
                            <!-- Arrow Navigator -->
                            <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
                            <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
                        </div>
            @elseif($noteDetail->file_type == 0)
            {{--end slider--}}
						@if(substr($noteDetail->note_file,-3)=='pdf')
                        {{--PDF SECTION--}}
                        <div id="pdf-view">
                            <!-- <h2 align="center"><a href="{{asset('/public/notes/')}}/{{$noteDetail->note_file}}" target="_blank">View Note in New Tab</a></h2> -->
                            <div class="overlay"></div>
                            <div id="DIVinPage">
                            </div>

                        </div>
                        {{--PDF SECTION END--}}
						@else
<div class="overlay"></div>
			<iframe src="http://docs.google.com/gview?url={{asset('/public/notes/')}}/{{$noteDetail->note_file}}&embedded=true" width="100%" height="600px"></iframe>
    @endif
    @endif
                    </div>
                </div>

{{--Note Slider End--}}
                <hr>

                <div class="col-lg-12 comments no-pad-left no-pad-right">
          <div class="user-comments">
            <h4>No comments for this note.</h4>
          </div>
					<div class="col-lg-12 no-pad-left no-pad-right comments-section add-new-comment">
						<h2>Add New Comment</h2>
						<form id="commentForm" action="{{route('notecommentpost')}}" method="post">
              <input type="hidden" name="note_id" value = "{{$noteDetail->notes_id}}"/>
							<textarea placeholder="Add New Comment" name="comment"></textarea>
              {{csrf_field()}}
							<div class="res-send comment-add send-button fleft no-pad-left no-pad-right">
                  <input type="submit" class="btn btn-primary edits unfollow send-button-msg" value="SEND"/>
              </div>
						</form>
					</div>
				</div>
                <!-- Blog Comments -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-lg-4 col-md-12 rec-posts">

                <h4>Recent Notes</h4>
                <div class="hline"></div>
                <ul class="popular-posts list-unstyled">
                    @foreach($recent_notes as $recentnote)
                    <li class="row">
                        <div class="col-lg-3 col-md-1 col-sm-2 col-xs-3">
                            <a class="thumbnail" href="{{ route('single_note', ['id' => $recentnote->notes_id]) }}"><img src="{{asset('/public/images/note-imgs.png')}}" alt="Popular Post"></a>
                        </div>
                        <div class="col-lg-9 col-md-11 col-sm-10 col-xs-9 r-text">
                            <p><a href="{{ route('single_note', ['id' => $recentnote->notes_id]) }}">{{$recentnote->note_title}}</a>
                            </p>
                            <em class="small">Posted <span><?php echo date("F jS, Y", strtotime($recentnote->created_at)); ?></span></em>
                        </div>
                    </li>
                    @endforeach

                </ul>

                <hr>
<div class="row about-author new-about">
                    <div class="col-lg-12">
                        <h4><span>About</span> the Author</h4>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if($tutorFlag)@if(!empty($authorDetail->profile_pic))
                            <a href="{{ route('profile_view', ['id' => $authorDetail->users_id ]) }}"><img class="img-responsive" src="{{asset('/public/profile_pics/')}}/{{$authorDetail->profile_pic}}" style="float:left; width:33%; margin-right:15px;"></a>
                                           @else
                            <img class="img-responsive" src="{{asset('/public/images/profile-icon.png')}}" style="float:left; width:33%; margin-right:15px;">
                        @endif
                        @else
                            <img class="img-responsive" src="{{asset('/public/images/profile-icon.png')}}" style="float:left; width:33%; margin-right:15px;">
                        @endif
						@if($tutorFlag)
                        @if($authorDetail->users_id != Auth::user()->id)
                        <a href="{{ route('profile_view', ['id' => $authorDetail->users_id ]) }}">
                            <h3>{{$authorDetail->tutor_unique}}</h3></a>
                            @else
                            <a href="{{ route('profile_index') }}">
                                <h3>{{$authorDetail->tutor_unique}}</h3></a>
                            @endif
                            <p>{{$authorDetail->tutor_about}}</p>
                              @if($authorDetail->users_id != Auth::user()->id)
                            <a tutor_id="{{$authorDetail->users_id }}" href="#groupModal" data-toggle="modal" data-target="#groupModal" class="btn btn-primary pull-left create_contact">Contact With Tutor</a>
                            @endif
                            
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
                                                            <label>Set Chat Name/Identity</label>
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
							@else <h3>{{$authorDetail->username}}</h3>
                            @endif
                    </div>

                </div>
				<div class="row download-note about-author new-download ">
                    <div class="col-lg-12">
                        <h4><span>Download</span> this Note</h4>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-lg-3">
                        <i style="color: #1F7F9F" class="fa fa-file-text-o fa-5x thumbnail"></i>
                    </div>
                    <div class="col-lg-9">
                        <h3>{{$noteDetail->note_title}}</h3>
@if($authorDetail->users_id != Auth::user()->id)
                        @if(($subscription_check) || (!$tutorFlag))
                        <!-- @if($subscription_check)
                        <a user-id="@if(isset($sub_id)) {{$sub_id}} @else 0 @endif " class="btn btn-danger cancel_subs">Cancel Subscription</a>
                        @endif -->
                        @if($noteDetail->file_type == 0)
                        <samll><a href="{{ asset('/public/notes/'. $noteDetail->note_file) }}" download="{{route('download_file',$noteDetail->note_file)}}">Download <i class="fa fa-download"></i></a></samll>
                            @else
                            <?php $imgs = explode(',',$noteDetail->note_file)?>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Download
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu signle-note-dd">
                                        <?php $count = 1?>
                            @foreach($imgs as $img)
                                    <li><a href="{{ asset('/public/notes/'. $img) }}" download="{{route('download_file',$img)}}">{{$count}}@if($count==1)st @elseif($count==2)nd @elseif($count == 3)rd @else th @endif Image<i class="fa fa-download"></i></a></li>
                                            <?php $count++?>
                                    {{--<samll><a href="{{ asset('/public/notes/'. $img) }}" download="{{route('download_file',$img)}}">Download <i class="fa fa-download"></i></a></samll>--}}
                            @endforeach
                                    </ul>
                                </div>
                                <button class="btn btn-primary d_all" id="d_all" file="{{$noteDetail->note_file}}" type="button">Download all</button>
                                <a id="ddd" href="{{ asset('/public/zip/note.zip') }}" download="{{route('download_file','note.zip')}}"></a>
                            {{--<samll><a href="#" url="{{asset('download/')}}" src="{{$noteDetail->note_file}}" class="download_imgs">Download <i class="fa fa-download"></i></a></samll>--}}
                            {{--<samll><a href="{{ asset('/public/notes/'. $noteDetail->note_file) }}" download="{{route('download_file',$noteDetail->note_file)}}">Download <i class="fa fa-download"></i></a></samll>--}}
                        @endif
                            @else
                            <samll><a href="#download_payment" data-toggle="modal" data-target="#download_payment" >Download <i class="fa fa-download"></i></a></samll>
                        @endif
                        @else
                        <samll><a href="{{ asset('/public/notes/'. $noteDetail->note_file) }}" download="{{route('download_file',$noteDetail->note_file)}}">Download <i class="fa fa-download"></i></a></samll>
                        @endif
                    </div>
                </div>
                 {{--<form method="post" action="{{route('brainTest')}}">--}}
                    {{--<input name="" />--}}

                    {{--<a tutor_id="{{$authorDetail->users_id }}" href="#myModaltransaction" data-toggle="modal" data-target="#myModaltransaction" class="btn btn-primary pull-right create_contact">Pay through paypal</a>--}}
                {{--</form>--}}
                <?php $clientToken = Braintree_ClientToken::generate();?>
                    <script type="text/javascript">
                        braintree.setup("{{$clientToken}}", "custom", {
                            paypal: {
                                container: "paypal-container",
                                singleUse: true, // Required
                                amount: 1.99, // Required
                                currency: 'USD', // Required
                                locale: 'en_US',
                                enableShippingAddress: true,
                                shippingAddressOverride: {
                                    recipientName: 'Scruff McGruff',
                                    streetAddress: '1234 Main St.',
                                    extendedAddress: 'Unit 1',
                                    locality: 'Chicago',
                                    countryCodeAlpha2: 'US',
                                    postalCode: '60652',
                                    region: 'IL',
                                    phone: '123.456.7890',
                                    editable: false
                                }
                            },
                            onPaymentMethodReceived: function (obj) {
                                doSomethingWithTheNonce(obj.nonce);
                                alert('payed successfully');
                            }
                        });
                </script>




                <div id="myModaltransaction" class="modal fade" role="dialog">
				<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Make a Transaction through Brain Tree</h4>
								</div>
								<div class="modal-body">
									<form id="transaction" method="post" role="form" action="{{route('noteUplaod')}}">
										<div class="row">
											<div class="form-group col-md-6">
												<input type="text" class="form-control" id="fname" placeholder="FIRST NAME">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" id="card-no" placeholder="CARD NUMBER">
											</div>
											<div class="form-group col-md-6">
												<span style="color:red" class="note_title"></span>
												<input type="text" class="form-control" id="lname" placeholder="LAST NAME">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" id="ex-date" placeholder="EXPIRY DATE  example : 7/17">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" id="phone" placeholder="PHONE NUMBER">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" id="username" placeholder="USERNAME">
											</div>
											<div class="form-group col-md-12">
											   <input type="text" class="form-control" id="email" placeholder="EMAIL">
											</div>
                                            <div class="form-group notes-detail col-md-12 text-center">
												<input type="submit" class="btn btn-primary " value="submit"/>
											</div>
                                            <div class="form-group col-md-12 text-center">
											   <hr/>OR<div id="paypal-container"></div>
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



                <div class="modal fade" id="download_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3>Student Subscription</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-1">
                                        <form id="std_subscription" method="post" action="{{route('download_payment')}}" role="form">
                                      <!-- <form id="std_subscription" method="post" action="{{route('brainTest')}}" role="form"> -->
                                            <div class="form-group">
                                                <h4>Good Luck, You will be able to access and download all Notes of the Tutor <b>"{{$authorDetail->tutor_unique}}"</b> for Just $1.99/Month !!</h4>
                                                <input type="hidden" name="author_id" class="tutor_id" value="{{$authorDetail->users_id}}"/>
                                                <input type="hidden" name="note_id" class="std_id" value="{{$noteDetail->notes_id}}"/>
                                                <input type="hidden" value="{{ Session::token() }}" name="_token" />
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="FIRST NAME">
                                                        </div>
                                                        <input type="hidden" name="plan_id" value="mybw"/>
                                                        <input type="hidden" name="amount" value="1.99"/>
                                                        <input type="hidden" name="subscription" value="1"/>
                                                        <input type="hidden" name="pay_from" value="std_subscription"/>
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" id="card-no" name="card-no" placeholder="CARD NUMBER">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <span style="color:red" class="note_title"></span>
                                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" id="ex-date" name="ex-date" placeholder="EXPIRY DATE  example : 7/17">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="PHONE NUMBER">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVC/CVV">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="EMAIL">
                                                        </div>
                                                        <div class="form-group notes-detail col-md-12 text-center">
                                                            {{--<input type="submit" class="btn btn-primary " value="submit"/>--}}
                                                        </div>
                                                        {{csrf_field()}}

                                                        {{--<div class="form-group col-md-12 text-center">--}}
                                                            {{--<hr/>OR<div id="paypal-container"></div>--}}
                                                        {{--</div>--}}











                                                    </div>
                                                <!-- <h6> <b>Please note</b> : The subscription will only be applied to the author you are subscribing to. After one month your subscription will be automatically cancelled.</h6> -->
                                                {{--</form>--}}
                                                <div class="col-md-8 col-md-offset-1">
                                                <input type="submit" class="btn btn-warning pull-right form-group" style="padding: 6% 15%" name="subscribe" value="Subscribe"/>
                                                </div>
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
                <div class="trials-btn text-center">
                    <style>
                        .btn-info{
                            background-color: transparent;
                            color: #2E6DA4;
                        }
                    </style>
                    @if(($tutorFlag && Auth::check() && $authorDetail->users_id != $user->id &&  $authorDetail->is_paid == 1) || ($ontrail!=0 && $authorDetail->users_id != $user->id))
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" class="lessonBook btn btn-info btn-lg trails text-center">Book Now</a>
                        @endif

                </div>

<!-- skype button -->
                <!-- <div class="row">
                    <div class="skype-button bubble" data-bot-id="YOUR_BOT_ID"></div>
                </div> -->
            </div>

        </div>
        <!-- /.row -->




    </div>
</div>


@if($tutorFlag && Auth::check() && $authorDetail->users_id != $user->id )
    {{--<a href="{{route('bookTutor', ['id' => $authorDetail->tutor_id])}}" class="lessonBook" tutorID = "{{$authorDetail->tutor_id}}">Book lesson</a>--}}

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">More About Author</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center" style="align-content: center">
                        <img src="{{asset('/public/profile_pics/')}}/{{$authorDetail->profile_pic}}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>

                        <a href="{{ route('profile_view', ['id' => $authorDetail->users_id ]) }}"><h3 class="media-heading">{{$authorDetail->tutor_unique}}</h3></a>

                        <span><strong>Skills: </strong></span>
                        <?php $skills = preg_split("/[\s,]+/",$authorDetail->tutor_skills);
                        $count = 0;
                        ?>
                        @foreach($skills as $skill)
                            @if($count == 0)
                                <span class="label label-warning">{{$skill}}</span>
                            @elseif($count < 3)
                                <span class="label label-info">{{$skill}}</span>
                            @else
                                <span class="label label-success">{{$skill}}</span>
                            @endif
                            <?php $count++;?>
                        @endforeach
                    </div>
                    <hr>
                    <div class="text-center" style="align-content: center">
                        <p class="text-left"><strong>What I Teach: </strong><br>
                            {{$lesson->lesson_desc}}
                        </p>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center" style="align-content: center">
                        <form id="bookForm" role="form" method="post" action="{{route('bookTutor')}}" >
                            <div class="form-group">
                                <label class="text-info">Your Active Email</label>
                                <input type="email" placeholder="email address" id="contact_email" required name="contact_email" class="form-control input-xs" />
                            </div>
                            <div class="form-group">
                                <label class="text-info">Your Active Skype</label>
                                <input type="text" class="form-control input-xs" id="contact_skype" required name="contact_skype" placeholder="skype id"/>
                            </div>
                            <input type="hidden" value="{{$authorDetail->tutor_id}}" name="tutor_id"/>
                            <input type="hidden" value="{{$noteDetail->notes_id}}" name="note_id"/>
                            <input type="hidden" value="{{$noteDetail->note_title}}" name="note_title"/>
                            <input type="submit" class="btn btn-default bookSlot" value="Book Your Slot">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

    <script src="{{asset('/public/js/star-rating.js')}}" type="text/javascript"></script>

    <!-- <script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script> -->
<script>
    $(document).ready(function(){
      loadcomments(0,{{$noteDetail->notes_id}});
      function loadcomments($id,$note_id){
        var url = '{{asset('')}}'+'/loadcomments/'+$id+'/'+$note_id;
        $.ajax({
            url: url,
            type: 'get',
            cache: true,
            success: function( data ) {
              console.log(data);
              $html = data.html;
              $('.user-comments').html($html);
            },
            error:function( data ) {
                console.log(data);
            }
        });
      }

      $('.cancel_subs').on('click',function(e){
        e.preventDefault();
        var user_id = $(this).attr('user-id');

        var url = '{{asset('')}}'+'dashboard/cacenlsubscription/' + user_id; //
        //alert(url)
        $.ajax({
            url: url,
            type: 'get',
            cache: true,
            success: function( data ) {
              console.log(data);
              location.reload();
            },
            error:function( data ) {
                console.log(data);
            }
        });
      })

      window.oncontextmenu = function () {
         return false;
       }
       document.onkeydown = function (e) {
          if (window.event.keyCode == 123 || e.button==2)
            return false;
          }

        $('#d_all').on('click',function(e){
            e.preventDefault();
            var file = $(this).attr('file');
            var url = "multi_download"+'/'+file;
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.post(url,function(data){
//                $('#ddd').click();
                $("#ddd")[0].click()
//                toastr.success('Note Successfully removed');
//                location.reload();
            })
        });

        $('.download_imgs').on('click',function(e){
            e.preventDefault();
            var src = $(this).attr('src');
            var url = $(this).attr('url');
            var result = src.split(',');
            var http = url+'/'+result[1];
            alert(http);
            location.href = http;
        });



        //Rate Note Form
        $(".rating-stars").mouseup(function(e){
            e.preventDefault();
        setTimeout(function(){
                  console.log("note form submitted" + $("#rate_note").val() );


            var url = "{{ route('note_rating') }}";

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: {'current_rate_note': $("#rate_note").val(), 'note_id': $("#notes_id").val() , 'note_user_id': $("#note_user_id").val()},
                cache: true,
                success: function( data ) {
                    console.log(data);
                    toastr.success("Note Successfully Rated");
                        setTimeout(function(){
                            // location.reload();
                        }, 600);
                },
                error:function( data ) {
                   toastr.error("Note Couldnot be rated");
                }

            });
       }, 800);
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

            $.ajax({
                url: url,// $("#register_form :input[name!=password2]").serializeArray()
                type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
                data: formData,
             //   processData: false,
//                contentType: false,
                cache: true,
                success: function( data ) {
                    console.log(data);
                    $('#myModal').modal('hide');
                    window.location.href = "{{route('requestsView')}}";

                },
                error:function( data ) {
                    window.location.href = "{{route('requestsView')}}";
                    var errors = data.responseJSON;
//                $("#LoaderGif").hide();
                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                    });
                }

            });
            $('#myModal').modal('hide');
            window.location.href = "{{route('requestsView')}}";
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
                    toastr.success("ChatGroup Successfully Made");
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
        $('.create_contact').on('click',function(){
            var id = $(this).attr('tutor_id');
           $('#groupForm').find('.tutor_id').val(id);
        });
    });
</script>
    <script src="{{asset('/public/js/jssor.slider-23.1.6.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
                $AutoPlay: 0,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Cols: 9,
                    $SpacingX: 3,
                    $SpacingY: 3,
                    $Align: 260
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 750);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <script type="text/javascript">jssor_1_slider_init();</script>
    <script type="text/x-javascript">

    $(function() {
    $('#DIVinPage').html('<iframe  id="MyIFRAME" src="{{asset('/public/notes/')}}/{{$noteDetail->note_file}}" width="100%"  height="600" frameborder="0" scrolling="no" style="overflow-x: hidden"></iframe>');
    $('#MyIFRAME').unbind('load');
    $('#MyIFRAME').load(function() {
        });

    });
        </script>
@endsection
