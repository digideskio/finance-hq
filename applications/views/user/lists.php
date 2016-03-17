<div class="col-sm-3"></div>
<div class="col-sm-6">
    <h3>ใบจ่ายเงินเดือนตาม ปี-เดือน</h3>
    <div class="col-sm-12">
        <span class="label label-default">แนะนำ</span> <a href="<?=getUrl();?>help" target="_blank">การตั้งค่าเพื่อพิมพ์ใบจ่ายเงินเดือน</a>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ปี-เดือน</th>
                <th>ยศ ชื่อ-สกุล</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $items as $key => $item ): ?>
            <tr>
                <td><?=$item['date_sheet'];?></td>
                <td><?=$item['B'];?></td>
                <td><a href="<?=getUrl();?>user/report/<?=$item['date_sheet'];?>">ดูข้อมูล</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>