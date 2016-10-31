@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Kategooria haldus')

@section('scripts')


@endsection

@section('content')
    @if(Session::has('category-create'))
        <script>
            $(function () {
                toastr.success('Kategooria {{str_replace('_', ' ', ucfirst(Session::get('category-create')))}} edukalt lisatud!');
            });
        </script>
    @elseif(Session::has('category-update'))
        <script>
            $(function () {
                toastr.success('Kategooriad edukalt uuendatud!');
            });
        </script>
    @endif


    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">


            <div class="row category-table">
                <h2>Uus kategooria: </h2>
                <form method="POST" action="/categories/add">
                    {{ csrf_field() }}

                    {{----}}
                    <div class="form-group label-floating new-category">
                        <div class="input-group short-input">
                            <label class="control-label" for="newCategory">Kategooria nimi:</label>
                            <input type="text" id="newCategory" class="form-control" name="name"
                                   value="{{old('name')}}">
                            <span class="input-group-addon">
                                    <input class="color btn btn-sm btn-raised" name="color"
                                           value="#5e70d4" maxlength="7"/>
                                </span>

                            <span class="input-group-btn">
                                    <button class="btn btn-success btn-raised btn-sm"
                                            type="submit"> Lisa uus</button>
                                </span>
                        </div>
                        {{----}}

                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </form>

                <form action="/categories/update" method="POST">

                    {{ method_field('PATCH')}}
                    {{ csrf_field() }}
                    <h2>Kategooriad</h2>
                    <table data-toggle="table"
                           id="table"
                           class="hidden-start"
                    >
                        <thead>
                        <tr>
                            <th class="col-md-1" data-sortable="true">ID</th>
                            <th class="col-md-5">Nimi</th>
                            <th class="col-md-1">Värv</th>
                            <th class="col-md-1" data-sortable="true">Järjekord</th>
                            <th class="col-md-4">Tegevus</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr id="cat-{{$category->id}}">
                                <td>{{$category->id}} </td>
                                <td>{{ str_replace('_', ' ', ucfirst($category->name) )}}</td>
                                <td>
                                    <div class="input-toggles wrapper">
                                        <input class="color" name="cp-{{$category->name}}" value="{{$category->color}}"
                                               maxlength="7"/>
                                    </div>
                                </td>
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