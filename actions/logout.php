<?php

	session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    echo "<script>alert('You have been logged out and will be redirected to the login page!');</script>";
    header('location:../index.php');
				
?>