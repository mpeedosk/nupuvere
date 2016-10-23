@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Pealehe muutmine | Galerii | Logod | Kontakt')


@section('content')
    <section class="admin-page-content">
        <div class="container">
            <div class="row vert-full full-height">
                <div class="col-md-6 vert-full text-center">
                    <div class="col-md-12 ">
                        <h1>Galerii
                            <span class="glyphicon glyphicon-question-sign icon-help" aria-hidden="true"
                                  data-toggle="modal" data-target="#gallery-help"></span>
                        </h1>

                        <hr>
                        <form method="POST" action="/admin/upload/gallery" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 img-box">
                                    <div class="form-group no-padding no-margin">
                                        <input type="file" id="inputGallery1" multiple="" name="gallery1">
                                        <span class="glyphicon glyphicon-open upload-icon"
                                              aria-hidden="true"></span>
                                        <input type="text" readonly="" class="form-control upload-input"
                                               placeholder="Pilt 1">
                                        <img src="/img/gallery/gallery1.png" alt="gallery1">
                                    </div>
                                </div>
                                <div class="col-md-6 img-box">
                                    <div class="form-group no-padding no-margin">
                                        <input type="file" id="inputgallery2" multiple="" name="gallery2">
                                        <span class="glyphicon glyphicon-open upload-icon"
                                              aria-hidden="true"></span>
                                        <input type="text" readonly="" class="form-control upload-input"
                                               placeholder="Pilt 2">
                                        <img src="/img/gallery/gallery2.png" alt="gallery2">
                                    </div>
                                </div>
                                <div class="col-md-6 img-box">
                                    <div class="form-group no-padding no-margin">
                                        <input type="file" id="inputgallery3" multiple="" name="gallery3">
                                        <span class="glyphicon glyphicon-open upload-icon"
                                              aria-hidden="true"></span>
                                        <input type="text" readonly="" class="form-control upload-input"
                                               placeholder="Pilt 3">
                                        <img src="/img/gallery/gallery3.png" alt="gallery3">
                                    </div>

                                </div>
                                <div class="col-md-6 img-box">
                                    <div class="form-group no-padding no-margin">
                                        <input type="file" id="inputgallery4" multiple="" name="gallery4">
                                        <span class="glyphicon glyphicon-open upload-icon"
                                              aria-hidden="true"></span>
                                        <input type="text" readonly="" class="form-control upload-input"
                                               placeholder="Pilt 4">
                                        <img src="/img/gallery/gallery4.png" alt="gallery4">
                                    </div>

                                </div>
                                <div class="col-md-6 col-md-offset-3 img-box">
                                    <div class="form-group no-padding no-margin" >
                                        <input type="file" id="inputgallery5" multiple="" name="gallery5">
                                        <span class="glyphicon glyphicon-open upload-icon"
                                              aria-hidden="true"></span>
                                        <input type="text" readonly="" class="form-control upload-input"
                                               placeholder="Pilt 5">
                                        <img src="/img/gallery/gallery5.png" alt="gallery5">
                                    </div>
                                    <button class="btn btn-primary btn-raised" type="submit">Uuenda
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-6 vert-full text-center full-height">
                    <div class="col-md-12 vert-half">
                        <h1>Logod<span class="glyphicon glyphicon-question-sign icon-help" aria-hidden="true"
                                       data-toggle="modal" data-target="#logo-help"></span></h1>
                        <hr>
                        <form method="POST" action="/admin/upload/logo" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group no-padding no-margin has-feedback">
                                <input type="file" id="inputLogos" multiple="" name="logo-footer">
                                <span class="glyphicon glyphicon-open upload-icon"
                                      aria-hidden="true"></span>
                                <input type="text" readonly="" class="form-control upload-input"
                                       placeholder="Logod">
                                <img class="sponsors" src="/img/logo/footer.png" alt="Logo"/>
                            </div>

                            <button class="btn btn-primary btn-raised" type="submit">Uuenda
                            </button>
                        </form>

                    </div>
                    <div class="col-md-12 vert-half text-center">
                        <h1>Kontakt</h1>
                        <hr>
                        <form>
                            <textarea class="ex-text-area" rows="5">Telephone:1-800-123-4567
Email: info@example.com
Website: www.example.com</textarea>
                            <button class="btn btn-primary btn-raised" type="submit">Uuenda
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div id="gallery-help" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Galerii uuendamine</h4>
                </div>
                <div class="modal-body font-size-lg" style="text-align: justify">
                    <p>Uuendatavate piltide mõõtmed peaksid olema 1080 x 422 pikselit. Pärast faili üleslaadimist süsteem
                        automaatselt muudab dimensioone. Seega, kui laadida üles pilt, mille mõõtmed ei ole vastavad,
                        võib see esilehel näha teistmoodi välja.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>

    <div id="logo-help" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Logo uuendamine</h4>
                </div>
                <div class="modal-body font-size-lg" style="text-align: justify">
                    <p>Logo suurus peaks olema 810 x 140. Pärast faili üleslaadimist süsteem
                        automaatselt muudab dimensioone. Seega, kui laadida üles pilt, mille mõõtmed ei ole vastavad,
                        võib see esilehel näha teistmoodi välja.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>
@endsection