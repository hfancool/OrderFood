# Host: localhost  (Version: 5.1.73-community)
# Date: 2016-05-12 07:55:22
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "think_admin_user"
#

DROP TABLE IF EXISTS `think_admin_user`;
CREATE TABLE `think_admin_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '商家管理员id',
  `username` varchar(255) NOT NULL COMMENT '商家用户名',
  `password` varchar(255) NOT NULL COMMENT '商家密码',
  `address` varchar(255) NOT NULL COMMENT '商家的地址',
  `tdcode` varchar(255) NOT NULL COMMENT '二维码',
  `paytype` varchar(255) DEFAULT NULL COMMENT '支付方式，支付信息',
  `menu` varchar(255) NOT NULL COMMENT '菜单',
  `storename` varchar(255) NOT NULL COMMENT '店铺名称',
  `storeinfo` varchar(255) NOT NULL COMMENT '营业执照等信息',
  `hotmenu` varchar(255) NOT NULL COMMENT '本店热门菜',
  `marketing` varchar(255) DEFAULT NULL COMMENT '营销策略，优惠',
  `secrate` char(4) DEFAULT NULL COMMENT '密码加密字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "think_admin_user"
#

INSERT INTO `think_admin_user` VALUES (1,'fanhang','111','陕西省宝鸡市岐山县枣林镇','ddd','ddd','dd','魏家凉皮','dd','dd','dd',NULL),(2,'admin','111','陕西省西安市雁塔区','dd','asdf','asdf','碗碗香','asdf','adff','asdf','N!OA');

#
# Structure for table "think_manage_info"
#

DROP TABLE IF EXISTS `think_manage_info`;
CREATE TABLE `think_manage_info` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "think_manage_info"
#

INSERT INTO `think_manage_info` VALUES (1,'fanhang','000');

#
# Structure for table "think_mapping"
#

DROP TABLE IF EXISTS `think_mapping`;
CREATE TABLE `think_mapping` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录自增id',
  `ssid` varchar(512) NOT NULL DEFAULT '' COMMENT '加密字段',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'admin主键id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "think_mapping"
#

/*!40000 ALTER TABLE `think_mapping` DISABLE KEYS */;
INSERT INTO `think_mapping` VALUES (1,'25e98b424e63300d77269a34bd30f1dd',1),(2,'1edf7cc45d8c32163d7ced7669f1fb10',2);
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "think_menu"
#

/*!40000 ALTER TABLE `think_menu` DISABLE KEYS */;
INSERT INTO `think_menu` VALUES (4,1,'水煮肉片','吃了能长肉','Admin/menu_image/573203d4ccf7d.png',20),(13,1,'山珍海味','养眼','Admin/menu_image/57327fc2f1adb.png',1000),(14,1,'好朋友','一模','Admin/menu_image/5733312f6d8d3.jpg',33),(16,1,'就是','你','Admin/menu_image/5733319237c14.jpg',0),(17,1,'osmund','哦搜狗','Admin/menu_image/573331be74acf.jpg',5546),(18,1,'你去听','个咯手机吧','Admin/menu_image/5733326217806.jpg',668),(19,2,'asdf ','afdfadf','Admin/menu_image/573348fd19f14.png',22);
/*!40000 ALTER TABLE `think_menu` ENABLE KEYS */;
