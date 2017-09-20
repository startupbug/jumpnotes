@extends('dashboard.masterDashboardLayout')
@section('content')

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                <a href="{{route('dashboard')}}" class="media-left"><img src="{{asset('/public/admin/images/placeholder.jpg')}}" class="img-circle img-sm" alt=""></a>
                                <div class="media-body">
                                    <span class="media-heading text-semibold">ADMIN</span>
                                    <div class="text-size-mini text-muted">
                                        <i class="icon-pin text-size-small"></i> &nbsp;Dashboard
                                    </div>
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a href="#"><i class="icon-cog3"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                                <!-- Main -->
                                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                <li class="active"><a href="{{route('dashboard')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                <li><a href="{{route('dashboardTransaction')}}"><i class="icon-transmission"></i> <span>Transactions</span></a></li>
                                <li><a href="{{route('cash_withdraw_view')}}"><i class="icon-shrink3"></i> <span>Payment Withdraw Request</span></a></li>
                                <li><a href="{{route('dashboard_contact')}}"><i class="icon-envelop"></i> <span>Contact List</span></a></li>
                                <li>
              									    <a href="#"><i class="icon-pencil3"></i> <span>Pages content</span></a>
              									    <ul>
                                        <li><a href="{{route('slider_index')}}"><span>Main Page Slider</span></a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">
    <!-- /main navbar -->
  <!-- Page header -->
  <div class="page-header page-header-default">
      <div class="page-header-content">
          <div class="page-title">
              <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
          </div>

          <div class="heading-elements">
              <!--<div class="heading-btn-group">
                  <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                  <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                  <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
              </div> -->
          </div>
      </div>

      <div class="breadcrumb-line">
          <ul class="breadcrumb">
              <li><a href="{{route('dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
              <li class="active">Dashboard</li>
          </ul>

          <ul class="breadcrumb-elements">
              <!-- <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-gear position-left"></i>
                      Settings
                      <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                      <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                      <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                  </ul>
              </li> -->
          </ul>
      </div>
  </div>
  <!-- /page header -->

  <!-- Content area -->
  <div class="content">
    <div class="row">
    						<div class="col-lg-12">

    							<!-- Traffic sources -->
    							<div class="panel panel-flat">
    								<div class="panel-heading">
    									<h6 class="panel-title">Traffic sources</h6>
    									<div class="heading-elements">
    										<form class="heading-form" action="#">
    											<div class="form-group">
    												<!-- <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
    													<input type="checkbox" class="switch" checked="checked">
    													Live update:
    												</label> -->
    											</div>
    										</form>
    									</div>
    								</div>

    								<div class="container-fluid">
    									<div class="row">
    										<div class="col-lg-3">
    											<ul class="list-inline text-center">
    												<li>
    													<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-user-plus"></i></a>
    												</li>
    												<li class="text-left">
    													<div class="text-semibold">New Users</div>
    													<div class="text-muted">{{ $newUserCount }}</div>
    												</li>
    											</ul>

    											<div class="col-lg-10 col-lg-offset-1">
    												<div class="content-group" id="new-visitors"></div>
    											</div>
    										</div>

    										<div class="col-lg-3">
    											<ul class="list-inline text-center">
    												<li>
    													<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-hat"></i></a>
    												</li>
    												<li class="text-left">
    													<div class="text-semibold">Subscribed Students</div>
    													<div class="text-muted">{{$subsCount}}</div>
    												</li>
    											</ul>

    											<div class="col-lg-10 col-lg-offset-1">
    												<div class="content-group" id="new-sessions"></div>
    											</div>
    										</div>

    										<div class="col-lg-3">
    											<ul class="list-inline text-center">
    												<li>
    													<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-user-tie"></i></a>
    												</li>
    												<li class="text-left">
    													<div class="text-semibold">Tutors</div>
    													<div class="text-muted"><span class="status-mark border-success position-left"></span>{{$totalTutors}}</div>
    												</li>
    											</ul>

    											<div class="col-lg-10 col-lg-offset-1">
    												<div class="content-group" id="total-online"></div>
    											</div>
    										</div>
    										<div class="col-lg-3">
    											<ul class="list-inline text-center">
    												<li>
    													<a href="#" class="btn border-danger-400 text-danger-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-users4"></i></a>
    												</li>
    												<li class="text-left">
    													<div class="text-semibold">Total Users</div>
    													<div class="text-muted"><span class="status-mark border-danger position-left"></span>{{ $allUserCount }}</div>
    												</li>
    											</ul>

    											<div class="col-lg-10 col-lg-offset-1">
    												<div class="content-group" id="total-online"></div>
    											</div>
    										</div>
    									</div>
    								</div>

    								<div class="position-relative" id="traffic-sources"></div>
    							</div>
    							<!-- /traffic sources -->

    						</div>
    					</div>
    					<!-- /main charts -->
      <!-- Main charts -->
      <div class="row">
          <div class="col-lg-12">

              <!-- Traffic sources -->
              <div class="panel panel-flat">
                  <div class="panel-heading">
                      <h6 class="panel-title">Tutors' List</h6>
                      <div class="heading-elements">
                          <form class="heading-form" action="#">
                              <!-- <div class="form-group">
                                  <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                      <input type="checkbox" class="switch" checked="checked">
                                      Live update:
                                  </label>
                              </div> -->
                          </form>
                      </div>
                  </div>
				<div class="table-responsive">
                  <table id="tutor_list">
                      <thead>
                      <tr>
                          <th>ID</th>
                          <th>Tutor Identity</th>
                          <th>Qualification</th>
                          <th>Subject</th>
                          <th>Skills</th>
                          <th>Per Hour Charges</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                  </table>
				</div>
                  <div class="position-relative" id="traffic-sources"></div>
              </div>
              <!-- /traffic sources -->

          </div>
      </div>
      <div class="modal fade" id="viewTutor" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
           <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">More About Tutor</h4>

					</div>
					<div class="modal-body">
						<div class="text-center" style="align-content: center">
							<img src="" name="aboutme" width="140" height="140" border="0" class="img-circle tutor_pic"></a>

							<a class="tutor_id" href="#"><h3 class="media-heading tutor_name"></h3></a>
                  <!-- <span><strong>Email Address: </strong></span> -->
                  <span class="label label-primary tutor_email"></span>
                  <br><br>
									<span><strong>Subject: </strong></span>
									<span class="label label-warning tutor_subject"></span>
									<span><strong>Skills: </strong></span>
									<span class="label label-success tutor_skills"></span>
						</div>
							<hr>
							<div class="text-center" style="align-content: center">
							<p class="text-left"><strong>About Tutor: </strong><br>
							<span class="tutor_about"></span>
							</p>
							<br>
							</div>
					</div>
						<div class="modal-footer">
							<div class="text-center" style="align-content: center">
							<span class="transcript">
									<a href="#" download="" class="btn btn-outline-success download_link" style="padding: 3% 15%">Download Transcript <i class="glyphicon glyphicon-download-alt stroked"></i></a>
							</span>
							</div>
							<div class="text-center" style="align-content: center">
							<a class="btn btn-info tutor_approval">Approve</a>
							<a class="btn btn-danger delete_tutor">Delete</a>
							</div>
						</div>
				</div>
			</div>
		</div>
      <!-- /main charts -->


      <!-- Dashboard content -->

      <!-- /dashboard content -->


      <!-- Footer -->
  <!-- /content area -->
      <script>
          $(document).ready(function() {
              var url = '{{route('tutor_list')}}';
              oTable = $('#tutor_list').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "order": [ [0, 'desc'] ],
                  "ajax": url,
                  "columns": [{data: 'tutor_id', name: 'tutor_id'},
                      {data: 'tutor_unique', name: 'tutor_unique'},
                      {data: 'tutor_qualification', name: 'tutor_qualificaion'},
                      {data: 'tutor_majors', name: 'tutor_majors'},
                      {data: 'tutor_skills', name: 'tutor_skills'},
                      {data: 'per_hour_charges', name: 'per_hour_charges'},
                      {data: 'status', name: 'status'},
                      {data: 'action', name: 'action'}
                  ]
              });
	var g_tutor_id = "";
	$('body').on('click','.tutorRecord',function(){
		var url = $(this).attr('url');
		var id = $(this).attr('tutor_id');
		g_tutor_id = id;
		 $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

		     $.ajax({
                url: url,
                type: 'post',
				data: {'id':id},
                cache: true,
                success: function( data ) {
					console.log(data.tutorRecord);
					$('#viewTutor').find('.tutor_pic').attr('src',"{{asset('/public/profile_pics/')}}"+'/'+ data.tutorRecord.profile_pic);
					$('#viewTutor').find('.tutor_name').text(data.tutorRecord.tutor_unique);
					$('#viewTutor').find('.tutor_skills').text(data.tutorRecord.tutor_skills);
					$('#viewTutor').find('.tutor_subject').text(data.tutorRecord.tutor_majors);
					$('#viewTutor').find('.tutor_email').text(data.tutorRecord.email);
					$('#viewTutor').find('.tutor_about').text(data.tutorRecord.tutor_about);

					if(data.tutorRecord.admin_approval == 1){
						$('.tutor_approval').hide();
					}
					else{
						$('.tutor_approval').show();
					}
					if(data.tutorRecord.tutor_transcript != ""){
						var down = "{{asset('/')}}"+"transcript_download/"+data.tutorRecord.tutor_transcript;
						var href = "{{asset('public/tutor_transcripts/')}}"+"/"+data.tutorRecord.tutor_transcript;
						$html = '<a href="'+href+'" download="'+down+'" class="btn btn-outline-success download_link" style="padding: 3% 15%">Download Transcript <i class="glyphicon glyphicon-download-alt stroked"></i></a>';
						$('#viewTutor').find('.transcript').html($html);
					}
					else{
						$('#viewTutor').find('.transcript').html("No transcript available");
					}
                },
                error:function( data ) {
					console.log(data.tutor)
                }
            });
	});
	$('.tutor_approval').on('click',function(e){
		e.preventDefault();
		var url = "tutor_approval/"+g_tutor_id;
            $.get(url,function(data){
                toastr.success('Tutor Approved');
                location.reload();
            })
	});
	$('.delete_tutor').on('click',function(e){
		e.preventDefault();
		var url = "deleteTutor/"+g_tutor_id;
            $.get(url,function(data){
                toastr.success('Tutor Approved');
                location.reload();
            })
	});



          });
      </script>
@endsection
