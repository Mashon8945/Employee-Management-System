<?php 
    require('includes/header.php');
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="mdi mdi-account-off" aria-hidden="true"></i> Former Employee</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item ">Employee</li>
                <li class="breadcrumb-item active">Former Employees</li>
            </ol>
        </div>
    </div>
    <div class="message"></div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="add_employee.php" class="text-white"><i class="" aria-hidden="true"></i> Add Employee</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="mdi mdi-account-off" aria-hidden="true"></i> Former Employees List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%"  style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 48px;">No.</th>
                                        <th style="width: 139px;">Employee Name</th> 
                                        <th style="width: 132px;">Email</th>
                                        <th style="width: 83px;">Contact</th>
                                        <th style="width: 67px;">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM employee WHERE role = 'Former' ORDER BY fname";
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
                                        <td class="jsgrid-align-center ">
                                            <?php  
                                                $emp_id = $emp['emp_id'];
                                                $profile_url = "employee_edit.php?emp_id=".$emp_id; 
                                            ?>
                                            <a href="<?php echo $profile_url ;?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="" title="delete" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Are you sure to delete this data?')"><i class="fa fa-trash-o"></i></a>
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
    </div>
</div>
<?php 
    require('includes/footer.php');
?>