<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">รายการอุปกรณ์ทั้งหมด</h1>
  </div>
</div>
<div class="row">
  <table id="datatable" class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>รูปประกอบ</th>
        <th>ชื่อประเภทอุปกรณ์</th>
        <th>ประเภทอุปกรณ์</th>
        <th>จำนวนอุปกรณ์ทั้งหมด</th>
        <th>จำนวนอุปกรณ์ที่ส่งซ่อม</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list_items as $ind => $list_item) : ?>
          <tr>
            <td><?=$list_item['code']?></td>
            <td><img src="xxx.jpg"></td>
            <td><?=$list_item['name']?></td>
            <td><?=$list_item['item_type']?></td>
            <td><?=$list_item['count']?></td>
            <td>
              <a href="index.php?r=site/itemCopiesList&id=<?=$list_item['id']?>" class="btn btn-success btn-xs">
                ดูรายการ
              </a>

              <?php if(Yii::app()->session['Permission']['buyItem'] == '1') : ?>
              <div class="btn btn-success btn-xs item-add" data-id="<?=$list_item['id']?>">
                สั่งซื้ออุปกรณ์เพื่ม
              </div>
              <?php endif; ?>
              <div class="btn btn-info btn-xs item-edit" data-id="<?=$list_item['id']?>">
                แก้ไข
              </div>

              <div class="btn btn-danger btn-xs item-delete" data-id="<?=$list_item['id']?>">
                ลบรายการ
              </div>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
