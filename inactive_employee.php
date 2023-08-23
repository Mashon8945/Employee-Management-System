<?php 
    require('includes/header.php');
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i> Former Employees</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Former Employees</li>
            </ol>
        </div>
    </div>
    <div class="message"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-users" aria-hidden="true"></i> Former Employee List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="employees123" class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="employees123_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 48px;">No.</th>
                                        <th style="width: 139px;"> Employee Name</th> 
                                        <th style="width: 132px;">Email</th>
                                        <th style="width: 83px;">Contact</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM employee WHERE role = 'Former' ";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $num = mysqli_num_rows($query);
                                    $n=0;

                                    foreach ($results as $emp) {
                                ?>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php $n = $n + 1; echo $n; ?></td>
                                        <td title='<?php echo $emp['fname']." ".$emp['surname'];?>'><?php echo $emp['fname']." ".$emp['surname'];?></td>
                                        <td><?php echo $emp['email'];?></td>
                                        <td>0<?php echo $emp['contact'];?></td>
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
</div>
<?php 
    require('includes/footer.php');
?>