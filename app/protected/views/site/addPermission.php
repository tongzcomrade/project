<?php
  $status = [
    0 => [
      'value' => 0,
      'text' => 'ปิดการใช้งาน'
    ], 

    1 => [
      'value' => 1,
      'text' => 'เปิดการใช้งาน'
    ]
  ];
  $id = !empty($member['id']) ? $member['id'] : '';
  $code = !empty($member['code']) ? $member['code'] : '';
  $email = !empty($member['email']) ? $member['email'] : '';
  $fname = !empty($member['fname']) ? $member['fname'] : '';
  $lname = !empty($member['lname']) ? $member['lname'] : '';
  $name = $fname.' '.$lname;
  $tel = !empty($member['tel']) ? $member['tel'] : '';
  $address = !empty($member['address']) ? $member['address'] : '';
  $credit = !empty($member['credit']) ? $member['credit'] : 0;

  // permission
  $cashier = !empty($permission['cashier']) ? 'checked' : false;
  $refill_credit = !empty($permission['refill_credit']) ? 'checked' : false;
  $register_users = !empty($permission['register_users']) ? 'checked' : false;
  $view_users = !empty($permission['view_users']) ? 'checked' : false;
  $edit_users = !empty($permission['edit_users']) ? 'checked' : false;
  $create_purchase = !empty($permission['create_purchase']) ? 'checked' : false;
  $approve_purchase = !empty($permission['approve_purchase']) ? 'checked' : false;
  $receive_item = !empty($permission['receive_item']) ? 'checked' : false;
  $print_purchase = !empty($permission['print_purchase']) ? 'checked' : false;
  $fix_item = !empty($permission['fix_item']) ? 'checked' : false;
  $checkout_item = !empty($permission['checkout_item']) ? 'checked' : false;
  $managing_supplier = !empty($permission['managing_supplier']) ? 'checked' : false;
  $managing_item = !empty($permission['managing_item']) ? 'checked' : false;
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">ข้อมูลสมาชิก</h1>
  </div>
</div>

<form action="index.php?r=site/addPermission" class="form-horizontal" method="post">
  <div class="container col-md-9">
    <input name="user_id" type="hidden" value="<?=$id?>">
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">รหัสสมาชิก :</label>
      <div class="col-sm-10">
        <label for="inputEmail3" class="control-label"><?=$code?></label>
      </div>
    </div>
  
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ - นามสกุล</label>
      <div class="col-sm-10">
        <label for="inputEmail3" class="control-label"><?=$fname.' '.$lname?></label>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <label for="inputEmail3" class="control-label"><?=$email?></label>
      </div>
    </div>


    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
      <div class="col-sm-10">
        <label for="inputEmail3" class="control-label"><?=$tel?></label>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ที่อยู่</label>
      <div class="col-sm-10">
        <label for="inputEmail3" class="control-label"><?=$address?></label>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">เงินคงเหลือ</label>
      <div class="col-sm-4">
        <label for="inputEmail3" class="control-label"><?=$credit?> บาท</label>
        <?php if (!Yii::app()->session['User']['role_id'] == 1) : ?>
          <a href="" class="btn btn-link"> (ประวัติการเติม) </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ประเภทผู้ใช้</label>
      <div class="col-sm-4">
        <select name="user_type" data-id="<?=$member['id']?>" class="form-control user-change-role">
          <?php foreach($roles as $role) : 
            $selected = $member['role_id'] == $role['id'] ? 'selected' : '';
            ?>
            <option value="<?=$role['id'];?>" <?=$selected?> > <?=$role['name']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">สถานะการใช้งาน</label>
      <div class="col-sm-4">
        <select name="user_status" data-id="<?=$member['id']?>" class="form-control user-change-role">
          <?php foreach($status as $v) : 
            $selected = $member['status'] == $v['value'] ? 'selected' : '';
            ?>
            <option value="<?=$v['value'];?>" <?=$selected?> > <?=$v['text']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
    
  <?php if (Yii::app()->session['User']['role_id'] == 1) : ?>
  <div class="container col-md-12" style="background-color: #bbb">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label"><h4>สิทธิที่ใช้งานได้</h4></label>
      <div class="col-sm-10">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[refill_credit]" <?=$refill_credit?> > เติมเงิน
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[view_users]" <?=$view_users?> > ดูข้อมูลผู้ใช้ระบบ
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[register_users]" <?=$register_users?> > ลงทะเบียนสมาชิก
        </div>
        <div class="col-sm-4">
          <input type="checkbox" value="1" name="Permission[edit_users]" <?=$edit_users?> > แก้ไขข้อมูลสมาชิก
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[cashier]" <?=$cashier?> > รับชำระเงิน
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[fix_item]" <?=$fix_item?> > ซ่อมบำรุงอุปกรณ์
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[checkout_item]" <?=$checkout_item?> > จำหน่ายอุปกรณ์
        </div>
        <div class="col-sm-4">
          <input type="checkbox" value="1" name="Permission[managing_supplier]" <?=$managing_supplier?> > จัดการข้อมูลตัวแทนจำหน่าย
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[create_purchase]" <?=$create_purchase?> > สั่งซื้ออุปกรณ์
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[approve_purchase]" <?=$approve_purchase?> > อนุมัติการสั่งซื้อ
        </div>
        <div class="col-sm-2">
          <input type="checkbox" value="1" name="Permission[receive_item]" <?=$receive_item?> > ตรวจรับอุปกรณ์
        </div>
        <div class="col-sm-4">
          <input type="checkbox" value="1" name="Permission[print_purchase]" <?=$print_purchase?> > พิมพ์ใบสั่งซื้อ
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <div class="col-sm-4">
          <input type="checkbox" value="1" name="Permission[managing_item]" <?=$managing_item?> > จัดการข้อมูลอุปกรณ์
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
        </div>
      </div>
    </div>
  </div>

  <div class="container col-md-12" style="padding: 15px;padding-bottom: 30px; text-align: center">
        <input type="submit" value="บันทึก" class="btn btn-primary" onclick="confirm('ยืนยันการแก้ไข')">
        <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
        <a href="" class="btn btn-warning"> Reset Password</a>
  </div>
  <?php else : ?>
  <?php endif; ?>
</form>