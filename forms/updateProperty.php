<?php
session_start();
if ($_REQUEST['js_submit_value']) {
    $PropertyID = $_REQUEST['js_submit_value'];
    //echo $PropertyID;
    $_SESSION['propertyID'] = $PropertyID;
    include('../actions/main_action.php');
    $action = new action();
    $action->selectOneProptery($_SESSION['propertyID']);




}
?>


<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>

            <label for propertyref class = "col-md-2 col-md-offset-2 col-sm-12" >Property Ref</label><input class="col-md-6 col-sm-12" type = "text" name="propertyref" size="50 " value="<?php echo $_SESSION['propertyref']; ?>">
            <br><br>
            <label for address1 class="col-md-2 col-md-offset-2 col-sm-12" >Address</label><input class="col-md-6 col-sm-12" type = "text" name="address1" value="<?php echo $_SESSION['address1']; ?> " size="50">
            <br><br>
            <label for address2 class="col-md-2 col-md-offset-2 col-sm-12"></label><input class="col-md-6 col-sm-12" type = "text" name="address2" value="<?php echo $_SESSION['address2']; ?> " size="50">
            <br><br>
            <label for town class="col-md-2 col-md-offset-2 col-sm-12">Town</label><input class="col-md-6 col-sm-12" type = "text" name="town" value="<?php echo $_SESSION['town']; ?> " size="50">
            <br><br>
            <label for county class="col-md-2 col-md-offset-2 col-sm-12">County</label><input class="col-md-6 col-sm-12" type = "text" name="county" value="<?php echo $_SESSION['county']; ?> " size="50">
            <br><br>
            <label for postcode class="col-md-2 col-md-offset-2 col-sm-12">Postcode</label><input class="col-md-6 col-sm-12" type = "text" name="postcode" value="<?php echo $_SESSION['postcode']; ?> " size="50">
            <br><br>
            <label for tel class="col-md-2 col-md-offset-2 col-sm-12">Tel</label><input class="col-md-6 col-sm-12" type = "text" name="tel" value="<?php echo $_SESSION['tel']; ?> " size="50">
            <br><br>
            <label for fax class="col-md-2 col-md-offset-2 col-sm-12">Fax</label><input class="col-md-6 col-sm-12" type = "text" name="fax"  value="<?php echo $_SESSION['fax']; ?> " size="50">
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12">Email</label><input class="col-md-6 col-sm-12" type = "text" name="email"  value="<?php echo $_SESSION['email']; ?> " size="50">
            <br><br>
            <input type="checkbox" name="update" value="update" required> &nbsp; Tick to confirm amended details are correct
            <br><br>
            <input type="hidden" name = "property" value="<?php echo $_SESSION['propertyID'];?>">
            <input class="AddBtn" type="submit" value="Update" name="submit">

        </fieldset>
    </div>
</form>