<script>

    function openModal(startDate,endDate,semester,towerNo,year,towerType){
        openBookingInfo = {
            startDate:startDate,
            endDate:endDate,
            semester:semester,
            towerNo:Number(towerNo),
            year:year,
            towerType:towerType
        }
        for(let key in openBookingInfo){

            $("#"+key).val(openBookingInfo[key]);
        }
        setTowerList();
        console.log(openBookingInfo);
        $("#editBookingModal").modal();
    }
    function editBooking(){

    }

</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 150px;">
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb  bg-dark">
                <h5><i class="fa fa-star"></i> จัดการการจอง</h5>
            </nav>
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-bordered rounded text-center" id="bookingTable">
                    <thead class="bg-warning">
                    <tr >
                        <th>ลำดับ</th>
                        <th>หอพัก</th>
                        <th>หมายเลข</th>
                        <th>เวลาเปิดจอง</th>
                        <th>เวลาปิดจอง</th>
                        <th>ปีการศึกษา</th>
                        <th>เทอม</th>
                        <th>จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 0;
                    $sql = "SELECT b.*,s.full_semester,t.full_status FROM BOOKING b INNER join semeter_detail s ON b.semester = s.semester INNER join status t on t.status = b.tower_type";
                    $result = mysqli_query($conn, $sql);
                    while ($temp = mysqli_fetch_array($result)) {
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $temp['full_status'] ?></td>
                            <td><?php echo $temp['tower_no'] ?></td>
                            <td><?php echo $temp['start_date'] ?></td>
                            <td><?php echo $temp['end_date'] ?></td>
                            <td><?php echo $temp['full_semester'] ?></td>
                            <td><?php echo $temp['year'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info"
                                onclick="openModal(
                                '<?php echo $temp['start_date']; ?>',
                                '<?php echo $temp['end_date']; ?>',
                                '<?php echo $temp['semester']; ?>',
                                '<?php echo $temp['tower_no']; ?>',
                                '<?php echo $temp['year']; ?>',
                                '<?php echo $temp['tower_type']; ?>')"><i class="fa fa-edit"></i> แก้ไข</button>
                                <button class="btn btn-sm btn-outline-warning"><i class="fa fa-trash"></i> ลบ</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form >
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookingModalLabel"><i class="fa fa-users"></i> แก้ไขข้อมูลการจอง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
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
                                            <select class="form-control" id="towerType" name="towerType" onchange="setTowerList()"
                                                    required>
                                                <option value="M"> หอชาย</option>
                                                <option value="F"> หอหญิง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">หอที่เปิด</label>
                                            <select class="form-control" id="towerNo" name="towerNo" onchange=" validateButton()"
                                                    required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> ปิด
                    </button>
                    <button type="button" class="btn btn-primary" id="editButton" onclick="editBooking()"><i
                                class="fa fa-save"></i>
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>