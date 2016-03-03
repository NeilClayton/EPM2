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

    function printUpdatableCustomers($customerInformation){
        while ($row = $customerInformation->fetch(PDO::FETCH_ASSOC)) {
            $value = $row['customerID'];
            echo "<tr>";
            echo "<td>" . $row['companyname'] . "</td>";
            echo "<td>" . $row['address1'] . "</td>";
            echo "<td>" . $row['town'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>" . $row['tel'] . "</td>";
            echo "<td>" . "<input type='submit' name=" . $value . " value='Update' class = 'updateThisCustomer'>" . "</td>";
            echo "</tr>";
        }
    }

    function printDeleteCustomers($customerInformation)
    {
        while ($row = $customerInformation->fetch(PDO::FETCH_ASSOC)) {
            $value = $row['customerID'];
            echo "<tr>";
            echo "<td>" . $row['companyname'] . "</td>";
            echo "<td>" . $row['address1'] . "</td>";
            echo "<td>" . $row['town'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>" . $row['tel'] . "</td>";
            echo "<td>" . "<input type='submit' name=" . $value . " value='Delete' class = 'deleteThisCustomer'>" . "</td>";
            echo "</tr>";
        }
    }

    function displayCustomers($customerInformation){
        while ($row = $customerInformation->fetch(PDO::FETCH_ASSOC)) {
            $value = $row['customerID'];
            echo "<tr>";
            echo "<td>" . $row['companyname'] . "</td>";
            echo "<td>" . $row['address1'] . "</td>";
            echo "<td>" . $row['town'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>" . $row['tel'] . "</td>";
            if ($_SESSION['Action'] == 'Add'){
                echo "<td>" . "<input type='submit' name=" . $value . " value='Add User' class = 'addNewUser'>" . "</td>";
            }
            else {
                echo "<td>" . "<input type='submit' name=" . $value . " value='Select' class = 'displayUsers'>" . "</td>";
            }
            echo "</tr>";
        }
    }

    function companyUsers($companyUsers){
        while ($row = $companyUsers->fetch(PDO::FETCH_ASSOC)){
            $user = $row['userID'];
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            if ($_SESSION['Action'] == 'Update'){
                echo "<td>" . "<input type='submit' name=" . $user . " value='Update' class = 'updateUser'>" . "</td>";
            }
            elseif ($_SESSION['Action'] == 'Delete'){
                echo "<td>" . "<input type='submit' name=" . $user . " value='Delete' class = 'deleteUser'>" . "</td>";
            }
            elseif ($_SESSION['Action'] == 'Reset'){
                echo "<td>" . "<input type='submit' name=" . $user . " value='Reset' class = 'resetUser'>" . "</td>";
            }
            echo "</tr>";

        }


    }

}
