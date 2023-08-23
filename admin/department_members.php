<?php require 'includes/header.php';?>

<div class="page-wrapper" style="min-height: 785px;">
    <?php
        $dept_id = $_GET['dept_id'];
        $sql = "SELECT * FROM department WHERE ID = $dept_id";
        $query = mysqli_query($dbconnect, $sql);
        $depts = mysqli_fetch_assoc($query);
    ?>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i><?php echo $depts['dept_name'];?>  Department</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Organisation</li>
                <li class="breadcrumb-item">Department</li>
                <li class="breadcrumb-item active"><?php echo $depts['dept_name'];?> </li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <div class="container-fluid">         
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> <?php echo $depts['dept_name'];?> department Members</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="80%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Employee Name</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql_members = "SELECT * FROM employee WHERE dept_id = $dept_id";
                                    $query_mem = mysqli_query($dbconnect, $sql_members);
                                    $members = mysqli_fetch_all($query_mem, MYSQLI_ASSOC);
                                    $n = 0;

                                    foreach ($members as $member) { $n = $n + 1; ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $n;?></td>
                                        <td><?php if(isset($member['fname']) && isset($member['surname'])) echo $member['fname']." ".$member['surname']; ?></td>
                                        <td>
                                        	<?php 
                                        		if(isset($member['designation'])){
                                        			$deg = $member['designation'];
                                        			$role_sql = "SELECT * FROM roles WHERE ID = '$deg' ";
                                        			$role_query = mysqli_query($dbconnect, $role_sql);
                                        			$roles = mysqli_fetch_assoc($role_query);

                                                    if (isset($roles['role_name'])) {
                                                        echo $roles['role_name'];
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
    </div>
</div>
<?php require('includes/footer.php');?>