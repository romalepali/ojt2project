<?php
include ('config/ag_verify.php');
$_SESSION['filter']=$_GET['report'];
header("location: reports.php");
?>