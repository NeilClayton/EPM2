<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 01/03/2016
 * Time: 18:23
 */
if ($_POST['param']) {
    $ID = $_POST['param'];
}

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action = $_POST['action'];
    switch($action){
        case 'customer' : deleteCustomer($ID);
            break;
        case 'user' : deleteUser($ID);
            break;
        case 'reset' : resetPassword($ID);
            break;

    }
}


function deleteCustomer($custID){
    include_once '../includes/db.php';

    try{
        $sql = "DELETE FROM customers WHERE customerID = :custID;
                DELETE FROM users WHERE customerID = :custID";
        $result = $pdo->prepare($sql);

        $result->bindParam(':custID', $custID);

        $result->execute();

        echo "The customer and all related users have been removed";

    } catch (PDOException $e){
        echo "ERROR!: " . $e->getMessage();
        exit();
    }
}

function deleteUser($userID){
    include_once  '../includes/db.php';

    try{
        $sql = "DELETE FROM users WHERE userID = :userID";
        $result = $pdo->prepare($sql);
        $result->bindParam(':userID', $userID);
        $result->execute();
        echo "User has been deleted";

    } catch (PDOException $e){
        echo "ERROR!: " . $e->getMessage();
        exit();
    }
}

function resetPassword($ID){
    include_once '../includes/db.php';
    try {
        $sql = "UPDATE users SET password = :newPassword WHERE userID = :thisUserID";
        $result = $pdo->prepare($sql);
        $newPass = md5('default');
        $result->bindParam(':newPassword', $newPass);
        $result->bindParam(':thisUserID', $ID);

        $result->execute();
        echo "The users password has been reset to 'default'. Please advise to change password!";

    } catch (PDOException $e) {
        echo "ERROR!: " . $e->getMessage();
    }
}
