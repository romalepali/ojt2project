<?php
include ('config/su_verify.php');
$_SESSION['filter']=$_GET['report'];
header("location: reports.php");
?>