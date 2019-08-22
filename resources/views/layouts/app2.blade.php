<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset('assets/js/core/jquery.min.js')}} "></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}} "></script>
    <script src="{{asset('assets/js/jquery.nicescroll.min.js')}}" type="text/javascript" ></script>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">


</head>
<body class="white-content">

<div class="wrapper container-fluid">

    @yield('content')


</div>



</body>
</html>