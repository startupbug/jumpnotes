<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ Session::token() }}"/>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{asset('/public/admin/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/public/admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/public/admin/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/public/admin/css/components.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/public/admin/css/colors.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- /global stylesheets -->
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
        <!-- Core JS files -->
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/loaders/pace.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/core/libraries/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/core/libraries/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/loaders/blockui.min.js')}}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/visualization/d3/d3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/forms/styling/switchery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/ui/moment/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/public/admin/js/plugins/pickers/daterangepicker.js')}}"></script>

        <script type="text/javascript" src="{{asset('/public/admin/js/core/app.js')}}"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- toastr JS -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- /theme JS files -->
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <!-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->

    </head>

    <body>

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}"><img width="150px" src="{{asset('/public/dynamic_assets/1495873280-j_logo.png')}}" alt=""></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

            </ul>

            <!--<p class="navbar-text"><span class="label bg-success">Online</span></p> -->

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('/public/admin/images/placeholder.jpg')}}" alt="">
                        <span>Admin</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{route('profile_index')}}"><i class="icon-user-plus"></i> My profile</a></li>
                        <li><a href="{{route('dashboard_contact')}}"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
