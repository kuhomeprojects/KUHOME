<?php
include '__connect.php';
include '__checkSession.php';

if($_SESSION['userType'] == 'S'){
    header("Location: _home.php");
}
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

                <?php
                if($_SESSION['userType']=='A'){
                ?>
                <a class="btn btn-sm btn-primary text-white" style="float: left" onclick="window.location = '_tower_insert.php'"><i class="fa fa-plus"></i> เพิ่มข้อมมูลหอพัก</a>

                    <?php
                }
                ?>
                <div class="table-responsive">
                    <hr>
                <table id="reportContentList" class="table table-bordered rounded">
                    <thead>
                    <tr>
                        <th>ชื่อหอพัก</th>
                        <th>เบอร์โทร</th>
                        <th>สถานะ</th>
                        <th>ห้องพัก</th>

                        <?php
                        if($_SESSION['userType']=='A'){
                        ?>  <th></th> <?php }?>
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

                            <?php
                            if($_SESSION['userType']=='A'){
                            ?> <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_tower_insert.php?tower_no=<?php echo $temp['tower_no']?>&type=<?php echo $temp['type']?>'"><i class="fa fa-edit"></i> แก้ไขหอพัก</a></td><?php }?>
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

</body>
</html>
