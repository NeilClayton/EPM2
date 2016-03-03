<?php
    //timeout script
	session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    header('location:/EPM2/index.php');
				
?>