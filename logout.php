<?php 
	//Start the session
	session_start();
    
    session_unset();

    //Redirect the user to the login page
    header('Location: login.php');
?>