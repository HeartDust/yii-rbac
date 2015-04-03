<title>#BBF-权限管理【添加用户】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <div class="mws-panel grid_6">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 添加用户<a href="backend.php?r=rbac/adminuser" style="cursor: pointer;padding-left: 74%;"><input type="button" value="返回用户列表"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="backend.php?r=rbac/adminuser/create" method="post" id="sub">
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">用户昵称</label>
                            <div class="mws-form-item">
                                <input type="text" id="username" class="large require" name="username" value="">
                            </div>
                        </div>
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">手机号</label>
                            <div class="mws-form-item">
                                <input type="text" id="tel" class="large require" name="tel" value="">
                            </div>
                        </div>
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">添加角色</label>
                            <div class="mws-form-item">
                                <select name="role_id">
                                    <option value="0">--请选择--</option>
                                    <?php foreach($role_list as $val){ ?>
                                        <option value="<?php echo $val->attributes['id']; ?>"><?php echo $val->attributes['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="password" name="password" value="" >
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
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI-2.45.js" type="text/javascript" language="javascript"></script>
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

        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '<?php echo Yii::app()->baseUrl;?>/backend.php?r=rbac/adminUser/verifyName',
            data: 'username='+username,
            success:function(msg){
                if(msg == 1) {
                    alert('该用户名已经存在，不可用！');
                    return false;
                } else {
                    var pwd = <?php echo mt_rand(100000,999999); ?>;
                    $("#password").val(pwd);

                    var html = '';
                    html += '<div style="position:absolute;left:20%; width:277px; height:100px; text-align:left;background-color: #ffffff;">';
                    html += '<div style="padding-top: 20px;left:20%;text-align: center">密码(请牢记)：'+pwd+'</div>';
                    html += '<div style="left:20%;text-align: center"><a href="javascript:void(0);" id="ok">确认</a></div>';
                    html += '</div>';
                    $.blockUI(html);
                    $("#ok").click(function(){
                        $.unblockUI();
                        $("#sub").submit();
                    });
                }
            }
        });
    }
</script>
