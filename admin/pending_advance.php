<?php
    require('includes/header.php');
?>
<?php
    $sql = "SELECT emp_salary.emp_id, emp_salary.loan, emp_salary.installment, advance.status
            FROM emp_salary 
            LEFT JOIN advance
            ON emp_salary.emp_id = advance.emp_id
            WHERE advance.status = 'Granted' AND emp_salary.loan <= 0 ";
    $query = mysqli_query($dbconnect, $sql);
    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach($results as $res){
            $emp_id = $res['emp_id'];

            $status_update = "UPDATE advance SET status = 'Completed' WHERE emp_id = $emp_id AND status = 'Granted' ";
            if ($dbconnect->query($status_update) === TRUE) {
                $update = "UPDATE emp_salary SET installment = 0 WHERE emp_id = $emp_id";
                if ($dbconnect->query($update) === TRUE) {
                    $success = '';
                }else{
                    $error = '
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <link rel="stylesheet" href="css/alerts.css">
                            <div class="alert-title"></div>
                            <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                <p class="message-alert-none"><strong>Danger! Error: '.$dbconnect->error.'</strong>.</p>
                            </div>
                        </div>';
                }
            }
        }
    }
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>  
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-money" aria-hidden="true"></i> Granted Advance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Advance</li>
                <li class="breadcrumb-item active">Granted Advance</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i>Advance </a></button>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Advance List                     
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <div id="loan123_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="loan123_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Installment period</th>
                                            <th>Installment</th>
                                            <th>Total Due</th>
                                            <th>Approved Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql = "SELECT * FROM advance WHERE status = 'Granted' OR status = 'Completed' ORDER BY approve_date DESC";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $loans = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                        foreach ($loans as $loan) { ?>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td>
                                                <?php 
                                                    if(isset($loan['emp_id'])){
                                                        $emp_id = $loan['emp_id'];

                                                        $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id"; 
                                                        $emp_query = mysqli_query($dbconnect, $emp_sql);
                                                        $employee_name = mysqli_fetch_assoc($emp_query);
                                                        if(isset($employee_name['fname']) && isset($employee_name['surname'])) echo $employee_name['fname']." ".$employee_name['surname'];
                                                    } 
                                                ?>  
                                            </td>
                                            <td><?php if(isset($loan['amount'])) echo $loan['amount'];?></td>
                                            <td><?php if(isset($loan['installment_period'])) echo $loan['installment_period'];?></td>
                                            <td><?php if(isset($loan['installment'])) echo $loan['installment'];?></td> 
                                            <td>
                                                <?php 
                                                    $emp_id = $loan['emp_id'];
                                                    $loan_sql = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
                                                    $loan_query = mysqli_query($dbconnect, $loan_sql);
                                                    $Loan_balance = mysqli_fetch_assoc($loan_query);

                                                    echo $Loan_balance['loan'];
                                                ?>     
                                            </td>
                                            <td><?php if(isset($loan['approve_date'])) echo $loan['approve_date']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($loan['status'] == 'Pending') {
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >Pending</button> ';
                                                    } elseif ($loan['status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">Rejected</button> ';
                                                    } elseif ($loan['status'] == 'Granted') {
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">Granted</button> ';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-custon-four btn-primary btn-sm">Completed</button> ';
                                                    }
                                                ?>  
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php 
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <?php 
        if (isset($error)) {
            echo $error;
        }
        if (isset($success)) {
            echo $success;
        }
    ?>                          
</div>
<?php
    require('includes/footer.php');
?>