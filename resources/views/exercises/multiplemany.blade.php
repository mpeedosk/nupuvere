<div class="form-group" style="margin-left: 20px">
    @foreach($answers as $answer)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="answer" value="{{$answer}}">
                {{$answer}}
            </label>
        </div>
    @endforeach
</div>