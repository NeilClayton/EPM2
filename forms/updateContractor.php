<?php
session_start();
if ($_REQUEST['js_submit_value']) {
    $ContractorID = $_REQUEST['js_submit_value'];
//echo $PropertyID;
    $_SESSION['contractorID'] = $ContractorID;
    include('../actions/main_action.php');
    $action = new action();
    $action->selectOneContractor($_SESSION['contractorID']);
}
?>


<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Update Contractor</h1>

            <label for contractorname class = "col-md-2 col-md-offset-2 col-sm-12" >Contractor</label><input class="col-md-6 col-sm-12" type = "text" name="contractorname" value ="<?php echo $_SESSION['conCompanyname'] ?>"size="50" autofocus>
            <br><br>
            <label for contact class="col-md-2 col-md-offset-2 col-sm-12" >Contact</label><input class="col-md-6 col-sm-12" type = "text" name="contact" value ="<?php echo $_SESSION['conContact']?>" size="50">
            <br><br>
            <label for address1 class="col-md-2 col-md-offset-2 col-sm-12">Address</label><input class="col-md-6 col-sm-12" type = "text" name="address1"  value ="<?php echo $_SESSION['conAddress1']?>" size="50">
            <br><br>
            <label for address2 class="col-md-2 col-md-offset-2 col-sm-12"></label><input class="col-md-6 col-sm-12" type = "text" name="address2"  value ="<?php echo $_SESSION['conAddress2']?>" size="50">
            <br><br>
            <label for town class="col-md-2 col-md-offset-2 col-sm-12">Town</label><input class="col-md-6 col-sm-12" type = "text" name="town"  value ="<?php echo $_SESSION['conTown']?>" size="50">
            <br><br>
            <label for county class="col-md-2 col-md-offset-2 col-sm-12">County</label><input class="col-md-6 col-sm-12" type = "text" name="county"  value ="<?php echo $_SESSION['conCounty']?>" size="50">
            <br><br>
            <label for postcode class="col-md-2 col-md-offset-2 col-sm-12">Postcode</label><input class="col-md-6 col-sm-12" type = "text" name="postcode"  value ="<?php echo $_SESSION['conPostcode']?>" size="50">
            <br><br>
            <label for tel class="col-md-2 col-md-offset-2 col-sm-12">Tel</label><input class="col-md-6 col-sm-12" type = "text" name="tel"  value ="<?php echo $_SESSION['conTel']?>" size="50">
            <br><br>
            <label for mobile class="col-md-2 col-md-offset-2 col-sm-12">Mobile</label><input class="col-md-6 col-sm-12" type = "text" name="mobile"  value ="<?php echo $_SESSION['conMobile']?>" size="50">
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12">Email</label><input class="col-md-6 col-sm-12" type = "text" name="email"  value ="<?php echo $_SESSION['conEmail']?>" size="50">
            <br><br>
            <label for notes class="col-md-2 col-md-offset-2 col-sm-12">Notes</label><input class="col-md-6 col-sm-12" type = "textarea" name="notes"  value ="<?php echo $_SESSION['conNotes']?>" size="50">
            <br><br>
            <input type="checkbox" name="updateContractor" value="updateContractor" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input type="hidden" name = "Contractor" value="<?php echo $_SESSION['contractorID'];?>">
            <input class="AddBtn" type="submit" value="Update" name="submit">

        </fieldset>
    </div>
</form>
