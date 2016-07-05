<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Bootstrap Admin Theme</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Datatable Css -->
  <link rel="stylesheet" type="text/css" href="css/datatable/css/dataTables.bootstrap.min.css">

  <!-- MetisMenu CSS -->
  <link href="css/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

  <!-- Timeline CSS -->
  <link href="css/dist/css/timeline.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="css/bower_components/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="css/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- jQuery -->
  <script src="css/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

  <!-- Morris Charts JavaScript -->
  <!-- <script src="css/bower_components/raphael/raphael-min.js"></script>
  <script src="css/bower_components/morrisjs/morris.min.js"></script>
  <script src="css/js/morris-data.js"></script> -->

  <!-- Custom Theme JavaScript -->
  <script src="css/dist/js/sb-admin-2.js"></script>

  <!-- Datatable Js -->
  <script src="css/datatable/js/jquery.dataTables.min.js"></script>
  <script src="css/datatable/js/dataTables.bootstrap.min.js"></script>
  
  <link href="css/style.css" rel="stylesheet">

  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').dataTable( {
        "sPaginationType" : "full_numbers",// แสดงตัวแบ่งหน้า
        "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
        "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
        "bFilter": false, // แสดง search box
        //"sScrollY": '300px', // กำหนดความสูงของ ตาราง
        "stateSave": true,
        "oTableTools": {
          "sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น
          }
        } );
    });
  </script>
</head>
<?php
      /*echo '<pre>';
      print_r(Yii::app()->session['Permission']);
      echo '</pre>';
      //exit();*/
