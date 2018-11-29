<nav class="navbar navbar-expand-lg navbar-dark bg-success " style="margin-top: 25px;">
    <a class="navbar-brand" href="index.php">KU Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="_nisit.php">รายชื่อนิสิต</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="_information.php">ประชาสัมพันธ์</a>
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
                    <a class="dropdown-item" data-toggle="modal" onclick="initReportModal()" data-target="#reportModal"><i class="fa fa-exclamation-triangle"></i> แจ้งปัญหา</a>
                    <a class="dropdown-item" data-toggle="modal"  onclick="initProfileModal()" data-target="#profileModal">
                        <i class="fa fa-user-circle-o"></i> Profile</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="__logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<nav class="fixed-bottom navbar navbar-expand-lg text-white navbar-light bg-success d-flex justify-content-center"
     style="margin-bottom: 10px;">
    <p class="lead">
    <center>
        KU Home
    </center>
    </p>
</nav>

<?php include '__report_modal.php'; ?>
<?php include '__profile_modal.php'; ?>