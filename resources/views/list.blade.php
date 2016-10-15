@extends('layouts.main')
@section('title', 'Matemaatika')


@section('content')
    <div class="content margin-vert-30">
        <div class="container">
            {{--<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: -20px; background: none">--}}
            {{--<li><a href="javascript:void(0)">{{$cate}}</a></li>--}}
            {{--<li class="active">{{$group}}</li>--}}
            {{--<li class="active">{{$cat_id}}</li>--}}
            {{--</ul>--}}
            <div class="row text-center">

                <div class="col-md-4">

                    <H1> Lihtne</H1>
                    @if (Auth::guest() )
                        @foreach($easyEx as $exercise)
                            <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                               class="btn center-block btn-not-solved">{{$exercise -> title}}</a>
                        @endforeach
                    @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$p_easy}}"
                                 aria-valuemin="0" aria-valuemax="100" style="width: {{$p_easy}}%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>

                        @foreach($easyEx as $exercise)
                            @if( in_array($exercise-> id, $solved))
                                <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                                   class="btn center-block btn-solved">
                                    {{$exercise -> title}}
                                    <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                </a>
                            @else
                                <a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}"
                                   class="btn center-block btn-not-solved">{{$exercise -> title}}</a>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4"
                     style="padding-right:20px; padding-left:20px; border-left: 1px solid #ccc; border-right: 1px solid #ccc;">
                    <H1> Keskmine</H1>
                    @if (Auth::guest() )
                        @foreach($mediumEx as $exercise)
                            <a class="btn center-block btn-not-solved"
                               href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}">
                                {{$exercise -> title}}
                            </a>
                        @endforeach
                    @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{$p_med}}"
                                 aria-valuemin="0" aria-valuemax="100" style="width: {{$p_med}}%">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>

                        @foreach($mediumEx as $exercise)
                            @if( in_array($exercise-> id, $solved))
                                <a href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}"
                                   class="btn center-block btn-solved">
                                    {{$exercise -> title}}
                                    <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                </a>
                            @else
                                <a href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}"
                                   class="btn center-block btn-not-solved">{{$exercise -> title}}</a>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4">
                    <H1> Raske</H1>

                    @if(Auth::guest())
                        @foreach($hardEx as $exercise)
                            <a class="btn center-block btn-not-solved"
                               href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}">{{$exercise -> title}}</a>
                        @endforeach
                    @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$p_hard}}"
                                 aria-valuemin="0" aria-valuemax="100" style="width: {{$p_hard}}%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>

                        @foreach($hardEx as $exercise)
                            @if( in_array($exercise-> id, $solved))
                                <a href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}"
                                   class="btn center-block btn-solved">
                                    {{$exercise -> title}}
                                    <span class="glyphicon glyphicon-ok pull-right text-icon"></span>
                                </a>
                            @else
                                <a href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}"
                                   class="btn center-block btn-not-solved">{{$exercise -> title}}</a>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection