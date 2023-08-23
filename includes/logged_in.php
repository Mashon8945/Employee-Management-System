<?php
    // Start the session
    session_start();

    //connect to the database
    $dbconnect = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

    //check whether database connection is successful
    if (!$dbconnect) {
        echo "Database failed to connect" .mysqli_connect_error();
    } else {
        $firstName = $_SESSION['fname'];
        $surname = $_SESSION['surname'];
    } 
    $session_timeout = 300;

    if (isset($_SESSION['last_activity'])) {
        $time_diff = time() - $_SESSION['last_activity'];

        if ($time_diff > $session_timeout) {
            session_unset();
            session_destroy();
        }
    }  
    // Update the last activity time session variable to the current time
    $_SESSION['last_activity'] = time();
    
    //check whether the user is logged in
    if (!isset($_SESSION['fname'])) {
        header('Location: login.php');
    }
?>