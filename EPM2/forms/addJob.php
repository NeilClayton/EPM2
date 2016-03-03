<?php
/**
 * Created by PhpStorm.
 * User: ncair
 * Date: 02/02/2016
 * Time: 13:00
 */



?>



<div class="loadArea whiteOpacity col-md-8 col-md-offset-2 col-sm-12">


    <div id = "propertyTable">
        <div class="centre"><h1>Select Property to Add Job Too</h1></div>

        <table class="center striped">
                <th>Property Ref</th>
                <th>County</th>
                <th>Postcode</th>
                <th>Select</th>
                <?php
                session_start();
                include "../actions/main_action.php";
                $action2 = new action();
                $action2->grabPropertiesForJobs();

                ?>
            </table>

    </div> <!-- Closes propertyTable-->
</div>
