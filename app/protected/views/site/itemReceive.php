<script>

</script>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">รับสินค้า</h1>
  </div>
</div>

<div class="container col-md-9">
  <form action="index.php?r=site/confirmReceive" class="form-horizontal" method="post">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ผู้จัดจำหน่าย</label>
      <div class="col-sm-10">
        <label id="name" for="inputEmail3" class="control-label"><?=$purchases[0]['supplier_name']?></label>
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ที่อยู่</label>
      <div class="col-sm-4">
        <label id="address" for="inputEmail3" class="control-label"><?=$purchases[0]['supplier_address']?></label>
      </div>


      <label for="inputEmail3" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
      <div class="col-sm-4">
        <label id="tel" for="inputEmail3" class="control-label"><?=$purchases[0]['supplier_tel']?></label>
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">รายการสั่งซื้อ</label>
      <div class="col-sm-10">
        <label id="tel" for="inputEmail3" class="control-label"></label>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="form-group" id="row_header">
        <label for="inputEmail3" class="col-sm-1 control-label">ลำดับ</label>
        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">รหัสสินค้า</label>
        </div>
        
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label">ชื่อรายการ</label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">ราคา</label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">จำนวน</label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">ราคารวม</label>
        </div>
      </div>

      <div id="list_items">
        <?php $sum = 0; foreach ($purchases as $index => $purchase) : ?>
        <input type="hidden" name="data[<?=$index?>][item_id]" value="<?=$purchase['item_id']?>">
        <input type="hidden" name="data[<?=$index?>][quantity]" value="<?=$purchase['quantity']?>">
        <input type="hidden" name="purchase_id" value="<?=$purchase['purchase_id']?>">
        <div class="form-group" id="row_#row_no#">
          <label for="inputEmail3" class="col-sm-1 control-label"><?=$index + 1?></label>
          <div class="col-sm-2">
            <label for="" class="control-label"><?=$purchase['item_code']?></label>
          </div>

          <div class="col-sm-3">
            <label for="" class="control-label"><?=$purchase['name']?></label>
          </div>
          
          <div class="col-sm-2">
            <label for="" class="control-label"><?=$purchase['price']?></label>
          </div>

          <div class="col-sm-2">
            <label for="" class="control-label"><?=$purchase['quantity']?></label>
          </div>

          <div class="col-sm-2">
            <label id="sum_<?=$index?>" required for="inputEmail3" class="control-label sum-all">
            <?=((int)$purchase['price']*(int)$purchase['quantity'])?>
            </label>
          </div>
        </div>
      <?php $sum += ((int)$purchase['price']*(int)$purchase['quantity']); endforeach; ?>  
      </div>
      
      <!-- row footer -->
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>
        
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">รวม</label>
        </div>

        <div class="col-sm-2">
          <label id="sum_all" for="inputEmail3" class="control-label"><?=$sum?></label>
        </div>

        <label for="inputEmail3" class="col-sm-1 control-label"> บาท </label>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>
        
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">ภาษี</label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label"><?=$purchases[0]['tax']?></label>
        </div>

        <label for="inputEmail3" class="col-sm-1 control-label"> % </label>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>
        
        <div class="col-sm-3">
          <label for="inputEmail3" class="control-label"></label>
        </div>

        <div class="col-sm-2">
          <label for="inputEmail3" class="control-label">รวมสุทธิ</label>
        </div>

        <div class="col-sm-2">
          <label id="net" for="inputEmail3" class="control-label"> <?=$purchases[0]['net']?> </label>
        </div>

        <label for="inputEmail3" class="col-sm-1 control-label"> บาท </label>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" onclick="confirm('ยินยันกรทำรายการ')" value="ลงทะเบียน" class="btn btn-primary">
        <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
      </div>
    </div>
  </form>
</div>