<?php
    require('includes/header.php');
?>
<?php 
    //submitting advance application
    if (isset($_POST['submit'])) {
        $name = $amount = $period = $installment = $total_due = $app_date = $status = $success = $error = '';

        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $installment = $_POST['installment'];
        $period = $_POST['period'];
        $total_due = 0;
        $app_date = 0;
        $status = 'Pending';

        $sql = "INSERT INTO advance (emp_id, amount, installment, total_due, installment_period, approve_date, status) VALUES ('$name', '$amount', '$installment', '$total_due', '$period', '$app_date', '$status')";
        if ($dbconnect->query($sql) === TRUE) {
            $success = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title">
                    </div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success!</strong> Advance application submitted successfully.</p>
                    </div>
                </div>';
        } else {
            $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
       }
    }

    //Approve advance
    if (isset($_POST['approve'])) {
        $id = $_POST['empl_id'];
        $total = $_POST['total'];
        $installment = $_POST['installment'];
        $approve = $_POST['date'];

        $sql_advance = "SELECT * FROM emp_salary WHERE emp_id = $id AND loan > 0";
        $advance_query = mysqli_query($dbconnect, $sql_advance);
        $rows = mysqli_num_rows($advance_query);

        if ($rows > 0) {
            $error = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title"></div>
                    <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Danger! Employee has an existing advance </strong>.</p>
                    </div>
                </div>';
        } else {
            $sql = "UPDATE advance SET status = 'Granted', total_due = '$total', approve_date = '$today' WHERE emp_id = $id AND approve_date = '$approve' ";
            $sql2 = "UPDATE emp_salary SET loan = '$total', installment = '$installment'  WHERE emp_id = '$id' ";

            if ($dbconnect->query($sql) === TRUE) {
                $success = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title"></div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success! Advance application approved</strong> .</p>
                        </div>
                    </div>';
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
                            <p class="message-alert-none"><strong>Danger! Error: ' .$dbconnect->error.'</strong>.</p>
                        </div>
                    </div>';
            }
            if ($dbconnect->query($sql2) === TRUE) {
                $success2 = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title"></div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success! Advance loan set</strong> .</p>
                        </div>
                    </div>';
            }else{
                $error2 = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title"></div>
                        <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Danger! Error2: ' .$dbconnect->error.'</strong>.</p>
                        </div>
                    </div>';
            }
        }
    }

    //reject advance
    if (isset($_POST['reject'])) {
        $id = $_POST['empl_id'];
        $approve = $_POST['date'];
        $sql = "UPDATE advance SET status = 'Rejected' WHERE emp_id = $id AND approve_date = $approve";
        if ($dbconnect->query($sql) === TRUE) {
            $success = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title"></div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                            <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success! Advance application rejected</strong> .</p>
                    </div>
                </div>';
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
                        <p class="message-alert-none"><strong>Danger! Error: ' .$dbconnect->error.'</strong>.</p>
                    </div>
                </div>';
        }
    }
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>  
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-money" aria-hidden="true"></i> Apply Advance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Apply Advance</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Apply Advance </a></button>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql = "SELECT * FROM advance WHERE status = 'Pending'";
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
                                            <td><?php if(isset($loan['total_due'])) echo $loan['total_due'];?></td>
                                            <td><?php if(isset($loan['approve_date'])) echo $loan['approve_date']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($loan['status'] == 'Pending') {
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >Pending</button> ';
                                                    } elseif ($loan['status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">Rejected</button> ';
                                                    } else {
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">Granted</button> ';
                                                    }
                                                ?>  
                                            </td>
                                            <td class="jsgrid-align-center ">
                                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart">
                                                    <input type="hidden" name="empl_id" value="<?php echo $loan['emp_id'];?>">
                                                    <input type="hidden" name="total" value="<?php echo $loan['amount'];?>">
                                                    <input type="hidden" name="installment" value="<?php echo $loan['installment'];?>">
                                                    <input type="hidden" name="date" value="<?php echo $loan['approve_date'];?>">
                                                    <button type="submit" name="approve" title="Approve leave" class="btn btn-sm btn-success waves-effect waves-light Status">Approve</button>  
                                                    <button type="submit" name="reject" title="Reject leave" class="btn btn-sm btn-danger waves-effect waves-light  Status">Reject</button>
                                                </form>
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
         if (isset($error2)) {
            echo $error2;
        }
        if (isset($success2)) {
            echo $success2;
        }
    ?>     
    
    <!-- sample modal content -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Advance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form role="form" method="post" action="" id="btnSubmit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Employee <i style="color: red;">*</i></label>
                            <select class="form-control custom-select col-md-8" name="name" required="">
                                <option value="">Select Here</option>
                                <option value="<?php echo $_SESSION['emp_id']?>"><?php echo $_SESSION['fname']." ".$_SESSION['surname']; ?></option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Amount <i style="color: red;">*</i></label>
                            <input type="number" name="amount" value="" class="form-control col-md-8 amount" id="recipient-name1" required="">
                        </div>                                                        
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Installment Period <i style="color: red;">*</i></label>
                            <input type="number" name="period" value="" class="form-control col-md-8 period" id="recipient-name1" required="">
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Install Amount <i style="color: red;">*</i></label>
                            <input type="number" name="installment" value="" class="form-control col-md-8 installment" id="recipient-name1" readonly="">
                        </div>                                                                       
                        <div class="modal-footer">
                           <input type="hidden" name="id" value="">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal --> 
    <script type="text/javascript">
        $('.amount, .period').on('input',function() {
            var amount = parseInt($('.amount').val());
            var period = parseFloat($('.period').val());
            $('.installment').val((amount / period ? amount / period : 0).toFixed(2));
        });
    </script>                      
</div>
<?php
    require('includes/footer.php');
?>