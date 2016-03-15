<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>บก. การเงิน</title>

        <!-- Bootstrap core CSS -->
        <link href="<?=getUrl();?>assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?=getUrl();?>assets/js/jquery-1.12.1.min.js"></script>
        <script type="text/javascript" src="<?=getUrl();?>assets/js/bootstrap.min.js"></script>
    </head>

<body>
<style type="text/css">
    @media print{
        body{
            font-family: 'TH SarabunPSK';
            font-size: 16px;
        }
        #no-print{
            display: none;
        }
    }
    
</style>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=getUrl();?>">บก. การเงิน</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=getUrl();?>">หน้าหลัก</a></li>
                <?php if( $this->user === false ): ?>
                    <li><a href="<?=getUrl();?>user/form">เข้าสู่ระบบ</a></li>
                <?php else: ?>
                    <?php if( $this->user->level === 'admin' OR $this->user->level === 'super admin' ): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">เมนู <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=getUrl();?>finance/lists">รายการข้อมูล</a></li>
                            <li><a href="<?=getUrl();?>finance/form">เพิ่มข้อมูล</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ผู้ใช้งาน <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">แก้ไขข้อมูล</a></li>
                            <li><a href="#">แก้ไขรหัสผ่าน</a></li>
                            <li><a href="<?=getUrl();?>user/lists">ใบจ่ายเงินเดือน</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?=getUrl();?>user/logout">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>