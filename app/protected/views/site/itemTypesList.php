<script type="text/javascript">
  $(document).ready(function() {
    $('.item_type-edit').click(function() {
      var id = $(this).data('id');

      location.href = 'index.php?r=site/editItemType&id=' + id;
    });

    $('.item_type-delete').click(function() {
      var cf = confirm('ยืนยันการลบรายการ');
      if (cf != true) return;
      var id = $(this).data('id');
        $.ajax({
        url: 'index.php?r=site/deleteItemType',
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
    <h1 class="page-header">รายการประเภทอุปกรณ์</h1>
  </div>
</div>
<div class="row">
  <a href="index.php?r=site/allItem" class="btn btn-link"> ดูอุปกรณ์ทั้งหมด </a>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>รหัส</th>
        <th>ชื่อประเภทอุปกรณ์</th>
        <th style="width: 150px">รายละเอียด</th>
        <th>จำนวนอุปกรณ์ทั้งหมด</th>
        <th>จำนวนอุปกรณ์ที่ส่งซ่อม</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($item_types as $ind => $item_type) : ?>
          <tr id="row_<?=$item_type['id']?>">
            <td><?=$ind+1?></td>
            <td><?=$item_type['code']?></td>
            <td><?=$item_type['name']?></td>
            <td><?=$item_type['description']?></td>
            <td> 0 </td>
            <td> 0 </td>
            <td>
              <a href="index.php?r=site/itemsList&item_type_id=<?=$item_type['id']?>" class="btn btn-success btn-xs"> ดูอุปกรณ์ </a>

              <div class="btn btn-info btn-xs item_type-edit" data-id="<?=$item_type['id']?>">
                แก้ไข
              </div>

              <div class="btn btn-danger btn-xs item_type-delete" data-id="<?=$item_type['id']?>">
                ลบรายการ
              </div>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>