<?php 
  $roles = Role::model()->findAll();
?>
<script type="text/javascript">
  var is_employee = '<?=$is_employee?>';
  $(document).ready(function() {
    $('.user-change-role').change(function() {
      var cf = confirm('ยืนยันการแก้ไขประเภทผู้ใช้งาน');
      if (cf != true) return;
      
      var user_id = $(this).data('id');
      var role_id = $(this).val();
      $.ajax({
        url: 'index.php?r=site/putRoleById',
        data: {
          user_id: user_id,
          role_id: role_id
        },
        type: 'post',
        success: function(response) {
          console.log(response);
        }
      });
    });

    $('.user-view').click(function() {
      var id = $(this).data('id');
      location.href = 'index.php?r=site/putPermission&id=' + id;  
    });

    $('.user-delete').click(function() {
      var cf = confirm('ยืนยันการลบรายการ');
      if (cf != true) return;
      var id = $(this).data('id');
      $.ajax({
        url: 'index.php?r=site/deleteUser',
        data: {
          id: id,
        },
        type: 'post',
        success: function(response) {
          $('#row_' + id).remove();
        }
      });
    });

    $('.user-edit').click(function() {
      var cf = confirm('ยืนยันการแก้ไขสถานะผู้ใช้งาน');
      if (cf != true) return;
      var status = $(this).data('status');
      var id = $(this).data('id');

      location.href = 'index.php?r=site/activeUser&id=' + id + '&status=' + status;  
    });
  });
</script>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"> รายการผู้ใช้ระบบ </h1>
  </div>
</div>
<div class="row">
  <form action="index.php?r=site/usersList" class="form-inline" method="post">
    <select name="role_id" id="" class="form-control">
      <option value=""> ประเภทผู้ใช้งานทั้งหมด </option>
      <?php foreach ($roles as $role) : ?>
        <option value="<?=$role->id?>"><?=$role->name?></option>
      <?php endforeach; ?>
    </select>

    <select name="cols" id="" class="form-control">
      <option value="">เลือก</option>
      <!-- <option value="">ทั้งหมด</option> -->
      <option value="code">รหัสสมาชิก</option>
      <option value="name">ชื่อ - นามสกุล</option>
      <option value="username">ชื่อผู้ใข้</option>
      <option value="tel">เบอร์โทร</option>
      <option value="status_name">สถานะผู้ใช้งาน</option>
    </select>

    <input name="search" type="text" class="form-control">

    <button class="btn btn-primary">
      <i class="glyphicon glyphicon-search"></i> ค้นหา
    </button>
  </form>
</div>
<hr>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>รหัสสมาชิก</th>
        <th>ชื่อ - นามสกุล</th>
        <th>ชื่อผู้ใช้</th>
        <th>เบอร์โทร</th>
        <th>ประเภทผู้ใช้งาน</th>
        <th>สถานะผู้ใช้งาน</th>    
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($members as $ind => $member) : ?>
          <tr id="row_<?=$member['id']?>">
            <td><?=$member['code']?></td>
            <td><?=$member['fname'].' '.$member['lname']?></td>
            <td><?=$member['username']?></td>
            <td><?=$member['tel']?></td>
            <td> 
              <?php if (Yii::app()->session['User']['role_id'] == 1 && false) : ?>
                <select data-id="<?=$member['id']?>" class="form-control user-change-role">
                  <?php foreach($roles as $role) : 
                    $selected = $member['role_id'] == $role->id ? 'selected' : '';
                    ?>
                    <option value="<?=$role->id;?>" <?=$selected?> > <?=$role->name?></option>
                  <?php endforeach; ?>
                </select>
              <?php else : ?>
                <?=$member['role'];?>
              <?php endif; ?>
            </td>
            <td>
              <?php if (Helper::ifAllowMenu('edit_users') && false) : ?>
                <?php if ($member['status'] == 1) : ?>
                  <div class="btn btn-success btn-xs user-edit" data-status="true" data-id="<?=$member['id']?>">
                    <?=$member['status_name']?>
                  </div>
                <?php else : ?>
                  <div class="btn btn-danger btn-xs user-edit" data-status="false" data-id="<?=$member['id']?>">
                    <?=$member['status_name']?>
                  </div>
                <?php endif; ?>
              <?php else : ?>
                <?php if ($member['status'] == 1) {
                        echo 'เปิดการใช้งาน';
                      } else {
                        echo 'ปิดใช้งาน';
                      }
                  ?>
              <?php endif; ?>
            </td>
            <td>
              <?php if (Yii::app()->session['User']['role_id'] == 1) : ?>
                <div class="btn btn-warning btn-xs user-view" data-id="<?=$member['id']?>">
                  กำหนดสิทธิ
                </div>
              <?php else : ?>
                <div class="btn btn-success btn-xs user-view" data-id="<?=$member['id']?>">
                  ดูรายละเอียด
                </div>
              <?php endif; ?>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>