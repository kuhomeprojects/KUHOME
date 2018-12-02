<?php
$code = $_GET['code'];
include '__connect.php';
$sql = "select distinct d.*,
       s.name,
       s.department,
       s.major,
       s.level,
       s.tel,
       r.cost,
       r.size,
       t.full_status as tower_type,
       tower.tower_name
from booking_detail d
       inner join student s on s.code = d.student_code
       inner join status t on t.status = d.type
       inner join room r on r.room_no = d.room_no
       inner join tower  on tower.tower_no = d.tower_no
where d.student_code = '$code' limit 1
";
$result = mysqli_query($conn,$sql);
$detail = mysqli_fetch_assoc($result);
require_once __DIR__ . '/vendor/autoload.php';
include '__header.php';
$mpdf = new \Mpdf\Mpdf();

?>
<html>
<body style="background: white;">


<div class="container">
    <h5 class="font-weight-bold text-center">เอกสารขอจองหอพัก</h5>
    <hr>
    <div class="row">
        <div class="col-2 col-md-2 col-sm-2 col-lg-2">
                <img  src="img/KU_TH.png" height="200">

        </div>
        <div class="col-5 col-md-5 col-sm-5 col-lg-5">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" colspan="2">ข้อมูลนิสิต</th>
                </tr>
                </thead>
                <tr>
                    <th class="text-right">รหัสนิสิต</th>
                    <td><?php echo $detail['student_code']?></td>
                </tr>
                <tr>
                    <th class="text-right">ชื่อ-สกุล</th>
                    <td><?php echo $detail['name']?></td>
                </tr>
                <tr>
                    <th class="text-right">คณะ</th>
                    <td><?php echo $detail['department']?></td>
                </tr>
                <tr>
                    <th class="text-right">หลักสูตร</th>
                    <td><?php echo $detail['major']?></td>
                </tr>
                <tr>
                    <th class="text-right">ชั้นปี</th>
                    <td><?php echo $detail['level']?></td>
                </tr>
            </table>
        </div>
        <div class="col-5 col-md-5 col-sm-5 col-lg-5">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" colspan="4">ข้อมูลหอพัก</th>
                </tr>
                </thead>
                <tr>
                    <th class="text-right">ประเภทตึก</th>
                    <td colspan="3"><?php echo $detail['tower_type']?></td>
                </tr>
                <tr>
                    <th class="text-right">หมายเลขตึก</th>
                    <td><?php echo $detail['tower_no']?></td>
                    <th class="text-right">ชื่อตึก</th>
                    <td><?php echo $detail['tower_name']?></td>
                </tr>
                <tr>
                    <th class="text-right">เลขห้อง</th>
                    <td><?php echo $detail['room_no']?></td>
                    <th class="text-right">ขนาด</th>
                    <td><?php echo $detail['size']?> คน</td>
                </tr>
                <tr>
                    <th class="text-right">ราคา</th>
                    <td colspan="3"><?php echo $detail['cost']?></td>
                </tr>
            </table>
        </div>
    </div>
<br>
    <div class="container">
        <p class="font-italic font-weight-bold"><u>หมายเหตุ</u></p>
        <p class="font-italic">กรุณาชำระเงินที่กองกิจการนิสิตภายใน 7 วันหลังจากจองห้องผ่านระบบ พร้อมแนบเอกสารนี้พร้อมบัตรนิสิต</p>
    </div>
<div class="row" style="margin-top:50px; ">
    <div class="col col-md col-lg col-sm text-center">
        <strong>ลงชื่อ............................................................................ผู้ชำระเงิน</strong><br>
        <strong>(.......................................................)</strong><br>
        <strong>วันที่ (....../....../......)</strong><br>

    </div>
    <div class="col col-md col-lg col-sm text-center">
        <strong>ลงชื่อ............................................................................ผู้รับเงิน</strong><br>
        <strong>(.......................................................)</strong><br>
        <strong>วันที่ (....../....../......)</strong><br>
    </div>
</div>
</div>
</body>

<p class="text-center" style="margin-top: 20px; margin-bottom: 20px;">--------------------------------------------------------------------------<small>สำหรับเจ้าหน้าที่</small>------------------------------------------------------------------</p>

<body style="background: white;">


<div class="container">
    <h5 class="font-weight-bold text-center">เอกสารขอจองหอพัก</h5>
    <hr>
    <div class="row">
        <div class="col-2 col-md-2 col-sm-2 col-lg-2">
            <img  src="img/KU_TH.png" height="200">

        </div>
        <div class="col-5 col-md-5 col-sm-5 col-lg-5">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" colspan="2">ข้อมูลนิสิต</th>
                </tr>
                </thead>
                <tr>
                    <th class="text-right">รหัสนิสิต</th>
                    <td><?php echo $detail['student_code']?></td>
                </tr>
                <tr>
                    <th class="text-right">ชื่อ-สกุล</th>
                    <td><?php echo $detail['name']?></td>
                </tr>
                <tr>
                    <th class="text-right">คณะ</th>
                    <td><?php echo $detail['department']?></td>
                </tr>
                <tr>
                    <th class="text-right">หลักสูตร</th>
                    <td><?php echo $detail['major']?></td>
                </tr>
                <tr>
                    <th class="text-right">ชั้นปี</th>
                    <td><?php echo $detail['level']?></td>
                </tr>
            </table>
        </div>
        <div class="col-5 col-md-5 col-sm-5 col-lg-5">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" colspan="4">ข้อมูลหอพัก</th>
                </tr>
                </thead>
                <tr>
                    <th class="text-right">ประเภทตึก</th>
                    <td colspan="3"><?php echo $detail['tower_type']?></td>
                </tr>
                <tr>
                    <th class="text-right">หมายเลขตึก</th>
                    <td><?php echo $detail['tower_no']?></td>
                    <th class="text-right">ชื่อตึก</th>
                    <td><?php echo $detail['tower_name']?></td>
                </tr>
                <tr>
                    <th class="text-right">เลขห้อง</th>
                    <td><?php echo $detail['room_no']?></td>
                    <th class="text-right">ขนาด</th>
                    <td><?php echo $detail['size']?> คน</td>
                </tr>
                <tr>
                    <th class="text-right">ราคา</th>
                    <td colspan="3"><?php echo $detail['cost']?></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="container">
        <p class="font-italic font-weight-bold"><u>หมายเหตุ</u></p>
        <p class="font-italic">กรุณาชำระเงินที่กองกิจการนิสิตภายใน 7 วันหลังจากจองห้องผ่านระบบ พร้อมแนบเอกสารนี้พร้อมบัตรนิสิต</p>
    </div>
    <div class="row" style="margin-top:50px; ">
        <div class="col col-md col-lg col-sm text-center">
            <strong>ลงชื่อ............................................................................ผู้ชำระเงิน</strong><br>
            <strong>(.......................................................)</strong><br>
            <strong>วันที่ (....../....../......)</strong><br>

        </div>
        <div class="col col-md col-lg col-sm text-center">
            <strong>ลงชื่อ............................................................................ผู้รับเงิน</strong><br>
            <strong>(.......................................................)</strong><br>
            <strong>วันที่ (....../....../......)</strong><br>
        </div>
    </div>
</div>
</body>
</html>


