<?php require('includes/header.php'); ?>
<?php 
	$project_id = $_GET['project_id']; 
	$sql = "SELECT * FROM project WHERE ID = $project_id";
	$query = mysqli_query($dbconnect, $sql);
	$fetch = mysqli_fetch_assoc($query);
?>
<?php
	if (isset($_POST['submit'])) {
		$project_id = $_GET['project_id']; 
		$Name = $_POST['name'];
		$start_date = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$desc = $_POST['description'];

		$sql = "UPDATE project SET name = '$Name', start_date = '$start_date', end_date = '$enddate', description = '$desc' WHERE ID = '$project_id'";
		if ($dbconnect->query($sql)) {
            $success = '
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <link rel="stylesheet" href="css/alerts.css">
                    <div class="alert-title">
                    </div>
                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                        <p class="message-alert-none"><strong>Success!</strong> project info updated!.</p>
                    </div>
                </div>';
        } else {
            $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
        }
	}
?>
<script>
	const progressBar = document.querySelector('.progress-bar');
	const progressValue = document.querySelector('.progress-value');
	const progress = progressValue.innerText;

	progressBar.style.width = progress;
	progressValue.innerText = progress;

	if (progress === '100%') {
    	progressBar.classList.add('complete');
	}
</script>
<style type="text/css">


</style>

