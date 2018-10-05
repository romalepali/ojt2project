<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "db_tesoro";
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// function quote($strText)
	// {
	// 	$Mstr = addslashes($strText);
	// 	return "'" . $Mstr . "'";
	// }

	// function isdate($d)
	// {
	// 	$ret = true;
	// 	try
	// 	{
	// 		$x = date("d",$d);
	// 	}
	// 	catch (Exception $e)
	// 	{
	// 		$ret = false;
	// 	}
	// 	echo $x;
	// 	return $ret;
	// } 
?>