@extends('layouts.main')
@section('title', 'Ülesanded')
@section('content')
    <section class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-4 vertical-line-left">
                    <H1> Lihtne</H1>
                    @if(count($easyEx)==0)
                        <h3>Selles raskusastmes ülesanded puuduvad</h3>
                    @else
                        @if (Auth::guest() )
                            @foreach($easyEx as $exercise)
                                <a href="{{$exercise->getPath()}}"
                                   class="btn center-block btn-not-solved">{{$exercise->cutTitle(25)}}</a>
                            @endforeach
                        @else
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                     aria-valuenow="{{$p_easy}}"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$p_easy}}%">
                                </div>
                            </div>
                            @foreach($easyEx as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-solved">
                                        {{$exercise->cutTitle(25)}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-not-solved">{{$exercise->cutTitle(25)}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
                <div class="col-sm-4 vertical-line-center">
                    <H1> Keskmine</H1>
                    @if(count($mediumEx)==0)
                        <h3>Selles raskusastmes ülesanded puuduvad</h3>
                    @else
                        @if (Auth::guest() )
                            @foreach($mediumEx as $exercise)
                                <a class="btn center-block btn-not-solved"
                                   href="{{$exercise->getPath()}}">
                                    {{$exercise->cutTitle(25)}}
                                </a>
                            @endforeach
                        @else
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                     aria-valuenow="{{$p_med}}"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$p_med}}%">
                                </div>
                            </div>

                            @foreach($mediumEx as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-solved">
                                        {{$exercise->cutTitle(25)}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-not-solved">{{$exercise->cutTitle(25)}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
                <div class="col-sm-4 vertical-line-right">
                    <H1> Raske</H1>
                    @if(count($hardEx)==0)
                        <h3>Selles raskusastmes ülesanded puuduvad</h3>
                    @else
                        @if(Auth::guest())
                            @foreach($hardEx as $exercise)
                                <a class="btn center-block btn-not-solved"
                                   href="{{$exercise->getPath()}}">{{$exercise->cutTitle(25)}}
                                </a>
                            @endforeach
                        @else
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                     aria-valuenow="{{$p_hard}}"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$p_hard}}%">
                                </div>
                            </div>
                            @foreach($hardEx as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-solved">
                                        {{$exercise->cutTitle(25)}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="{{$exercise->getPath()}}"
                                       class="btn center-block btn-not-solved">{{$exercise->cutTitle(25)}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection