<?php
include '__connect.php';
include '__checkSession.php';
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
    <script>

    </script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb  bg-dark">
                <h5><i class="fa fa-star"></i> จัดการการจอง</h5>
            </nav>
        </div>
        <div class="card-body">

            <div class="row" align="center">
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area">
                        <a href="_information_create.php"> <img src="img/menu/booking.png" class="image"
                                                                width="125" height="125">
                            <div class="overlay bg-info ">
                                <div class="text"> เพิ่มช่วงจองหอ</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area ">
                        <a data-toggle="modal" data-target="#reportModal"> <img src="img/menu/booked.png" class=" image"
                                                                                width="125" height="125">
                            <div class="overlay bg-secondary ">
                                <div class="text"> ดูรายการจอง</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer bg-warning text-white">
        </div>
    </div>
</div>


<div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb  bg-dark">
                <h5><i class="fa fa-star"></i> จัดการการจอง</h5>
            </nav>
        </div>
        <div class="card-body">
            

        </div>
        <div class="footer bg-warning text-white">
        </div>
    </div>
</div>

</body>
</html>
