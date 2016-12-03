@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Järjestamine')
@section('action')
    onSubmit="return getCheckedValueO(this)"
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/4' }}@endif"
@endsection
@section('answer-content')
    <div id="answers">
        <div id="draggable" class="drag-panel">
            @if(isset($answers))
                @foreach($answers as $answer)
                    <div class="drag-item drag">
                        <div class="drag-content inline-block">
                            {!!$answer->content!!}
                        </div>
                        <div class="visuallyhidden">
                            <input hidden class="drag-input" value='{!! $answer->content !!}'>
                        </div>
                        <button class="btn btn-danger btn-sm btn_remove margin-bottom-0 drag-delete" type="button"
                                data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1">
                            <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="answer-title">Lisa veel vastusevariante</label>
        <div class="input-group center-block">
            <textarea id="answer-title" class="form-control"></textarea>
            <div class="text-center">
                <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua" onclick="addAnswerOrder()">
                    <span class="glyphicon glyphicon-plus"></span>&nbspLisa vastus
                </button>
            </div>
        </div>
    </div>
@endsection
