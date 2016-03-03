
<?php
SESSION_START();

if ($_SESSION['customerID'] != 1){
    header('location:../home.php');
}

include('actions/admin_action.php');
$action = new admin_action(); //instantiate main_action

if ((isset($_POST['currentPassword'])) && (isset($_POST['password1'])) && (isset($_POST['password2']))){
    $action->changePassword();
}

if ((isset($_POST['addCustomer']))){
    $action->insertCustomerIntoDB();
}

if ((isset($_POST['updateCustomer']))){
    $action->updateCustomerInDB();
}

if (isset($_POST['addUser'])){
    if ($_POST['password1'] == $_POST['password2']) {
        $action->addThisUser($_SESSION['selectedCompany']);
    }
    else{
        echo "<script>alert('Passwords do not match')</script>>";
    }
}

if (isset($_POST['updateUser'])){
    $action->updateThisUser();
}
?>



<!DOCTYPE html>
<html class="fullAdmin" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="Neil Clayton" content="">

    <title>Enterprise Portfolio Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
include ('includes/navigation.php');
?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="whiteOpacity">
                <h1>Hi <?php echo $_SESSION['username']?>.</h1>
                <p>Welcome back to the Admin Panel.</p>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <br>
    <div class="row">
        <div class="col-md-4 col-md-offset-1 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading center">Customers</div>
                <div class="panel-body center">
                    <p>Manage Customer Information</p>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="customerLoad btn btn-default">View</button>
                        <button type="button" class="addCustomer btn btn-default">Add</button>
                        <button type="button" class="updateCustomer btn btn-default">Update</button>
                        <button type="button" class="deleteCustomer btn btn-default">Delete</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading center">Users</div>
                <div class="panel-body center">
                    <p>Manage User Information</p>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" name = "View" class="userControl btn btn-default">View</button>
                        <button type="button" name = "Add" class="userControl btn btn-default">Add</button>
                        <button type="button" name = "Update" class="userControl btn btn-default">Update</button>
                        <button type="button" name = "Delete" class="userControl btn btn-default">Delete</button>
                        <button type="button" name = "Reset" class="userControl btn btn-default">Password Reset</button>
                    </div>
                </div>
            </div>

        </div>




        </div>

    </div>

    <!-- loaded forms -->
    <div class="row">
        <div id="loadArea">

        </div>
    </div>

</div>
<br>
<!-- /.container -->






<script src="../js/jquery.js"></script>

<!--manual raised script-->
<script src="js/script.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>

