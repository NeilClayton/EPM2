<?php
session_start();

if ($_REQUEST['js_submit_value']) {
    $selectedCompany = $_REQUEST['js_submit_value'];
    $_SESSION['selectedCompany'] = $selectedCompany;
}

include_once '../actions/admin_action.php'
?>

<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Add a New Customer</h1>

            <label for username class = "col-md-2 col-md-offset-2 col-sm-12" >Username</label><input class="col-md-6 col-sm-12" type = "text" name="username" size="50" autofocus required>
            <br><br>
            <label for password class="col-md-2 col-md-offset-2 col-sm-12" >Password</label><input class="col-md-6 col-sm-12" type = "password" name="password1" size="50" required>
            <br><br>
            <label for password class="col-md-2 col-md-offset-2 col-sm-12" >Confirm Password</label><input class="col-md-6 col-sm-12" type = "password" name="password2" size="50" required>
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12">Email</label><input class="col-md-6 col-sm-12" type = "text" name="email" size="50" required>

            <br><br>
            <input type="checkbox" name="addUser" value="addUser" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input class="AddBtn" type="submit" value="Add" name="submit">

        </fieldset>
    </div>
</form>
