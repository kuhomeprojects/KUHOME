<?php
include '../connect.php';
$import_no = $_GET['import_no'];
$sql = "select i.*,p.name,p.full_type from import_list i inner join product p on p.id = i.product_id where i.import_no = '$import_no' ";
$content = mysqli_query($conn,$sql);
?>
<h5><i class="fa fa-list"></i> <strong>รายละเอียดการนำเข้า </strong><?php echo $import_no;?></h5>
<table class="table">
    <thead>
    <tr>
        <th>ลำดับ</th>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ประเภทสินค้า</th>
        <th>จำนวนที่นำเข้า</th>
        <th>ราคาซื้อ</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $count = 1;
    $totalQty = 0;
    $totalCost = 0;
    while($temp=mysqli_fetch_array($content)){
        ?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $temp['product_id'];?></td>
            <td><?php echo $temp['name'];?></td>
            <td><?php echo $temp['full_type'];?></td>
            <td><?php echo $temp['qty'];?></td>
            <td><?php echo $temp['purchase_cost'];?></td>
        </tr>
    <?php
        $totalQty+=$temp['qty'];;
        $totalCost+=($temp['qty']*$temp['purchase_cost']);
        $count++;
    }?>
    <tr>
        <th colspan="4" class="text-right">รวม</th>
        <td ><?php echo $totalQty;?></td>
        <td ><?php echo $totalCost;?></td>
    </tr>
    </tbody>
</table>

