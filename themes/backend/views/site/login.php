<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录</title>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/login/js/jquery.js" type="text/javascript" language="javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/login/css/register.css">
</head>
<body>
<div class='signup_container'>
    <h1 class='signup_title'>用户登陆</h1>
    <div id="signup_forms" class="signup_forms clearfix">
        <form action="backend.php?r=site/login" method="post" id="signup_form">
            <div class="form_row first_row">
                <label for="signup_email">请输入用户名</label><div  id="signup_name_tip"></div>
                <input type="text" name="username" placeholder="请输入用户名" id="signup_name" data-required="required">
            </div>
            <div class="form_row">
                <label for="signup_password">请输入密码</label><div  id="signup_password_tip"></div>
                <input type="password" name="pwd" placeholder="请输入密码" id="signup_password" data-required="required">
            </div>
    </div>
    <div class="login-btn-set"><a href='javascript:void(0);' onclick="loginin()" class='login-btn'></a></div>
    </form>
    <p class='copyright'>版权所有 笔笔富科技有限公司 </p>
</div>
</body>
<script type="text/javascript">
    $(function(){
        $('#signup_name').focus(function(){
            $('#signup_name_tip').removeClass();
        })
        $('#signup_password').focus(function(){
            $('#signup_password_tip').removeClass();
        })
        $('#signup_select').click(function(){
            $('.form_row ul').show();
            event.cancelBubble = true;
        })
        $('#d').click(function(){
            $('.form_row ul').toggle();
            event.cancelBubble = true;
        })
        $('body').click(function(){
            $('.form_row ul').hide();
        })
        $('.form_row li').click(function(){
            var v  = $(this).text();
            $('#signup_select').val(v);
            $('.form_row ul').hide();
        })
    })
    function loginin()
    {
        var username = $('#signup_name').val();
        var pwd = $('#signup_password').val();
        $.ajax({
            type: 'get',
            url: 'backend.php?r=site/verify',
            data: 'username='+username+'&pwd='+pwd,
            success:function(msg){
                if(msg == 1){
                    $('#signup_form').submit();
                }else{
                    alert('用户名或密码错误');
                    location.reload();
                }
            }
        });
    }
</script>
</html>