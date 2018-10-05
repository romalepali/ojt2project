<?php
    include ('dbconnect.php');

    if(empty($_SESSION)){
        session_start();
    } 

    if (isset($_SESSION['user_type']) && $_SESSION['user_type']==1 && $_SESSION['user_status']=='Active'){
    	header("location: views/users/lu/");
    	exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==2 && $_SESSION['user_status']=='Active'){
    	header("location: views/users/sm/");
    	exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==3 && $_SESSION['user_status']=='Active'){
        header("location: views/users/su/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==4 && $_SESSION['user_status']=='Active'){
        header("location: views/users/ob/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==5 && $_SESSION['user_status']=='Active'){
        header("location: views/users/os/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==6 && $_SESSION['user_status']=='Active'){
        header("location: views/users/ag/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==7 && $_SESSION['user_status']=='Active'){
        header("location: views/users/ar/");
        exit;
    }
?>