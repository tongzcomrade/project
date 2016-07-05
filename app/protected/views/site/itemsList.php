<script type="text/javascript">
  var type_id = '<?=$item_type_id?>';
  $(document).ready(function() {
    $('.item-add').click(function() {
      var cf = confirm('ยืนยันการเพื่มรายการสั่งซื้อ');
      if (cf != true) return;
      var id = $(this).data('id');
        $.ajax({
        url: 'index.php?r=site/addItemToCart',
        data: {
          id: id,
          type: type_id
        },
        type: 'post',
        success: function(response) {
          console.log(response);
          alert('เพื่มรายการสำเร็จ');
        }
      });
    });

    $('.item-edit').click(function() {
      var id = $(this).data('id');

      location.href = 'index.php?r=site/editItem&id=' + id;
    });

    $('.item-delete').click(function() {
      var cf = confirm('ยืนยันการลบรายการ');
      if (cf != true) return;
      var id = $(this).data('id');
        $.ajax({
        url: 'index.php?r=site/deleteItem',
        data: {
          id: id,
        },
        type: 'post',
        success: function(response) {
          $('#row_' + id).remove();
        }
      });
    });
  });
</script>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">รายการอุปกรณ์ประเภท : <?=$item_type?></h1>
  </div>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>รหัสอุปกรณ์</th>
        <th>รูปประกอบ</th>
        <th>ชื่ออุปกรณ์</th>
        <th>จำนวนทั้งหมด</th>
        <th>จำนวนที่ส่งซ่อม</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $ind => $item) : ?>
          <tr id="row_<?=$item['id']?>">
            <td><?=$item['code']?></td>
            <td><img src="xxx.jpg"></td>
            <td><?=$item['name']?></td>
            <td> 0 </td>
            <td> 0 </td>
            <td>
              <a href="index.php?r=site/itemCopiesList&id=<?=$item['id']?>" class="btn btn-success btn-xs">
                ดูรายการ
              </a>

              <?php if(Yii::app()->session['Permission']['buyItem'] == '1') : ?>
              <div class="btn btn-success btn-xs item-add" data-id="<?=$item['id']?>">
                สั่งซื้ออุปกรณ์เพื่ม
              </div>
              <?php endif; ?>
              <div class="btn btn-info btn-xs item-edit" data-id="<?=$item['id']?>">
                แก้ไข
              </div>

              <div class="btn btn-danger btn-xs item-delete" data-id="<?=$item['id']?>">
                ลบรายการ
              </div>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>