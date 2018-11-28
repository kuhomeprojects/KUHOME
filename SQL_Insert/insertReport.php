<?php
include '../connect.php';
if ($_POST) {
$user = $_SESSION['username'];
$content = $_POST['report_content'];
$sql = "insert into report values(null,now(),'$content','$user')";
$query = mysqli_query($conn,$sql);
echo json_encode($query);
}

