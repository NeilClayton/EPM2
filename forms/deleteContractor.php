<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 10:46
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 02/03/2016
 * Time: 09:22
 */

?>

<div class="loadArea whiteOpacity col-md-10 col-md-offset-1 col-sm-12">


    <div id = "ContractorTable">
        <div class="centre"><h1>Delete Contractor</h1></div>
        <table class="center striped">
            <th>Company</th>
            <th>Contact</th>
            <th>Town</th>
            <th>Tel</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Select</th>

            <?php
            session_start();
            include "../actions/main_action.php";
            $action2 = new action();
            $action2->deleteableContractors();

            ?>
        </table>

    </div> <!-- Closes propertyTable-->
</div>

