<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="GenIT Bangladesh">
    <!-- Favicon icon -->
        <link rel="icon" type="image/ico" sizes="16x16" href="http://localhost/HRSystem-CI/assets/images/favicn.ico">
    <title>EMPLOYEE MANAGEMENT SYSTEM</title>
    <!-- Bootstrap Core CSS -->
    <link href="http://localhost/HRSystem-CI/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="http://localhost/HRSystem-CI/assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="http://localhost/HRSystem-CI/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    
    <link href="http://localhost/HRSystem-CI/assets/css/style.css" rel="stylesheet" media="all">
    <link href="http://localhost/HRSystem-CI/assets/css/print.css" rel="stylesheet" media="print">
    <!-- You can change the theme colors from here -->
    <link href="http://localhost/HRSystem-CI/assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="http://localhost/HRSystem-CI/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="http://localhost/HRSystem-CI/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="http://localhost/HRSystem-CI/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css">
    <link href="http://localhost/HRSystem-CI/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="http://localhost/HRSystem-CI/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    
    <script src="http://localhost/HRSystem-CI/assets/plugins/jquery/jquery.min.js"></script>
     <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <link href="http://localhost/HRSystem-CI/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css">   
    <link href="http://localhost/HRSystem-CI/assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css">   
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

<body class="fix-header fix-sidebar card-no-border mini-sidebar">
            <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar" style="">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://localhost/HRSystem-CI/"><b>
                        <img src="http://localhost/HRSystem-CI/assets/images/hricn.png" alt="DRI" class="DRI-logo" style="width:50px;">
                        </b>
                        <!-- Logo text --><span style="display: none;">
                         <img src="http://localhost/HRSystem-CI/assets/images/hrtag.png" alt="homepage" class="dark-logo" height="60px" width="100px">
                         <!-- Light Logo text -->    
                         </span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox scale-up-left">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li style="overflow: visible;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: visible hidden; width: auto; height: 250px;"><div class="message-center" style="overflow: hidden; width: auto; height: 250px;">
                                            <!-- Message -->
                                                                                    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 250px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div> 
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="http://localhost/HRSystem-CI/assets/images/users/Soy1332.jpg" alt="Genit" class="profile-pic" style="height:40px;width:40px;border-radius:50px"></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="http://localhost/HRSystem-CI/assets/images/users/Soy1332.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Thom Anderson</h4>
                                                <p class="text-muted">thoma@mail.com</p>
                                        </div>
                                    </div></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="http://localhost/HRSystem-CI/employee/view?I=U295MTMzMg=="><i class="ti-user"></i> My Profile</a></li>
                                                                        
                                    <li><a href="http://localhost/HRSystem-CI/settings/Settings"><i class="ti-settings"></i> Account Setting</a></li>
                                                                        <li><a href="http://localhost/HRSystem-CI/login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" style="overflow: visible;">
            <!-- Sidebar scroll-->
            <div class="slimScrollDiv" style="position: relative; overflow: visible; width: auto; height: 100%;"><div class="scroll-sidebar" style="overflow: visible hidden; width: auto; height: 100%;">
                <!-- User profile -->
                                        
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="http://localhost/HRSystem-CI/assets/images/users/Soy1332.jpg" alt="user">
                        <!-- this is blinking heartbit-->
                         <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>

                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>Thom Anderson</h5>
                        <a href="http://localhost/HRSystem-CI/settings/Settings" class="dropdown-toggle u-dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="http://localhost/HRSystem-CI/login/logout" class="" data-toggle="tooltip" title="" data-original-title="Logout"><i class="mdi mdi-power"></i></a>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="http://localhost/HRSystem-CI/"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                                                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building-o"></i><span class="hide-menu">Organization </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/organization/Department">Department </a></li>
                                <li><a href="http://localhost/HRSystem-CI/organization/Designation">Designation</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/employee/Employees">Employees </a></li>
                                <li><a href="http://localhost/HRSystem-CI/employee/Disciplinary">Disciplinary </a></li>
                                <li><a href="http://localhost/HRSystem-CI/employee/Inactive_Employee">Inactive User </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Attendance </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/attendance/Attendance">Attendance List </a></li>
                                <li><a href="http://localhost/HRSystem-CI/attendance/Save_Attendance">Add Attendance </a></li>
                                <li><a href="http://localhost/HRSystem-CI/attendance/Attendance_Report">Attendance Report </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/leave/Holidays"> Holiday </a></li>
                                <li><a href="http://localhost/HRSystem-CI/leave/leavetypes"> Leave Type</a></li>
                                <li><a href="http://localhost/HRSystem-CI/leave/Application"> Leave Application </a></li>
                                <li><a href="http://localhost/HRSystem-CI/leave/Earnedleave"> Earned Leave </a></li>
                                <li><a href="http://localhost/HRSystem-CI/leave/Leave_report"> Report </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Project </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/Projects/All_Projects">Projects </a></li>
                                <li><a href="http://localhost/HRSystem-CI/Projects/All_Tasks"> Task List </a></li>
                                <li><a href="http://localhost/HRSystem-CI/Projects/Field_visit"> Field Visit</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payroll </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="Payroll/Salary_Type"> Payroll Type </a></li>-->
                                <li><a href="http://localhost/HRSystem-CI/Payroll/Salary_List"> Payroll List </a></li>
                                <li><a href="http://localhost/HRSystem-CI/Payroll/Generate_salary"> Generate Payslip</a></li>
                                <li><a href="http://localhost/HRSystem-CI/Payroll/Payslip_Report"> Payslip Report</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/Loan/View"> Grant Loan </a></li>
                                <li><a href="http://localhost/HRSystem-CI/Loan/installment"> Loan Installment</a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-grid"></i><span class="hide-menu">Assets </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="http://localhost/HRSystem-CI/Logistice/Assets_Category"> Assets Category </a></li>
                                <li><a href="http://localhost/HRSystem-CI/Logistice/All_Assets"> Asset List </a></li>
                                <!--<li><a href="Logistice/View"> Logistic Support List </a></li>-->
                                <li><a href="http://localhost/HRSystem-CI/Logistice/logistic_support"> Logistic Support </a></li>
                            </ul>
                        </li>
                        
                        <li> <a href="http://localhost/HRSystem-CI/notice/All_notice"><i class="mdi mdi-clipboard"></i><span class="hide-menu">Notice <span class="hide-menu"></span></span></a></li>
                        <li> <a href="http://localhost/HRSystem-CI/settings/Settings"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings <span class="hide-menu"></span></span></a></li>
                                            </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 772.407px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
            <!-- End Sidebar scroll-->
        </aside>      <div class="page-wrapper" style="min-height: 707px;">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp; Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-primary"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                    12  Employees</h3>
                                        <a href="http://localhost/HRSystem-CI/employee/Employees" class="text-muted m-b-0">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-file"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             4 Leaves
                                        </h3>
                                        <a href="http://localhost/HRSystem-CI/leave/Application" class="text-muted m-b-0">View Details</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         5 Projects
                                        </h3>
                                        <a href="http://localhost/HRSystem-CI/Projects/All_Projects" class="text-muted m-b-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-money"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         1 Loan 
                                        </h3>
                                        <a href="http://localhost/HRSystem-CI/Loan/View" class="text-muted m-b-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                
                <div class="row ">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="box bg-primary text-center">
                                <h1 class="font-light text-white">
                                    0                                </h1>
                                <h6 class="text-white">Former Employees</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             0 
                                </h1>
                                <h6 class="text-white">Pending Leave Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-danger">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                     1 
                                </h1>
                                <h6 class="text-white">Upcoming Project</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         1 
                                </h1>
                                <h6 class="text-white">Loan Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
            </div> 
            <div class="container-fluid">
                                <!-- Row -->
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Running Project/s</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-bordered table-hover earning-box">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                       <tr style="vertical-align:top;">
                                                <td><a href="http://localhost/HRSystem-CI/Projects/view?P=Ng==">Graphics Illustration...</a></td>
                                                <td>Jan 2, 2022</td>
                                                <td>Jan 10, 2022</td>
                                            </tr>
                                                                                        <tr style="vertical-align:top;">
                                                <td><a href="http://localhost/HRSystem-CI/Projects/view?P=NQ==">Real Estate Site...</a></td>
                                                <td>Dec 29, 2021</td>
                                                <td>Mar 21, 2022</td>
                                            </tr>
                                                                                        <tr style="vertical-align:top;">
                                                <td><a href="http://localhost/HRSystem-CI/Projects/view?P=NA==">Customer support service ...</a></td>
                                                <td>Dec 25, 2021</td>
                                                <td>Feb 16, 2022</td>
                                            </tr>
                                                                                        <tr style="vertical-align:top;">
                                                <td><a href="http://localhost/HRSystem-CI/Projects/view?P=Mw==">Image Enhancement Softwar...</a></td>
                                                <td>Dec 10, 2021</td>
                                                <td>Mar 20, 2022</td>
                                            </tr>
                                                                                        <tr style="vertical-align:top;">
                                                <td><a href="http://localhost/HRSystem-CI/Projects/view?P=Mg==">Multi User Chat System...</a></td>
                                                <td>Jan 1, 2022</td>
                                                <td>April 14, 2022</td>
                                            </tr>
                                                                                    </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">To Do list</h4>
                                <h6 class="card-subtitle">List of your next task to complete</h6>
                                <div class="to-do-widget m-t-20" style="height:550px;overflow-y:scroll">
                                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                                                                               <li class="list-group-item" data-role="task">
                                                                                                       <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="6" data-value="1" type="checkbox" id="6" checked="">
                                                        <label class="task-done" for="6"><span>Attend Interviews</span></label>
                                                    </div> 
                                                                                                       
                                                </li>

                                                                                                <li class="list-group-item" data-role="task">
                                                                                                       <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="5" data-value="1" type="checkbox" id="5" checked="">
                                                        <label class="task-done" for="5"><span>Attend Zoom Meetings</span></label>
                                                    </div> 
                                                                                                       
                                                </li>

                                                                                                <li class="list-group-item" data-role="task">
                                                                                                       <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="4" data-value="1" type="checkbox" id="4" checked="">
                                                        <label class="task-done" for="4"><span>Assign Task to Dev.</span></label>
                                                    </div> 
                                                                                                       
                                                </li>

                                                                                                <li class="list-group-item" data-role="task">
                                                                                                       <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="3" data-value="1" type="checkbox" id="3" checked="">
                                                        <label class="task-done" for="3"><span>Recruit Members</span></label>
                                                    </div> 
                                                                                                       
                                                </li>

                                                                                                <li class="list-group-item" data-role="task">
                                                                                                       <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="2" data-value="1" type="checkbox" id="2" checked="">
                                                        <label class="task-done" for="2"><span>Research on X1, Y2, A3</span></label>
                                                    </div> 
                                                                                                       
                                                </li>

                                                                                            </ul>                                    
                                </div>
                                <div class="new-todo">
                                   <form method="post" action="add_todo" enctype="multipart/form-data" id="add_todo" novalidate="novalidate">
                                    <div class="input-group">
                                        <input type="text" name="todo_data" class="form-control" style="border: 1px solid #fff !IMPORTANT;" placeholder="Enter New Task...">
                                        <span class="input-group-btn">
                                        <input type="hidden" name="userid" value="Soy1332">
                                        <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                        </span> 
                                    </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notice Board</h4>
                            </div>
                            <div class="card-body" style="overflow: visible;">
                                <div class="table-responsive slimScrollDiv" style="height: 600px; overflow: visible scroll;">
                                    <table class="table table-hover table-bordered earning-box ">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                       <tr class="scrollbar" style="vertical-align:top">
                                                <td>Notice to everyone from HR</td>
                                                <td><mark><a href="http://localhost/HRSystem-CI/assets/images/notice/Annette.png" target="_blank">Annette.png</a></mark>
                                                </td>
                                                <td style="width:100px">2023-03-01</td>
                                            </tr>
                                                                                        <tr class="scrollbar" style="vertical-align:top">
                                                <td>This is a demo notice for all!</td>
                                                <td><mark><a href="http://localhost/HRSystem-CI/assets/images/notice/sample_image.jpg" target="_blank">sample_image.jpg</a></mark>
                                                </td>
                                                <td style="width:100px">2022-01-01</td>
                                            </tr>
                                                                                        <tr class="scrollbar" style="vertical-align:top">
                                                <td>Warning for Violation of Office Decorum</td>
                                                <td><mark><a href="http://localhost/HRSystem-CI/assets/images/notice/offnot2.png" target="_blank">offnot2.png</a></mark>
                                                </td>
                                                <td style="width:100px">2021-12-27</td>
                                            </tr>
                                                                                        <tr class="scrollbar" style="vertical-align:top">
                                                <td>Office Decorum Notice to Staff Members</td>
                                                <td><mark><a href="http://localhost/HRSystem-CI/assets/images/notice/offnot1.png" target="_blank">offnot1.png</a></mark>
                                                </td>
                                                <td style="width:100px">2021-12-21</td>
                                            </tr>
                                                                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Holidays
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover table-bordered earning-box">
                                       <thead>
                                            <tr>
                                                <th>Holiday Name</th>
                                                <th>Date</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                                                                     <tr style="background-color:#e3f0f7">
                                               <td>Saint Patrick's Day</td>
                                               <td>2021-03-17</td>
                                           </tr>
                                                                                      <tr style="background-color:#e3f0f7">
                                               <td>Halloween</td>
                                               <td>2021-10-31</td>
                                           </tr>
                                                                                      <tr style="background-color:#e3f0f7">
                                               <td>Thanksgiving</td>
                                               <td>2021-11-23</td>
                                           </tr>
                                                                                      <tr style="background-color:#e3f0f7">
                                               <td>Christmas</td>
                                               <td>2021-12-23</td>
                                           </tr>
                                                                                      <tr style="background-color:#e3f0f7">
                                               <td>New Year's Day</td>
                                               <td>2022-01-01</td>
                                           </tr>
                                                                                      <tr style="background-color:#e3f0f7">
                                               <td>New Year's Eve</td>
                                               <td>2021-12-30</td>
                                           </tr>
                                                                                  </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
