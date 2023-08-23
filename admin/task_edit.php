<?php require("includes/header.php");?>
<?php
	$task_id = $_GET['task_id']; 
?>
<?php
	if (isset($_POST['submit'])) {
		$task_id = $_GET['task_id']; 
		$Name = $_POST['name'];
		$start_date = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$desc = $_POST['description'];

		$sql = "UPDATE project SET name = '$Name', start_date = '$start_date', end_date = '$enddate', description = '$desc' WHERE ID = '$task_id'";
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
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-archive" aria-hidden="true"></i> Tasks Edit</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Tasks</li>
                <li class="breadcrumb-item active">Task Edit</li>
            </ol>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><a href="tasks.php" class="text-white">Back </a></button>
            </div>
        </div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">Task Edit</div>
					<div class="card-body">
						<form class="form-group" method="post" action="" enctype="multipart/form-data">
							<?php 
								$sql = "SELECT * FROM project_tasks WHERE ID = $task_id";
								$query = mysqli_query($dbconnect, $sql);
								$row = mysqli_num_rows($query);

								if ($row > 0) {
									$result = mysqli_fetch_assoc($query);?>
		                    <label for="project-name">Name:</label>
		                    <input class="form-control" type="text" id="project-name" name="name" value="<?php echo $result['name'];?>">
		                    <label for="start-date">Start Date:</label>
		                    <input class="form-control" type="date" id="start-date" name="startdate" value="<?php echo $result['start_date'];?>">
		                    <label for="end-date">End Date:</label>
		                    <input class="form-control" type="date" id="end-date" name="enddate" value="<?php echo $result['end_date'];?>">
		                    <label for="description">Description:</label><br>
		                    <input class="form-control" id="description" name="description" value="<?php echo $result['end_date'];?>">
		                <?php }?>
		            </div>
		            <div class="card-footer">
		                    <div class="form-actions">
                                <button type="submit" class="btn btn-success" name="submit"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger"><a href="project.php"> Cancel</a></button>
                            </div>
		                </form>
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
	</div>
</div>
<?php require("includes/footer.php");?>