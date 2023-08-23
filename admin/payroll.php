<?php
    require('includes/header.php');
?>
<?php 
    if (isset($_POST['submit'])) {
        $emp_id = $_POST['emid'];
        $month = date('m');
        $year = date('y');

        $emp = "SELECT * FROM pay_salary WHERE emp_id = $emp_id AND status = 'Paid' AND month = '$month'";
        $emp_query = mysqli_query($dbconnect, $emp);
        $emp_row = mysqli_fetch_assoc($emp_query);

        if ($emp_row > 0) {
            $error = "<p style='color:red;'> Error: You have completed payment for this employee</p>";
        } else {
            $sql = "UPDATE pay_salary SET status = 'Paid', paid_date = '$today' WHERE emp_id = $emp_id ";
            if ($dbconnect->query($sql) === TRUE) {
                $success = '
                    <div class="col-lg-8 col-md-6 col-sm-5 col-xs-10">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title">
                        </div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success!</strong>salary payment complete.</p>
                        </div>
                    </div>';

                    $loan_sql = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
                    $loan_query = mysqli_query($dbconnect, $loan_sql);
                    $loan = mysqli_fetch_assoc($loan_query);
                    if ($loan['loan'] > 0) {
                        $new_loan = $loan['loan'] - $loan['installment'];
                        $update_loan = "UPDATE emp_salary SET loan = $new_loan WHERE emp_id = $emp_id";
                    
                        if ($dbconnect->query($update_loan) === TRUE) {
                           $success2 = '
                                <div class="col-lg-8 col-md-6 col-sm-5 col-xs-10">
                                    <link rel="stylesheet" href="css/alerts.css">
                                    <div class="alert-title">
                                    </div>
                                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                        <p class="message-alert-none"><strong>Success!</strong>Loan update successfully.</p>
                                    </div>
                                </div>';
                        }else{
                            $error2 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                        }
                    } 
            } else {
                $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }
        }
    }
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-bars" aria-hidden="true"></i> Payroll</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-university" aria-hidden="true"></i> Payroll</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid"> 
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="generate_payroll_list.php" class="text-white"><i class="" aria-hidden="true"></i>  Generate Payslips</a></button>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Payroll List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <div id="example123_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Name</th>
                                            <th>Month </th>
                                            <th>Year </th>
                                            <th>Basic</th>
                                            <th>House Allowance </th>
                                            <th>Medical</th>
                                            <th>Commutance</th>
                                            <th>Loan</th>
                                            <th>Total Paid</th>
                                            <th>Pay Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $month = date('m');
                                        $sql = "SELECT * FROM pay_salary WHERE month = $month ORDER BY status ASC";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $Employee_salary = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        $n = 0; 

                                        foreach ($Employee_salary as $salary) { $n = $n + 1; ?>
                                    <tbody>                                             
                                        <tr role="row" class="odd">
                                            <td><?php echo $n; ?></td>
                                            <td>
                                                <?php 
                                                    $id = $salary['emp_id'];
                                                    $emp_sql = "SELECT * FROM employee WHERE emp_id = '$id' ";
                                                    $emp_query = mysqli_query($dbconnect, $emp_sql);
                                                    $employee_name = mysqli_fetch_assoc($emp_query);

                                                    echo $employee_name['fname']." ".$employee_name['surname'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($salary['month'] == 1) {
                                                        echo "january";
                                                    } else if($salary['month'] == 2) {
                                                        echo "February";
                                                    } else if($salary['month'] == 3) {
                                                        echo "March";
                                                    } else if($salary['month'] == 4) {
                                                        echo "April";
                                                    } else if($salary['month'] == 5) {
                                                        echo "May";
                                                    } else if($salary['month'] == 6) {
                                                        echo "June";
                                                    } else if($salary['month'] == 7) {
                                                        echo "July";
                                                    } else if($salary['month'] == 8) {
                                                        echo "August";
                                                    } else if($salary['month'] == 9) {
                                                        echo "September";
                                                    } else if($salary['month'] == 10) {
                                                        echo "October";
                                                    } else if($salary['month'] == 11) {
                                                        echo "November";
                                                    } else {
                                                        echo "December";
                                                    }
                                                ?>  
                                            </td>
                                            <td><?php if(isset($salary['year'])) echo $salary['year'];?></td>
                                            <td><?php if(isset($salary['basic'])) echo $salary['basic'];?></td>
                                            <td><?php if(isset($salary['house'])) echo $salary['house'];?></td>
                                            <td><?php if(isset($salary['medical'])) echo $salary['medical'];?></td>
                                            <td><?php if(isset($salary['commutance'])) echo $salary['commutance'];?></td>
                                            <td>
                                                <?php 
                                                    $loan_sql = "SELECT * FROM emp_salary WHERE emp_id = $id";
                                                    $loan_query = mysqli_query($dbconnect, $loan_sql);
                                                    $loan = mysqli_fetch_assoc($loan_query);
                                                    echo $loan['loan'];
                                                ?>
                                            </td>
                                            <td><?php if(isset($salary['total'])) echo $salary['total'];?></td>
                                            <td><?php if(isset($salary['paid_date'])) echo $salary['paid_date'];?></td>
                                            <td><?php if(isset($salary['status'])) echo $salary['status'];?></td>
                                            <td class="jsgrid-align-center ">
                                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart">
                                                    <input type="hidden" name="emid" value="<?php echo $id;?>">
                                                    <button type="submit" name="submit" onclick="return confirm('Confirm payment?')" title="complete Salary payment" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-print"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>  
        <?php
            if(isset($success)){
                echo $success;
            }
            if (isset($error)) {
               echo $error;
            }
        ?>   
         <?php
            if(isset($success2)){
                echo $success2;
            }
            if (isset($error2)) {
               echo $error2;
            }
        ?>                  
    </div>
</div>

<?php require ('includes/footer.php');?>