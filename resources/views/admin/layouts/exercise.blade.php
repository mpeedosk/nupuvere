@extends('admin.layouts.dashboard')
@section('css')
    <script type="text/javascript" src="{{asset('lib/js/tinymce.min.js')}}"></script>
    <script id="wiris" type="text/javascript"
            src="{{asset('lib/js/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script>

    <script>
        function afterInit(inst) {
            $(".se-pre-con").fadeOut("slow");
        }
        function setImageValue(url) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(url);
        }
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            tinymce.init({
                selector: 'textarea',
                language: 'et',
                theme: 'modern',
                menubar: false,
                relative_urls: false,
                plugins: 'link, image, code, youtube, imagetools, charmap, media, textcolor, hr, table, autoresize, tiny_mce_wiris',
                extended_valid_elements: 'input[onclick|value|style|type]',
                file_browser_callback: function (field_name, url, type) {
                    if (type == 'image') {
                        $('#upload_file').trigger('click');
                    }
                },
                toolbar1: 'styleselect | fontselect fontsizeselect | bold italic underline forecolor  | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image editimage youtube | table | hr | subscript superscript | preview | ' +
                'charmap tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                image_caption: true,
                image_advtab: true,
                content_css: '/css/main.css',
                wirisformulaeditorlang: 'et',
                init_instance_callback: "afterInit",
                setup: function (editor) {
                    editor.addButton('preview',
                        {
                            title: "Preview",
                            onclick: function () {
                                var modal = $("#modal-view");
                                modal.removeClass("modal-sm");

                                var preview = document.getElementById('preview');
                                preview.innerHTML = "";
                                preview.insertAdjacentHTML('beforeend', editor.getContent());

                                if (editor.id == 'ex_hint') {
                                    modal.addClass("modal-sm");
                                    modal.removeClass('font-size-md');
                                }
                                else {
                                    modal.addClass('font-size-md')
                                }
                                $("#preview-modal").modal();
                                reloadWiris();
                            }
                        });
                    editor.addMenuItem("preview", {
                        text: "Preview",
                        cmd: "mcePreview",
                        context: "view"
                    })
                }
            });
        });
    </script>
@endsection

