<?php 
	require("includes/header.php");
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="mdi mdi-account-multiple" style="color:#1976d2"> </i>Leave List</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Employee</li>
                <li class="breadcrumb-item active">Employees on leave</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="mdi mdi-account-multiple"></i> Employees leave List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Application Date</th>
                                        <th>Start Date</th>
                                        <th>Return Date</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <?php
                                	$sql = "SELECT * FROM emp_leave WHERE leave_status = 'Approved' ";
                                	$query = mysqli_query($dbconnect, $sql);
                                	$leave = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                	foreach ($leave as $value) {
                                		$emp = $value['emp_id'];
                                		?>
                                <tbody>
                                    <tr style="vertical-align:top">
                                        <td>
                                        	<?php
                                        	$emp_sql = "SELECT * FROM employee WHERE emp_id = $emp";
                                        	$emp_query = mysqli_query($dbconnect, $emp_sql);
                                        	$Emp_name = mysqli_fetch_assoc($emp_query);
                                        	?>
                                        	<?php echo $Emp_name['fname']." ".$Emp_name['surname']; ?>
                                        </td>
                                        <td><?php 
                                        		$ID = $value['leave_typeid'];
                                        		$sql_leave = "SELECT * FROM leave_type WHERE type_id = $ID";
                                        		$sql_query = mysqli_query($dbconnect, $sql_leave);
                                        		$fetch = mysqli_fetch_assoc($sql_query);
                                        		echo $fetch['name']; 
                                        	?>
                                        			
                                		</td>
                                        <td><?php echo $value['apply_date']; ?></td>
                                        <td><?php echo $value['start_date']; ?></td>
                                        <td><?php echo $value['end_date']; ?></td>
                                        <td><?php echo $value['leave_duration']; ?> days</td>
                                        <td>
                                        	<?php
	                                        	if ($value['leave_status'] == 'Pending') {
	                                        		echo '<button  class="btn btn-sm btn-warning waves-effect waves-light Status" >Pending</button> ';
	                                        	} elseif ($value['leave_status'] == 'Rejected') {
	                                        		echo '<button class="btn btn-sm btn-danger waves-effect waves-light Status">Rejected</button> ';
	                                        	} else {
	                                        		echo '<button class="btn btn-sm btn-success waves-effect waves-light Status">Approved</button> ';
	                                        	}
                                        	?>
                                        </td>
                                        <td></td>
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
    <!--end container fluid-->
</div>
<?php
	require('includes/footer.php');
?>