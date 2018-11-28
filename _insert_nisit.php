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
include '_navbar_admin.php';
?>
<div class="container-fluid" style="margin-top: 10px;">

    <div class="jumbotron jumbotron-fluid" style='background-image: url("img/Gear-BG-4.jpg"); '>

        <div class="row">

            <div class="col-4 col-lg-4 col-sm-4 col-md-4">
            </div>

            <div class="col-8 col-lg-8 col-sm-8 col-md-8">
                <div class="container">
                    <h1 class="display-3 font-weight-bold"></h1>
                </div>
            </div>

        </div>

    </div>

</div>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
    <div class="card">
        <form method="post">
            <div class="card-header">
                <nav aria-label="breadcrumb  bg-dark">
                    <h5><b><i class="fa fa-star"></i> กิจกรรมล่าสุด</b></h5>
                </nav>
            </div>
            <div class="card-body">
            </div>
            <div class="footer bg-info text-white">
                <div class="container-fluid text-right">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
