<?php
include '__connect.php';
include '__checkSession.php';
?>
<!Document>
<html>

<head>
    <?php include '__header.php';

    $code = "";
    $name = "";
    $level = "";
    $major = "";
    $sex = "";
    $birthdate = "";
    $ID = "";
    $address = "";
    $tel = "";
    $picture = "";
    $parent_name = "";
    $teacher_name = "";
    $username = "";
    $password = "";
    $parent_tel = "";
    $department = "";

    if(isset($_GET['code'])){
        $code = $_GET['code'];
        //select data
        $sql = "SELECT * FROM `student` WHERE `code` = '$code'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $code = $row['code'];
            $name = $row['name'];
            list($firstName,$lastname) = explode(" ", $name);
            $level = $row['level'];
            $major = $row['major'];
            $sex = $row['sex'];
            $birthdate = $row['birthdate'];
            $ID = $row['ID'];
            $address = $row['address'];
            $tel = $row['tel'];
            $picture = $row['picture'];
            $showpicture = $row['picture'];
            $parent_name = $row['parent_name'];
            $teacher_name = $row['teacher_name'];
            $username = $row['username'];
            $password = $row['password'];
            $parent_tel = $row['parent_tel'];
            $department = $row['department'];
        }

    }
    if (isset($_POST['insertNisit'])) {
        $code = $_POST['code'];

        $firstName = trim($_POST['firstName']);
        $lastname = trim($_POST['lastName']);
        $name = $firstName." ".$lastname;

        $level = $_POST['level'];
        $major = $_POST['major'];
        $sex = $_POST['sex'];
        $birthdate = $_POST['birthdate'];
        $ID = $_POST['ID'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];

        if (isset($_FILES['picture'])) {
            $file = $_FILES['picture']['tmp_name'];
            $picture = addslashes(file_get_contents($file));
        }

        $parent_name = $_POST['parent_name'];
        $teacher_name = $_POST['teacher_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $parent_tel = $_POST['parent_tel'];
        $department = $_POST['department'];


        $sql = "INSERT INTO `student` (`code`, `name`, `level`, `major`, `sex`, `birthdate`, `ID`, `address`, `tel`, `picture`, `parent_name`, `teacher_name`, `username`, `password`, `parent_tel`, `department`) VALUES ('$code', '$name', '$level', '$major', '$sex', '$birthdate', '$ID', '$address', '$tel','$picture' ,'$parent_name', '$teacher_name', '$username', '$password', '$parent_tel', '$department');";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>สำเร็จ!</strong> แก้ไขข้อมูลลูกค้าแล้ว
                    </div>';
        } else {

        }
    }
    ?>

    <script>
        $(document).ready(function () {

            $('#birthdate').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy'
            });

            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    // label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    label = input.val();
                //  label = input.files[0].name;
                input.trigger('fileselect', [label]);
            });
            $('.btn-file :file').on('fileselect', function (event, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                if (input.length) {
                    input.val(log);
                } else {
                    // if (log) alert(log);
                }
            });
            function readURL(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(id).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                    readFile(input.files[0], function (e) {
                        // alert( e.target.result);
                    });
                }
            }
            function readFile(file, callback) {
                var reader = new FileReader();
                reader.onload = callback
                reader.readAsText(file);
            }
            $("#picture").change(function () {
                readURL(this, '#showpicture');
            });
        });


    </script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>
<div class="container-fluid" style="margin-top: 10px;">

    <!--    <div class="jumbotron jumbotron-fluid" style='background-image: url("img/Gear-BG-4.jpg"); '>-->
    <div class="jumbotron jumbotron-fluid">

        <div style="width: 60%" class="mx-auto">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" align="center">
                        <?php
                        if ($picture == ''){
                            echo '<img id="showpicture" src="img/profile.png" width="200" border="5">';
                        }else
                            echo '<img  width="200" border="5" src="data:image/jpeg;base64,'.base64_encode( $picture ).'" />';
                        ?>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                      <span class="btn btn-sm btn-default btn-file btn-outline-info"><i
                                                  class="fa fa-image"></i> เลือกรูปภาพ
                                           <input type="file" name="picture" id="picture" value="<?php echo $picture; ?>" >
                                      </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ชื่อเข้าใช้งาน :</label>
                            <input name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>รหัสผ่าน :</label>
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>">
                        </div>
                    </div>
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ยืนยันรหัสผ่าน :</label>
                            <input type="password" name="conPassword" id="conPassword" class="form-control" value="<?php echo $password; ?>">
                        </div>
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ชื่อ :</label>
                            <input name="firstName" id="firstName" class="form-control" value="<?php echo $firstName; ?>">
                        </div>
                    </div>
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>นามสกุล :</label>
                            <input name="lastName" id="lastName" class="form-control" value="<?php echo $lastname; ?>">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>วันเกิด :</label>
                            <input  name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>">
                        </div>
                    </div>
                    <div class="col col-sm col-lg col-md">
                        <label>เพศ :
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="sex" id="sex" value="m">
                                    </div>
                                </div>
                                <output type="text" class="form-control"> ชาย</output>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="sex" id="sex" value="f">
                                    </div>
                                </div>
                                <output type="text" class="form-control"> หญิง</output>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>รหัสบัตรประชาชน :</label>
                            <input name="ID" id="ID" class="form-control" value="<?php echo $ID; ?>">
                        </div>
                    </div>

                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์ :</label>
                            <input type="tel" name="tel" id="tel" class="form-control" value="<?php echo $tel; ?>">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ที่อยู่ :</label>
                            <textarea name="address" id="address" class="form-control"><?php echo $address; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ชื่อผู้ปกครอง :</label>
                            <input name="parent_name" id="parent_name" class="form-control" value="<?php echo $parent_name; ?>">
                        </div>
                    </div>
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>เบอร์ผู้ปกครอง :</label>
                            <input name="parent_tel" id="parent_tel" class="form-control" value="<?php echo $parent_tel; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>รหัสนิสิต :</label>
                            <input name="code" id="code" class="form-control" value="<?php echo $code; ?>">
                        </div>
                    </div>
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>หลักสูตร/คณะ :</label>
                            <input name="department" id="department" class="form-control" value="<?php echo $department; ?>">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>สาขา :</label>
                            <input name="major" id="major" class="form-control" value="<?php echo $major; ?>">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>ชั้นปีที่ :</label>
                            <input name="level" id="level" class="form-control" value="<?php echo $level; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm col-lg col-md">
                        <div class="form-group">
                            <label>ชื่ออาจารย์ที่ปรึกษา :</label>
                            <input name="teacher_name" id="teacher_name" class="form-control" value="<?php echo $teacher_name; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 col-sm-2 col-lg-2 col-md-2"></div>
                    <button type="submit" name="insertNisit" class="btn btn-primary col-4 col-sm-4 col-lg-4 col-md-4 "><i class="fa fa-plus"></i> เพิ่มข้อมูลนิสิต
                    </button><span style="margin: 10px"></span>
                    <button onclick="window.history.go(-1);" type="button" class="btn btn-danger col-4 col-sm-4 col-lg-4 col-md-4 " ><i class="fa fa-times"></i> ยกเลิก
                    </button>
                    <div class="col-2 col-sm-2 col-lg-2 col-md-2"></div>

                </div>

            </form>
        </div>

    </div>

</div>
</body>
</html>
