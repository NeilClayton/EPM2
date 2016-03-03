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


//load add contractor form into home.php
$(document).ready (function(){
    $('.addContractor').click(function(){
        $('#loadArea').load('forms/addContractor.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).on("click", ".JobFormRedirect" , function(){
    var name = this.name;
    $('#loadArea').load('forms/addJobForm.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});

// load updateable properties into home.php
$(document).ready (function(){
    $('.updateProperty').click(function(){
        $('#loadArea').load('forms/updateableProperties.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

//load updateable contractors into home.php
$(document).ready (function(){
    $('.updateContractor').click(function(){
        $('#loadArea').load('forms/updateableContractors.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).ready (function(){
    $('.updateJob').click(function(){
        $('#loadArea').load('forms/updateableJobs.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

// load deleteable properties into home.php
$(document).ready (function(){
    $('.deleteProperty').click(function(){
        $('#loadArea').load('forms/deleteProperty.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

// load deleteable properties into home.php
$(document).ready (function(){
    $('.deleteContractor').click(function(){
        $('#loadArea').load('forms/deleteContractor.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).ready (function(){
    $('.deleteJob').click(function(){
        $('#loadArea').load('forms/deleteJob.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).ready(function(){
   $('.changePassword').click(function(){
       $('#loadArea').load('forms/changePassword.php')
   })
});

$(document).on("click", ".updateThisContractor" , function(){
    var name = this.name;
    $('#loadArea').load('forms/updateContractor.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});


$(document).on("click", ".updateThisJob" , function(){
    var name = this.name;
    $('#loadArea').load('forms/updateJob.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});

$(document).on("click", ".updateThisProperty" , function(){
    var name = this.name;
    $('#loadArea').load('forms/updateProperty.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});


$(document).on("click", ".deleteThisProperty", function(){
    var name = this.name;

    if(confirm("Are you sure you want to delete this property?")){
        $.ajax({
            url: 'actions/delete_action.php',
            data: {action: 'property', param: name},
            type: 'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/deleteProperty.php');
            }

        })

    }
    else{
        return false;
    }

});

$(document).on("click", ".deleteThisJob", function(){
    var name = this.name;

    if(confirm("Are you sure you want to delete this Job?")){
        $.ajax({
            url: 'actions/delete_action.php',
            data: {action: 'job', param: name},
            type: 'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/deleteJob.php');
            }

        })

    }
    else{
        return false;
    }

});

$(document).on("click", ".deleteThisContractor", function(){
   var name = this.name;

    if(confirm("Are you sure you want to deleted this contractor?")){
        $.ajax({
            url: 'actions/delete_action.php',
            data: {action: 'contractor', param: name},
            type:'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/deleteContractor.php');
            }
        })
    }
    else{
        return false;
    }

});

//detect is uppercase letter has been entered within a field
function capLock(e){
    kc = e.keyCode?e.keyCode:e.which;
    sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
    if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
        document.getElementById('caps').style.visibility = 'visible';
    else
        document.getElementById('caps').style.visibility = 'hidden';
}

