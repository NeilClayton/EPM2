<?php

    if ($_REQUEST['js_submit_value']){
        $PropertyID = $_REQUEST['js_submit_value'];
        //echo $PropertyID;
        $_SESSION['propertyID'] = $PropertyID;
    }
?>


<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

    <div class="whiteOpacity">
        <fieldset>
            <h1>Add a Job</h1>
            <?php echo $_SESSION['propertyID']; ?>
            <label for description class = "col-md-2 col-md-offset-2 col-sm-12" >Job Title</label><input class="col-md-6 col-sm-12" type = "text" name="description" size="50" autofocus>
            <br><br>
            <label for jobdescription class="col-md-2 col-md-offset-2 col-sm-12" >Job Details</label><input class="col-md-6 col-sm-12" type = "text" name="jobdescription" size="50">
            <br><br>
            <input class="AddBtn" type="submit" value="Add" name="submit">

        </fieldset>
    </div>
</form>

