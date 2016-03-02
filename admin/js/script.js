/**
 * Created by Neil on 02/03/2016.
 */
$(document).ready(function(){
    $('.changePassword').click(function(){
        $('#loadArea').load('forms/changePassword.php')
    })
});

$(document).ready (function(){
    $('.customerLoad').click(function(){
        $('#loadArea').load('forms/viewCustomers.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

$(document).ready (function(){
    $('.addCustomer').click(function(){
        $('#loadArea').load('forms/addCustomer.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});

