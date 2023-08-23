<?php
    require('includes/header.php');
?>
<?php
    $sql = "SELECT * FROM emp_leave";
    $query = mysqli_query($dbconnect, $sql);
    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach($results as $res){
            $emp_id = $res['emp_id'];
            $update = "UPDATE emp_leave SET leave_status = 'Completed' WHERE end_date <= '$today' AND leave_status = 'Approved' ";
            if ($dbconnect->query($update) === FALSE) {
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
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Leave report</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Leave</li>
                <li class="breadcrumb-item active">Leave report</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Report List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>Apply Date</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Reason</th>
                                        <th>Leave Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    $typeSql  = "SELECT * FROM emp_leave ORDER BY apply_date DESC";
                                    $typeQuery = mysqli_query($dbconnect, $typeSql);
                                    $Leaves = mysqli_fetch_all($typeQuery, MYSQLI_ASSOC);

                                    foreach ($Leaves as $pending) {?>
                                <tbody>
                                    <tr style="vertical-align:top">
                                        <td>
                                            <?php 
                                                $emp_p = $pending['emp_id'];
                                                $empl = "SELECT * FROM employee WHERE emp_id = $emp_p";
                                                $empl_Q = mysqli_query($dbconnect, $empl);
                                                $Name = mysqli_fetch_assoc($empl_Q);
                                            ?>
                                            <span><?php if( isset($Name['fname']) && isset($Name['surname']) ) echo $Name['fname']." ".$Name['surname']; ?></span>
                                        </td>                        
                                        <td>
                                            <?php 
                                                if(isset($pending['leave_typeid'])) $leavetype = $pending['leave_typeid'];
                                                $leftSql = "SELECT * FROM leave_type WHERE type_id = $leavetype";
                                                $leftQuery = mysqli_query($dbconnect, $leftSql);
                                                $left = mysqli_fetch_assoc($leftQuery);
                                                echo $left['name'];
                                            ?>    
                                        </td>
                                        <td><?php if(isset($pending['apply_date'])) echo $pending['apply_date'];?></td>
                                        <td><?php if(isset($pending['start_date'])) echo $pending['start_date'];?></td>
                                        <td><?php if(isset($pending['end_date'])) echo $pending['end_date'];?></td>
                                        <td><?php if(isset($pending['leave_duration'])) echo $pending['leave_duration'];?></td>
                                        <td><?php if(isset($pending['reason'])) echo $pending['reason'];?></td>
                                        <td>
                                            <?php 
                                                if(isset($pending['leave_status'])) {
                                                    if ($pending['leave_status'] == 'Pending') {
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status btn-sm" >'.$pending['leave_status'].'</button> ';
                                                    } elseif ($pending['leave_status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status btn-sm" >'.$pending['leave_status'].'</button> ';
                                                    } elseif ($pending['leave_status'] == 'Approved'){
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status btn-sm">'.$pending['leave_status'].'</button> ';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-custon-four btn-primary btn-sm">'.$pending['leave_status'].'</button> ';
                                                    }
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
        <?php 
            if (isset($error)) {
                echo $error;
            }
            if (isset($success)) {
                echo $success;
            }
        ?>  
    </div>
</div>

<?php
    require('includes/footer.php');
?>