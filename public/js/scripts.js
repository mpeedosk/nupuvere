/* INITIALIZATIONS */

// Material design
$.material.init();

// Initialize bootstrap tooltip
// $('[data-toggle="popover"]').popover();

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Initialize toastr
toastr.options = {
    "positionClass": "toast-top-left",
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "7000",
    "extendedTimeOut": "2000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// $("#table").fadeIn(700);


// initialize sortable
var el = document.getElementById('draggable');
// var sortable = Sortable.create(el);

if (el != null) {
    Sortable.create(el, {
        animation: 150,
        draggable: ".drag"
    });
}

// Mobile Menu
$(function () {
    $('#navmenu').slicknav();
    $("div.slicknav_menu").addClass("hidden-lg hidden-md");
    $('.slicknav_menu').prepend('<a href="/" title=""><img class="logo-menu padding-5" src="/img/logo.png" alt="Logo"/></a>');

});


// Vertically center modals

var modalVerticalCenterClass = ".modal";

function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each(function (i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$(modalVerticalCenterClass).on('show.bs.modal', function (e) {
    centerModals($(this));
});
$(window).on('resize', centerModals);


/* Exercise scripts */

function loginRequired() {
    toastr.info('Vastamiseks peate sisse logima!');
}


// user has chosen to see the answer
function showAnswer(id, type) {
    $.ajax({
        url: "/exercise/show/" + id,
        type: "post",
        dataType: "JSON",
        data: {
            '_token': $('input[name="_token"]').val(),
        },
        success: function (data) {
            toastr.warning('Selle ülesande eest ei ole enam võimalik punkte saada.');

            var answers = JSON.parse(data.answers);

            switch (type) {
                case 1 :
                    answers.push(document.getElementById("answer-input").value.trim());
                    var inputfield = document.getElementById('answer-input');
                    inputfield.disabled = true;
                    inputfield.value = answers[0];
                    inputfield.className += " correct-answer";
                    break;
                case 2 :
                    var listElements = document.querySelectorAll('input[name = "answer"]');
                    for (var i = 0; i < listElements.length; i++) {
                        listElements[i].disabled = true;
                        if (listElements[i].value == answers[0]) {
                            listElements[i].checked = true;
                            listElements[i].parentNode.parentNode.className += " correct-answer";
                        } else
                            listElements[i].checked = false;
                    }
                    break;
                case 3 :
                    var listElements = document.querySelectorAll('input[name = "answer"]');
                    for (var i = 0; i < listElements.length; i++) {
                        listElements[i].disabled = true;
                        if (answers.indexOf(listElements[i].value) >= 0) {
                            listElements[i].checked = true;
                        } else {
                            listElements[i].checked = false;
                        }
                    }
                    break;
                case 4 :
                    var listElements = document.getElementsByClassName("drag-item");
                    for (var i = 0; i < answers.length; i++) {
                        listElements[i].innerText = answers[i];
                        listElements[i].className = "drag-item";
                    }
                    break;
            }
            if (data.solution != null) {
                console.log(data.solution);
                document.getElementById('solution-text').insertAdjacentHTML('beforeend',data.solution);
                document.getElementById('solution').style.display = "block";
            }
            document.getElementById('submit-answer').disabled = true;

        },
        error: function (xhr) {
            toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
        }
    });


}

// User has chosen to submit the exercise answer
function submitAnswer(event, id, type) {
    event.preventDefault();
    answers = [];
    switch (type) {
        case 1 :
            answers.push(document.getElementById("answer-input").value.trim());
            break;
        case 2 :
            var input = document.querySelector('input[name = "answer"]:checked');
            if (input != null)
                answers.push(input.value);
            else
                return;
            break;
        case 3 :
            var listElements = document.querySelectorAll('input[name = "answer"]:checked');
            for (var i = 0; i < listElements.length; i++) {
                answers.push(listElements[i].value)
            }
            break;
        case 4 :
            var listElements = document.getElementsByClassName("drag-item");
            for (var i = 0; i < listElements.length; i++) {
                answers.push(listElements[i].innerHTML.trim());
            }
            /*
             document.getElementById("draggable").id = "not-draggable";
             */

            break;
    }


    var postArray = JSON.stringify(answers);

    $.ajax({
        url: "/exercise/check/" + id,
        type: "post",
        dataType: "JSON",
        data: {
            '_token': $('input[name="_token"]').val(),
            'answers': postArray
        },
        success: function (data) {
            if (data.response) {
                var points = document.getElementById('user-points');
                data.points == points.innerHTML ? toastr.success('Te vastasite õigesti!') :
                    toastr.success('Te vastasite õigesti ning kogusite 1 punkti.');

                if (data.solution != null) {
                    document.getElementById('solution-text').innerText = data.solution;
                    document.getElementById('solution').style.display = "block";
                }
                points.innerText = data.points;

                $("#active").removeClass("btn-not-solved").addClass("btn-solved");

                document.getElementById('submit-answer').disabled = true;

            } else {
                $("#wrong-answer").modal({
                    keyboard: false,
                    backdrop: 'static'
                })
            }
        },
        error: function (xhr) {
            toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
        }
    });
}

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

var i = -1;

function addAnswer(count) {
    if (i == -1)
        i = count + 1;
    else
        i++;
    document.getElementById('answer_count').value = i;


    var answer_group = '<div class="form-group" id="answer_group_' + i + '">' +
        ' <label for="a' + i + '"> Vastus ' + i + '</label>' +
        '<button class="btn btn-danger btn-sm margin-bottom-15 btn_remove" type="button" data-toggle="tooltip" title="Ee' +
        'malda" name="remove" tabindex="-1" id="' + i + '">' +
        '<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></button>' +
        '<input class="form-control" id="a' + i + '" name="answer_' + i + '"></div>';


    $('#answers').append(answer_group);

}

$(document).on('click', '.btn_remove', function () {
    var button_id = $(this).attr("id");
    console.log(button_id);
    $('#answer_group_' + button_id + '').remove();
});

$('#submit').click(function () {
    $.ajax({
        url: "name.php",
        method: "POST",
        data: $('#add_name').serialize(),
        success: function (data) {
            alert(data);
            $('#add_name')[0].reset();
        }
    });
});


$('#ex-content').find('img').addClass('ex-image');

$(function() {
    $('.ex-image').on('click', function() {
        $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
        $('#enlargeImageModal').modal();
    });
});
