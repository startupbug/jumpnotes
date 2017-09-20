@extends('masterlayout')
@section('content')

		<!-- / ABOUT BANNER  -->

<div class="container-fluid text-center banner-text abt-banner">
  <h3>ABOUT US</h3>
</div>

	<!-- / ABOUT TEXT BLOCK -->

<div class="meet-with abt-section">
<div class="container">

   <div class="about-text col-md-6">

   <h1>{{$maincontent->sec1_heading}}</h1>
   <p>{{$maincontent->sec1_content}}</p>

   <!-- <h4>Happy Studying!
     voluptas sit aspernatur !!!</h4> -->
   </div>
   <div class="about-img col-md-6">
   <img src="{{ asset('public/images/') }}/{{$maincontent->sec1_file}}" alt=""/>
   <!-- <a href="#sec1Modal" data-toggle="modal" data-target="#sec1Modal"><span class="fa fa-pencil-square-o"></span></a> -->
   </div>
 </div>
 </div>

<div class="team-block text-center">
<div class="container">
    <div class="heading">
        <h2>{{$maincontent->sec2_heading}}</h2>
        <h3>{{$maincontent->sec2_subheading}}</h3>
    </div><!-- //end heading -->

	<div class="row">
    @foreach($team as $singlemember)
        <div class="col-sm-4">
            <div class="team-members">
                <div class="team-avatar">
                    <img class="img-responsive" src="{{asset('public/images/')}}/{{$singlemember->file}}" alt="">
                </div>
                <div class="team-desc">
                    <h4>{{$singlemember->name}}</h4>
                    <div class="job">({{$singlemember->designation}})</div>
					<p>{{$singlemember->about}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div><!-- //end row -->
</div>
</div>

<!-- //TEAM BLOCK END -->



<div class="container client-testimonial">
	<div class="row">
		<h2>{{$maincontent->sec3_heading}}</h2>
		<h3>{{$maincontent->sec3_subheading}}</h3>

	</div>
</div>
<div class="carousel-reviews broun-block caro-1">
    <div class="container">
        <div class="row">
            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">
                  <div class="item active">
                	    <div class="col-md-4 col-sm-6">
        				    <div class="block-text rel zmin">
						        <p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
							    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
					        </div>
							<div class="person-text rel">
				                <img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
							<p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
            			<div class="col-md-4 col-sm-6 hidden-xs">
						    <div class="block-text rel zmin">
        						<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
					            <ins class="ab zmin sprite sprite-i-triangle block"></ins>
				            </div>
							<div class="person-text rel">
				               <img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
						     <p title="" href="#">Jhone, adisicing elit</p>		
							</div>
						</div>
						<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
							<div class="block-text rel zmin">			
    							<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
								<ins class="ab zmin sprite sprite-i-triangle block"></ins>
							</div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
								<p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
                    </div>
				<div class="item">
                        <div class="col-md-4 col-sm-6">
        				    <div class="block-text rel zmin">
						        	<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
							    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
					        </div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
							<p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
            			<div class="col-md-4 col-sm-6 hidden-xs">
						    <div class="block-text rel zmin">			
        							<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
					            <ins class="ab zmin sprite sprite-i-triangle block"></ins>
				            </div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
						      <p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
						<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
							<div class="block-text rel zmin">
    								<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
								<ins class="ab zmin sprite sprite-i-triangle block"></ins>
							</div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
								<p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
                    </div>
                    <div class="item">
                        <div class="col-md-4 col-sm-6">
        				    <div class="block-text rel zmin">
						        <p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
							    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
					        </div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
								<p title="" href="#">Jhone, adisicing elit</p>			
							</div>
						</div>
            			<div class="col-md-4 col-sm-6 hidden-xs">
						    <div class="block-text rel zmin">
        						<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
					            <ins class="ab zmin sprite sprite-i-triangle block"></ins>
				            </div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
						       <p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
						<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
							<div class="block-text rel zmin">
    							<p>voluptatem accusantium doloremque elit laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasiums architecto beatae vitae dicta sunt explictos abo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia.</p>
								<ins class="ab zmin sprite sprite-i-triangle block"></ins>
							</div>
							<div class="person-text rel">
								<img src="{{asset('public/images')}}/tet-img.jpg" alt=""/>
								<p title="" href="#">Jhone, adisicing elit</p>	
							</div>
						</div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="sec1Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3>Edit Section 1</h3>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                              <div class="col-md-10 col-md-offset-1 thumbnail">
                                  <form id="groupForm" method="post" enctype="multipart/form-data" action="route('edit_sec1')" role="form">
                                    <div class="form-group">
                                    <img class="img-responsove" src="{{asset('/public/images/')}}/{{$maincontent->sec1_file}}" width="100%"/>
                                    <input type="file" name="sec1_file"/>
                                    </div>
                                      <div class="form-group">
                                          <label>Main Heading</label>
                                          <br>
                                          <input type="text" class="input-lg" name="sec1_heading" class="form-control" value="{{$maincontent->sec1_heading}}"/>
                                      </div>
                                      <div class="form-group">
                                        <label>Content</label>
                                        <br>
                                        <textarea name="sec1_content" class="input-lg" rows="4" style="width:100%">{{$maincontent->sec1_content}}</textarea>
                                      </div>
                                      <div class="form-group col-md-12">
                                          <input type="submit" class="btn btn-success pull-right" value="Submit"/>
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

				<!-- client testimonials end  BLOCK -->

@endsection
