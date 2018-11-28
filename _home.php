<?php
include 'connect.php';
include 'checkSession.php';
?>
<!Document>
<html>

<head>
    <?php include 'header.php'; ?>
    <script>

    </script>
</head>
<body>

<div class="container-fluid" style="margin-top: 10px;">

    <div class="jumbotron jumbotron-fluid" style='background-image: url("img/Gear-BG-4.jpg"); '>

        <div class="row">

            <div class="col-4 col-lg-4 col-sm-4 col-md-4">
                <img class=" float-right" src="img/KCI_logo-620x400.png" height="200">
            </div>

            <div class="col-8 col-lg-8 col-sm-8 col-md-8">
                <div class="container">
                    <h1 class="display-3 font-weight-bold">K.C.I Engineering</h1>
                    <p class="lead font-weight-bold text-dark"><i class="fa fa-map-pin"></i>  81/9 หมู่ 2 ตำบลสามโคก, อำเภอสามโคก จังหวัดปทุมธานี, 12160</p>
                    <p class="lead font-weight-bold text-success"><i class="fa fa-phone"></i> +66 (0) 2 979 1400-8</p>
                    <p class="lead font-weight-bold text-warning"><i class="fa fa-envelope"></i> kci@cranekci.com</p>
                </div>
            </div>

        </div>

    </div>

</div>

<?php

if($_SESSION['type']=='A'){
    include "navbar_admin.php";
    $sql = 'SELECT i.*,u.name from information i inner join user u on u.username = i.info_owner order by info_date desc limit 1';
    $query = mysqli_query($conn,$sql);
    $currentNew = mysqli_fetch_assoc($query);
}
?>
<div class="container-fluid"  style="margin-top: 10px; margin-bottom: 150px;" >
    <div class="card">
        <form action="newsCreatePage.php" method="post">
            <div class="card-header">
                <nav aria-label="breadcrumb  bg-dark">
                    <h5><b><i class="fa fa-star"></i> กิจกรรมล่าสุด</b></h5>
                </nav>
            </div>
            <div class="card-body">
                <?php echo base64_decode($currentNew['info_content']); ?>
            </div>
            <div class="footer bg-info text-white">
                <div class="container-fluid text-right">
                    <strong>ประกาศโดย</strong> <?php echo $currentNew['name'];  ?>
                    <strong>วันที่</strong> <?php echo $currentNew['info_date'];  ?>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
