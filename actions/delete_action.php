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
        case 'property' : deleteProperty($ID);
            break;
        case 'contractor' : deleteContractor($ID);
            break;
        case 'job' : deleteJob($ID);
            break;

    }
}


function deleteProperty($prop){
    include_once '../includes/db.php';

    try {
        $sql = "DELETE FROM properties WHERE propertyID = :propID";
        $result = $pdo->prepare($sql);

        $result->bindParam(":propID", $prop);

        $result->execute();

        echo "Your property has now been deleted";

    } catch (PDOException $e) {
        echo "ERROR!: " . $e . getMessage();
        exit();
    }

}


function deleteContractor ($contractor){
    include_once '../includes/db.php';

    try{
        $sql = "DELETE FROM contractors WHERE contractorID = :contID";
        $result = $pdo->prepare($sql);

        $result->bindParam(":contID", $contractor);

        $result->execute();
        echo "The contractor has now been deleted";

    } catch (PDOException $e){
        echo "ERROR!: " . $e->getmessage();
        exit();
    }
}

function deleteJob ($job){
    include_once  '../includes/db.php';
    try{
        $sql = "DELETE FROM joblist WHERE jobID = :thisJobID;
                DELETE FROM jobnotes WHERE jobID = :thisJobID";
        $result = $pdo->prepare($sql);

        $result->bindParam(":thisJobID", $job);

        $result->execute();
        echo "The job has now been deleted";

    } catch (PDOException $e){
        echo "ERROR!: " . $e->getMessage();
        exit();
    }

}

