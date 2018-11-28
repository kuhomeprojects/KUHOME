<?php
include '../connect.php';
$username = $_POST['username'];
$status = $_POST['status'];
$fullStatus = '';
if($status=='A') $fullStatus='ใช้งาน';
if($status=='S') $fullStatus='พักงาน';
if($status=='C') $fullStatus='ยกเลิก';
$sql = "UPDATE user set status='$status',full_status='$fullStatus' WHERE username='$username' ";
$query = mysqli_query($conn,$sql);

echo json_encode($query);