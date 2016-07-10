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
            <h2>สมัครสมาชิก</h2>
            <form id="form" method="post">
                <div class="one_third first">
                    <label for="name">ชื่อ <span>*</span></label>
                    <input type="text" required name="first_name" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="email">นามสกุล <span>*</span></label>
                    <input type="text" required name="last_name" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="url">อีเมล์ <span>*</span></label>
                    <input type="email" required name="email" id="email" value="" size="22">
                </div>
                <div class="one_third first">
                    <label for="name">ชื่อผู้ใช้ <span>*</span></label>
                    <input type="text" required name="username" id="name" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="email">รหัสผ่าน <span>*</span></label>
                    <input type="password" required name="password" id="email" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="url">ยืนยันรหัสผ่าน <span>*</span></label>
                    <input type="password" required name="re_password" id="url" value="" size="22">
                </div>
                <div class="one_third first">
                    <label for="email">คำถามกันลืม <span>*</span></label>
                    <input type="text" required name="question" id="text" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="url">คำตอบ <span>*</span></label>
                    <input type="text" required name="answer" id="url" value="" size="22">
                </div>
                <div class="one_third">
                    <label for="url">เบอร์โทรศัพท์ <span>*</span></label>
                    <input type="text" required name="tel" id="url" value="" size="22">
                </div>
                <div class="one_third first">
                    <label for="url">รูปภาพ </label>
                    <input type="file" required name="image" id="url" value="" size="22">
                </div>
                <div class="block clear">
                    <label for="comment">ที่อยู่ <span>*</span></label>
                    <textarea name="address" id="comment" cols="25" rows="10" required></textarea>
                </div>
                <div>
                    <input name="submit" type="button" onclick="saveData()" value="บันทึก">
                    &nbsp;
                    <input name="reset" type="reset" value="ล้างฟอร์ม">
                </div>
            </form>
        </div>
        <!-- ########################################################################################## -->
        <!-- / container body -->
        <div class="clear"></div>
    </main>
</div>