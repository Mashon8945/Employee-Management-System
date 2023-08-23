<?php
    //connect to the database
    $dbconnect = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

    //check whether database connection is successful
    if (!$dbconnect) {
        echo "Database failed to connect" .mysqli_connect_error();
        } 
?>