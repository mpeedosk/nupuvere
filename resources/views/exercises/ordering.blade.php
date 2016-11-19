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

<script>
    var items = document.getElementsByClassName('drag-item');
    var height = 0;
    for (var i = 0; i < items.length; i++) {
        height += items[i].offsetHeight
    }
    console.log(height + " " + 38* items.length);
    if (height != 38 * items.length) {
        var margin = ((height - items.length * 38) / items.length);
        $('.drag-item-label').css('margin-bottom', margin + 10);
    }
</script>
