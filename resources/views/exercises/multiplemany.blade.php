<div class="form-group">
    @foreach($answers as $answer)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="answer" value="{{$answer}}">
                {{$answer}}
            </label>
        </div>
    @endforeach
</div>