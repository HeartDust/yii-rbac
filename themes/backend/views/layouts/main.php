<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Required Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fonts/ptsans/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fonts/icomoon/style.css" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mws-style.css" media="screen">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themer.css" media="screen">
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.3.min.js"></script>
</head>

<body>
<div id="mws-header" class="clearfix">

    <!-- Logo Container -->
    <div id="mws-logo-container">

        <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        <div id="mws-logo-wrap">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/mws-logo.png" alt="mws admin">
        </div>
    </div>

    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">
        <!-- User Information and functions section -->
        <div id="mws-user-info" class="mws-inset">

            <!-- User Photo -->
            <div id="mws-user-photo">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/profile.jpg" alt="User Photo">
            </div>

            <!-- Username and Functions -->
            <div id="mws-user-functions">
                <div id="mws-username">
                    你好,<?php echo $_SESSION['username']; ?>
                </div>
                <ul>
                    <li><a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=site/pwd">更改密码</a></li>
                    <li><a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=site/logout">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="mws-wrapper">
    <!-- Necessary markup, do not remove -->
    <div id="mws-sidebar-stitch"></div>
    <div id="mws-sidebar-bg"></div>

    <!-- Sidebar Wrapper -->
    <div id="mws-sidebar">

        <!-- Hidden Nav Collapse Button -->
        <div id="mws-nav-collapse">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div id="mws-navigation">
            <ul>
                <li>
                    <a href="#"><i class="icon-home"></i>显示</a>
                </li>
                <?php if(Rbac::checkAccess('adminuser') || Rbac::checkAccess('role') || Rbac::checkAccess('node')){ ?>
                    <li>
                        <a href="#"><i class="icon-magic"></i>权限管理</a>
                        <ul class="closed">
                            <?php if(Rbac::checkAccess('adminuser')){ ?>
                            <li><a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/adminuser">人员管理</a></li>
                            <?php } ?>
                            <?php if(Rbac::checkAccess('role')){ ?>
                            <li><a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/role">角色权限管理</a></li>
                            <?php } ?>
                            <?php if(Rbac::checkAccess('node')){ ?>
                            <li><a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node">功能管理</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php  echo $content; ?>
</div>
<script type="text/javascript">
    // 权限验证隐藏按钮
    var uid = <?php echo $_SESSION['admin_uid']; ?>;
    if(uid != 1) {
        var access_arr = new Array();
        <?php
            $moduleName = strtoupper(Yii::app()->controller->id);
            $access_list = Rbac::getAccessList($_SESSION['admin_uid']);
            if($access_list) {
                foreach($access_list as $key=>$val) {
                    if($key == $moduleName){
                        $i = 0;
                        foreach($val as $kk=>$vv){
                            echo "access_arr[$i] = '$kk';";
                            $i++;
                        }
                    }
                }
            }
        ?>
        var action = $("[at]");
        for(var i=0;i<action.length;i++){
            if($.inArray(action.eq(i).attr("at").toUpperCase(),access_arr) < 0) {
                action.eq(i).hide();
            }
        }
    }
</script>
<!-- jQuery-UI Dependent Scripts-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.9.2.min.js"></script>

<!-- Plugin Scripts-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/colorpicker-min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.validate-min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/wizard.min.js"></script>

<!-- Core Script -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/mws.js"></script>
</body>
</html>
