@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Administraatorite ülevaade')


@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            @if(session('toast'))
                <script>
                    $(function () {
                        toastr.success('{{session('toast')}}');
                    });
                </script>
            @endif
            <div class="row">
                <h2>Loo uus kasutaja: </h2>

                <div class="list-group">

                    <div class="list-group-item">
                        <a href="/admin/admins/create" class="list-group-item-heading">
                            <span class="fa fa-fw fa-plus" aria-hidden="true"></span>
                            Admin/Moderaator</a>
                    </div>
                </div>

                <h2 class="table-title">Administraatorite andmed</h2>
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
                        <th class="col-md-2" data-sortable="true">Kasutajanimi</th>
                        <th>Eesnimi</th>
                        <th>Perenimi</th>
                        <th>E-post</th>
                        <th data-sortable="true">Roll</th>
                        <th class="col-md-3">Tegevus</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($admins as $admin)
                        <tr id="ex-{{$admin->id}}">
                            <td>{{$admin -> id}}</td>
                            <td>{{$admin -> username}}</td>
                            <td>{{$admin -> first_name}}</td>
                            <td>{{$admin -> last_name}}</td>
                            <td>{{$admin -> email}}</td>
                            <td>@if($admin -> role === 2) Moderaator @else Administraator @endif</td>
                            <td class="text-center">
                                <a href="/admin/admins/edit/{{$admin->id}}" class="btn btn-info btn-raised btn-sm"
                                   type="button" data-toggle="tooltip"
                                   title="Muuda">
                                    <span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span>
                                </a>
                                <button
                                        class="btn btn-danger btn-raised btn-sm" data-toggle="tooltip"
                                        title="Kustuta"
                                        onclick="showUserConfirm('{{$admin->id}}', '{{$admin->username}}')">
                                    <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                                </button>
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
                    <p>Olete kindel, et tahate kasutaja "<strong id="confirm-user-name"></strong>" kustutada?</p>
                    <p>Seda tegevust ei saa hiljem tagasi võtta</p>
                    <span class="hidden" id="confirm-user-id"></span>
                </div>
                <div class="panel-footer">

                    <button type="button" class="btn btn-blue btn-raised" data-dismiss="modal">Tühista</button>
                    <button id="showAnswer" type="submit" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal" onclick="deleteUser()">Kustuta
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection