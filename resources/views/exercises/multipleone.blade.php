<div class="form-group pull-left no-margin">
    @foreach($answers as $answer)
        <div class="radio">
            <label>
                <input type="radio" name="answer" id="{{$answer->id}}" value="{{$answer->content}}">
                {{$answer->content}}
            </label>
        </div>
    @endforeach
</div>