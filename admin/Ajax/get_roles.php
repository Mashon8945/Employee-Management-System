<?php
    // Connect to the database
    $dbconnect = mysqli_connect("localhost", "Mashon", "M@5h0__.n8L9", "employee_mgt");

    // Retrieve the roles for the selected department from the database
    $departmentId = mysqli_real_escape_string($dbconnect, $_GET['department_id']);
    $query = "SELECT * FROM roles WHERE dept_id = $departmentId";
    $result = mysqli_query($dbconnect, $query);

    // Build an array of roles
    $roles = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $roles[] = $row;
    }

    // Return the roles as JSON
    header('Content-Type: application/json');
    echo json_encode($roles);

    // Close the database connection
    mysqli_close($dbconnect);
?>

