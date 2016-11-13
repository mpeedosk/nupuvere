@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Järjestamine')

@section('action')
    onSubmit="return getCheckedValueO()"
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/4' }}@endif"
@endsection

@section('answer-content')
    <div id="answers">
        <div id="draggable" class="drag-panel">
            @if(isset($answers))
                @foreach($answers as $answer)
                    <div class="drag-item drag">
                        {{$answer->content}}
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="answer-title">Lisa veel vastusevariante</label>
        <div class="input-group">
            <input type="text" id="answer-title" class="form-control">
            <span class="input-group-btn">
                <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua"
                        @if(isset($answers)) onclick="addAnswerOrder({{count($answers)}})"
                        @else onclick="addAnswerOrder(0)" @endif>
                    <span class="glyphicon glyphicon-plus"></span>&nbspLisa
                </button>
            </span>
        </div>
    </div>
@endsection
