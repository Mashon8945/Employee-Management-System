<?php require('includes/header.php'); ?>

<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="mdi mdi-clipboard-text"></i>Attendance Report</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Attendance</li>
                <li class="breadcrumb-item active">Attendance report</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-clipboard-text"></i>Attendance Report</h4>
                        <form method="post" action="" class="form-material row">
                            <div class="form-group col-md-3">
                                <input type="date" name="date_from" id="date_from" class="form-control mydatetimepickerFull" placeholder="From" required="">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="date" name="date_to" id="date_to" class="form-control mydatetimepickerFull" placeholder="To" required="">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control custom-select" name="employee"  id="employee_id" required="">
                                    <option value="">Employee</option>
                                    <?php
                                        $sql = "SELECT * FROM employee";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $employee = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        foreach($employee as $emp){
                                    ?>
                                    <option value="<?php if(isset($emp['emp_id'])) echo $emp['emp_id']; ?>"><?php if(isset($emp['fname']) && isset($emp['surname'])) echo $emp['fname']." ".$emp['surname']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="submit" class="btn btn-success" value="submit" name="submit" id="getAtdReport">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if (isset($_POST['submit'])) {
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $emp_id = $_POST['employee'];
            $error = '';

            $sql = "SELECT * FROM attendance WHERE emp_id = $emp_id AND status = 'Approved' AND atten_date >= '$date_from' AND atten_date <= '$date_to'";
            $result = mysqli_query($dbconnect, $sql);
            $num_rows = mysqli_num_rows($result);

            $total_duration = 0;

            // Loop through the query results and add up the duration values
            if ($num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach($rows as $row){
                    $total_duration += $row["working_hours"];
                }
            }

            // Step 1: Retrieve attendance data from the database
            // Connect to database and fetch attendance data
            // Example query: SELECT date, status FROM attendance WHERE month = 'May'
            $sql_date = "SELECT atten_date FROM attendance WHERE emp_id = $emp_id AND status = 'Approved' AND atten_date >= '$date_from' AND atten_date <= '$date_to'";
            $result = mysqli_query($dbconnect, $sql);

            // Step 2: Generate the calendar structure
            function generateCalendar($year, $month) {
                // Generate HTML structure for the calendar using loops and table elements
                // You can customize the layout and styling according to your needs
            }

            // Step 3: Display the calendar
            $year = date('Y');
            $month = date('n');
            generateCalendar($year, $month);

        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body EmployeeInfo">
                        <h3 class="employee_name">Employee</h3>
                        Worked <span class="hours"></span><?php echo $total_duration; ?> Hours in <span class="days"></span><?php echo $num_rows ; ?> days
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Full attendance</h4>
                        <div class="table-responsive ">
                            <table id="example234" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th>Hour</th>
                                    </tr>
                                </thead>
                                <?php
                                        $sql = "SELECT * FROM attendance WHERE emp_id = $emp_id AND status = 'Approved' AND atten_date >= '$date_from' AND atten_date <= '$date_to' ORDER BY atten_date ASC";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $num_rows = mysqli_num_rows($query);

                                        if ($num_rows > 0) {
                                            $attendances = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                            $n = 0; 

                                            foreach ($attendances as $attends) { $n = $n + 1; ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $n; ?></td>
                                        <td>
                                            <?php 
                                                $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
                                                $emp_query = mysqli_query($dbconnect, $emp_sql);
                                                $empl_data = mysqli_fetch_assoc($emp_query);
                                                echo $empl_data['fname']." ".$empl_data['surname']; 
                                            ?>          
                                        </td>
                                        <td><?php if(isset($attends['atten_date'])) echo $attends['atten_date'];?></td>
                                        <td><?php if(isset($attends['signin_time'])) echo $attends['signin_time'];?></td>
                                        <td><?php if(isset($attends['signout_time'])) echo $attends['signout_time'];?></td>
                                        <td><?php if(isset($attends['working_hours'])) echo $attends['working_hours'];?></td>
                                    </tr>
                                </tbody>
                                <?php
                                            }
                                        } else {
                                            $error = "<h4><b style='color:green'>No data found! </b></h4>";
                                        }
                                   }
                                ?>
                            </table>
                            <?php if (isset($error)) echo $error; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<?php require('includes/footer.php');?>