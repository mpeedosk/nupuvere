<div class="form-group">
    @foreach($answers as $answer)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="answer" id="{{$answer->id}}" value="{{$answer->content}}">
                {{$answer->content}}
            </label>
        </div>
    @endforeach
</div>