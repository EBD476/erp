<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="perfect-scrollbar-on">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HANTA ERP') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script src="{{asset('assets/js/core/jquery.min.js')}} "></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    @stack('script')
    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    {{--<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" />
    @if (app()->getLocale() == 'fa')
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    @endif

    @stack('css')
</head>
<body  @if (app()->getLocale() == 'fa') class="white-content rtl menu-on-right" @else  class="white-content"  @endif>

<div class="wrapper">
    {{--<div class="navbar-minimize-fixed" style="opacity: 0;">--}}
        {{--<button class="minimize-sidebar btn btn-link btn-just-icon">--}}
            {{--<i class="tim-icons icon-align-center visible-on-sidebar-regular text-muted"></i>--}}
            {{--<i class="tim-icons icon-bullet-list-67 visible-on-sidebar-mini text-muted"></i>--}}
        {{--</button>--}}
    {{--</div>--}}
    <div class="sidebar" data="purple">
        <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"-->
        <div class="sidebar-wrapper">
            <div class="logo">
                {{--<a href="javascript:void(0)" class="simple-text logo-mini">--}}

                {{--</a>--}}
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    {{--H&nbsp;&nbsp;A&nbsp;&nbsp;N&nbsp;&nbsp;T&nbsp;&nbsp;A--}}
                  <small>Hanta Smart Home</small>
                </a>
            </div>
            <ul class="nav">
                <li >
                    <a href="{{ route('home') }}">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>{{__('Dashboard')}}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}">
                        <i class="tim-icons icon-atom"></i>
                        <p>{{__('Manage Projects')}}</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        {{--{{ route('orders.index') }}--}}
                        <i class="tim-icons icon-app"></i>
                        <p>{{__('Orders')}}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map')}}">
                        <i class="tim-icons icon-pin"></i>
                        <p>{{__('Projects Map')}}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index')}}">
                        <i class="tim-icons icon-bulb-63"></i>
                        <p>{{__('Manage Products')}}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="tim-icons icon-single-02"></i>
                        <p> {{__('Manage Users')}}</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="tim-icons icon-single-02"></i>
                        <p>{{__('Manage Roles')}}</p>
                    </a>
                </li>
                <li>
                    <a href="./tables.html">
                        <i class="tim-icons icon-coins"></i>
                        <p>{{__('Manage Finance')}}</p>
                    </a>
                </li>
                <li>
                    <a href="./tables.html">
                        <i class="tim-icons icon-settings"></i>
                        <p>{{__('Settings')}}</p>
                    </a>
                </li>
                {{--<li>--}}
                    {{--<a href="./typography.html">--}}
                        {{--<i class="tim-icons icon-align-center"></i>--}}
                        {{--<p>Typography</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="./rtl.html">--}}
                        {{--<i class="tim-icons icon-world"></i>--}}
                        {{--<p>RTL Support</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="active-pro">--}}
                    {{--<a href="./upgrade.html">--}}
                        {{--<i class="tim-icons icon-spaceship"></i>--}}
                        {{--<p>Upgrade to PRO</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-gradient-light p-md-0 text-danger" >
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize d-inline">
                        <button class="minimize-sidebar btn btn-link btn-just-icon" rel="tooltip" data-original-title="Sidebar toggle" data-placement="right">
                            <i class="tim-icons icon-align-center visible-on-sidebar-regular"></i>
                            <i class="tim-icons icon-bullet-list-67 visible-on-sidebar-mini"></i>
                        </button>
                    </div>
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand font-weight-bold" href="javascript:void(0)">@yield('title')</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav @if (app()->getLocale() == 'fa') mr-auto @else ml-auto @endif">
                        <li class="search-bar input-group">
                            <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                <span class="d-lg-none d-md-block">Search</span>
                            </button>
                        </li>
                        {{--<li class="dropdown nav-item">--}}
                            {{--<a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
                                {{--<div class="notification d-none d-lg-block d-xl-block"></div>--}}
                                {{--<i class="tim-icons icon-sound-wave"></i>--}}
                                {{--<p class="d-lg-none">--}}
                                    {{--Notifications--}}
                                {{--</p>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu dropdown-menu-right dropdown-navbar">--}}
                                {{--<li class="nav-link">--}}
                                    {{--<a href="#" class="nav-item dropdown-item">Mike John responded to your email</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-link">--}}
                                    {{--<a href="javascript:void(0)" class="nav-item dropdown-item">You have 5 more tasks</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-link">--}}
                                    {{--<a href="javascript:void(0)" class="nav-item dropdown-item">Your friend Michael is in town</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-link">--}}
                                    {{--<a href="javascript:void(0)" class="nav-item dropdown-item">Another notification</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-link">--}}
                                    {{--<a href="javascript:void(0)" class="nav-item dropdown-item">Another one</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <div class="photo" >
                                    <img src="{{asset('assets/images/user.jpg')}}" alt="Profile Photo" >
                                </div>
                                {{auth()->user()->username}}
                                <b class="caret d-none d-lg-block d-xl-block"></b>
                                <p class="d-lg-none">
                                    Log out
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="nav-link">
                                    <a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a>
                                </li>
                                <li class="nav-link">
                                    <a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="nav-link">
                                    <a class="nav-item dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    </a>
                                    {{--<a href="javascript:void(0)" class="nav-item dropdown-item">--}}
                                        {{--Log out--}}
                                    {{----}}
                                    {{--</a>--}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->

                @yield('content')

        <footer class="footer">
            <div class="container-fluid">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            Creative Tim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            Blog
                        </a>
                    </li>
                </ul>
                <div class="copyright fc-ltr">
                   <a href=http://hantaibms.com >Hantaibms</a> Co. by EBD   ©2018
                </div>
            </div>
        </footer>
    </div>
</div>

    {{--<div id="app">--}}
        {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
            {{--<div class="container">--}}
                {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                    {{--{{ config('app.name', 'Laravel') }}--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

                {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--@if (Route::has('register'))--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                                {{--@endif--}}
                            {{--</li>--}}
                        {{--@else--}}
                            {{--<li class="nav-item dropdown">--}}
                                {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                                    {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                        {{--{{ __('Logout') }}--}}
                                    {{--</a>--}}

                                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                        {{--@csrf--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        {{--<main class="py-4">--}}
            {{--@yield('content')--}}
        {{--</main>--}}
    {{--</div>--}}


{{--<script type="text/javascript" src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/popper.min.js')}} "></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}} "></script>
<script>
    $(document).ready(function() {

        sidebar_mini_active = false;

       var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        /**** Scroller ****/

        if (isWindows) {
            if ($('.main-panel').length != 0) {
                var ps = new PerfectScrollbar('.main-panel', {
                    wheelSpeed: 2,
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                    suppressScrollX: true
                });
            }

            if ($('.table-responsive').length != 0) {
                var ps = new PerfectScrollbar('.table-responsive', {
                    wheelSpeed: 2,
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                    suppressScrollX: true
                });
            }
        }



        // if ($.fn.niceScroll) {
        //     var mainScroller = $("html").niceScroll({
        //         zindex: 999999,
        //         boxzoom: true,
        //         cursoropacitymin: 0.5,
        //         cursoropacitymax: 0.8,
        //         cursorwidth: "10px",
        //         cursorborder: "0px solid",
        //         autohidemode: false
        //     });
        // }


    });
</script>

@stack('scripts')

</body>
</html>
