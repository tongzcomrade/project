<?php
  $id = '';
  $name = '';
  $description = '';
  if (!empty($item_type)) {
    $id = $item_type['id'];
    $name = $item_type['name'];
    $description = $item_type['description'];
  }
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">ลงทะเบียนประเภทอุปกรณ์</h1>
  </div>
</div>

<div class="container col-md-9">
  <form action="index.php?r=site/insertItemType" class="form-horizontal" method="post">
    <input name="id" type="hidden" value="<?=$id?>">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ชื่อรายการ</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="Name" value="<?=$name?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด</label>
      <div class="col-sm-10">
        <input name="description" type="text" class="form-control" placeholder="Description" value="<?=$description?>">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="ลงทะเบียน" class="btn btn-primary">
        <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
      </div>
    </div>
  </form>
</div>