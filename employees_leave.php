<?php 
	require("includes/header.php");
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-fighter-jet" style="color:#1976d2"> </i>Leave List</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave List</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-fighter-jet"></i> Employees leave List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <?php
                                	$sql = "SELECT * FROM emp_leave WHERE leave_status = 'Approved' ";
                                	$query = mysqli_query($dbconnect, $sql);
                                	$leave = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $n = 0;

                                	foreach ($leave as $value) {
                                		$emp = $value['emp_id'];
                                        $n++;
                                		?>
                                <tbody>
                                    <tr style="vertical-align:top">
                                        <td><?php echo $n;?></td>
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
                                        <td><?php echo $value['start_date']; ?></td>
                                        <td><?php echo $value['end_date']; ?></td>
                                        <td><?php echo $value['leave_duration']." days"; ?></td>
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