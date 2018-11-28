<?php
include "../connect.php";
$service_no = $_POST['service_no'];
$username = $_SESSION['username'];
$sql = "UPDATE 
          service_detail 
        set install_status='Y',
            install_end_date=now(),
            install_by ='$username'
        where service_no='$service_no'";
$result=mysqli_query($conn,$sql);
echo json_encode($result);