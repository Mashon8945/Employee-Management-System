<?php
	require("includes/header.php");
?>

<div class="page-wrapper" style="min-height: 785px;">
	<div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clipboard"></i> Notice Board</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Notice Board</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#noticemodel" data-whatever="@getbootstrap" class="text-white "><i class="" aria-hidden="true"></i> Add Notice </a></button>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Notice</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                        	<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                            <thead>
	                                <tr>
	                                    <th>No.</th>
	                                    <th>Title</th>
	                                    <th>Subject</th>
	                                    <th>Date</th>
	                                </tr>
	                            </thead>
	                            <?php 
                                   $sql1 = "SELECT * FROM notice ORDER BY date DESC";
                                   $query1 = mysqli_query($dbconnect, $sql1);
                                   $result = mysqli_fetch_all($query1, MYSQLI_ASSOC);
                                   $n = 0;
                                   foreach ($result as $notice){
                            		$n = $n + 1;
	                            ?>
	                            <tbody>
	                                <tr>
	                                    <td><?php echo $n; ?></td>
	                                    <td><?php echo $notice['title'];?></td>
	                                    <td><a href=""><?php echo $notice['subject'];?></a></td>
	                                    <td><?php echo $notice['date'];?></td>
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
        </div>
        <?php
        if (isset($_POST['submit'])) {
         	$title = $subject = $nodate = $success = $error = '';

         	if (isset($_POST['title'])) {
         		$title = $_POST['title'];         	
         	}
         	if (isset($_POST['subject'])) {
         		$subject = $_POST['subject'];         	
         	}
         	if (isset($_POST['nodate'])) {
         		$nodate = $_POST['nodate'];         	
         	}

         	$sql = "INSERT INTO notice (title, subject, date) VALUES ('$title', '$subject', '$nodate')";
 	  		if ($dbconnect->query($sql) === TRUE) {
	           $success = '
	                <div class="col-lg-8 col-md-6 col-sm-5 col-xs-10">
	                    <link rel="stylesheet" href="css/alerts.css">
	                    <div class="alert-title">
	                    </div>
	                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
	                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
	                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
	                        </button>
	                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
	                        <p class="message-alert-none"><strong>Success!</strong>New Notice added successfully.</p>
	                    </div>
	                </div>';
	        }else{
	            $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
	        }
         } 

        ?>
        <!--modal content -->
        <div class="modal fade" id="noticemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Notice Board</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form method="post"  id="btnSubmit" enctype="multipart/form-data">
	                    <div class="modal-body">
	                            <div class="form-group">
	                                <label for="message-text" class="control-label">Notice Title</label>
	                                <input type="text" class="form-control" name="title" id="message-text1" required="">
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label">Subject</label>
	                                <label for="recipient-name1" class="control-label">Title</label>
	                                <textarea class="form-control" name="subject" required minlength="20" maxlength="200"></textarea>
	                            </div>
	                            <div class="form-group">
	                                <label for="message-text" class="control-label">Published Date</label>
	                                <input type="date" name="nodate" class="form-control" id="recipient-name1" required="">
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
        <?php 
            if (isset($success)) {
                echo $success;
            }
            if (isset($error)) {
                echo $error;
            }
        ?>
    </div>
</div>

<?php 
	require("includes/footer.php")
?>