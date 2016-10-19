<div class="form-group pull-left no-margin">
    @foreach($answers as $answer)
        <div class="radio">
            <label>
                <input type="radio" name="answer" value="{{$answer}}">
                {{$answer}}
            </label>
        </div>
    @endforeach
</div>