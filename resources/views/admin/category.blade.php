@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Kategooriad | Lisamine | Muutmine | Kustutamine')


@section('content')
    @if(Session::has('category-create'))
        <script>
            $(function() {
                toastr.success('Kategooria {{str_replace('_', ' ', ucfirst(Session::get('category-create')))}} edukalt lisatud!');
            });
        </script>
    @elseif(Session::has('category-update'))
        <script>
            $(function() {
                toastr.success('Kategooriad edukalt uuendatud!');
            });
        </script>
    @endif

    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            <form action="/categories/update" method="POST">
                {{ method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="row category-table">
                    <h2>Kategooriad</h2>
                    <table data-toggle="table"
                           id="table"
                           class="hidden-start"
                    >
                        <thead>
                        <tr>
                            <th class="col-md-1" data-sortable="true">ID</th>
                            <th class="col-md-6">Nimi</th>
                            <th class="col-md-1" data-sortable="true">Järjekord</th>
                            <th class="col-md-4">Tegevus</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr id="cat-{{$category->id}}">
                                <td>{{$category->id}}</td>
                                <td>{{ str_replace('_', ' ', ucfirst($category->name) )}}</td>
                                <td><input type="number" min="1" max="{{$count}}"
                                           value="{{$category->order}}" name="{{$category->name}}"></td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-raised btn-sm" type="button"
                                            onclick="showCategoryConfirm({{$category->id}}, '{{ str_replace('_', ' ', ucfirst($category->name) )}}')"
                                    > Kustuta <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row category-row">
                    <div class="col-md-4 col-md-offset-8 text-center margin-bottom-20 margin-top-20">
                        <button class="btn btn-info btn-raised " type="submit"> Salvesta</button>
                    </div>
                </div>
            </form>
            <form method="POST" action="/categories/add">
                {{ csrf_field() }}
                <div class="row category-row">
                    <div class="col-md-4 col-md-offset-8 text-center">
                        <label for="newCategory" class="font-size-lg">Kategooria nimi: </label>
                        <br>
                        <input id="newCategory" type="text" name="name" value="{{old('name')}}">
                        <br>
                        <button class="btn btn-success btn-raised margin-top-20" type="submit"> Lisa uus</button>

                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </form>
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
                    <p>Olete kindel, et tahate kategooria <strong id="confirm-category-name"></strong> kustutada?</p>
                    <span class="hidden" id="confirm-category-id">5</span>
                </div>
                <div class="panel-footer">
                    {{--<form method="POST" action="/categories/delete/">--}}

                    <button type="button" class="btn btn-blue btn-raised" data-dismiss="modal">Tühista</button>
                    <button id="showAnswer" type="submit" class="btn btn-danger btn-raised pull-right"
                            data-dismiss="modal" onclick="deleteCategory()">Kustuta
                    </button>

                    {{--                        {{ method_field('DELETE')}}
                                            {{ csrf_field() }}
                                        </form>--}}
                </div>
            </div>
        </div>
    </div>


@endsection