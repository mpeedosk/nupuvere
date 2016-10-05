@extends('layouts.main')
@section('title', 'Ülesanne 2')

@section('content')
    <div class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">

                <div class="col-md-3 visible-lg">
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th class="text-center">Kerge</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="info">
                            <td>Ülesanne 1</td>
                        </tr>
                        <tr class="info">
                            <td><a href="ulesanne">Ülesanne 2</a></td>
                        </tr>
                        <tr class="info">
                            <td>Ülesanne 3</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 4</td>

                        </tr>
                        <tr class="info">
                            <td>Ülesanne 5</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 6</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 7</td>
                        </tr>
                        </tbody>
                    </table>
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
                        <div class="col-md-12">
                            <input class="ex-text-area no-margin" placeholder="Sisestage vastus">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <button type="button"
                                        class="btn btn-raised btn-blue btn-default fix-margin-left pull-left">Nimekiri
                                </button>
                                <button type="button"
                                        class="btn btn-raised btn-green btn-default fix-margin-right pull-right" disabled>Vasta
                                </button>
                                <button type="button" class="btn btn-raised btn-bronze btn-default pull-right">Edasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 margin-50-lg">
                    <button type="button" class="btn btn-success btn-default btn-lg" data-toggle="modal" data-target="#hint-dialog">
                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                    </button>

                    <button type="button" class="btn btn-danger btn-default" data-toggle="modal" data-target="#confirm-dialog" data-backdrop="static" data-keyboard="false">
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
                    <button id="showAnswer" type="button" class="btn btn-danger btn-raised" data-dismiss="modal" onclick="showAnswer()">Näita vastust</button>
                </div>
            </div>
        </div>
    </div>

@endsection
