<?php 
    require('includes/header.php');
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i> Employees</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
        </div>
    </div>
    <div class="message"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-users" aria-hidden="true"></i> Employee List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <div id="employees123_wrapper" class="dataTables_wrapper no-footer">
                                <table id="employees123" class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="employees123_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 48px;">No.</th>
                                            <th style="width: 139px;">Employee Name </th> 
                                            <th style="width: 132px;">Email </th>
                                            <th style="width: 99px;">Role</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $rowsPerPage = 10;
                                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                        // Calculate the offset for the SQL query
                                        $offset = ($pageNumber - 1) * $rowsPerPage;

                                        $sql = "SELECT * FROM employee WHERE role = 'Employee' OR role = 'ADMIN' ORDER BY fname LIMIT $rowsPerPage OFFSET $offset";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        $num = mysqli_num_rows($query);
                                        $start_index = $offset + 1;
                                        $n = $start_index;

                                        foreach ($results as $emp) {
                                            $des = $emp['designation']; 
                                            $role_sql ="SELECT * FROM roles WHERE ID = $des ";
                                            $role_query = mysqli_query($dbconnect, $role_sql);
                                            $emp_roles = mysqli_fetch_assoc($role_query); 
                                    ?>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td><?php echo $n; $n++; ?></td>
                                            <td title='<?php if(isset($emp['fname'])) echo $emp['fname']." ".$emp['surname'];?>'><?php if(isset($emp['fname'])) echo $emp['fname']." ".$emp['surname'];?></td>
                                            <td><?php if(isset($emp['email'])) echo $emp['email'];?></td>
                                            <td><?php if(isset($emp_roles['role_name'])) echo $emp_roles['role_name'];?></td>
                                        </tr>
                                    </tbody>
                                    <?php 
                                    }
                                    ?>
                                </table>
                                <?php
                                    $page_sql = "SELECT COUNT(*) AS total FROM employee WHERE role != 'Former'";
                                    $page_query = mysqli_query($dbconnect, $page_sql);
                                    $row = mysqli_fetch_assoc($page_query);

                                    $total_records = $row['total'];
                                    $total_pages = ceil($total_records / $rowsPerPage);

                                    $limit = $rowsPerPage;
                                    $start_index = $offset + 1;
                                    $end_index = min(($offset + $limit), $total_records);
                                ?>
                                <div class="dataTables_info"><?php echo "Showing ".$start_index." to ".$end_index." of ". $total_records;?> entries</div>
                                <div class="dataTables_paginate ">
                                   <?php
                                        // Display previous and next links
                                        if ($pageNumber > 1) {
                                            echo "<button class='paginate_button previous'><a href='?page=" . ($pageNumber - 1) . "'>Previous</a></button> ";
                                        }
                                        echo "<a class='paginate_button current'>".$pageNumber."</a>";
                                        if ($pageNumber < $total_pages) {
                                            echo "<button class='paginate_button next'><a href='?page=" . ($pageNumber + 1) . "'>Next</a></button>";
                                        }
                                   ?>
                                </div>
                            </div>
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

    