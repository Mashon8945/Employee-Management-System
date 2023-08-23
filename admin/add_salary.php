<?php 
    require('includes/header.php');
?>
<?php
    if (isset($_POST['save'])) {
       $basic = $_POST['basic'];
       $medical = $_POST['medical'];
       $house = $_POST['house'];
       $commute = $_POST['commute'];

       $sql = "INSERT INTO salary (basic_salary, medical_allowance, house_allowance, commute_allowance) VALUES ('$basic', '$medical', '$house', '$commute')";
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
                        <p class="message-alert-none"><strong>Success!</strong>Salary added successfully.</p>
                    </div>
                </div>';
        }else{
            $error = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
        }

    }

    if (isset($_POST['drop'])) {
        $id = $_POST['salary_id'];
        $drop_sql = "DELETE FROM salary WHERE ID = $id";
        $drop_query = mysqli_query($dbconnect, $drop_sql);    

        if ($drop_query === TRUE ) {
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
                        <p class="message-alert-none"><strong>Success!</strong> dropped successfully.</p>
                    </div>
                </div>';
         }
         else{
           $error = "
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                    <link rel='stylesheet' href='css/alerts.css'>
                    <div class='alert-title'>
                    </div>
                    <div class='alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone'>
                        <button type='button' class='close sucess-op' data-dismiss='alert' aria-label='Close'>
                                <span class='icon-sc-cl' aria-hidden='true'>&times;</span>
                        </button>
                        <i class='fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-none' aria-hidden='true'></i>
                        <p class='message-alert-none'><strong>Danger!</strong> A dangerous or potentially negative action.".$dbconnect->error."</p>
                    </div>
                </div>
            ";
        }
    }
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-money" style="color:#1976d2"></i> Salary Cap</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Salary</li>
                <li class="breadcrumb-item active">Salary Cap</li>
            </ol>
        </div>
    </div>
    <div class="message"></div> 
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Salary </a></button>
            </div>
        </div>         
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Salaries List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Basic Salary</th>
                                        <th>Medical Allowance</th>
                                        <th>House Allowance</th>
                                        <th>Commutance Allowance</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = "SELECT * FROM salary";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $n = 0;

                                    foreach ($results as $sal) {    $n++; ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $n; ?></td>
                                        <td><?php echo $sal['basic_salary']; ?></td>
                                        <td><?php echo $sal['medical_allowance']; ?></td>
                                        <td><?php echo $sal['house_allowance'];?></td>
                                        <td><?php echo $sal['commute_allowance'];?></td>
                                        <td class="jsgrid-align-center ">
                                            <form method="post" action="">
                                                <input type="hidden" name="salary_id" value="<?php echo $sal['ID']; ?>">
                                                <a href="" data-toggle="modal" data-target="#exampleModal" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                <button type="submit" name="drop" onclick="return confirm('Are you sure to delete this data?')" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
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
                <?php
                    if(isset($success)){
                        echo $success;
                    }
                    if (isset($error)) {
                       echo $error;
                    }
                ?>
            </div>
        </div>
        <!-- sample modal content -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1"><i class="fa fa-money"></i> Add Salary</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form method="post" action=" " id="btnSubmit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Basic Salary</label>
                                    <input type="number" name="basic" id="salary" class="form-control" maxlength="10" minlength="5" required="" placeholder="Ksh. 50000">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Medical Allowance</label>
                                    <input type="number" name="medical" class="form-control datepicker"  placeholder="Ksh 5000" maxlength="10" minlength="5">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">House Allowance</label>
                                    <input type="number" name="house" class="form-control datepicker" required="" placeholder="Ksh 2000" maxlength="10" minlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Commute Allowance</label>
                                    <input type="number" class="form-control" name="commute" placeholder="Ksh 10000" required="" maxlength="10" minlength="5">
                                </div>
                            </div>                                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-success">Submit</button>
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