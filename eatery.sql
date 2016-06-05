# Host: localhost  (Version: 5.1.73-community)
# Date: 2016-06-05 09:46:36
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "think_admin_user"
#

DROP TABLE IF EXISTS `think_admin_user`;
CREATE TABLE `think_admin_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '商家管理员id',
  `username` varchar(255) NOT NULL COMMENT '商家用户名',
  `mobile` varchar(16) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(20) DEFAULT NULL COMMENT '邮箱地址',
  `password` varchar(255) NOT NULL COMMENT '商家密码',
  `address` varchar(255) NOT NULL COMMENT '商家的地址',
  `tdcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '二维码',
  `paytype` varchar(255) DEFAULT NULL COMMENT '支付方式，支付信息',
  `menu` varchar(255) DEFAULT '' COMMENT '菜单',
  `storename` varchar(255) NOT NULL COMMENT '店铺名称',
  `storeinfo` varchar(255) NOT NULL COMMENT '营业执照等信息',
  `hotmenu` varchar(255) DEFAULT '' COMMENT '本店热门菜',
  `marketing` varchar(255) DEFAULT NULL COMMENT '营销策略，优惠',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '商家状态1：启用2：停用',
  `secrate` char(4) DEFAULT NULL COMMENT '密码加密字段',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商家添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "think_admin_user"
#

INSERT INTO `think_admin_user` VALUES (1,'fanhang',NULL,NULL,'7ebff87bb6e29e1ac48a69dd6eef9280','陕西省宝鸡市岐山县枣林镇','Public/Admin/tcode/d2c9b2d222b411a29682d40eabfb7372.jpg','现金支付','dd','魏家凉皮','dd','dd','dd',1,'%sTa',0),(2,'admin',NULL,NULL,'7ebff87bb6e29e1ac48a69dd6eef9280','陕西省西安市雁塔区','','现金支付','asdf','碗碗香','asdf','adff','asdf',1,'%sTa',0),(3,'hfan','15091631716','www@qq.com','7ebff87bb6e29e1ac48a69dd6eef9280','fadjfojdsf','','现金支付','','wwwwwwww','wwwwwww','',NULL,1,'%sTa',1465017546),(4,'aaa','15091631716','804667084@qq.com','7ebff87bb6e29e1ac48a69dd6eef9280','wwwwwwwwwww','','现金支付','','ajsdfiasodf','wwwwwww','',NULL,2,'%sTa',1465017797);

#
# Structure for table "think_attendence"
#

DROP TABLE IF EXISTS `think_attendence`;
CREATE TABLE `think_attendence` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `eid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '雇员id',
  `att_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1:到勤、2:病假、3:事假、4:旷工、5:迟到、6:早退',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '记录添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Data for table "think_attendence"
#

/*!40000 ALTER TABLE `think_attendence` DISABLE KEYS */;
INSERT INTO `think_attendence` VALUES (10,1,2,1,'',1464446137),(11,1,8,6,'A的',1464446231),(12,1,8,1,'',1464532661),(13,1,10,2,'',1464489666),(15,1,8,1,'',1464610115),(16,1,10,1,'',1464610121),(17,1,8,3,'',1464667485),(18,1,10,1,'',1464792277),(19,1,10,4,'',1465023808),(20,1,8,4,'',1465035830),(21,1,2,4,'离职',1465035852);
/*!40000 ALTER TABLE `think_attendence` ENABLE KEYS */;

#
# Structure for table "think_employee"
#

DROP TABLE IF EXISTS `think_employee`;
CREATE TABLE `think_employee` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户所属商家的id号',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户的姓名',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户性别:0:保密，1:男2:女',
  `age` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户的年龄',
  `birthday` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '雇员的生日',
  `tel_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '用户的手机号码',
  `level_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户的等级id',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "think_employee"
#

/*!40000 ALTER TABLE `think_employee` DISABLE KEYS */;
INSERT INTO `think_employee` VALUES (1,2,'张三',1,22,1,'192192913931',2,0),(2,1,'李四',1,33,1,'15091631716',3,0),(8,1,'小蜗牛',2,7,1241107200,'3238239823982',3,1464412704),(10,1,'坎坎坷坷',1,20,831830400,'0000000000000',1,1464444639);
/*!40000 ALTER TABLE `think_employee` ENABLE KEYS */;

#
# Structure for table "think_law"
#