@section('content')

    @if(session('exercise-update'))
        <script>
            $(function () {
                toastr.success('Ülesanne "{{session('exercise-update')}}" edukalt uuendatud');
            });
        </script>
    @endif

    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <div class="row margin-30">
                <div class="col-md-7">
                    <form method="POST" @yield('action')>
                        @if(isset($exercise))
                            {{ method_field('PATCH')}}
                        @endif

                        {{ csrf_field() }}
                        <div id="ex_title-group" class="form-group label-floating short-input">
                            <label for="ex_title" class="control-label "><span class="fa fa-fw fa-asterisk"
                                                                               aria-hidden="true"></span> Ülesande
                                pealkiri</label>
                            <input class="form-control" id="ex_title" name="ex_title" required maxlength="37"
                                   @if(!isset($exercise)) onblur="checkTitleAvailability(-1)"
                                   @else onblur="checkTitleAvailability({{$exercise->id}})" @endif
                                   value="@if(isset($exercise->title)){{ $exercise->title }}@else{{old('ex_title')}}@endif">
                            <span class="help-block">Pealkirjad ei tohi korduda</span>
                        </div>

                        <div class="form-group label-floating short-input">
                            <label for="ex_author" class="control-label"><span class="fa fa-fw"
                                                                               aria-hidden="true"></span>
                                Ülesande autor</label>
                            <input class="form-control" id="ex_author" name="ex_author" maxlength="30"
                                   value="@if(isset($exercise->author)){{ $exercise->author }}@else{{old('ex_author') }}@endif">
                            <span class="help-block color-default"></span>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="licence"
                                           @if(isset($exercise) && $exercise->licence) checked=""@endif>
                                    CC BY-NC 4.0 Litsents
                                </label>
                            </div>
                        </div>

                        <div class="form-group label-static">
                            <label for="ex_content" class=""><span class="fa fa-fw fa-asterisk"
                                                                   aria-hidden="true"></span>Ülesande püstitus</label>
                            <textarea class="form-control" id="ex_content" name="ex_content" required>
                                @if(isset($exercise->content)){{ $exercise->content }} @else {{ old('ex_content') }} @endif
                            </textarea>
                        </div>

                        <div class="form-group label-static">
                            <label for="ex_solution" class=""><span class="fa fa-fw"
                                                                    aria-hidden="true"></span>Lahenduskäik</label>
                            <textarea class="form-control" id="ex_solution" name="ex_solution">
                                 @if(isset($exercise->solution)){{ $exercise->solution }} @else {{ old('ex_solution') }} @endif
                            </textarea>
                        </div>

                        <div class="form-group label-static">
                            <label for="ex_hint" class=""><span class="fa fa-fw"
                                                                aria-hidden="true"></span>Lisa vihje</label>

                            <textarea class=" form-control" id="ex_hint" name="ex_hint">
                                @if(isset($exercise->hint)){{ $exercise->hint }} @else {{ old('ex_hint') }}@endif
                            </textarea>
                        </div>

                        <div class="form-group label-static">
                            <label for="answer_count" class=""><span class="fa fa-fw fa-asterisk"
                                                                     aria-hidden="true"></span>Lisa vastus</label>
                            <input id="answer_count" class="hidden" name="answer_count"
                                   @if(isset($answers))value="{{count($answers)}}"
                                   @else value="1"
                                    @endif>
                        </div>

                        @yield('answer-content')

                        <div class="form-group">
                            <label for="keywords">Märksõnad</label>
                            <input class="form-control" name="keywords"
                                   value="@if(isset($exercise->keywords)){{$exercise->keywords }}@else{{old('keywords')}}@endif" id="keywords">
                        </div>

                        <div class="form-group">
                            <label for="category-select"><span class="fa fa-fw fa-asterisk"
                                                               aria-hidden="true"></span>Kategooria: </label>
                            <select id="category-select" class="form-control dropdown-input" name="category">
                                @foreach(App\Category::getCategories() as $cat )
                                    @if(isset($exercise))
                                        <option value="{{$cat->name}}"
                                                @if($cat->name == $exercise->category) selected @endif>{{str_replace('_', ' ', ucfirst($cat->name)) }}</option>
                                    @else
                                        <option value="{{$cat->name}}">{{str_replace('_', ' ', ucfirst($cat->name)) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="age_group-select"><span class="fa fa-fw fa-asterisk"
                                                                aria-hidden="true"></span>Vanuseklass: </label>
                            <select id="age_group-select" class="form-control dropdown-input" name="age_group">
                                <option value="avastaja"
                                        @if(isset($exercise) && $exercise->age_group == 'avastaja') selected @endif >
                                    Avastajad (... - 2kl)
                                </option>
                                <option value="uurija"
                                        @if(isset($exercise) && $exercise->age_group == 'uurija') selected @endif>
                                    Uurijad (3.
                                    - 6. kl)
                                </option>
                                <option value="teadja"
                                        @if(isset($exercise) && $exercise->age_group == 'teadja') selected @endif>
                                    Teadjad (7.
                                    - 9. kl)
                                </option>
                                <option value="ekspert"
                                        @if(isset($exercise) && $exercise->age_group == 'ekspert') selected @endif>
                                    Eksperdid
                                    (10. - 12. kl)
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="difficulty-select"><span class="fa fa-fw fa-asterisk"
                                                                 aria-hidden="true"></span>Raskusaste: </label>
                            <select id="difficulty-select" class="form-control dropdown-input" name="difficulty">
                                <option value="lihtne"
                                        @if(isset($exercise) && $exercise->difficulty == 'lihtne') selected @endif>
                                    Lihtne
                                </option>
                                <option value="keskmine"
                                        @if(isset($exercise) && $exercise->difficulty == 'keskmine') selected @endif>
                                    Keskmine
                                </option>
                                <option value="raske"
                                        @if(isset($exercise) && $exercise->difficulty == 'raske') selected @endif>Raske
                                </option>
                            </select>
                        </div>

                        @if(isset($exercise))
                            <button type="submit" class="btn btn-info btn-raised">
                                Uuenda
                            </button>
                        @else
                            <button type="submit" class="btn btn-indigo">
                                Lisa ülesanne
                            </button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('admin.includes.tinymceUpload')

    <div id="preview-modal" class="modal fade" role="dialog" tabindex="-1">
        <div id="modal-view" class="modal-dialog modal-sm font-size-md">
            <div class="modal-content  panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span class="modal-img glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    <h4 class="panel-title">Eelvaade</h4>
                </div>
                <div id="preview" class="modal-body ex-content"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>
@endsection