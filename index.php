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
    $sql = "SELECT * FROM USER WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
    } else {
        $msg = "<span class='text-danger'><i class='fa fa-times'></i> เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบ username/password อีกครั้ง</span>";
    }


}
if (isset($_SESSION['username'])) {
    header("location: _home.php");
}
?>

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

                <br>
                <button class="btn btn-info" type="submit"><i class="fa fa-sign-in"></i> Log in</button>

            </div>
        </form>
    </div>
</div>
</body>
</html>