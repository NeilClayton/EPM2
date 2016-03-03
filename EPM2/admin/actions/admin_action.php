<?php

/* action class is used to hold all functions that can be called upon with the web application*/
class admin_action
{

    // Default constructor
    function _construct()
    {

    }

    //function used to produce alert box to inform user of recently conducted update to db
    function update($what, $type)
    {
        echo "<script>alert('Your $what has been $type');</script>";

    }

    function changePassword()
    {
        $thispass = md5($_POST['currentPassword']);
        if ($_POST['password1'] == $_POST['password2']) {
            $newPass = md5($_POST['password1']);
            include_once '../includes/db.php';

            try {
                $sql = "SELECT password FROM users WHERE userID = :thisUserID";
                $result = $pdo->prepare($sql);

                $result->bindParam('thisUserID', $_SESSION['userID']);

                $result->execute();
                $num = $result->fetch(PDO::FETCH_ASSOC);

                if ($thispass == $num['password']) {
                    try {
                        $sql = "UPDATE users SET password = :newPassword WHERE userID = :thisUserID";
                        $result = $pdo->prepare($sql);

                        $result->bindParam(':newPassword', $newPass);
                        $result->bindParam(':thisUserID', $_SESSION['userID']);

                        $result->execute();
                        echo "<script> alert('Your Password has been updated')</script>";

                    } catch (PDOException $e) {
                        echo "ERROR!: " . $e->getMessage();
                    }
                } else {
                    echo "<script> alert('Current Password is incorrect')</script>";
                }

            } catch (PDOException $e) {
                echo "ERROR!: " . $e->getMessage();
                exit();
            }

        }
        else {
            echo "<script> alert('Passwords do not match')</script>";
        }

    }

    function currentCustomers(){
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try{
            $sql = "SELECT * FROM customers";
            $result = $pdo->prepare($sql);
            $result->execute();
            $action_controller->printCustomers($result);


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit;
        }
    }

    function customersAvailable(){
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try{
            $sql = "SELECT * FROM customers";
            $result = $pdo->prepare($sql);
            $result->execute();
            $action_controller->displayCustomers($result);


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit;
        }

    }

    function getUsers($companyID){
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try{
            $sql = "SELECT * FROM users WHERE customerID = :custID";
            $result = $pdo->prepare($sql);
            $result->bindParam(':custID', $companyID);
            $result->execute();
            $action_controller->companyUsers($result);


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit;
        }
    }

    function updateableCustomers(){
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try{
            $sql = "SELECT * FROM customers";
            $result = $pdo->prepare($sql);
            $result->execute();
            $action_controller->printUpdatableCustomers($result);


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit;
        }
    }

    function addThisUser($ID){

        include_once '../includes/db.php';
        try{
            $sql = "INSERT INTO users (username, password, email, customerID) VALUES (:username, :pass, :em, :custID)";
            $result = $pdo->prepare($sql);
            $result->bindParam(':username', $_POST['username'] );
            $result->bindParam(':pass', $_POST['password1']);
            $result->bindParam(':em', $_POST['email']);
            $result->bindParam(':custID', $ID);

            $result->execute();

            self::update('customer', 'added');

        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
        }
    }

    function insertCustomerIntoDB(){
        include_once '../includes/db.php';
        try{
            $sql = "INSERT INTO customers (companyname, address1, address2, town, county, postcode, contact, tel, email)
                    VALUES (:nme, :add1, :add2, :twn, :coun, :pc, :cont, :tel, :em)";
            $result = $pdo->prepare($sql);

            $result->bindParam(':nme', $_POST['companyname']);
            $result->bindParam(':add1', $_POST['address1']);
            $result->bindParam(':add2', $_POST['address2']);
            $result->bindParam(':twn', $_POST['town']);
            $result->bindParam(':coun', $_POST['county']);
            $result->bindParam(':pc', $_POST['postcode']);
            $result->bindParam(':cont', $_POST['contact']);
            $result->bindParam(':tel', $_POST['tel']);
            $result->bindParam(':em', $_POST['email']);

            $result->execute();

            self::update('customer', 'added');

        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
        }
    }

    function getUserDetails($ID){
        include_once '../includes/db.php';
        try{
            $sql = "SELECT * FROM users WHERE userID = :userID";
            $result = $pdo->prepare($sql);
            $result->bindParam(':userID', $ID);
            $result->execute();


            while ($row=$result->fetch(PDO::FETCH_ASSOC)){
                $_SESSION['thisUserID'] = $row['userID'];
                $_SESSION['updateUsername'] = $row['username'];
                $_SESSION['updateEmail'] = $row['email'];
            }

        }catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
        }
    }

    function updateThisUser(){
        include_once '../includes/db.php';
        try{
            $sql = "UPDATE users SET username = :username, email = :email WHERE userID = :userID";
            $result = $pdo->prepare($sql);
            $result->bindParam(':username', $_POST['username']);
            $result->bindParam(':email', $_POST['email']);
            $result->bindParam(':userID', $_SESSION['thisUserID']);
            $result->execute();

            self::update('user', 'updated');


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit();
        }
    }

    function selectOneCustomer($ID){
        include '../includes/db.php';
        try {
            $sql = "SELECT * FROM customers WHERE customerID = :custID";

            $result = $pdo->prepare($sql);

            $result->bindParam(":custID", $ID);

            $result->execute();


            while($row=$result->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['custCompanyname'] = $row['companyname'];
                $_SESSION['custAddress1'] = $row['address1'];
                $_SESSION['custAddress2'] = $row['address2'];
                $_SESSION['custTown'] = $row['town'];
                $_SESSION['custCounty'] = $row['county'];
                $_SESSION['custPostcode'] = $row['postcode'];
                $_SESSION['custContact'] = $row['contact'];
                $_SESSION['custTel'] = $row['tel'];
                $_SESSION['custEmail'] = $row['email'];
            }



        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
            exit();
        }

    }

    function updateCustomerInDB(){
        include_once '../includes/db.php';
        try{
            $sql = "UPDATE customers SET companyname = :compname, address1 = :add1, address2 = :add2, town = :twn, county = :coun,
                    postcode = :pc, contact = :contact, tel = :tel, email = :em WHERE customerID = :custID";

            $result = $pdo->prepare($sql);
            $result->bindParam(":compname", $_POST['companyname']);
            $result->bindParam(":add1", $_POST['address1']);
            $result->bindParam(":add2", $_POST['address2']);
            $result->bindParam(":twn", $_POST['town']);
            $result->bindParam(":coun", $_POST['county']);
            $result->bindParam(":pc", $_POST['postcode']);
            $result->bindParam(":contact", $_POST['contact']);
            $result->bindParam(":tel", $_POST['tel']);
            $result->bindParam(":em", $_POST['email']);
            $result->bindParam(":custID", $_SESSION['customerUpdateID']);

            $result->execute();
            self::update('customer', 'updated');

        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit();
        }
    }

    function deleteCustomerList()
    {
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try {
            $sql = "SELECT * FROM customers";
            $result = $pdo->prepare($sql);
            $result->execute();
            $action_controller->printDeleteCustomers($result);


        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
            exit;
        }
    }

    function selectCustomer(){
        include_once '../includes/db.php';
        include_once '../actions/admin_controller.php';
        $action_controller = new Admin_Controller();

        try{
            $sql = "SELECT * FROM customers";
            $result = $pdo->prepare($sql);
            $result->execute();
            $action_controller->customerList($result);


        } catch (PDOException $e){
            echo "ERROR!: " . $e->getMessage();
            exit;
        }
    }
}

