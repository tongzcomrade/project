<script>
  var i = 0;
  $(document).ready(function() {
    addRow();

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

    $('#list_items').append(html);
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
          alert(res.msg);
          console.log(res.msg);
        }
      },
    });
  }

  function removeRow(row) {
    $('.item_row_'+row).remove();
  }
</script>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">ลงทะเบียนตัวแทนจำหน่าย</h1>
  </div>
</div>

<div class="container col-md-9">
  <form id="form" action="index.php?r=site/insertItem" class="form-horizontal" method="post">
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ข้อมูลทั่วไป</label>
      <div class="col-sm-5">
        <input name="supplier_name" type="text" class="form-control" placeholder="ชื่อตัวแทนจำหน่าย" value="">
      </div>
      
      <div id="type_name" class="col-sm-5">
        <input name="tel" type="text" class="form-control" placeholder="เบอร์ติดต่อ" value="">
      </div>

      <div id="description" class="col-sm-10 col-sm-offset-2" style="margin-top:15px">
        <textarea name="address" cols="30" rows="3" class="form-control" placeholder="ที่อยู่"></textarea>
      </div>
    </div>
      
    <hr>
    <h3> รายการขาย </h3>
    <hr>

    <div class="col-md-2"><strong>ลำดับ</strong></div>  
    <div class="col-md-6"><strong>ชื่ออุปกรณ์</strong></div>
    <div class="col-md-4"><strong>ราคา</strong></div>

    <div id="list_items">
    
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-top: 20px">
        <div class="btn btn-info" id="addRow"><i class="glyphicon glyphicon-plus"></i> เพื่มแถว </div>
        <div class="btn btn-primary" id="submit"><i class="glyphicon glyphicon-check"></i> ลงทะเบียน </div>
      </div>
    </div>
  </form>
</div>

<div id="temp_row" style="display: none">
  <div class="item_row_#row#">
    <div class="col-md-2" style="margin-top: 15px">#row#</div>  
    <div class="col-md-6" style="margin-top: 15px">
      <select class="form-control" name="Item[#row#][item]" id="">
        <?php if (!empty($items)) :
                foreach($items as $item) : ?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
        <?php   endforeach; 
          endif;
        ?>
      </select>
    </div>
    <div class="col-md-2" style="margin-top: 15px"><input name="Item[#row#][price]" type="text" class="form-control"></div> 
    <div class="col-md-2" style="margin-top: 15px">
      <div class="deleteRow btn btn-danger" onclick="removeRow(#row#)">
        ลบแถว
      </div>
    </div> 
  </div>
</div>