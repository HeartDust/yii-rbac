# yii-rbac
yii框架rbac权限管理

1.basic_admin_user 表中手动建立一个系统管理员账户,id为1(必需为1)。
2.登录用户时把用户的id存到$_SESSION['admin_uid']中。
3.后台登陆链接
  http://localhost/rbac/backend.php?r=site/login
  账号：admin
  密码：admin
4.在rbac/protected/backend/目录下建runtime文件夹和views文件夹
