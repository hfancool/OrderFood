# Host: localhost  (Version: 5.1.73-community)
# Date: 2016-05-11 07:57:43
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "think_admin_user"
#

INSERT INTO `think_admin_user` VALUES (1,'fanhang','111','陕西省宝鸡市岐山县枣林镇','ddd','ddd','dd','魏家凉皮','dd','dd','dd',NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "think_menu"
#

/*!40000 ALTER TABLE `think_menu` DISABLE KEYS */;
INSERT INTO `think_menu` VALUES (4,1,'水煮肉片','吃了能长肉','Admin/menu_image/573203d4ccf7d.png',20);
/*!40000 ALTER TABLE `think_menu` ENABLE KEYS */;
