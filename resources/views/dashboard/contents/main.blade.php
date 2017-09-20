@extends('dashboard.masterDashboardLayout')
@section('content')

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
                  <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                  <li><a href="{{route('dashboard')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                  <li><a href="{{route('dashboardTransaction')}}"><i class="icon-transmission"></i> <span>Transactions</span></a></li>
                  <li><a href="{{route('dashboard_contact')}}"><i class="icon-transmission"></i> <span>Contact List</span></a></li>
                  <li>
									    <a href="#"><i class="icon-pencil3"></i> <span>Pages content</span></a>
									    <ul>
                          <li class="active"><a href="{{route('slider_index')}}"><span>Main Page Slider</span></a></li>
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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pages Content</span> - Slider</h4>
          </div>
          <div class="heading-elements">
          </div>
        </div>
        <div class="breadcrumb-line">
          <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="icon-home2 position-left"></i> Content</a></li>
            <li class="active">Main page slider</li>
          </ul>
          <ul class="breadcrumb-elements">
          </ul>
        </div>
      </div>
        <!-- /page header -->

        <!-- Content area -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            @if(isset($sliders))
              <?php $i=1; ?>
              @foreach($sliders as $slider)
                 <h3>Slider # {{$i}}</h3>
                 <form class="staticForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                           <img class="img-responsive" src="{{ asset('public/dynamic_assets/'.$slider->image)}}" width="220" height="350">
                        </div>
                        <div class="col-md-6">
                          <span style="color:red" class="sliderImageText"></span>
                          <!-- <input type="text" class="form-control" value="{{ $slider->text}}" name="sliderImageText" id="sliderImageText"/> -->
                          <textarea class="form-control"  rows=4 name="sliderImageText">{{$slider->text}}</textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <span style="color:red" class="sliderImage"></span>
                          <input type="file" name="sliderImage" id="sliderImage" />
                        </div>
                        <div class="col-md-6">
                          <input type="hidden" value="{{ $slider->id }}" name="sliderImageId" />
                          <input type="submit" class="btn btn-primary btn-xs pull-right" value="Update"/>
                        </div>
                      </div>
                      <hr>
                  </form>
                  <br>
                  <?php  $i++; ?>
                @endforeach
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

$(".staticForm").on('submit', function(e){
    e.preventDefault();
     $("#LoaderGif").show();
    console.log("Slider Form");
    var base_url = "{{route('slider_post')}}";//$(this).attr('action');;
    var formData = new FormData(this);
    console.log(formData);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
          url: base_url,// $("#register_form :input[name!=password2]").serializeArray()
          type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
          data: formData, //$("#staticForm").serialize(),
          success: function (data) {
          $("#LoaderGif").hide();
           window.location.reload();
           console.log(data);
           toastr.success('Image Successfully Updated');
           window.location.reload();
          },
          error: function (data) {
           $("#LoaderGif").hide();
           toastr.error('Image Couldnot be Updated due to Errors');
           window.location.reload();
          },
          processData: false,
          contentType: false
      })
});

</script>
@endsection
