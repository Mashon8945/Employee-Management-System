<?php 
    require('includes/header.php');
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-fighter-jet" style="color:#1976d2"></i> Leave Types</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave</li>
            </ol>
        </div>
    </div> 
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#leavemodel" class="text-white"><i class="" aria-hidden="true"></i> Add Leave Types</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Leave List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>Leave Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $sql = "SELECT * FROM leave_type";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $leaves = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $i = 0;
                                    foreach ($leaves as $leave){
                                        $i = $i + 1;
                                    ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php if(isset($leave['name'])) echo $leave['name'];?></td>
                                        <td class="jsgrid-align-center ">
                                            <form method="post">
                                                <input type="hidden" name="leave_id" value="<?php echo $leave['type_id'];?>">
                                                <a href="" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light leavetype" data-id="8"><i class="fa fa-pencil-square-o"></i></a>
                                                <button onclick="confirm('Are you sure, you want to delete this?')" name="delete" href="" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
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
        <?php
            if (isset($_POST['delete'])) {
                $leave_id = $_POST['leave_id'];

                $sql = "DELETE FROM leave_type WHERE type_id = $leave_id";
                if ($dbconnect->query($sql) === TRUE) {
                    $success = '
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <link rel="stylesheet" href="css/alerts.css">
                            <div class="alert-title"></div>
                            <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                <p class="message-alert-none"><strong>Success! leave type deleted</strong> .</p>
                            </div>
                        </div>';
                }else{
                    $error = '
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <link rel="stylesheet" href="css/alerts.css">
                            <div class="alert-title"></div>
                            <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                <p class="message-alert-none"><strong>Danger! Error: ' .$dbconnect->error.'</strong>.</p>
                            </div>
                        </div>';
                } 
            }
        ?>
        <?php
            if (isset($_POST['submit'])) {
                $name = $days = $status = $success = $error = '';
                $name = $_POST['name'];

                $sql = "INSERT INTO leave_type (name) VALUES ('$name')";
                if ($dbconnect->query($sql) === TRUE) {
                    $success = '
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <link rel="stylesheet" href="css/alerts.css">
                            <div class="alert-title"></div>
                            <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                <p class="message-alert-none"><strong>Success! New leave type added</strong> .</p>
                            </div>
                        </div>';
                }else{
                    $error = '
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <link rel="stylesheet" href="css/alerts.css">
                            <div class="alert-title"></div>
                            <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                <p class="message-alert-none"><strong>Danger! Error: ' .$dbconnect->error.'</strong>.</p>
                            </div>
                        </div>';
                }
            }
        ?>
         <?php 
            if (isset($error)) {
                echo $error;
            }
            if (isset($success)) {
                echo $success;
            }
        ?> 
        <!--modal-->
        <div class="modal fade" id="leavemodel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title">Leave Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form method="post" action="" id="leaveform" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Leave name <i style="color:red">*</i></label>
                                <input type="text" name="name" class="form-control" id="recipient-name1" minlength="1" maxlength="35" value="" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
<?php 
    require('includes/footer.php');
?>
