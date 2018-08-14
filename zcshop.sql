/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zcshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-14 20:26:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `zc_admin`
-- ----------------------------
DROP TABLE IF EXISTS `zc_admin`;
CREATE TABLE `zc_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL COMMENT '管理员名称',
  `admin_password` varchar(255) NOT NULL COMMENT '管理员密码',
  `admin_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `admin_login_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `admin_is_super` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否超级管理员 0是 1否',
  `admin_gid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限组ID',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of zc_admin
-- ----------------------------
INSERT INTO `zc_admin` VALUES ('7', 'zhusixun', 'a616af86c544a2de3353ba8185b19e36', '0', '0', '0', '0');
INSERT INTO `zc_admin` VALUES ('8', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '1', '1');
INSERT INTO `zc_admin` VALUES ('9', 'dahai', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '1', '1');

-- ----------------------------
-- Table structure for `zc_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `zc_attribute`;
CREATE TABLE `zc_attribute` (
  `attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) NOT NULL COMMENT '属性名称',
  `attr_values` varchar(255) NOT NULL COMMENT '属性值 值用,区分开',
  `attr_type` int(10) unsigned NOT NULL COMMENT '属性类别 0多选 1唯一',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of zc_attribute
-- ----------------------------
INSERT INTO `zc_attribute` VALUES ('1', '颜色', '黄色,红色,蓝色,绿色', '0');
INSERT INTO `zc_attribute` VALUES ('2', '出版社', '中央人民出版社,湖南人民出版社,广州人民出版社', '1');
INSERT INTO `zc_attribute` VALUES ('3', '网络支持', '移动,电信,联通', '0');
INSERT INTO `zc_attribute` VALUES ('4', 'i系列处理器', 'i3,i5,i7', '1');
INSERT INTO `zc_attribute` VALUES ('5', '含棉量', '30,50,80,100', '1');
INSERT INTO `zc_attribute` VALUES ('7', '屏幕尺寸', '14,15,16', '1');

-- ----------------------------
-- Table structure for `zc_brand`
-- ----------------------------
DROP TABLE IF EXISTS `zc_brand`;
CREATE TABLE `zc_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL COMMENT '品牌名称',
  `brand_initial` varchar(255) NOT NULL COMMENT '品牌首字母',
  `brand_logo` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌Logo',
  `brand_sort` int(10) unsigned NOT NULL COMMENT '排序',
  `brand_apply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '品牌申请 0为申请中 1为通过 2未通过 申请功能只能会员使用',
  `brand_recommend` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐 0是 1否',
  `gc_id` int(10) unsigned NOT NULL COMMENT '商品分类ID',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品品牌表';

-- ----------------------------
-- Records of zc_brand
-- ----------------------------
INSERT INTO `zc_brand` VALUES ('7', '华为', 'H', 'uploads/brand/thumb/20180812/380b0e17ef58f50232ef290723b29ec6.png', '1', '1', '0', '5');
INSERT INTO `zc_brand` VALUES ('8', '小米', 'X', 'uploads/brand/thumb/20180809/f5fe77875e414e5d38619fea780e9dc2.jpg', '3', '2', '0', '3');
INSERT INTO `zc_brand` VALUES ('9', '波司登', 'B', 'uploads/brand/thumb/20180809/0b20e180eaec3d13b5046c61ba627e6e.jpg', '2', '2', '0', '9');
INSERT INTO `zc_brand` VALUES ('10', '华硕', 'H', 'uploads/brand/thumb/20180809/4c13e2a50f239bd6f9787544cff93c7f.jpg', '4', '1', '0', '5');
INSERT INTO `zc_brand` VALUES ('11', '﻿﻿Apple Orange', 'A', 'uploads/brand/thumb/20180809/169fdf31d459eeb6fed66ee0fd4db98c.jpg', '6', '1', '0', '9');
INSERT INTO `zc_brand` VALUES ('12', '卡骆驰(Crocs)', 'C', 'uploads/brand/thumb/20180809/d44b2631b0b777c7adcfff12ed503f59.jpg', '8', '2', '1', '2');
INSERT INTO `zc_brand` VALUES ('13', '迪奥(Dior)', 'D', 'uploads/brand/thumb/20180809/874ada2b6e1aea2464ba39f82b8efff0.jpg', '15', '1', '0', '2');
INSERT INTO `zc_brand` VALUES ('14', '魅族', 'M', 'uploads/brand/thumb/20180809/2b2583b452e812fa743f103da99b9b2c.jpg', '55', '0', '0', '3');

