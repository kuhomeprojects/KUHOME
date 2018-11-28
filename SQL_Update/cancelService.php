<?php
include "../connect.php";
$service_no = $_POST['service_no'];
$username = $_SESSION['username'];
$sql = "UPDATE 
          service_detail 
        set install_status='C',
            payment_status='C',
            update_date=now(),
            update_by='$username',
            payment_remark='รายการถูกยกเลิกโดยผู้ใช้' 
        where service_no='$service_no'";
$result=mysqli_query($conn,$sql);
if($result){
    $sql = "select * from service_list where service_no ='$service_no'";
    $product = mysqli_query($conn,$sql);
    while ($temp=mysqli_fetch_array($product)){
        $p_id = $temp['product_id'];
        $qty = $temp['qty'];
        $sql = "update product set stock = stock+$qty where id = $p_id";
        $query = mysqli_query($conn,$sql);
    }
}
echo json_encode($result);