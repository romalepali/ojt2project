<?php
    include ('dbconnect.php');
    include ('../../../../dbconnect.php');
    if(empty($_SESSION)){
        session_start();
    } 

    if (isset($_SESSION['TIMS_type']) && $_SESSION['TIMS_type']==1 && $_SESSION['TIMS_status']=='Active'){
    	header("location: ../../support/");
    	exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 2) && $_SESSION['TIMS_status']=='Active'){
    	header("location: ../../admin/");
    	exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 4) && $_SESSION['TIMS_status']=='Active'){
        header("location: ../enduser/orgs/");
        exit;
    } else if(isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type']== 5) && $_SESSION['TIMS_status']=='Active'){
        header("location: ../enduser/orgb/");
        exit;
    } else if(!isset($_SESSION['TIMS_type']) && ($_SESSION['TIMS_type'] > 6 && $_SESSION['TIMS_type']) < 1){
    	header("location: ../../../../TIMS_login.php");
        exit;
    }
?>