<script>
  $(".to-do").on("click", function(){
      //console.log($(this).attr('data-value'));
      $.ajax({
          url: "Update_Todo",
          type:"POST",
          data:
          {
          'toid': $(this).attr('data-id'),         
          'tovalue': $(this).attr('data-value'),
          },
          success: function(response) {
              location.reload();
          },
          error: function(response) {
            console.error();
          }
      });
  });			
</script>                                               
            </div>

            <footer class="footer"> © 2023 | Developed By GenIT Bangladesh </footer>

        </div>

    </div>


    <!-- Bootstrap tether Core JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="http://localhost/HRSystem-CI/assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="http://localhost/HRSystem-CI/assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/js/custom.min.js"></script>

    <!-- ============================================================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/raphael/raphael-min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/morrisjs/morris.js"></script>
    <!-- Chart JS -->




    <!-- CHART COMMENTED....UNCOMMENT WHEN DONE -->
    <!-- <script src="http://localhost/HRSystem-CI/assets/js/dashboard1.js"></script> -->




    
 <script src="http://localhost/HRSystem-CI/assets/plugins/moment/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>  
   
    <script src="http://localhost/HRSystem-CI/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- Editable -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/jsgrid/db.js"></script>
    <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/jsgrid/dist/jsgrid.min.js"></script>
    <!-- This is data table -->

    <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

   
    <!-- Clock Plugin JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>                        
    <!-- Date range Plugin JavaScript -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>     
    <!-- end - This is for export functionality only -->
    <script src="http://localhost/HRSystem-CI/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    



    <!-- CALENDAR -->
    <!-- <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/calendar/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/calendar/dist/fullcalendar.min.js"></script>
    <script type="text/javascript" src="http://localhost/HRSystem-CI/assets/plugins/calendar/dist/cal-init.js"></script>
    <script src="http://localhost/HRSystem-CI/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>



</body></html>