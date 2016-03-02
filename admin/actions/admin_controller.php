<?php

class Admin_Controller
{

    //default constructor
    function _construct()
    {
    }

    function printCustomers($customerInformation){

        while ($row = $customerInformation->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['companyname'] . "</td>";
            echo "<td>" . $row['address1'] . "</td>";
            echo "<td>" . $row['town'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>" . $row['tel'] . "</td>";
            echo "</tr>";
        }

    }


}
