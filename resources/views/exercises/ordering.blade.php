<div class="drag-numbers">
    @foreach(range(1, count($answers)) as $number)
        <label class="drag-item-label">
            {{$number}}.
        </label>
    @endforeach
</div>
<div id="draggable" class="drag-panel">
    @foreach($answers as $answer)
        <div class="drag-item drag" id="{{$answer->id}}">
            {!!$answer->content!!}
        </div>
    @endforeach
</div>

{{--
<script>
        height = document.getElementsByClassName('drag-item')[0].offsetHeight;
        if(height>70)
                $('.drag-item-label').css('margin-bottom', 2 * height / 3);
</script>
--}}
