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

                <h5>ข้อมูลห้องพัก</h5>

            </nav>
        </div>
        <div class="card-body">
            <div style="width: 85%" class="mx-auto">

                <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_room_insert.php?tower_no=<?php echo $_GET['tower_no']?>&type=<?php echo $_GET['type']?>'"><i class="fa fa-search"></i>เพิ่มห้องพัก</a></td>
                <hr>

                <table id="reportContentList" class="table table-bordered rounded">
                    <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>เลขห้อง</th>
                        <th>จำนวนที่พักได้</th>
                        <th>สถานะ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $type = '';
                    if (isset($_GET['type'])&&isset($_GET['tower_no'])) {
                        $type = $_GET['type'];
                        $tower_no = $_GET['tower_no'];
                    }
                    $sql = "select * from room where tower_no like '%$tower_no%' AND type like '%$type%'";
                    $count = 0;
                    $result = mysqli_query($conn, $sql);
                    while ($temp = mysqli_fetch_array($result)) {
                        $count++;
                        if ($temp['status'] == 'Y'){
                            $temp['status'] = 'จองแล้ว';
                        }else if ($temp['status'] == 'N'){
                            $temp['status'] = 'ว่าง';
                        }else if ($temp['status'] == 'F'){
                            $temp['status'] = 'ปรับปรุง';
                        }
                        ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $temp['room_no'] ?></td>
                            <td><?php echo $temp['size'] ?></td>
                            <td><?php echo $temp['status'] ?></td>
                            <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_room_insert.php?tower_no=<?php echo $temp['tower_no']?>&room_no=<?php echo $temp['room_no']?>&type=<?php echo $_GET['type']?>'"><i class="fa fa-edit"></i> แก้ไขห้องพัก</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="footer bg-warning text-white">

        </div>
    </div>


</div>
</body>
</html>
