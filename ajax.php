<?php
    // Connect to database
    $dbconnect = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

    // Retrieve project start date and end date based on project ID
    if (isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        $sql = "SELECT start_date, end_date FROM project WHERE ID = '$project_id'";
        $result = mysqli_query($dbconnect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Return start date and end date as JSON object
            echo json_encode([
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date']
            ]);
        }
    }

    date_default_timezone_set('Africa/Nairobi');
    $today = date('Y-m-d');

    //check attendance
    session_start();
    $emp_id = $_SESSION['emp_id'];
    if (isset($emp_id)) {
        $sql = "SELECT * FROM attendance WHERE emp_id = $emp_id AND atten_date = '$today'";
        $query = mysqli_query($dbconnect, $sql);
        $attendance = mysqli_fetch_assoc($query);

        if (!$attendance) {
            $response = array('status' => 'error', 'message' => 'Please sign attendance before continuing');
            echo json_encode($response);
        }
    }

    mysqli_close($dbconnect);
?>