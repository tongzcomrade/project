<script>
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function saveData() {
        if (!confirm('ยืนยันการสมัคร')) {
            return false;
        }

        var email = $('#email').val();

        var validate = validateEmail(email);

        if (validate != true) {
            alert('อีเมล์ไม่ถูกต้อง');
            return false;
        }

        $.ajax({
            url: 'index.php?r=frontend/saveMember',
            type: 'POST',
            data: $('#form').serialize(),
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 'ok') {
                    alert(resp.msg);
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
                    <label for="name">ชื่อ <span>*</span></label>
                    <input type="text" required name="first_name" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="email">นามสกุล <span>*</span></label>
                    <input type="text" required name="last_name" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="clear"></div>
                <div class="one_third first">
                </div>
                <div>
                    <input name="submit" type="button" onclick="saveData()" value="เข้าสู่ระบบ">
                    &nbsp;
                    <input name="reset" type="reset" value="ลืมรหัสผ่าน">
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