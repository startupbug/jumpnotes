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
                                        <i class="icon-pin text-size-small"></i> &nbsp;Payment Widthdraw Requests
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
                                <li><a href="{{route('dashboardTransaction')}}"><i class="icon-transmission"></i> <span>Transactions</span></a></li>
                                <li  class="active"><a href="{{route('cash_withdraw_view')}}"><i class="icon-shrink3"></i> <span>Payment Withdraw Request</span></a></li>
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
              <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Payment Widthdraw Requests</h4>
          </div>

          <div class="heading-elements">
          </div>
      </div>

      <div class="breadcrumb-line">
          <ul class="breadcrumb">
              <li><a href="{{route('dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
              <li class="active">Contact Page Messages</li>
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
                      <h6 class="panel-title">Contacts' List</h6>
                      <div class="heading-elements">
                          <form class="heading-form" action="#">
                              <!--<div class="form-group">
                                  <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                      <input type="checkbox" class="switch" checked="checked">
                                      Live update:
                                  </label>
                              </div> -->
                          </form>
                      </div>
                  </div>
				<div class="table-responsive">
                  <table id="cashWidthdrawList">
                      <thead>
                      <tr>
                          <th>ID</th>
                          <th>Username</th>
                          <th>Paypal Email</th>
                          <th>Amount</th>
                          <th>Date</th>
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
      <script>
      $(document).ready(function() {
            var url = '{{route('cash_withdraw')}}';
            oTable = $('#cashWidthdrawList').DataTable({
                "processing": true,
                "serverSide": true,
                "bSort" : false,
                "ajax": url,
                "columns": [{data: 'id', name: 'id'},
                    {data: 'username', name: 'name'},
                    {data: 'paypal_email', name: 'paypal_email'},
                    {data: 'earning', name: 'amount'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ]
            });

            $('body').on('click','.payed',function(e){
              e.preventDefault();
              var id =$(this).attr('data-id');
              var url = '{{asset('')}}'+'dashboard/changepaystatus/' + id; //
              //alert(url)
              $.ajax({
                  url: url,
                  type: 'get',
                  cache: true,
                  success: function( data ) {
                    location.reload();
                  },
                  error:function( data ) {
                      console.log(data);
                  }
              });
            })
          });
          </script>
      <!-- /main charts -->
@endsection
