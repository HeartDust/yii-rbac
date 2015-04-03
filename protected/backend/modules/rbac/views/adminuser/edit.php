<title>#BBF-权限管理【修改用户】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <div class="mws-panel grid_6">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 修改用户<a href="backend.php?r=rbac/adminuser" style="cursor: pointer;padding-left: 74%;"><input type="button" value="返回用户列表"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="backend.php?r=rbac/adminuser/update" method="post" id="sub">
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">用户昵称</label>
                            <div class="mws-form-item">
                                <input type="text" id="username" readonly class="large require" name="username" value="<?php echo $user_info['username']; ?>">
                            </div>
                        </div>
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">用户手机号</label>
                            <div class="mws-form-item">
                                <input type="text" id="tel" class="large require" name="tel" value="<?php echo $user_info['tel']; ?>">
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
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">添加角色</label>
                            <div class="mws-form-item">
                                <select name="role_id">
                                    <option value="0">--请选择--</option>
                                    <?php foreach($role_list as $val){ ?>
                                        <option value="<?php echo $val->attributes['id']; ?>" <?php if($val->attributes['id'] == $user_info['role_id']){?>selected<?php }?> ><?php echo $val->attributes['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $user_info['id']; ?>">
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
        var username = $.trim($("#username").val());
        if(username == "") {
            alert('用户名不能为空！');
            return false;
        }
        var mobile = $("#tel").val();
        mobile = $.trim(mobile);
        var p1 =/^(?:13\d|14\d|15\d|17\d|18\d)-?\d{5}(\d{3}|\*{3})$/;
        if ("" == mobile || !p1.test(mobile)) {
            alert('手机号格式不对或手机号不能为空！');
            return false;
        }
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
