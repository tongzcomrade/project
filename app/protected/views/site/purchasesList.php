<script type="text/javascript">
  function receiveProduct(id) {
    location.href = 'index.php?r=site/receiveProduct&id=' + id;
  }

  function approveDoc(id) {
    var cf = confirm('ยืนยันการอนุมัติ');
    if (cf != true) return;

    location.href = 'index.php?r=site/approvePurchase&id=' + id;
  }

  function canApprove(id) {
    var cf = confirm('ยืนยันการยกเลิก');
    if (cf != true) return;

    location.href = 'index.php?r=site/cancelApprove&id=' + id;
  }

  function unApprove(id) {
    var cf = confirm('ยืนยันการทำรายการ');
    if (cf != true) return;

    location.href = 'index.php?r=site/unApprove&id=' + id;
  }
</script>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">รายการใบสั่งซื้อ</h1>
  </div>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>เลขที่เอกสาร</th>
        <th>ผู้จำหน่าย</th>
        <th>สถานะ</th>
        <th>ราคารวม</th>
        <th>วันที่ทำรายการ</th>
        <?php if (Helper::ifAllowMenu('print_purchase')) : ?>
        <th>ดูเอกสาร</th>
        <?php endif; ?>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($lists as $ind => $list) : ?>
          <tr id="row_<?=$list['id']?>">
            <td><?=$ind+1?></td>
            <td><?=$list['doc_no']?></td>
            <td><?=$list['name']?></td>
            <td><?=$list['status']?></td>
            <td><?=$list['net']?></td>
            <td><?=$list['created']?></td>
            <?php if (Helper::ifAllowMenu('print_purchase')) : ?>
            <td> <a href="">#PDF#</a> </td>
            <?php endif; ?>
            <td>
              <?php if ($list['status'] == 'อนุมัติ' && Helper::ifAllowMenu('receive_item')) : ?>
                <div class="btn btn-primary btn-xs" onclick="receiveProduct(<?=$list['id']?>)" data-id="<?=$list['id']?>">
                  รับสินค้า
                </div>
              <?php endif; ?>
              <?php 
                if ($list['status'] != 'รับสินค้าแล้ว' && Helper::ifAllowMenu('approve_purchase')) : 
                  if ($list['status'] == 'รอการอนุมัติ'): ?>
                    <div class="btn btn-info btn-xs list-approve" onclick="approveDoc(<?=$list['id']?>)" data-id="<?=$list['id']?>">
                      อนุมัติรายการ
                    </div>
                    <div class="btn btn-danger btn-xs list-unApprove" onclick="unApprove(<?=$list['id']?>)" data-id="<?=$list['id']?>">
                      ไม่อนุมัติ
                    </div>
                  <?php else : ?>
                  <div class="btn btn-danger btn-xs list-cancelApprove" onclick="canApprove(<?=$list['id']?>)" data-id="<?=$list['id']?>">
                    ยกเลิกการอนุมัติ/ไม่อนุมัติ 
                  </div>
                <?php endif;
                endif; 
              ?>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>