<script>
    function resetPassword() {
        $.ajax({
            url: 'index.php?r=frontend/resetPassword',
            type: 'POST',
            data: $('#form').serialize(),
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 'ok') {
                    location.href = 'index.php?r=frontend/resetNewPassword&token='+resp.data;
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
            <h2 style="text-align: center; font-size: 32px;">ลืมรหัสผ่าน</h2>
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
                    <label for="email">คำถามกันลืม <span>*</span></label>
                    <input type="text" required name="question" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="one_third first">
                </div>
                <div class="one_third" style="margin: 0;">
                    <label for="email">คำตอบ <span>*</span></label>
                    <input type="text" required name="answer" value="" size="22">
                </div>
                <div class="one_third">
                </div>

                <div class="clear"></div>
                <div class="one_third first">
                </div>
                <div>
                    <input name="submit" type="button" onclick="resetPassword()" value="ตั้งรหัสผ่านใหม่">
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