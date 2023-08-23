<?php
    require('includes/header.php');
?>
<?php
    if (isset($_POST['approve'])) {
       $id = $_POST['task_id']; 
       $appr = 'Approved';
       $sql = "UPDATE project_tasks SET approve_status = '$appr' WHERE ID = $id ";
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
                        <p class="message-alert-none"><strong>Success! Task application approved</strong> .</p>
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
        $id = $_POST['task_id'];
        $sql = "UPDATE project_tasks SET approve_status = 'Rejected' WHERE ID = $id ";
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
                        <p class="message-alert-none"><strong>Success! Task application rejected</strong> .</p>
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
            <h3 class="text-themecolor"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Tasks</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Tasks </a></button>
                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="project.php" class="text-white"><i class="" aria-hidden="true"></i>  Project List</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Task List                   
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: ">Project Title</th>
                                        <th style="width: 40px">Start Date </th>
                                        <th style="width: 40px">End Date </th>
                                        <th style="width: 77px;">Assigned Employees </th>
                                        <th>Approval status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $pro_sql = "SELECT * FROM project_tasks"; 
                                    $pro_query = mysqli_query($dbconnect, $pro_sql);
                                    $tasks = mysqli_fetch_all($pro_query, MYSQLI_ASSOC);

                                    foreach ($tasks as $task) {
                                 ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php 
                                                if (isset($task['project_id'])) {
                                                    $pro_id = $task['project_id'];
                                                    $sql = "SELECT * FROM project WHERE ID = $pro_id";
                                                    $query = mysqli_query($dbconnect, $sql);
                                                    $pro = mysqli_fetch_assoc($query);

                                                    if(isset($pro['name'])) echo $pro['name'];
                                            ?>
                                        </td>
                                        <td><?php if(isset($pro['start_date'])) echo $pro['start_date']; ?></td>
                                        <td><?php if(isset($pro['end_date'])) echo $pro['end_date']; ?></td> 
                                        <td>
                                            <?php
                                                $assigned_sql = "SELECT * FROM assign_employee_tasks WHERE project_id = $pro_id";
                                                $assigned_query = mysqli_query($dbconnect, $assigned_sql);
                                                $assigned_emp = mysqli_fetch_all($assigned_query, MYSQLI_ASSOC);

                                                foreach ($assigned_emp as $emp) {
                                                    $emp_id = $emp['assigned_employee'];
                                                    $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
                                                    $query = mysqli_query($dbconnect, $sql);
                                                    $employee = mysqli_fetch_assoc($query);
                                                ?>
                                            <img src="assets/images/users/<?php if (isset($employee['image'])) echo $employee['image'];?>" height="40px" width="40px" style="border-radius:50px" alt="" data-toggle="tooltip" data-placement="top" title="<?php if(isset($employee['fname'])) echo $employee['fname']." ".$employee['surname'];?>">
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(isset($task['approve_status'])) {
                                                    if ($task['approve_status'] == 'Pending') {
                                                        echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >'.$task['approve_status'].'</button> ';
                                                    } elseif ($task['approve_status'] == 'Rejected') {
                                                        echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">'.$task['approve_status'].'</button> ';
                                                    } else {
                                                        echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">'.$task['approve_status'].'</button> ';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <form method="post" action="" enctype="multipart">
                                                <input type="hidden" name="task_id" value="<?php echo $task['ID'];?>">
                                                <button type="submit" name="approve" title="Approve tasks" class="btn btn-sm btn-success waves-effect waves-light Status">Approve</button>  
                                                <button type="submit" name="reject" title="Reject tasks" class="btn btn-sm btn-danger waves-effect waves-light  Status">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php 
                                                }
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
    <script>
        $(document).ready(function() {
            $('#project-select').change(function() {
                var project_id = $(this).val();

                // AJAX call to retrieve project start date and end date from database
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: { project_id: project_id },
                    success: function(data) {
                        var dates = JSON.parse(data);

                        // Populate date inputs with retrieved dates
                        $('#start-date').val(dates.start_date);
                        $('#end-date').val(dates.end_date);
                    }
                });
            });
        });
    </script>
    <?php
        if (isset($_POST['save'])) {
            $project_id = $_POST['project'];
            $assigned_user = $_POST['assignto'];

            foreach ($assigned_user as $users) {
                $sql = "INSERT INTO assign_employee_tasks (project_id, assigned_employee) VALUES ('$project_id', '$users')";
                mysqli_query($dbconnect, $sql);
            }        
            $sql2 = "INSERT INTO project_tasks (project_id, approve_status) VALUES ('$project_id', 'Pending')";
            if ($dbconnect->query($sql) === TRUE) {
                $success1 = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title">
                        </div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success!</strong> Successfully assigned employees!.</p>
                        </div>
                    </div>';
            } else {
                $error1 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }

            if ($dbconnect->query($sql2) === TRUE) {
                $success2 = '
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title">
                        </div>
                        <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Success!</strong> Tasks updated!.</p>
                        </div>
                    </div>';
            } else {
                $error2 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }
        }
    ?>
    <?php
        if (isset($error1)) {
            echo $error1;
        }
        if (isset($success1)) {
            echo $success1;
        }

        if (isset($error2)) {
            echo $error2;
        }
        if (isset($success2)) {
            echo $success2;
        }
    ?>
    <!-- sample modal content -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Tasks</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project List</label>
                            <select class="form-control custom-select col-md-8" name="project" id="project-select" onchange="showDate(this.value)" required>
                                <option></option>
                                <?php 
                                    $P_sql = "SELECT * FROM project WHERE status != 'Completed'";
                                    $P_query = mysqli_query($dbconnect, $P_sql);
                                    $p_results = mysqli_fetch_all($P_query, MYSQLI_ASSOC);
                                    foreach ($p_results as $pro_tasks) {?>
                                    <option value="<?php if(isset($pro_tasks['ID'])) echo $pro_tasks['ID'];?>"><?php if(isset($pro_tasks['name'])) echo $pro_tasks['name'];?></option>
                                <?php }?>
                           </select>
                        </div>
                        <div class="form-group row" id="txtHint">
                            <label class="control-label col-md-3">Project Date</label>
                            <input type="text" value="" name="startdate" class="form-control col-md-4" id="start-date" readonly="">
                            <input type="text" value="" name="enddate" class="form-control col-md-4" id="end-date" readonly="">
                        </div>                                              
                        <div class="form-group row">
                            <label class="control-label col-md-3">Assign To</label>                            
                            <select class="select2 form-control select2-multiple col-md-3" data-placeholder="Choose a Category" multiple="multiple" style="width:25%" tabindex="1" name="assignto[]" required>
                                <?php 
                                    $emp = "SELECT * FROM employee WHERE status = 1 AND role != 'Former' ";
                                    $emp_query = mysqli_query($dbconnect, $emp);
                                    $employee = mysqli_fetch_all($emp_query, MYSQLI_ASSOC);
                                    foreach($employee as $empl){
                                ?>
                                <option value="<?php if(isset($empl['emp_id']))echo $empl['emp_id'];?>"><?php if (isset($empl['fname']) && isset($empl['surname'])) echo $empl['fname']." ".$empl['surname']; ?></option>
                            <?php }?>
                            </select>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" class="form-control" id="recipient-name1">                                       
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
    require('includes/footer.php');
?>
