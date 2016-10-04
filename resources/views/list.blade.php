@extends('layouts.main')
@section('title', 'Matemaatika')


@section('content')
    <div class="content margin-vert-30">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <H1> Lihtne</H1>
                    <table class="table table-striped table-hover ">
                        <thead>
                        </thead>
                        <tbody>
                        <tr class="info">
                            <td>Ülesanne 1</td>
                        </tr>
                        <tr class="info">
                            <td><a href="ulesanne">Ülesanne 2</a></td>
                        </tr>
                        <tr class="info">
                            <td>Ülesanne 3</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 4</td>

                        </tr>
                        <tr class="info">
                            <td>Ülesanne 5</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 6</td>

                        </tr>
                        <tr class="success">
                            <td>Ülesanne 7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4"
                     style="padding-right:20px; padding-left:20px; border-left: 1px solid #ccc; border-right: 1px solid #ccc;">
                    <H1> Keskmine</H1>
                    <table class="table table-striped table-hover ">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ülesanne</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ülesanne</td>
                        </tr>
                        <tr class="info">
                            <td>3</td>
                            <td>Ülesanne</td>

                        </tr>
                        <tr class="success">
                            <td>4</td>
                            <td>Ülesanne</td>

                        </tr>
                        <tr class="danger">
                            <td>5</td>
                            <td>Ülesanne</td>

                        </tr>
                        <tr class="warning">
                            <td>6</td>
                            <td>Ülesanne</td>

                        </tr>
                        <tr class="active">
                            <td>7</td>
                            <td>Ülesanne</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <H1> Raske</H1>
                </div>
            </div>
        </div>
    </div>
@endsection