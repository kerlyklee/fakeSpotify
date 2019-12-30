<?php
ob_start();
session_start();
$timeZone = date_default_timezone_set("Europe/Tallinn");
$connection = mysqli_connect("localhost", "root", "", "sy_users");
if(mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_errno(); 

}
?>