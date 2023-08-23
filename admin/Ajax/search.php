<?php
    // Connect to database
    $dbconnect = new mysqli("localhost", "Mashon", "M@5h0__.n8L9", "Employee_mgt");

    // Get the search term from the query string
    $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';

    // If the search term is empty, return an empty response
    if ($searchTerm === '') {
      echo '';
      exit;
    }

    // Sanitize the search term
    $searchTerm = $dbconnect->real_escape_string($searchTerm);

    // Query to retrieve data from the table that match the search term
    $sql = "SELECT * FROM employee WHERE fname LIKE '%$searchTerm%' OR surname LIKE '%$searchTerm%' ORDER BY fname";
    $result = $dbconnect->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
      // Loop through the results and create an HTML table row for each result
      $output = '<table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" style="width: 100%;">';
      $output .= '<tr>
                        <th>No.</th>
                        <th>Employee Name</th>
                        <td>Email</td>
                        <td>Contact</td>
                        <td>Employee Type</td>
                        <td>Role</td>
                        <td>Action</td>
                  </tr>';
        $n = 0;
      while ($row = $result->fetch_assoc()) {
        $emp_id = $row['emp_id'];
        $profile_url = "employee_edit.php?emp_id=".$emp_id; 
        $n++;
        $deg = $row['designation'];
        $sql_query = "SELECT * FROM roles WHERE ID = $deg";
        $deg_query = mysqli_query($dbconnect, $sql_query);
        $desig = mysqli_fetch_assoc($deg_query); 
        $output .= '<tr>
                        <td>' . $n .'</td>
                        <td>' . $row['fname'].' '.$row['surname'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>0'. $row['contact'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $desig['role_name'] . '</td>
                        <td class="jsgrid-align-center ">
                          <form method="post">
                              <input type="hidden" name="userid" value=" ">
                              <a href="'. $profile_url .'" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                              <a href="" title="delete" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm("Are you sure to delete this data?")"><i class="fa fa-trash-o"></i></a>
                          </form>
                        </td>
                    </tr>';
      }
      $output .= '</table>';
      echo $output;
    } else {
      echo 'No results found.';
    }

    // Close database connection
    $dbconnect->close();
?>
