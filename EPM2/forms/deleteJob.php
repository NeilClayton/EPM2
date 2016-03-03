<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 11:40
 */
?>
<div class="loadArea whiteOpacity col-md-8 col-md-offset-2 col-sm-12">


    <div id = "propertyTable">
        <div class="centre"><h1>Delete a Job</h1></div>
        <table class="center striped">
            <th>Property Ref</th>
            <th>Title</th>
            <th>Description</th>

            <?php
            session_start();
            include "../actions/main_action.php";
            $action2 = new action();
            $action2->deletableJobs();

            ?>
        </table>

    </div> <!-- Closes propertyTable-->
</div>