?>
<body>
  <?php
    // set variable
    $user = Yii::app()->session['User'];
    $email = '';
    $password = '';

    if (!empty(Yii::app()->session['tempData']['email'])) {
      $email = yii::app()->session['tempData']['email'];
    }

  ?>

  <?php if (!empty($user['id'])) : 
    if (!empty(Yii::app()->session['successMsg']['message'])) : ?>
    <!-- have error message -->
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="glyphicon glyphicon-check"></i>  <strong><?=Yii::app()->session['successMsg']['message']?></strong>
        </div>
      </div>
    </div>
  <?php unset($_SESSION['successMsg']); endif; ?>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">ระบบจัดการฟิตเนส</a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
          <li>
            <?=$user['name'].' ('.ucwords($user['role']).') '?>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <!-- <li>
                <a href="#">
                  <i class="fa fa-user fa-fw"></i> 
                  User Profile
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-gear fa-fw"></i> 
                  Settings
                </a>
              </li>
              <li class="divider"></li> -->
              <li>
                <a href="index.php?r=site/logout">
                  <i class="fa fa-sign-out fa-fw"></i> Logout
                </a>
              </li>
            </ul>
          </li>
        </ul>

        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li class="sidebar-search">
                <div class="input-group custom-search-form">
                  <input type="text" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
                </div>
              </li>

              <!-- homepage -->
              <li>
                <a href="index.php?r=site/index">
                  <i class="glyphicon glyphicon-home"></i> 
                  หน้าเว็บไซต์
                </a>
              </li>
              <!-- service -->
              <?php if (Helper::ifAllowMenu('cashier') || Helper::ifAllowMenu('refill_credit')) : ?>
                <li>
                  <a href="index.php?r=site/mainService">
                    <i class="glyphicon glyphicon-home"></i> 
                    บริการหลัก
                  </a>
                </li>
              <?php endif; ?>

              <!-- users -->
              <?php if (Helper::ifAllowMenu('view_users') || Helper::ifAllowMenu('register_users') || Yii::app()->session['User']['role_id'] == 1) : ?>   
                <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-user"></i> 
                    ข้อมูลผู้ใช้ระบบ <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <?php if (Helper::ifAllowMenu('register_users')) : ?>
                    <li>
                      <a href="index.php?r=site/registerUser">
                        <i class="glyphicon glyphicon-minus"></i>
                        ลงทะเบียนผู้ใช้ระบบ
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if (Helper::ifAllowMenu('view_users') || Yii::app()->session['User']['role_id'] == 1) : ?>
                    <li>
                      <a href="index.php?r=site/usersList">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการผู้ใช้ระบบ
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </li>
              <?php endif; ?>
              
              <!-- purchase -->
              <?php if (Helper::ifAllowMenu('create_purchase') ||
                        Helper::ifAllowMenu('approve_purchase') ||
                        Helper::ifAllowMenu('receive_item') ||
                        Helper::ifAllowMenu('print_purchase')) : ?>
                <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-shopping-cart"></i> 
                    ข้อมูลการจัดซื้อ <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <?php if (Helper::ifAllowMenu('create_purchase')) : ?>
                    <li>
                      <a href="index.php?r=site/registerPurchase">
                        <i class="glyphicon glyphicon-minus"></i>
                        สร้างใบสั่งซื้อ
                      </a>
                    </li>
                    <?php endif; ?>
                    <li>
                      <a href="index.php?r=site/purchasesList">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการใบสั่งซื้อ
                      </a>
                    </li>
                    <?php if (Helper::ifAllowMenu('receive_item') && false) : ?>
                    <li>
                      <a href="index.php?r=site/itemReceive">
                        <i class="glyphicon glyphicon-minus"></i>
                        ตรวจรับสินค้า
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </li>
              <?php endif; ?>
              
              <!-- supplier -->
              <?php if (Helper::ifAllowMenu('managing_supplier')) : ?>
                <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-user"></i> 
                    จัดการผู้จำหน่าย <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="index.php?r=site/registerSupplier">
                        <i class="glyphicon glyphicon-minus"></i>
                        ลงทะเบียนผู้จำหน่าย
                      </a>
                    </li>
                    <li>
                      <a href="index.php?r=site/suppliersList">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการผู้จำหน่าย
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
              
              <!-- item -->
              <?php if (Helper::ifAllowMenu('managing_item')) : ?>
                <li>
                  <a href="#">
                    <i class="fa fa-book"></i> 
                    ข้อมูลอุปกรณ์ <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="index.php?r=site/registerItem">
                        <i class="glyphicon glyphicon-minus"></i>
                        ลงทะเบียนอุปกรณ์
                      </a>
                    </li>
                    <li>
                      <a href="index.php?r=site/itemTypesList">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการอุปกรณ์
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
              
              <!-- fix -->
              <?php if (!empty(Yii::app()->session['Permission']['fix_item']) || 
                        !empty(Yii::app()->session['Permission']['checkout_item'])) : ?>
                <li>
                  <a href="#">
                    <i class="fa fa-book"></i> 
                    ขัอมูลการแจ้งซ่อม </span>
                  </a>
                </li>
              <?php endif; ?>

              <!-- report -->
              <?php if (!empty(Yii::app()->session['Permission']['report'])) : ?>
                <li>
                  <a href="#">
                    <i class="fa fa-book"></i> 
                    รายงาน </span>
                  </a>
                </li>
              <?php endif; ?>

              <?php if (/*$user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 7 &&*/ false) : ?>
                <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-user"></i> 
                    จัดการพนักงาน <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="index.php?r=site/registerUser">
                        <i class="glyphicon glyphicon-minus"></i>
                        ลงทะเบียนพนักงาน
                      </a>
                    </li>
                    <li>
                      <a href="index.php?r=site/usersList">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการพนักงาน
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>

              <?php if (/*$user['role_id'] == 2 || $user['role_id'] == 7 &&*/ false) : ?>
                <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-folder-open"></i> 
                    รายงาน <span class="fa arrow"></span>
                  </a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="flot.html">
                        <i class="glyphicon glyphicon-minus"></i>
                        ลงทะเบียนพนักงาน
                      </a>
                    </li>
                    <li>
                      <a href="morris.html">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการพนักงาน
                      </a>
                    </li>
                    <li>
                      <a href="morris.html">
                        <i class="glyphicon glyphicon-minus"></i>
                        รายการกลุ่มผู้ใช้งาน
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Contents -->
      <div id="page-wrapper">
        <?=$content?>
      </div>
    </div>
  <?php else: 
    if (!empty(Yii::app()->session['errorMsg']['message'])) :
  ?>
    <!-- have error message -->
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="glyphicon glyphicon-remove"></i>  <strong><?=Yii::app()->session['errorMsg']['message']?></strong>
        </div>
      </div>
    </div>
  <?php unset($_SESSION['errorMsg']); endif; ?>
  
    <!-- Login Form -->
    <div class="container">
        <div class="row" style="text-align: center">
          <h2 style="margin-top: 100px"> เข้าสู่หน้าจัดการของระบบจัดการฟิตเนส </h2>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top: -20px">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form action="index.php?r=site/login" method="post">
                            <fieldset>
                                <div class="form-group">
                                      <input class="form-control" placeholder="E-mail" name="email" type="email"  value="<?=$email?>" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="<?=$password?>">
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php endif; ?>
</body>
</html>

  