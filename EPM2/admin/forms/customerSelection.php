<?php
    session_start();
    if ($_REQUEST['js_submit_value']) {
        $requiredAction = $_REQUEST['js_submit_value'];
        $_SESSION['Action'] = $requiredAction;
    }
    include_once '../actions/admin_action.php'
?>

<div class="loadArea whiteOpacity col-md-6 col-md-offset-3 col-sm-12">


    <div id = "customerTable">
        <div class="centre"><h1>Current Customers</h1></div>
        <table class="center striped">
            <th>Company</th>
            <th>Address</th>
            <th>Town</th>
            <th>Contact</th>
            <th>Telephone</th>


            <?php

            $action = new admin_action();
            $action->customersAvailable();

            ?>
        </table>

    </div> <!-- Closes customerTable-->
</div>
