<?php 
	require('includes/header.php');
?>
<!--Body starts here-->
<div class="page-wrapper" style="min-height: 785px;">
	<div class="message"></div>
		<div class="row page-titles">
    		<div class="col-md-5 align-self-center">
       			<h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp; Dashboard</h3>
    		</div>
    	<div class="col-md-7 align-self-center">
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
	            <li class="breadcrumb-item active">Dashboard</li>
	        </ol>
   		</div>
	</div>
	<!-- Container fluid  -->
	<div class="container-fluid">
	    <!-- Row -->
	    <div class="row">
	        <!--Employee Column -->
	        <div class="col-lg-3 col-md-6">
	            <div class="card">
	                <div class="card-body">
	                    <div class="d-flex flex-row">
	                        <div class="round align-self-center round-primary"><i class="ti-user"></i></div>
	                        <div class="m-l-10 align-self-center">
	                            <h3 class="m-b-0">
	                            	<?php
	                            		$sql = "SELECT * FROM employee WHERE role = 'Employee' OR role = 'ADMIN' ";
	                            		$query = mysqli_query($dbconnect, $sql);
	                            		$num = mysqli_num_rows($query);
	                            		echo $num." Employees";
	                            	?>
	                        	</h3>
	                            <a href="employee.php" class="text-muted m-b-0">View Details</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	       <!--Leaves Column -->
	        <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-info">
                            	<i class="ti-file"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0">
                                <?php
		                       	 	$leave_sql = "SELECT * FROM employee WHERE status = '0' AND role != 'Former'" ;
	                            	$leave_query = mysqli_query($dbconnect, $leave_sql);
	                            	$leave_row = mysqli_num_rows($leave_query);

	                            	echo $leave_row;
	                            ?> Leaves
                                </h3>
                                <a href="employees_leave.php" class="text-muted m-b-0">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	        <!--Projects Column -->
	        <div class="col-lg-3 col-md-6">
	            <div class="card">
	                <div class="card-body">
	                    <div class="d-flex flex-row">
	                        <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
	                        <div class="m-l-10 align-self-center">
	                            <h3 class="m-b-0"> 
	                            <?php
		                       	 	$project_sql = "SELECT * FROM attendance WHERE atten_date = '$today'" ;
	                            	$pro_query = mysqli_query($dbconnect, $project_sql);
	                            	$row = mysqli_num_rows($pro_query);

	                            	echo $row;
	                            ?> Attendance
	                            </h3>
	                            <a href="add_attendance.php" class="text-muted m-b-0">View Details</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!--Salary Advance Column -->
	        <div class="col-lg-3 col-md-6">
	            <div class="card">
	                <div class="card-body">
	                    <div class="d-flex flex-row">
	                        <div class="round align-self-center round-success"><i class="ti-money"></i></div>
	                        <div class="m-l-10 align-self-center">
	                            <h3 class="m-b-0">
	                               	<?php
		                        		$sql_advance = "SELECT * FROM advance WHERE status = 'Granted'";
		                        		$query_advance = mysqli_query($dbconnect, $sql_advance);
		                        		$rows = mysqli_num_rows($query_advance);

		                        		echo $rows;
		                        	?> Advance
	                            </h3>
	                            <a href="pending_advance.php" class="text-muted m-b-0">View Details</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	    </div>

	    <!-- Row -->   
	    <div class="row ">
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-inverse card-info">
	                <div class="box bg-primary text-center">
	                    <h1 class="font-light text-white">
	                        <?php
                        		$sql = "SELECT * FROM employee WHERE role = 'Former' ";
                        		$query = mysqli_query($dbconnect, $sql);
                        		$num = mysqli_num_rows($query);
                        		echo $num;
                        	?>                                  
	                    </h1>
	                    <h6 class="text-white">Former Employees</h6>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-info card-inverse">
	                <div class="box text-center">
	                    <h1 class="font-light text-white">
	                        <?php
                        		$sql = "SELECT * FROM emp_leave WHERE leave_status = 'Pending' ";
                        		$query = mysqli_query($dbconnect, $sql);
                        		$num = mysqli_num_rows($query);
                        		echo $num;
                        	?>
	                    </h1>
	                    <h6 class="text-white">Pending Leave Applications</h6>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-inverse card-danger">
	                <div class="box text-center">
	                    <h1 class="font-light text-white">
	                       <?php
	                       	 	$project_sql = "SELECT * FROM project WHERE status = 'Upcoming'"  ;
                            	$pro_query = mysqli_query($dbconnect, $project_sql);
                            	$row = mysqli_num_rows($pro_query);

                            	echo $row;
                            ?>
	                    </h1>
	                    <h6 class="text-white">Upcoming Project</h6>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-inverse card-success">
	                <div class="box text-center">
	                    <h1 class="font-light text-white">
	                        <?php
                        		$sql_advance = "SELECT * FROM advance WHERE status = 'Pending'";
                        		$query_advance = mysqli_query($dbconnect, $sql_advance);
                        		$rows = mysqli_num_rows($query_advance);

                        		echo $rows;
                    		?> 
	                    </h1>
	                    <h6 class="text-white">Pending Advance Applications</h6>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	    </div>
	</div> 

	<div class="container-fluid">
	    <!-- Row -->
	    <div class="row">   
	        <div class="col-md-7">
	            <div class="card">
	                <div class="card-body">
	                    <h4 class="card-title">Running Project/s</h4>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive" style="height:300px;">
	                        <table class="table table-bordered table-hover earning-box">
	                            <thead>
	                                <tr>
	                                    <th>Title</th>
	                                    <th>Start Date</th>
	                                    <th>End Date</th>
	                                </tr>
	                            </thead>
	                            <?php
	                            	$project_sql = "SELECT * FROM project WHERE status = 'Running'"  ;
	                            	$pro_query = mysqli_query($dbconnect, $project_sql);
	                            	$projects = mysqli_fetch_all($pro_query, MYSQLI_ASSOC);

	                            	foreach ($projects as $pro){
	                            ?>
	                            <tbody>
	                                <tr style="vertical-align:top;">
	                                    <td><a href="project.php"><?php echo $pro['name'];?></a></td>
	                                    <td><?php echo $pro['start_date'];?></td>
	                                    <td><?php echo $pro['end_date'];?></td>
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
	            <div class="card">
	                <div class="card-body">
	                    <h4 class="card-title">Notice Board <i class="mdi mdi-bell"></i>
	                    	<?php 
	                    		if($not > 0){?>
	                    			<sup style="color:red"><?php echo $not;?></sup>
	                    	<?php }?>
	                    </h4>
	                </div>
	                <div class="card-body" style="overflow: visible;">
	                    <div class="table-responsive slimScrollDiv" style="height: 300px;">
	                        <table class="table table-hover table-bordered earning-box ">
	                            <thead>
	                                <tr>
	                                    <th>No.</th>
	                                    <th>Title</th>
	                                    <th>Subject</th>
	                                    <th>Date</th>
	                                </tr>
	                            </thead>
	                            <?php
	                            	$n = 0;
	                            	foreach ($results as $notis){
	                            		$n = $n + 1;
	                            ?>
	                            <tbody>
	                                <tr>
	                                    <td><?php echo $n; ?></td>
	                                    <td><?php echo $notis['title'];?></td>
	                                    <td><a href="notice.php"><?php echo $notis['subject'];?></a></td>
	                                    <td><?php echo $notis['date'];?></td>
	                                </tr>
	                                <?php 
	                                	}
	                                ?>
	                            </tbody>
                           </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="modal fade" id="myModal" role="dialod">
	        	<div class="modal-dialog">
	        		<div class="modal-content">
	        			<div class="modal-header">
	        				<h4 class="modal-title">Attendance Alert</h4>
	        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        			</div>
	        			<div class="modal-body">
	        				<div class="row justify-content-start">
	        					<div class="col-md-8">
	        						<div class="form-group">
                                    	<p id="modal-message"></p>
                                	</div>
	                                <div class="form-group">
	                                    <b><a href="attendance.php"> Sign Attendance</a></b>
	                                </div>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="modal-footer">
	        				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			dataType: 'json',
			success: function(response) {
				if (response.status == 'error') {
					//display modal
					$('#modal-message').html(response.message);
					$('#myModal').modal('show');
				}
			}
		});
	});
</script>
<?php 
	require('includes/footer.php')
?>