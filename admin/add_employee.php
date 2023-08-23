<?php 
    require('includes/header.php');

     //checkimg if the sign up button has been clicked
    if (isset($_POST['save'])){

        //creating variables to hold form data
        $firstname = $surname = $email = $contact =  $image = $tempName = $folder = $dob = $dept = $deg = $role = $gender = $join_date = $cont_end = '';
        $password =$password1 = 0;
        $success = '';

        $error = array('firstname' => '', 'surname' => '', 'contact' => '', 'image' => '', 'email' => '', 'password' => '', 'password1' => '', 'general' => '');

        //picking data from the form
        $firstname = $_POST['fname']; 
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $contact = $_POST['contact'];
        $dob = $_POST['dob'];
        $dept = $_POST['dept'];
        $deg = $_POST['deg'];
        $role = $_POST['role'];
        $gender = $_POST['gender'];
        $join_date = $_POST['join_date'];
        $cont_end = $_POST['cont_end'];

        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
            $tempName = $_FILES["image"]["tmp_name"];
            $folder = "assets/images/users/".$image; 
        }else{
            $error['image'] = "<p style='color: red;'>Please upload image </p>"; 
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

        //checking if Email Address has been filled
        if (empty($email)) {
            $error['email'] = "<p style='color:red;'>Please enter Email Address<p/>";
        }else{
            //prevent cross site scripting
            $email = sanitize($email);

            //validating email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $error['email'] = "<p style='color:red;'>Invalid Email Address ($email), please check and try again.<p/>";
            }

            //Checking if email already exists in the database
            $sql = "SELECT * FROM employee WHERE email = '$email' ";
            //Execute the sql statement usimg mysqli query function
            $result = mysqli_query($dbconnect, $sql);
            if (mysqli_num_rows($result) > 0) {
                 $row = mysqli_fetch_assoc($result); 
                 if ($email == isset($row['email'])) {
                     $error['email'] = "<p style='color:red;'>Email Address:$email already exists, Use another email.<p/>";
                 }
             } 
        }

        //checking if password has been filled
        if (empty($password)) {
            $error['password'] = "<p style='color:red;'>Please enter your password<p/>";
        }else{
            //prevent cross site scripting
            $password = sanitize($password);
            $password1 = sanitize($password1);

            //validate password length, special character, number, upper case and lower case
            if (strlen($password) < 8) {
                $error['password'] = "<p style='color:red;'>Password is too short!<p/>";
            }
            if ( ! preg_match("#[0-9]+#", $password)) {
                $error['password'] = "<p style='color:red;'>Password must include at least one number<p/>!";
            }
            if (!preg_match("#[a-zA-Z]+#", $password)) {
                $error['password'] = "<p style='color:red;'>Password must include at least alphabets!<p/>";
            }

            //Confirm passwords if they match
            if ($password != $password1) {
                    $error['password1'] = "The passwords do not match please check again";
            } else {
                //Encrypt passwords
                $password = crypt($password, 'Mashon_89');
            }    
        }
        if (array_filter($error)) {
            $error['general'] = "<p style='color:red;'> Please sort out the above error before you can proceed<p/>";
        }else{
           //Sql statements to INSERT data to the tables
           $sql = "INSERT INTO employee (fname, surname, contact, email, gender, password, role, designation, status, image, joining_date, contract_end, DOB, dept_id) VALUES ('$firstname', '$surname', '$contact', '$email', '$gender', '$password', '$role', '$deg', 1, '$image', '$join_date', '$cont_end', '$dob', '$dept') ";
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
                        <p class="message-alert-none"><strong>Success!</strong> You have registered a new employee successfully.</p>
                    </div>
                </div>';
            }else{
                $error['general'] = "<p style='color:red;'> Error: " .$dbconnect->error. "</p>";
            }

        }
    }
?>


