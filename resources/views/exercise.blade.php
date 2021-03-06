@extends('layouts.main')
@section('title', $exercise->title)
@section('content')
    <section class="margin-vert-30">
        <div class="se-pre-con"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 visible-lg visible-md">
                    @foreach($exercises_before as $ex)
                        @if ($ex->id == $exercise->id)
                            <a id="active" href="{{$ex->getPath()}}"
                               class="btn center-block @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
                                <div class="ex-title-wrapper">
                                    {{$ex->cutTitle(11)}}
                                </div>
                            </a>
                        @else
                            <a href="{{$ex->getPath()}}"
                               class="btn center-block  @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                <div class="ex-title-wrapper">
                                    {{$ex->cutTitle(19)}}
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @foreach($exercises_after as $ex)
                        @if ($loop->first)
                            <a id="active" href="{{$ex->getPath()}}"
                               class="btn center-block @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
                                <div class="ex-title-wrapper">
                                    <span>{{$ex->cutTitle(19)}}</span>
                                </div>

                            </a>
                        @else
                            <a href="{{$ex->getPath()}}"
                               class="btn center-block  @if( in_array($ex -> id, $solved)) btn-solved @else btn-not-solved @endif ">
                                <div class="ex-title-wrapper">
                                    {{$ex->cutTitle(19)}}
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="ex-title col-md-12 fadeInRight animated">
                            <H2 class="text-left">{{$exercise -> title}}</H2>
                        </div>
                        <div class="col-md-12 animate fadeInLeft animated">
                            <div class="ex-text-area font-size-md">
                                <div id="ex-content">
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
                                    <div id="solution-text">
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
                                    <a href="/{{$category}}/{{$age_group}}" class="btn btn-raised btn-blue fix-margin-left pull-left">
                                        <span class="hidden-xs">Nimekiri</span>
                                        <span class="visible-xs">&larr;</span>
                                    </a>
                                    @if(Auth::guest() )
                                        <span class="btn btn-raised btn-success fix-margin-right pull-right" disabled onclick="loginRequired()">
                                            Vasta</span>
                                    @else
                                        <button id="submit-answer" type="submit" class="btn btn-raised btn-success fix-margin-right pull-right"
                                                onclick="submitAnswer(event, '{{$exercise -> id}}', '{{$exercise -> type}}')">
                                            <span class="spinner"><span class="md-spinner md-spinner-white"></span></span>
                                            <span class="md-spinner-text">Vasta</span>
                                        </button>
                                    @endif

                                    <a id="next-ex" class="btn btn-raised btn-aqua pull-right"
                                       href="{{isset($exercises_after[1]) ? $exercises_after[1]->getPath() : '/'.$category.'/'.$age_group }}">
                                        <span class="hidden-xs">Edasi</span>
                                        <span class="visible-xs">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2 margin-50-lg text-center">
                    @if(!trim($exercise -> hint) == "")
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal"
                                data-target="#hint-dialog">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                        </button>
                    @endif
                    @if(!Auth::guest() )
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-dialog" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> vastus
                        </button>
                    @endif
                    @if(!trim($exercise -> author) == "")
                        <div>
                            <p class="font-size-sm">
                                Koostanud:
                            </p>
                            <p class="font-size-sm">
                                {{$exercise -> author}}
                            </p>
                        </div>
                    @endif
                    @if($exercise->licence)
                        <div>
                            <p class="font-size-sm"> Litsents: </p>
                            <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img
                                        alt="Creative Commons License"
                                        src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png"
                                        data-toggle="tooltip" data-placement="bottom"
                                        title="See töö on kaitstud Creative Commons Attribution-NonCommercial 4.0 International litsentsiga"/></a>
                        </div>
                    @endif
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
                            onclick="showAnswer('{{$exercise -> id}}','{{$exercise -> type}}')">Näita vastust
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
                    <img src="#" class="enlargeImageModalSource" alt="enlarged-image">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <script src="{{asset('lib/js/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script>
@endsection