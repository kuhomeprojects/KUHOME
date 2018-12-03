<?php
include '__connect.php';
include '__checkSession.php';


if (isset($_GET['room_no']) && isset($_GET['tower_no']) && isset($_GET['type'])) {
//เแก้ไข

    $room_no = $_GET['room_no'];
    $type = $_GET['type'];
    $tower_no = $_GET['tower_no'];

    $sql = "SELECT * FROM `tower` WHERE `type` = '$type' AND `tower_no` = '$tower_no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $tower_name = $row['tower_name'];
        $headetroom_update = "<nav aria-label='breadcrumb  bg-dark'><h5><i class='fa fa-star'></i> แก้ไขข้อมูลห้องพัก </h5></nav>";

        $sql = "SELECT * FROM `room` WHERE `room_no` = '$room_no' AND `tower_no` = '$tower_no'";
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);
        if($res){
            $size = $res['size'];
            $status = $res['status'];
            $cost = $res['cost'];
        }

    }
    }else if (isset($_GET['type']) && isset($_GET['tower_no'])) {
//เพิ่มข้อมูล
    $room_no = "";
    $tower_no = "";
    $size = "";
    $status = "";
    $type = "";
    $cost = "";

    $type = $_GET['type'];
    $tower_no = $_GET['tower_no'];
    $sql = "SELECT * FROM `tower` WHERE `type` = '$type' AND `tower_no` = '$tower_no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $tower_name = $row['tower_name'];
        $headetroom_insert = "<nav aria-label='breadcrumb  bg-dark'><h5><i class='fa fa-star'></i> เพิ่มข้อมูลห้องพัก</h5></nav>";
    }
}

if (isset($_POST['insertRoom'])) {
    $tower_name = $_POST['tower_name'];

    $sql = "INSERT INTO `tower` (`tower_no`, `type`, `tel`, `status`, `cost`, `tower_name`) VALUES ('$tower_no', '$type', '$tel', '$status', '$cost', '$tower_name');";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_GET['type'] = $type;
        $_GET['tower_no'] = $tower_no;
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>สำเร็จ!</strong> เพิ่มข้อมูลตึกแล้ว
                    </div>';

    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>ไม่สำเร็จ!</strong> กลุ่มหอและตึกนี้้มีอยู่ในข้อมูลแล้ว
                    </div>';
    }
} else if (isset($_POST['updateRoom'])) {

    $check_type = $_POST['check_type'];
    $check_tower_no = $_POST['check_tower_no'];
    $tower_no = $_POST['tower_no'];
    $type = $_POST['type'];
    $tel = $_POST['tel'];
    $status = $_POST['status'];
    $cost = $_POST['cost'];
    $tower_name = $_POST['tower_name'];

    $sql = "UPDATE `tower` SET `tower_no` = '$tower_no', `type` = '$type', `tel` = '$tel', `status` = '$status', `cost` = '$cost', `tower_name` = '$tower_name' WHERE `tower`.`tower_no` = '$check_tower_no' AND `tower`.`type` = '$check_type';";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>สำเร็จ!</strong> แก้ไขข้อมูลตึกแล้ว
                    </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>ไม่สำเร็จ!</strong> กลุ่มหอและตึกนี้้มีอยู่ในข้อมูลแล้ว
                    </div>';
    }
}
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
    <script>
        $(document).ready(() => {
            $("#tel").mask("999-9999999");
        });
    </script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>
<form method="post" class="simple-form">
    <div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
        <div class="card">
            <div class="card-header">
                <?php
                if (isset($headetroom_insert)) {
                    echo "$headetroom_insert";
                }else if (isset($headetroom_update)){
                    echo "$headetroom_update";
                }
                ?>

            </div>
            <div class="card-body">
                <div class="container">

                    <div class="row">
                        <div class="col col-sm col-md col-lg">
                            <div class="form-group">
                                <label class="font-weight-bold">กลุ่มหอ</label>
                                <select class="form-control" id="type" name="type" required>


                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-sm col-lg col-md">
                            <div class="form-group">
                                <label>รายละเอียด :</label>
                                <input name="tower_name" id="tower_name" class="form-control" required
                                       placeholder="ชื่อตึก" value="<?php echo $tower_name; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-sm col-lg col-md">
