<div class="col-sm-3"></div>
<div class="col-sm-6">
    <h3>สถานะการอนุมัติ</h3>
    <?php
    // if( $search === 'search' ){
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ยศ ชื่อ</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $users as $key => $item ): ?>
                <tr>
                    <td><?=$item['rank'].' '.$item['firstname'];?></td>
                    <td>
                    <?php
                        if( $item['status'] === 'approve' ){
                            ?><p class="text-success">อนุมัติ</p><?php
                        }else{
                            ?><p class="text-danger">ยังไม่อนุมัติ</p><?php
                        }
                    ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    // }
    ?>
</div>