@extends('layouts.main')
@section('title', 'Nuppel')
@section('content')
    {{-- Simple greeting after registering  --}}
    @if(Session::has('register'))
        <script>
            $(function () {
                toastr.success("{{Session::get('register')}}");
            });
        </script>
    @endif

    <div id="slideshow" class="margin-vert-30">
        {{-- Make the loading smoother by first hiding the gallery then fading it in --}}
        <script>
            document.getElementById('slideshow').style.opacity = 0;
        </script>
        <div class="container bottom-border">
            <div class="row">
                <!-- Carousel Slideshow -->
                <div id="gallery" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#gallery" data-slide-to="0"></li>
                        <li data-target="#gallery" data-slide-to="1"></li>
                        <li data-target="#gallery" data-slide-to="2" class="active"></li>
                        <li data-target="#gallery" data-slide-to="3"></li>
                        <li data-target="#gallery" data-slide-to="4"></li>
                    </ol>
                    <div class="clearfix"></div>
                    <!-- Carousel Images -->
                    <div class="carousel-inner">
                        <div class="item">
                            <img src="img/gallery/gallery1.png?cache={{$updated}}" alt="slide1">
                        </div>
                        <div class="item">
                            <img src="img/gallery/gallery2.png?cache={{$updated}}" alt="slide2">
                        </div>
                        <div class="item active">
                            <img src="img/gallery/gallery3.png?cache={{$updated}}" alt="slide3">
                        </div>
                        <div class="item">
                            <img src="img/gallery/gallery4.png?cache={{$updated}}" alt="slide4">
                        </div>
                        <div class="item">
                            <img src="img/gallery/gallery5.png?cache={{$updated}}" alt="slide5">
                        </div>
                    </div>
                    <!-- End Carousel Images -->
                    <a class="left carousel-control" href="#gallery" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#gallery" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <!-- End Carousel Slideshow -->
            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection

@section('css')
    <script>
        $(document).ready(function () {
            $('#slideshow').fadeTo(400, 1);
            $('.carousel').carousel({
                interval: 1000 * 10
            });
        });
    </script>
@endsection
