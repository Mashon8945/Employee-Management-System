 <?php
    //Require the database connection page
    require("includes/logged_in.php"); 

    //Require user defined function page
    require("includes/my_function.php");
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/ico" sizes="16x16" href="assets/images/favicn.ico">
    <title>EMPLOYEE MANAGEMENT SYSTEM</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet" media="all">
    <link href="assets/css/print.css" rel="stylesheet" media="print">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css">   
    <link href="assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css">   
   <style type="text/css">
      .jqstooltip { 
         position: absolute;
         left: 0px;
         top: 0px;
         visibility: hidden;
         background: rgb(0, 0, 0) transparent;
         background-color: rgba(0,0,0,0.6);
         filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
         -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
         color: white;
         font: 10px arial, san serif;
         text-align: left;
         white-space: nowrap;
         padding: 5px;
         border: 1px solid white;
         z-index: 10000;
      }
      .jqsfield { 
         color: white;
         font: 10px arial, san serif;
         text-align: left;
      }
   </style>
</head>

<body class="fix-header fix-sidebar card-no-border mini-sidebar">
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> 
        </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <b><img src="assets/images/hricn.png" alt="DRI" class="DRI-logo" style="width:50px;"></b>
                        <!-- Logo text -->
                        <span style="display: none;">
                          <img src="assets/images/hrtag.png" alt="homepage" class="dark-logo" height="60px" width="100px">
                          <!-- Light Logo text -->    
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> 
                            <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> 
                        </li>
                        <li class="nav-item m-l-10"> 
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> 
                        </li>
                        <li class="nav-item dropdown">
                            <?php 
                                date_default_timezone_set('Africa/Nairobi');
                                $today = date('Y-m-d');
                                $time = date("H:i:s");

                                $sql = "SELECT * FROM notice WHERE date >= '$today' ";
                                $query = mysqli_query($dbconnect, $sql);
                                $not = mysqli_num_rows($query);
                            ?>
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i><?php if ($not > 0){?><sup style="color:gold"><?php echo $not;?></sup>
                                <div class="notify"><span class="heartbit"></span> <span class="point"></span> </div>
                             <?php }?>
                            </a>
                            <div class="dropdown-menu mailbox scale-up-left">
                                <ul>
                                    <li>
                                       <div class="drop-title">Notifications</div>
                                    </li>
                                    <li style="overflow: visible;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: visible hidden; width: auto; height: 250px;">
                                            <div class="message-center" style="overflow: hidden; width: auto; height: 250px;">
                                               <!-- Message -->
                                               <?php 
                                                   $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                   foreach ($results as $notis){
                                                      echo "<a href='notice.php' style='color: green; margin-left: 20px;'><b>".$notis['title']."</b></a>";
                                                   }
                                                ?>
                                            </div>
                                            <div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 249.976px;"></div>
                                            <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="notice.php"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php if(!isset($_SESSION['image'])){ echo 'assets/images/users/user.jpg'; } else { echo 'assets/images/users/'.$_SESSION['image']; }?>" alt="Genit" class="profile-pic" style="height:40px;width:40px;border-radius:50px"></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                            <?php 
                                                if(isset($_SESSION['image'])){
                                                    echo ' <img src="assets/images/users/'.$_SESSION['image'].'" alt="user" >'; 
                                                } else {?>
                                                  <img src="assets/images/users/user.jpg" alt="user">
                                            <?php
                                                } 
                                            ?>  
                                            </div>
                                            <div class="u-text">
                                                <h4><?php if(isset($_SESSION['fname'])) echo $_SESSION['fname']." ".$_SESSION['surname'];?></h4>
                                                <p class="text-muted"><?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="profile.php"><i class="ti-user"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <a href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!--aside bar-->
        <aside class="left-sidebar" style="overflow: visible;">
            <!-- Sidebar scroll-->
            <div class="slimScrollDiv" style="position: relative; overflow: visible; width: auto; height: 100%;">
                <div class="scroll-sidebar" style="overflow: visible hidden; width: auto; height: 100%;">
                    <!-- User profile-->
                    <div class="user-profile">
                        <div class="profile-img"> 
                            <?php 
                                if(!isset($_SESSION['image'])){
                                   echo ' <img alt="user" src="assets/images/users/user.png"> '; 
                                } else {?>
                                   <img alt="user" src="assets/images/users/<?php echo $_SESSION['image']; ?>"> 
                            <?php
                                }
                            ?> 
                        </div>
                        <div class="profile-text">
                            <h5> <?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']." ".$_SESSION['surname'];}?></h5>
                        </div>
                   </div>
                    <!-- End User profile-->

                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="nav-devider"></li>
                            <li> <a href="index.php"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building-o"></i><span class="hide-menu">Department </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="department.php">My Department </a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="employee.php">Active Employees </a></li>
                                    <li><a href="employees_leave.php">Employees on leave </a></li>
                                    <li><a href="inactive_employee.php">Former Employees</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Attendance </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="attendance.php">Sign Attendance</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Leave </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="leave.php"> Leave Application </a></li>  
                                    <li><a href="earned_leave.php"> Earned Leave </a></li>        
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Project </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="project.php">Projects </a></li>
                                    <li><a href="tasks.php">Tasks List</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Salary </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="payslip.php">Payslip</a></li>
                                    <li><a href="advance.php">Advance application </a></li>                            
                                </ul>
                            </li>
                        </ul>          
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 796px;"></div>
                <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
    </div>