<!--                            <div class="form-group">-->
<!--                                <input type="number" name="tower_no" id="tower_no" class="form-control" required-->
<!--                                       placeholder="เลขตึก" value="--><?php //echo $tower_no; ?><!--">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="row">-->
<!--                        <div class="col col-sm col-lg col-md">-->
<!--                            <div class="form-group">-->
<!--                                <label>เบอร์โทรศัพท์ :</label>-->
<!--                                <input name="tel" id="tel" class="form-control" maxlength="11"-->
<!--                                       minlength="11" required value="--><?php //echo $tel; ?><!--"-->
<!--                                       placeholder="ตัวอย่าง (089-1231231)">-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!--                    <div class="row">-->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">สถานะ</label>-->
<!--                                <select class="form-control" id="status" name="status" required>-->
<!---->
<!--                                    --><?php
//                                    if (isset($_GET['type']) && isset($_GET['tower_no'])) {
//                                        if ($status == 'Y') {
//                                            echo "
//                                                <option selected value='Y'>พร้อมใช้งาน</option>
//                                                <option value='N'>ปรับปรุง</option>";
//                                        } else if ($status == 'N') {
//                                            echo "
//                                                <option value='Y'>พร้อมใช้งาน</option>
//                                                <option selected value='N'>ปรับปรุง</option>";
//                                        } else {
//                                            echo "<option></option>
//                                       <option value='Y'>พร้อมใช้งาน</option>
//                                                <option value='N'>ปรับปรุง</option>";
//                                        }
//                                    } else {
//                                        echo "<option></option>
//                                       <option value='Y'>พร้อมใช้งาน</option>
//                                                <option value='N'>ปรับปรุง</option>";
//                                    }
//                                    ?>
<!---->
<!---->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                    <div class="row">-->
<!--                        <div class="col col-sm col-md col-lg">-->
<!--                            <div class="form-group">-->
<!--                                <label class="font-weight-bold">ค่าธรรมเนียม</label>-->
<!--                                <select class="form-control" id="cost" name="cost" required>-->
<!--                                    --><?php
//                                    if (isset($_GET['type']) && isset($_GET['tower_no'])) {
//                                        echo "<option value='$cost'>$cost</option>";
//                                    } else {
//                                        echo "<option></option>";
//                                    }
//                                    ?>
<!--                                    <option value="4500">4500</option>-->
<!--                                    <option value="4900">4900</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="row">-->
<!--                        <div class="col-2 col-sm-2 col-lg-2 col-md-2"></div>-->
<!---->
<!--                        --><?php
//                        if (isset($_GET['type']) && isset($_GET['tower_no'])) {
//                            echo "<input value='$type' name='check_type' type='hidden'>";
//                            echo "<input value='$tower_no' name='check_tower_no' type='hidden'>";
//                            echo "<button type='submit' name='updateRoom' class='btn btn-primary col-4 col-sm-4 col-lg-4 col-md-4'>
//                        <i class='fa fa-plus'></i> เแก้ไขข้อมูลห้อง</button>";
//                        } else {
//                            echo "<button type='submit' name='insertRoom' class='btn btn-primary col-4 col-sm-4 col-lg-4 col-md-4'>
//                        <i class='fa fa-plus'></i> เพิ่มห้อง</button>";
//                        }
//                        ?>
<!--                        <span style="margin: 10px"></span>-->
<!--                        <button onclick="window.location = '_room.php'" type="button"-->
<!--                                class="btn btn-danger col-4 col-sm-4 col-lg-4 col-md-4 "><i class="fa fa-times"></i>-->
<!--                            ยกเลิก-->
<!--                        </button>-->
<!--                        <div class="col-2 col-sm-2 col-lg-2 col-md-2"></div>-->
<!---->
<!--                    </div>-->
                </div>
            </div>

            <div class="footer" align="center">

            </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>