<?php
include '../connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "select * from user where username='$username' and password = '$password'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
if($result){
    echo json_encode(true);
}else{
    echo json_encode(false);
}
