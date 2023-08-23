<?php require('includes/header.php');?>

<div class="page-wrapper" style="min-height: 785px;">
  	<div class="message"></div>
  	<div class="row page-titles">
    	<div class="col-md-5 align-self-center">
      		<h3 class="text-themecolor"><i class="fa fa-money"></i> Generate payroll</h3>
    	</div>
    	<div class="col-md-7 align-self-center">
  			<ol class="breadcrumb">
        		<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        		<li class="breadcrumb-item active"> Generate payroll</li>
      		</ol>
    	</div>
  	</div>
  	<div class="container-fluid">
    	<div class="row">
      		<div class="col-12">
        		<div class="card card-outline-info">
          			<div class="card-header">
            			<h4 class="m-b-0 text-white"> Employees Payroll List</h4>
          			</div>
	      			<div class="card-body">       
			            <div class="table-responsive ">
			              	<div id="example23_wrapper" class="dataTables_wrapper no-footer">			              			
			              		<table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
			                		<thead>
						                <tr role="row">
						                  	<th style="width: 71px;">#</th>
						                    <th style="width: 127px;">Full name</th>
						                    <th style="width: 141px;">Total salary</th>
						                    <th style="width: 127px">status</th>
						                    <th style="width: 97px;">Action</th>
						                </tr>
					                </thead>
					                <?php

					                		$sql = "SELECT * FROM employee WHERE role = 'ADMIN' OR role = 'Employee' ";
					                		$query = mysqli_query($dbconnect, $sql);		
					                		$rows = mysqli_num_rows($query);

					                		if ($rows > 0) {
					                			$emp_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
					                			$n = 0;
					                			foreach($emp_data as $emp){ $n = $n + 1; ?>
	                				<tbody class="payroll">
	                					<tr class="odd">
	                						<td><?php echo $n; ?></td>
	                						<td><?php echo $emp['fname']." ".$emp['surname']; ?></td>
	                						<td>
	                							<?php 
	                								$emp_id = $emp['emp_id'];

	                								$emp_sql = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
	                								$emp_query = mysqli_query($dbconnect, $emp_sql);
	                								$emp_salary = mysqli_fetch_assoc($emp_query);

	                								if (isset($emp_salary['total'])) echo $emp_salary['total'];
	                							?>
	                								
	                						</td>
	                						<td>
	                							<?php 
	                								$month = date('m');
        											$year = date('Y');

	                								$sal_sql = "SELECT * FROM pay_salary WHERE emp_id = $emp_id AND month = $month AND year = $year";
										            $sal_query = mysqli_query($dbconnect, $sal_sql);
										            $rows = mysqli_num_rows($sal_query);
										            if ($rows > 0){
										            	echo "<button class='btn btn-sm btn-success'>Generated</button>";
										            } else {
										            	echo "-";
										            }
										        ?>
	                						</td>
	                						<td>
	                							<?php 
	                								$invoice = "payslip.php?emp_id=".$emp_id;
	                							?>
	                							<button type="button"><a href="<?php echo $invoice ?>" title="Generate payslip"><i class="fa fa-pencil-square-o"></i></button>
	                						</td>
	                					</tr>
	                				</tbody>
	                				<?php 
	                							}
	                						} else {?>
	                						<td valign="top" colspan="4" class="dataTables_empty">No data available in table</td>
	                				<?php	}
	                					
	                				?>
	              				</table>
	              			</div>
	            		</div>                                
	          		</div>
	    		</div>
	      	</div>
	    </div>
	</div>
</div>
<?php require('includes/footer.php'); ?>