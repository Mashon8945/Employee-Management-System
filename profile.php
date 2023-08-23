<?php
	require('includes/header.php');
?>
<?php 
    if (isset($_POST['save'])){

        //creating variables to hold form data
        $firstname = $surname = $contact =  $image = $tempName = $folder = $dob = $gender = '';
        $success = '';
        $error = array('firstname' => '', 'surname' => '', 'contact' => '', 'general' => '');

        //picking data from the form
        $firstname = $_POST['fname'];
        $surname = $_POST['surname'];
        $contact = $_POST['contact'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
            $tempName = $_FILES["image"]["tmp_name"];
            $folder = "assets/images/users/".$image; 
        }
        $emp_id = $_SESSION['emp_id'];
        

        $firstname = sanitize($firstname);
        //check whether special characters have been used on the name
        if (!preg_match('/^[a-z ]+$/i', $firstname)) {
            $error['firstname'] = "<p style='color:red;'>Please use letters A-Z<p/>";
        }
 
        $surname = sanitize($surname);
        if (!preg_match('/^[a-z ]+$/i', $surname)) {
            $error['surname'] = "<p style='color:red;'>Please use letters A-Z<p/>";
        }

        $contact = sanitize($contact);
        if (is_int($contact)) {
            $error['contact'] = "<p style='color:red;'>Phone number must be digits between 0-9<p/>";
        }
        if (strlen($contact)!=10) {
            $error['contact'] = "<p style='color:red;'>Phone number must be 10 digits<p/>";
        }

        if (array_filter($error)) {
            $error['general'] = "<p style='color:red;'> Please sort out the above error before you can proceed<p/>";
        }else{
            $sql = "UPDATE employee SET fname = '$firstname', surname = '$surname', contact = '$contact', gender = '$gender', DOB = '$dob' WHERE emp_id = $emp_id";
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
	                        <p class="message-alert-none"><strong>Success!</strong> Employee info updated successfully.</p>
	                    </div>
	                </div>';
            } else {
                $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }
        }
    }
?>

