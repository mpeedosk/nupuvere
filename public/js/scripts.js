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


// initialize sortable
var el = document.getElementById('draggable');

/* initialize draggable elements*/
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


// Vertically center modals http://www.minimit.com/articles/solutions-tutorials/vertical-center-bootstrap-3-modals

var modalVerticalCenterClass = ".modal";

function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each(function () {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}

$(modalVerticalCenterClass).on('show.bs.modal', function () {
    centerModals($(this));
});
$(window).on('resize', centerModals);


/* Exercise scripts */

function loginRequired() {
    toastr.info('Vastamiseks peate sisse logima!');
}

// user has chosen to see the answer

var solutionSeen = false;

function showAnswer(id, type) {
    id = parseInt(id);
    type = parseInt(type);

    if (solutionSeen)
        return;
    $(".se-pre-con").fadeIn("fast");
    $.ajax({
        url: "/answer/show/" + id,
        type: "post",
        dataType: "JSON",
        data: {
            '_token': $('input[name="_token"]').val()
        },
        success: function (data) {

            var answers = JSON.parse(data.answers);
            var answers_id = JSON.parse(data.answers_id);
            var listElements = null;

            switch (type) {
                case 1 :
                    var inputField = document.getElementById('answer-input');
                    answers.push(inputField.value.trim());
                    inputField.disabled = true;
                    inputField.value = answers[0];
                    inputField.className += " correct-answer";
                    break;
                case 2 :
                    listElements = document.querySelectorAll('input[name = "answer"]');
                    for (var i = 0; i < listElements.length; i++) {
                        listElements[i].disabled = true;
                        if (listElements[i].id == answers_id[0]) {
                            listElements[i].checked = true;
                        } else
                            listElements[i].checked = false;
                    }
                    break;
                case 3 :
                    listElements = document.querySelectorAll('input[name = "answer"]');
                    for (var i = 0; i < listElements.length; i++) {
                        listElements[i].disabled = true;
                        if (answers_id.indexOf(parseInt(listElements[i].id)) >= 0) {
                            listElements[i].checked = true;
                        } else {
                            listElements[i].checked = false;
                        }
                    }
                    break;
                case 4 :
                    listElements = document.getElementsByClassName("drag-item");
                    console.log(answers.length);
                    for (var i = 0; i < answers.length; i++) {
                        listElements[i].innerText = "";
                        listElements[i].insertAdjacentHTML('beforeend', answers[i]);
                        listElements[i].className = "drag-item";
                    }
                    break;
            }
            if (data.solution != null && data.solution != "") {

                document.getElementById('solution-text').insertAdjacentHTML('beforeend', data.solution);
                document.getElementById('solution').style.display = "block";
                reloadWiris();

            }
            document.getElementById('submit-answer').disabled = true;
            solutionSeen = true;

            if (data.seenOrSolved == false){
                toastr.warning('Selle ülesande eest ei ole enam võimalik punkte saada.');
            }
            $(".se-pre-con").fadeOut("slow");


        },
        error: function (xhr) {
            if (xhr.status == 401) {
                toastr.error("Sessioon on aegunud. Loggige uuesti sisse!")
            } else {
                toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
            }
            $(".se-pre-con").fadeOut("slow");
        }
    });


}

// User has chosen to submit the exercise answer
function submitAnswer(event, id, type) {
    id = parseInt(id);
    type = parseInt(type);

    event.preventDefault();
    answers = [];
    switch (type) {
        case 1 :
            answers.push(document.getElementById("answer-input").value.trim());
            break;
        case 2 :
            var input = document.querySelector('input[name = "answer"]:checked');
            if (input != null)
                answers.push(input.id);
            else
                return;
            break;
        case 3 :
            var listElements = document.querySelectorAll('input[name = "answer"]:checked');
            for (var i = 0; i < listElements.length; i++) {
                answers.push(listElements[i].id)
            }
            break;
        case 4 :
            var listElements = document.getElementsByClassName("drag-item");
            for (var i = 0; i < listElements.length; i++) {
                answers.push(listElements[i].id);
            }
            /*
             document.getElementById("draggable").id = "not-draggable";
             */

            break;
    }


    var postArray = JSON.stringify(answers);

    $("#md-spinner").fadeIn("fast").css("display","block");
    $("#submit-text").hide();

    $.ajax({
        url: "/answer/check/" + id,
        type: "post",
        dataType: "JSON",
        data: {
            '_token': $('input[name="_token"]').val(),
            'answers': postArray
        },
        success: function (data) {
            if (data.response) {
                var points = document.getElementById('user-points');
                toastr.success('Te vastasite õigesti!');
                if (data.points != points.innerHTML) {
                    $('#points-increase').fadeTo('slow', 1).delay(2000).fadeTo('slow', 0);
                }

                if (data.solution != null && data.solution != "") {
                    document.getElementById('solution-text').insertAdjacentHTML('beforeend', data.solution);
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
            $("#md-spinner").fadeOut("slow", function () {
                $("#submit-text").show();
            });
        },
        error: function (xhr) {

            if (xhr.status == 401) {
                toastr.error("Sessioon on aegunud. Loggige uuesti sisse!")
            } else {
                toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
            }
            $("#md-spinner").fadeOut("slow", function () {
                $("#submit-text").show();
            });
        }
    });

}

/* image zoom on click*/
$('#ex-content').find('img').addClass('ex-image');

$(function () {
    $('.ex-image').on('click', function () {
        $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
        $('#enlargeImageModal').modal();
    });
});


/* search bar*/
// modified from http://codeconvey.com/expanding-search-bar-with-jquery/

$(document).ready(function () {
    var searchIcon = $('.search-icon');
    var searchInput = $('.search-input');
    var searchBox = $('.search');
    var isOpen = false;

    $(document).mouseup(function () {
        if (isOpen == true) {
            searchInput.val('');
            searchBox.removeClass('search-open');
            isOpen = false;
        }
    });

    searchIcon.mouseup(function () {
        return false;
    });

    searchBox.mouseup(function () {
        return false;
    });

    searchIcon.click(function () {
        if (isOpen == false) {
            searchBox.addClass('search-open');
            isOpen = true;
        } else {
            if ($("#search").val() != "")
                document.getElementById("search-form").submit();
            else {
                searchBox.removeClass('search-open');
                isOpen = false;
            }
        }
    });
});

function reloadWiris() {
    var script = document.createElement('script');
    script.id = 'wiris';
    script.type = 'text/javascript';
    script.src = " /lib/js/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image";
    $('#wiris').remove();
    document.getElementsByTagName('head')[0].appendChild(script);
}