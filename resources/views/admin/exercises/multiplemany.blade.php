@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Valikvastustega - mitu õiget')
@section('action')
    onSubmit="return getCheckedValue(this)"
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/3' }}@endif"
@endsection
@section('answer-content')
    <div id="answers">
        @if(isset($answers))
            @foreach($answers as $answer)
                <div class="form-group" id="answer_group_{{$loop->index + 1}}">
                    <div class="checkbox checkbox-inline">
                        <label for="answer_{{$loop->index + 1}}">
                            <input id="answer_{{$loop->index + 1}}" type="checkbox" name="answer"
                                   value='{!!$answer->content!!}' @if($answer->is_correct) checked="checked" @endif>
                            <div class="inline-block"> {!!$answer->content!!} </div>
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
                <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua" onclick="addAnswerChoiceM()">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;Lisa vastus
                </button>
            </div>
        </div>
    </div>
@endsection
