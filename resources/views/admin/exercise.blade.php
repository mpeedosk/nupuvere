@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Ülesannete haldus')


@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            @if(session('exercise-create'))
                <script>
                    $(function () {
                        toastr.success('Ülesanne "{{session('exercise-create')}}" edukalt lisatud');
                    });
                </script>
            @endif
            <div class="row">
                <h2>Lisa uus: </h2>

                <div class="list-group">

                    <div class="list-group-item">
                        <a href="/admin/exercise/create/1" class="list-group-item-heading">
                            <span class="fa fa-fw fa-quote-left" aria-hidden="true"></span>
                            Tekstiline/numbriline</a>
                    </div>

                    <div class="list-group-item">
                        <a href="/admin/exercise/create/2" class="list-group-item-heading">
                            <span class="fa fa-fw fa-check-circle-o" aria-hidden="true"></span>
                            Valikvastusega - üks õige</a>
                    </div>

                    <div class="list-group-item">
                        <a href="/admin/exercise/create/3" class="list-group-item-heading">
                            <span class="fa fa-fw fa-check-square" aria-hidden="true"></span>
                            Valikvastusega - mitu õiget</a>
                    </div>

                    <div class="list-group-item botto">
                        <a href="/admin/exercise/create/4" class="list-group-item-heading">
                            <span class="fa fa-fw fa-sort-amount-asc" aria-hidden="true"></span>
                            Järjestamine</a>
                    </div>
                </div>

                <h2 class="table-title">Ülesanded</h2>
                <table id="table"
                       data-toggle="table"
                       data-search="true"
                       data-show-columns="true"
                       data-pagination="true"
                       data-id-field="id"
                       data-striped="true"
                       class="hidden-start"
                >
                    <thead>
                    <tr>
                        <th data-sortable="true">ID</th>
                        <th class="col-md-2" data-sortable="true">Peakiri</th>
                        <th data-sortable="true">Kategooria</th>
                        <th data-sortable="true">Vanuserühm</th>
                        <th data-sortable="true">Raskusaste</th>
                        <th data-sortable="true">Lahendatud</th>
                        <th data-sortable="true">Proovitud</th>
                        <th data-sortable="true">%</th>
                        <th class="col-md-3">Tegevus</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($exercises as $exercise)
                        <tr id="ex-{{$exercise->id}}">
                            <td>{{$exercise -> id}}</td>
                            <td>
                                <a href="/{{$exercise->category.'/'.$exercise->age_group.'/'.$exercise->difficulty.'/'.$exercise->id}}"
                                   target="_blank"> {{$exercise -> title}}</a></td>
                            <td>{{$exercise -> category}}</td>
                            <td>{{$exercise -> age_group}}</td>
                            <td>{{$exercise -> difficulty}}</td>
                            <td>{{$exercise -> solved}}</td>
                            <td>{{$exercise -> attempted}}</td>
                            <td>{{$exercise -> attempted == 0 ? 0 : ceil(($exercise -> solved)/($exercise -> attempted)*100)}}</td>
                            <td class="text-center">
                                <a href="/admin/exercise/edit/{{$exercise->id}}" class="btn btn-info btn-raised btn-sm"
                                   type="button" data-toggle="tooltip"
                                   title="Muuda">
                                    <span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span>
                                </a>

                                <button
                                        class="btn btn-danger btn-raised btn-sm" data-toggle="tooltip"
                                        title="Kustuta"
                                        onclick="showExerciseConfirm('{{$exercise->id}}', '{{$exercise->title}}')">
                                    <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                                </button>

                                <a href="/exercise/hide/{{$exercise->id}}" class="btn btn-default btn-raised btn-sm"
                                   type="button" data-toggle="tooltip"
                                   title="Peida">
                                    <span class="glyphicon glyphicon-eye-close pull-right" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div id="confirm-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  panel panel-danger">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-alert" aria-hidden="true"></span>
                    <h4 class="panel-title">Kinnitus</h4>
                </div>
                <div class="modal-body">
                    <p>Olete kindel, et tahate "<strong id="confirm-exercise-name"></strong>" kustutada?</p>
                    <p>Seda tegevust ei saa hiljem tagasi võtta</p>
                    <span class="hidden" id="confirm-exercise-id"></span>
                </div>
                <div class="panel-footer">

                    <button type="button" class="btn btn-blue btn-raised" data-dismiss="modal">Tühista</button>
                    <button id="showAnswer" type="submit" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal" onclick="deleteExercise()">Kustuta
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection