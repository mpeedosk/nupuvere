@extends('layouts.main')
@section('title', 'Edetabel')


@section('content')
    <section class="content margin-vert-30">
        <div class="se-pre-con"></div>
        <div class="container">
            <div id="leaderboard" class="row text-center" style="display: none">
                <div class="col-md-6">
                    <h2>Jooksev aasta</h2>
                    <hr>
                    <table id="table"
                           data-toggle="table"
                           data-striped="true"
                           class="hidden-start">
                        <thead>
                        <tr>
                            <th class="col-md-2" data-sortable="true">Koht</th>
                            <th class="col-md-6">Kasutajanimi</th>
                            <th class="col-md-4">Punktid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($this_year as $user)
                            <tr>
                                <td>{{$loop -> iteration}}</td>
                                <td>{{$user -> username}}</td>
                                <td>{{$user -> points_this_year}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h2>Läbi aegade</h2>
                    <hr>
                    <table id="table"
                           data-toggle="table"
                           data-striped="true"
                           class="hidden-start">
                        <thead>
                        <tr>
                            <th class="col-md-2" data-sortable="true">Koht</th>
                            <th class="col-md-6">Kasutajanimi</th>
                            <th class="col-md-4">Punktid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_time as $user)
                            <tr>
                                <td>{{$loop -> iteration}}</td>
                                <td>{{$user -> username}}</td>
                                <td>{{$user -> points}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">
@endsection
@section('scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".se-pre-con").fadeOut("slow");
            $("#leaderboard").fadeIn("slow");
        });
    </script>
@endsection