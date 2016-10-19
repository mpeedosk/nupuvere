<div class="drag-numbers" style="display: inline-block">
    @foreach(range(1, count($answers)) as $number)
        <label class="drag-item-label">
            {{$number}}
        </label>
    @endforeach
</div>
<div id="draggable" class="drag-panel" style="display: inline-block;">
    @foreach($answers as $answer)
        <div class="drag-item">
            {{$answer}}
        </div>
    @endforeach
</div>