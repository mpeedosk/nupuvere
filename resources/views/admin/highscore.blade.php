@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Kategooria haldus')
@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            <div class="row category-table">
                <div class="tabs">
                    <ul class="nav nav-tabs tab-nav">
                        <li class="active"><a href="#current" data-toggle="tab">Jooksev aasta</a></li>
                        <li><a href="#all-time" data-toggle="tab">Läbi aegade</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="current">
                            <h2 class="table-title margin-top-20">Jooksev aasta</h2>
                            <button class="btn btn-primary btn-raised inline-block pull-right"
                                    onclick='$("#reset-dialog").modal()'>
                                Lähtesta punktid
                            </button>
                            <table
                                    data-toggle="table"
                                    data-show-columns="true"
                                    data-striped="true"
                                    data-search="true">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="col-md-1" data-sortable="true">Koht</th>
                                    <th class="col-md-1">Punktid</th>
                                    <th class="col-md-2">Kasutajanimi</th>
                                    <th class="col-md-2" data-sortable="true">Eesnimi</th>
                                    <th class="col-md-2" data-sortable="true">Perenimi</th>
                                    <th class="col-md-2" data-sortable="true">Meiliaadress</th>
                                    <th class="col-md-1">Tegevus</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($this_year as $user)
                                    <tr id="ty-{{$user->id}}">
                                        <td>{{$user->id}}</td>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$user -> points_this_year}}</td>
                                        <td>{{$user -> username}}</td>
                                        <td>{{$user -> first_name}}</td>
                                        <td>{{$user -> last_name}}</td>
                                        <td>{{$user -> email}}</td>
                                        <td class="text-center">
                                            <button
                                                    class="btn btn-danger btn-raised btn-sm" data-toggle="tooltip"
                                                    title="Kustuta"
                                                    onclick="showUserConfirm('{{$user->id}}', '{{$user->username}}')">
                                                <span class="glyphicon glyphicon-remove pull-right"
                                                      aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="all-time">
                            <h2 class="table-title margin-top-20">Läbi aegade</h2>
                            <table
                                    data-toggle="table"
                                    data-show-columns="true"
                                    data-striped="true"
                                    data-search="true">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="col-md-1" data-sortable="true">Koht</th>
                                    <th class="col-md-1">Punktid</th>
                                    <th class="col-md-2">Kasutajanimi</th>
                                    <th class="col-md-2" data-sortable="true">Eesnimi</th>
                                    <th class="col-md-2" data-sortable="true">Perenimi</th>
                                    <th class="col-md-2" data-sortable="true">Meiliaadress</th>
                                    <th class="col-md-1">Tegevus</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_time as $user)
                                    <tr id="at-{{$user->id}}">
                                        <td>{{$user->id}}</td>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$user -> points}}</td>
                                        <td>{{$user -> username}}</td>
                                        <td>{{$user -> first_name}}</td>
                                        <td>{{$user -> last_name}}</td>
                                        <td>{{$user -> email}}</td>
                                        <td class="text-center">
                                            <button
                                                    class="btn btn-danger btn-raised btn-sm" data-toggle="tooltip"
                                                    title="Kustuta"
                                                    onclick="showUserConfirm('{{$user->id}}', '{{$user->username}}')">
                                                <span class="glyphicon glyphicon-remove pull-right"
                                                      aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                    <button type="submit" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal" onclick="deleteUser()">Kustuta
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="reset-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  panel panel-danger">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-alert" aria-hidden="true"></span>
                    <h4 class="panel-title">Kinnitus</h4>
                </div>
                <div class="modal-body">
                    <p>Olete kindel, et tahate kõik viimase aasta punktid lähtestada?</p>
                    <p>Seda tegevust ei saa hiljem tagasi võtta</p>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-blue btn-raised" data-dismiss="modal">Tühista</button>
                    <form class="inline" method="POST" action="/admin/highscore/reset">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-raised pull-right">Lähtesta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    @if(session('toast'))
        <script>
            $(function () {
                toastr.success('{{session('toast')}}');
            });
        </script>
    @endif
@endsection