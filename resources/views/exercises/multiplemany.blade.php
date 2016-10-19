<div class="form-group  pull-left no-margin">

    @foreach($answers as $answer)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="answer" value="{{$answer}}">
                {{$answer}}
            </label>
        </div>
    @endforeach
</div>