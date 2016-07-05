<script type="text/javascript">
  $(document).ready(function() {
    $('.supplier-view').click(function() {
      var id = $(this).data('id');

      location.href = 'index.php?r=site/viewSupplier&id=' + id;
    });

    $('.supplier-delete').click(function() {
      var cf = confirm('ยืนยันการลบรายการ');
      if (cf != true) return;
      var id = $(this).data('id');
        $.ajax({
        url: 'index.php?r=site/deleteSupplier',
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
    <h1 class="page-header">ผู้จำหน่าย</h1>
  </div>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้จำหน่าย</th>
        <th>ที่อยู่</th>
        <th>เบอร์ติดต่อ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($suppliers as $ind => $supplier) : ?>
          <tr id="row_<?=$supplier['id']?>">
            <td><?=$ind+1?></td>
            <td><?=$supplier['name']?></td>
            <td><?=$supplier['address']?></td>
            <td><?=$supplier['tel']?></td>
            <td>
              <div class="btn btn-info btn-xs supplier-view" data-id="<?=$supplier['id']?>">
                ดูรายละเอียด
              </div>

              <div class="btn btn-danger btn-xs supplier-delete" data-id="<?=$supplier['id']?>">
                ลบรายการ
              </div>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>