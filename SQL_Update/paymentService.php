<?php
include "../connect.php";
$service_no = $_POST['service_no'];
$remark = $_POST['remark'];
$username = $_SESSION['username'];
$sql = "UPDATE 
          service_detail 
        set install_status='W',
            payment_status='Y',
            remain_cost=0,
            update_date=now(),
            update_by='$username',
            payment_remark='$remark' 
        where service_no='$service_no'";
$result=mysqli_query($conn,$sql);
echo json_encode($result);