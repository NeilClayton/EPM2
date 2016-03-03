<?php
session_start();

    if ($_REQUEST['js_submit_value']) {
        $selectedCompany = $_REQUEST['js_submit_value'];
        $_SESSION['selectedCompany'] = $selectedCompany;
    }

include_once '../actions/admin_action.php'
?>

<div class="loadArea whiteOpacity col-md-6 col-md-offset-3 col-sm-12">


    <div id = "customerTable">
        <div class="centre"><h1>Users</h1></div>
        <table class="center striped">
            <th>Username</th>
            <th>Email</th>

            <?php

            $action = new admin_action();
            $action->getUsers($_SESSION['selectedCompany']);

            ?>
        </table>

    </div> <!-- Closes customerTable-->
</div>
