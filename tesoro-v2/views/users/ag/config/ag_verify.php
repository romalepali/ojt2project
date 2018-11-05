<?php
    include ('../../../config/dbconnect.php');

    if(empty($_SESSION)){
        session_start();
    } 

    if (isset($_SESSION['user_type']) && $_SESSION['user_type']==1 && $_SESSION['user_status']=='Active'){
        header("location: ../lu/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==2 && $_SESSION['user_status']=='Active'){
        header("location: ../sm/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==3 && $_SESSION['user_status']=='Active'){
        header("location: ../su/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==4 && $_SESSION['user_status']=='Active'){
        header("location: ../ob/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==5 && $_SESSION['user_status']=='Active'){
        header("location: ../os/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==7 && $_SESSION['user_status']=='Active'){
        header("location: ../ar/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==8 && $_SESSION['user_status']=='Active'){
        header("location: ../en/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==9 && $_SESSION['user_status']=='Active'){
        header("location: ../bo/");
        exit;
    } else if(!isset($_SESSION['user_type']) && ($_SESSION['user_type'] > 9 && $_SESSION['user_type']) < 1){
        header("location: ../../../");
        exit;
    }
?>