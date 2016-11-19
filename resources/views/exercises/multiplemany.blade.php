<div class="form-group">
    @foreach($answers as $answer)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="answer" id="{{$answer->id}}">
                <span class="inline-block"> {!!$answer->content!!} </span>
            </label>
        </div>
    @endforeach
</div>