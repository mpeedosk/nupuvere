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
                            <H2 class="text-left no-margin">Ülesanne 2</H2>
                        </div>
                        <div class="col-md-12 animate fadeInLeft animated">
                            <div class="ex-text-area font-size-md">
                                <div class="padding-10" align="left">
                                    Retseptis oli öeldud, et antud kogustega tuleb hea ja õige paksusega kook, kui
                                    kasutada küpsetusplaati mõõtmetega 20cm x 28cm. Kertu tahtis teha sama paksu kooki,
                                    aga tema küpsetusplaat oli mõõtmetega 24cm x 35cm. Mitu grammi peab Kertu taignasse
                                    võid panema, kui retseptis on öeldud, et võid tuleb panna 150 grammi?
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
                                        class="btn btn-raised btn-green btn-default fix-margin-right pull-right">Vasta
                                </button>
                                <button type="button" class="btn btn-raised btn-bronze btn-default pull-right">Edasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 margin-50-lg">
                    <button type="button" class="btn btn-success btn-default btn-lg">
                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> vihje
                    </button>
                    <button type="button" class="btn btn-danger btn-default">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> vastus
                    </button>
                    <p class="font-size-sm">
                        Koostanud Ahhaa
                    </p>
                </div>


            </div>
        </div>
    </div>
@endsection
