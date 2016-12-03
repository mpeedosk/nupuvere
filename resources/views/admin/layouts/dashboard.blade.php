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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">
    @if (App::isLocal())
        <link rel="stylesheet" href="{{asset('css/bootstrap-material-design.css')}}">
        <link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    @else
        <link rel="stylesheet" href="{{secure_asset('css/bootstrap-material-design.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/main.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/admin.css')}}">
    @endif


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.css">

    <!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/jqColorPicker.min.js"></script>

    @yield('css')

</head>
<body class="pattern">

<section class="admin-page-container">
    <div class="admin-page-layout">
        @include('admin.includes.header')

        @include('admin.includes.sidebar')



        @yield('content')
    </div>
</section>
<div id="scripts">
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.4.2/Sortable.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/locale/bootstrap-table-et-EE.min.js"></script>

@if (App::isLocal())

    <script type="text/javascript" src="{{asset('js/modernizr.custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin.only.js')}}"></script>
@else
    <script type="text/javascript" src="{{secure_asset('js/modernizr.custom.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/scripts.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/admin.only.js')}}"></script>
@endif
@yield('scripts')
</div>

</body>
</html>
