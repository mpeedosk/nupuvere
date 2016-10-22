/*/!* Portfolio *!/
 $(window).load(function() {
 var $cont = $('.portfolio-group');

 $cont.isotope({
 itemSelector: '.portfolio-group .portfolio-item',
 masonry: {columnWidth: $('.isotope-item:first').width(), gutterWidth: -20, isFitWidth: true},
 filter: '*',
 });

 $('.portfolio-filter-container a').click(function() {
 $cont.isotope({
 filter: this.getAttribute('data-filter')
 });

 return false;
 });

 var lastClickFilter = null;
 $('.portfolio-filter a').click(function() {

 //first clicked we don't know which element is selected last time
 if (lastClickFilter === null) {
 $('.portfolio-filter a').removeClass('portfolio-selected');
 }
 else {
 $(lastClickFilter).removeClass('portfolio-selected');
 }

 lastClickFilter = this;
 $(this).addClass('portfolio-selected');
 });

 });*/

/* Image Hover  - Add hover class on hover */
/*
 $(document).ready(function(){
 if (Modernizr.touch) {
 // show the close overlay button
 $(".close-overlay").removeClass("hidden");
 // handle the adding of hover class when clicked
 $(".image-hover figure").click(function(e){
 if (!$(this).hasClass("hover")) {
 $(this).addClass("hover");
 }
 });
 // handle the closing of the overlay
 $(".close-overlay").click(function(e){
 e.preventDefault();
 e.stopPropagation();
 if ($(this).closest(".image-hover figure").hasClass("hover")) {
 $(this).closest(".image-hover figure").removeClass("hover");
 }
 });
 } else {
 // handle the mouseenter functionality
 $(".image-hover figure").mouseenter(function(){
 $(this).addClass("hover");
 })
 // handle the mouseleave functionality
 .mouseleave(function(){
 $(this).removeClass("hover");
 });
 }
 });
 */

// thumbs animations
/*$(function () {

 $(".thumbs-gallery i").animate({
 opacity: 0

 }, {
 duration: 300,
 queue: false
 });

 $(".thumbs-gallery").parent().hover(
 function () {},
 function () {
 $(".thumbs-gallery i").animate({
 opacity: 0
 }, {
 duration: 300,
 queue: false
 });
 });

 $(".thumbs-gallery i").hover(
 function () {
 $(this).animate({
 opacity: 0

 }, {
 duration: 300,
 queue: false
 });

 $(".thumbs-gallery i").not( $(this) ).animate({
 opacity: 0.4         }, {
 duration: 300,
 queue: false
 });
 }, function () {
 }
 );

 });*/

// Mobile Menu
$(function () {
    $('#navmenu').slicknav();
    $("div.slicknav_menu").addClass("hidden-lg hidden-md");
    $('.slicknav_menu').prepend('<a href="/" title=""><img class="logo-menu padding-5" src="/img/logo.png" alt="Logo"/></a>');

});

// Material design
$.material.init();

// Initialize bootstrap tooltip
// $('[data-toggle="popover"]').popover();


// Initialize toastr
toastr.options = {
    "positionClass": "toast-top-center",
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


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

// user has chosen to see the answer
function showAnswer(id, type) {
    console.log(id);

    $.ajax({
        url: "/exercise/show/" + id,
        type: "post",
        dataType: "JSON",
        data: {
            '_token': $('input[name="_token"]').val(),
        },
        success: function (data) {
            toastr.warning('Selle ülesande eest ei ole enam võimalik punkte saada.').css("width","400px");

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
                        if(answers.indexOf(listElements[i].value) >=0 ){
                            listElements[i].checked = true;
                        }else{
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
                document.getElementById('solution-text').innerText = data.solution;
                document.getElementById('solution').style.display = "block";
            }
            document.getElementById('submit-answer').disabled = true;

        },
        error: function (xhr) {
            toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
        }
    });


}

function loginRequired() {
    toastr.info('Vastamiseks peate sisse logima!');
}

// User has chosen to submit the exercise answer
function submitAnswer(event, id, type) {
    event.preventDefault();
    console.log(id);
    console.log(type);
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
            document.getElementById("draggable").id = "not-draggable";

            break;
    }


    var postArray = JSON.stringify(answers);
    console.log(postArray);


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
                toastr.success('Te vastasite õigesti!');
                if (data.solution != null) {
                    document.getElementById('solution-text').innerText = data.solution;
                    document.getElementById('solution').style.display = "block";
                }
                console.log(data.points);
                document.getElementById('user-points').innerText = data.points;
                // $("#next-ex").removeClass("btn-aqua").addClass("btn-success");

                $("#active").removeClass("btn-not-solved").addClass("btn-solved");

                // var inputfield = document.getElementById('answer-input');
                // inputfield.disabled = true;
                // inputfield.value = "225g";
                document.getElementById('submit-answer').disabled = true;

            } else {
                $("#wrong-answer").modal()
            }
        },
        error: function (xhr) {
            toastr.error('Viga ühendusega ( kood ' + xhr.status + ")");
        }
    });


}

// initialize sortable
var el = document.getElementById('draggable');
// var sortable = Sortable.create(el);

if (el != null) {
    Sortable.create(el, {
        animation: 150,
        draggable: ".drag"
    });
}



