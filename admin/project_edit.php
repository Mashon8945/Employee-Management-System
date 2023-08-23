<?php require("includes/header.php");?>
<?php
	$project_id = $_GET['project_id']; 
?>

<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-archive" aria-hidden="true"></i> Project Edit</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Project Edit</li>
            </ol>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><a href="project.php" class="text-white"><i class="fa fa-angle-left"></i>Back </a></button>
            </div>
        </div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">Project Edit</div>
					<div class="card-body">
						<form class="form-group" method="post" action="" enctype="multipart/form-data">
							<?php 
								$sql = "SELECT * FROM project WHERE ID = $project_id";
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
		                    <input class="form-control" id="description" name="description" value="<?php echo $result['description'];?>">
		                <?php }?>
		            </div>
		            <div class="card-footer">
		                    <div class="form-actions">
                                <button type="submit" class="btn btn-success" name="submit"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger"><a href="project.php" class="text-white"> Cancel</a></button>
                            </div>
		                </form>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require("includes/footer.php");?>