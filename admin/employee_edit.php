<?php
    require('includes/header.php');
 
    if (isset($_POST['save'])){

        //creating variables to hold form data
        $firstname = $surname = $email = $contact =  $image = $tempName = $folder = $dob = $dept = $deg = $role = $status = $gender = $join_date = $cont_end = '';
        $success = '';
        $error = array('firstname' => '', 'image' =>'', 'surname' => '', 'contact' => '', 'email' => '', 'general' => '');

        //picking data from the form
        $firstname = $_POST['fname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $status = $_POST['status'];
        $dob = $_POST['dob'];
        $dept = $_POST['dept'];
        $deg = $_POST['deg'];
        $role = $_POST['role'];
        $gender = $_POST['gender'];
        $join_date = $_POST['join_date'];
        $cont_end = $_POST['cont_end'];

        $emp_id = $_GET['emp_id'];

        if (isset($_FILES["image"]) && $_FILES['image']['error'] == 0) {
            $image = $_FILES["image"]["name"];
            $tempName = $_FILES["image"]["tmp_name"];
            $folder = "assets/images/users/".$image;

            $image_sql =  "UPDATE employee SET image = '$image' WHERE emp_id = $emp_id";
            if ($dbconnect->query($image_sql)) {
                $success_image = "<p style='color:green'>Successfully updated image</p>";
            } else {
                $error['image'] = "<p style='color:red;'>Image Error:".$dbconnect->error."<p/>";
            }
        }
        
        //Validating data
        //checking if first name has been filled
        if (empty($firstname)) {
            $error['firstname'] = "<p style='color:red;'>Please enter your first name<p/>";
        }else{
            //prevent cross site scripting
            $firstname = sanitize($firstname);

            //check whether special characters have been used on the name
            if (!preg_match('/^[a-z ]+$/i', $firstname)) {
                $error['firstname'] = "<p style='color:red;'>Please use letters A-Z<p/>";
            }
        }

        //checking if surname has been filled
        if (empty($surname)) {
            $error['surname'] = "<p style='color:red;'>Please enter your surname<p/>";
        }else{
            //prevent cross site scripting
            $surname = sanitize($surname);

            //check whether special characters have been used on the name
            if (!preg_match('/^[a-z ]+$/i', $surname)) {
                $error['surname'] = "<p style='color:red;'>Please use letters A-Z<p/>";
            }
        }

        //checking if phone number has been filled
        if (empty($contact)) {
            $error['contact'] = "<p style='color:red;'>Please enter your phone number<p/>";
        }else{
            //prevent cross site scripting
            $contact = sanitize($contact);

            //check whether it's a phone number
            if (is_int($contact)) {
                $error['contact'] = "<p style='color:red;'>Phone number must be digits between 0-9<p/>";
            }
            if (strlen($contact)!=10) {
                $error['contact'] = "<p style='color:red;'>Phone number must be 10 digits<p/>";
            }
        }

        if (array_filter($error)) {
            $error['general'] = "<p style='color:red;'> Please sort out the above error before you can proceed<p/>";
        }else{
           //Sql statements to INSERT data to the tables
            $sql = "UPDATE employee SET fname = '$firstname', surname = '$surname', contact = '$contact', gender = '$gender',  role = '$role', designation = '$deg', status = '$status',  joining_date = '$join_date', contract_end = '$cont_end', DOB = '$dob', dept_id = '$dept' WHERE emp_id = $emp_id";

           //Sql statement using the query() function
           //checking whether the data is saved using the if statement
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
            }else{
                $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }

        }
    }
?>

<?php 
    $emp_id = $_GET['emp_id'];

    $emp_sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
    $emp_query = mysqli_query($dbconnect, $emp_sql);
    $employee_data = mysqli_fetch_assoc($emp_query);
