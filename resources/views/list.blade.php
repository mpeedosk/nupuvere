@extends('layouts.main')
@section('title', 'Matemaatika')


@section('content')
    <div class="content margin-vert-30">
        <div class="container">
            {{--<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: -20px; background: none">--}}
                {{--<li><a href="javascript:void(0)">{{$cate}}</a></li>--}}
                {{--<li class="active">{{$group}}</li>--}}
                {{--<li class="active">{{$cat_id}}</li>--}}
            {{--</ul>--}}
            <div class="row text-center">

                <div class="col-md-4">

                    <H1> Lihtne</H1>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        </thead>
                        <tbody>

                        @foreach($easyEx as $exercise)
                            <tr class="info">
                                <td><a href="/{{$category}}/{{$age_group}}/lihtne/{{$exercise -> id}}">{{$exercise -> title}}</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-md-4"
                     style="padding-right:20px; padding-left:20px; border-left: 1px solid #ccc; border-right: 1px solid #ccc;">
                    <H1> Keskmine</H1>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                            <span class="sr-only">20% Complete</span>
                        </div>
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        </thead>
                        <tbody>
                        @foreach($mediumEx as $exercise)
                            <tr class="info">
                                <td><a href="/{{$category}}/{{$age_group}}/keskmine/{{$exercise -> id}}">{{$exercise -> title}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <H1> Raske</H1>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        </thead>
                        <tbody>
                        @foreach($hardEx as $exercise)
                            <tr class="info">
                                <td><a href="/{{$category}}/{{$age_group}}/raske/{{$exercise -> id}}">{{$exercise -> title}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection