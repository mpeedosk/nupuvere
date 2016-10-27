@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Ülesannete ülevaade')


@section('content')
    @if(Session::has('toast'))
        <script>
            $(function () {
                toastr.success('Kategooriad edukalt uuendatud!');
            });
        </script>
    @elseif(Session::has('category-update'))
        <script>
            toastr.success('Kategooriad edukalt uuendatud!');
        </script>
    @endif

    <section class="admin-page-content">
        <div class="container">
            <div class="row">
                <h2>Lisa uus: </h2>

                <div class="list-group">
                    <div class="list-group-item">
                        <a href="/exercise/text" class="list-group-item-heading">
                            <span class="fa fa-fw fa-quote-left" aria-hidden="true"></span>
                            Tekstiline/numbriline</a>
                    </div>
                    <div class="list-group-item">
                        <a href="#" class="list-group-item-heading">
                            <span class="fa fa-fw fa-check-circle-o" aria-hidden="true"></span>
                            Valikvastusega - üks õige</a>
                    </div>
                    <div class="list-group-item">
                        <a href="#" class="list-group-item-heading">
                            <span class="fa fa-fw fa-check-square" aria-hidden="true"></span>
                            Valikvastusega - mitu õiget</a>
                    </div>
                    <div class="list-group-item botto">
                        <a href="#" class="list-group-item-heading">
                            <span class="fa fa-fw fa-sort-amount-asc" aria-hidden="true"></span>
                            Järjestamine</a>
                    </div>

                </div>

                <h2 class="table-title" >Ülesanded</h2>
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
                        <tr>
                            <td>{{$exercise -> id}}</td>
                            <td><a href="/{{$exercise->category.'/'.$exercise->age_group.'/'.$exercise->difficulty.'/'.$exercise->id}}"
                                   target="_blank"> {{$exercise -> title}}</a></td>
                            <td>{{$exercise -> category}}</td>
                            <td>{{$exercise -> age_group}}</td>
                            <td>{{$exercise -> difficulty}}</td>
                            <td>{{$exercise -> solved}}</td>
                            <td>{{$exercise -> attempted}}</td>
                            <td>{{$exercise->attempted == 0 ? 0 : ceil(($exercise -> solved)/($exercise -> attempted)*100)}}</td>
                            <td class="text-center">
                                <button class="btn btn-info btn-raised btn-sm" type="button" data-toggle="tooltip"
                                        title="Muuda">
                                    <span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span>
                                </button>
                                <button class="btn btn-danger btn-raised btn-sm" type="button" data-toggle="tooltip"
                                        title="Kustuta">
                                    <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                                </button>
                                <button class="btn btn-default btn-raised btn-sm" type="button" data-toggle="tooltip"
                                        title="Peida">
                                    <span class="glyphicon glyphicon-eye-close pull-right" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>



@endsection