<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 13:21
 */
?>

<form class="col-md-4 col-md-offset-4 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
    <fieldset>
        <div class="center whiteOpacity">
            <label for currentPassword>Current Password</label><br><input type = "password" name="currentPassword" size="15" required onkeypress="capLock(event)" autofocus>
            <br>

            <label for newpassword>New Password</label><br><input type = "password" name="password1" size="15" required onkeypress="capLock(event)" />
            <br>

            <label for confirmpassword>Confirm Password</label><br><input type = "password" name="password2" size="15" required onkeypress="capLock(event)" />
            <div id="caps" style="visibility:hidden">Caps Lock is on.</div>

            <input class="loginBtn" type="submit" value="Change Password" name="submit">
        </div>
    </fieldset>
</form>

