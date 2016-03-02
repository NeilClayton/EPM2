<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 11:51
 */
?>
<?php
session_start();
if ($_REQUEST['js_submit_value']){
    $jobID = $_REQUEST['js_submit_value'];
    $_SESSION['jobID'] = $jobID;
    include('../actions/main_action.php');
    $action = new action();
    $action->selectOneJob($_SESSION['jobID']);
}
?>


<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Update Job</h1>
            <label for description class = "col-md-2 col-md-offset-2 col-sm-12" >Job Title</label><input class="col-md-6 col-sm-12" type = "text" name="description" value="<?php echo $_SESSION['jobTitle'] ?>" size="50" autofocus>
            <br><br>
            <label for jobdescription class="col-md-2 col-md-offset-2 col-sm-12" >Job Details</label><input class="col-md-6 col-sm-12" type = "text" name="jobdescription" value="<?php echo $_SESSION['jobDescription'] ?>" size="50">
            <br><br>
            <input type="checkbox" name="updateJob" value="updateJob" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input type="hidden" name = "property" value="<?php echo $_SESSION['propertyID'];?>">
            <input class="AddBtn" type="submit" value="Update" name="submit">

        </fieldset>
    </div>
</form>


