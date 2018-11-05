<?php
include ("config/ar_verify.php");

$update_query = "UPDATE jo_notifications SET notify='No' WHERE user_id=".$_SESSION['user_id'];
mysqli_query($conn,$update_query);
?>