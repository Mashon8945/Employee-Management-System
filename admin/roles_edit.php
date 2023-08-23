<?php 
    require('includes/header.php');

    if (isset($_POST['save'])) {
       $role_name = $_POST['role_name'];
       $dept = $_POST['dept_id'];
       $id = $_GET['role_id'];

       $sql = "UPDATE roles SET role_name = '$role_name', dept_id = '$dept' WHERE ID = $id";
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
                        <p class="message-alert-none"><strong>Success!</strong>Role updated successfully.</p>
                    </div>
                </div>';
        }else{
            $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
        }

    }
?>
<?php
    $id = $_GET['role_id'];
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
                <li class="breadcrumb-item">Roles</li>
                <li class="breadcrumb-item active">Roles Edit</li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <div class="container-fluid">         
        <div class="row">
            <div class="col-lg-7">                         
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Edit role</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            $sql = "SELECT * FROM roles WHERE ID = $id";
                            $query = mysqli_query($dbconnect, $sql);
                            $roles = mysqli_fetch_assoc($query);
                        ?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Role Name <i style="color:red;">*</i></label>
                                            <input type="text" name="role_name"  value="<?php echo $roles['role_name']; ?>" class="form-control" placeholder=""  required="">
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
                                                <option value="<?php if(isset($det['ID'])) echo $det['ID']; ?>" <?php if(isset($det['ID']) && $det['ID'] == $roles['ID']) echo 'selected'; ?>> <?php if(isset($det['dept_name'])) echo $det['dept_name'];?>  </option>
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
                                <button type="button" class="btn btn-danger"><a href="roles.php" class="text-white">Cancel</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            if (isset($success)) {
                echo $success;
            }
            if (isset($error)) {
                echo $error;
            } 
        ?>
    </div>
</div>
<?php 
    require('includes/footer.php');
?>