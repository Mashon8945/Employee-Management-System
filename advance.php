<?php
    require('includes/header.php');

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
                <li class="breadcrumb-item active">Salary</li>
                <li class="breadcrumb-item active">Advance application</li>
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
                                        </tr>
                                    </thead>
                                    <?php
                                        $emp_id = $_SESSION['emp_id'];
                                        $sql = "SELECT * FROM advance WHERE emp_id = $emp_id ORDER BY approve_date";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $nums = mysqli_num_rows($query);

                                        if ($nums > 0) {
                                            $loans = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                            foreach ($loans as $loan) { ?>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <?php if(isset($_SESSION['fname']) && isset($_SESSION['surname'])) echo $_SESSION['fname']." ".$_SESSION['surname'] ;?>
                                                </td>
                                                <td><?php echo $loan['amount']; ?></td>
                                                <td><?php if(isset($loan['installment_period'])) echo $loan['installment_period'];?></td>
                                                <td><?php if(isset($loan['installment'])) echo $loan['installment'];?></td> 
                                                <td><?php if(isset($loan['total_due'])) echo $loan['total_due']; ?></td>
                                                <td><?php if(isset($loan['approve_date'])) echo $loan['approve_date']; ?></td>
                                                <td>
                                                    <?php 
                                                        if ($loan['status'] == 'Pending') {
                                                            echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >'.$loan['status'].'</button> ';
                                                        } elseif ($loan['status'] == 'Rejected') {
                                                            echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">'.$loan['status'].'</button> ';
                                                        } elseif ($loan['status'] == 'Completed') {
                                                            echo '<button type="button" class="btn btn-custon-four btn-primary btn-sm">'.$loan['status'].'</button> ';
                                                        } else {
                                                            echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">'.$loan['status'].'</button> ';
                                                        }
                                                    ?>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php 
                                            }
                                        } else {?>
                                            <tbody>
                                                <tr colspan="7"><td><b style="color: green;">You have Completed your loan advance</b></td></tr>
                                            </tbody>
                                    <?php    }
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
                            <label for="message-text" class="control-label col-md-3">Installment Amount <i style="color: red;">*</i></label>
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