<?php 
	//connect to db
	$dbcon = mysqli_connect('localhost', 'Mashon', 'M@5h0__.n8L9', 'employee_mgt');

	//A function to sanitize user data
	function sanitize($data){
		$data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($GLOBALS['dbcon'], $data);

        return $data;
	}
	/* date_default_timezone_set("Africa/Nairobi");
	echo "<p style='color: red'> Today is".date("l-d-m-y"). " Time is: ". date("h:i:sa"); */
?>