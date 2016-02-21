/**
 * Created by Neil on 30/12/2015.
 */


/** loads login form onto page when members button pressed **/
$(document).ready(function(){
    $('.membersBtn').click(function() {
        $('#LoginForm').load('forms/login_form.php')
    });
});

/** loads property form onto page when view property button pressed **/
$(document).ready(function(){
    $('.propertyLoad').click(function() {
        $('#loadArea').load('forms/currentProperties.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

/** load current jobs form onto page when view jobs button is pressed **/
$(document).ready(function(){
    $('.jobLoad').click(function() {


        $('#loadArea').load('forms/currentJobs.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});
//load current contractors into home load area div when button pressed
$(document).ready (function(){
    $('.contractorLoad').click(function(){
       $('#loadArea').load('forms/currentContractors.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
                }, 1000)
    });
});

$(document).ready (function(){
    $('.addProperty').click(function(){
        $('#loadArea').load('forms/addProperty.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});


$(document).ready (function(){
    $('.addJob').click(function(){
        $('#loadArea').load('forms/addJob.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});



$(document).ready (function(){
    $('.addContractor').click(function(){
        $('#loadArea').load('forms/addContractor.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).on("click", ".JobFormRedirect" , function(){
    var name = $('.JobFormRedirect').prop('name');
        $('#loadArea').load('forms/addJobForm.php', {js_submit_value : name})
    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});

//$(document).ready (function(){
//    $('.JobFormRedirect').click(function(){
//        var name = $('submit')[0].name;

//        $('#loadArea').load('forms/addJobForm.php', {js_submit_value : name})
//        $('html, body').animate({
//            scrollTop: $("#loadArea").offset().top
//        }, 1000)
//    });
//});



//detect is uppercase letter has been entered within a field
function capLock(e){
    kc = e.keyCode?e.keyCode:e.which;
    sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
    if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
        document.getElementById('caps').style.visibility = 'visible';
    else
        document.getElementById('caps').style.visibility = 'hidden';
}

