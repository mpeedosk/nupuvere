<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Nupuvere lehekülg">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>@yield('title')</title>

    <!-- Favicon -->
{{--<link href="favicon.ico" rel="shortcut icon">--}}


<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
    <!-- Bootstrap Material Design -->
    {{--<link rel="stylesheet"--}}
          {{--href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.css">--}}



@if (App::isLocal())
        <link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-material-design.css')}}">
@else
    <!-- Template CSS -->
        <link rel="stylesheet" href="{{secure_asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/main.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/bootstrap-material-design.css')}}">

@endif


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.css">

<!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

</head>
<body id="body-bg" >
<!-- Header -->
@include('includes.header')
<!-- End Header -->
<!-- Top Menu -->

@include('includes.menu')
<!-- End Top Menu -->

<!-- === END HEADER === -->
<!-- === BEGIN CONTENT === -->
@yield('content')
<!-- === END CONTENT === -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
@if (App::isLocal())
    <script type="text/javascript" src="{{asset('js/modernizr.custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
@else
    <!-- JS -->
    {{--<script type="text/javascript" src="{{secure_asset('js/jquery.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{secure_asset('js/bootstrap.min.js')}}"></script>--}}
    <!-- Isotope - Portfolio Sorting -->
    {{--<script type="text/javascript" src="{{secure_asset('js/jquery.isotope.js')}}"></script>--}}
    <!-- Mobile Menu - Slicknav -->
    {{--<script type="text/javascript" src="{{secure_asset('js/jquery.slicknav.js')}}"></script>--}}



    <!-- Animate on Scroll-->
    {{--<script type="text/javascript" src="{{secure_asset('js/jquery.visible.js')}}" charset="utf-8"></script>--}}
    {{--<!-- Slimbox2-->--}}
    {{--<script type="text/javascript" src="{{secure_asset('js/slimbox2.js')}}" charset="utf-8"></script>--}}
    {{--<!-- Modernizr -->--}}
    <script type="text/javascript" src="{{secure_asset('js/modernizr.custom.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/scripts.js')}}"></script>
@endif
</body>
</html>
