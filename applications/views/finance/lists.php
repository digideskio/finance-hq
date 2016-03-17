<div class="col-sm-3"></div>
<div class="col-sm-6">
    <h3>ค้นหารายชื่อตาม ปี-เดือน</h3>
    <form action="<?=getUrl();?>finance/lists" method="post">
        <div class="form-group">
            <label for="date">ปี-เดือน</label>
            <input type="text" class="form-control" id="date" name="date" value="<?=$def_date;?>">
        </div>
        <div class="form-group">
            <label>ประเภทนายทหาร</label>
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" id="" name="type" value="1" <?php echo ( $def_type === 1 ) ? 'checked="checked"' : '' ;?>> นายทหาร
                </label>
                <label class="radio-inline">
                    <input type="radio" id="" name="type" value="2" <?php echo ( $def_type === 2 ) ? 'checked="checked"' : '' ;?>> นายสิบ
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
            <input type="hidden" name="search" value="search">
        </div>
    </form>
    <?php
    if( $search === 'search' ){
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>บัตรประชาชน</th>
                    <th>ยศ ชื่อ-สกุล</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $items as $key => $item ): ?>
                <tr>
                    <td><a href="<?=getUrl();?>finance/details/<?php echo $item['_id']->{'$id'};?>" target="_blank"><?=$item['A'];?></a></td>
                    <td><?=$item['B'];?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>