<?php
 	function MaxNumbers($number){ 
		rsort($number); //descending order
		//$highestNumber = array_slice($number, 0,2);
		$product = $number[0] * $number[1];
		return $product;
 	}
	$number = array('1', '2', '3', '4', '5', '6', '7', '8', '9');
	$result = MaxNumbers($number);
	echo $result;
?>