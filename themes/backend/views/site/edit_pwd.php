<title>#BBF-用户管理【修改密码】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <div class="mws-panel grid_6">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 修改密码</span>
            </div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="backend.php?r=site/pwd" method="post" id="sub">
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">用户昵称</label>
                            <div class="mws-form-item">
                                <input type="text" readonly class="large require" name="username" value="<?php echo $user_info['username']; ?>">
                            </div>
                        </div>
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">用户密码</label>
                            <div class="mws-form-item">
                                <input type="password" id="password" class="large require" name="password" value="" placeholder="空默认使用原密码">
                            </div>
                        </div>
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">确认密码</label>
                            <div class="mws-form-item">
                                <input type="password" id="repwd" class="large require" name="repwd" value="" placeholder="空默认使用原密码">
                            </div>
                        </div>
                    </div>
                    <div class="mws-button-row">
                        <a class="btn btn-danger" onclick="sub()">提交</a>
                        <input type="reset" value="重置" class="btn ">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Inner Container End -->
    <!-- Footer -->
    <div id="mws-footer">
        Copyright Your Website 2014. All Rights Reserved.
    </div>
</div>
<!-- Main Container End -->
<script type="text/javascript">
    function sub() {
        var password = $.trim($("#password").val());
        if(password.length > 0 && password.length < 6) {
            alert('密码不能小于6位！');
            return false;
        }
        var repwd = $.trim($("#repwd").val());
        if(password != repwd) {
            alert('密码不一致！');
            return false;
        }
        $("#sub").submit();
    }
</script>
