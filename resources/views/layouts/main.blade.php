<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Nupuvere lehekülg">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>@yield('title')</title>

    <!-- Favicon -->
    <link href="favicon.ico" rel="shortcut icon">



    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">


    @if (App::isLocal())
        <!-- Bootstrap Material Design -->
            <link rel="stylesheet" type="text/css" href="{{asset('css/material/bootstrap-material-design.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('css/material/ripples.css')}}">


            <!-- Template CSS -->
            <link rel="stylesheet" href="{{asset('css/animate.css')}}">
            <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
            <link rel="stylesheet" href="{{asset('css/main.css')}}">
            <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    @else
    <!-- Bootstrap Material Design -->
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/material/bootstrap-material-design.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/material/ripples.css')}}">


        <!-- Template CSS -->
        <link rel="stylesheet" href="{{secure_asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/main.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/responsive.css')}}">
    @endif




    <!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

</head>
<body>



<div id="body-bg">
    <!-- Phone/Email -->
{{--    <div id="pre-header" class="background-gray-lighter">
        <div class="container no-padding">
            <div class="row">
                <div class="col-sm-6 padding-vert-5">
                    <strong>Phone:</strong>&nbsp;1-800-123-4567
                </div>
                <div class="col-sm-6 text-right padding-vert-5">
                    <strong>Email:</strong>&nbsp;info@joomla51.com
                </div>
            </div>
        </div>
    </div>--}}
<!-- End Phone/Email -->
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
    <!-- === BEGIN FOOTER === -->

    @include('includes.footer')

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>

<script type="text/javascript" src="{{'//js/modernizr.custom.js'}}" ></script>
<script type="text/javascript" src="{{'//js/scripts.js'}}"></script>
</body>
</html>
