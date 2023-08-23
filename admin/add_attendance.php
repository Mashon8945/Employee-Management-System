<?php require('includes/header.php'); 
$dbconnect = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

    if (isset($_POST['approve'])) {
        $atten_date = $_POST['atten-date'];
        $id = $_POST['employee_id']; 
        $sql_update = "UPDATE attendance SET status = 'Approved' WHERE emp_id = $id AND atten_date = '$atten_date' ";
        if ($dbconnect->query($sql_update) === TRUE) {
            $success = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title"></div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success! Attendance approved successfully</strong> .</p>
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

    if (isset($_POST['reject'])) {
        $atten_date = $_POST['atten-date'];
        $id = $_POST['employee_id'];
        $sql_reject = "UPDATE attendance SET status = 'Rejected' WHERE emp_id = $id AND atten_date = '$atten_date' ";
        if ($dbconnect->query($sql_reject) === TRUE) {
            $success = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title"></div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                            <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success! Attendance rejected</strong> .</p>
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
            <h3 class="text-themecolor"><i class="mdi mdi-clipboard-text" aria-hidden="true"></i> Approve attendance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item">Attendance</li>
                <li class="breadcrumb-item active">Approve attendance</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="mdi mdi-clipboard-text"></i> Attendance List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <div id="loan123_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Attendance date</th>
                                            <th>Sign in time</th>
                                            <th>Sign out time</th>
                                            <th>Hours worked</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql = "SELECT * FROM attendance WHERE atten_date = '$today' OR status = 'Pending' ";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $attends = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                        foreach ($attends as $attend) { ?>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td>
                                                <?php 
                                                    if(isset($attend['emp_id'])){
                                                        $emp_id = $attend['emp_id'];

                                                        $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id"; 
                                                        $emp_query = mysqli_query($dbconnect, $emp_sql);
                                                        $employee_name = mysqli_fetch_assoc($emp_query);
                                                        if(isset($employee_name['fname']) && isset($employee_name['surname'])) echo $employee_name['fname']." ".$employee_name['surname'];
                                                    } 
                                                ?>  
                                            </td>
                                            <td><?php if(isset($attend['atten_date'])) echo $attend['atten_date'];?></td>
                                            <td><?php if(isset($attend['signin_time'])) echo $attend['signin_time'];?></td>
                                            <td><?php if(isset($attend['signout_time'])) echo $attend['signout_time'];?></td> 
                                            <td><?php if(isset($attend['working_hours'])) echo $attend['working_hours'];?></td>
                                            <td>
                                                <?php 
                                                    if ($attend['status'] == 'Pending') {
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >'.$attend['status'].'</button> ';
                                                    } elseif ($attend['status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">'.$attend['status'].'</button> ';
                                                    } else {
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">'.$attend['status'].'</button> ';
                                                    }
                                                ?>  
                                            </td>
                                            <td class="jsgrid-align-center ">
                                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart">
                                                    <input type="hidden" name="employee_id" value="<?php echo $attend['emp_id'];?>">
                                                    <input type="hidden" name="atten-date" value="<?php echo $attend['atten_date'];?>">
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
    ?>                          
</div>

<?php require('includes/footer.php');?>