DROP TABLE IF EXISTS `think_law`;
CREATE TABLE `think_law` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(5) unsigned DEFAULT NULL,
  `info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "think_law"
#

INSERT INTO `think_law` VALUES (1,1,'adsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfsadsfsaffffffffasdfasdfsdfwerwerwesdfs'),(2,2,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaahhhhhhhhhhhhwwwwwwwwasddddddssaaa'),(3,3,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaahhhhhhhhhhhhwwwwwwwwasddddddssaaa');

#
# Structure for table "think_level"
#

DROP TABLE IF EXISTS `think_level`;
CREATE TABLE `think_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '对应的商家id',
  `level_id` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '用户的等级id',
  `level_name` varchar(100) NOT NULL DEFAULT '' COMMENT '等级名称',
  `salary` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '该等级对应的工资',
  PRIMARY KEY (`id`,`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "think_level"
#

/*!40000 ALTER TABLE `think_level` DISABLE KEYS */;
INSERT INTO `think_level` VALUES (1,1,2,'服务员',1200),(2,1,1,'传菜员',1100),(3,1,3,'配菜员',1300),(4,1,4,'采购员',2000),(5,1,5,'厨师',3500);
/*!40000 ALTER TABLE `think_level` ENABLE KEYS */;

#
# Structure for table "think_manager_user"
#

DROP TABLE IF EXISTS `think_manager_user`;
CREATE TABLE `think_manager_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '' COMMENT '管理员姓名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:保密、2：男。3：女',
  `birthday` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `secrate` varchar(5) NOT NULL DEFAULT '' COMMENT '加密字串',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `idcard` varchar(30) NOT NULL DEFAULT '' COMMENT '身份证号',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "think_manager_user"
#

/*!40000 ALTER TABLE `think_manager_user` DISABLE KEYS */;
INSERT INTO `think_manager_user` VALUES (1,'admin','111',1,0,'','15091631716','610323199212186317','804667883@qq.com',0),(2,'aaa','ef825d57a2b57158b37c8e7744fb35b4',1,2015,'yV56','15091631716','610323199212186317','www@qq.com',1465036770);
/*!40000 ALTER TABLE `think_manager_user` ENABLE KEYS */;

#
# Structure for table "think_mapping"
#

DROP TABLE IF EXISTS `think_mapping`;
CREATE TABLE `think_mapping` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录自增id',
  `ssid` varchar(600) NOT NULL DEFAULT '' COMMENT '加密字段',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'admin主键id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

#
# Data for table "think_mapping"
#

/*!40000 ALTER TABLE `think_mapping` DISABLE KEYS */;
INSERT INTO `think_mapping` VALUES (26,'199b4dbc2d11c03b9ba8ce8dc4535d39',2),(27,'089815738010bb559b675bff03c30406',1);
/*!40000 ALTER TABLE `think_mapping` ENABLE KEYS */;

#
# Structure for table "think_menu"
#

DROP TABLE IF EXISTS `think_menu`;
CREATE TABLE `think_menu` (
  `menu_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `parent_id` int(20) NOT NULL COMMENT '对应的父亲结点',
  `name` varchar(100) NOT NULL COMMENT '菜名',
  `desc` varchar(255) DEFAULT NULL COMMENT '菜品描述',
  `image` varchar(100) NOT NULL COMMENT '菜品图片',
  `price` double NOT NULL COMMENT '价格',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Data for table "think_menu"
#

/*!40000 ALTER TABLE `think_menu` DISABLE KEYS */;
INSERT INTO `think_menu` VALUES (19,2,'asdf ','afdfadf','Admin/menu_image/573348fd19f14.png',22),(22,2,'洋槐花','绿色又健康','Admin/menu_image/573893c5d3d69.jpg',20),(23,1,'水煮肉片','辣','Admin/menu_image/574305135f661.png',22),(24,1,'麻婆豆腐','好吃','Admin/menu_image/5743052c29ca2.png',15),(25,1,'抄手','好吃','Admin/menu_image/5743067ee561a.png',15),(26,1,'蕨根粉','好吃','Admin/menu_image/574306af2c052.png',12),(27,1,'红烧排骨','油大肉多','Admin/menu_image/574306f3e7fdf.png',25),(28,1,'夫妻肺片','好吃','Admin/menu_image/5743091ab97bf.png',22),(29,1,'鱼香肉丝','好吃','Admin/menu_image/57430d8cc2c8c.png',18);
/*!40000 ALTER TABLE `think_menu` ENABLE KEYS */;
