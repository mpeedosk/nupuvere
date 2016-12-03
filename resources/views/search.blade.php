@extends('layouts.main')
@section('title', 'Otsing')
@section('content')
    <section class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 col-md-offset-2">
                    <H1>Otsingu "{{$query}}" tulemused:</H1>
                    <hr>
                    @if(count($exercises)==0)
                        <h3>Kahjuks sellisele päringule vasteid ei leitud.</h3>
                    @else
                        <h3>Tulemusi : {{count($exercises)}}</h3>
                        <br>
                        @if (Auth::guest() )
                            @foreach($exercises as $exercise)
                                <a href="{{$exercise->getPath()}}"
                                   class="btn center-block btn-not-solved">
                                    {{$exercise->category.'  →  '.$exercise->age_group.'  →  '.$exercise -> title}}
                                </a>
                            @endforeach
                        @else
                            @foreach($exercises as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-solved">
                                        {{$exercise->category.'  →  '.$exercise->age_group.'  →  '.$exercise -> title}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-not-solved">
                                        {{$exercise->category.'  →  '.$exercise->age_group.'  →  '.$exercise -> title}}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
