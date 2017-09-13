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
                        <i class="icon-pin text-size-small"></i> &nbsp;Aboutus
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
                          <li class="active"><a href="{{route('slider_index')}}"><span>Aboutus Page</span></a></li>
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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pages Content</span> - Aboutus</h4>
          </div>
          <div class="heading-elements">
          </div>
        </div>
        <div class="breadcrumb-line">
          <ul class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="icon-home2 position-left"></i> Content</a></li>
            <li class="active">Aboutus page</li>
          </ul>
          <ul class="breadcrumb-elements">
          </ul>
        </div>
      </div>
        <!-- /page header -->

        <!-- Content area -->
        <form class="staticForm" method="post" enctype="multipart/form-data" action="{{route('aboutcontent_post')}}">
            <div class="content">
                  <h3>Section # 1</h3>
                     <div class="row">
                         <div class="col-md-6">
                            <img class="img-responsive" src="{{ asset('public/dynamic_assets/'.$maincontent->sec1_file)}}" width="220" height="350">
                            <input type="file" name="sec1_file"/>
                         </div>
                         <div class="col-md-6">
                           <div class="col-md-12">
                             <label>Section1 Main Heading</label>
                             <input name="sec1_heading" class="input-lg" value="{{$maincontent->sec1_heading}}"/>
                           </div>
                           <div class="col-md-12">
                           <span style="color:red" class="sliderImageText"></span>
                           <label>Content</label>
                           <!-- <input type="text" class="form-control" value="{{ $slider->text}}" name="sliderImageText" id="sliderImageText"/> -->
                           <textarea class="form-control"  rows=4 name="sliderImageText">{{$maincontent->sec1_content}}</textarea>
                         </div>
                         </div>
                      </div>
                       <hr>
                       <h3>Section # 2 (Team Memebers)</h3>
                       <div class="row">
                         <div class="col-md-6 col-md-offset-4">
                           <label>Main Heading</label>
                           <input name="sec2_heading" value="{{$maincontent->sec2_heading}}"/>
                           <br>
                           <label>Sub Heading</label>
                           <input name="sec2_subheading" value="{{$maincontent->sec2_subheading}}"/>
                         </div>
                         <div class="row">
                           <?php $i=1;?>
                         @foreach($team as $memeber)
                         <div class="col-md-4">
                           <img src="{{asset('/public/images/')}}/{{$member->file}}" class="img-responsive" with="100%"/>
                           <input type="file" name="sec2_file{{$i}}" value=""/>
                           <input type="text" name="name"/>
                           <br>
                           <textarea></textarea>
                         </div>
                         <?php $i++;?>
                         @endforeach
                       </div>
                       </div>
                    @foreach($maincontent as $content)
                       <h3>Section # 1</h3>
                       <form class="staticForm" method="post" enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-md-6">
                                 <img class="img-responsive" src="{{ asset('public/dynamic_assets/'.$maincontent->sec1_file)}}" width="220" height="350">
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
                      @endforeach
                    @endif
                </div>
              </div>
            </div>
          </form>
    </div>
  </div>
</div>
<script type="text/javascript">

</script>
@endsection
