<?php
include '../connect.php';
$id = $_GET['id'];
$sql = "SELECT * from customer where c_id = '$id'";
$query = mysqli_query($conn,$sql);
$dbdata = array();
while ( $temp = mysqli_fetch_array($query,MYSQLI_ASSOC))  {
    $dbdata[]=$temp;
}


echo json_encode($dbdata[0]);