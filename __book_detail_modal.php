<?php
$sql = "SELECT b.*,type.full_status as tower_type,r.cost,s.full_status as payment_status FROM booking_detail b 
INNER JOIN STATUS type On type.status = b.type
INNER JOIN STATUS s ON s.status = b.status
INNER JOIN ROOM r ON r.room_no = b.room_no
WHERE student_code='".$_SESSION['code']."'";
$queryBookDetail = mysqli_query($conn,$sql);
$bookDetail = mysqli_fetch_assoc($queryBookDetail);

$c_date = date_create(date("Y-m-d"));
$r_date = date_create($bookDetail['book_date']);
$diff = date_diff($c_date, $r_date);
$day = $diff->format('%r%d');
echo $day;
?>
<form class="simple-form">
<div class="modal fade " id="bookDetailModal" tabindex="-1" role="dialog" aria-labelledby="bookDetailLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="bookDetailLabel"><i class="fa fa-print"></i> รายละเอียดการจอง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th class="bg-success text-center text-white" colspan="2">รายละเอียดการจอง</th>
                            </tr>
                            </thead>
                            <tr>
                                <th class="bg-success text-right text-white">ประเภท</th>
                                <td><?php echo $bookDetail['tower_type'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-right text-white">เลขตึก</th>
                                <td><?php echo $bookDetail['tower_no'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-right text-white">เลขห้อง</th>
                                <td><?php echo $bookDetail['room_no'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-right text-white">ราคา</th>
                                <td><?php echo $bookDetail['cost'] ?></td>
                            </tr>
                        </table>
                        <span class="text-danger"><i class="fa fa-exclamation-triangle"></i> กรุณาชำระเงินที่กองกิจการภายใน 7 วัน</span>
                    </div>
                </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> ปิด
                </button>

                <button type="button" class="btn btn-primary" onclick="insertReportProbelm()"><i
                        class="fa fa-check"></i>
                    พิมพ์ใบชำระเงิน
                </button>

            </div>
        </div>
    </div>
</div></form>