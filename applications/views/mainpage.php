<div class="col-sm-4"></div>
<div class="col-sm-4">
    <div>
        <form action="<?=getUrl();?>mainpage/search" method="post">
            <div class="form-group">
                <label for="username">ค้นหาข้อมูลจากบัตรประชาชน</label>
                <input type="text" class="form-control" id="idcard" name="idcard" placeholder="เลขบัตรประชาชน">
            </div>
            <div class="form-group">
                <?php
                $msg = Session_Helper::get('x_msg');
                if( $msg !== false ){
                    ?>
                    <div class="form-group">
                        <p class="text-warning"><?=$msg;?></p>
                    </div>
                    <?php
                    Session_Helper::set('x_msg', false);
                }
                ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
            </div>
            <div class="col-sm-12">
                <span class="label label-default">แนะนำ</span> <a href="<?=getUrl();?>help" target="_blank">การตั้งค่าเพื่อพิมพ์ใบจ่ายเงินเดือน</a>
            </div>
        </form>
        
    </div>
</div>