<div class="page-wrapper" style="min-height: 707px;">
	<div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-archive" aria-hidden="true"></i> Projects</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Project view</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <div id="tabs">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="false">  Project View </a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#project_tasks" role="tab" aria-expanded="true">Projects tasks </a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#expenses" role="tab"> Expenses</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#logistics" role="tab"> Logistic</a> </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="false">
                               <div class="row">
                                   <div class="col-md-4">
				                        <div class="card">
				                            <div class="card-body">
				                                <center class="m-t-30"> 
				                                    <!--progress bar-->
				                                    <div class="container">
					                                    <div class="progress blue">
						                                    <span class="progress-left">
						                                        <span class="progress-bar"></span>
						                                    </span>
						                                    <span class="progress-right">
						                                        <span class="progress-bar"></span>
						                                    </span>
					                                    	<div class="progress-value">
					                                    		<?php
					                                    			$datefrom = $fetch['start_date'];
					                                    			$dateto = $fetch['end_date'];
					                                    			if ($dateto < $today) {
					                                    				echo "100%";
					                                    			} else{
					                                    				if ($datefrom >= $today) {
					                                    					echo "0%";
					                                    				} else {
						                                    				$days_total = (new DateTime($dateto))->diff(new DateTime($datefrom))->days;
																			$days_completed = (new DateTime($today))->diff(new DateTime($datefrom))->days;

																			$percentage = ($days_completed / $days_total) * 100;

																			echo number_format($percentage, 1)."%";
																		}
					                                    			}
					                                    		?>
					                                    	</div>
					                                    </div>
				                                    </div>                            
				                                    <!--end progress-->                                   
				                                    <h4 class="card-title m-t-10"><?php echo $fetch['name']; ?></h4>
				                                </center>
				                            </div>
				                            <div>
				                                <hr> 
				                            </div>
				                            <div class="card-body"> 
				                            	<small class="text-muted">Start Date </small>
				                                <h6><?php echo $fetch['start_date']; ?></h6> 
				                                <small class="text-muted p-t-30 db">End date</small>
				                                <h6><?php echo $fetch['end_date']; ?></h6> <small class="text-muted p-t-30 db">Status</small>
				                                <h6><?php echo $fetch['status']; ?></h6>
				                                <br>
				                            </div>
				                        </div>                                          
                                    </div>
                                    <div class="col-md-8">
	                                    <div class="card">
					                        <div class="card-body">
			                                    <form method="post" action="" id="btnSubmit" enctype="multipart/form-data" novalidate="novalidate">
			                                    	<div class="modal-body">
			                                            <div class="form-group">
			                                                <label class="control-label">Project Title</label>
			                                                <input type="text" name="name" value="<?php if(isset($fetch['name'])) echo $fetch['name']; ?>" class="form-control" id="recipient-name1" minlength="8" maxlength="250" required="">
			                                            </div>
			                                            <div class="form-group">
			                                                <label class="control-label">Project Start Date</label>
			                                                <input type="text" name="startdate" value="<?php if(isset($fetch['start_date'])) echo $fetch['start_date']; ?>" class="form-control mydatepicker" id="recipient-name1" required="">
			                                            </div>
			                                            <div class="form-group">
			                                                <label class="control-label">Project End Date</label>
			                                                <input type="text" name="enddate" value="<?php if(isset($fetch['end_date'])) echo $fetch['end_date']; ?>" class="form-control mydatepicker" id="recipient-name1" required="">
			                                            </div>
			                                            <div class="form-group">
			                                                <label for="message-text" class="control-label">Description</label>
			                                                <textarea class="form-control" rows="10" name="description" value="<?php if(isset($fetch['description'])) echo $fetch['description']; ?>" id="message-text1" minlength="10" maxlength="1300"><?php if(isset($fetch['description'])) echo $fetch['description']; ?></textarea>
			                                            </div>                                           
			                                    	</div>
				                                    <div class="modal-footer">
				                                        <input type="hidden" name="proid" value="4">
				                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
				                                    </div>
			                                    </form>
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
                            <!--second tab-->
                            <div class="tab-pane" id="project_tasks" role="tabpanel" aria-expanded="true">
                                <div class="card">
			                        <div class="card-body">
		                        		<h3 class="card-title">Employees assigned</h3>                   
					                    <div class="table-responsive " id="">
					                        <div id="example23_wrapper" class="dataTables_wrapper no-footer">
					                        	<div>
					                        		<button class="btn btn-info waves-effect waves-light" ><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#add_employee" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Employee</a></button>
					                        	</div>
				                        		<div id="example23_filter" class="dataTables_filter">
				                        			<label>Search:<input type="search" class="" placeholder="" aria-controls="example23"></label>
				                        		</div>
						                        <table  class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" style="width: 100%;">
						                            <thead>
						                                <tr role="row">
						                                	<th style="width: 34px;">No</th>
						                                	<th>Image</th>
						                                	<th>Employee Name</th>
						                                	<th>Role </th>
						                                	<th>Action</th>
						                                </tr>
						                            </thead>
						                            <?php
		                                                $assigned_sql = "SELECT * FROM assign_employee_tasks WHERE project_id = $project_id";
		                                                $assigned_query = mysqli_query($dbconnect, $assigned_sql);
		                                                $num = mysqli_num_rows($assigned_query);?>
                            						<tbody>
                            							<?php 
                            							if ($num <= 0) {?>
                                                        <tr class="odd">
                                                       		<td valign="top" colspan="5" class="dataTables_empty">No employees assigned</td>
                                                       	</tr>
                                                       <?php } else {
                                                       		$assigned_emp = mysqli_fetch_all($assigned_query, MYSQLI_ASSOC);
                                                       		$n = 0;

			                                                foreach ($assigned_emp as $emp) {
			                                                    $emp_id = $emp['assigned_employee'];
			                                                    $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
			                                                    $query = mysqli_query($dbconnect, $sql);
			                                                    $employee = mysqli_fetch_assoc($query);	
			                                                    $n++;
		                                                    ?>
	                                                       	<tr>
	                                                       		<td><?php echo $n; ?></td>
	                                                       		<td>
	                                                       			<img src="assets/images/users/<?php echo $employee['image']; ?>" height="40px" width="40px" style="border-radius:50px" alt="" data-toggle="tooltip" data-placement="top" title="<?php echo $employee['fname']." ".$employee['surname'];?>">
	                                                       		</td>
	                                                       		<td><?php echo $employee['fname']." ".$employee['surname'];?></td>
	                                                       		<td>
	                                                       			<?php 
	                                                       				$id = $employee['designation'];
	                                                       				$deg_sql = "SELECT * FROM roles WHERE ID = $id";
	                                                       				$deg_query = mysqli_query($dbconnect, $deg_sql);
	                                                       				$deg = mysqli_fetch_assoc($deg_query);

	                                                       				echo $deg['role_name'];
	                                                       			?>
	                                                       		</td>
	                                                       		<td>
	                                                       			<button type="submit" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Confirm dropping user from project...')"><i class="fa fa-trash-o"></i></button>
	                                                       		</td>
	                                                       	</tr>
	                                                       	<?php 
	                                                        }
	                                                    }
	                                                    ?>
                                                    </tbody>
                    							</table>
                    						</div>
           					 			</div>
                                    </div>
		                        </div>
                            </div>
                            <?php
						        if (isset($_POST['save'])) {
						            $project_id = $_GET['project_id'];
						            $assigned_user = $_POST['assignto'];

						            foreach ($assigned_user as $users) {
						                $sql = "INSERT INTO assign_employee_tasks (project_id, assigned_employee) VALUES ('$project_id', '$users')";
						                mysqli_query($dbconnect, $sql);
						            }        
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
                            <!--Budget allocation-->
                            <div class="tab-pane" id="expenses" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
					                    <div class="table-responsive ">
					                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>Details</th>
					                                    <th>Assigned users </th>
					                                    <th>Date </th>
					                                    <th>Amount </th>
					                                    <th>Status </th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<tr></tr>
                                                </tbody>
					                        </table>
                						</div>	                                    
		                                <form class="row" action="Add_Expenses" method="post" enctype="multipart/form-data" id="expenseform" novalidate="novalidate">
		                                    <div class="form-group col-md-6 m-t-5">
		                                        <label>Details</label>
		                                        <input type="text" class="form-control form-control-line" placeholder="details..." name="details"> 
		                                    </div>
		                                    <div class="form-group col-md-6 m-t-5">
		                                        <label>Assign To</label>
                                            	<select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="assignto">
                                                4                                                   
                                                </select>
		                                    </div>
		                                    <div class="form-group col-md-6 m-t-5">
		                                        <label>Amount</label>
		                                        <input type="number" class="form-control form-control-line" placeholder=" amount.." name="amount"> 
		                                    </div>
		                                    <div class="form-group col-md-6 m-t-5">
		                                        <label>Date</label>
		                                        <input type="text" class="form-control form-control-line mydatetimepickerFull" placeholder="" name="date" value=""> 
		                                    </div>
		                                    <div class="form-actions col-md-12">
                                                <input type="hidden" name="id" value="">                                                
                                                <input type="hidden" name="proid" value="4">                                                
		                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
		                                        <button type="button" class="btn btn-info">Cancel</button>
		                                    </div>
		                                </form>
				                    </div>
                                </div>
                            </div>

                            <!--logistics-->
                            <div class="tab-pane" id="logistics" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                    	<a data-toggle="modal" data-target="#logisticmodel" data-whatever="@getbootstrap" class="text-white btn btn-info">Logistic Support</a>
					                    <div class="table-responsive ">
					                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>Logistic Name</th>
					                                    <th>Assigned users </th>
					                                    <th>Quantity </th>
					                                    <th>Start Date </th>
					                                    <th>End Date </th>
					                                    <th>Action </th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<tr></tr>
                                               </tbody>
					                        </table>
					                    </div>	                                   
				                    </div>
                                </div>
                            </div>                               
                        </div>
                    </div>
                </div>
            </div>
        <!-- Column -->
        </div>
    </div>
          
    <!-- sample modal content -->
    <div class="modal fade" id="logisticmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Assign Logistic Support</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="Add_Logistic" id="logisModalform" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project List</label>
                            <select class="form-control custom-select col-md-8" data-placeholder="Choose a Category" tabindex="1" name="proid">
                                <option value="4">Customer support service operation</option>                                 
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project Date</label>
                            <input type="text" value="Dec 25, 2021" name="prostart" class="form-control col-md-4" id="recipient-name1" readonly="">
                            <input type="text" value="Feb 16, 2022" name="proend" class="form-control col-md-4" id="recipient-name1" readonly="">
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Task List</label>
                            <select class="form-control custom-select taskclass col-md-3" data-placeholder="Choose a Category" tabindex="1" name="taskid" id="taskval" required="">
                              	<option value="">Select Here</option>
                          	</select>
                            <label class="control-label col-md-2">Assign To</label>
                            <select class="select2 form-control custom-select col-md-4 select2-hidden-accessible" data-placeholder="Choose a Category" style="width:25%" tabindex="-1" name="teamhead" aria-hidden="true">
                              	<option value="">Select Here</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 25%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="1" aria-labelledby="select2-teamhead-ya-container">
                            			<span class="select2-selection__rendered" id="select2-teamhead-ya-container">
                            				<span class="select2-selection__placeholder">Choose a Category</span>
                            			</span>
                            			<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                            		</span>
                        		</span>
                        		<span class="dropdown-wrapper" aria-hidden="true"></span>
                    		</span>                                               
                    	</div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Start Date</label>
                            <input type="text" name="startdate" class="form-control col-md-3 mydatetimepickerFull" id="recipient-name1">
                            <label class="control-label col-md-2">End Date</label>
                            <input type="text" name="enddate" class="form-control col-md-3 mydatetimepickerFull" id="recipient-name1">
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Remarks</label>
                            <textarea class="form-control col-md-8" name="remarks" id="message-text1" minlength="10" maxlength="1400" rows="4"></textarea>
                        </div>                                                                 
                     	<div class="form-group row">
                            <label class="control-label col-md-3">Logistic Support</label>
                            <select class="select2 form-control custom-select col-md-4 assetsstock select2-hidden-accessible" data-placeholder="Choose a Category" style="width:35%" tabindex="-1" name="logistic" aria-hidden="true">
                              	<option value="">Select Here</option>
                                <option value="1">Laptop T10</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 35%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="1" aria-labelledby="select2-logistic-8n-container">
                            			<span class="select2-selection__rendered" id="select2-logistic-8n-container">
                            				<span class="select2-selection__placeholder">Choose a Category</span>
                            			</span>
                            			<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                            		</span>
                            	</span>
                            	<span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>
                        	<div style="color:red" class="qty col-md-1"></div>
                        	<input type="number" name="qty" id="qty" class="form-control col-md-3" placeholder="Qty" max="">    
                		</div> 
        			</div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">                                       
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  

    <!-- sample modal content -->
    <div class="modal fade" id="tasksmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Tasks</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="Add_Tasks" id="tasksModalform" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project List</label>
                            <select class="form-control custom-select col-md-8 proid" data-placeholder="Choose a Category" tabindex="1" name="projectid">
                                <option value="4">Customer support service operation</option> 
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project Date</label>
                            <input type="text" value="Dec 25, 2021" name="prostart" class="form-control col-md-4" id="recipient-name1" readonly="">
                            <input type="text" value="Feb 16, 2022" name="proend" class="form-control col-md-4" id="recipient-name1" readonly="">
                        </div>                                               
                        <div class="form-group row">
                            <label class="control-label col-md-3">Assign To</label>
                            <select class="select2 form-control custom-select col-md-3 select2-hidden-accessible" data-placeholder="Choose a Category" style="width:25%" tabindex="-1" name="teamhead" aria-hidden="true">
                              	<option value="">Select Here</option>
                                <option value="Soy1332">Thom Anderson</option>
                                <option value="Doe1753">Will Williams</option>
                                <option value="Doe1754">John Greenwood</option>
                                <option value="Moo1402">Liam Moore</option>
                                <option value="Rob1472">Stephany Robs</option>
                                <option value="Tho1044">Chris Thompson</option>
                                <option value="Smi1266">Colin Smith</option>
                                <option value="Moo1634">Christine Moore</option>
                                <option value="Joh1474">Michael Johnson</option>
                                <option value="Den1745">Emily Denn</option>
                                <option value="Mas1016">Don Mashon</option>
                                <option value="Buz1383">Buzeki Buzeki</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 25%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="1" aria-labelledby="select2-teamhead-ww-container">
                            			<span class="select2-selection__rendered" id="select2-teamhead-ww-container">
                            				<span class="select2-selection__placeholder">Choose a Category</span>
                            			</span>
                            			<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                            		</span>
                            	</span>
                            	<span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>
                            <label class="control-label col-md-2">Collaborators</label>
                            <select class="select2 form-control select2-multiple col-md-3 select2-hidden-accessible" data-placeholder="Choose a Category" multiple="" style="width:25%" tabindex="-1" name="assignto[]" aria-hidden="true">
                              	<option value="">Select Here</option>
                                <option value="Soy1332">Thom Anderson</option>
                                <option value="Doe1753">Will Williams</option>
                                <option value="Doe1754">John Greenwood</option>
                                <option value="Moo1402">Liam Moore</option>
                                <option value="Rob1472">Stephany Robs</option>
                                <option value="Tho1044">Chris Thompson</option>
                                <option value="Smi1266">Colin Smith</option>
                                <option value="Moo1634">Christine Moore</option>
                                <option value="Joh1474">Michael Johnson</option>
                                <option value="Den1745">Emily Denn</option>
                                <option value="Mas1016">Don Mashon</option>
                                <option value="Buz1383">Buzeki Buzeki</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 25%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
                            			<ul class="select2-selection__rendered">
                            				<li class="select2-search select2-search--inline">
                            					<input class="select2-search__field" type="search" tabindex="1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Choose a Category" style="width: 100px;">
                            				</li>
                            			</ul>
                            		</span>
                            	</span>
                            	<span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>                                                
                        </div>              
                        <div class="form-group row">
                        	<label class="control-label col-md-3">Task Title</label>
                        	<input type="text" name="tasktitle" class="form-control col-md-8" id="recipient-name1" minlength="8" maxlength="250" placeholder="Task Title...">
                    	</div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Start Date</label>
                            <input type="text" name="startdate" class="form-control col-md-3 mydatepicker" id="recipient-name1">
                            <label class="control-label col-md-2">End Date</label>
                            <input type="text" name="enddate" class="form-control col-md-3 mydatepicker" id="recipient-name1">
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Details</label>
                            <textarea class="form-control col-md-8" name="details" id="message-text1" minlength="10" maxlength="1400" rows="5"></textarea>
                        </div>                                            
                      	<div class="form-group row">
                            <label class="control-label col-md-3">Status: </label>
                            <input name="status" type="radio" id="radio_1" data-value="Logistic" class="type" value="complete">
                            <label for="radio_1">Complete</label>
                            <input name="status" type="radio" id="radio_2" data-value="Logistic" class="type" value="running">
                            <label for="radio_2">Running</label>
                            <input name="status" type="radio" id="radio_3" data-value="Logistic" class="type" value="cancel">
                            <label for="radio_3">Cancel</label>
                        </div>                                             
                      	<div class="form-group row">
                           	<label class="control-label col-md-3">Type: </label>
                            <input name="type" type="radio" id="radio_4" data-value="Office" class="type" value="Office" checked="">
                            <label for="radio_4">Office</label>                  
                      	</div>  
            		</div>
	                <div class="modal-footer">
	                    <input type="hidden" name="id" class="form-control" id="recipient-name1">                                       
	                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>  

    <!-- sample modal content -->
    <div class="modal fade" id="fieldmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Field Tasks</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="Add_Field_Tasks" id="tasksModalform" enctype="multipart/form-data" novalidate="novalidate">
                	<div class="modal-body">
                     	<div class="form-group row">
                            <label class="control-label col-md-3">Project List</label>
                            <select class="form-control custom-select col-md-6 proid" data-placeholder="Choose a Category" tabindex="1" name="projectid">
                                <option value="4">Customer support service operation</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Project Date</label>
                            <input type="text" value="Dec 25, 2021" name="prostart" class="form-control col-md-4" id="recipient-name1" readonly="">
                            <input type="text" value="Feb 16, 2022" name="proend" class="form-control col-md-4" id="recipient-name1" readonly="">
                        </div>                                              
                     	<div class="form-group row">
                            <label class="control-label col-md-3">Assign To</label>
                            <select class="select2 form-control custom-select col-md-3 select2-hidden-accessible" data-placeholder="Choose a Category" style="width:25%" tabindex="-1" name="teamhead" aria-hidden="true">
                              	<option value="">Select Here</option>
                                <option value="Soy1332">Thom</option>
                                <option value="Doe1753">Will</option>
                                <option value="Doe1754">John</option>
                                <option value="Moo1402">Liam</option>
                                <option value="Rob1472">Stephany</option>
                                <option value="Tho1044">Chris</option>
                                <option value="Smi1266">Colin</option>
                                <option value="Moo1634">Christine</option>
                                <option value="Joh1474">Michael</option>
                                <option value="Den1745">Emily</option>
                                <option value="Mas1016">Don</option>
                                <option value="Buz1383">Buzeki</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 25%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="1" aria-labelledby="select2-teamhead-nu-container">
                            			<span class="select2-selection__rendered" id="select2-teamhead-nu-container">
                            				<span class="select2-selection__placeholder">Choose a Category</span>
                            			</span>
                            			<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                            		</span>
                            	</span>
                            	<span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>
                            <label class="control-label col-md-2">Collaborators</label>
                            <select class="select2 form-control select2-multiple col-md-3 select2-hidden-accessible" data-placeholder="Choose a Category" multiple="" style="width:25%" tabindex="-1" name="assignto[]" aria-hidden="true">
                                <option value="">Select Here</option>
                                <option value="Soy1332">Thom</option>	
                                <option value="Doe1753">Will</option>
                                <option value="Doe1754">John</option>
                                <option value="Moo1402">Liam</option>
                                <option value="Rob1472">Stephany</option>
                                <option value="Tho1044">Chris</option>
                                <option value="Smi1266">Colin</option>
                                <option value="Moo1634">Christine</option>
                                <option value="Joh1474">Michael</option>
                                <option value="Den1745">Emily</option>
                                <option value="Mas1016">Don</option>
                                <option value="Buz1383">Buzeki</option>
                            </select>
                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 25%;">
                            	<span class="selection">
                            		<span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
                            			<ul class="select2-selection__rendered">
                            				<li class="select2-search select2-search--inline">
                            					<input class="select2-search__field" type="search" tabindex="1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Choose a Category" style="width: 100px;">
                            				</li>
                            			</ul>
                            		</span>
                            	</span>
                            	<span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>                                                
                        </div>              
                        <div class="form-group row">
                            <label class="control-label col-md-3">Task Title</label>
                            <input type="text" name="tasktitle" class="form-control col-md-8" id="recipient-name1" minlength="8" maxlength="250">
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Start Date</label>
                            <input type="text" name="startdate" class="form-control col-md-3 mydatepicker" id="recipient-name1">
                            <label class="control-label col-md-1">End Date</label>
                            <input type="text" name="enddate" class="form-control col-md-3 mydatepicker" id="recipient-name1">                                         
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Details</label>
                            <textarea class="form-control col-md-8" name="details" id="message-text1" minlength="10" maxlength="1400" rows="4"></textarea>
                        </div>                                            
                      	<div class="form-group row">
                        	<label class="control-label col-md-3">Status: </label>
                        	<input name="status" type="radio" id="radio_7" data-value="complete" class="type" value="complete">
                        	<label for="radio_7">Complete</label>
                        	<input name="status" type="radio" id="radio_5" data-value="running" class="type" value="running">
                        	<label for="radio_5">Running</label>
                        	<input name="status" type="radio" id="radio_6" data-value="cancel" class="type" value="cancel">
                        	<label for="radio_6">Cancel</label>
                     	</div>                                             
                      	<div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Location</label>
                            <textarea class="form-control col-md-8" name="location" id="message-text1" minlength="10" maxlength="1400" rows="4"></textarea>
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" class="form-control" id="recipient-name1">                                       
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!-- sample modal content -->
    <div class="modal fade" id="add_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
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
                            <select class="form-control custom-select col-md-8" name="project" id="project-select" onchange="showDate(this.value)">
                                <option></option>
                                <?php 
                                    $P_sql = "SELECT * FROM project WHERE status != 'Completed' AND ID = $project_id";
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
                            <select class="select2 form-control select2-multiple col-md-3" data-placeholder="Choose a Category" multiple="multiple" style="width:25%" tabindex="1" name="assignto[]">
                                <?php
                                    $emp = "SELECT * FROM employee WHERE role != 'Former' AND status = 1";
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
<?php require('includes/footer.php'); ?>