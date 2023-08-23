<?php 
    require('includes/header.php');

    if (isset($_POST['save'])) {
       $role_name = $_POST['role_name'];
       $dept = $_POST['dept_id'];

       $sql = "INSERT INTO roles (role_name, dept_id) VALUES ('$role_name', '$dept')";
       if ($dbconnect->query($sql) === TRUE) {
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
                        <p class="message-alert-none"><strong>Success!</strong>New role added successfully.</p>
                    </div>
                </div>';
        }else{
            $error1 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
        }

    }

    if (isset($_POST['delete'])) {
        $role_id = '';
        $role_id = $_POST['roles_id'];

        $sql = "DELETE FROM roles WHERE ID = $role_id";
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
                        <p class="message-alert-none"><strong>Success!</strong> Role deleted!.</p>
                    </div>
                </div>';
        } else {
            $error1 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
       }

    }
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Roles</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Organisation</li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <div class="container-fluid">         
        <div class="row">
            <div class="col-7">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Role List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM roles";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $roles = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                    foreach ($roles as $role) {?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $role['role_name']; ?></td>
                                        <td class="jsgrid-align-center ">
                                        <form method="post" enctype="multipart">
                                            <input type="hidden" name="roles_id" value="<?php echo $role['ID'];?>">
                                            <?php 
                                                $role_id = $role['ID'];
                                                $roles_url = "roles_edit.php?role_id=".$role_id;
                                            ?>
                                            <a href="<?php echo $roles_url; ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                            <button name="delete" onclick="return confirm('Are you sure to delete this data?')" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
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
            <div class="col-lg-5">                         
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Add new role</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Role Name <i style="color:red;">*</i></label>
                                            <input type="text" name="role_name"  value="" class="form-control" placeholder=""  required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Department <i style="color:red;">*</i></label>
                                            <select class="form-control custom-select" name="dept_id" required="">
                                                <option></option>
                                                <?php
                                                    $sql_roles = "SELECT * FROM department";
                                                    $query =mysqli_query($dbconnect, $sql_roles);
                                                    $dept_roles = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                    foreach($dept_roles as $det){
                                                ?>
                                                <option value="<?php if(isset($det['ID'])) echo $det['ID']; ?>"> <?php if(isset($det['dept_name'])) echo $det['dept_name'];?>  </option>
                                                <?php 
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="save" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            if (isset($success1)) {
                echo $success1;
            }
            if (isset($error1)) {
                echo $error1;
            }
        ?>
    </div>
</div>
<?php 
    require('includes/footer.php');
?>