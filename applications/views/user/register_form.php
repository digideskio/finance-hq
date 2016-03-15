<div class="col-sm-4"></div>
<form class="col-sm-4" action="<?=getUrl();?>user/register" method="post">
    <?php
    $msg = Session_Helper::get('x_msg');
    if( $msg !== false ){
        ?>
        <div class="form-group">
            <p class="text-success"><?=$msg;?></p>
        </div>
        <?php
        Session_Helper::set('x_msg', false);
    }
    ?>
    <div class="form-group">
        <label for="idcard">รหัสบัตรประชาชน</label>
        <input type="text" class="form-control" id="idcard" name="idcard" placeholder="Identification Number">
    </div>
    <div class="form-group">
        <label for="rank">ยศ</label>
        <select name="rank" id="rank" class="form-control">
            <option value="">เลือกชั้นยศ</option>
            <?php foreach( $ranks as $key => $rank ): ?>
            <option value="<?=$rank;?>"><?=$rank;?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="firstname">ชื่อ</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="lastname">นามสกุล</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
    </div>
    <div class="form-group">
        <label for="username">ชื่อผู้ใช้งาน</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <label for="password">รหัสผ่าน</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="confirm_password">ยืนยันรหัสผ่าน</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
    </div>
    <div class="form-group">
        <p class="text-muted">กรุณากรอกข้อมูลให้ครบถ้วน เมื่อสมัครเสร็จเรียบร้อยแล้วสามารถโทรแจ้งไปที่เบอร์ 6203 เพื่อให้เจ้าหน้าที่ยืนยันข้อมูล</p>
    </div>
    <div class="form-group">
        <p class="text-muted">คลิก <a href="<?=getUrl();?>user/approve">ที่นี่</a> เพื่อดูสถานะการอนุมัติล่าสุดได้</p>
    </div>
    
</form>
