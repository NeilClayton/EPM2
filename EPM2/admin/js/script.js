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

$(document).ready (function(){
    $('.updateCustomer').click(function(){
        $('#loadArea').load('forms/updateableCustomers.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});


$(document).on("click", ".updateThisCustomer" , function(){
    var name = this.name;
    $('#loadArea').load('forms/updateCustomer.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});


$(document).on("click", ".displayUsers" , function(){
    var name = this.name;
    $('#loadArea').load('forms/showUsers.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});




$(document).ready (function(){
    $('.deleteCustomer').click(function(){
        $('#loadArea').load('forms/deleteCustomer.php')
        $('html, body').animate({
            scrollTop: $("#loadArea").offset().top
        }, 1000)
    });
});


$(document).on("click", ".deleteThisCustomer", function(){
    var name = this.name;

    if(confirm("Are you sure you want to deleted this Customer? all customer users will also be deleted!")){
        $.ajax({
            url: 'actions/admin_delete_action.php',
            data: {action: 'customer', param: name},
            type:'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/deleteCustomer.php');
            }
        })
    }
    else{
        return false;
    }

});




///User section

$(document).on("click", ".userControl" , function(){
    var name = this.name;
    $('#loadArea').load('forms/customerSelection.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});

$(document).on("click", ".addNewUser" , function(){
    var name = this.name;
    $('#loadArea').load('forms/addUser.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});

$(document).on("click", ".updateUser" , function(){
    var name = this.name;
    $('#loadArea').load('forms/updateUser.php', {js_submit_value : name});

    $('html, body').animate({
        scrollTop: $("#loadArea").offset().top
    }, 1000)
});




$(document).on("click", ".resetUser", function(){
    var name = this.name;

    if(confirm("Are you sure you want to reset this users password?")){
        $.ajax({
            url: 'actions/admin_delete_action.php',
            data: {action: 'reset', param: name},
            type:'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/showUsers.php');
            }
        })
    }
    else{
        return false;
    }

});

$(document).on("click", ".deleteUser", function(){
    var name = this.name;

    if(confirm("Are you sure you want to deleted this user?")){
        $.ajax({
            url: 'actions/admin_delete_action.php',
            data: {action: 'user', param: name},
            type:'post',
            success: function(output){
                alert(output);
                $('#loadArea').load('forms/showUsers.php');
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

