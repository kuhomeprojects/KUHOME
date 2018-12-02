<?php
include '__connect.php';
include '__checkSession.php';

if (isset($_POST['insertBooking'])) {

}
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
    <script>

        $(document).ready(()=>{
            $('#reportContentList').DataTable();
        })
    </script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb  bg-dark">
                <h5><i class="fa fa-star"></i> ข้อมูลหอพัก</h5>
            </nav>
        </div>
        <div class="card-body">
            <div class="row" align="center">
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area">
                        <a href="_tower.php?type=M"> <img src="img/man.png" class="image"
                                                          width="125" height="125">
                            <div class="overlay bg-info ">
                                <div class="text"> หอพักชาย</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area">
                        <a href="_tower.php?type=F"> <img src="img/girl.png" class="image"
                                                          width="125" height="125">
                            <div class="overlay bg-info ">
                                <div class="text"> หอพักหญิง</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer bg-warning text-white">
        </div>
    </div>
<br>
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb  bg-dark">
                <h5></h5>
            </nav>
        </div>
        <div class="card-body">
            <div style="width: 85%" class="mx-auto">
                <a class="btn btn-sm btn-primary text-white" style="float: left" onclick="window.location = '_tower_insert.php'"><i class="fa fa-plus"></i> เพิ่มข้อมมูลหอพัก</a>
                <div class="table-responsive">
                <table id="reportContentList" class="table table-bordered rounded">
                    <thead>
                    <tr>
                        <th>ชื่อหอพัก</th>
                        <th>เบอร์โทร</th>
                        <th>สถานะ</th>
                        <th>ห้องพัก</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $type = '';
                    if (isset($_GET['type'])) {
                        $type = $_GET['type'];
                    }
                    $sql = "select * from tower where type like '%$type%'";

                    $result = mysqli_query($conn, $sql);
                    while ($temp = mysqli_fetch_array($result)) {
                        if ($temp['status'] == 'Y'){
                            $temp['status'] = 'พร้อมใช้งาน';
                        }else if ($temp['status'] == 'N'){
                            $temp['status'] = 'ปรับปรุง';
                        }
                        ?>
                        <tr>
                            <td><?php echo $temp['tower_name'] ?></td>
                            <td><?php echo $temp['tel'] ?></td>
                            <td><?php echo $temp['status'] ?></td>
                            <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_room.php?tower_no=<?php echo $temp['tower_no']?>&type=<?php echo $temp['type']?>'"><i class="fa fa-search"></i> ดูข้อมูลห้องพัก</a></td>
                            <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_tower_insert.php?tower_no=<?php echo $temp['tower_no']?>&type=<?php echo $temp['type']?>'"><i class="fa fa-edit"></i> แก้ไขหอพัก</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>

        </div>
        <div class="footer bg-warning text-white">

        </div>
    </div>


</div>
<!---->
<!--<form class="simple-form">-->
<!--    <div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">-->
<!--        <div class="card">-->
<!--            <div class="card-header">-->
<!--                <nav aria-label="breadcrumb  bg-dark">-->
<!--                    <h5><i class="fa fa-star"></i> ข้อมูลหอพัก</h5>-->
<!--                </nav>-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <div class="container">-->
<!--                    <div class="row">-->
<!---->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">วันที่เริ่มจอง</label>-->
<!--                                <input id="startDate" class="form-control" name="startDate" required readonly>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">วันที่สิ้นสุดการจอง</label>-->
<!--                                <input id="endDate" class="form-control" name="endDate" onchange="validateDateBooking()"-->
<!--                                       required readonly>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row">-->
<!---->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">ปีการศึกษา</label>-->
<!--                                <select class="form-control" id="year" name="year" required>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">เทอม</label>-->
<!--                                <select class="form-control" id="semester" name="semester" required>-->
<!--                                    <option value="1">ภาคต้น</option>-->
<!--                                    <option value="2">ภาคปลาย</option>-->
<!--                                    <option value="3">ฤดูร้อน</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row">-->
<!--                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">ประเภทหอพัก</label>-->
<!--                                <select class="form-control" id="towerType" name="towerType" onchange="setTowerList()" required>-->
<!--                                    <option value="M"> หอชาย</option>-->
<!--                                    <option value="F"> หอหญิง</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div><div class="col-6 col-sm-6 col-md-6 col-lg-6">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">หอที่เปิด</label>-->
<!--                                <select class="form-control" id="towerNo" name="towerNo" onchange=" validateButton()" required>-->
<!---->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="footer" align="center">-->
<!--                <button class="btn btn-sm btn-outline-success" id="submitBtn" name="insertBooking" style="margin: 10px"><i class="fa fa-check"></i> เปิดการจอง</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    </div>-->
<!--</form>-->
</body>
</html>
