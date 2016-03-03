<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 30/12/2015
 * Time: 19:19
 */

    /* action class is used to hold all functions that can be called upon with the web application*/
    class action
    {

        // Default constructor
        function _construct()
        {

        }

        //Login function to check user credentials before allowing access
        function login()
        {
            //create variables to store user information / attempted login information
            if (isset($_POST['username'])) {

                $thisuser = filter_var($_POST['username'], FILTER_SANITIZE_STRING); //filter input to prevent sql injection
            }
            if (isset($_POST['password'])) {
                $thispass = md5($_POST['password']); //MD5 encryption used on passwords - consider adding salt
            }
            //connect to epm_db
            include('includes/db.php');

            //validation of login request, if user not logged in start session
            if (!isset($_SESSION)) {
                session_start();
            }

            //attempt to login

            try {
                $sql = "SELECT userID, customerID, username, password FROM users WHERE username = :username AND password = :password";
                $result = $pdo->prepare($sql);

                $result->bindParam(":username", $thisuser);
                $result->bindParam(":password", $thispass);

                $result->execute();
            } catch (PDOException $e) {
                echo "ERROR!: " . $e->getMessage();
                exit();
            }

            $num = $result->fetch(PDO::FETCH_ASSOC);
            if ($num > 0) {
                $_SESSION['username'] = $thisuser;
                $_SESSION['userID'] = $num['userID'];
                $_SESSION['customerID'] = $num['customerID'];
                $_SESSION['last_action'] = time();

                if ($_SESSION['customerID'] == 1){
                    header('location:admin/admin.php');
                }
                else{
                    header('location:home.php');
                }


            } else {

            }
        }



        //function allows user to change their password
        function changePassword(){
            $thispass = md5($_POST['currentPassword']);
            if ($_POST['password1']== $_POST['password2']){
                $newPass = md5($_POST['password1']);
                include_once 'includes/db.php';

                try{
                    $sql = "SELECT password FROM users WHERE userID = :thisUserID";
                    $result = $pdo->prepare($sql);

                    $result->bindParam('thisUserID', $_SESSION['userID']);

                    $result->execute();
                    $num = $result->fetch(PDO::FETCH_ASSOC);

                    if ($thispass == $num['password']){
                        try{
                            $sql = "UPDATE users SET password = :newPassword WHERE userID = :thisUserID";
                            $result = $pdo->prepare($sql);

                            $result->bindParam(':newPassword', $newPass);
                            $result->bindParam(':thisUserID', $_SESSION['userID']);

                            $result->execute();
                            echo "<script> alert('Your Password has been updated')</script>";

                        } catch (PDOException $e){
                            echo "ERROR!: " . $e->getMessage();
                        }
                    }
                    else{
                        echo "<script> alert('Current Password is incorrect')</script>";
                    }

                } catch (PDOException $e){
                    echo "ERROR!: ". $e->getMessage();
                    exit();
                }

            }
            else {
                echo "<script> alert('Passwords do not match')</script>";
            }

        }

        //Check to ensure user is logged in and not trying to bypass the login screen
        function isLoggedIn()
        {
            if (!isset($_SESSION['username'])) {
                header('location:index.php');
            }
        }



        //Used to determine if the user has been inactive for 15 mins or more. If they have destroy session and
        //redirect to index.php
        function timedOut()
        {
            if (isset($_SESSION['last_action']) && (time() - $_SESSION['last_action'] > 15 * 60)) {
                // last request was more than 15 minutes ago
                session_unset();     // unset $_SESSION variable for the run-time
                session_destroy();   // destroy session data in storage
                header('location:index.php');
            }
        }



        //sql query the db to return all property data associated with the users organisation
        function grabPropertyData()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM properties WHERE customerID = :custID ";

                $result = $pdo->prepare($sql);

                $result->bindParam(":custID", $_SESSION['customerID']);

                $result->execute();

                $controller->printPropertyTable($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }

        //SQL query database to grab all jobs associated with users organisation
        function grabCurrentJobs()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {

                $sql = "SELECT * FROM joblist LEFT JOIN properties ON joblist.propertyID = properties.propertyID
                        LEFT JOIN jobnotes ON joblist.jobID = jobnotes.jobID WHERE properties.customerID = :custID";

                //$sql = "SELECT * FROM properties LEFT JOIN joblist ON properties.propertyID = joblist.propertyID
                //	WHERE properties.customerID = :custID";

                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printJobsTable($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }

        }

        function updateableJobs(){
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {

                $sql = "SELECT * FROM joblist LEFT JOIN properties ON joblist.propertyID = properties.propertyID
                        LEFT JOIN jobnotes ON joblist.jobID = jobnotes.jobID WHERE properties.customerID = :custID";

                //$sql = "SELECT * FROM properties LEFT JOIN joblist ON properties.propertyID = joblist.propertyID
                //	WHERE properties.customerID = :custID";

                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printUpdateableJobs($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }
        //SQL query database to return all contractors that are associated with the users organisation
        function getCurrentContractors()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM contractors LEFT JOIN propertycontractors ON contractors.contractorID =
                        propertycontractors.contractorID WHERE customerID = :custID";
                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printContractorTable($result);
            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }



        //function used to add new properties to the database
        function addProperty()
        {
            include '/includes/db.php';



            try{
                $sql = "INSERT INTO properties (customerID, propertyref, address1, address2, town, county, postcode, tel, fax, email, userID)
                        VALUES (:custID, :ref, :add1, :add2, :town, :county, :postcode, :tel, :fax, :email, :userid)";

                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->bindParam(":ref", $_POST['propertyref']);
                $result->bindParam(":add1", $_POST['address1']);
                $result->bindParam(":add2", $_POST['address2']);
                $result->bindParam(":town", $_POST['town']);
                $result->bindParam(":county", $_POST['county']);
                $result->bindParam(":postcode", $_POST['postcode']);
                $result->bindParam(":tel", $_POST['tel']);
                $result->bindParam(":fax", $_POST['fax']);
                $result->bindParam(":email", $_POST['email']);
                $result->bindParam("userid", $_SESSION['userID'] );
                $result->execute();

                //call to update fuction to produce user notification of property insert
                self::update("Property", "Added");

            } Catch (PDOException $e){
                echo "ERROR!: " . $e . getMessage();
                exit();
            }

        }


        //function used to add new jobs to the database
        function addJob(){

            include '/includes/db.php';

            try{

                $sql = "INSERT INTO joblist (propertyID, jobdescription) VALUES (:propID, :jobTitle);
                       INSERT INTO jobnotes (jobID, description) VALUES (LAST_INSERT_ID(), :descrip);";

                $result= $pdo->prepare($sql);
                $result->bindParam(":propID", $_POST['property'], PDO::PARAM_INT);
                $result->bindParam(":jobTitle", $_POST['description']);
                $result->bindParam(":descrip", $_POST['jobdescription']);
                $result->execute();

                self::update("job", "added");

            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }

        //function used in order to add new contractors to the database
        function addContractor()
        {
            include '/includes/db.php';




            try{
                $sql = "INSERT INTO contractors (companyname, contact, address1, address2, town, county, postcode, tel, mobile, email, notes, userID)
                        VALUES (:companyname, :contact, :add1, :add2, :town, :county, :postcode, :tel, :mobile, :email, :notes, :custid)";

                $result = $pdo->prepare($sql);
                $result->bindParam(":companyname", $_POST['contractorname']);
                $result->bindParam(":contact", $_POST['contact']);
                $result->bindParam(":add1", $_POST['address1']);
                $result->bindParam(":add2", $_POST['address2']);
                $result->bindParam(":town", $_POST['town']);
                $result->bindParam(":county", $_POST['county']);
                $result->bindParam(":postcode", $_POST['postcode']);
                $result->bindParam(":tel", $_POST['tel']);
                $result->bindParam(":mobile", $_POST['mobile']);
                $result->bindParam(":email", $_POST['email']);
                $result->bindParam(":notes", $_POST['notes']);
                $result->bindParam(":custid", $_SESSION['customerID'] );
                $result->execute();

                $id = $pdo->lastInsertId();

                $sql = "INSERT INTO propertycontractors (customerID, contractorID) VALUES (:custID, :contractID)";
                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->bindParam(":contractID", $id);
                $result->execute();
//
//                try {
//                    $sql = "INSERT INTO propertycontractors (proe)"
//                } Catch (PDOException $e){
//                    echo "ERROR!: " . $e;
//                    exit();
//                }

                //call to update fuction to produce user notification of property insert
                self::update("Contractor", "Added");

            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }


        //function used to produce alert box to inform user of recently conducted update to db
        function update($what, $type)
        {
            echo "<script>alert('Your $what has been $type');</script>";

        }

        //sql query the db to return all property data associated with the users organisation
        function grabPropertiesForJobs()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM properties WHERE customerID = :custID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":custID", $_SESSION['customerID']);

                $result->execute();

                $controller->printPropertiesToAddJobs($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }

        //gets all properties from the DB related to the customer and calls controller to print to screen
        function printPropertiesToUpdate(){
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM properties WHERE customerID = :custID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":custID", $_SESSION['customerID']);

                $result->execute();

                $controller->printPropertiesToUpdate($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }
        //function selects single property from DB and assigns values to session variable
        function selectOneProptery($ID){
            include '../includes/db.php';
            try {
                $sql = "SELECT * FROM properties WHERE propertyID = :propID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":propID", $ID);

                $result->execute();


                while($row=$result->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['propertyref'] = $row['propertyref'];
                    $_SESSION['address1'] = $row['address1'];
                    $_SESSION['address2'] = $row['address2'];
                    $_SESSION['town'] = $row['town'];
                    $_SESSION['county'] = $row['county'];
                    $_SESSION['postcode'] = $row['postcode'];
                    $_SESSION['tel'] = $row['tel'];
                    $_SESSION['fax'] = $row['fax'];
                    $_SESSION['email'] = $row['email'];
                }



            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }

        }

        function selectOneContractor($ID){
            include '../includes/db.php';
            try {
                $sql = "SELECT * FROM contractors WHERE contractorID = :conID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":conID", $ID);

                $result->execute();


                while($row=$result->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['conCompanyname'] = $row['companyname'];
                    $_SESSION['conContact'] = $row['contact'];
                    $_SESSION['conAddress1'] = $row['address1'];
                    $_SESSION['conAddress2'] = $row['address2'];
                    $_SESSION['conTown'] = $row['town'];
                    $_SESSION['conCounty'] = $row['county'];
                    $_SESSION['conPostcode'] = $row['postcode'];
                    $_SESSION['conTel'] = $row['tel'];
                    $_SESSION['conMobile'] = $row['mobile'];
                    $_SESSION['conEmail'] = $row['email'];
                    $_SESSION['conNotes'] = $row['notes'];
                }
            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }
        function selectOneJob($ID){
            include '../includes/db.php';
            try {
                $sql = "SELECT * FROM joblist LEFT JOIN properties ON joblist.propertyID = properties.propertyID
                        LEFT JOIN jobnotes ON joblist.jobID = jobnotes.jobID WHERE joblist.jobID = :thisJobID";
                $result = $pdo->prepare($sql);

                $result->bindParam(":thisJobID", $ID);

                $result->execute();


                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['jobTitle'] = $row['jobdescription'];
                    $_SESSION['jobDescription'] = $row['description'];
                }
            } catch (PDOException $e) {
                    echo "ERROR!: " . $e->getMessage();
                    exit();
                }
        }




        // updates property in the DB with what the user has entered
        function updatePropertyinDB(){
            include 'includes/db.php';
            try{
                $sql = "UPDATE properties SET propertyref = :propref, address1 = :add1, address2 = :add2,
                          town = :twn, county = :coun, postcode = :pc, tel = :telephone, fax = :facsimile, email = :em
                          WHERE propertyID = :propID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":propref", $_POST['propertyref']);
                $result->bindParam(":add1", $_POST['address1']);
                $result->bindParam(":add2", $_POST['address2']);
                $result->bindParam(":twn", $_POST['town']);
                $result->bindParam(":coun", $_POST['county']);
                $result->bindParam(":pc", $_POST['postcode']);
                $result->bindParam(":telephone", $_POST['tel']);
                $result->bindParam(":facsimile", $_POST['fax']);
                $result->bindParam(":em", $_POST['email']);
                $result->bindParam(":propID", $_SESSION['propertyID']);

                $result->execute();
                //call update function to notify user that the property has been updated
                self::update('property information', 'updated');


            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }

        }

        function updateContractorinDB(){
            include 'includes/db.php';
            try{
                $sql = "UPDATE contractors SET companyname = :compname, contact = :cont, address1 = :add1, address2 = :add2,
                          town = :twn, county = :coun, postcode = :pc, tel = :telephone, mobile = :mob, email = :em, notes = :note
                          WHERE contractorID = :contID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":compname", $_POST['contractorname']);
                $result->bindParam(":cont", $_POST['contact']);
                $result->bindParam(":add1", $_POST['address1']);
                $result->bindParam(":add2", $_POST['address2']);
                $result->bindParam(":twn", $_POST['town']);
                $result->bindParam(":coun", $_POST['county']);
                $result->bindParam(":pc", $_POST['postcode']);
                $result->bindParam(":telephone", $_POST['tel']);
                $result->bindParam(":mob", $_POST['mobile']);
                $result->bindParam(":em", $_POST['email']);
                $result->bindParam(":note", $_POST['notes']);
                $result->bindParam(":contID", $_SESSION['contractorID']);

                $result->execute();
                //call update function to notify user that the property has been updated
                self::update('contractor information', 'updated');


            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }

        function updateJobinDB(){
            include 'includes/db.php';

            try{
                $sql = "UPDATE joblist SET jobdescription = :jobTitle WHERE joblist.jobID = :thisJobID;
                        UPDATE jobnotes SET description = :jobDescription WHERE jobnote.jobID = :thisJobID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":jobTitle", $_POST['description']);
                $result->bindParam(":jobDescription", $_POST['jobdescription']);
                $result->bindParam(":thisJobID", $_SESSION['jobID']);
                $result->execute();

                self::update('job', 'updated');

            } catch (PDOException $e){
                echo "ERROR!: " . $e->getMessage();
                exit();
            }
        }
        function deletableProperties(){
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM properties WHERE customerID = :custID";

                $result = $pdo->prepare($sql);

                $result->bindParam(":custID", $_SESSION['customerID']);

                $result->execute();

                $controller->printDeletableProperties($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }
        }

        function deleteableContractors(){
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM contractors LEFT JOIN propertycontractors ON contractors.contractorID =
                        propertycontractors.contractorID WHERE customerID = :custID";
                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printDeletableContractors($result);
            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }

        function deletableJobs(){
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {

                $sql = "SELECT * FROM joblist LEFT JOIN properties ON joblist.propertyID = properties.propertyID
                        LEFT JOIN jobnotes ON joblist.jobID = jobnotes.jobID WHERE properties.customerID = :custID";

                //$sql = "SELECT * FROM properties LEFT JOIN joblist ON properties.propertyID = joblist.propertyID
                //	WHERE properties.customerID = :custID";

                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printDeletableJobs($result);

            } catch (PDOException $e) {
                echo "ERROR!: " . $e . getMessage();
                exit();
            }

        }

        function deleteProperty($data){

            echo "<script>alert('$data') </script>";

        }



        function getUpdateableContractors()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM contractors LEFT JOIN propertycontractors ON contractors.contractorID =
                        propertycontractors.contractorID WHERE customerID = :custID";
                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printContractorToUpdate($result);
            } Catch (PDOException $e) {
                echo "ERROR!: " . $e->getMessage();
                exit();
            }
        }
    }
?>