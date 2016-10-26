<div class="drag-numbers" >
    @foreach(range(1, count($answers)) as $number)
        <label class="drag-item-label">
            {{$number}}.
        </label>
    @endforeach
</div>
<div id="draggable" class="drag-panel">
    @foreach($answers as $answer)
        <div class="drag-item drag">
            {{$answer}}
        </div>
    @endforeach
</div>