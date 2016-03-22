<div class="col-sm-4"></div>
<div class="col-sm-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>รายการใบจ่ายเงินเดือน</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $items as $key => $item ): ?>
            <tr>
                <td>
                    <?php
                    list($y, $m) = explode('-', $item['date_sheet']);
                    $monthTxt = $months[$m];
                    ?>
                    <a href="<?=getUrl();?>mainpage/details/<?php echo $item['_id']->{'$id'};?>" target="_blank"><?=$monthTxt.' '.$y;?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>