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

        $(document).ready(() => {
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
                        <a href="_rules_insert.php">
                            <img src="img/rule.png" class="image" width="125" height="125">
                            <div class="overlay bg-info ">
                                <div class="text"> เพิ่ม/แก้ไขกฏเกณฑ์และข้อบังคับ</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area">
                        <a href="_score.php">
                            <img src="img/blacklist.png" class="image" width="125" height="125">
                            <div class="overlay bg-info ">
                                <div class="text"> หักคะแนน</div>
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

                <h5>กฏเกณฑ์และข้อบังคับ</h5>

            </nav>
        </div>
        <div class="card-body">
            <div style="width: 85%" class="mx-auto">
                <div class="table-responsive">
                    <table id="reportContentList" class="table table-bordered rounded">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รายละเอียด</th>
                            <th>คะแนน</th>
                            <th>หมายเหตุ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "select * from rule";
                        $count = 0;
                        $result = mysqli_query($conn, $sql);
                        while ($temp = mysqli_fetch_array($result)) {
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $temp['detail'] ?></td>
                                <td><?php echo $temp['score'] ?></td>
                                <td><?php echo $temp['remark'] ?></td>
                                <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_rules_insert.php?rule_no=<?php echo $temp['rule_no']?>'"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a></td>
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
</body>
</html>