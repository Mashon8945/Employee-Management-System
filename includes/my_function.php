<?php 
	//connect to db
	$dbcon = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

	//A function to sanitize user data
	function sanitize($data){
		$data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($GLOBALS['dbcon'], $data);

        return $data;
	}
?>