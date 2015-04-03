# yii-rbac
yii框架rbac权限管理

1.basic_admin_user 表中手动建立一个系统管理员账户,id为1(必需为1)。
2.登录用户时把用户的id存到$_SESSION['admin_uid']中。
