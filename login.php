<?php
    // Start the session
    session_start();

    //Require the database connection page
    require("includes/db_connect.php"); 

    //Require user defined function page
    require("includes/my_function.php");

    //pick user details from the form
    if (isset($_POST['login'])){

        //creating variables to hold form data
        $email = $login_success = ''; 
        $login_error = array('status' => '', 'password' => '', 'email' => '', 'general' => '');
        $password = 0;

        //picking data from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Prevent cross-site scripting
        $email = sanitize($email);
        $password = sanitize($password);

        $sql = "SELECT * FROM employee WHERE email = '$email' ";
        $result = mysqli_query($dbconnect, $sql);
        $employee = mysqli_fetch_assoc($result);
        $num = mysqli_num_rows($result);
        
        if ($num > 0) {
            $pass_from_db = $employee['password'];
            $role = $employee['role'];
            $state = $employee['status'];

            if ($role == 'Former') {
                $login_error['status'] = "<p style='color: red'> Login failed! You are no longer an employee of this organisation. Please contact HR for further information </p>";
            }else{
                if ($state > 0) {
                    $password = crypt($password, 'Mashon_89');
                    if ($password == $pass_from_db) {
                        $login_success = "<p style='color: green'> Login Successful </p>";
                        //Save some user info on a session
                        $_SESSION['fname'] = $employee['fname'];
                        $_SESSION['surname'] = $employee['surname'];
                        $_SESSION['emp_id'] = $employee['emp_id'];
                        $_SESSION['contact'] = $employee['contact'];
                        $_SESSION['email'] = $employee['email'];
                        $_SESSION['image'] = $employee['image']; 
                        $_SESSION['dob'] = $employee['DOB'];
                        $_SESSION['role'] = $employee['role'];
                        $_SESSION['status'] = $employee['status'];
                        $_SESSION['joining_date'] = $employee['joining_date'];
                        $_SESSION['gender'] = $employee['gender'];
                        $_SESSION['contract_end'] = $employee['contract_end'];
                        $_SESSION['dept_id'] = $employee['dept_id'];

                        //Redirect user to their home page
                        if ($role == 'ADMIN') {
                            header('Location: admin/index.php');
                        } else {
                            header('Location: index.php');
                        }
                    } else {
                        $login_error['password'] = "<p style='color: red'> Login failed! Incorrect password! </p>";
                    }
                } else {
                    $login_error['general'] = "<p style='color: red'> Login failed! You are on leave. Please contact HR for further information </p>";
                }
            }
        } else {
            $login_error['email'] = "<p style='color: red'><strong>Danger!</strong> User doesn't exist!</p>";
        }
        // Free Memory result set
        mysqli_free_result($result);
    }

    //Close the Database connection
    mysqli_close($dbconnect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Employee management System</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
</head>
<style type="text/css">
    .password-field {
        position: relative;
    }
    .show-password {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(assets/images/background/hrbbg.jpg);"> 
        <div class="login-box card">
            <div class="card-body loginpage">                                          
                <form class="form-horizontal form-material" method="post" id="loginform" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <a href="" class="text-center db"><br/><img src="assets/images/hrinv.png" width="175px" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="form-group">
                            <input class="form-control" name="email" value="<?php if (isset($email)) { echo $email;} ?>" type="text" required placeholder="Email">
                        </div>
                    </div>
                    <div class="password-field">
                        <div class="col-xs-12">
                            <input class="form-control" id="typepass" name="password" value="<?php if (isset($password)) echo $password; ?>" type="password" required="" placeholder="Password">
                            <span class="show-password"><i class="fa fa-fw fa-eye field-icon" onclick="Toggle()" ></i></span>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember-me" >
                        <label class="form-check-label" for="remember-me">Remember me</label>
                    </div>                     
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-success btn-login btn-block text-uppercase waves-effect waves-light" type="submit" name="login">Log In</button>
                        </div>
                    </div>
                    <?php                         
                        if (isset($login_success)) {
                            echo $login_success;
                        }
                        if (isset($login_error['email'])) {
                            echo $login_error['email'];
                        }
                        if (isset($login_error['password'])) {
                            echo $login_error['password'];
                        }
                        if (isset($login_error['status'])) {
                            echo $login_error['status'];
                        }
                        if (isset($login_error['general'])) {
                            echo $login_error['general'];
                        }
                    ?>
                </form>
            </div>
        </div>
    </section>


    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>
<script>
    // Change the type of input to password or text
    function Toggle() {
        var temp = document.getElementById("typepass");
        if (temp.type === "password") {
            temp.type = "text";
        }
        else {
            temp.type = "password";
        }
    }
</script>

</html>