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
        h
    @endif


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.css">

    <!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

</head>
<body id="body-bg">
<section class="admin-page-container">
    <div class="admin-page-layout">
        <header class="admin-page-header">
            <!--logo start-->
            <div class="admin-page-header-row">

                <span class="header-title hidden-sm hidden-xs">Pealehe muutmine | Galerii | Logod | Kontakt</span>

                <div class="empty-space"></div>

                <form id="logout-form"
                      action="@if (App::isLocal()) {{ url('/logout') }} @else{{ secure_url('/logout') }} @endif "
                      method="POST">
                    <button class="btn btn-primary btn-raised" type="submit">Logi välja
                    </button>
                    {{ csrf_field() }}

                </form>
            </div>
            <!--logo end-->
        </header>

        <div id="sidebar">
            <!-- sidebar menu start-->
            <a href="#" class="sidebar-logo withripple padding-10">
                <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif"
                     alt="Logo"/></a>

            <header class="sidebar-header text-center" id="nav-accordion">
                <i class="fa fa-cogs fa-10x color-yellow" aria-hidden="true"></i>
                <span class="font-size-md">Martin Peedosk</span>
            </header>

            <div class="sidebar-nav">

                <a href="/" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-long-arrow-left "></i> Tagasi pealehele

                </a>

                <a href="#" class="sidebar-item withripple sidebar-item-active">
                    <i class="fa fa-fw fa-picture-o"></i> Nupuvere
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-book"></i> Kategooriad
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-list-alt"></i> Ülesanded
                </a>


                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-trophy"></i> Edetabel
                </a>

                <a href="#" class="sidebar-item withripple">
                    <i class="fa fa-fw fa-users"></i> Administraatorid
                </a>
            </div>
        </div>


        <section class="admin-page-content">
            <div class="container">
                <div class="row vert-full full-height">
                    <div class="col-md-6 vert-full text-center">
                        <div class="col-md-12 ">
                            <h1>Galerii
                                <span class="glyphicon glyphicon-question-sign icon-help" aria-hidden="true"
                                      data-toggle="modal" data-target="#slider-help"></span>
                            </h1>

                            <hr>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 img-box">
                                        <div class="form-group no-padding no-margin has-feedback">
                                            <input type="file" id="inputSlide1" multiple="">
                                            <span class="glyphicon glyphicon-open upload-icon"
                                                  aria-hidden="true"></span>
                                            <input type="text" readonly="" class="form-control upload-input"
                                                   placeholder="Pilt 1">
                                            <img src="img/slideshow/slide1.jpg" alt="slide1">
                                        </div>
                                    </div>
                                    <div class="col-md-6 img-box">
                                        <div class="form-group no-padding no-margin has-feedback">
                                            <input type="file" id="inputSlide2" multiple="">
                                            <span class="glyphicon glyphicon-open upload-icon"
                                                  aria-hidden="true"></span>
                                            <input type="text" readonly="" class="form-control upload-input"
                                                   placeholder="Pilt 2">
                                            <img src="img/slideshow/slide2.jpg" alt="slide2">
                                        </div>
                                    </div>
                                    <div class="col-md-6 img-box">
                                        <div class="form-group no-padding no-margin has-feedback">
                                            <input type="file" id="inputSlide3" multiple="">
                                            <span class="glyphicon glyphicon-open upload-icon"
                                                  aria-hidden="true"></span>
                                            <input type="text" readonly="" class="form-control upload-input"
                                                   placeholder="Pilt 3">
                                            <img src="img/slideshow/slide3.jpg" alt="slide3">
                                        </div>

                                    </div>
                                    <div class="col-md-6 img-box">
                                        <div class="form-group no-padding no-margin has-feedback">
                                            <input type="file" id="inputSlide4" multiple="">
                                            <span class="glyphicon glyphicon-open upload-icon"
                                                  aria-hidden="true"></span>
                                            <input type="text" readonly="" class="form-control upload-input"
                                                   placeholder="Pilt 4">
                                            <img src="img/slideshow/slide4.jpg" alt="slide4">
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-md-offset-3 img-box">
                                        <div class="form-group no-padding no-margin has-feedback">
                                            <input type="file" id="inputSlide5" multiple="">
                                            <span class="glyphicon glyphicon-open upload-icon"
                                                  aria-hidden="true"></span>
                                            <input type="text" readonly="" class="form-control upload-input"
                                                   placeholder="Pilt 5">
                                            <img src="img/slideshow/slide5.jpg" alt="slide5">
                                        </div>
                                        <button class="btn btn-primary btn-raised" type="submit">Uuenda
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 vert-full text-center full-height">
                        <div class="col-md-12 vert-half">
                            <h1>Logod<span class="glyphicon glyphicon-question-sign icon-help" aria-hidden="true"
                                           data-toggle="modal" data-target="#logo-help"></span></h1>
                            <hr>
                            <form>
                                <div class="form-group no-padding no-margin has-feedback">
                                    <input type="file" id="inputLogos" multiple="">
                                    <span class="glyphicon glyphicon-open upload-icon"
                                          aria-hidden="true"></span>
                                    <input type="text" readonly="" class="form-control upload-input"
                                           placeholder="Logod">
                                    <img class="sponsors" src="/img/partnerid.png" alt="Logo"/>
                                </div>

                                <button class="btn btn-primary btn-raised" type="submit">Uuenda
                                </button>
                            </form>

                        </div>
                        <div class="col-md-12 vert-half text-center">
                            <h1>Kontakt</h1>
                            <hr>
                            <form>
                            <textarea class="ex-text-area" rows="5">Telephone:1-800-123-4567
Email: info@example.com
Website: www.example.com</textarea>
                                <button class="btn btn-primary btn-raised" type="submit">Uuenda
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

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

    <div id="slider-help" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Galerii uuendamine</h4>
                </div>
                <div class="modal-body font-size-lg" style="text-align: justify">
                    <p>Uuendatavate piltide mõõtmed peaksid olema 1080 x 422 pikselit. Pärast faili üleslaadimist süsteem
                    automaatselt muudab dimensioone. Seega, kui laadida üles pilt, mille mõõtmed ei ole vastavad,
                    võib see esilehel näha teistmoodi välja.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>

    <div id="logo-help" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Logo uuendamine</h4>
                </div>
                <div class="modal-body font-size-lg" style="text-align: justify">
                    <p>Logo suurus peaks olema 810 x 140. Pärast faili üleslaadimist süsteem
                        automaatselt muudab dimensioone. Seega, kui laadida üles pilt, mille mõõtmed ei ole vastavad,
                        võib see esilehel näha teistmoodi välja.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
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
