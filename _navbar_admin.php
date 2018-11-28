<nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="margin-top: 25px;">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="product.php">สินค้า</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="service.php">บริการติดตั้ง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="customer.php">ลูกค้า</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="import.php">นำเข้าสินค้า</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="report.php">ตรวจสอบ</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="news.php">ข่าวสารกิจกรรม</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="supplier.php">บริษัทนำเข้า/ตัวแทนจำหน่าย</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="account.php">ผู้ใช้ระบบ</a>
            </li>

        </ul>
        <ul class="navbar-nav">

            <li class="nav-item dropdown" style="cursor: pointer;">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo $_SESSION['username'];
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" data-toggle="modal" data-target="#reportModal"><i class="fa fa-exclamation-triangle"></i> แจ้งปัญหา</a>
                    <a class="dropdown-item" data-toggle="modal" onclick="initModal()" data-target="#profileModal">
                        <i class="fa fa-user-circle-o"></i> Profile</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="__logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<nav class="fixed-bottom navbar navbar-expand-lg text-white navbar-light bg-secondary d-flex justify-content-center"
     style="margin-bottom: 10px;">
    <p class="lead">
    <center>
        K.C.I. Engineering Management System version 1.0 (2018) Power by Computer Science KU KPS.
    </center>
    </p>
</nav>