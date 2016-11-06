/**
 * Created by Martin on 28.10.2016.
 */
$(document).ready(function(){
    $(".se-pre-con").fadeOut("slow");
    $(".pre-loader-ex").fadeOut("slow");

});

/*
 $(window).load(function() {
 // Animate loader off screen
 $(".se-pre-con").fadeOut("slow");
 });*/


function showCategoryConfirm(id, name) {
    $("#confirm-category-name").html(name);
    $("#confirm-category-id").html(id);
    $("#confirm-dialog").modal()
}

function deleteCategory() {
    var name = document.getElementById('confirm-category-name').innerHTML;
    var id = document.getElementById('confirm-category-id').innerHTML;

    $.ajax({
        url: "/categories/delete/" + id,
        type: 'post',
        data: {
            _method: 'delete',
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {
            toastr.success('Kategooria ' + name + " edukalt kustutatud!");
            document.getElementById('cat-' + id).style.display = 'none';
        },
        error: function (xhr) {
            toastr.error('Viga kustutamisel ( kood ' + xhr.status + ")");
        }
    });
}

function showExerciseConfirm(id, name) {
    $("#confirm-exercise-name").html(name);
    $("#confirm-exercise-id").html(id);
    $("#confirm-dialog").modal()
}

function deleteExercise() {
    var name = document.getElementById('confirm-exercise-name').innerHTML;
    var id = document.getElementById('confirm-exercise-id').innerHTML;

    $.ajax({
        url: "/exercise/delete/" + id,
        type: 'post',
        data: {
            _method: 'delete',
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {
            toastr.success(name + " edukalt kustutatud!");
            document.getElementById('ex-' + id).style.display = 'none';
        },
        error: function (xhr) {
            toastr.error('Viga kustutamisel ( kood ' + xhr.status + ")");
        }
    });
}

var answerCount = -1;

function updateAnswerCount(count) {
    if (answerCount == -1)
        answerCount = parseInt(count) + 1;
    else
        answerCount++;
}


function addAnswer(count) {

    updateAnswerCount(count);

    document.getElementById('answer_count').value = answerCount;

    var answer_group =
        '<div class="form-group" id="answer_group_' + answerCount + '">' +
        '<label for="a' + answerCount + '"> Vastus ' + answerCount + '</label>' +
        '<button class="btn btn-danger btn-sm margin-bottom-15 btn_remove" type="button" data-toggle="tooltip" title="Ee' +
        'malda" name="remove" tabindex="-1" id="' + answerCount + '">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button>' +
        '<input class="form-control" id="a' + answerCount + '" name="answer_' + answerCount + '">' +
        '</div>';


    $('#answers').append(answer_group);

}

function addAnswerChoice(count) {

    updateAnswerCount(count);
    document.getElementById('answer_count').value = answerCount;

    var userInput = document.getElementById('answer-title');
    content = userInput.value;
    userInput.value = "";

    var answer_group =
        '<div class="form-group margin-top-10" id="answer_group_' + answerCount + '">' +
        '<div class="radio radio-inline">' +
        '<label for="answer_' + answerCount + '">' +
        '<input id="answer_' + answerCount + '" type="radio" name="answer" value="' + content + '">' +
        '<span class="circle"></span>' +
        '<span class="check"></span>' +
        content +
        '</label>' +
        '</div>' +
        '<button class="btn btn-danger btn-sm  margin-bottom-0 btn_remove" type="button"' +
        'data-toggle="tooltip" title="Eemalda" name="remove" tabindex="-1" id="' + answerCount + '">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>' +
        '</button>' +
        '</div>';


    $('#answers').append(answer_group);

}

$(document).on('click', '.btn_remove', function () {
    var button_id = $(this).attr("id");
    console.log(button_id);
    $('#answer_group_' + button_id + '').remove();
});



$('#table').bootstrapTable({
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


function getCheckedValue() {
    var radios = document.getElementsByName('answer');
    var correct = false;

    // check if we have an correct answer chosen
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            correct = true;
        }
    }
    // if no correct answer is provided, display a warning
    if (!correct) {
        toastr.warning('Üks õige vastus on kohustuslik!');
        return false;
    }
    // add a new input for each non-correct answer with the value as value
    for (i = 0; i < radios.length; i++) {
        if (!radios[i].checked) {
            $('#answers').append('<input hidden value="' + radios[i].value + '" name="incorrect_' + (i+1) + '">');
        }
    }

    // update the answer_count for backend
    document.getElementById('answer_count').value= radios.length;

    return true;

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