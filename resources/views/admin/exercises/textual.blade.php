@extends('admin.layouts.exercise')
@section('title', 'Administraator')
@section('description', 'Tekstiline/numbriline')
@section('action')
    action="@if(isset($exercise->id)){{ '/admin/exercise/edit/' . $exercise->id }}@else{{ '/admin/exercise/create/1' }}@endif"
@endsection

@section('answer-content')

    <div id="answers">

        @if(isset($answers))
            @foreach($answers as $answer)
                <div class="form-group" id="answer_group_{{$loop->index + 1}}">
                    <label class="" for="a{{$loop->index + 1}}"> Vastus {{$loop->index + 1}}</label>
                    @if(!$loop->first)
                    <button class="btn btn-danger btn-sm margin-bottom-15 btn_remove" type="button"
                            data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1" id="{{$loop->index + 1}}">
                        <span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></button>
                    @endif
                    <input class="form-control" id="a{{$loop->index + 1}}"
                           name="answer_{{$loop->index + 1}}" value="{{$answer->content}}">
                </div>
            @endforeach
        @else
            <div class="form-group" id="answer_group_1">
                <label class="" for="a1"> Vastus 1</label>
                <input class="form-control" id="a1" name="answer_1">
            </div>
        @endif

    </div>

    <button type="button" id="add" tabindex="-1" class="btn btn-sm btn-aqua"
            @if(isset($answers))onclick="addAnswer({{count($answers)}})"
            @else onclick="addAnswer(1)"
            @endif>
        <span class="glyphicon glyphicon-plus"></span> Lisa veel üks vastus
    </button>
@endsection