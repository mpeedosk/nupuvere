@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Valikvastustega - üks õige')
@section('action')
    onSubmit="return getCheckedValue()"
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/2' }}@endif"
@endsection

@section('answer-content')
    <div id="answers">
        @if(isset($answers))
            @foreach($answers as $answer)
                <div class="form-group margin-top-10" id="answer_group_{{$loop->index + 1}}">
                    <div class="radio radio-inline">
                        <label for="answer_{{$loop->index + 1}}">
                            <span class="pre-formatted"> {!!$answer->content!!} </span>
                            <input id="answer_{{$loop->index + 1}}" type="radio" name="answer"
                                   value='{!!$answer->content!!}' @if($answer->is_correct) checked="checked" @endif>
                        </label>
                    </div>
                    <button class="btn btn-danger btn-sm  margin-bottom-0 btn_remove" type="button"
                            data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1">
                        <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    <div class="form-group">
        <label class="control-label" for="answer-title">Lisa veel vastusevariante</label>
        <div class="input-group center-block">
            <textarea id="answer-title" class="form-control"></textarea>
            <div class="text-center">
                <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua" onclick="addAnswerChoice()">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;Lisa vastus
                </button>
            </div>
        </div>
    </div>
@endsection
