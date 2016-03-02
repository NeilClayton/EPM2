<?php
/**
 * Created by PhpStorm.
 * User: ncair
 * Date: 24/02/2016
 * Time: 14:44
 */
?>


<div class="loadArea whiteOpacity col-md-10 col-md-offset-2 col-sm-12">


    <div id = "propertyTable">
        <div class="centre"><h1>Select Property to Update</h1></div>

        <table class="center striped">
            <th>Property Ref</th>
            <th>County</th>
            <th>Postcode</th>
            <th>Select</th>
            <?php
            session_start();
            include "../actions/main_action.php";
            $action2 = new action();
            $action2->printPropertiesToUpdate();

            ?>
        </table>

    </div> <!-- Closes propertyTable-->
</div>