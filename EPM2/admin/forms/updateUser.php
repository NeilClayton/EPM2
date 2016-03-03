<?php
session_start();

if ($_REQUEST['js_submit_value']) {
    $selectedUser = $_REQUEST['js_submit_value'];
    $_SESSION['selectedUser'] = $selectedUser;
}

include_once '../actions/admin_action.php';
$action = new admin_action();
$action->getUserDetails($_SESSION['selectedUser']);
?>

<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Update a User</h1>

            <label for username class = "col-md-2 col-md-offset-2 col-sm-12" >Username</label><input class="col-md-6 col-sm-12" type = "text" name="username" value="<?php echo $_SESSION['updateUsername']?>" size="50" autofocus>
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12" >Email</label><input class="col-md-6 col-sm-12" type = "text" name="email" value="<?php echo $_SESSION['updateEmail']?>" size="50">
            <br><br>
            <input type="checkbox" name="updateUser" value="updateUser" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input class="AddBtn" type="submit" value="Add" name="submit">

        </fieldset>
    </div>
</form>