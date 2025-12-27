<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "pr_db";  //Database Name
$conn = mysqli_connect($host, $username, $password, $db_name);
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
   echo "Connected Failed";
}


echo "Connected successfully!";
?>