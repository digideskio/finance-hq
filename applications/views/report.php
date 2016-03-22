<style type="text/css">
        
        table{
            width: 100%;
            border-spacing: 0;
            height: 100%;
        }
        td{
            padding: 1px 4px;
        }
        .t-contain{
            border: 1px solid #000000;
        }
        .tbr{
            border-right: 1px solid #000000;
        }
        .tbb{
            border-bottom: 1px solid #000000;
        }
        .tbl{
            border-left: 1px solid #000000;
        }
        .tbt{
            border-top: 1px solid #000000;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        .clear-padding{
            padding: 0;
        }
        .bold{
            font-weight: bold;
        }
        @media print{
            body{
                font-size: 12px;
                font-weight: normal;
            }
            .half-page{
                /*margin-top: 143px;*/
                margin-top: 123px;
            }
        }
    </style>
    <?php
    $i = 0;
    foreach( $items as $key => $item ){
        // dump($item);
        if( strlen($item['A']) === 13 ){
            
            $i++;
            $test_mod = $i % 2 ;
            
            $half_page = '';
            // เพิ่มช่องว่างให้ตารางตัวแรก
            if( $test_mod === 0 ){
                $half_page = 'half-page';
            }
            
            ?>
            <div class="test-big-contain <?=$half_page;?>">

            <table style="margin-bottom: 1em;" class="t-contain">
                <tbody>
                    <tr style="line-height: 30px;">
                        <td colspan="2" class="tbb clear-padding">
                            <table >
                                <tr>
                                    <td>ใบจ่ายเงินเดือนข้าราชการกองทัพบก</td>
                                    <td>หน่วย รพ.ค่ายสุรศักดิ์มนตรี</td>
                                    <td>วันที่จ่ายเงิน <?=$top_date;?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="clear-padding" width="85%">
                            <table>
                                <tr>
                                    <td class="clear-padding">
                                        <table>
                                            <tr>
                                                <td class="tbr text-center clear-padding">ยศ-นาม</td>
                                                <td class="tbr text-center clear-padding" width="13%">เงินเดือน</td>
                                                <td class="tbr text-center clear-padding" width="13%">เบิกลด/พ</td>
                                                <td class="tbr text-center clear-padding" width="13%">พสร./พอย.</td>
                                                <td class="tbr text-center clear-padding" width="13%">ฝ่าอัตราย</td>
                                                <td class="text-center clear-padding" width="13%">บุตร/ค่าเช่าบ้าน</td>
                                            </tr>
                                            <tr style="line-height: 30px;">
                                                <td class="tbr tbb">
                                                    <?=$item['B'];?>
                                                    <div class="text-right"><?=$item['A'];?></div>
                                                </td>
                                                <td class="tbr tbb text-right">
                                                    <?=$item['BK'];?>/<?=$item['BL'];?>
                                                    <div><?=toNumber($item['BM']);?></div>
                                                </td>
                                                <td class="tbr tbb text-right"><?=toNumber($item['BW']);?></td>
                                                <td class="tbr tbb text-right"><?=toNumber($item['BN']);?></td>
                                                <td class="tbr tbb text-right">ไม่มี</td>
                                                <td class="tbb tbb text-right"><?=toNumber($item['AB']);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="clear-padding">
                                        <table>
                                            <tr>
                                                <td class="text-right" width="12.5%">รายได้รวมสะสม</td>
                                                <td class="text-right" width="12.5%">ง/ด ตกเบิก</td>
                                                <td class="text-right" width="12.5%">เงินตำแหน่ง</td>
                                                <td class="text-right" width="12.5%">กบข เพิ่ม</td>
                                                <td class="text-right" width="12.5%">ภาษี</td>
                                                <td class="text-right tbr" width="12.5%">กองทุน</td>
                                                <td class="text-center"rowspan="2" style="vertical-align: top;" width="25%">
                                                    <div>ลงชื่อ ผู้จ่ายเงิน</div>
                                                    <div class="text-left bold" style="line-height: 35px;">พ.ต.</div>
                                                    <div class="bold">( ชวนิต กะฐิน )</div>
                                                    <div class="bold">น.กง.รพ.ค่ายสุรศักดิ์มนตรี</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><?=toNumber($item['BX']);?></td>
                                                <td class="text-right">
                                                    <?php
                                                    if( $item['type'] == 2 ){
                                                        $brbs = $item['BR'] + $item['BS'];
                                                        echo toNumber($brbs);
                                                    }else{
                                                        echo toNumber($item['BS']);
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php
                                                    $BOBP = $item['BO'] + $item['BP'];
                                                    echo toNumber($BOBP);
                                                    ?>
                                                </td>
                                                <td class="text-right"><?=toNumber($item['CA']);?></td>
                                                <td class="text-right"><?=toNumber($item['BY']);?></td>
                                                <td class="tbr text-right"><?=toNumber($item['BZ']);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl clear-padding" width="15%">
                            <table>
                                <tbody>
                                    <tr width="20%">
                                        <td>เบิกสุทธิ</td>
                                        <td class="text-right"><?=toNumber($item['BM']);?></td>
                                    </tr>
                                    <tr>
                                        <td>หนี้สิน</td>
                                        <td class="text-right"><?=toNumber($item['BJ']);?></td>
                                    </tr>
                                    <tr>
                                        <td>จ่ายสุทธิ</td>
                                        <td class="text-right bold"><?=toNumber($item['CD']);?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="tbt clear-padding">
                            <table>
                                <tr>
                                    <td class="tbr" width="10%">อทบ.(ป)</td>
                                    <td class="tbr" width="10%">อทบ.(ส)</td>
                                    <td class="tbr" width="10%">อทบ.(พ)</td>
                                    <td class="tbr" width="10%">อทบ.(บ)</td>
                                    <td class="tbr" width="10%">กู้เคหะ</td>
                                    <td class="tbr" width="10%">อัคคีภัย</td>
                                    <td class="tbr" width="10%">ณาปนกิจ</td>
                                    <td class="tbr" width="10%">กองทุนฯ 2</td>
                                    <td class="tbr" width="10%">สร.รวม</td>
                                    <td>สน.ทบ.</td>
                                </tr>
                                <tr>
                                    <td class="tbr text-right"><?=toNumber($item['Q']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['R']);?></td>
                                    <td class="tbr text-right">0.00</td>
                                    <td class="tbr text-right"><?=toNumber($item['T']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['V']);?></td>
                                    <td class="tbr text-right">0.00</td>
                                    <td class="tbr text-right"><?=toNumber($item['BC']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AW']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AZ']);?></td>
                                    <td class="text-right"><?=toNumber($item['AU']);?></td>
                                </tr>
                                <tr>
                                    <td class="tbb tbr"></td>
                                    <td class="tbb tbr"></td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr"></td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb">งวดที่</td>
                                </tr>
                                <tr>
                                    <td class="tbr">ขยะ</td>
                                    <td class="tbr">ออท.</td>
                                    <td class="tbr clear-padding">เวชสารแพทย์</td>
                                    <td class="tbr">น้ำประปา</td>
                                    <td class="tbr">สวัสดิการศพ</td>
                                    <td class="tbr">สหกรณ์ฯ</td>
                                    <td class="tbr">รสก.ทบ.</td>
                                    <td class="tbr">ไฟฟ้า</td>
                                    <td class="tbr">ธ.อาคารฯ</td>
                                    <td>UBC มทบ.</td>
                                </tr>
                                <tr>
                                    <td class="tbr text-right"><?=toNumber($item['AR']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AK']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AH']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AO']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['BH']);?></td>
                                    <td class="tbr text-right">
                                        <?php
                                        $C_T_I = $item['C'] + $item['D'] + $item['E'] + $item['F'] + $item['G'] + $item['H'] + $item['I'];
                                        echo toNumber($C_T_I);
                                        ?>
                                    </td>
                                    <td class="tbr text-right"><?=toNumber($item['AM']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AN']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['K']);?></td>
                                    <td class="text-right"><?=toNumber($item['AL']);?></td>
                                </tr>
                                <tr>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb tbr">งวดที่</td>
                                    <td class="tbb">งวดที่</td>
                                </tr>
                                <tr>
                                    <td class="tbr">ธ.ออมสิน</td>
                                    <td class="tbr">ธ.กรุงไทย</td>
                                    <td class="tbr">A.I.A</td>
                                    <td class="tbr">โครงการสิน</td>
                                    <td class="tbr">ชุมชน รพฯ</td>
                                    <td class="tbr clear-padding">กะฐิน มทบ.32</td>
                                    <td class="tbr">กองทุน 1</td>
                                    <td class="tbr">ฟินันซ่า</td>
                                    <td class="tbr">อาคเนย์</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="tbr text-right"><?=toNumber($item['L']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AA']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AD']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['O']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['BA']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AT']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AV']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AX']);?></td>
                                    <td class="tbr text-right"><?=toNumber($item['AY']);?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class="tbr">งวดที่</td>
                                    <td class=""></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            
            <?php 
            // ตัดขึ้นหน้าใหม่
            if( $test_mod === 0 ){
            ?>
            <div style="page-break-after: always;"></div>
            <?php
            }
        }

    }