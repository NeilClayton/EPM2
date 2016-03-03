
    <form class="col-md-4 col-md-offset-4 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
        <fieldset>
            <div class="center whiteOpacity">
                <label for username>Username &nbsp; </label><input type = "text" name="username" size="15" required autofocus>
                <br>
                <br>
                <label for password>Password &nbsp; </label><input type = "password" name="password" size="15" required onkeypress="capLock(event)" />
                <div id="caps" style="visibility:hidden">Caps Lock is on.</div>
                <br>
                <input class="loginBtn" type="submit" value="Login" name="submit">
            </div>
        </fieldset>
    </form>


