<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 15:08
 */
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
            session_start();
            include "../actions/admin_action.php";
            $action = new admin_action();
            $action->currentCustomers();

            ?>
        </table>

    </div> <!-- Closes customerTable-->
</div>
