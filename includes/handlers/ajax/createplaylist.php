<?php 
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date("Y-m-d");
    
    $query = mysqli_query($connection, "INSERT INTO playlists VALUES('', '$name', '$username', '$date')");
}
else {
    echo "Name or username parameters not passed in";
}
?>