<?php
    session_start();
    include('actions/main_action.php');
    $action = new action(); //instantiate main_action
    $action->isLoggedIn(); //check if user is logged in
    $action->timedOut(); //check for in activity

    if (isset($_POST['addProperty'])) {
        //if (isset($_POST['submit'])){
        $action->addProperty();
    }


    if ((isset($_POST['addContractor']))) {
        $action->addContractor();
    }

    if ((isset($_POST['addJob']))){
        $action->addJob();
    }

    if ((isset($_POST['update']))) {
        $action->updatePropertyinDB();
    }

    if ((isset($_POST['updateContractor']))){
        $action->updateContractorinDB();
    }

    if ((isset($_POST['updateJob']))){
    $action->updateJobinDB();
    }

    if ((isset($_POST['currentPassword'])) && (isset($_POST['password1'])) && (isset($_POST['password2']))){
        $action->changePassword();
    }


?>

<!DOCTYPE html>
<html class="full" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="Neil Clayton" content="">

    <title>Enterprise Portfolio Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">


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
					<p>Welcome to the home screen. From here you can navigate to the area required in order
                    to add, lookup or update your portfolio information. If you get stuck see the help menu
                    located on the navigation bar at the bottom of the page.</p>
				</div>
			</div>
        </div>
        <!-- /.row -->
        <br>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading center">PROPERTIES</div>
                    <div class="panel-body center">
                        <p>Manage your property portfolio</p>
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="propertyLoad btn btn-default">View</button>
                            <button type="button" class="addProperty btn btn-default">Add</button>
                            <button type="button" class="updateProperty btn btn-default">Update</button>
                            <button type="button" class="deleteProperty btn btn-default">Delete</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading center">CONTRACTORS</div>
                    <div class="panel-body center">
                        <p>Manage your contractor information</p>
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="contractorLoad btn btn-default">View</button>
                            <button type="button" class="addContractor btn btn-default">Add</button>
                            <button type="button" class="updateContractor btn btn-default">Update</button>
                            <button type="button" class="deleteContractor btn btn-default">Delete</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading center">JOBS</div>
                    <div class="panel-body center">
                        <p>Manage your jobs</p>
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="jobLoad btn btn-default">View</button>
                            <button type="button" class="addJob btn btn-default">Add</button>
                            <button type="button" class="updateJob btn btn-default">Update</button>
                            <button type="button" class="deleteJob btn btn-default">Delete</button>
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	
	<!--manual raised script-->
	<script src="js/script.js"></script>
    
	<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
