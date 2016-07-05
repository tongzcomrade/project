<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">รายการประเภทอุปกรณ์</h1>
  </div>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>รหัสอุปกรณ์</th>
        <th>ชื่อประเภทอุปกรณ์</th>
        <th>สถานะ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($copies as $ind => $copy) : ?>
          <tr id="row_<?=$copy['id']?>">
            <td> <?=$copy['code'].'-'.$copy['ranking']?></td>
            <td> <?=$copy['name']?></td>
            <td> 
              <?php 
                if ($copy['status'] == 1) {
                  echo 'เปิดใช้งาน';
                }
                else if ($copy['status'] == 2) {
                  echo 'ซ่อมบำรุง';
                }
                else {
                  echo 'จำหน่าย';
                }
              ?>
            </td>
            <td>
              <div class="btn btn-danger btn-xs copy-delete" data-id="<?=$copy['id']?>">
                แจ้งซ่อม
              </div>
              <div class="btn btn-warning btn-xs copy-delete" data-id="<?=$copy['id']?>">
                จำหน่ายอุปกรณ์
              </div>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>