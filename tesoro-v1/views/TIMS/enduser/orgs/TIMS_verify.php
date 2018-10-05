<?php
    include ('../../../../dbconnect.php');
    date_default_timezone_set('Asia/Manila');
    if(empty($_SESSION)){
        session_start();
    } 

    if (isset($_SESSION['TIMS_type']) && $_SESSION['TIMS_type']==1 && $_SESSION['TIMS_status']=='Active'){
    	header("location: ../../support/");
    	exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 2) && $_SESSION['TIMS_status']=='Active'){
    	header("location: ../../admin/");
    	exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 3) && $_SESSION['TIMS_status']=='Active'){
        header("location: ../enduser/default/");
        exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 5) && $_SESSION['TIMS_status']=='Active'){
        header("location: ../enduser/orgb/");
        exit;
    } else if(!isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type'] > 6 && $_SESSION['TIMS_type']) < 1){
    	header("location: ../../../../TIMS_login.php");
        exit;
    }
?>