<?php require('includes/header.php'); ?>

<?php
    $emp_id = $_SESSION['emp_id'];
    $month = date('m');
    $year = date('Y');

    $sql = "SELECT * FROM pay_salary WHERE emp_id = '$emp_id' AND month = '$month' AND year = '$year' ";
    $query = mysqli_query($dbconnect, $sql);
    $rows = mysqli_num_rows($query);
    
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Payslip</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-university" aria-hidden="true"></i> Payslip</li>
            </ol>
        </div>
    </div>
    <style type="text/css">
        table.table.table-hover thead{
            background-color: #e8e8e8;
        }
    </style>
<?php if($rows > 0){?>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-8">
                <button type="button" class="btn btn-primary print_payslip_btn"><i class="fa fa-print"></i><i class="" aria-hidden="true" onclick="printDiv()"></i>  Print</button>
            </div>
        </div>
        <div class="row payslip_print" id="payslip_print">
            <div class="col-md-10">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-6 col-sm-6">
                            <img src="assets/images/hrinv.png" style=" width:180px; margin-right: 10px;">
                        </div>
                        <div class="col-md-5 col-xs-6 col-sm-6"></div>
                        <div class="col-md-3 col-xs-6 col-sm-6 text-left payslip_address">
                            <?php 
                                $month = date('m');
                                $year = date('Y');

                                $addr_sql = "SELECT * FROM address WHERE emp_id = $emp_id";
                                $addr_query = mysqli_query($dbconnect, $addr_sql);
                                $address = mysqli_fetch_assoc($addr_query);
                            ?>
                            <p><?php if(isset($address['address'])) echo $address['address'];?></p>
                            <p><?php if(isset($address['city']) && isset($address['country'])) echo $address['city'].", ".$address['country'];?></p>
                            <?php
                                $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
                                $query = mysqli_query($dbconnect, $sql);
                                $emp = mysqli_fetch_assoc($query); 
                            ?>
                            <p>Phone: 0<?php if(isset($emp['contact'])) echo $emp['contact'];?><br/> Email: <?php if(isset($emp['email'])) echo $emp['email'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h5 style="margin-top: 15px;">Payslip for the <?php echo $month." month of ".$year;?></h5>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-12">
                            <table class="table table-condensed borderless payslip_info" style="width: 100%">
                                <tbody>
                                    <?php 
                                        $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
                                        $emp_query = mysqli_query($dbconnect, $emp_sql);
                                        $emp_data = mysqli_fetch_assoc($emp_query);
                                    ?>
                                    <tr>
                                        <td>Employee PIN</td>
                                        <td>: <?php if(isset($emp_data['emp_id'])) echo $emp_data['emp_id'];?></td>
                                        <td>Employee Name</td>
                                        <td>: <?php if(isset($emp_data['fname']) && isset($emp_data['surname'])) echo $emp_data['fname']." ".$emp_data['surname']; ?></td>
                                    </tr>
                                    <?php 
                                        $dept_id = $emp_data['dept_id'];

                                        $dept_sql = "SELECT * FROM department WHERE ID = $dept_id";
                                        $dept_query = mysqli_query($dbconnect, $dept_sql);
                                        $dept_data = mysqli_fetch_assoc($dept_query);

                                        $deg = $emp_data['designation'];

                                        $role_sql = "SELECT * FROM roles WHERE ID = $deg";
                                        $role_query = mysqli_query($dbconnect, $role_sql);
                                        $role_data = mysqli_fetch_assoc($role_query);
                                    ?>
                                    <tr>
                                        <td>Department</td>
                                        <td>: <?php if(isset($dept_data['dept_name'])) echo $dept_data['dept_name'];?></td>
                                        <td>Designation</td>
                                        <td>: <?php if(isset($role_data['role_name'])) echo $role_data['role_name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Pay Date</td>
                                        <td>: <input type="hidden" name="today" value="<?php echo $today;?>"></td>
                                        <td>Date of Joining</td>
                                        <td>: <?php if(isset($emp_data['joining_date'])) echo $emp_data['joining_date'];?></td>
                                    </tr>
                                    <?php 
                                        $bank_sql = "SELECT * FROM bank_info WHERE emp_id = $emp_id";
                                        $bank_query = mysqli_query($dbconnect, $bank_sql);
                                        $bank_data = mysqli_fetch_assoc($bank_query);
                                    ?>
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>: <?php if(isset($bank_data['bank_name'])) echo $bank_data['bank_name']; ?></td>
                                        <td>Branch Name</td>
                                        <td>: <?php if(isset($bank_data['branch_name'])) echo $bank_data['branch_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Account Name</td>
                                        <td>: <?php if(isset($bank_data['holder_name'])) echo $bank_data['holder_name'];?></td>
                                        <td>Account Number</td>
                                        <td>: <?php if(isset($bank_data['account_number'])) echo $bank_data['account_number'];?> <input type="hidden" name="account_number" value="<?php if(isset($bank_data['account_number'])) echo $bank_data['account_number'];?>"> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <style>
                        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td { padding: 2px 5px; }
                    </style>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed borderless" style="border-left: 1px solid #ececec; width: 100%;">
                                <?php
                                    $sql = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $salary = mysqli_fetch_assoc($query);

                                ?>
                                <thead class="thead-light" style="border: 1px solid #ececec;">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-right">Earnings</th>
                                        <th class="text-right">Deductions</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #ececec;">
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td class="text-right"><?php echo $salary['basic_salary'];?> Ksh <input type="hidden" name="basic" value="<?php echo $salary['basic_salary'];?>"></td>
                                        <td class="text-right"> </td>
                                    </tr>
                                    <tr>
                                        <td>Medical Allowance</td>
                                        <td class="text-right"> <?php echo $salary['medical_allowance'];?> Ksh </td>
                                        <td class="text-right"> <input type="hidden" name="medical" value="<?php echo $salary['medical_allowance'];?>"> </td>
                                    </tr>
                                    <tr>
                                        <td>House Allowance</td>
                                        <td class="text-right"><?php echo $salary['house_allowance'];?> Ksh</td>
                                        <td class="text-right"> <input type="hidden" name="house" value="<?php echo $salary['house_allowance'];?>"> </td>
                                    </tr>
                                    <tr>
                                        <td>Commutance Allowance</td>
                                        <td class="text-right"><?php echo $salary['commute_allowance'];?> Ksh</td>
                                        <td class="text-right"> <input type="hidden" name="commute" value="<?php echo $salary['commute_allowance'];?>"> </td>
                                    </tr>  
                                    <?php
                                        $basic = $salary['basic_salary'];
                                        $house = $salary['house_allowance'];
                                        $medical = $salary['medical_allowance'];
                                        $commute = $salary['commute_allowance'];

                                        $gross = $basic + $house + $medical + $commute;
                                        $nhif = 0.034 * $gross ;
                                        $paye = 0.16 * $gross;
                                        $total = $salary['total'] - $salary['installment'];
                                    ?>
                                    <tr>
                                        <td>PAYE</td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><?php echo $paye; ?> ksh</td>
                                    </tr>
                                    <tr>
                                        <td>NHIF</td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><?php echo $nhif; ?> Ksh</td>
                                    </tr>
                                    <tr>
                                        <td>NSSF</td>
                                        <td class="text-right"> </td>
                                        <td class="text-right"> 200 ksh</td>
                                    </tr>
                                    <tr>
                                        <td>Loan</td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><?php echo $salary['installment'];?> Ksh</td>
                                    </tr>
                                </tbody>
                                <tfoot class="tfoot-light">
                                    <tr>
                                        <th>Total</th>
                                        <th class="text-right"> <?php echo $gross; ?></th>
                                        <th class="text-right"><?php echo $salary['deductions'];?> Ksh</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-right">Net Pay</th>
                                        <th class="text-right"><?php echo $total;?> Ksh <input type="hidden" name="total" value="<?php echo $total;?>"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-8">
                <h3 style="color: red;"><i>Pay slip not yet generated</i></h3>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<?php require('includes/footer.php');?>
   
<script src="assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
<script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".print_payslip_btn").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.payslip_print").printArea(options);
        });
    });
</script>               