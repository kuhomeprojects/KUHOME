<?php
include '../connect.php';
$username = $_GET['username'];
$sql = "SELECT * from user where username = '$username'";
$query = mysqli_query($conn,$sql);
$dbdata = array();
//Fetch into associative array
while ( $temp = mysqli_fetch_array($query,MYSQLI_ASSOC))  {
    $dbdata[]=$temp;
}
echo json_encode($dbdata[0]);