@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Ülesannete haldus')
@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
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
                <form class="inline pull-right" method="POST" action="/admin/exercise/export" onsubmit="exportStart()">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-raised pull-right">Ekspordi
                    </button>
                </form>
                <form id="import-form" class="inline pull-right" method="POST"
                      action="/admin/exercise/import"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group hidden">
                        <input hidden class="form-control upload-input"
                               type="file" id="import" multiple="" name="import">
                    </div>
                    <button type="submit" class="inline btn btn-primary btn-raised" onclick='event.preventDefault();$("#import").click()'>
                        <span class="spinner"><span class="md-spinner md-spinner-white"></span></span>
                        <span class="md-spinner-text">Impordi</span>
                    </button>
                </form>
                <table id="table"
                       data-toggle="table"
                       data-search="true"
                       data-show-columns="true"
                       data-pagination="true"
                       data-page-size="25"
                       data-unique-id="id"
                       data-striped="true">
                    <thead>
                    <tr>
                        <th data-field="id" data-sortable="true">ID</th>
                        <th class="col-md-2" data-field="title" data-sortable="true">Pealkiri</th>
                        <th data-field="category" data-sortable="true">Kategooria</th>
                        <th data-field="age_group" data-sortable="true">Vanuserühm</th>
                        <th data-field="difficulty" data-sortable="true">Raskusaste</th>
                        <th data-field="solved" data-sortable="true">Lahendatud</th>
                        <th data-field="attempted" data-sortable="true">Proovitud</th>
                        <th data-field="percent" data-sortable="true">%</th>
                        <th data-field="action" class="col-md-3 text-center">Tegevus</th>
                    </thead>
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
                    <button type="submit" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal" onclick="deleteExercise()">Kustuta
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    @if(session('exercise-create'))
        <script>
            $(function () {
                toastr.success('Ülesanne "{{session('exercise-create')}}" edukalt lisatud');
            });
        </script>
    @endif

    @if(session('toast'))
        <script>
            $(function () {
                toastr.success('{{session('toast')}}');
            });
        </script>
    @endif
    @if(session('info'))
        <script>
            $(function () {
                toastr.info('{{session('info')}}');
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            $(function () {
                toastr.error('{{session('error')}}');
            });
        </script>
    @endif
    <script>
        var data = [
                @foreach($exercises as $exercise)
            {
                "id": "{{$exercise -> id}}",
                "title": '<a href="/{{$exercise->category}}/{{$exercise->age_group}}/{{$exercise->difficulty}}/{{$exercise->id}}" target="_blank">{{$exercise -> title}}</a>',
                "category": "{{$exercise -> category}}",
                "age_group": "{{$exercise -> age_group}}",
                "difficulty": "{{$exercise -> difficulty}}",
                "solved": "{{$exercise -> solved}}",
                "attempted": "{{$exercise -> attempted}}",
                "percent": "{{$exercise -> attempted == 0 ? 0 : ceil(($exercise -> solved)/($exercise -> attempted)*100)}}",
                'action': '<a href="/admin/exercise/edit/{{$exercise->id}}" class="btn btn-info btn-raised btn-sm" type="button" data-toggle="tooltip" title="Muuda">' +
                '<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>   ' +
                '<button class="btn btn-danger btn-raised btn-sm" data-toggle="tooltip" title="Kustuta" onclick="showExerciseConfirm(\'{{$exercise->id}}\', \'{{$exercise->title}}\')">' +
                '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></button>   ' +
                '<form class="inline-block" method="POST" action="/admin/exercise/hide/{{$exercise->id}}">{{ csrf_field() }}' +
                @if(!$exercise->hidden)
                    '<button class="btn btn-success btn-raised btn-sm" type="submit" data-toggle="tooltip" title="Peida"><span class="glyphicon glyphicon-eye-close pull-right color-black" aria-hidden="true"></span></button>' +
                @else
                    '<button class="btn btn-default btn-raised btn-sm" type="submit" data-toggle="tooltip" title="Tee nähtavaks"><span class="glyphicon glyphicon-eye-open pull-right" aria-hidden="true"></span></button>' +
                @endif
                    '</form>'

            },
            @endforeach
        ];

        $(function () {
            $('#table').bootstrapTable({
                data: data
            });
        });
    </script>
@endsection
