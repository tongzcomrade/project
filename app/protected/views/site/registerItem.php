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

    $('#type_select').change(function() {
      if ($(this).val() == '') {
        $('#code').css('visibility', 'visible');
        $('#description').css('display', 'block');
        $('#type_name').css('display', 'block');
      } 
      else {
        $('#code').css('visibility', 'hidden');
        $('#description').css('display', 'none');
        $('#type_name').css('display', 'none');
      }
    });
  });

  function addRow() {
    var html = $('#temp_row').html();

    html = html.replace('#row#', i);
    html = html.replace('#row#', i+1);
    html = html.replace('#row#', i);
    html = html.replace('#row#', i);

    $('#list_items').append(html);
    i++;
  }

  function submitForm() {
    $.ajax({
      url: 'index.php?r=site/postItems',
      data: $('#form').serialize(),
      type: 'post',
      dataType: 'json',
      success: function(res) {
        if (res.completed == true) {
          location.href = 'index.php?r=site/itemTypesList';
        }
        else {
          alert(res.msg);
        }
      }
    });
  }

  function removeRow(row) {
    $('.item_row_'+row).remove();
  }
</script>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">ลงทะเบียนอุปกรณ์</h1>
  </div>
</div>

<div class="container col-md-9">
  <form id="form" action="index.php?r=site/insertItem" class="form-horizontal" method="post">
    
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">ประเภทอุปกรณ์</label>
      <div class="col-sm-5">
        <select name="item_type_id" id="type_select" class="form-control">
          <?php 
            if (!empty($item_types)) :
              foreach ($item_types as $item_type) :
                $select = '';
                //if ($item_type_id == $item_type['id']) $select = 'selected';
                ?>
                <option value="<?=$item_type['id']?>" <?=$select?> ><?=$item_type['name']?></option>
          <?php
              endforeach; 
          ?>
          <?php endif; ?>          

          <option value=""> เพื่มเติม </option>
        </select>
      </div>
      
      <div class="col-sm-5" style="visibility: hidden">
        <input id="code" name="code" type="text" class="form-control" placeholder="Code" value="">
      </div>

      <div id="type_name" class="col-sm-5 col-sm-offset-2" style="margin-top:15px; display: none">
        <input name="type_name" type="text" class="form-control" placeholder="Name" value="">
      </div>

      <div id="description" class="col-sm-10 col-sm-offset-2" style="margin-top:15px; display: none">
        <textarea name="description" cols="30" rows="3" class="form-control"></textarea>
      </div>
    </div>

    <div class="col-md-2"><strong>ลำดับ</strong></div>  
    <div class="col-md-10"><strong>ชื่ออุปกรณ์</strong></div>

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
    <div class="col-md-8" style="margin-top: 15px"><input name="Item[#row#][name]" type="text" class="form-control"></div> 
    <div class="col-md-2" style="margin-top: 15px">
      <div class="deleteRow btn btn-danger" onclick="removeRow(#row#)">
        ลบแถว
      </div>
    </div> 
  </div>
</div>