<?php 
	require("includes/header.php");
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-fighter-jet" style="color:#1976d2"> </i>Earned Leave</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Leave</li>
                <li class="breadcrumb-item active">Earned Leave</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Earned leave</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Name</th>
                                        <th>Total Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                	$emp_id = $_SESSION['emp_id'];
                                	$sql = "SELECT employee.fname, employee.surname, attendance.working_hours
                                            FROM employee 
                                            LEFT JOIN attendance
                                            ON employee.emp_id = attendance.emp_id
                                            WHERE attendance.emp_id = $emp_id";
                                    $result = mysqli_query($dbconnect, $sql);
                                    $num_rows = mysqli_num_rows($result);

                                    $total_duration = 0;

                                    // Loop through the query results and add up the duration values
                                    if ($num_rows > 0) {
                                        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        foreach($rows as $row){
                                            $total_duration += $row["working_hours"];
                                        }
                                    }
                                    if ($total_duration >= 7800 ) {?>
                                        <tbody>
                                            <tr style="vertical-align:top">
                                                <td>1</td>
                                                <td><?php echo $row['fname']." ".$row['surname']; ?></td>
                                                <td><?php echo $total_duration; ?></td>
                                                <td><?php  ?></td>
        	                                </tr>
        	                            </tbody>
	                                <?php 
	                            	} else {?>
                                        <tbody>
                                            <tr style="vertical-align:top">
                                                <td class="text-center" colspan="4"><b style="color: green;">NO DATA!</b></td>
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