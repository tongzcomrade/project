<script>
    function forgotPassword() {
        location.href = 'index.php?r=frontend/forgotPassword';
    }

    function login() {
        $.ajax({
            url: 'index.php?r=frontend/loginSystem',
            type: 'POST',
            data: $('#form').serialize(),
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 'ok') {
                    alert(resp.msg);
                    console.log(resp.data);
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
            <h2 style="text-align: center; font-size: 32px;">ยินดีต้อนรับเข้าสู่ระบบจัดการศูนย์ฟิตเนสด้วยเทคโนโลยีบาร์โค้ด</h2>
            <form id="form" method="post">
                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="name">ชื่อผู้ใช้ <span>*</span></label>
                    <input type="text" required name="username" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="email">รหัสผ่าน <span>*</span></label>
                    <input type="password" required name="password" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="clear"></div>
                <div class="one_third first">
                </div>
                <div>
                    <input name="submit" type="button" onclick="login()" value="เข้าสู่ระบบ">
                    &nbsp;
                    <input name="reset" type="reset" onclick="forgotPassword()" value="ลืมรหัสผ่าน">
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