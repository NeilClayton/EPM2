<?php
session_start();
if ($_REQUEST['js_submit_value']) {
    $customerID = $_REQUEST['js_submit_value'];
    $_SESSION['customerUpdateID'] = $customerID;
    include('../actions/admin_action.php');
    $action = new admin_action();
    $action->selectOneCustomer($_SESSION['customerUpdateID']);
}
?>
<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Update a Customer</h1>

            <label for companyname class = "col-md-2 col-md-offset-2 col-sm-12" >Company Name</label><input class="col-md-6 col-sm-12" type = "text" name="companyname" value="<?php echo $_SESSION['custCompanyname']?>" size="50" autofocus>
            <br><br>
            <label for address1 class="col-md-2 col-md-offset-2 col-sm-12" >Address</label><input class="col-md-6 col-sm-12" type = "text" name="address1" value="<?php echo $_SESSION['custAddress1']?>" size="50">
            <br><br>
            <label for address2 class="col-md-2 col-md-offset-2 col-sm-12"></label><input class="col-md-6 col-sm-12" type = "text" name="address2" value="<?php echo $_SESSION['custAddress2']?>" size="50">
            <br><br>
            <label for town class="col-md-2 col-md-offset-2 col-sm-12">Town</label><input class="col-md-6 col-sm-12" type = "text" name="town" value="<?php echo $_SESSION['custTown']?>" size="50">
            <br><br>
            <label for county class="col-md-2 col-md-offset-2 col-sm-12">County</label><input class="col-md-6 col-sm-12" type = "text" name="county" value="<?php echo $_SESSION['custCounty']?>" size="50">
            <br><br>
            <label for postcode class="col-md-2 col-md-offset-2 col-sm-12">Postcode</label><input class="col-md-6 col-sm-12" type = "text" name="postcode" value="<?php echo $_SESSION['custPostcode']?>" size="50">
            <br><br>
            <label for contact class="col-md-2 col-md-offset-2 col-sm-12">Contact</label><input class="col-md-6 col-sm-12" type = "text" name="contact" value="<?php echo $_SESSION['custContact']?>" size="50">
            <br><br>
            <label for tel class="col-md-2 col-md-offset-2 col-sm-12">Tel</label><input class="col-md-6 col-sm-12" type = "text" name="tel" value="<?php echo $_SESSION['custTel']?>" size="50">
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12">Email</label><input class="col-md-6 col-sm-12" type = "text" name="email" value="<?php echo $_SESSION['custEmail']?>" size="50">
            <br><br>
            <input type="checkbox" name="updateCustomer" value="updateCustomer" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input class="AddBtn" type="submit" value="Add" name="submit">

        </fieldset>
    </div>
</form>
