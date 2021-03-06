/**
 * Created by Martin on 28.10.2016.
 */


/* Fade loader icon away after page has loaded*/
$(document).ready(function () {
    if (!(pathname == "/admin/home" || pathname.startsWith("/admin/exercise/")))
    // $(".se-pre-con").delay(100).fadeOut("slow");
    // else
        $(".se-pre-con").fadeOut("slow");
});

function hide() {
    var sidebar = $("#sidebar");
    var duration = 400;
    console.log(sidebar.css("left"));
    if(sidebar.css("left") == '-240px'){
        sidebar.animate({left:0}, {duration: duration, queue:false});
        $(".admin-page-content").animate({'margin-left':240},{duration: duration, queue:false});
        $(".admin-page-header").animate({'margin-left':240, 'width': '-=240px'},{duration: duration, queue:false});
        $(".admin-page-header .glyphicon").toggleClass('rotate-180');
    }else{
        sidebar.animate({left:-240}, {duration: duration , queue:false});
        $(".admin-page-content").animate({'margin-left':0},{duration: duration, queue:false});
        $(".admin-page-header").animate({'margin-left':0, 'width': '100%'},{duration: duration, queue:false});
        $(".admin-page-header .glyphicon").toggleClass('rotate-180');
    }
}

var pathname = window.location.pathname;
$table = $('#table');

if (window.location.pathname == "/admin/category") {
    $table.bootstrapTable({
        onPostBody: function (data) {
            $('.color').colorPicker({
                opacity: false,

                buildCallback: function ($elm) {
                    this.$colorPatch = $elm.prepend('<div class="cp-disp">').find('.cp-disp');
                },
                cssAddon: '.cp-disp {padding:10px; margin-bottom:6px; font-size:16px; height:25px; line-height:6px}' +
                '.cp-xy-slider {width:150px; height:150px;}' +
                '.cp-xy-cursor {width:16px; height:16px; border-width:2px; margin:-8px}' +
                '.cp-z-slider {height:150px; width:25px;}' +
                '.cp-z-cursor {border-width:8px; margin-top:-8px;}',

                renderCallback: function ($elm, toggled) {
                    var colors = this.color.colors;

                    this.$colorPatch.css({
                        backgroundColor: '#' + colors.HEX,
                        color: colors.RGBLuminance > 0.22 ? '#222' : '#ddd'
                    }).text(this.color.toString($elm._colorMode)); // $elm.val();
                }
            });
        }
    });
} else if (pathname == "/admin/exercise") {
    document.getElementById("import-form").onchange = function () {
        var filename = document.getElementById('import').value;
        if (filename != "") {
            var fileParts = filename.split('.');
            var extension = fileParts[fileParts.length - 1].toLowerCase();
            if (extension != "xls")
                toastr.info("Faili laiend peab olema xls");
            else {
                document.getElementById("import-form").submit();
                toastr.info("Importimine alustatud - palun oota");
                startLoader(document.getElementById("import-form"));
            }
        }
    };
}

function showCategoryConfirm(id, name) {
    $("#confirm-category-name").html(name);
    $("#confirm-category-id").html(id);
    $("#confirm-dialog").modal()
}