-- ----------------------------
-- Table structure for `zc_exppointslog`
-- ----------------------------
DROP TABLE IF EXISTS `zc_exppointslog`;
CREATE TABLE `zc_exppointslog` (
  `explog_id` int(10) unsigned NOT NULL,
  `explog_member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `explog_member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `ex_rule_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值规则ID',
  `explog_addtime` int(10) unsigned NOT NULL COMMENT '经验添加时间',
  PRIMARY KEY (`explog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='经验日志表';

-- ----------------------------
-- Records of zc_exppointslog
-- ----------------------------
INSERT INTO `zc_exppointslog` VALUES ('0', '1', 'zhusixun', '1', '1534214840');

-- ----------------------------
-- Table structure for `zc_exppoints_rule`
-- ----------------------------
DROP TABLE IF EXISTS `zc_exppoints_rule`;
CREATE TABLE `zc_exppoints_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `explog_stage` varchar(255) NOT NULL COMMENT '经验值操作状态',
  `explog_pattern` tinyint(3) unsigned NOT NULL COMMENT '规则模式 0固定值 1比例值 2最大值',
  `add_exppoints` int(10) unsigned NOT NULL COMMENT '增加经验值',
  `explog_desc` varchar(255) NOT NULL COMMENT '经验值操作描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='经验值规则表';

-- ----------------------------
-- Records of zc_exppoints_rule
-- ----------------------------
INSERT INTO `zc_exppoints_rule` VALUES ('1', 'login', '0', '20', '会员每天第一次登录');
INSERT INTO `zc_exppoints_rule` VALUES ('2', 'comments', '0', '10', '订单商品评论');
INSERT INTO `zc_exppoints_rule` VALUES ('3', 'order_rate', '1', '10', '消费赠送经验值');
INSERT INTO `zc_exppoints_rule` VALUES ('4', 'order_max', '2', '100', '每订单赠送经验值');

-- ----------------------------
-- Table structure for `zc_gadmin`
-- ----------------------------
DROP TABLE IF EXISTS `zc_gadmin`;
CREATE TABLE `zc_gadmin` (
  `gid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gname` varchar(255) NOT NULL COMMENT '权限组名',
  `glimits` text NOT NULL COMMENT '权限组序列',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='权限组';

-- ----------------------------
-- Records of zc_gadmin
-- ----------------------------
INSERT INTO `zc_gadmin` VALUES ('1', '呵呵', '1');

-- ----------------------------
-- Table structure for `zc_goods`
-- ----------------------------
DROP TABLE IF EXISTS `zc_goods`;
CREATE TABLE `zc_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_number` varchar(255) NOT NULL COMMENT '商品编号',
  `goods_inventory` int(10) unsigned NOT NULL COMMENT '商品库存',
  `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_promotion_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `goods_marketprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_promotion_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '促销类型 0无促销 1团购 2限时折扣',
  `goods_click` int(10) unsigned NOT NULL COMMENT '商品点击次数',
  `goods_salenum` int(10) unsigned NOT NULL COMMENT '销售数量',
  `goods_collect` int(10) unsigned NOT NULL COMMENT '收藏数量',
  `goods_verify` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品状态 0正常 1禁售',
  `goods_commend` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品推荐 0推荐 1不推荐',
  `goods_freight` tinyint(3) unsigned NOT NULL COMMENT '运费 0免运费 1不免运费',
  `brand_id` int(10) unsigned NOT NULL COMMENT '商品品牌ID',
  `gc_id` int(10) unsigned NOT NULL COMMENT '商品分类ID',
  `type_id` int(10) unsigned NOT NULL COMMENT '类型ID',
  `is_del` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否进入回收站 0是 1否',
  `goods_body` text NOT NULL COMMENT '商品描述',
  `is_out` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否下架 0是 1否',
  `is_check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态 0审核中 1审核通过 2审核未通过',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of zc_goods
-- ----------------------------
INSERT INTO `zc_goods` VALUES ('75', '华为Mate10', '4e9798499fcdf89db1799c1a5d9ddb04', '0', '4499.00', '0.00', '4999.00', '0', '0', '0', '0', '1', '0', '0', '7', '3', '55', '1', '<p>而非删除大声的</p>', '1', '1');
INSERT INTO `zc_goods` VALUES ('76', '小米8', '96f5b22f0e87f6ffeb15d129eb8d585b', '0', '4499.00', '0.00', '4999.00', '0', '0', '0', '0', '1', '0', '0', '8', '3', '54', '1', '<p>萨达萨达sa</p>', '0', '1');
INSERT INTO `zc_goods` VALUES ('78', '华为P10', 'e43c6a07af3802326f7ed8ec0549d8a9', '15666', '4499.00', '0.00', '4999.00', '0', '0', '0', '0', '0', '0', '0', '7', '4', '54', '1', '<p>撒打算打算的萨达萨达</p>', '1', '2');

-- ----------------------------
-- Table structure for `zc_goodsclass`
-- ----------------------------
DROP TABLE IF EXISTS `zc_goodsclass`;
CREATE TABLE `zc_goodsclass` (
  `gc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gc_name` varchar(255) NOT NULL COMMENT '商品分类名称',
  `gc_parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `gc_show` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示前台 0是 1否',
  PRIMARY KEY (`gc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of zc_goodsclass
-- ----------------------------
INSERT INTO `zc_goodsclass` VALUES ('1', '电子产品', '0', '1');
INSERT INTO `zc_goodsclass` VALUES ('2', '生活用品', '0', '0');
INSERT INTO `zc_goodsclass` VALUES ('3', '手机', '1', '1');
INSERT INTO `zc_goodsclass` VALUES ('4', '平板', '1', '1');
INSERT INTO `zc_goodsclass` VALUES ('5', '笔记本', '1', '0');
INSERT INTO `zc_goodsclass` VALUES ('10', '女装', '9', '0');
INSERT INTO `zc_goodsclass` VALUES ('9', '衣服', '2', '0');

-- ----------------------------
-- Table structure for `zc_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `zc_goods_attr`;
CREATE TABLE `zc_goods_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `attr_id` int(10) unsigned NOT NULL COMMENT '属性ID',
  `attr_values` varchar(255) NOT NULL COMMENT '属性值 用,区分开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='商品与属性中间表';

-- ----------------------------
-- Records of zc_goods_attr
-- ----------------------------
INSERT INTO `zc_goods_attr` VALUES ('22', '75', '3', '移动,电信,联通');
INSERT INTO `zc_goods_attr` VALUES ('23', '75', '1', '黄色,红色,蓝色,绿色');
INSERT INTO `zc_goods_attr` VALUES ('24', '76', '1', '黄色,红色,蓝色,绿色');
INSERT INTO `zc_goods_attr` VALUES ('25', '77', '1', '黄色,红色,蓝色,绿色');
INSERT INTO `zc_goods_attr` VALUES ('26', '78', '1', '黄色,红色,蓝色,绿色');

-- ----------------------------
-- Table structure for `zc_image`
-- ----------------------------
DROP TABLE IF EXISTS `zc_image`;
CREATE TABLE `zc_image` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL COMMENT '相册名称',
  `img_photo` text NOT NULL COMMENT '原图 每张图片以 , 隔开',
  `img_thumb` text NOT NULL COMMENT '缩略图 每张图片以 , 隔开',
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `img_logo` varchar(255) NOT NULL COMMENT '封面',
  `img_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片数',
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品相册表';

-- ----------------------------
-- Records of zc_image
-- ----------------------------
INSERT INTO `zc_image` VALUES ('2', '华为Mate10', 'uploads/goods/20180813\\836bd7579cc3cf979c2051fe13aa6d44.jpg,uploads/goods/20180813\\c8e0dc8349267bf7247d786709e1ae94.png', 'uploads/goods/thumb/20180813/836bd7579cc3cf979c2051fe13aa6d44.jpg,uploads/goods/thumb/20180813/c8e0dc8349267bf7247d786709e1ae94.png', '78', 'uploads/images/thumb/20180809/7b783266ebd0c278da4e428bbfc87c8d.jpg', '0');
INSERT INTO `zc_image` VALUES ('4', '波司登', 'uploads/goods/20180813\\c2b2b8d3141b1c99499a1bfa6961802e.jpg,uploads/goods/20180813\\7d87975dfe753f174ac2cc12aaca01f6.jpg,uploads/goods/20180813\\597b28de1a51eb2ae8360276e69b8992.jpg', 'uploads/goods/thumb/20180813/c2b2b8d3141b1c99499a1bfa6961802e.jpg,uploads/goods/thumb/20180813/7d87975dfe753f174ac2cc12aaca01f6.jpg,uploads/goods/thumb/20180813/597b28de1a51eb2ae8360276e69b8992.jpg', '77', 'uploads/images/thumb/20180813/641332b2db1bf67f7042b98bbe2c3e9b.jpg', '0');
INSERT INTO `zc_image` VALUES ('3', '小米', 'uploads/goods/20180813\\48b542e4d098f5d9cd3cdeb7f75c1497.jpg,uploads/goods/20180813\\4826f360759419be5e137c5e60e4fc4d.png,uploads/goods/20180813\\f5c32cfd739e6a10db34bbdf5791d11d.png', 'uploads/goods/thumb/20180813/48b542e4d098f5d9cd3cdeb7f75c1497.jpg,uploads/goods/thumb/20180813/4826f360759419be5e137c5e60e4fc4d.png,uploads/goods/thumb/20180813/f5c32cfd739e6a10db34bbdf5791d11d.png', '76', 'uploads/images/thumb/20180813/8ceb6fe0eefbaaf88a5bd54a798fe78d.jpg', '0');

-- ----------------------------
-- Table structure for `zc_member`
-- ----------------------------
DROP TABLE IF EXISTS `zc_member`;
CREATE TABLE `zc_member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL COMMENT '会员用户名',
  `member_truename` varchar(255) NOT NULL COMMENT '会员真实姓名',
  `member_avatar` varchar(255) NOT NULL COMMENT '会员头像',
  `member_sex` tinyint(3) unsigned NOT NULL COMMENT '会员性别 0男 1女',
  `member_password` varchar(255) NOT NULL COMMENT '会员密码',
  `member_paypwd` varchar(255) NOT NULL COMMENT '支付密码',
  `member_email` varchar(255) NOT NULL COMMENT '会员邮箱',
  `member_moblie` varchar(255) NOT NULL COMMENT '手机号码',
  `member_qq` varchar(255) NOT NULL COMMENT '会员QQ',
  `member_login_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员登录次数',
  `member_addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员添加时间',
  `member_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员当前登录时间',
  `member_old_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员上次登录时间',
  `member_login_ip` varchar(255) NOT NULL COMMENT '会员当前登录IP',
  `member_old_login_ip` varchar(255) NOT NULL COMMENT '会员上次登录IP',
  `member_points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员积分',
  `member_exppoints` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员经验值',
  `member_areaid` int(10) unsigned NOT NULL COMMENT '地区ID',
  `member_cityid` int(10) unsigned NOT NULL COMMENT '城市ID',
  `member_provinceid` int(10) unsigned NOT NULL COMMENT '省份ID',
  `member_areainfo` varchar(255) NOT NULL COMMENT '地区内容',
  `inform_allow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许举报 0是 1否',
  `is_buylimit` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有购买权限 0是 1否',
  `is_allowtalk` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否有咨询权限 0是 1否',
  `member_state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '会员是否登录 0是 1否',
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of zc_member
-- ----------------------------
INSERT INTO `zc_member` VALUES ('1', 'zhusixun', '朱锶洵', '', '1', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '2539357831@qq.com', '13962005498', '2539357831', '0', '0', '0', '0', '127.0.0.1', '127.0.0.1', '0', '0', '0', '0', '0', '', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `zc_member_grade`
-- ----------------------------
DROP TABLE IF EXISTS `zc_member_grade`;
CREATE TABLE `zc_member_grade` (
  `grade_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(255) NOT NULL COMMENT '会员级别',
  `grade_points` int(10) unsigned NOT NULL COMMENT '需要的经验值',
  PRIMARY KEY (`grade_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='会员等级表';

-- ----------------------------
-- Records of zc_member_grade
-- ----------------------------
INSERT INTO `zc_member_grade` VALUES ('1', 'V0', '0');
INSERT INTO `zc_member_grade` VALUES ('2', 'V1', '100');
INSERT INTO `zc_member_grade` VALUES ('3', 'V2', '200');
INSERT INTO `zc_member_grade` VALUES ('4', 'V3', '300');
INSERT INTO `zc_member_grade` VALUES ('5', 'V4', '500');
INSERT INTO `zc_member_grade` VALUES ('6', 'V5', '700');
INSERT INTO `zc_member_grade` VALUES ('7', 'V6', '900');
INSERT INTO `zc_member_grade` VALUES ('8', 'V7', '1200');
INSERT INTO `zc_member_grade` VALUES ('9', 'V8', '1500');
INSERT INTO `zc_member_grade` VALUES ('10', 'V9', '1800');
INSERT INTO `zc_member_grade` VALUES ('11', 'V10', '2500');

-- ----------------------------
-- Table structure for `zc_pointslog`
-- ----------------------------
DROP TABLE IF EXISTS `zc_pointslog`;
CREATE TABLE `zc_pointslog` (
  `pl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pl_member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `pl_member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `pl_check_id` int(10) unsigned NOT NULL COMMENT '积分调整ID',
  `pl_addtime` int(10) unsigned NOT NULL COMMENT '积分添加时间',
  `pl_admin_id` int(10) unsigned NOT NULL COMMENT '管理员ID',
  `pl_admin_name` varchar(255) NOT NULL COMMENT '管理员名称',
  `pl_points_comments` varchar(255) NOT NULL COMMENT '积分操作描述',
  `pl_check_type` tinyint(3) unsigned NOT NULL COMMENT '增减类型 0增加 1减少',
  `pl_check_points` int(11) NOT NULL COMMENT '调整积分值 ',
  PRIMARY KEY (`pl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='积分日志表';

-- ----------------------------
-- Records of zc_pointslog
-- ----------------------------
INSERT INTO `zc_pointslog` VALUES ('1', '1', 'zhusixun', '1', '1534214840', '1', 'admin', '每天第一次登录', '0', '10');
INSERT INTO `zc_pointslog` VALUES ('2', '1', 'zhusixun', '0', '0', '0', '', '嫖娼来的', '0', '10');

-- ----------------------------
-- Table structure for `zc_type`
-- ----------------------------
DROP TABLE IF EXISTS `zc_type`;
CREATE TABLE `zc_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- ----------------------------
-- Records of zc_type
-- ----------------------------
INSERT INTO `zc_type` VALUES ('56', '衣服');
INSERT INTO `zc_type` VALUES ('54', '手机');
INSERT INTO `zc_type` VALUES ('55', '键盘');

-- ----------------------------
-- Table structure for `zc_type_attr`
-- ----------------------------
DROP TABLE IF EXISTS `zc_type_attr`;
CREATE TABLE `zc_type_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL COMMENT '类型ID',
  `attr_id` int(10) unsigned NOT NULL COMMENT '属性ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='类型与属性关联表';

-- ----------------------------
-- Records of zc_type_attr
-- ----------------------------
INSERT INTO `zc_type_attr` VALUES ('48', '55', '3');
INSERT INTO `zc_type_attr` VALUES ('47', '55', '1');
INSERT INTO `zc_type_attr` VALUES ('46', '54', '1');
