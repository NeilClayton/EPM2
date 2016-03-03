<?php
if ((isset($_POST['username'])) && (isset($_POST['password']))){
    //if (isset($_POST['submit'])){
    include "actions/main_action.php";
    $action = new action();
    $action->login();
}
?>

<!DOCTYPE html>
<html class="fullLogin" lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.ico" />

    <title>Enterprise Portfolio Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php
        include('includes/LINavigation.php');
    ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!--<div class ="col-md-3"></div> center whiteOpacity div-->
            <div class="col-md-4 col-md-offset-4 col-sm-12">
                <div class="whiteOpacity">
                    <img src="images\Logo.png" class="logo">
				</div>
                <!-- /.whiteOpacity-->
            </div>
        </div>
        <!-- /.row -->
        <br><br><br>
        <div class="center">
            <button type="button" class="membersBtn">Members</button>
        </div>

        <br><br>
        <div id="LoginForm">


        </div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>
