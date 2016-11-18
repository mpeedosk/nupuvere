@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Tekstiline/numbriline')
@section('action')
    onSubmit="return getCheckedValueT()"
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/1' }}@endif"
@endsection

@section('answer-content')
    <div id="answers">
        @if(isset($answers))
            @foreach($answers as $answer)
                <div class="form-group">
                    <label for="answer_{{$loop->iteration}}"> Vastus</label>
                    @if(!$loop->first)
                        <button class="btn btn-danger btn-sm margin-bottom-15 btn_remove" type="button"
                                data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1">
                            <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></button>
                    @endif
                    <input class="form-control" name="answer" value="{{$answer->content}}" id="answer_{{$loop->iteration}}">
                </div>
            @endforeach
        @else
            <div class="form-group">
                <label for="a1"> Vastus</label>
                <input class="form-control" id="a1" name="answer">
            </div>
        @endif
    </div>

    <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua" onclick="addAnswer()">
        <span class="glyphicon glyphicon-plus"></span> Lisa veel üks vastus
    </button>
@endsection