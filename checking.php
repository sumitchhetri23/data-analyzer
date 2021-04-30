<?php
$dbServername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname ="statewise";
$conn = mysqli_connect($dbServername, $dbuser, $dbpass, $dbname) or die("Connection failed:". $conn -> error);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
