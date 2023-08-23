<?php
    require("includes/header.php");
?>
<?php
    if (isset($_POST['submit'])) {
       $pro_title = $start_date = $end_date = $status = $description = '';

       $pro_title = $_POST['name'];
       $start_date = $_POST['startdate'];
       $end_date = $_POST['enddate'];
       $description = $_POST['description']; 

       $sql = "INSERT INTO project (name, start_date, end_date, description) VALUES ('$pro_title', '$start_date', '$end_date', '$description' )";
       if ($dbconnect->query($sql) === TRUE) {
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
                        <p class="message-alert-none"><strong>Success!</strong> You have registered a new employee successfully.</p>
                    </div>
                </div>';
        } else {
            $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
       }

    }
    if (isset($_POST['delete'])) {
       $project_id = $_POST['project_id'];


        $sql = "DELETE FROM project WHERE  ID = $project_id";
        if ($dbconnect->query($sql) === TRUE) {
            $Task_sql = "DELETE FROM project_tasks WHERE project_id = $project_id";
            if ($dbconnect->query($Task_sql)) {
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
                            <p class="message-alert-none"><strong>Success!</strong> project deleted and the resultant Task!.</p>
                        </div>
                    </div>';
            } else {
                $error1 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }
            
        } 

    }
?>
<?php
    $pros_sql = "SELECT * FROM project";
    $pros_query = mysqli_query($dbconnect, $pros_sql);
    $pro_status = mysqli_fetch_all($pros_query, MYSQLI_ASSOC);
    $today = date('Y-m-d');

    foreach($pro_status as $state){
        $ID = $state['ID'];
        if ($state['start_date'] > $today && $state['end_date'] > $today ) {
            $sql = "UPDATE project SET status = 'Upcoming' WHERE ID = $ID";
        } 
        if ($state['start_date'] <= $today && $state['end_date'] >= $today ) {
            $sql = "UPDATE project SET status = 'Running' WHERE ID = $ID";
        } 
        if ($state['start_date'] < $today && $state['end_date'] < $today ) {
            $sql = "UPDATE project SET status = 'Completed' WHERE ID = $ID";
        }

        if ($dbconnect->query($sql) === TRUE) {
            $success = '';
        } else {
            $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
       }
    }

?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-archive" aria-hidden="true"></i> Projects</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Projects</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Project </a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Project List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Project Title</th>
                                        <th>Status </th>
                                        <th>Start Date </th>
                                        <th>End Date </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM project";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $project = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $n=0;

                                    foreach ($project as $proj) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php $n = $n + 1; echo $n;?></td>
                                        <td><?php echo $proj['name']; ?></td>
                                        <td><?php echo $proj['status']; ?></td>
                                        <td><?php echo $proj['start_date'];?></td>
                                        <td><?php echo $proj['end_date'];?></td>
                                        <td class="jsgrid-align-center ">
                                            <form method="post" action="">
                                                <?php 
                                                    $project_id = $proj['ID'];
                                                    $project_url = "project_view.php?project_id=".$project_id;

                                                ?>
                                                <input type="hidden" name="project_id" value="<?php echo $proj['ID'];?>">
                                                <a href="<?php echo $project_url;?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                <button title="Delete" onclick="return confirm('Are you sure to delete this Project?')" class="btn btn-sm btn-danger waves-effect waves-light projectdelet" name="delete"><i class="fa fa-trash-o"></i></button>
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
        <!-- sample modal content --> 
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-braille"></i> Add Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form method="post" action=" " enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Project Title</label>
                                    <input type="text" name="name" class="form-control" id="recipient-name1" minlength="8" maxlength="250" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Project Start Date</label>
                                    <input type="date" name="startdate" class="form-control datepicker" id="recipient-name1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Project End Date</label>
                                    <input type="date" name="enddate" class="form-control datepicker" id="recipient-name1" required="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Description</label>
                                    <textarea class="form-control" name="description" id="message-text1" placeholder=""></textarea>
                                </div>
                            </div>                                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                    </form>
                    <?php 
                        if (isset($error1)) {
                            echo $error1;
                        }
                        if (isset($success1)) {
                            echo $success1;
                        }
                    ?>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php 
    require('includes/footer.php');
?>