<?php
    if(empty($_SESSION)){
        session_start();
    } 

    if (isset($_SESSION['user_type']) && $_SESSION['user_type']==1 && $_SESSION['user_status']=='Active'){
    	header("location: users/lu/");
    	exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==2 && $_SESSION['user_status']=='Active'){
    	header("location: users/sm/");
    	exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==3 && $_SESSION['user_status']=='Active'){
        header("location: users/su/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==4 && $_SESSION['user_status']=='Active'){
        header("location: users/ob/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==5 && $_SESSION['user_status']=='Active'){
        header("location: users/os/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==6 && $_SESSION['user_status']=='Active'){
        header("location: users/ag/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==7 && $_SESSION['user_status']=='Active'){
        header("location: users/ar/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==8 && $_SESSION['user_status']=='Active'){
        header("location: users/en/");
        exit;
    } else if(isset($_SESSION['user_type']) && $_SESSION['user_type']==9 && $_SESSION['user_status']=='Active'){
        header("location: users/bo/");
        exit;
    } else {
        header("location: ../");
        exit;
    }
?>