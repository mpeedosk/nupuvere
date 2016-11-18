@extends('layouts.main')
@section('title', $exercise->title)
@section('content')
    <script src="{{asset('lib/js/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script>
    <section class="margin-vert-30">
        <div class="container">
            <div class="row">
                <div class="col-md-3 visible-lg visible-md">
                    @foreach($exercises_before as $ex)
                        @if ($ex->id == $exercise->id)
                            <a id="active" href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}"
                               class="btn center-block @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                {{$ex -> title}}

                                <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
                            </a>
                        @else
                            <a href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}"
                               class="btn center-block  @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                {{$ex -> title}}
                            </a>
                        @endif
                    @endforeach
                    @foreach($exercises_after as $ex)
                        @if ($loop->first)
                            <a id="active" href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}"
                               class="btn center-block @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                {{$ex -> title}}

                                <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
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
                        <div class="ex-title col-md-12 fadeInRight animated">
                            <H2 class="text-left no-margin">{{$exercise -> title}}</H2>
                        </div>
                        <div class="col-md-12 animate fadeInLeft animated">
                            <div class="ex-text-area font-size-md">
                                <div id="ex-content" class="padding-10" style=" overflow: hidden ">

                                    {!! $exercise -> content !!}

                                </div>
                            </div>
                        </div>

                        @if(Session::has('answer-check'))
                            @if(Session::get('answer-check'))
                                <div class="col-md-12 fadeInRightBig animated">
                                    <div class="ex-text-area font-size-md">
                                        <div id="solution-text" class="padding-10">
                                            {!! $exercise -> solution !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="solution" class="col-md-12 fadeInRightBig animated">
                                <div class="ex-text-area font-size-md">
                                    <div id="solution-text" class="padding-10">

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(Session::has('answer-check'))
                            @if(Session::get('answer-check'))
                                <p class="answer-no-js">Vastasite õigesti!</p>
                            @else
                                <p class="answer-no-js">Vastasite valesti!</p>
                            @endif
                        @endif

                        <form method="POST" action="{{ url('/answer/check/'.$exercise-> id)}}">
                            {{ csrf_field() }}
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
                                        <button id="submit-answer" type="submit"
                                                class="btn btn-raised btn-success btn-default fix-margin-right pull-right"
                                                onclick="submitAnswer(event, {{$exercise -> id}},{{$exercise -> type}})">
                                            Vasta
                                        </button>
                                    @endif

                                    <a id="next-ex"
                                       href="{{isset($exercises_after[1]) ? '/' . $category.'/'.$age_group.'/'.$difficulty.'/'.$exercises_after[1]->id : '/'.$category.'/'.$age_group }}"

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

                    @if(!$exercise -> hint == "")
                        <button type="button" class="btn btn-success btn-default btn-lg" data-toggle="modal"
                                data-target="#hint-dialog">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                        </button>
                    @endif

                    @if(!Auth::guest() )
                        <button type="button" class="btn btn-danger btn-default" data-toggle="modal"
                                data-target="#confirm-dialog" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> vastus
                        </button>
                    @endif
                    <p class="font-size-sm">
                        Koostanud: {{$exercise -> author}}
                    </p>
                    <p class="font-size-sm">
                        Litsents: <span class="fa fa-creative-commons" style="font-size: 16px" aria-hidden="true"
                                        data-toggle="tooltip" data-placement="bottom"
                                        title="See ülesanne on kaitstud Creative Commons 3.0 litsentsiga"></span>
                    </p>

                    <div>
                         <span class="fa fa-2x fa-creative-commons" aria-hidden="true"
                               data-toggle="tooltip" data-placement="bottom"
                               title="See ülesanne on kaitstud Creative Commons 3.0 litsentsiga"></span>
                    </div>

                    <img src="/img/licence.svg" alt="creative commons">

                </div>


            </div>
        </div>
    </section>

    <div id="hint-dialog" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Vihjed</h4>
                </div>
                <div class="modal-body">
                    <p>{!! $exercise -> hint !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm-dialog" class="modal fade" role="dialog" tabindex="-1">
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

    <div id="wrong-answer" class="modal fade" role="dialog" tabindex="-1">
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

    <div id="enlargeImageModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="enlargeImageModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body text-center">
                    <img src="" class="enlargeImageModalSource">
                </div>
            </div>
        </div>
    </div>
@endsection
