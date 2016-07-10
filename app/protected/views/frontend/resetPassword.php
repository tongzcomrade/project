<script>
    function login() {
        location.href = 'index.php?r=frontend/login';
    }

    function resetPassword() {
        var password = $('#password').val();
        var re_password = $('#re_password').val();

        if (password != re_password) {
            alert('รหัสผ่านไม่ตรงกัน');
            return false;
        }

        $.ajax({
            url: 'index.php?r=frontend/reset',
            type: 'POST',
            data: $('#form').serialize(),
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 'ok') {
                    alert(resp.msg);
                    location.href = 'index.php?r=frontend/login';
                }
                else {
                    alert(resp.msg);
                }
            }
        });
    }
</script>
<div class="wrapper row3">
    <main id="container" class="clear">
        <div id="comments">
            <h2 style="text-align: center; font-size: 32px;">แก้ไขรหัสผ่าน</h2>
            <form id="form" method="post">
                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="name">รหัสผ่านใหม่ <span>*</span></label>
                    <input type="hidden" required name="token" value="<?=$token?>">
                    <input type="password" id="password" required name="password" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="email">ยืนยันรหัสผ่านใหม่ <span>*</span></label>
                    <input type="password" id="re_password" required name="re_password" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="clear"></div>
                <div class="one_third first">
                </div>
                <div>
                    <input name="submit" type="button" onclick="resetPassword()" value="ตั้งรหัสผ่านใหม่">
                    &nbsp;
                    <input name="reset" type="reset" onclick="login()" value="เข้าสู่ระบบ">
                </div>
                <div class="one_third">
                </div>
            </form>
        </div>
        <!-- ########################################################################################## -->
        <!-- / container body -->
        <div class="clear"></div>
    </main>
</div>