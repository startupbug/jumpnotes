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
                                        <i class="icon-pin text-size-small"></i> &nbsp;Payment Transactions
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
                                <li><a href="{{route('dashboard')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                <li class="active"><a href="{{route('dashboardTransaction')}}"><i class="icon-transmission"></i> <span>Transactions</span></a></li>
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


  {{--<a href="{{ route('profile_index') }}">View Profile</a>--}}
   {{--<a href="{{route('dashboard')}}">Dashboard</a>--}}
   {{--<a href="{{route('payment_index')}}">Payment</a>  --}}
   {{--<a href="{{route('requestsView')}}">Your Requests</a>--}}


   {{--<h1>Dashboard</h1>--}}

  <!-- Page header -->
  <div class="page-header page-header-default">
      <div class="page-header-content">
          <div class="page-title">
              <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Payment Transactions</h4>
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
              <li class="active">Transactions</li>
          </ul>

          <ul class="breadcrumb-elements">
              <!--<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
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
              </li>  -->
          </ul>
      </div>
  </div>
  <!-- /page header -->

  <!-- Content area -->
  <div class="content">

      <!-- Main charts -->
      <div class="row">
          <div class="col-lg-12">

              <!-- Traffic sources -->
              <div class="panel panel-flat">
                  <div class="panel-heading">
                      <h6 class="panel-title">Become Tutor Payments ($3.99/month)</h6>
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
                  <table id="transaction_list">
                      <thead>
                      <tr>
                          <th>Transaction ID</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Date</th>
                      </tr>
                      </thead>
                  </table>
				</div>
                  <div class="position-relative" id="traffic-sources"></div>
              </div>
              <!-- /traffic sources -->

          </div>
      </div>
      <!-- Main charts -->
      <div class="row">
          <div class="col-lg-12">

              <!-- Traffic sources -->
              <div class="panel panel-flat">
                  <div class="panel-heading">
                      <h6 class="panel-title">Student Subscription Payments ($1.99/month)</h6>
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
                  <table id="std_transaction_list">
                      <thead>
                      <tr>
                          <th>Transaction ID</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Date</th>
                      </tr>
                      </thead>
                  </table>
				</div>
                  <div class="position-relative" id="traffic-sources"></div>
              </div>
              <!-- /traffic sources -->

          </div>
      </div>
      <!-- Main charts -->
      <div class="row">
          <div class="col-lg-12">

              <!-- Traffic sources -->
              <div class="panel panel-flat">
                  <div class="panel-heading">
                      <h6 class="panel-title">Book Tutor Payments</h6>
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
                  <table id="book_transaction_list">
                      <thead>
                      <tr>
                          <th>Transaction ID</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Amount</th>
                          <th>Date</th>
                      </tr>
                      </thead>
                  </table>
				</div>
                  <div class="position-relative" id="traffic-sources"></div>
              </div>
              <!-- /traffic sources -->

          </div>
      </div>
      <script>
      $(document).ready(function() {
        // Tutor confirmation
          var url = '{{route('transaction_datatable')}}';
          oTable = $('#transaction_list').DataTable({
              "processing": true,
              "serverSide": true,
              "bSort" : false,
              "ajax": url,
              "columns": [{data: 'id', name: 'id'},
                  {data: 'user_id', name: 'user_id'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'created_at', name: 'created_at'},
              ]
          });
          // student transactions
          var url2 = '{{route('std_transaction_datatable')}}';
          oTable = $('#std_transaction_list').DataTable({
              "processing": true,
              "serverSide": true,
              "bSort" : false,
              "ajax": url2,
              "columns": [{data: 'id', name: 'id'},
                  {data: 'user_id', name: 'user_id'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'created_at', name: 'created_at'},
              ]
          });

          var url3 = '{{route('note_transaction_datatable')}}';
          oTable = $('#book_transaction_list').DataTable({
              "processing": true,
              "serverSide": true,
              "bSort" : false,
              "ajax": url3,
              "columns": [{data: 'id', name: 'id'},
                  {data: 'user_id', name: 'user_id'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'amount', name: 'amount'},
                  {data: 'created_at', name: 'created_at'},
              ]
          });
          });
          </script>
      <!-- /main charts -->
@endsection