?>
<div class="page-wrapper" style="min-height: 785px;">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-user-o" style="color:#1976d2"></i> <?php echo $employee_data['fname']." ".$employee_data['surname'];?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Employee</li>
                <li class="breadcrumb-item active">Employee edit</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" style="font-size: 14px;"> Personal Info </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" style="font-size: 14px;"> Address </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#education" role="tab" style="font-size: 14px;"> Education</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#experience" role="tab" style="font-size: 14px;"> Experience</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bank" role="tab" style="font-size: 14px;"> Bank Account</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#salary" role="tab" style="font-size: 14px;"> Salary</a> </li>     
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
                                                                if(isset($Des_name['role_name'])) echo $Des_name['role_name'];
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
			                                        <label>Employee ID <i style="color: red">*</i></label>
			                                        <input type="text" class="form-control form-control-line" placeholder="ID" name="eid" value="<?php if(isset($employee_data['emp_id'])) echo $employee_data['emp_id'];?>" required="" readonly="true"> 
			                                    </div>
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
                                                    <label>Employee Type <i style="color: red">*</i></label>
                                                    <select name="role" class="form-control custom-select" required="">
                                                        <option value=""> </option>
                                                        <option value="ADMIN" <?php if(isset($employee_data['role']) && $employee_data['role'] == 'ADMIN') echo 'selected';?>>Admin</option>
                                                        <option value="Employee" <?php if(isset($employee_data['role']) && $employee_data['role'] == 'Employee') echo 'selected';?>>Employee</option>
                                                        <option value="Former" <?php if(isset($employee_data['role']) && $employee_data['role'] == 'Former') echo 'selected';?>>Former</option>
                                                    </select>
                                                </div>                                                     
                                                <div class="form-group col-md-4 m-t-10">
                                                    <label>Status <i style="color: red">*</i></label>
                                                    <select name="status" class="form-control custom-select" required="">
			                                            <option value=""> </option>
                                                        <option value="1" <?php if(isset($employee_data['status']) && $employee_data['status'] == '1') echo 'selected';?>>ACTIVE</option>
                                                        <option value="0" <?php if(isset($employee_data['status']) && $employee_data['status'] == '0') echo 'selected';?>>INACTIVE</option>
                                                    </select>
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
			                                        <select name="dept" id="dept-id" class="form-control custom-select">
                                                        <option>Select Department</option>
                                                        <?php 
                                                            $sql = "SELECT * FROM department";
                                                            $query = mysqli_query($dbconnect, $sql);
                                                            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                                            foreach ($result as $dep){
                                                        ?>
                                                        <option value="<?php if(isset($dep['ID'])) echo $dep['ID'] ;?>" <?php if(isset($employee_data['dept_id']) && $employee_data['dept_id'] == $dep['ID']) echo 'selected';?> ><?php echo $dep['dept_name'];?></option>
                                                        <?php
                                                            }
                                                        ?>
            				                        </select>
			                                    </div>                                                   				                                    
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Role <i style="color: red">*</i></label>
                                                    <select name="deg" class="form-control custom-select" id="role" required="">
                                                        <option>Select Role</option>
                                                        
                                                    </select>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Date Of Joining <i style="color: red">*</i></label>
			                                        <input type="date" id="example-email2" name="join_date" class="form-control" value="<?php if(isset($employee_data['joining_date'])) echo $employee_data['joining_date'];?>" placeholder=""> 
                                                    <?php if (isset($error['joining_date'])) echo $error['joining_date'];?>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Contract End Date</label>
			                                        <input type="date" id="example-email2" name="cont_end" class="form-control"  placeholder="" value="<?php if(isset($employee_data['contract_end'])) echo $employee_data['contract_end'];?>" > 
                                                    <?php if (isset($error['contract_end'])) echo $error['contract_end'];?>
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Email <i style="color: red">*</i></label>
			                                        <input type="email" id="example-email2" name="email" readonly="true" class="form-control" title="Email cannot be changed"  placeholder="email@mail.com" minlength="7" required="" value="<?php if(isset($employee_data['email'])) echo $employee_data['email'];?>">
                                                    <?php if (isset($error['email'])) echo $error['email'];?> 
			                                    </div>
			                                    <div class="form-group col-md-12 m-t-10">
                                                    <img src="assets/images/users/<?php echo $employee_data['image'];?>" class="img-circle" width="150">
                                                    <label>Image <i style="color: red">*</i></label>
                                                    <input type="file" name="image" class="form-control"> 
                                                    <?php if (isset($error['image'])) echo $error['image'];?>
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
                                                    if (isset($success_image)) {
                                                        echo $success_image;
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
                                                    <th>No.</th>
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
                        <!--experiemce -->
                        <div class="tab-pane" id="experience" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
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
                                                    <th>No. </th>
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
                                $basic = $net_salary = $house = $medical = $commute = $loan = $net = $paye = '';
                                $sucess5 = '';
                                $error5 = array('general' => '' , 'net' => ''); 

                                $emp_id = $_GET['emp_id'];

                                if (isset($_POST['net'])) {
                                    $basic = $_POST['basic'];
                                    $net_salary = $_POST['net'];
                                    $house = $_POST['house'];
                                    $medical = $_POST['medical'];
                                    $commute = $_POST['commute']; 
                                    $net = $_POST['net'];
                                    $paye = $_POST['paye'];
                                    $nssf = $_POST['nssf'];
                                    $nhif = $_POST['nhif'];

                                    $deductions = $paye + $nssf + $nhif;
                                } else {
                                    $error5['net'] = "<p style='color:red'> Calculate the deductions</p>";
                                }
                                if (array_filter($error5)) {
                                    $error5['general'] = "<p style='color:red'> Sort out the above errors!</p>";
                                } else {
                                    $sql = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
                                    $query = mysqli_query($dbconnect, $sql);
                                    $rowl = mysqli_num_rows($query);

                                    if ($rowl > 0) {
                                        $sql = "UPDATE emp_salary SET basic_salary = '$basic', medical_allowance = '$medical', house_allowance = '$house', commute_allowance = '$commute', total = '$net', deductions = '$deductions' WHERE emp_id = $emp_id";
                                    } else {
                                        $sql = "INSERT INTO emp_salary (emp_id, basic_salary, medical_allowance, house_allowance, commute_allowance, loan, total, deductions) VALUES ('$emp_id', '$basic', '$medical', '$house', '$commute', 0, '$net', '$deductions')";
                                    }
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
                                                        <p class="message-alert-none"><strong>Success!</strong> Successfully updated salary</p>
                                                    </div>
                                                </div>';
                                    } else {
                                        $error5['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
                                    }
                                    
                                }
                            }
                        ?>
                        <!--Salary panel-->
                        <div class="tab-pane" id="salary" role="tabpanel">
                            <div class="card">
		                        <div class="card-body">
	                        		<h3 class="card-title">Basic Salary </h3>
	                                <form action=" " method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php 
                                                $sal = "SELECT * FROM emp_salary WHERE emp_id = $emp_id";
                                                $sal_query = mysqli_query($dbconnect, $sal);
                                                $salaries = mysqli_fetch_assoc($sal_query);
                                            ?>
                                            <div class="form-group col-md-6 m-t-5">
                                                <label class="control-label">Basic Salary <i style="color:red">*</i></label>
                                                <select class="form-control  custom-select" id="basic1" data-placeholder="Choose a Category" tabindex="1" name="basic" required="">
                                                    <option>Basic</option>
                                                    <?php 
                                                        $basic_sql = "SELECT * FROM salary ORDER BY basic_salary ASC";
                                                        $basic_query = mysqli_query($dbconnect, $basic_sql);
                                                        $salary = mysqli_fetch_all($basic_query, MYSQLI_ASSOC);

                                                        foreach ($salary as $basic){
                                                    ?>
                                                    <option value="<?php echo $basic['basic_salary'];?>" <?php if(isset($salaries['basic_salary']) && $salaries['basic_salary'] == $basic['basic_salary']) echo 'selected';?> ><?php echo $basic['basic_salary'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div> 
                                        </div>    
                                        <h3 class="card-title">Allowances</h3>
                                        <div class="row">
                                            <div class="form-group col-md-6 m-t-5">
    	                                        <label>House Allowance <i style="color:red">*</i></label>
    	                                        <select class="form-control  custom-select" id="house1" data-placeholder="Choose a Category" tabindex="1" name="house" required="">
                                                    <option>House allowance</option>
                                                    <?php 
                                                        $s_sql = "SELECT * FROM salary ORDER BY house_allowance ASC";
                                                        $s_query = mysqli_query($dbconnect, $s_sql);
                                                        $salary = mysqli_fetch_all($s_query, MYSQLI_ASSOC);
                                                        foreach ($salary as $house){
                                                    ?>
                                                    <option value="<?php echo $house['house_allowance'];?>" <?php if(isset($salaries['house_allowance']) && $salaries['house_allowance'] == $house['house_allowance']) echo 'selected';?> ><?php echo $house['house_allowance'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
    	                                    </div> 
    	                                    <div class="form-group col-md-6 m-t-5">
    	                                        <label>Commutance Allowance <i style="color:red">*</i></label>
    	                                        <select class="form-control  custom-select" id="commutance1" data-placeholder="Choose a Category" tabindex="1" name="commute" required="">
                                                    <option>Commutance allowance</option>
                                                    <?php 
                                                        $s_sql = "SELECT * FROM salary ORDER BY commute_allowance ASC";
                                                        $s_query = mysqli_query($dbconnect, $s_sql);
                                                        $salary = mysqli_fetch_all($s_query, MYSQLI_ASSOC);

                                                        foreach ($salary as $commute){
                                                    ?>
                                                    <option value="<?php echo $commute['commute_allowance'];?>" <?php if(isset($salaries['commute_allowance']) && $salaries['commute_allowance'] == $commute['commute_allowance']) echo 'selected';?> ><?php echo $commute['commute_allowance'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select> 
    	                                    </div> 
    	                                    <div class="form-group col-md-6 m-t-5">
    	                                        <label>Medical Allowance <i style="color:red">*</i></label>
    	                                        <select class="form-control  custom-select" id="medical1" data-placeholder="Choose a Category" tabindex="1" name="medical" required="">
                                                    <option>Medical allowance</option>
                                                    <?php
                                                        $s_sql = "SELECT * FROM salary ORDER BY medical_allowance ASC";
                                                        $s_query = mysqli_query($dbconnect, $s_sql);
                                                        $salary = mysqli_fetch_all($s_query, MYSQLI_ASSOC);

                                                        foreach ($salary as $medical){
                                                    ?>
                                                    <option value="<?php echo $medical['medical_allowance'];?>" <?php if(isset($salaries['medical_allowance']) && $salaries['medical_allowance'] == $medical['medical_allowance']) echo 'selected';?> ><?php echo $medical['medical_allowance'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select> 
    	                                    </div> 
                                        </div>
                                        <h3 class="card-title">Gross income</h3>
                                        <div class="row">
                                            <div class="form-group col-md-6 m-t-5">
                                                <label>Gross Income <i style="color:red">*</i></label>
                                                <input type="text" name="gross" id="gross1" class="form-control form-control-line" placeholder="Gross" readonly="true"> 
                                            </div>
                                        </div>
                                        <h3 class="card-title">Deductions</h3>
                                        <div class="row">
    	                                    <div class="form-group col-md-6 m-t-5">
    	                                        <label>PAYE Tax <i style="color:red">*</i></label>
    	                                        <input type="text" name="paye" id="paye1" class="form-control form-control-line" placeholder="PAYE" readonly="true"> 
    	                                    </div>
    	                                    <div class="form-group col-md-6 m-t-5">
    	                                        <label>NSSF <i style="color:red">*</i></label>
    	                                        <input type="text" name="nssf" id="nssf1" class="form-control form-control-line" placeholder="NSSF" value="200" readonly="true">
    	                                    </div>
    	                                    <div class="form-group col-md-6 m-t-5">
    	                                        <label>NHIF <i style="color:red">*</i></label>
    	                                        <input type="text" name="nhif" id="nhif1" class="form-control form-control-line" placeholder="NHIF" required="" readonly="true">
    	                                    </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 m-t-5">
                                                <label>Net Income <i style="color:red">*</i></label>
                                                <input type="text" name="net" id="net1" class="form-control form-control-line total" placeholder="Net income" required="" readonly="true"> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">                                            
                                                <button type="submit" name="save5" style="float: right" class="btn btn-success">Add Salary</button>
                                            </div>
                                        </div>                                                		                                    
	                                </form>
		                        </div>
                                <?php 
                                    if (isset($success5)): 
                                       echo $success5;
                                    endif;

                                    if (isset($error5['net'])):
                                        echo $error5['net'];
                                    endif;

                                    if (isset($error5['general'])):
                                        echo $error5['general'];
                                    endif;
                                ?>
                            </div>
                        </div>                               
                    </div>
                </div>
            </div>
        </div>            
    </div>
</div>

<script type="text/javascript">
    document.getElementById('medical1').addEventListener("change", calculate);
    document.getElementById('basic1').addEventListener("change", calculate);
    document.getElementById('house1').addEventListener("change", calculate);
    document.getElementById('commutance1').addEventListener("change", calculate);
    function calculate(){ 
        var basic = parseInt(document.getElementById('basic1').value);
        var medical = parseInt(document.getElementById('medical1').value);
        var house = parseInt(document.getElementById('house1').value);
        var commute = parseInt(document.getElementById('commutance1').value);
        var nssf = parseInt(document.getElementById('nssf1').value);

        document.getElementById('gross1').value = basic + medical + house + commute ;
        document.getElementById('paye1').value = parseInt(document.getElementById('gross1').value) * 0.16; 
        document.getElementById('nhif1').value = parseInt(document.getElementById('gross1').value) * 0.034;
        document.getElementById('net1').value = parseInt(document.getElementById('gross1').value) - parseInt(document.getElementById('paye1').value) - parseInt(document.getElementById('nhif1').value) - parseInt(document.getElementById('nssf1').value);  
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Listen for changes on the department select input
        $('#dept-id').on('change', function() {
            var departmentId = $(this).val(); // Get the selected department ID
            var roleSelect = $('#role'); // Get the role select input
            roleSelect.empty(); // Remove any existing options

            // If a department is selected, retrieve the roles for that department from the database
            if (departmentId) {
                $.ajax({
                    url: 'Ajax/get_roles.php',
                    type: 'GET',
                    data: { department_id: departmentId },
                    success: function(data) {
                        // Generate an option for each role
                        $.each(data, function(index, role) {
                            roleSelect.append($('<option></option>').attr('value', role.ID).text(role.role_name));
                        });
                    }
                });
            } else {
                roleSelect.append($('<option></option>').attr('value', '').text('Select a role'));
            }
        });
    });
</script>

<?php require('includes/footer.php');?>

      



