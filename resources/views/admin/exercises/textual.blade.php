@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Tekstiline/numbriline')


@section('content')
    @if(Session::has('exercise-create'))
        <script>
            $(function () {
                toastr.success('Ülesanne "{{Session::get('exercise-create')}}" edukalt lisatud');
            });
            console.log('{{Session::get('exercise-create')}}')
        </script>
    @endif

    <section class="admin-page-content">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        <div class="container">
            <div class="row margin-30">
                <form method="POST" action="/exercise/text/new">
                    {{ csrf_field() }}

                    <div class="form-group label-floating short-input">
                        <label for="ex_title" class="control-label "><span class="fa fa-fw fa-asterisk"
                                                                        aria-hidden="true"></span> Ülesande
                            pealkiri</label>
                        <input class="form-control" id="ex_title" name="ex_title">
                        <span class="help-block color-default">Pealkirjad ei tohi korduda</span>
                    </div>

                    <div class="form-group label-floating short-input">
                        <label for="ex_authro" class="control-label"><span class="fa fa-fw" aria-hidden="true"></span>
                            Ülesande autor</label>
                        <input class="form-control" id="ex_author" name="ex_author">
                        <span class="help-block color-default">See väli ei ole kohustuslik</span>
                    </div>

                    <div class="form-group label-static">
                        <label for="ex_content" class=""><span class="fa fa-fw fa-asterisk"
                                                            aria-hidden="true"></span>Ülesande püstitus</label>
                        <textarea class="form-control" id="ex_content" name="ex_content"></textarea>
                    </div>

                    <div class="form-group label-static">
                        <label for="ex_solution" class=""><span class="fa fa-fw"
                                                               aria-hidden="true"></span>Lahenduskäik</label>
                        <textarea class="form-control" id="ex_solution" name="ex_solution"></textarea>
                    </div>

                    <div class="form-group label-static">
                        <label for="ex_hint" class=""><span class="fa fa-fw"
                                                         aria-hidden="true"></span>Lisa vihje</label>

                        <textarea class="form-control" id="ex_hint" name="ex_hint"></textarea>
                    </div>
                    <div class="form-group label-static">
                        <label for="answer_count" class=""><span class="fa fa-fw fa-asterisk"
                                                       aria-hidden="true"></span>Lisa vastus</label>
                        <input id="answer_count" class="hidden" name="answer_count" value="3">
                    </div>

                    <div id="answers">
                        <div class="form-group" id="answer_group_1">
                            <label class="" for="a1"> Vastus 1</label>
                            <input class="form-control" id="a1" name="answer_1">
                        </div>

                        {{--<div class="form-group" id="answer_group_2">
                            <label for="a2"> Vastus 2</label>
                            <button class="btn btn-danger btn-sm margin-bottom-15  btn_remove" type="button" data-toggle="tooltip"
                                    title="Eemalda" name="remove" id="2" tabindex="-1">
                                <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                            </button>
                            <input class="form-control" id="a2" name="answer_2">
                        </div>
--}}
                    </div>

                    <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua" onclick="addAnswer(1)">
                        <span class="glyphicon glyphicon-plus">  </span> Lisa veel üks vastus
                    </button>

                    <div class="form-group">
                        <label class=""><span class="fa fa-fw fa-asterisk"
                                              aria-hidden="true"></span>Kategooria: </label>
                        <select class="form-control dropdown-input" name="category">
                            <option value="matemaatika">Matemaatika</option>
                            <option value="füüsika">Füüsika</option>
                            <option value="keemia">Keemia</option>
                            <option value="bioloogia">Bioloogia</option>
                            <option value="ajalugu">Ajalugu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class=""><span class="fa fa-fw fa-asterisk"
                                              aria-hidden="true"></span>Vanuseklass: </label>
                        <select class="form-control dropdown-input" name="age_group">
                            <option value="avastaja">Avastajad (... - 2kl)</option>
                            <option value="uurija">Uurijad (3. - 6. kl)</option>
                            <option value="teadja">Teadjad (7. - 9. kl)</option>
                            <option value="ekspert">Eksperdid (10. - 12. kl)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class=""><span class="fa fa-fw fa-asterisk"
                                              aria-hidden="true"></span>Raskusaste: </label>
                        <select class="form-control dropdown-input" name="difficulty">
                            <option value="lihtne">Lihtne</option>
                            <option value="keskmine">Keskmine</option>
                            <option value="raske">Raske</option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-indigo">
                        Lisa ülesanne
                    </button>
                </form>
            </div>
        </div>

    </section>



@endsection