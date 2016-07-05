<?php
  $supplier_id = $suppliers[0]['id'];
  $supplier_id = $supplier['id'];
  $address = $supplier['address'];
  $tel = $supplier['tel'];
?>
<script>
  var row = '<?=count($items)?>';
  function checkSum(row_no, price) {
    var quantity = $('#quantity_' + row_no).val() - 0;

    $('#sum_'+row_no).text(price * quantity);

    sumAll();
  }

  function sumAll() {
    var sum_all = 0;
    var tax = $('#tax').val();
    for (var i = 0; i <= 3 - 1; i++) {
      sum_all += $('#sum_'+i).text() - 0;
    }
    
    $('#sum_all').text(sum_all);
    var vat = sum_all * (tax / 100);

    var net = sum_all + vat;
    $('#net').text(net);
    $('#hidden_net').val(net);
  }

  function setSupplierById() {
    var id = $('#supplier').val();
    
    location.href = 'index.php?r=site/registerPurchase&id='+id;    
  }
</script>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">สร้างใบสั่งซื้อ</h1>
  </div>
</div>

<div class="container col-md-9">
  <form action="index.php?r=site/insertPurchase" class="form-horizontal" method="post">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ผู้จัดจำหน่าย</label>
      <div class="col-sm-10">
        <select name="supplier_id" id="supplier" class="form-control" onchange="setSupplierById()">
          <?php 
            if (!empty($suppliers)) :
              foreach ($suppliers as $supplier) : 
                $select = '';
                if ($supplier['id'] == $supplier_id) $select = 'selected';
                ?>
                <option value="<?=$supplier['id']?>" <?=$select?> > <?=$supplier['name']?></option>
          <?php
              endforeach; 
          ?>
          <?php else : ?>
            <option value=""></option>
          <?php endif; ?>          
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ที่อยู่</label>
      <div class="col-sm-4">
        <label id="address" for="inputEmail3" class="control-label"><?=$address?></label>
      </div>


      <label for="inputEmail3" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
      <div class="col-sm-4">
        <label id="tel" for="inputEmail3" class="control-label"><?=$tel?></label>
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
      <?php foreach ($items as $index => $item) : ?>
        <div class="form-group" id="row_#row_no#">
          <input type="hidden" name="data[<?=$index?>][id]" value="<?=$item['id']?>">
          <label for="inputEmail3" class="col-sm-1 control-label"><?=$index + 1?></label>
          <div class="col-sm-2">
            <label for="" class="control-label"><?=$item['code']?></label>
          </div>

          <div class="col-sm-3">
            <label for="" class="control-label"><?=$item['name']?></label>
          </div>
          
          <div class="col-sm-2">
            <label for="" class="control-label"><?=$item['price']?></label>
          </div>

          <div class="col-sm-2">
            <input id="quantity_<?=$index?>" name="data[<?=$index?>][quantity]" type="number" class="form-control" placeholder="Quantity" value="" onchange="checkSum(<?=$index?>, <?=$item['price']?>)">
          </div>

          <div class="col-sm-2">
            <label id="sum_<?=$index?>" required for="inputEmail3" class="control-label sum-all">0</label>
          </div>
        </div>
      <?php endforeach; ?>  
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
          <label id="sum_all" for="inputEmail3" class="control-label"></label>
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
          <input id="tax" type="number" class="form-control" name="tax" value="7" onchange="sumAll()">
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
          <label id="net" for="inputEmail3" class="control-label"> 0 </label>
          <input type="hidden" id="hidden_net" name="net">
        </div>

        <label for="inputEmail3" class="col-sm-1 control-label"> บาท </label>
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