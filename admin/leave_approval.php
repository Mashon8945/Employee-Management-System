<?php
    require('includes/header.php');
?>
<?php
    if (isset($_POST['approve'])) {
        $id = $_POST['empl_id']; 
        $sql = "UPDATE emp_leave SET leave_status = 'Approved' WHERE emp_id = $id AND apply_date";
        if ($dbconnect->query($sql) === TRUE) {
            $emp_sql = "UPDATE employee SET status = 0 WHERE emp_id = $id";
            if ($dbconnect->query($emp_sql) === TRUE) {
                $success = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title"></div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success! Leave application approved</strong> .</p>
                        </div>
                    </div>';
                }
        } else {
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
        $id = $_POST['empl_id'];
        $sql = "UPDATE emp_leave SET leave_status = 'Rejected' WHERE emp_id = $id ";
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
                        <p class="message-alert-none"><strong>Success! Leave application rejected</strong> .</p>
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
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Application</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave Application</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Application </a></button>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Application List                        
                        </h4>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $typeSql  = "SELECT * FROM emp_leave WHERE leave_status = 'Pending' ";
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
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >'.$pending['leave_status'].'</button> ';
                                                    } elseif ($pending['leave_status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">'.$pending['leave_status'].'</button> ';
                                                    } else {
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">'.$pending['leave_status'].'</button> ';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td class="jsgrid-align-center">
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart">
                                                <input type="hidden" name="empl_id" value="<?php echo $pending['emp_id'];?>">
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

        <?php 
            if (isset($_POST['submit'])) {
                $emp_id = $leave_id = $startdate = $enddate = $reason = $duration = '';

                $emp_id = $_POST['emp'];
                $leave_id = $_POST['leavetype'];
                $startdate = $_POST['startdate'];
                $enddate = $_POST['enddate'];
                $duration = $_POST['duration']; 
                $reason = $_POST['reason'];
                $apply_date = $_POST['apply_date'];
                $leave_status = 'Pending';

                $sql = "INSERT INTO emp_leave (emp_id, leave_typeid, start_date, end_date, leave_duration, apply_date, reason, leave_status) VALUES ('$emp_id', '$leave_id', '$startdate', '$enddate', '$duration', '$apply_date', '$reason', '$leave_status')";
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
                                <p class="message-alert-none"><strong>Success! Leave application submitted</strong> .</p>
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
        <?php
            if (isset($success)) {
                echo $success; 
            }
            if (isset($error)) {
                echo $error; 
            }
        ?>
        <!--Leave Application Modal-->
        <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Leave Application</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">    
                            <div class="form-group">
                                <label>Employee<i style="color:red">*</i></label>
                                <?php 
                                    $sql_emp = "SELECT * FROM employee WHERE emp_id = $emp_id";
                                    $emp_query = mysqli_query($dbconnect, $sql_emp);
                                    $emps = mysqli_fetch_assoc($emp_query);
                                ?>
                                <select class=" form-control custom-select selectedEmployeeID" tabindex="1" name="emp" required="">
                                    <option></option>
                                    <option value="<?php echo $emps['emp_id'];?>"><?php echo $emps['fname']." ".$emps['surname']; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Leave Type<i style="color:red">*</i></label>
                                <select class="form-control custom-select assignleave" tabindex="1" name="leavetype" id="" required="">
                                    <option ></option>
                                    <?php 
                                        $sql = "SELECT * FROM leave_type";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $leaves = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                        foreach ($leaves as $types) {
                                    ?>
                                    <option value="<?php echo $types['type_id'];?>"><?php echo $types['name']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" id="hourlyFix">From date<i style="color:red">*</i></label>
                                <input type="date" name="startdate" id="startdate" class="form-control" id="recipient-name1" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">To date<i style="color:red">*</i></label>
                                <input type="date" name="enddate" id="enddate" class="form-control" id="recipient-name1" required="" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Leave Duration<i style="color:red">*</i></label>
                                <input type="text" class="form-control" name="duration" id="duration" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reason<i style="color:red">*</i></label>
                                <textarea class="form-control" name="reason" id="reason" required=""></textarea>   
                            </div>
                            <div class="form-group">
                                <label class="control-label">Leave application date<i style="color:red">*</i></label>
                                <input type="date" class="form-control" name="apply_date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>                  
    </div>
</div>
<script type="text/javascript">
    document.getElementById("enddate").addEventListener("change", calculateDuration);
    function calculateDuration(){
        var startdate = new Date(document.getElementById("startdate").value);
        var enddate = new Date(document.getElementById("enddate").value);

        var difference = enddate.getTime() - startdate.getTime();

        //convert to days
        var seconds = Math.floor(difference/1000);
        var minutes = Math.floor(seconds/60);
        var hours = Math.floor(minutes/60);
        var days = Math.floor(hours/24);

        //format as string and set as duration input
        var duration = days;

        document.getElementById("duration").value = duration;
    }
</script>

<?php
    require('includes/footer.php');
?>