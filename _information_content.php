<?php
include '__connect.php';
include '__checkSession.php';

?>
<p></p>
<!Document>
<html>
<head>
    <?php
    include '__header.php';
    ?>
</head>
<body>
<?php
include '_navbar_admin.php';
?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM information WHERE info_id = {$id}";
    $query = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($query);
?>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
    <div class="card">
        <form action="_information_content.php" method="post">

            <div class="card-header">
                <nav aria-label="breadcrumb  bg-dark">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="_information.php">ข่าวสาร</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $info['info_name']; ?></li>
                    </ol>
                </nav>
            </div>

            <div class="card-body">
                <?php echo base64_decode($info['info_content']); ?>
            </div>
        </form>
    </div>
</div>
</body>
</html>