<?php 
    $emp_id = $_SESSION['emp_id'];

    $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
    $emp_query = mysqli_query($dbconnect, $emp_sql);
    $employee_data = mysqli_fetch_assoc($emp_query);
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-users" style="color:#1976d2"></i> <?php echo $employee_data['fname']." ".$employee_data['surname'];?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" style="font-size: 14px;">  Personal Info </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" style="font-size: 14px;"> Address </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#education" role="tab" style="font-size: 14px;"> Education</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#experience" role="tab" style="font-size: 14px;"> Experience</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bank" role="tab" style="font-size: 14px;"> Bank Account</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab" style="font-size: 14px;"> Change Password</a> </li>     
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card">
		                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <center class="m-t-30">
                                                       <img src="assets/images/users/<?php if(isset($employee_data['image'])) echo $employee_data['image'];?>" class="img-circle" width="150">
                                                        <h4 class="card-title m-t-10"><?php echo $employee_data['fname']." ".$employee_data['surname'];?></h4>
                                                        <h6 class="card-subtitle">
                                                            <?php 
                                                                $Des = $employee_data['designation'];
                                                                $Des_sql = "SELECT role_name FROM roles WHERE ID = $Des";
                                                                $Des_query = mysqli_query($dbconnect, $Des_sql);
                                                                $Des_name = mysqli_fetch_assoc($Des_query);
                                                                echo $Des_name['role_name'];
                                                            ?>
                                                        </h6>
                                                    </center>
                                                </div>
                                                <div>
                                                    <hr> 
                                                </div>
                                                <div class="card-body"> 
                                                    <small class="text-muted">Email address </small>
                                                    <h6><?php if(isset($employee_data['email'])) echo $employee_data['email'];?></h6> 
                                                    <small class="text-muted p-t-30 db">Phone</small>
                                                    <h6>0<?php if(isset($employee_data['contact'])) echo $employee_data['contact'];?></h6>
                                                </div>
                                            </div>                                                    
                                        </div>
                                        <div class="col-md-8">
			                                <form class="row" action="" method="post" enctype="multipart/form-data">
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>First Name <i style="color: red">*</i></label>
			                                        <input type="text" class="form-control form-control-line" placeholder="Employee's FirstName" name="fname" value="<?php if(isset($employee_data['fname'])) echo $employee_data['fname'];?>" minlength="3" required=""> 
                                                    <?php if (isset($error['fname'])) echo $error['fname'];?>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Last Name <i style="color: red">*</i></label>
			                                        <input type="text" id="" name="surname" class="form-control form-control-line" value="<?php if(isset($employee_data['surname'])) echo $employee_data['surname'];?>" placeholder="Employee's LastName" minlength="3" required=""> 
                                                    <?php if (isset($error['surname'])) echo $error['surname'];?>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Gender <i style="color: red">*</i></label>
			                                        <select name="gender" class="form-control custom-select" required="">
			                                            <option value="">Gender</option>
			                                            <option value="Male" <?php if($employee_data['gender'] == 'Male') echo 'selected';?>>Male</option>
			                                            <option value="Female" <?php if($employee_data['gender'] == 'Female') echo 'selected';?> >Female</option>
			                                        </select>
			                                    </div>                                                   
                                                <div class="form-group col-md-4 m-t-10">
                                                    <label>Status <i style="color: red">*</i></label>
                                                    <input type="text" value="<?php if(isset($employee_data['status']) && $employee_data['status'] == 1) {echo "Active";} else{echo "Inactive"; }?>" readonly="" class="form-control">
                                                </div>			                                    
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Date Of Birth <i style="color: red">*</i></label>
			                                        <input type="date" id="example-email2" name="dob" class="form-control" placeholder="" value="<?php if(isset($employee_data['DOB'])) echo $employee_data['DOB'];?>" required=""> 
                                                    	<?php if (isset($error['dob'])) echo $error['dob'];?>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Contact <i style="color: red">*</i></label>
			                                        <input type="text" class="form-control" placeholder="" name="contact" minlength="10" maxlength="15" required="" value="0<?php if(isset($employee_data['contact'])) echo $employee_data['contact'];?>"> 
                                                    <?php if (isset($error['contact'])) echo $error['contact'];?>
			                                    </div>			                                    
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Department <i style="color: red">*</i></label>
			                                        <?php 
			                                        	if(isset($employee_data['dept_id'])){
			                                        		$dept = $employee_data['dept_id'];
			                                        		$sq_dept = "SELECT * FROM department WHERE ID = $dept";
			                                        		$query_det = mysqli_query($dbconnect, $sq_dept);
			                                        		$det = mysqli_fetch_assoc($query_det);
			                                        	}
			                                        ?>
            				                        <input type="text" class="form-control" value="<?php if(isset($det['dept_name'])) echo $det['dept_name'];?>" readonly="">
			                                    </div>                                                   				                                    
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Role <i style="color: red">*</i></label>
                                                        <?php 
                                                        	$r_id = $employee_data['designation'];
                                                            $r_sql = "SELECT * FROM roles WHERE ID = $r_id ";
                                                            $r_query = mysqli_query($dbconnect, $r_sql);
                                                            $designation = mysqli_fetch_assoc($r_query);
                                                        ?>
                                                    <input type="text" class="form-control" value="<?php if(isset($designation['role_name'])) echo $designation['role_name'];?> " readonly="">
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Date Of Joining <i style="color: red">*</i></label>
			                                        <input type="date" id="example-email2" name="join_date" class="form-control" value="<?php if(isset($employee_data['joining_date'])) echo $employee_data['joining_date'];?>" readonly=""> 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Contract End Date</label>
			                                        <input type="date" id="example-email2" name="cont_end" class="form-control" readonly="" value="<?php if(isset($employee_data['contract_end'])) echo $employee_data['contract_end'];?>" >
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Email <i style="color: red">*</i></label>
			                                        <input type="email" id="example-email2" name="email" readonly="true" class="form-control" title="Email cannot be changed"  placeholder="email@mail.com" minlength="7" required="" value="<?php if(isset($employee_data['email'])) echo $employee_data['email'];?>">
                                                    <?php if (isset($error['email'])) echo $error['email'];?> 
			                                    </div>
			                                    <div class="form-group col-md-12 m-t-10">
                                                    <img src="assets/images/users/<?php echo $employee_data['image'];?>" class="img-circle" width="150">
                                                    <label>Image <i style="color: red">*</i></label>
                                                    <input type="file" name="image" class="form-control" value="<?php if(isset($employee_data['image'])) echo"<img src='assets/images/users/".$employee_data['image'].">"; ?>"> 
                                                </div>
                                                <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php if(isset($employee_data['emp_id'])) echo $employee_data['emp_id']; ?>">
			                                        <button type="submit" name="save" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                        <button type="button" name="cancel" class="btn btn-danger">Cancel</button>
			                                    </div>
                                                <?php 
                                                    if (isset($error['general'])) {
                                                        echo $error['general'];
                                                    }
                                                    if (isset($success)) {
                                                        echo $success;
                                                    }
                                                ?>
			                                </form>
                                        </div>
                                    </div>
			                    </div>
                            </div>
                        </div>
                        <?php
                            if (isset($_POST['save1'])) {
                                $address = $_POST['address'];
                                $city = $_POST['city'];
                                $country = $_POST['country'];
                            
                                $city = sanitize($city);
                                $address = sanitize($address);
                                $country = sanitize($country);
                                $emp_id = sanitize($emp_id);

                                $sql = "SELECT * FROM address WHERE emp_id = $emp_id";
                                $query = mysqli_query($dbconnect, $sql);
                                $row = mysqli_num_rows($query);

                                if ($row > 0) {
                                    $insert = "UPDATE address SET address = '$address', city = '$city', country = '$country' WHERE emp_id = $emp_id";
                                } else{
                                    $insert = "INSERT INTO address (emp_id, city, country, address) VALUES ('$emp_id', '$city', '$country', '$address')";
                                }
                                if ($dbconnect->query($insert) === TRUE) {
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
                                                    <p class="message-alert-none"><strong>Success!</strong> Address updated.</p>
                                                </div>
                                            </div>';
                                }else{
                                    $error1 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                                }

                            }
                        ?>
                        <!--address tab-->
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="card">
		                        <div class="card-body">
	                        		<h3 class="card-title">Address Information</h3>
                                    <?php 
                                        $addr_sql = "SELECT * FROM address WHERE emp_id = $emp_id";
                                        $addr_query = mysqli_query($dbconnect, $addr_sql);
                                        $address = mysqli_fetch_assoc($addr_query);
                                    ?>
                                    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="" width="100%">
                                    	<thead>
                                    		<th>Address</th>
                                    		<th>City</th>
                                    		<th>Country</th>
                                    	</thead>
                                    	<tbody>
                                    		<tr>
                                    			<td><?php if(isset($address['address'])) echo $address['address']; ?></td>
                                    			<td><?php if(isset($address['city'])) echo $address['city']; ?></td>
                                    			<td><?php if(isset($address['country'])) echo $address['country']; ?></td>
                                    		</tr>
                                    	</tbody>
                                    </table>
	                                <form class="row" action="" method="post" enctype="multipart/form-data">
	                                    <div class="form-group col-md-12 m-t-5">
	                                        <label>Address </label>
	                                        <input type="textarea" name="address" value="<?php if(isset($address['address'])) echo $address['address'];?>" class="form-control" rows="3" minlength="7" required="" placeholder="P.O BOX 393-01100">
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>City</label>
	                                        <input type="text" name="city" class="form-control form-control-line" placeholder="Nairobi" value="<?php if(isset($address['city'])) echo $address['city'];?>" minlength="2" required=""> 
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Country</label>
	                                        <input type="text" name="country" class="form-control form-control-line" placeholder="Kenya" value="<?php if(isset($address['country'])) echo $address['country'];?>" minlength="2" required=""> 
	                                    </div> 			                                    
	                                    <div class="form-actions col-md-12">
                                            <input type="hidden" name=" " value=" ">
                                            <input type="hidden" name="id" value=" ">                                                    
	                                        <button type="submit" name="save1" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
	                                    </div>	
                                        <?php 
                                            if (isset($success1)): 
                                               echo $success1 ;
                                            endif;

                                            if (isset($error1)):
                                                echo $error1;
                                            endif;
                                        ?>	                                    
                                    </form>  
		                        </div>
                            </div>
                        </div>
                        <?php 
                            if (isset($_POST['save2'])) {
                                $edu_level = $_POST['edu_level'];
                                $institution = $_POST['institution'];
                                $course = $_POST['course'];
                                $accreditation = $_POST['accreditation'];
                                $year = $_POST['year'];
                                $success2 = $error2 = '';
                                
                                $sql = "INSERT INTO education (emp_id, edu_level, institution, Course, accreditation, year) VALUES ('$emp_id','$edu_level', '$institution',  '$course','$accreditation', '$year')";
                                if ($dbconnect->query($sql) === TRUE) {
                                    $success2 = '
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <link rel="stylesheet" href="css/alerts.css">
                                            <div class="alert-title">
                                            </div>
                                            <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                                <p class="message-alert-none"><strong>Success!</strong> Education info updated successfully.</p>
                                            </div>
                                        </div>';
                                }else{
                                    $error2 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                                }
                            }
                        ?>

                        <!--Education panel-->
                        <div class="tab-pane" id="education" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Education level</th>
                                                    <th>Institution </th>
                                                    <th>Course</th>
                                                    <th>Accreditation </th>
                                                    <th>Year</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $educ_sql = "SELECT * FROM education WHERE emp_id = $emp_id";
                                                $edu_query = mysqli_query($dbconnect, $educ_sql);
                                                $education = mysqli_fetch_all($edu_query, MYSQLI_ASSOC);
                                                $n = 0; 

                                                foreach ($education as $edu){ 
                                                    $n = $n + 1;
                                            ?>
                                            <tbody>
                                                <td><?php echo $n; ?></td>
                                                <td><?php if(isset($edu['edu_level'])) echo $edu['edu_level'];?></td>
                                                <td><?php if(isset($edu['institution'])) echo $edu['institution'];?></td>
                                                <td><?php if(isset($edu['Course'])) echo $edu['Course'];?></td>
                                                <td><?php if(isset($edu['accreditation'])) echo $edu['accreditation'];?></td>
                                                <td><?php if(isset($edu['year'])) echo $edu['year'];?></td>
                                                <td>
                                                    <input type="hidden" name="delete" value="<?php echo $emp_id; ?>">
                                                    <a href="" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button type="submit" name="drop" onclick="return confirm('Are you sure to delete this data?')" href="" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tbody>
                                            <?php 
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>                                    
                            </div>
                            <div class="card">
                                <div class="card-body">
	                                <form class="row" action="" method="post" enctype="multipart/form-data" id="insert_education">
	                                	<span id="error"></span>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Education Level <i style="color:red">*</i></label><br/>
	                                        <select name="edu_level" class="form-group custom-select" required="" style="width: 100%;">
                                                <option value=""> </option>
                                                <option value="certificate">Certificate</option>
                                                <option value="diploma">Diploma</option> 
                                                <option value="higher diploma">Higher Diploma</option>
                                                <option value="bachelors degree">Bachelor's Degree</option> 
                                                <option value="masters">Masters</option> 
                                                <option value="phd">Phd</option>
                                                <option value="certifications">Certifications</option>
                                            </select>
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Institution <i style="color:red">*</i></label>
	                                        <input type="text" name="institution" class="form-control form-control-line" placeholder="College name" minlength="3" required=""> 
	                                    </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Course <i style="color:red">*</i></label>
                                            <input type="text" name="course" class="form-control form-control-line" placeholder="BSc. Software engineering" minlength="3" required=""> 
                                        </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Accreditation <i style="color:red">*</i></label> <br/>
	                                        <select name="accreditation" class="form-group custom-select" required="" style="width: 100%;">
                                                <option value=""> </option>
                                                <option value="first class">First Class Honours</option>
                                                <option value="second class upper">Second Class Upper</option> 
                                                <option value="second class lower">Second Class Lower</option>
                                                <option value="pass">Pass</option> 
                                                <option value="credit">Credit</option> 
                                                <option value="Distinction">Distinction</option>
                                            </select>
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Year completed <i style="color:red">*</i></label>
	                                        <input type="text" name="year" class="form-control form-control-line" placeholder="Year"> 
	                                    </div>
                                        <div class="form-group col-md-6 m-t-5"></div>
	                                  	<div class="form-actions col-md-6">
                                            <input type="hidden" name="emid" value="Soy1332">
	                                        <button name="save2" type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
	                                    </div>
                                        <?php 
                                            if (isset($success2)): 
                                               echo $success2 ;
                                            endif;

                                            if (isset($error2)):
                                                echo $error2;
                                            endif;
                                        ?>  
	                                </form>
			                    </div>
                            </div>
                        </div>
                        <?php 
                            if (isset($_POST['save3'])) {
                                $company_name = $_POST['company'];
                                $position = $_POST['position'];
                                $working_period = $_POST['working_period'];

                                $sql = "INSERT INTO experience (emp_id, company_name, position, working_period) VALUES ('$emp_id','$company_name', '$position', '$working_period')";
                                if ($dbconnect->query($sql) === TRUE) {
                                    $success3 = '
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <link rel="stylesheet" href="css/alerts.css">
                                            <div class="alert-title">
                                            </div>
                                            <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                                <p class="message-alert-none"><strong>Success!</strong> Experience info updated successfully.</p>
                                            </div>
                                        </div>';
                                }else{
                                    $error3 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                                }
                            }
                        ?>
                        <!--experience -->
                        <div class="tab-pane" id="experience" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company name</th>
                                                    <th>Position </th>
                                                    <th>Work Duration </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $exp_sql = "SELECT * FROM experience WHERE emp_id = $emp_id";
                                                $exp_query = mysqli_query($dbconnect, $exp_sql);
                                                $experience = mysqli_fetch_all($exp_query, MYSQLI_ASSOC);
                                                $n = 0;

                                                foreach ($experience as $exp){ 
                                                    $n = $n + 1;
                                            ?>
                                            <tbody>
                                                <td><?php echo $n;?></td>
                                                <td><?php if(isset($exp['company_name'])) echo $exp['company_name'];?></td>
                                                <td><?php if(isset($exp['position'])) echo $exp['position'];?></td>
                                                <td><?php if(isset($exp['working_period'])) echo $exp['working_period'];?></td>
                                                <td>
                                                    <input type="hidden" name="delete" value="<?php echo $emp_id; ?>">
                                                    <a href="" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button type="submit" name="drop" onclick="return confirm('Are you sure to delete this data?')" href="" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tbody>
                                            <?php 
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>                                     
                                <div class="card-body">
	                                <form class="row" action="" method="post" enctype="multipart/form-data">
                                    	<div class="form-group col-md-6 m-t-5">
                                    	    <label> Company Name<i style="color:red">*</i></label>
                                    	    <input type="text" name="company" class="form-control form-control-line company_name" placeholder="Company Name" minlength="2" required=""> 
                                    	</div>
                                    	<div class="form-group col-md-6 m-t-5">
                                    	    <label>Position<i style="color:red">*</i></label>
                                    	    <input type="text" name="position" class="form-control form-control-line position_name" placeholder="Position" minlength="3" required=""> 
                                    	</div>
                                    	<div class="form-group col-md-6 m-t-5">
                                    	    <label>Address<i style="color:red">*</i></label>
                                    	    <input type="text" name="address" class="form-control form-control-line duty" placeholder="Address" minlength="7" required=""> 
                                    	</div>
                                    	<div class="form-group col-md-6 m-t-5">
                                    	    <label>Working Duration (years)<i style="color:red">*</i></label>
                                    	    <input type="text" name="working_period" class="form-control form-control-line working_period" placeholder="Working Duration" required=""> 
                                    	</div>
                                 		<div class="form-actions col-md-12">
                                            <input type="hidden" name="emid" value="Soy1332">                                                
                                    	    <button type="submit" name="save3" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    	</div>
                                        <?php 
                                            if (isset($success3)): 
                                               echo $success3;
                                            endif;

                                            if (isset($error3)):
                                                echo $error3;
                                            endif;
                                        ?>
                                    </form>
			                    </div>
                            </div>
                        </div>
                        <?php 
                            if (isset($_POST['save4'])) {
                                $bank = $_POST['bank'];
                                $branch = $_POST['branch'];
                                $account_name = $_POST['account_name'];
                                $account_number = $_POST['account_number'];

                                $sql = "SELECT * FROM bank_info WHERE emp_id = $emp_id";
                                $query = mysqli_query($dbconnect, $sql);
                                $row = mysqli_num_rows($query);

                                if ($row > 0) {
                                    $insert = "UPDATE bank_info SET holder_name = '$account_name', bank_name = '$bank', branch_name = '$branch', account_number = '$account_number' WHERE emp_id = $emp_id";
                                } else{
                                    $insert = "INSERT INTO bank_info (emp_id, holder_name, bank_name, branch_name, account_number) VALUES ('$emp_id', '$account_name', '$bank', '$branch', '$account_number')";
                                }
                                if ($dbconnect->query($insert) === TRUE) {
                                    $success4 = '
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <link rel="stylesheet" href="css/alerts.css">
                                                <div class="alert-title">
                                                </div>
                                                <div class="alert alert-success alert-success-style1 alert-success-stylenone">
                                                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                            <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                    </button>
                                                    <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
                                                    <p class="message-alert-none"><strong>Success!</strong> Successfully updated Bank info.</p>
                                                </div>
                                            </div>';
                                }else{
                                    $error4 = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                                }

                            }

                        ?>
                        <!--Bank info-->
                        <div class="tab-pane" id="bank" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th># </th>
                                                    <th>Holder name</th>
                                                    <th>Account Number </th>
                                                    <th>Bank </th>
                                                    <th>Branch</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                               <?php
                                                    $bank_sql = "SELECT * FROM bank_info WHERE emp_id = $emp_id";
                                                    $bank_query = mysqli_query($dbconnect, $bank_sql);
                                                    $details = mysqli_fetch_all($bank_query, MYSQLI_ASSOC);
                                                    $n = 0;

                                                    foreach ($details as $info){ 
                                                        $n = $n + 1;
                                                ?>
                                            <tbody>
                                                <td><?php echo $n;?></td>
                                                <td><?php if(isset($info['holder_name'])){ echo $info['holder_name'];}?></td>
                                                <td><?php if(isset($info['account_number'])) echo $info['account_number'];?></td>
                                                <td><?php if(isset($info['bank_name'])) echo $info['bank_name'];?></td>
                                                <td><?php if(isset($info['branch_name'])) echo $info['branch_name']; ?></td>
                                                <td>
                                                    <input type="hidden" name="delete" value="<?php echo $emp_id; ?>">
                                                    <a href="" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button type="submit" name="drop" onclick="return confirm('Are you sure to delete this data?')" href="" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tbody>
                                                <?php 
                                                    }
                                                ?>
                                        </table>
                                    </div>
                                </div> 
                                <div class="card-body">
	                                <form class="row" action="" method="post" enctype="multipart/form-data">
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label> Bank Name <i style="color: red">*</i></label>
	                                        <select style="width: 100%" class="form-control custom-select" name="bank">
                                                <option value=""></option>
                                                <option value="Equity Bank">Equity Bank</option>
                                                <option value="KCB Bank">KCB Bank</option>
                                                <option value="DTB Bank">DTB Bank</option>
                                                <option value="NCBA">NCBA</option>
                                                <option value="Absa Bank">Absa Bank</option>
                                                <option value="Safaricom">Safaricom Global Pay</option>
                                            </select>
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Branch <i style="color: red">*</i></label>
	                                        <input type="text" name="branch" value="<?php if(isset($branch)) echo $branch; ?>" class="form-control form-control-line" placeholder="Nairobi west" minlength="5" required=""> 
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Account holder's name <i style="color: red">*</i></label>
	                                        <input type="text" name="account_name" value="<?php if(isset($account_name)) echo $account_name; ?>" class="form-control form-control-line" placeholder="Lemashon Lasiti" required> 
	                                    </div>
	                                    <div class="form-group col-md-6 m-t-5">
	                                        <label>Account Number <i style="color: red">*</i></label>
	                                        <input type="text" name="account_number" value="<?php if(isset($account_number)) echo $account_number; ?>" placeholder="128097781254" class="form-control form-control-line" minlength="5" required=""> 
	                                    </div>
	                                    <div class="form-actions col-md-12">
                                            <input type="hidden" name="emid" value="">
	                                        <button type="submit" name="save4" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
	                                    </div>
	                                </form>
                                    <?php 
                                        if (isset($success4)): 
                                           echo $success4;
                                        endif;

                                        if (isset($error4)):
                                            echo $error4;
                                        endif;
                                    ?>
			                    </div>
                            </div>
                        </div>

                        <?php 
							if (isset($_POST['save5'])) {
								$old_password = $new_password = $confirm_password = $success5 = '';
								$error5 = array('old' => '', 'new1' => '', 'general' => '');

								$old_password = $_POST['old'];
								$new_password = $_POST['new1'];
								$confirm_password = $_POST['new2']; 

								if (empty($old_password)){
									$error5['old_password'] = "<p style='color:red'>Fill old password <p/>";
								}else{
									$old_password = sanitize($old_password);
									$old_password = crypt($old_password, 'Mashon_89');

									$sql5 = "SELECT * FROM employee WHERE emp_id = $emp_id";
									$sql_query = mysqli_query($dbconnect, $sql5);
									$result = mysqli_fetch_assoc($sql_query);
									$pass_from_db = $result['password'];

									if ($old_password != $pass_from_db) {
										$error5['old_password'] = "<p style='color:red'>Incorrect password try again!<p/>";
									}
								}

								if (empty($new_password || $confirm_password)) {
						            $error5['new_password'] = "<p style='color:red;'>Please fill new password<p/>";
						        }else{
						            $new_password = sanitize($new_password);
						            $confirm_password = sanitize($confirm_password);

						            if (strlen($new_password) < 8) {
						                $error5['new_password'] = "<p style='color:red;'>Password is too short!<p/>";
						            }
						            if ( ! preg_match("#[0-9]+#", $new_password)) {
						                $error5['new_password'] = "<p style='color:red;'>Password must include at least one number<p/>!";
						            }
						            if (!preg_match("#[a-zA-Z]+#", $new_password)) {
						                $error5['new_password'] = "<p style='color:red;'>Password must include at least alphabets!<p/>";
						            }

						            //Confirm passwords if they match
						            if ($new_password != $confirm_password) {
						                $error5['new_password'] = "<p style='color:red'>The passwords do not match! please check again<p/>";
						            } else{
						            	//Encrypt passwords 
							            $new_password = crypt($new_password, 'Mashon_89');
							            $confirm_password = crypt($confirm_password, 'Mashon_89');
						            }
								}
								if (array_filter($error5)) {
									 $error5['general'] = "
						                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						                    <link rel='stylesheet' href='css/alerts.css'>
						                    <div class='alert-title'>
						                    </div>
						                    <div class='alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone'>
						                        <button type='button' class='close sucess-op' data-dismiss='alert' aria-label='Close'>
						                                <span class='icon-sc-cl' aria-hidden='true'>&times;</span>
						                        </button>
						                        <i class='fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-none' aria-hidden='true'></i>
						                        <p class='message-alert-none'><strong>Danger!</strong> Sort out the above errors.</p>
						                    </div>
						                </div>
						            ";
								} else{
									$sql = "UPDATE employee SET password = '$new_password' WHERE emp_id = '$emp_id'";

									if ($dbconnect->query($sql) === TRUE) {
						               $success5 = '
						                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                    <link rel="stylesheet" href="css/alerts.css">
						                    <div class="alert-title">
						                    </div>
						                    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
						                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
						                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
						                        </button>
						                        <i class="fa fa-check adminpro-checked-pro admin-check-sucess admin-check-pro-none" aria-hidden="true"></i>
						                        <p class="message-alert-none"><strong>Success!</strong>You have successfully reset your password</p>
						                    </div>
						                </div>';
						            }else{
						                $error5['general'] = "
						                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12'>
						                    <link rel='stylesheet' href='css/alerts.css'>
						                    <div class='alert-title'>
						                    </div>
						                    <div class='alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone'>
						                        <button type='button' class='close sucess-op' data-dismiss='alert' aria-label='Close'>
						                                <span class='icon-sc-cl' aria-hidden='true'>&times;</span>
						                        </button>
						                        <i class='fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-none' aria-hidden='true'></i>
						                        <p class='message-alert-none'><strong>Danger!</strong> Pottentionally dangerous action! ".$dbconnect->error."</p>
						                    </div>
						                </div>
						                <br/>";

						            }
								}
							}
						?>
                        <div class="tab-pane" id="password" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                <form class="row" action="" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Old Password</label>
                                        <input type="text" class="form-control" name="old" value="" placeholder="old password" required="" minlength="6"> 
                                        <?php if (isset($error5['old_password'])) { echo $error5['old_password'];  }?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="new1" value="" required="" minlength="6"> 
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Confirm Password</label>
                                        <input type="text" id="" name="new2" class="form-control " required="" minlength="6"> 
                                        <?php if (isset($error5['new_password'])) { echo $error5['new_password'];  }?>
                                    </div>
                                    <div class="form-actions col-md-12">
                                    <input type="hidden" name="emid" value="Mas1016">                                                   
                                        <button type="submit" class="btn btn-success pull-right" name="save5"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>
                    <?php 
						if (isset($success5)) {
							echo $success5;
						}
						if (isset($error5['general'])){
							echo $error5['general'];
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