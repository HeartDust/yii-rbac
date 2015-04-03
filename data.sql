DROP TABLE IF EXISTS `basic_admin_user`;

CREATE TABLE `basic_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) DEFAULT NULL COMMENT '用户姓名',
  `password` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT '' COMMENT '电话',
  `create_time` int(11) DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

LOCK TABLES `basic_admin_user` WRITE;

INSERT INTO `basic_admin_user` (`id`, `username`, `password`, `tel`, `create_time`)
VALUES
  (1,'admin','21232f297a57a5a743894a0e4a801fc3','13666666666','1428074744');

UNLOCK TABLES;


/*************************************/
DROP TABLE IF EXISTS `basic_role`;

CREATE TABLE `basic_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

LOCK TABLES `basic_role` WRITE;

INSERT INTO `basic_role` (`id`, `name`, `pid`, `status`, `remark`)
VALUES
  (1,'超级管理员','0','1','');

UNLOCK TABLES;


/*************************************/
DROP TABLE IF EXISTS `basic_role_user`;

CREATE TABLE `basic_role_user` (
  `role_id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  KEY `role_id` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*************************************/
DROP TABLE IF EXISTS `basic_node`;

CREATE TABLE `basic_node` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `pid` smallint(5) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`status`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

LOCK TABLES `basic_node` WRITE;

INSERT INTO `basic_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`)
VALUES
	(1,'adminuser','权限管理-人员管理',1,'控制器',0,0,1),
	(2,'index','用户列表',1,'动作',0,1,2),
	(3,'create','添加内部人员',1,'动作',0,1,2),
	(4,'verifyname','添加内部人员二',1,'动作',0,1,2),
	(5,'edit','修改用户信息',1,'动作',0,1,2),
	(6,'update','修改用户信息二',1,'动作',0,1,2),
	(7,'del','删除用户',1,'动作',0,1,2),
	(8,'role','权限管理-角色权限管理',1,'控制器',0,0,1),
	(9,'index','角色列表',1,'动作',0,8,2),
	(10,'create','添加角色',1,'动作',0,8,2),
	(11,'edit','修改角色',1,'动作',0,8,2),
	(12,'del','删除角色',1,'动作',0,8,2),
	(13,'node','权限管理-功能管理',1,'控制器',0,0,1),
	(14,'index','功能列表',1,'动作',0,13,2),
	(15,'create','添加功能',1,'动作',0,13,2),
	(16,'verify','添加功能二',1,'动作',0,13,2),
	(17,'edit','编辑功能',1,'动作',0,13,2),
	(18,'del','删除功能',1,'动作',0,13,2),
	(19,'access','权限管理-授权管理',1,'控制器',0,0,1),
	(20,'index','权限列表',1,'动作',0,19,2),
	(21,'update','更新权限',1,'动作',0,19,2);

UNLOCK TABLES;


/*************************************/
DROP TABLE IF EXISTS `basic_access`;

CREATE TABLE `basic_access` (
  `role_id` smallint(5) unsigned NOT NULL,
  `node_id` smallint(5) unsigned NOT NULL,
  `level` tinyint(4) NOT NULL,
  `pid` smallint(6) NOT NULL,
  KEY `role_id` (`role_id`,`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
