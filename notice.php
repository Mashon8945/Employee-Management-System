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
	                                    <td><a href="" data-toggle="modal" data-target="#noticemodel"><?php echo $notice['subject'];?></a></td>
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
        	$notis_sql = "SELECT * FROM notice WHERE ID = 3";
        	$notis_query = mysqli_query($dbconnect, $notis_sql);
        	$Result = mysqli_fetch_assoc($notis_query);
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
                                <label for="message-text" class="control-label"><?php echo $Result['date'];?></b></label>
                            </div>
                            <div class="form-group">
                               <label for="message-text" class="control-label"><u>RE:<b><?php echo " ". $Result['title'];?></b></u></label>
                                <p><b><?php echo $Result['subject'];?></b></p>
                            </div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
	require("includes/footer.php")
?>