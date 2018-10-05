<?php
session_start();
session_destroy();

if(empty($_SESSION)){
	session_start();
}

if(!isset($_POST['logout']))
{
	header("Location: index.php");
	exit;  
}

header("location: ../../../TIMS_login.php");
exit;
?>