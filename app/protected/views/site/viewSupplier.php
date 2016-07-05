<script>
  var i = 0;
  var supplier_id = '<?=$supplier[0]['id']?>';
  $(document).ready(function() {
    $('#submit').click(function() {
      var cf = confirm('ยืนยันการทำรายการ ?');
      if (cf != true) return;

      submitForm();
    });

    $('#addRow').click(function() {
      addRow();
    });
  });

  function addRow() {
    var html = $('#temp_row').html();

    html = html.replace('#row#', i);
    html = html.replace('#row#', i+1);
    html = html.replace('#row#', i);
    html = html.replace('#row#', i);
    html = html.replace('#row#', i);
    html = html.replace('#row#', i);
    html = html.replace('#row#', i);

    $('#btn-control').prepend(html);
    i++;
  }

  function submitForm() {
    $.ajax({
      url: 'index.php?r=site/postSupplier',
      data: $('#form').serialize(),
      type: 'post',
      dataType: 'json',
      success: function(res) {
        if (res.completed == true) {
          location.href = 'index.php?r=site/itemTypesList';
        }
        else {
          console.log(res.msg);
        }
      },
    });
  }

  function addItem(row) {
    var cf = confirm('ยืนยันการเพิ่มรายการ');
    if (cf != true) return;
    var item_id = $('#item_' + row).val();
    var price = $('#price_' + row).val();

    $.ajax({
      url: 'index.php?r=site/addItemOfSupplier',
      data: {
        supplier_id: supplier_id,
        item_id: item_id,
        price: price
      },
      type: 'post',
      dataType: 'json',
      success: function(res) {
        if (res.completed == true) {
          console.log(res);
          //location.reload();
        }
        else {
          console.log(res.msg);
        }
      },
    });
  }

  function deleteRow(id) {
    var cf = confirm('ยืนยันการทำรายการ');
    if (cf != true) return;

    $.ajax({
      url: 'index.php?r=site/deleteItemOfSupplier',
      data: {
        id :id
      },
      type: 'post',
      dataType: 'json',
      success: function(res) {
        if (res.completed == true) {
          location.reload();
        }
        else {
          console.log(res.msg);
        }
      },
    });
  }

  function removeRow(row) {
    $('.item_row_' + row).remove();
  }
</script>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">ข้อมูลผู้จัดจำหน่าย</h1>
  </div>
</div>

<div class="container col-md-9">
  <form id="form" action="index.php?r=site/insertItem" class="form-horizontal" method="post">
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ข้อมูลทั่วไป</label>
      <div class="col-sm-5">
        <input name="supplier_name" type="text" class="form-control" placeholder="ชื่อตัวแทนจำหน่าย" value="<?=$supplier[0]['name']?>" disabled="">
      </div>
      
      <div id="type_name" class="col-sm-5">
        <input name="tel" type="text" class="form-control" placeholder="เบอร์ติดต่อ" value="<?=$supplier[0]['tel']?>" disabled>
      </div>

      <div id="description" class="col-sm-10 col-sm-offset-2" style="margin-top:15px">
        <textarea name="address" cols="30" rows="3" class="form-control" placeholder="ที่อยู่" disabled=""><?=$supplier[0]['address']?>
        </textarea>
      </div>
    </div>
      
    <hr>
    <h3> รายการจำหน่าย </h3>
    <hr>

    <div class="col-md-2"><strong>ลำดับ</strong></div>  
    <div class="col-md-6"><strong>ชื่ออุปกรณ์</strong></div>
    <div class="col-md-4"><strong>ราคา</strong></div>

    <div id="list_items">
      <?php foreach($list_item as $ind => $item) : ?>
        <div class="item_row_#row#">
          <div class="col-md-2" style="margin-top: 15px"><?=$ind+1?></div>  
          <div class="col-md-6" style="margin-top: 15px">
            <input type="text" class="form-control" disabled="" value="<?=$item['name']?>">
          </div>
          <div class="col-md-2" style="margin-top: 15px">
            <input type="text" class="form-control" disabled="" value="<?=$item['price']?>">
          </div> 
          <div class="col-md-2" style="margin-top: 15px">
            <div class="deleteRow btn btn-danger" onclick="deleteRow('<?=$item["iop_id"]?>')">
              ลบรายการ
            </div>
          </div> 
        </div>
      <?php endforeach; ?>

      <div id="btn-control" class="item_row_#row#">
        <div class="col-md-2" style="margin-top: 15px"></div>  
        <div class="col-md-6" style="margin-top: 15px">
        </div>
        <div class="col-md-2" style="margin-top: 15px">
        </div> 
        <div class="col-md-2" style="margin-top: 15px">
          <div class="btn btn-info" id="addRow">
            <i class="glyphicon glyphicon-plus"></i> เพื่มรายการ 
          </div>
        </div> 
      </div>
    </div>
  </form>
</div>

<div id="temp_row" style="display: none">
  <div class="item_row_#row#">
    <div class="col-md-2" style="margin-top: 15px"></div>  
    <div class="col-md-6" style="margin-top: 15px">
      <select class="form-control" name="Item[#row#][item]" id="item_#row#">
        <?php if (!empty($items)) :
                foreach($items as $item) : ?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
        <?php   endforeach; 
          endif;
        ?>
      </select>
    </div>
    <div class="col-md-2" style="margin-top: 15px">
      <input name="Item[#row#][price]" type="text" class="form-control" id="price_#row#">
    </div> 
    <div class="col-md-2" style="margin-top: 15px">
      <div class="deleteRow btn btn-success" onclick="addItem(#row#)">
        <i class="glyphicon glyphicon-plus"></i>
      </div>
      <div class="deleteRow btn btn-danger" onclick="removeRow(#row#)">
        <i class="glyphicon glyphicon-minus"></i>
      </div>
    </div> 
  </div>
</div>