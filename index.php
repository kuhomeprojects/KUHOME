<?php
include '__connect.php';
?>


<!DOCTYPE html>
<html>

<head>
    <?php include '__header.php'; ?>
    <style>
    </style>
</head>
<body>
<?php
$msg = "";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isAdmmin = $_POST['isAdmin'];
    $sql = '';
    if ($isAdmmin == 'Y') {
        $sql = "SELECT * FROM USER WHERE username='$username' AND password='$password'";
        $_SESSION['table'] = 'user';
    } elseif ($isAdmmin == 'N') {
        $sql = "SELECT * FROM student WHERE username='$username' AND password='$password'";
        $_SESSION['table'] = 'student';
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['type'] = $isAdmmin;
    } else {
        $msg = "<span class='text-danger'><i class='fa fa-times'></i> เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบ username/password อีกครั้ง</span>";
    }
    if ($isAdmmin == 'N') {
        $_SESSION['department'] = $row['department'];
        $_SESSION['teacher_name'] = $row['teacher_name'];
        $_SESSION['parent_tel'] = $row['parent_tel'];
        $_SESSION['parent_name'] = $row['parent_name'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['tel'] = $row['tel'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['level'] = $_row['level'];
        $_SESSION['major'] = $_row['major'];
        $_SESSION['sex'] = $_row['sex'];
        $_SESSION['birthdate'] = $_row['birthdate'];
    } elseif ($isAdmmin = 'Y') {
        $_SESSION['tel'] = $row['tel'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['position'] = $row['position'];
        //$_SESSION['picture'] = $row['picture'];
    }

}
if (isset($_SESSION['username'])) {
    header("location: _home.php");
}
?>
<script>
    $(document).ready(() => {
        $("#isAdmin").val('N');
    });

    function checkIsAdmin() {
        let isAdmin = $("#adminFlag")[0].checked;
        if (isAdmin) {
            $("#isAdmin").val('Y');
        } else {
            $("#isAdmin").val('N');
        }
        console.log($("#isAdmin").val());
    }
</script>

<div class="container" align="center" style="padding-top: 100px;">
    <div class="card" style="width: 500px;">
        <form method="post" action="index.php">
            <!--<img class="card-img-top"
                 width="" alt="Card image cap">-->
            <div class="card-footer">
                <div class="form-group" align="left">

                    <label> Username</label>
                    <input type="text" name="username" class="form-control" placeholder="" aria-label=""
                           aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="form-group" align="left">
                    <label> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" aria-label=""
                           aria-describedby="basic-addon1">
                    <?php echo $msg; ?>
                </div>
                <hr>
                <div align="right">
                    <input name="isAdmin" id="isAdmin" type="hidden">
                    <div
                            class="custom-control custom-checkbox" style="margin-top: 5px;">
                        <input type="checkbox" class="custom-control-input" id="adminFlag"
                               onclick="checkIsAdmin()">
                        <label class="custom-control-label" for="adminFlag"> ผู้ดูแลระบบ/รักษาความปลอดภัย</label>
                    </div>
                </div>
                <br>
                <button class="btn btn-info" type="submit"><i class="fa fa-sign-in"></i> Log in</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>