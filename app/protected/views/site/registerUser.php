<div class="row">
  <div class="col-md-6 col-md-offset-2" style="text-align: center">
    <h1 class="page-header"> ลงทะเบียนผู้ใช้ระบบ </h1>
  </div>
</div>

<form action="index.php?r=site/postUser" method="post">
  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> ชื่อ - นามสกุล </label>
    <div>
      <div class="col-md-6" style="padding-left: 0">
        <input type="text" class="form-control name-form" name="fname" placeholder="name" required>
      </div>
      <div class="col-md-6" style="padding-right: 0">
        <input type="text" class="form-control name-form" name="lname" placeholder="last name" required>
      </div>
    </div>  
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> ชื่อผู้ใช้ </label>
    <input type="text" class="form-control" name="username" placeholder="username" required>
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
      <label for="" class="control-label"> รหัสผ่าน </label>
      <input type="password" class="form-control" name="password" placeholder="password" required>
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> ยืนยันรหัสผ่าน </label>
    <input type="password" class="form-control" name="re_password" placeholder="re-password" required>
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> อีเมล์ </label>
    <input type="text" class="form-control" name="email" placeholder="email" required>
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> เบอร์ติดต่อ </label>
    <input type="text" class="form-control" name="tel" placeholder="telephone No." required>
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> รูปภาพประจำตัว </label>
    <input type="file" class="form-control" name="image">
  </div>

  <div class="form-group col-md-6 col-md-offset-2">
    <label for="" class="control-label"> ที่อยู่ </label>
    <textarea name="address" class="form-control" placeholder="address" required></textarea>
  </div>

  <div class="form-group col-md-6 col-md-offset-2" style="text-align: center">
    <input type="hidden" value="1" name="fromBackOffice">
    <button class="btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> ตกลง </button>
    <input type="reset" value="ยกเลิก" class="btn btn-danger">
  </div>
</form>