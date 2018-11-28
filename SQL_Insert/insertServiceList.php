<?php
include '../connect.php';
if ($_POST) {
    $sql = "SELECT service_no FROM service_detail ORDER BY service_no DESC LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $service_no = '';
    if($result){
        $content = mysqli_fetch_assoc($result);
        $service_no = $content['service_no'];
        $service_no = substr($service_no,0,1).sprintf('%09d',((int)substr($service_no,-9)+1));
    }else{
        $service_no = 'S000000001';
    }
//STR_TO_DATE(`my_date_col`, '%d/%c/%Y');
    $service_date       = $_POST['orderDate'];
    $c_id               = $_POST['customerId'];
    $payment_status     = $_POST['paymentStatus'];
    $install_status     = 'N';
    $install_date       = $_POST['installDate'];
    $install_address    = $_POST['installAddress'];
    $transfer_cost      = $_POST['transferCost'];
    //$create_date      = $_POST[''];
    $create_by          = $_SESSION['username'];
    $install_cost       = $_POST['installCost'];
    $discount_cost       = $_POST['discount'];
    $total_cost         = $_POST['totalCost'];
    $net_cost           = $_POST['netCost'];
    $total_product_cost = $_POST['totalProductCost'];
    $urgent_name        = $_POST['urgentName'];
    $urgent_tel         = $_POST['urgentCall'];
    $deposit_cost         = $_POST['depositCost'];
    $remain_cost         = $_POST['remainCost'];
    $sql = "insert into service_detail values ('$service_no',
                                                STR_TO_DATE('$service_date','%d/%c/%Y'),
                                                '$c_id',
                                                '$payment_status',
                                                '$install_status',
                                                STR_TO_DATE('$install_date','%d/%c/%Y'),
                                                '$install_address',
                                                '$transfer_cost',
                                                now(),
                                                '$create_by',
                                                '$install_cost',
                                                '$discount_cost',
                                                '$total_cost',
                                                '$net_cost',
                                                '$total_product_cost',
                                                '$urgent_name',
                                                '$urgent_tel',
                                                '$deposit_cost',
                                                '$remain_cost',
                                                now(),
                                                now(),
                                                '$create_by',
                                                '',
                                                '')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $max = count($_POST['productList']);
        for($i=0;$i<$max;$i++){
            $service_no = $service_no;
            $product_id = $_POST['productList'][$i]['id'];
            $qty = $_POST['productList'][$i]['qty'];
            $cost = $_POST['productList'][$i]['cost'];
            $insurance = $_POST['productList'][$i]['insurance'];
            $sql = "INSERT INTO service_list values('$service_no','$product_id','$qty','$cost','$insurance')";
            $resultProduct = mysqli_query($conn,$sql);
            if($resultProduct){
                $sql = "UPDATE PRODUCT SET stock = stock - $qty where id = '$product_id'";
                $resultProduct = mysqli_query($conn,$sql);
            }
        }
    }

    if($result && $resultProduct){
        $json = (object)'';
        $json->service_no = $service_no;
        echo json_encode($json);
    }else{
        echo false;
    }
}

