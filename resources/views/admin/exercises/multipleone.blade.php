@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Valikvastustega - üks õige')
@section('css')
    <script type="text/javascript" src="{{asset('lib/js/tinymce.min.js')}}"></script>

    <script>
        function setImageValue(url) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(url);
        }
        $(document).ready(function () {

            tinymce.init({
                selector: 'textarea',
                language: 'et',
                theme: 'modern',
                menubar: false,
                relative_urls: false,
                plugins: 'link, image, code, youtube, imagetools, print, preview, charmap, media, textcolor, hr, table, autoresize, tiny_mce_wiris',
                extended_valid_elements: 'input[onclick|value|style|type]',
                file_browser_callback: function (field_name, url, type, win) {
                    if (type == 'image') {
                        $('#upload_file').trigger('click');
                    }
                },
                toolbar1: 'styleselect | fontselect fontsizeselect | bold italic underline forecolor  | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image editimage youtube | table | hr | subscript superscript | preview |' +
                'charmap tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                plugin_preview_width: 600,
                image_caption: true,
                image_advtab: true,
                content_css: '/css/main.css',
                wirisformulaeditorlang: 'et'
            });
        });
    </script>
@endsection

@section('content')
    @if(Session::has('exercise-create'))
        <script>
            $(function () {
                toastr.success('Ülesanne "{{Session::get('exercise-create')}}" edukalt lisatud');
            });
            console.log('{{Session::get('exercise-create')}}')
        </script>
    @endif

    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        <div class="container">
            <div class="row margin-30">
                <div class="col-md-7">
                    <form method="POST" onSubmit="return getCheckedValue()"
                          action="@if(isset($exercise->id)){{ '/exercise/choice/edit/' . $exercise->id }}@else{{ '/exercise/choice/create' }}@endif ">
                        @if(isset($exercise))
                            {{ method_field('PATCH')}}
                        @endif

                        {{ csrf_field() }}
                        <div class="form-group label-floating short-input">
                            <label for="ex_title" class="control-label "><span class="fa fa-fw fa-asterisk"
                                                                               aria-hidden="true"></span> Ülesande
                                pealkiri</label>
                            <input class="form-control" id="ex_title" name="ex_title"
                                   value="@if(isset($exercise->title)){{ $exercise->title }}@endif">
                            <span class="help-block color-default">Pealkirjad ei tohi korduda</span>
                        </div>

                        <div class="form-group label-floating short-input">
                            <label for="ex_authro" class="control-label"><span class="fa fa-fw"
                                                                               aria-hidden="true"></span>
                                Ülesande autor</label>
                            <input class="form-control" id="ex_author" name="ex_author"
                                   value="@if(isset($exercise->author)){{ $exercise->author }}@endif">
                            <span class="help-block color-default">See väli ei ole kohustuslik</span>
                        </div>

                        <div class="form-group label-static">
                            <label for="ex_content" class=""><span class="fa fa-fw fa-asterisk"
                                                                   aria-hidden="true"></span>Ülesande püstitus</label>
                            <textarea class="form-control" id="ex_content" name="ex_content">
                                @if(isset($exercise->content)){{ $exercise->content }}@endif
                            </textarea>
                        </div>

                        <div class="form-group label-static">
                            <label for="ex_solution" class=""><span class="fa fa-fw"
                                                                    aria-hidden="true"></span>Lahenduskäik</label>
                            <textarea class=" form-control" id="ex_solution" name="ex_solution">
                                 @if(isset($exercise->solution)){{ $exercise->solution }}@endif
                            </textarea>
                        </div>

                        <div class="form-group label-static modal-sm">
                            <label for="ex_hint" class=""><span class="fa fa-fw"
                                                                aria-hidden="true"></span>Lisa vihje</label>

                            <textarea class=" form-control" id="ex_hint" name="ex_hint">
                                @if(isset($exercise->hint)){{ $exercise->hint }}@endif
                            </textarea>
                        </div>
                        <div class="form-group label-static">
                            <label for="answer_count" onclick="getCheckedValue()"><span class="fa fa-fw fa-asterisk"
                                                                                        aria-hidden="true"></span>Lisa
                                vastus</label>
                            <input hidden id="answer_count" name="answer_count" value="0">
                        </div>

                        <div id="answers">

                            @if(isset($answers))
                                @foreach($answers as $answer)
                                    <div class="form-group margin-top-10" id="answer_group_{{$loop->index + 1}}">
                                        <div class="radio radio-inline">
                                            <label for="answer_{{$loop->index + 1}}">
                                                <input id="answer_{{$loop->index + 1}}" type="radio" name="answer"
                                                       value="{{$answer->content}}" @if($answer->is_correct) checked="checked" @endif>
                                                {{$answer->content}}
                                            </label>
                                        </div>
                                        <button class="btn btn-danger btn-sm  margin-bottom-0 btn_remove" type="button"
                                                data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1" id="{{$loop->index + 1}}">
                                            <span class="glyphicon glyphicon-remove pull-right"
                                                  aria-hidden="true"></span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif


                            {{--
                                                        <div class="form-group" id="answer_group_1">
                                                            <div class="radio radio-inline">
                                                                <label for="answer_1">
                                                                    <input id="answer_1" type="radio" name="answer">
                                                                    Tere
                                                                </label>
                                                            </div>
                                                        </div>
                            --}}

                        </div>

                        <div class="form-group">
                            <label class="control-label" for="answer-title">Lisa veel vastusevariante</label>
                            <div class="input-group">
                                <input type="text" id="answer-title" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua"
                                            @if(isset($answers)) onclick="addAnswerChoice({{count($answers)}})"
                                            @else onclick="addAnswerChoice(0)"
                                            @endif
                                    >
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Lisa</button>
                                 </span>
                            </div>
                        </div>

                        {{--                            <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua"
                                                            @if(isset($answers))onclick="addAnswer({{count($answers)}})"
                                                            @else onclick="addAnswer(1)"
                                                            @endif>
                                                        <span class="glyphicon glyphicon-plus"></span> Lisa veel üks vastus
                                                    </button>--}}


                        <div class="form-group">
                            <label class=""><span class="fa fa-fw fa-asterisk"
                                                  aria-hidden="true"></span>Kategooria: </label>
                            <select class="form-control dropdown-input" name="category">
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
                            <label class=""><span class="fa fa-fw fa-asterisk"
                                                  aria-hidden="true"></span>Vanuseklass: </label>
                            <select class="form-control dropdown-input" name="age_group">
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
                            <label class=""><span class="fa fa-fw fa-asterisk"
                                                  aria-hidden="true"></span>Raskusaste: </label>
                            <select class="form-control dropdown-input" name="difficulty">
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

@endsection