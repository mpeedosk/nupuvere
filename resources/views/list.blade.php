@extends('layouts.main')
@section('title', 'Ülesanded')


@section('content')
    <section class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">

                <div class="col-sm-4">

                    <H1> Lihtne</H1>

                    @if(count($easyEx)==0)
                        <h3>Selles raskusastmes ülesanded puuduvad</h3>
                    @else
                        @if (Auth::guest() )

                            @foreach($easyEx as $exercise)
                                <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                                   class="btn center-block btn-not-solved">{{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}</a>
                            @endforeach
                        @else
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                     aria-valuenow="{{$p_easy}}"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$p_easy}}%">
                                </div>
                            </div>
                            @foreach($easyEx as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                                       class="btn center-block btn-solved">
                                        {{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                                       class="btn center-block btn-not-solved">{{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
                <div class="col-sm-4">
                    <div class="vertical-lines">
                        <H1> Keskmine</H1>
                        @if(count($mediumEx)==0)
                            <h3>Selles raskusastmes ülesanded puuduvad</h3>
                        @else
                            @if (Auth::guest() )
                                @foreach($mediumEx as $exercise)
                                    <a class="btn center-block btn-not-solved"
                                       href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}">
                                        {{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}
                                    </a>
                                @endforeach
                            @else
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="{{$p_med}}"
                                         aria-valuemin="0" aria-valuemax="100" style="width: {{$p_med}}%">
                                    </div>
                                </div>

                                @foreach($mediumEx as $exercise)
                                    @if( in_array($exercise-> id, $solved))
                                        <a href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}"
                                           class="btn center-block btn-solved">
                                            {{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}
                                            <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                        </a>
                                    @else
                                        <a href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}"
                                           class="btn center-block btn-not-solved">{{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <H1> Raske</H1>
                    @if(count($hardEx)==0)
                        <h3>Selles raskusastmes ülesanded puuduvad</h3>
                    @else
                        @if(Auth::guest())
                            @foreach($hardEx as $exercise)
                                <a class="btn center-block btn-not-solved"
                                   href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}">{{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}</a>
                            @endforeach
                        @else
                            <div class="progress">
                                <div class="progress-bar progress-bar-violet" role="progressbar"
                                     aria-valuenow="{{$p_hard}}"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$p_hard}}%">
                                </div>
                            </div>

                            @foreach($hardEx as $exercise)
                                @if( in_array($exercise-> id, $solved))
                                    <a href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}"
                                       class="btn center-block btn-solved">
                                        {{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}
                                        <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                    </a>
                                @else
                                    <a href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}"
                                       class="btn center-block btn-not-solved">{{strlen($exercise -> title) > 24 ? substr($exercise -> title,0, 25)."..." : $exercise -> title}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection