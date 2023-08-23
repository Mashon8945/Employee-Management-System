<?php 
    require('includes/header.php');
?>

<div class="page-wrapper" style="min-height: 785px;">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i> Employee</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Employee</li>
                <li class="breadcrumb-item active">Employees</li>
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
                        <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Employee List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTables_wrapper no-footer">
                                <div class="dataTables_filter">
                                    <label>Search:
                                        <input type="search" id="search-input">
                                    </label>
                                </div>
                                <table class="display nowrap table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%" style="width: 100%;"  id="search-results">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 48px;">No.</th>
                                            <th style="width: 139px;">Employee Name</th> 
                                            <th style="width: 132px;">Email</th>
                                            <th style="width: 83px;">Contact </th>
                                            <th style="width: 99px;">Employee Type</th>
                                            <th style="width: 99px;">Role</th>
                                            <th style="width: 67px;">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $rowsPerPage = 10;
                                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                        // Calculate the offset for the SQL query
                                        $offset = ($pageNumber - 1) * $rowsPerPage;  
                                        $start_index = $offset + 1;

                                        $sql = "SELECT * FROM employee WHERE role != 'Former' ORDER BY fname LIMIT $rowsPerPage OFFSET $offset";
                                        $query = mysqli_query($dbconnect, $sql);
                                        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        $num = mysqli_num_rows($query);
                                        $n = $start_index;

                                        foreach ($results as $emp) {
                                            $des = $emp['designation']; 
                                            $role_sql ="SELECT * FROM roles WHERE ID = $des ";
                                            $role_query = mysqli_query($dbconnect, $role_sql);
                                            $emp_roles = mysqli_fetch_assoc($role_query); 
                                    ?>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?php echo $n; $n = $n + 1; ?></td>
                                            <td title='<?php if(isset($emp['fname'])) echo $emp['fname']." ".$emp['surname'];?>'><?php if(isset($emp['fname'])) echo $emp['fname']." ".$emp['surname'];?></td>
                                            <td><?php if(isset($emp['email'])) echo $emp['email'];?></td>
                                            <td>0<?php if(isset($emp['contact'])) echo $emp['contact'];?></td>
                                            <td><?php if(isset($emp['role'])) echo  $emp['role'];?></td>
                                            <td><?php if(isset($emp_roles['role_name'])) echo $emp_roles['role_name'];?></td>
                                            <td class="jsgrid-align-center ">
                                                <?php  
                                                    $emp_id = $emp['emp_id'];
                                                    $profile_url = "employee_edit.php?emp_id=".$emp_id; 
                                                ?>
                                                <input type="hidden" name="userid" value="<?php echo $emp_id;?>">
                                                <a href="<?php echo $profile_url; ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" title="delete" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Are you sure to delete this data?')"><i class="fa fa-trash-o"></i></a>
                                            </td>
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
                                    $end_index = min(($offset + $limit), $total_records);
                                ?>
                                <div class="dataTables_info" id="employees123_info" role="status" aria-live="polite"><?php echo "Showing ".$start_index." to ".$end_index." of ". $total_records;?> entries</div>
                                <div class="dataTables_paginate paging_simple_numbers">
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
<script type="text/javascript">
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    // Add event listener to the search input
    searchInput.addEventListener('input', () => {
        // Get the search term
        const searchTerm = searchInput.value.trim();

        // If the search term is empty, clear the search results container and return
        if (searchTerm === '') {
            searchResults.innerHTML = '';
            return;
        }

        // Send an AJAX request to the server to retrieve the search results
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Update the search results container with the retrieved data
                searchResults.innerHTML = this.responseText;
            }
        };
        xhr.open('GET', `Ajax/search.php?q=${encodeURIComponent(searchTerm)}`);
        xhr.send();
    });
</script>
<?php 
    require('includes/footer.php');
?>

    