<script type="text/javascript">
  var cost = 50;
  $(document).ready(function() {
    $('#search_user').click(function() {
        searchUser();
    });

    $('#pay_service').click(function() {
        paymentService();
    });

    $('#refill').click(function() {
        refill();
    });
  });

  function sumRefill() {
    var a = $('#credit').val() - 0;
    var b = $('#how_many_refill').val() - 0;

    $('#sum_refill').val(a+b);
  }

  function refill() {
    var id = $('#user_id').val();
    if (id == '') {
        alert('เลือกสมาชิกก่อนทำรายการ');
        return;
    }

    var how_many_refill = $('#how_many_refill').val();
    if (how_many_refill < 1) {
        alert('ระบุจำนวนเงินที่ต้องการเติม');
        return;
    }

    $.ajax({
        url: 'index.php?r=site/refillCredit',
         data: {
            id: id,
            credit: how_many_refill,
        },
        type: 'post',
        dataType: 'json',
        success: function(response) {
            if (response.completed == true) {
                $('#credit').val($('#sum_refill').val());
                $('#how_many_refill').val(0);
                $('#sum_refill').val('');
            }
        }
    });
  }

  function paymentService() {
    var id = $('#user_id').val();
    if (id == '') {
        alert('เลือกสมาชิกก่อนทำรายการ');
        return;
    }

    var credit = $('#credit').val();
    if (credit < 50) {
        alert('จำนวนเงินของท่านไม่เพียงพอต่อการใช้งาน');
        return;
    }
    alert(id);

    $('#formPayment').submit();
  }

  function searchUser() {
    var code = $('#search').val();

    $.ajax({
        url: 'index.php?r=site/getUserByCode',
        data: {
            code: code
        },
        type: 'post',
        dataType: 'json',
        success: function(response) {
            if (response.completed == true) {
                var data = response.user[0];
                $('#user_id').val(data.id);
                $('#name').val(data.fname + ' ' + data.lname);
                $('#tel').val(data.tel);
                $('#address').val(data.address);
                $('#credit').val(data.credit);
            }
            else {
                alert('ไม่มีผู้ใช้รหัสนี้');
            }
        }
    });
  }
</script>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">บริการหลัก</h1>
  </div>
</div>
<form id="formPayment" action="index.php?r=site/paymentService" method="post">
    <input name="id" type="hidden" id="user_id">
    <div class="row">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">ค้นหาสมาชิก</label>
          <div class="col-sm-4">
            <input id="search" type="text" class="form-control">
          </div>
          <div id="search_user" class="btn btn-primary">
            ค้นหา ...
          </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label">ชื่อ - นามสกุล :</label>
          <div class="col-sm-4">
            <input id="name" type="text" class="form-control" readonly>
          </div>
        </div>
    </div>

    <div class="row" style="padding-top:15px">
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label">เบอร์ติดต่อ :</label>
          <div class="col-sm-4">
            <input id="tel" type="text" class="form-control" readonly>
          </div>
        </div>
    </div>

    <div class="row" style="padding-top:15px">
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label">ที่อยู่ :</label>
          <div class="col-sm-4">
            <textarea name="" id="address" cols="30" rows="5" class="form-control" readonly></textarea>
          </div>
        </div>
    </div>

    <div class="row" style="padding-top:15px">
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label">เงินคงเหลือ :</label>
          <div class="col-sm-3">
            <input id="credit" type="numer" value="0" class="form-control" readonly>
          </div>
          <label for="inputEmail3" class="col-md-1 control-label">บาท</label>
        </div>
    </div>
    
    <?php if (Helper::ifAllowMenu('refill_credit')) : ?>
    <div class="row" style="padding-top:15px">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">เติมเงินเข้าระบบ</label>
          <div class="col-sm-2">
            <input id="how_many_refill" type="number" class="form-control" onchange="sumRefill()">
          </div>
          <label for="inputEmail3" class="col-sm-1 control-label"> บาท</label>

          <label for="inputEmail3" class="col-sm-1 control-label">รวม</label>
          <div class="col-sm-2">
            <input id="sum_refill" type="text" class="form-control" readonly>
          </div>
          <label for="inputEmail3" class="col-sm-1 control-label"> บาท</label>

          <div id="refill" class="btn btn-info">
            เติมเงิน
          </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="row" style="padding-top:15px">
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label"></label>
          <div class="col-sm-3">
            <div id="pay_service" class="btn btn-primary"> ชำระเงิน </div>
            <input type="reset" vale="ล้างข้อมูล" class="btn btn-danger">
          </div>
        </div>
    </div>
</form>