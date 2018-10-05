<?php
$db_host = "localhost";
$db_user = "lordadmin";
$db_pass = "nothinglastforever";
$db_name = "db_tesoro";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>