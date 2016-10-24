@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Pealehe muutmine | Galerii | Logod | Kontakt')


@section('content')
    <section class="admin-page-content">
        <div class="container">
            <form>
                <div class="row category-table">
                    <h2>Kategooriad</h2>
                    <table data-toggle="table"
                    >
                        <thead>
                        <tr>
                            <th class="col-md-1" data-sortable="true">ID</th>
                            <th class="col-md-6">Nimi</th>
                            <th class="col-md-1" data-sortable="true" data-editable="true">Järjekord</th>
                            <th class="col-md-4">Tegevus</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>12</td>
                            <td>Matemaatika</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="1"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Füüsika</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="2"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>
                        <tr>
                            <td>32</td>
                            <td>Keemia</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="3"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>
                        <tr>
                            <td>42</td>
                            <td>Bioloogia</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="4"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>
                        <tr>
                            <td>52</td>
                            <td>Geograafia</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="5"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>
                        <tr>
                            <td>62</td>
                            <td>Ajalugu</td>
                            <td><input type="number" name="quantity" min="1" max="6" value="6"></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-raised btn-sm"> Kustuta <span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row category-row">
                    <div class="col-md-4 col-md-offset-8 text-center margin-bottom-20 margin-top-20">
                        <button class="btn btn-info btn-raised " type="submit"> Salvesta</button>
                    </div>
                </div>
            </form>
            <form>
                <div class="row category-row">
                    <div class="col-md-4 col-md-offset-8 text-center">
                        <label for="newCategory" class="font-size-lg">Kategooria nimi: </label>
                        <br>
                        <input id="newCategory" type="text">
                        <br>
                        <button class="btn btn-success btn-raised margin-top-20" type="submit"> Lisa uus</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection