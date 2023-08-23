<?php require 'includes/header.php';?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Department</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <?php
    	$dept_id = $_SESSION['dept_id'];
    	$sql = "SELECT * FROM department WHERE ID = $dept_id";
    	$query = mysqli_query($dbconnect, $sql);
    	$depts = mysqli_fetch_assoc($query);
    ?>
    <div class="container-fluid">         
        <div class="row">
            <div class="col-9">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> <?php echo $depts['dept_name'];?> department Members</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Employee Name</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql_members = "SELECT * FROM employee WHERE dept_id = $dept_id AND role != 'Former'";
                                    $query_mem = mysqli_query($dbconnect, $sql_members);
                                    $members = mysqli_fetch_all($query_mem, MYSQLI_ASSOC);
                                    $n=0;

                                    foreach ($members as $member) {
                                        $n = $n + 1; ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $n; ?></td>
                                        <td><?php if(isset($member['fname']) && isset($member['surname'])) echo $member['fname']." ".$member['surname']; ?></td>
                                        <td>
                                        	<?php 
                                        		if(isset($member['designation'])){
                                        			$deg = $member['designation'];
                                        			$role_sql = "SELECT * FROM roles WHERE ID = '$deg' ";
                                        			$role_query = mysqli_query($dbconnect, $role_sql);
                                        			$roles = mysqli_fetch_assoc($role_query);
                                        			echo $roles['role_name'];
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
                <?php
                    if(isset($success1)){
                        echo $success1;
                    }
                    if (isset($error1)) {
                       echo $error1;
                    }
                ?>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1"><i class="fa fa-braille"></i> Edit Department</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <form method="post" action=" " id="btnSubmit" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Department Name</label>
                                            <input type="text" name="name" class="form-control" id="recipient-name1" minlength="4" maxlength="25" placeholder="" value="<?php if(isset($dept_id)) echo $dept_id; ?>">
                                        </div>
                                    </div>                                           
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
</div>
<?php require('includes/footer.php');?>