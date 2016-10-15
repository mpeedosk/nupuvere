@extends('layouts.main')
@section('title', $exercise->title)
@section('content')
    <div class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">

                <div class="col-md-3 visible-lg visible-md">
                    <?php $next = false; ?>
                    @foreach($exercises as $ex)
                        @if($next)
                            <?php $next_id = $ex->id; $next = false;?>
                        @endif
                            <a href="/{{$category}}/{{$age_group}}/{{$difficulty}}/{{$ex -> id}}" class="btn center-block btn-not-solved">
                                {{$ex -> title}}
                                @if ($ex->id == $exercise->id)
                                    <span class="glyphicon glyphicon-arrow-right pull-right text-icon"></span>
                                    <?php $next = true;?>
                                @endif
                            </a>
                    @endforeach

                </div>

                <div class="col-md-7">
                    <div class="row">
                        <div class="ex-title col-md-12 animate fadeInRight animated">
                            <H2 class="text-left no-margin">{{$exercise -> title}}</H2>
                        </div>
                        <div class="col-md-12 animate fadeInLeft animated">
                            <div class="ex-text-area font-size-md">
                                <div class="padding-10" align="left">
                                    {!! $exercise -> content !!}
                                </div>
                            </div>
                        </div>
                        <div id="solution" class="col-md-12 animate fadeInRightBig animated" style="display: none;">
                            <div class="ex-text-area font-size-md " style=" border: 2px solid #2196f3;  margin-top: 0;">
                                <div class="padding-10" align="left">
                                    <p>
                                        Retseptis antud küpsetusplaadi pindala on 20·28=560 cm2. Kertu küpsetusplaadi
                                        pindala oli 24·35=840 cm2. Seega plaadi pindala oli 840:560=1,5 korda suurem.
                                        Sama paksu koogi tegemiseks tuli järelikult ka tainast teha 1,5 korda rohkem. Et
                                        retsepti kohaselt oli vaja panna 150 grammi võid, siis Kertul tuli võid panna
                                        1,5·150 = 225 grammi
                                    </p>
                                    {{--{!! $exercise -> content !!}--}}
                                </div>
                            </div>
                        </div>
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
                                <button id="answer-btn" type="button"
                                        class="btn btn-raised btn-green btn-default fix-margin-right pull-right"
                                        @if(Auth::guest() )
                                        disabled
                                        @endif
                                >Vasta
                                </button>
                                <a href="{{isset($next_id) ? '/' . $category.'/'.$age_group.'/'.$difficulty.'/'.$next_id : '/'.$category.'/'.$age_group }}"
                                   class="btn btn-raised btn-bronze btn-default pull-right">
                                    <span class="hidden-xs">Edasi</span>
                                    <span class="visible-xs">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 margin-50-lg">
                    <button type="button" class="btn btn-success btn-default btn-lg" data-toggle="modal"
                            data-target="#hint-dialog">
                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                    </button>

                    <button type="button" class="btn btn-danger btn-default" data-toggle="modal"
                            data-target="#confirm-dialog" data-backdrop="static" data-keyboard="false">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> vastus
                    </button>
                    <p class="font-size-sm">
                        Koostanud Ahhaa
                    </p>
                </div>


            </div>
        </div>
    </div>

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
            <div class="modal-content  panel panel-warning">
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
                    <button id="showAnswer" type="button" class="btn btn-danger btn-raised pull-right" data-dismiss="modal"
                            onclick="showAnswer()">Näita vastust
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
