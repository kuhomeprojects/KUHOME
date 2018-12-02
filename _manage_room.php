<?php
include '__connect.php';
include '__checkSession.php';
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
</head>
<body>
<?php
include '__navbar_admin.php';
?>

<div class="container-fluid" style="margin-top: 20px; margin-bottom: 30px;">
    <div class="card">
        <div class="card-header bg-success text-white font-weight-bold"><i class="fa fa-star"></i>
            ข่าวสาร/แจ้งปัญหา
        </div>
        <div class="card-body">
            <div class="row" align="center">
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area">
                        <a href="_manage_room.php?manage_reserve"> <img src="img/room.png" class="image"
                                                                width="125" height="125">
                            <div class="overlay bg-primary ">
                                <div class="text"> จัดการการจอง</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=" col-3 col-sm col-md col-lg">
                    <div class="img-area ">
                        <a href="_manage_room.php?manage_bill"> <img src="img/bill.png"
                                                                                class=" image"
                                                                                width="125" height="125">
                            <div class="overlay bg-warning ">
                                <div class="text"> ชำระค่าน้ำค่าไฟ</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['manage_reserve'])) include '_manage_room_reserve.php';
elseif (isset($_GET['manage_bill'])) include '_manage_room_bill.php';
?>
</body>
</html>
