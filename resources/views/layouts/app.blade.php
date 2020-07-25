<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="perfect-scrollbar-on">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HANTA ERP') }}</title>
    <!-- Fonts -->
{{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

<!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    {{--    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet"/>
    @if (app()->getLocale() == 'fa')
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    @endif

    @stack('css')
</head>
<body @if (app()->getLocale() == 'fa') class="white-content rtl menu-on-right" @else  class="white-content" @endif>

<div class="wrapper">
    {{--Message unread data--}}
    {{$current_user = auth()->user()->id,
    $unread_message_count = \App\ConversationView::where('hcv_message_status', 0)->where('hcv_receiver_user_id',auth()->user()->id)->count(),
     $unread_message = \Illuminate\Support\Facades\DB::table('hnt_conversation_view')
     ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
     ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name','users.image', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
     ->where('hnt_conversation_view.hcv_message_status', '=', 0)
     ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
     ->where('hnt_conversation_view.deleted_at', '=', Null)
     ->get()}}
    {{--end--}}
    @include('layouts.partial.sidebar')
    <div class="main-panel">

        <!-- Navbar -->
    @include('layouts.partial.topbar')
    <!-- End Navbar -->

        <!-- Content -->
    @yield('content')
    <!-- End Content -->

        <!-- Footer -->
    @include('layouts.partial.footer')
    <!-- End Footer -->


    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/js/app.js') }}" defer></script>
<script src="{{asset('assets/js/core/jquery.min.js')}} "></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script src="{{asset('assets/js/plugins/persian-numbers-jquery-plugin-master/persianNum.jquery-2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/popper.min.js')}} "></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}} "></script>
<script>
    $(document).ready(function () {


        $('body').persianNum({
            forbiddenTag: ['input', 'div']

        })


        sidebar_mini_active = false;

        var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        /**** Scroller ****/

        if (isWindows) {
            // if ($('.main-panel').length != 0) {
            //     var ps = new PerfectScrollbar('.main-panel', {
            //         wheelSpeed: 2,
            //         wheelPropagation: true,
            //         minScrollbarLength: 20,
            //         suppressScrollX: true
            //     });
            // }

            // if ($('.table-responsive').length != 0) {
            //     var ps = new PerfectScrollbar('.table-responsive', {
            //         wheelSpeed: 2,
            //         wheelPropagation: true,
            //         minScrollbarLength: 20,
            //         suppressScrollX: true
            //     });
            // }
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
