<div class="form-group pull-left no-margin">
    @foreach($answers as $answer)
        <div class="radio">
            <label>
                <span class="pre-formatted">{!!$answer->content!!}</span>
                <input type="radio" name="answer" id="{{$answer->id}}">
            </label>
        </div>
    @endforeach
</div>