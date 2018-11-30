<?php
include '__connect.php';
include '__checkSession.php';

if(isset($_POST['insertBooking'])){

}
?>
<!Document>
<html>

<head>
    <?php include '__header.php'; ?>
    <script>
        let towerList =[];

        $(document).ready(() => {

            $.get('SQL_Select/selectTowerList.php',r=>{
                towerList = JSON.parse(r);

                setTowerList();
                console.log(towerList);
            });
            let year = new Date().getFullYear() + 543;
            let yearList = '';
            for (let i = 0; i < 5; i++) {
                let y = Number(Number(year) + i);
                yearList += "<option value='"+y+"'>" + y + "</option>"
            }
            $("#year").html(yearList);
            $('#startDate').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy'
            });
            $('#endDate').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy'
            });
            validateButton()
        });
        function setTowerList(){
            let type = $('#towerType').val();
            let list = towerList.filter(f=>f.type==type);
            let html = '';
            for(let tower of list){
                html += '<option value="'+tower.tower_no+'">'+tower.tower_no+'</option>'
            }
            $('#towerNo').html(html);
        }
        let openBookingInfo={
            startDate:"",
            endDate:"",
            year:"",
            towerType:"",
            towerNo:""
        }
        function validateButton(){
            let valid = true;
            for(let key in openBookingInfo){
                openBookingInfo[key] = $('#'+key).val();
                if(openBookingInfo[key]==''){
                    valid = false;
                }
            }
            if(!valid) $("#submitBtn").attr('disabled','disabled');
            else  $("#submitBtn").removeAttr('disabled');


        }

        function validateDateBooking() {
            let startDateTxt = setDateToActualFormat($('#startDate').val());
            let endDateTxt = setDateToActualFormat($('#endDate').val());
            let startDate = new Date(startDateTxt).setHours(0, 0, 0, 0);
            let endDate = new Date(endDateTxt).setHours(0, 0, 0, 0);
            console.log(startDate);
            console.log(endDate);
            if (endDate < startDate) {
                alert('ระบุวันที่ติดตั้งไม่ถูกต้อง');
                $('#endDate').val('');
                console.log(serviceDetail);
            }
            validateButton()
        }

        function setDateToActualFormat(date) {
            return date.substr(3, 2) + "/" + date.substr(0, 2) + '/' + date.substr(6, 4);
        }
    </script>
</head>
<body>
<?php
include '__navbar_admin.php';
?>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
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

<form class="simple-form">
    <div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb  bg-dark">
                    <h5><i class="fa fa-star"></i> จัดการการจอง</h5>
                </nav>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">

                        <div class="col col-sm col-md col-lg">
                            <div class="form-group">
                                <label class="font-weight-bold">วันที่เริ่มจอง</label>
                                <input id="startDate" class="form-control" name="startDate" required readonly>

                            </div>
                        </div>
                        <div class="col col-sm col-md col-lg">
                            <div class="form-group">
                                <label class="font-weight-bold">วันที่สิ้นสุดการจอง</label>
                                <input id="endDate" class="form-control" name="endDate" onchange="validateDateBooking()"
                                       required readonly>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col col-sm col-md col-lg">
                            <div class="form-group">
                                <label class="font-weight-bold">ปีการศึกษา</label>
                                <select class="form-control" id="year" name="year" required>
                                </select>
                            </div>
                        </div>
                        <div class="col col-sm col-md col-lg">
                            <div class="form-group">
                                <label class="font-weight-bold">เทอม</label>
                                <select class="form-control" id="semester" name="semester" required>
                                    <option value="1">ภาคต้น</option>
                                    <option value="2">ภาคปลาย</option>
                                    <option value="3">ฤดูร้อน</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">ประเภทหอพัก</label>
                                <select class="form-control" id="towerType" name="towerType" onchange="setTowerList()" required>
                                    <option value="M"> หอชาย</option>
                                    <option value="F"> หอหญิง</option>
                                </select>
                            </div>
                        </div><div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">หอที่เปิด</label>
                                <select class="form-control" id="towerNo" name="towerNo" onchange=" validateButton()" required>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer" align="center">
                <button class="btn btn-sm btn-outline-success" id="submitBtn" name="insertBooking" style="margin: 10px"><i class="fa fa-check"></i> เปิดการจอง</button>
            </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>
