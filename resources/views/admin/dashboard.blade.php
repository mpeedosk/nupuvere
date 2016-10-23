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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.css">
    <!-- Bootstrap Material Design -->
    {{--<link rel="stylesheet"--}}
    {{--href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.css">--}}



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

</head>
<body id="body-bg">
<section class="admin-page-container">
    <div class="admin-page-layout">
        {{--    <header class="header black-bg">
                <!--logo start-->
                <a href="#" class="logo"><b>DASHGUM FREE</b></a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <!--  notification end -->
                </div>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li><a class="logout" href="\login">Logout</a></li>
                    </ul>
                </div>
            </header>--}}

        <div id="sidebar">
            <!-- sidebar menu start-->
            <a href="#" class="sidebar-logo withripple padding-10">
                <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif"
                     alt="Logo"/></a>
            <header class="sidebar-header text-center" id="nav-accordion">
                <i class="fa fa-cogs fa-10x color-yellow" aria-hidden="true"></i>
                <h5 class="centered">Martin Peedosk</h5>
            </header>

            <div class="sidebar-nav">

                <a href="/" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-long-arrow-left "></i> Tagasi pealehele

                </a>

                <a href="#" class="sidebar-item withripple sidebar-item-active">
                    <i class="fa fa-fw fa-dashboard "></i> Nupuvere
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-gift"></i> Kategooriad
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-globe"></i> Ülesanded
                </a>


                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-car"></i> Edetabel
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-user"></i> Administraatorid
                </a>
            </div>
        </div>
        {{--
            <!-- **********************************************************************************************************************************************************
             MAIN CONTENT
             *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <h3><i class="fa fa-angle-right"></i> Blank Page</h3>
                    <div class="row mt">
                        <div class="col-lg-12">
                            <p>Place your content here.</p>
                        </div>
                    </div>

                </section>
                <! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2014 - Alvarez.is
                    <a href="blank.html#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->--}}
    </div>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
