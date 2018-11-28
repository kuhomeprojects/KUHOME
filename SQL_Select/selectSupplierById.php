<?php
include '../connect.php';
$id = $_GET['id'];
$sql = "SELECT * from supplier where id = '$id'";
$query = mysqli_query($conn,$sql);
$dbdata = array();
while ( $temp = mysqli_fetch_array($query,MYSQLI_ASSOC))  {
    $dbdata[]=$temp;
}


echo json_encode($dbdata[0]);