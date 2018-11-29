<div class="row">

    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>ชื่อผุ้ใช้</label>
            <input name="updateUsername" id="updateUsername" class="form-control"
                   value="<?php echo $_SESSION['username']; ?>" disabled>
        </div>
    </div>

    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>ชื่อจริง-นามสกุล</label>
            <input name="updateName" id="updateName" class="form-control"
                   value="<?php echo $_SESSION['name']; ?>">
        </div>
    </div>

</div>

<div class="row">

    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>ตำแหน่ง</label>
            <input name="updateType" id="updateType" class="form-control"
                   value="<?php echo ''; ?>" disabled>
        </div>
    </div>

    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <input name="updateTel"
                   maxlength="20" id="updateTel" class="form-control"
                   value="<?php echo ''; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>สถานะการใช้าน</label>
            <input name="updateStatus" id="updateStatus" class="form-control"
                   value="<?php echo ''; ?>" disabled>
        </div>
    </div>
    <div class="col col-sm col-lg col-md">
    </div>
</div>
<div class="row">
    <div class="col col-sm col-lg col-md">
        <div class="form-group">
            <label>ที่อยู่</label>
            <textarea name="updateAddress"
                      id="updateAddress"
                      class="form-control"
                      value="<?php echo ''; ?>"></textarea>
        </div>
    </div>
</div>