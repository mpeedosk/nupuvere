<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form id="my_form" action="/admin/upload" target="form_target" method="post" enctype="multipart/form-data"
      style="width:0px;height:0;overflow:hidden">
    <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
    <input type="hidden" name="type_slug" id="type_slug" value="exercise_s">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>