<?php 
    require('includes/header.php');  

    if (isset($_POST['submit'])) {
        $success = $error = '';

        $emp_id = $_POST['emid']; 
        $atten_date = $_POST['atten_date'];
        $signin = $_POST['signin'];
        $signout = $_POST['signout'];
        $duration = $_POST['duration'];
        $status = 'Pending';

        $attend = "SELECT * FROM attendance WHERE emp_id = '$emp_id'  AND atten_date = '$atten_date' ";
        $attend_query = mysqli_query($dbconnect, $attend);
        $row = mysqli_num_rows($attend_query);

        if ($row > 0) {
            $error = '
                    <div class="col-lg-7 col-md-7 col-sm-5 col-xs-12">
                        <link rel="stylesheet" href="css/alerts.css">
                        <div class="alert-title"></div>
                        <div class="alert alert-danger alert-danger-style1 alert-danger-stylenone">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                            <p class="message-alert-none"><strong>Danger! You have already signed Attendance</strong>.</p>
                        </div>
                    </div>';
        } else{
            $sql = "INSERT INTO attendance (emp_id, atten_date, signin_time, signout_time, working_hours, status) VALUES ('$emp_id', '$atten_date', '$signin', '$signout', '$duration', '$status')";
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
                            <p class="message-alert-none"><strong>Success! Attendance signed</strong> .</p>
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
    }
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Attendance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item">Attendance</li>
                <li class="breadcrumb-item active">Sign Attendance</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">  
        <div class="row">
            <div class="col-6">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Sign Attendance </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Employee</label>
                                    <select class="form-control custom-select" name="emid" id="sign-time"  name="emid" required="" onchange ="calculateTime()">
                                        <option value="">Select Here</option>
                                        <option value="<?php echo $_SESSION['emp_id'];?>"> <?php echo $_SESSION['fname']." ".$_SESSION['surname'];?> </option>
                                    </select>
                                </div>
                                <label>Date: </label>
                                <div class="input-group date">
                                    <input name="atten_date" class="form-control mydatetimepickerFull" value="<?php echo $today; ?>" readonly="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="form-group">
                                   <label class="m-t-20">Sign In Time</label>
                                    <input type="text" class="form-control" name="signin" id="signin-time" value="<?php echo $time; ?>" readonly="">
                                </div>
                                <div class="form-group">
                                    <label class="m-t-20">Sign Out Time</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" name="signout" id="signout-time" class="form-control" value="17:00:00" readonly="">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" name="duration" id="duration-time" class="form-control" readonly="" value="9">
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">                                       
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit"  name="submit" class="btn btn-success">Submit</button>
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
  <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment/moment.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment/locale/en-gb.js"></script>
  <script>
    function calculateTime() {
        const inputTime = $('#signin-time').val();
        const inputMoment = moment(inputTime, 'HH:mm:ss');
        const targetMoment = moment('17:00:00', 'HH:mm:ss');
        const diffMinutes = targetMoment.diff(inputMoment, 'minutes');
        const diffHours = diffMinutes / 60;

        // Output the difference in the input duration field, with 1 decimal place
        $('#duration-time').val(diffHours.toFixed(1));
    }
  </script> 
<?php require('includes/footer.php'); ?>