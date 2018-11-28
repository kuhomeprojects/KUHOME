<?php
include '../connect.php';
$username = $_POST['username'];
$type = $_POST['type'];
$fullType = '';
if($type=='C') $fullType='พนักงานเคาเตอร์';
if($type=='Q') $fullType='พนักงานตรวจสอบ';
if($type=='A') $fullType='ผุ้ดูแล';
if($type=='S') $fullType='พนักงานขาย';
$sql = "UPDATE user set type='$type',full_type='$fullType' WHERE username='$username' ";
$query = mysqli_query($conn,$sql);

echo json_encode($query);