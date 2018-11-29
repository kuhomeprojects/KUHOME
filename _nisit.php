<?php
include '__connect.php';
include '__checkSession.php';
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
    <script></script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>
<div class="container-fluid" style="margin-top: 10px;">

    <!--    <div class="jumbotron jumbotron-fluid" style='background-image: url("img/Gear-BG-4.jpg"); '>-->
    <div class="jumbotron jumbotron-fluid">
        <script>
            $(document).ready(()=>{
                $('#reportContentList').DataTable();
            })
        </script>


        <table id="reportContentList" class="table table-bordered rounded">
            <thead>
            <tr>
                <th>รหัสนิสิต</th>
                <th>ชื่อ</th>
                <th>เบอร์โทร</th>
                <th>คณะ</th>
                <th>สาขา</th>
                <th>ชั้นนปี</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sql = "SELECT * FROM `student`";
            $result = mysqli_query($conn, $sql);
            while ($temp = mysqli_fetch_array($result)) {
                ?>
                <tr>

                    <td><?php echo $temp['code'] ?></td>
                    <td><?php echo $temp['name'] ?></td>
                    <td><?php echo $temp['tel'] ?></td>
                    <td><?php echo $temp['department'] ?></td>
                    <td><?php echo $temp['major'] ?></td>
                    <td><?php echo $temp['level'] ?></td>
                    <td><a class="btn btn-sm btn-primary text-white" onclick="window.location ='_nisit_insert.php?code=<?php echo $temp['code']?>'"><i class="fa fa-list"></i> ดูรายละเอียด</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
     </div>

    </div>

</div>
</body>
</html>
