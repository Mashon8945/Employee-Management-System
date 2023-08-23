<?php
    require("includes/header.php");
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
                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="tasks.php" class="text-white"><i class="" aria-hidden="true"></i>  Tasks List</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Project List </h4>
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
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM project ORDER BY status ";
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
            if (isset($error)) :
                echo $error;
            endif;
            if (isset($success)) {
                echo $success;
            }
        ?> 
    </div>
</div>
<?php 
    require('includes/footer.php');
?>