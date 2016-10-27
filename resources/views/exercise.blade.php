@extends('layouts.main')
@section('title', $exercise->title)
@section('content')
    <section class="margin-vert-30">
        <div class="container">
            <div class="row">

                <div class="col-md-3 visible-lg visible-md">
                    <?php $next = false; ?>
                    @foreach($exercises as $ex)
                        @if($next)
                            <?php $next_id = $ex->id; $next = false;?>
                        @endif
                        @if ($ex->id == $exercise->id)
                            <a id="active" href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}"
                               class="btn center-block @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                {{$ex -> title}}

                                <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
                                <?php $next = true;?>
                            </a>
                         @else
                                <a href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}"
                                   class="btn center-block  @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                    {{$ex -> title}}
                                </a>
                        @endif

                    @endforeach


                </div>

                <div class="col-md-7 content-bg">
                    <div class="row">
                        <div class="ex-title col-md-12 animate fadeInRight animated">
                            <H2 class="text-left no-margin">{{$exercise -> title}}</H2>
                        </div>
                        <div class="col-md-12 animate fadeInLeft animated">
                            <div class="ex-text-area font-size-md">
                                <div class="padding-10">
                                    {!! $exercise -> content !!}
                                </div>
                            </div>
                        </div>
                        <div id="solution" class="col-md-12 animate fadeInRightBig animated">
                            <div class="ex-text-area font-size-md">
                                <div class="padding-10">
                                    <p id="solution-text"></p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ url('/exercise/check/'.$exercise-> id)}}">
                            <div class="col-xs-12">
                                @include('exercises.'.$type)
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <a href="/{{$category}}/{{$age_group}}"
                                       class="btn btn-raised btn-blue btn-default fix-margin-left pull-left">
                                        <span class="hidden-xs">Nimekiri</span>
                                        <span class="visible-xs">&larr;</span>

                                    </a>

                                    @if(Auth::guest() )
                                        <span class="btn btn-raised btn-success btn-default fix-margin-right pull-right"
                                              disabled
                                              onclick="loginRequired()">Vasta</span>
                                    @else
                                        {{ csrf_field() }}
                                        <button id="submit-answer" type="submit"
                                                class="btn btn-raised btn-success btn-default fix-margin-right pull-right"
                                                onclick="submitAnswer(event, {{$exercise -> id}},{{$exercise -> type}})">
                                            Vasta
                                        </button>
                                    @endif

                                    <a id="next-ex"
                                       href="{{isset($next_id) ? '/' . $category.'/'.$age_group.'/'.$difficulty.'/'.$next_id : '/'.$category.'/'.$age_group }}"

                                       class="btn btn-raised btn-aqua pull-right">
                                        <span class="hidden-xs">Edasi</span>
                                        <span class="visible-xs">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-md-2 margin-50-lg text-center">
                    <button type="button" class="btn btn-success btn-default btn-lg" data-toggle="modal"
                            data-target="#hint-dialog">
                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                    </button>

                    @if(!Auth::guest() )
                        <button type="button" class="btn btn-danger btn-default" data-toggle="modal"
                                data-target="#confirm-dialog" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> vastus
                        </button>
                    @endif
                    <p class="font-size-sm">
                        Koostanud: {{$exercise -> author}}
                    </p>
                </div>


            </div>
        </div>
    </section>

    <div id="hint-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Vihjed</h4>
                </div>
                <div class="modal-body">
                    <p>{{$exercise -> hint}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  panel panel-danger">
                <div class="panel-heading">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-alert" aria-hidden="true"></span>
                    <h4 class="panel-title">Vastus</h4>
                </div>
                <div class="modal-body">
                    <p>Kui vaatate vastuse ära, siis ei ole võimalik enam selle ülesande eest punkte saada.</p>
                    <p>Olete kindel, et tahate seda teha?</p>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-blue btn-raised" data-dismiss="modal">Tühista</button>
                    <button id="showAnswer" type="button" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal"
                            onclick="showAnswer({{$exercise -> id}},{{$exercise -> type}})">Näita vastust
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div id="wrong-answer" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content panel panel-warning">
                <div class="panel-heading">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-remove" aria-hidden="true"></span>
                    <h4 class="panel-title">Vale vastus</h4>
                </div>
                <div class="modal-body font-size-md text-center">
                    <p>Kahjuks ei ole see vastus õige.</p>
                    <p>Võite aga uuesti proovida!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>


@endsection
