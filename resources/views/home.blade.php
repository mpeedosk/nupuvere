
@extends('layouts.main')
@section('title', 'Nupuvere')


@section('content')
    <div id="slideshow" class="margin-vert-30">
        <div class="container no-padding">
            <div class="row">
                <!-- Carousel Slideshow -->
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="3"></li>
                        <li data-target="#carousel-example" data-slide-to="4"></li>
                    </ol>

                    <div class="clearfix"></div>
                    <!-- End Carousel Indicators -->
                    <!-- Carousel Images -->
                    <div class="carousel-inner">
                        <div class="item">
                            <img src="img/slideshow/slide1.jpg" alt="slide1">
                        </div>
                        <div class="item">
                            <img src="img/slideshow/slide2.jpg" alt="slide2">
                        </div>
                        <div class="item active">
                            <img src="img/slideshow/slide3.jpg" alt="slide3">
                        </div>
                        <div class="item">
                            <img src="img/slideshow/slide4.jpg" alt="slide4">
                        </div>
                        <div class="item">
                            <img src="img/slideshow/slide5.jpg" alt="slide5">
                        </div>
                    </div>
                    <!-- End Carousel Images -->
                    <!-- Carousel Controls -->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <!-- End Carousel Controls -->
                </div>
                <!-- End Carousel Slideshow -->
            </div>
        </div>
    </div>
    @include('includes.footer')

@endsection
