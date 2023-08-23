<?php 
    require('includes/header.php');
?>
<?php
    if (isset($_POST['save'])) {
       $dept_name = $_POST['department'];

       $sql = "INSERT INTO department (dept_name) VALUES ('$dept_name')";
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
                        <p class="message-alert-none"><strong>Success!</strong>New department added successfully.</p>
                    </div>
                </div>';
        }else{
            $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
        }

    }

    if (isset($_POST['drop'])) {
        $dept_id = $_POST['delete'];
        $drop_sql = "DELETE FROM department WHERE ID = $dept_id";
        $drop_query = mysqli_query($dbconnect, $drop_sql);    

        if ($drop_query === TRUE ) {
            $success1 = '
                <div class="col-lg-8 col-md-6 col-sm-5 col-xs-10">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title">
                    </div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success!</strong> Department '.$dept_id. ' dropped successfully.</p>
                    </div>
                </div>';
         }
         else{
           $error1 = "
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                    <link rel='stylesheet' href='css/alerts.css'>
                    <div class='alert-title'>
                    </div>
                    <div class='alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone'>
                        <button type='button' class='close sucess-op' data-dismiss='alert' aria-label='Close'>
                                <span class='icon-sc-cl' aria-hidden='true'>&times;</span>
                        </button>
                        <i class='fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-none' aria-hidden='true'></i>
                        <p class='message-alert-none'><strong>Danger!</strong> A dangerous or potentially negative action.</p>
                    </div>
                </div>
            ";
        }
    }
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Department</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Organisation</li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <div class="container-fluid">         
        <div class="row">
            <div class="col-7">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Department List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Members</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM department";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                    foreach ($results as $dept) {?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $dept['dept_name']; ?></td>
                                        <td>
                                            <?php  
                                                $dept_id = $dept['ID'];
                                                $department_url = "department_members.php?dept_id=".$dept_id; 
                                            ?>
                                            <a href="<?php echo $department_url; ?>">View</a>
                                        </td>
                                        <td class="jsgrid-align-center ">
                                            <form method="post" action="">
                                                <input type="hidden" name="department_id" value="<?php echo $dept['ID']; ?>">
                                                <a href="" data-toggle="modal" data-target="#exampleModal" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                <button type="submit" name="drop" onclick="return confirm('Are you sure to delete this data?')" href="" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
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
                <?php
                    if(isset($success1)){
                        echo $success1;
                    }
                    if (isset($error1)) {
                       echo $error1;
                    }
                ?>
            </div>
            <div class="col-lg-5">                         
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Add Department</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Department Name</label>
                                            <input type="text" name="department" id="firstName" value="" class="form-control" placeholder="" minlength="3" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success" name="save"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                            <?php
                                if(isset($success)){
                                    echo $success;
                                }
                                if (isset($error)) {
                                   echo $error;
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php 
    require('includes/footer.php');
?>