function deleteCategory() {
    var name = document.getElementById('confirm-category-name').innerHTML;
    var id = parseInt(document.getElementById('confirm-category-id').innerHTML);

    $.ajax({
        url: "/categories/delete/" + id,
        type: 'post',
        data: {
            _method: 'delete',
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {
            toastr.success('Kategooria ' + name + " edukalt kustutatud!");
            $table.bootstrapTable('removeByUniqueId', id);
        },
        error: function (xhr) {
            toastr.error('Viga kustutamisel ( kood ' + xhr.status + ")");
        }
    });
}

/* confirmation for deleting an exercise */
function showExerciseConfirm(id, name) {
    $("#confirm-exercise-name").html(name);
    $("#confirm-exercise-id").html(id);
    $("#confirm-dialog").modal()
}

function deleteExercise() {
    var name = document.getElementById('confirm-exercise-name').innerHTML;
    var id = parseInt(document.getElementById('confirm-exercise-id').innerHTML);

    $.ajax({
        url: "/admin/exercise/delete/" + id,
        type: 'post',
        data: {
            _method: 'delete',
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {
            toastr.success(name + " edukalt kustutatud!");
            $table.bootstrapTable('removeByUniqueId', id);
        },
        error: function (xhr) {
            toastr.error('Viga kustutamisel ( kood ' + xhr.status + ")");
        }
    });
}


/* confirmation for deleting an exercise */
function showUserConfirm(id, name) {
    $("#confirm-user-name").html(name);
    $("#confirm-user-id").html(id);
    $("#confirm-dialog").modal()
}

function deleteUser() {
    var name = document.getElementById('confirm-user-name').innerHTML;
    var id = parseInt(document.getElementById('confirm-user-id').innerHTML);

    $.ajax({
        url: "/admin/admins/delete/" + id,
        type: 'post',
        data: {
            _method: 'delete',
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {
            toastr.success(name + " edukalt kustutatud!");
            location.reload();
        },
        error: function (xhr) {
            if (xhr.status == 420)
                toastr.error("Iseennast ei saa kustutada");
            else
                toastr.error('Viga kustutamisel ( kood ' + xhr.status + ")");
        }
    });
}

/* adding answers for textual/numeric exercises*/
function addAnswer() {

    var answer_group =
        '<div class="form-group">' +
        '<label> Vastus</label>' +
        '<button class="btn btn-danger btn-sm margin-bottom-15 btn_remove" type="button" data-toggle="tooltip" title="Ee' +
        'malda" name="remove" tabindex="-1"">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button>' +
        '<input class="form-control" name="answer">' +
        '</div>';

    $('#answers').append(answer_group);
}

/* adding answers for multiple choice exercises*/
function addAnswerChoice() {

    var content = tinyMCE.get('answer-title').getContent();
    tinyMCE.get('answer-title').setContent("");

    var answerGroup =
        '<div class="form-group margin-top-10">' +
        '<div class="radio radio-inline">' +
        '<label>' +
        '<input type="radio" name="answer" value=\'' + content + '\'>' +
        '<span class="circle"></span>' +
        '<span class="check"></span><span class="pre-formatted">' + content +
        '</span></label>' +
        '</div>' +
        '<button class="btn btn-danger btn-sm  margin-bottom-0 btn_remove" type="button" ' +
        'data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button>' +
        '</div>';

    $('#answers').append(answerGroup);
    reloadWiris();
}


/* adding answers for multiple choice exercises*/
function addAnswerChoiceM() {
    var content = tinyMCE.get('answer-title').getContent();
    tinyMCE.get('answer-title').setContent("");

    var answerGroup =
        '<div class="form-group margin-top-10">' +
        '<div class="checkbox checkbox-inline">' +
        '<label>' +
        '<input type="checkbox" name="answer"  value=\'' + content + '\'>' +
        '<span class="checkbox-material">' +
        '<span class="check"></span>' +
        '</span><span class="inline-block">' + content +
        '</span></label>' +
        '</div>' +
        '<button class="btn btn-danger btn-sm btn_remove margin-bottom-0" type="button" ' +
        'data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button>' +
        '</div>';
    $('#answers').append(answerGroup);
    reloadWiris();

}

/* adding answers for multiple choice exercises*/
function addAnswerOrder() {
    var content = tinyMCE.get('answer-title').getContent();
    tinyMCE.get('answer-title').setContent("");

    var answerGroup = '<div class="drag-item drag"><div class="drag-content inline-block">' + content + '</div>' +
        '<div class="visuallyhidden"><input hidden class="drag-input"  value=\'' + content + '\'>' +
        '</div>' +
        '<button class="btn btn-danger btn-sm btn_remove margin-bottom-0 drag-delete" type="button" ' +
        'name="remove" tabindex="-1">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button></div>';

    $('#draggable').append(answerGroup);
    reloadWiris();
}

/* removing an answer*/
$(document).on('click', '.btn_remove', function () {
    /*    var button_id = $(this).attr("id");
     $('#answer_group_' + button_id + '').remove();*/
    $(this).parent().remove();
});

/* initializing bootstrap -*/
/**/

/* adding answers for backend processing for multiple choice exercises */
function getCheckedValue(form) {
    var answers = document.getElementsByName('answer');
    var correct = false;
    // check if we have an correct answer chosen
    for (var i = 0; i < answers.length; i++) {
        if (answers[i].checked) {
            correct = true;
        }
    }

    // if no correct answer is provided, display a warning
    if (!correct) {
        toastr.warning('Üks õige vastus on kohustuslik!');
        return false;
    }

    // add a new input for each non-correct answer with the value as value
    for (i = 0; i < answers.length; i++) {
        if (!answers[i].checked) {
            $('#answers').append('<input hidden value=\'' + answers[i].value + '\' name="incorrect_' + (i + 1) + '">');
        } else {
            $('#answers').append('<input hidden value=\'' + answers[i].value + '\' name="answer_' + (i + 1) + '">');

        }
    }
    // update the answer_count for backend
    document.getElementById('answer_count').value = answers.length;
    startLoader(form);

    return true;
}


/* adding answers for backend processing for ordering exercises */
function getCheckedValueO(form) {


    var listElements = document.getElementsByClassName("drag-input");
    // if no correct answer is provided, display a warning
    if (listElements.length == 0) {
        toastr.warning('Üks vastus on kohustuslik!');
        return false;
    }
    // add a new input for each non-correct answer with the value as value

    for (var i = 0; i < listElements.length; i++) {
        $('#answers').append('<textarea hidden name="answer_' + (i + 1) + '">' + listElements[i].value + '</textarea>');
    }

    // update the answer_count for backend
    document.getElementById('answer_count').value = listElements.length;
    startLoader(form);

    return true;

}

function getCheckedValueT(form) {
    var answers = document.getElementsByName('answer');
    var answerContainer = $('#answers');
    // add a new input for each non-correct answer with the value as value
    for (var i = 0; i < answers.length; i++) {
        answerContainer.append('<input hidden value=\'' + answers[i].value + '\' name="answer_' + (i + 1) + '">');

    }
    // update the answer_count for backend
    document.getElementById('answer_count').value = answers.length;
    startLoader(form);

    return true;
}

// http://stackoverflow.com/questions/35182800/image-resize-before-upload-without-preview-javascript

$('#inputGallery1').on('change', function () {
    resizeImages(this.files[0], 1, 'inputGallery1');
});
$('#inputGallery2').on('change', function () {
    resizeImages(this.files[0], 2, 'inputGallery2');
});
$('#inputGallery3').on('change', function () {
    resizeImages(this.files[0], 3, 'inputGallery3');
});
$('#inputGallery4').on('change', function () {
    resizeImages(this.files[0], 4, 'inputGallery4');
});
$('#inputGallery5').on('change', function () {
    resizeImages(this.files[0], 5, 'inputGallery5');
});
$('#inputLogos').on('change', function () {
    resizeImages(this.files[0], 6, 'inputLogos');
});
function clearInput(div_id) {
    document.getElementById(div_id).form.reset();

}
/* gallary image upload preview */

function resizeImages(file, id, div_id) {
    if (file == null) {
        if (id == 6) {
            $('.sponsors').attr('src', '/img/logo/footer.png');
            return false;
        }
        $('#gallery' + id + '-preview').attr('src', '/img/gallery/gallery' + id + '.png');
        return false;
    }

    if(file.size/1024/1024 > 5){
        toastr.error("Fail on liiga suur, kontrolli et see ei ületaks 5MB!");
        clearInput(div_id);
        return false;
    }

    var reader = new FileReader();
    reader.onload = function (e) {
        var img = new Image();
        img.onload = function () {
            if (id == 6) {
                $('.sponsors').attr('src', resizeInCanvas(img, id));
            }else{
                $('#gallery' + id + '-preview').attr('src', resizeInCanvas(img, id));
            }
        };

        if (e.target.result.substring(5, 10) != "image") {
            toastr.error("Viga pildi lugemisel, kontrollige faili laiendit! (jpeg, jpg, png või gif)");
            clearInput(div_id);
            return false;
        }

        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
    return true;
}

function resizeInCanvas(img, id) {
    var canvas = $("<canvas>")[0];

    if(id == 6){
        canvas.width = 810;
        canvas.height = 140;
    }else{
        canvas.width = 1080;
        canvas.height = 422;
    }

    canvas.getContext("2d").drawImage(img, 0, 0, canvas.width, canvas.height);

    return canvas.toDataURL();
}


/* Move to next input on enter http://stackoverflow.com/questions/24209588/how-to-move-focus-on-next-field-when-enter-is-pressed  */

// register jQuery extension
jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

function confirmReset() {
    $("#reset-dialog").modal()
}

function exportStart() {
    toastr.info("Eksportimine alustatud - palun oota");
    return true;
}


function checkTitleAvailability(id) {
    id = parseInt(id);

    var title = $("#ex_title").val();

    if (title.length > 0) {
        $.ajax({
            url: "/admin/exercise/checkTitle/" + id,
            data: {
                _token: $('input[name="_token"]').val(),
                title: title
            },
            type: "POST",
            success: function (data) {
                var status = $("#ex_title-group");
                status.removeClass("has-success");
                status.removeClass("has-error");

                if (data.response == "true") {
                    status.addClass("has-success");
                    status.find(".help-block").fadeOut("fast");
                }
                else {
                    status.addClass("has-error");
                    status.find(".help-block").fadeIn("fast");
                }
            },
            error: function () {
            }
        });
    }
}

/* polyfill http://stackoverflow.com/questions/30867172/code-not-running-in-ie-11-works-fine-in-chrome */

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(searchString, position) {
        position = position || 0;
        return this.indexOf(searchString, position) === position;
    };
}