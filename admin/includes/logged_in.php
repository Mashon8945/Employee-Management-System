<?php
    // Start the session
    session_start();

    //connect to the database
    $dbconnect = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

    //check whether database connection is successful
    if (!$dbconnect) {
        echo "Database failed to connect" .mysqli_connect_error();
    } else {
        //Create variable to pickup session variable
        $firstName = $_SESSION['fname'];
        $surname = $_SESSION['surname'];
    }

    // Set the last activity time
    if (isset($_SESSION['LAST_ACTIVITY']) && ((time() - $_SESSION['LAST_ACTIVITY']) > 300)) {
        // Unset session variables and destroy the session
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
    if (!isset($_SESSION['fname'])) {
        header('Location: ../login.php');
    }
?>