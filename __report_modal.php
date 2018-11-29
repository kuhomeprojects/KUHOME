<script>
    let reportDetail = {
        room:"",
        tower:"",
        report_tel:"",
        report_content:"",
    }
    function initReportModal(){

        $("#report_tel").mask("999-9999999");
    }
    function insertReportProbelm(){
       let valid = true;
        for(let key in reportDetail){
            reportDetail[key] = $("#"+key).val();
            if( reportDetail[key] == ''){
                valid = false;
            }
       }

        if(!valid){
            alert('กรุณากรอกรายละเอียดให้ครบ!');
        }else{
            $.post('SQL_Insert/insertReport.php',reportDetail,r=>{
                console.log(r);
                if(r=='true'){
                    console.log(r);
                    alert('บันทึกการแจ้งเตือนสำเร็จ!');
                }else{
                    alert("ไม่สำเร็จ! มีบางอย่างผิพลาด กรุณาตรวจสอบอีกครั้ง")
                }
            });
            $("#reportContent").val('');
            location.reload();
        }
    }
</script>

<div class="modal fade " id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel"><i class="fa fa-users"></i> แจ้งปัญหา/ข้อขัดข้อง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col col-sm-3 col-md-3 col-xs-3 col-lg-3">

                        <div class="form-group">
                            <label><strong>ตึก</strong></label>
                            <input class="form-control" id="tower" type="text" name="tower">
                        </div>
                    </div>
                    <div class="col col-sm-3 col-md-3 col-xs-3 col-lg-3">

                        <div class="form-group">
                            <label><strong>ห้อง</strong></label>
                            <input class="form-control" id="room" type="text" name="room">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-6 col-md-6 col-sm-6 col-lg-6">

                        <div class="form-group">
                            <label><strong>เบอร์ติดต่อ</strong></label>
                            <input class="form-control" id="report_tel" type="text" name="report_tel">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>รายละเอียด</strong></label>
                    <textarea name="report_content" id="report_content" class="form-control"></textarea>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> ปิด
                </button>

                <button type="button" class="btn btn-primary" onclick="insertReportProbelm()"><i
                        class="fa fa-check"></i>
                    แจ้งปัญหา
                </button>

            </div>
        </div>
    </div>
</div>