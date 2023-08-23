<?php require("includes/header.php");?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-money"></i> Payroll Report</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Payroll Report</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="payroll.php" class="text-white"><i class="" aria-hidden="true"></i>Payroll List</a></button>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Departments monthly Payroll Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Generate monthly payroll report</h4>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-material row">
                                            <div class="form-group col-md-3">
                                                <select class="form-control custom-select" name="department"  id="employee_id" required="">
                                                    <option value="">Department</option>
                                                    <option value = "0">All departments</option>
                                                    <?php
                                                        $sql = "SELECT * FROM department";
                                                        $query = mysqli_query($dbconnect, $sql);
                                                        $employee = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                        foreach($employee as $emp){
                                                    ?>
                                                    <option <?php if(isset($dept_id) && $month == '01') echo 'selected';?> value="<?php if(isset($emp['ID'])) echo $emp['ID']; ?>"><?php if(isset($emp['dept_name'])) echo $emp['dept_name']; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <select class="form-control custom-select" name="month"  id="employee_id" required="">
                                                    <?php $Current_month = date('m'); ?>
                                                    <option>Month</option>
                                                    <option value="01" <?php if($Current_month == '01') echo 'selected';?> >January</option>
                                                    <option value="02" <?php if($Current_month == '02') echo 'selected';?> >February</option>
                                                    <option value="03" <?php if($Current_month == '03') echo 'selected';?> >March</option>
                                                    <option value="04" <?php if($Current_month == '04') echo 'selected';?> >April</option>
                                                    <option value="05" <?php if($Current_month == '05') echo 'selected';?> >May</option>
                                                    <option value="06" <?php if($Current_month == '06') echo 'selected';?> >June</option>
                                                    <option value="07" <?php if($Current_month == '07') echo 'selected';?> >July</option>
                                                    <option value="08" <?php if($Current_month == '08') echo 'selected';?> >August</option>
                                                    <option value="09" <?php if($Current_month == '09') echo 'selected';?> >September</option>
                                                    <option value="10" <?php if($Current_month == '10') echo 'selected';?> >October</option>
                                                    <option value="11" <?php if($Current_month == '11') echo 'selected';?> >November</option>
                                                    <option value="12" <?php if($Current_month == '12') echo 'selected';?> >December</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input type="year" name="year" class="form-control mydatetimepickerFull" placeholder="Year" required="">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <button type="submit" class="btn btn-success" name="submit" >Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <?php
                            if (isset($_POST['submit'])) {
                                $dept_id = $_POST['department'];
                                $month = $_POST['month'];
                                $year = $_POST['year'];

                                $sql = "SELECT employee.fname, employee.surname, pay_salary.month, pay_salary.year, pay_salary.paid_date ,pay_salary.total, pay_salary.status 
                                        FROM employee
                                        LEFT JOIN pay_salary
                                        ON employee.emp_id = pay_salary.emp_id
                                        WHERE employee.dept_id = $dept_id AND pay_salary.month = $month AND pay_salary.year = $year";
                                $query = mysqli_query($dbconnect, $sql);
                                $num_rows = mysqli_num_rows($query);     
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?php 
                                                $select = "SELECT dept_name FROM department WHERE ID = $dept_id"; 
                                                $select_query = mysqli_query($dbconnect, $select);
                                                $name = mysqli_fetch_assoc($select_query);
                                                echo $name['dept_name'];
                                            ?> department report
                                        </h4>
                                        <div class="table-responsive ">
                                            <table id="example234" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Month</th>
                                                        <th>Year</th>
                                                        <th>Paid date</th>
                                                        <th>Total Paid</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if ($num_rows > 0 ) {
                                                    $reports = mysqli_fetch_all($query, MYSQLI_ASSOC);  
                                                    $n = 0;  
                                                    $total = 0; 

                                                    foreach($reports as $report){
                                                        $total = $total + $report['total'];
                                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php $n = $n + 1; echo $n; ?></td>
                                                        <td><?php if(isset($report['fname']) && isset($report['surname'])) echo $report['fname']." ".$report['surname']; ?></td>
                                                        <td>
                                                            <?php 
                                                                if(isset($report['month']) && $report['month'] == '01') echo "January";
                                                                if(isset($report['month']) && $report['month'] == '02') echo "February";
                                                                if(isset($report['month']) && $report['month'] == '03') echo "March";
                                                                if(isset($report['month']) && $report['month'] == '04') echo "April";
                                                                if(isset($report['month']) && $report['month'] == '05') echo "May";
                                                                if(isset($report['month']) && $report['month'] == '06') echo "June";
                                                                if(isset($report['month']) && $report['month'] == '07') echo "July";
                                                                if(isset($report['month']) && $report['month'] == '08') echo "August";
                                                                if(isset($report['month']) && $report['month'] == '09') echo "September";
                                                                if(isset($report['month']) && $report['month'] == '10') echo "October";
                                                                if(isset($report['month']) && $report['month'] == '11') echo "November";
                                                                if(isset($report['month']) && $report['month'] == '12') echo "December";
                                                            ?>
                                                            
                                                        </td>
                                                        <td><?php if(isset($report['year'])) echo $report['year'];?></td>
                                                        <td><?php if(isset($report['paid_date'])) echo $report['paid_date'];?></td>
                                                        <td><?php if(isset($report['total'])) echo $report['total'];?></td>
                                                        <td><?php if(isset($report['status'])) echo $report['status'];?></td>
                                                    </tr>
                                                </tbody>
                                                <?php } ?>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total payment: ksh</td>
                                                        <td><?php echo $total; ?></td>
                                                    </tr>
                                                </tfoot>
                                                <?php
                                                } else {
                                                    $error = "<b style='color:red'>No data found! </b>";
                                                }
                                                ?>     
                                            </table>
                                        </div>
                                        <?php 
                                            if (isset($error)) echo $error; 
                                            if (isset($total)) {?>
                                        <?php } ?>  
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <?php
                            }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("includes/footer.php"); ?>