<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Employee</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
        </div>
    </div>
    <div class="message"></div>
    <div class="container-fluid">
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="employee.php" class="text-white"><i class="" aria-hidden="true"></i>  Employee List</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Add New Employee<span class="pull-right "></span></h4>
                    </div>
                    <div class="card-body">
                        <form class="row" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                            <div class="form-group col-md-3 m-t-20">
                                <label>First Name <i style="color: red">*</i></label>
                                <input type="text" name="fname" class="form-control form-control-line" placeholder="Employee's FirstName" minlength="2" required="" value="<?php if (isset($firstname)) echo $firstname;?>"> 
                                <?php 
                                    if (isset($error['firstname'])) {
                                        echo $error['firstname'];
                                    }
                                ?>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Last Name <i style="color: red">*</i></label>
                                <input type="text" name="surname" class="form-control form-control-line" placeholder="Employee's LastName" minlength="2" required="" value="<?php if(isset($surname)) echo $surname;?>">
                                <?php 
                                    if (isset($error['surname'])) {
                                        echo $error['surname'];
                                    }
                                ?> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Contact <i style="color: red">*</i></label>
                                <input type="text" name="contact" class="form-control" placeholder="0712345678" minlength="10" maxlength="10" required="" value="<?php if (isset($contact)) echo $contact;?>">
                                <?php 
                                    if (isset($error['contact'])) {
                                        echo $error['contact'];
                                    }
                                ?> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Email <i style="color: red">*</i></label>
                                <input type="email" id="example-email2" name="email" class="form-control" placeholder="abc@gmail.com" minlength="7" required="" value="<?php if (isset($email)) echo $email;?>">
                                <?php 
                                    if (isset($error['email'])) {
                                        echo $error['email'];
                                    }
                                ?> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Image <i style="color: red">*</i></label>
                                <input type="file" name="image" class="form-control" value=""> 
                                <?php 
                                    if (isset($error['image'])) {
                                        echo $error['image'];
                                    }
                                ?>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Date Of Birth <i style="color: red">*</i></label>
                                <input type="date" name="dob" id="example-email2" class="form-control" placeholder="" required="" value="<?php if(isset($dob)) echo $dob; ?>"> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Department <i style="color: red">*</i></label>
                                <select name="dept" value="" class="form-control custom-select" required="" id="dept-id">
                                    <option>Select Department</option>
                                    <?php 
                                        $sql = "SELECT * FROM department";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                        foreach ($result as $dep){
                                    ?>
                                    <option value="<?php echo $dep['ID'];?>" <?php if(isset($dept) && $dept == $dep['ID']) echo 'selected'; ?>><?php echo $dep['dept_name'];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Designation <i style="color: red">*</i></label>
                                <select name="deg" class="form-control custom-select" required="" id="role">
                                    <option>Select Designation</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Role <i style="color: red">*</i></label>
                                <select name="role" class="form-control custom-select" required="">
                                    <option>Select Role</option>
                                    <option value="ADMIN" <?php if(isset($role) && $role == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                                    <option value="Employee" <?php if(isset($role) && $role == 'Employee') echo 'selected'; ?>>Employee</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Gender <i style="color: red">*</i></label>
                                <select name="gender" class="form-control custom-select" required="">
                                    <option>Select Gender</option>
                                    <option value="MALE" <?php if(isset($gender) && $gender == 'MALE') echo 'selected'; ?>>Male</option>
                                    <option value="FEMALE" <?php if(isset($gender) && $gender == 'FEMALE') echo 'selected'; ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Date Of Joining <i style="color: red">*</i></label>
                                <input type="date" name="join_date" id="example-email2" class="form-control" value="<?php if(isset($join_date)) echo $join_date;?>" placeholder="" required=""> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Date Of Leaving </label>
                                <input type="date" name="cont_end" id="example-email2" class="form-control" placeholder=""> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Password <i style="color: red">*</i></label>
                                <input type="text" name="password" class="form-control" placeholder="**********" required value="<?php if (isset($password)) echo $password;?>"> 
                            </div>
                            <div class="form-group col-md-3 m-t-20">
                                <label>Confirm Password <i style="color: red">*</i></label>
                                <input type="text" name="password1" class="form-control" value="" placeholder="**********" required="" value="<?php if (isset($password1)) echo $password1;?>"> 
                            </div>
                            <div class="form-actions col-md-12">
                                <button type="submit" class="btn btn-success" name="save"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                                <?php 
                                    if (isset($error['general'])) {
                                        echo $error['general'];
                                    }
                                    if (isset($success)){
                                        echo $success;
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require('includes/footer.php');
?>
<script>
    $(document).ready(function() {
        $('#dept-select').change(function() {
            var dept_id = $(this).val();

            // AJAX call to retrieve project start date and end date from database
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: { dept_id: dept_id },
                success: function(data) {
                    var dates = JSON.parse(data);

                    // Populate date inputs with retrieved dates
                    $('#role-select').val(dates.b start_date);
                    $('#end-date').val(dates.end_date);
                }
            });
        });
    });
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