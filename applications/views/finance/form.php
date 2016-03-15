<div class="col-sm-4"></div>
<form class="col-sm-4" action="<?=getUrl();?>finance/save" method="post" enctype="multipart/form-data">
    <h3>หน้าเพิ่มข้อมูล</h3>
    <div class="form-group">
        <label for="date">ปี-เดือน</label>
        <?php
        $date = (date('Y') + 543).date('-m');
        ?>
        <input type="text" name="date" class="form-control" placeholder="ปี-เดือน" value="<?=$date;?>">
        <p class="text-primary">ตัวอย่าง 2558-12</p>
    </div>
    <div class="form-group">
        <label>ประเภทนายทหาร</label>
        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" id="" name="type" value="1"> นายทหาร
            </label>
            <label class="radio-inline">
                <input type="radio" id="" name="type" value="2"> นายสิบ
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="file">เลือกไฟล์</label>
        <input type="file" class="form-control" id="file" name="file">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
    </div>
</form>