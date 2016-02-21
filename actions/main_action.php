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

                header('location:home.php');

            } else {
                header('location:../failed.php');
            }
        }

        /* end of login function*/

        //Check to ensure user is logged in and not trying to bypass the login screen
        function isLoggedIn()
        {
            if (!isset($_SESSION['username'])) {
                header('location:index.php');
            }
        }

        /* end of isLoggedIn function*/

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

        /* end of timedOut function */

        //sql query the db to return all property data associated with the users organisation
        function grabPropertyData()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM properties WHERE customerID = :custID";

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

                $sql = "SELECT * FROM joblist LEFT JOIN properties ON joblist.propertyID = properties.propertyID WHERE
						properties.customerID = :custID";

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

        //SQL query database to return all contractors that are associated with the users organisation
        function getCurrentContractors()
        {
            include '../includes/db.php';
            include '../actions/controller.php';
            $controller = new Controller();
            try {
                $sql = "SELECT * FROM contractors LEFT JOIN propertycontractors ON contractors.contractorID =
                        propertycontractors.contractorID WHERE propertycontractors.customerID IN(select propertyID
                        FROM properties WHERE customerID = :custID)";
                $result = $pdo->prepare($sql);
                $result->bindParam(":custID", $_SESSION['customerID']);
                $result->execute();
                $controller->printContractorTable($result);
            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }

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



        function addJob(){

            include '/includes/db.php';
            $propertyID = $_SESSION['propertyID'];

            try{
                $sql = "INSERT INTO joblist (propertyID, jobdescription) VALUES (:propID, :jobTitle);
                        INSERT INTO jobnotes (jobID, description) VALUES (LAST_INSERT_ID(), :descrip);";
                $result= $pdo->prepare($sql);
                $result->bindParam(":propID", $propertyID);
                $result->bindParam(":jobTitle", $_POST['description']);
                $result->bindParam(":descrip", $_POST['jobdescription']);
                $result->execute();
            //STUCK HERE, PROPERTY ID IS NOT BEING INSERTED AND SECOND INSERT IS NOT RUNNING AT ALL
                //LAST_INSERT_ID MAY NOT BE WORKING AT ALL????



            } Catch (PDOException $e){
                echo "ERROR!: " . $e;
                exit();
            }
        }


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


    }
?>