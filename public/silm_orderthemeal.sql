/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : silm_orderthemeal

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-06-12 21:42:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `img_url` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '单身狗套餐', '100.00', '/images/p.png', '        	<p>&emsp;&emsp;排毒排便－香蕉牛奶汁</p>\r\n	      	<p>&emsp;&emsp;适量加入牛奶调理，可以补充更多钙质，对于正在减肥中的女孩来说，也比较有饱足感。经常失眠或是容易经痛的女孩也可以喝喝看！</p>\r\n	      	<br>\r\n	      	<br>\r\n	      	<p>&emsp;&emsp;止咳防晕－芒果汁</p>\r\n	      	<p>&emsp;&emsp;退火利尿－椰子汁</p>\r\n	      	<p>&emsp;&emsp;不过有的人会怕椰子的味道，也因为椰子水生冷寒性，因此女孩们如果想喝椰子水来消暑，或是肠胃不好的人，在喝之前还是要三思！</p>\r\n	      	<p>&emsp;&emsp;水果之王－奇异果汁</p>\r\n	      	<img src=\"/images/banner.jpg\">');
INSERT INTO `menu` VALUES ('2', '虐狗情人套餐', '99.00', '/images/p1.png', '        	<p>&emsp;&emsp;排毒排便－香蕉牛奶汁</p>\r\n	      	<p>&emsp;&emsp;适量加入牛奶调理，可以补充更多钙质，对于正在减肥中的女孩来说，也比较有饱足感。经常失眠或是容易经痛的女孩也可以喝喝看！</p>\r\n	      	<br>\r\n	      	<br>\r\n	      	<p>&emsp;&emsp;止咳防晕－芒果汁</p>\r\n	      	<p>&emsp;&emsp;退火利尿－椰子汁</p>\r\n	      	<p>&emsp;&emsp;不过有的人会怕椰子的味道，也因为椰子水生冷寒性，因此女孩们如果想喝椰子水来消暑，或是肠胃不好的人，在喝之前还是要三思！</p>\r\n	      	<p>&emsp;&emsp;水果之王－奇异果汁</p>\r\n	      	<img src=\"/images/banner.jpg\">');
INSERT INTO `menu` VALUES ('3', '卤香鸡块', '12.00', '/images/p2.png', '        	<p>&emsp;&emsp;排毒排便－香蕉牛奶汁</p>\r\n	      	<p>&emsp;&emsp;适量加入牛奶调理，可以补充更多钙质，对于正在减肥中的女孩来说，也比较有饱足感。经常失眠或是容易经痛的女孩也可以喝喝看！</p>\r\n	      	<br>\r\n	      	<br>\r\n	      	<p>&emsp;&emsp;止咳防晕－芒果汁</p>\r\n	      	<p>&emsp;&emsp;退火利尿－椰子汁</p>\r\n	      	<p>&emsp;&emsp;不过有的人会怕椰子的味道，也因为椰子水生冷寒性，因此女孩们如果想喝椰子水来消暑，或是肠胃不好的人，在喝之前还是要三思！</p>\r\n	      	<p>&emsp;&emsp;水果之王－奇异果汁</p>\r\n	      	<img src=\"/images/banner.jpg\">');
INSERT INTO `menu` VALUES ('4', '香蕉谭富英', '15.33', '/images/p3.png', '        	<p>&emsp;&emsp;排毒排便－香蕉牛奶汁</p>\r\n	      	<p>&emsp;&emsp;适量加入牛奶调理，可以补充更多钙质，对于正在减肥中的女孩来说，也比较有饱足感。经常失眠或是容易经痛的女孩也可以喝喝看！</p>\r\n	      	<br>\r\n	      	<br>\r\n	      	<p>&emsp;&emsp;止咳防晕－芒果汁</p>\r\n	      	<p>&emsp;&emsp;退火利尿－椰子汁</p>\r\n	      	<p>&emsp;&emsp;不过有的人会怕椰子的味道，也因为椰子水生冷寒性，因此女孩们如果想喝椰子水来消暑，或是肠胃不好的人，在喝之前还是要三思！</p>\r\n	      	<p>&emsp;&emsp;水果之王－奇异果汁</p>\r\n	      	<img src=\"/images/banner.jpg\">');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('19', '1', '1', '2', '2017-06-12 13:35:32', '2017-06-12 13:35:32', '0');
INSERT INTO `order` VALUES ('18', '1', '1', '2', '2017-06-12 13:29:35', '2017-06-12 13:29:35', '0');
INSERT INTO `order` VALUES ('20', '1', '1', '2', '2017-06-12 13:39:13', '2017-06-12 13:39:13', '0');
