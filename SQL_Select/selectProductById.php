<?php
include '../connect.php';
$id = $_GET['id'];
$sql = "SELECT id,name,type,full_type,cost,stock,TO_BASE64(image) as image,insurance from product where id = '$id'";
$query = mysqli_query($conn,$sql);
$dbdata = array();

//Fetch into associative array
while ( $temp = mysqli_fetch_array($query,MYSQLI_ASSOC))  {
    $dbdata[]=$temp;
}


echo json_encode($dbdata[0]);