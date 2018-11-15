/*
Navicat MySQL Data Transfer

Source Server         : 香港
Source Server Version : 50556
Source Host           : 119.28.16.147:3306
Source Database       : auth

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-05-16 15:01:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group`;
CREATE TABLE `admin_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '组别名称',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_manage` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1需要验证权限 2 不需要验证权限',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_auth_group
-- ----------------------------
INSERT INTO `admin_auth_group` VALUES ('27', '超级管理员', '1', '1', '2,42,41,14,21,24,25,26,27,22,28,29,30,31,23,33,35,37,39,40,38');
INSERT INTO `admin_auth_group` VALUES ('28', '编辑', '1', '1', '14,23,32,33');
INSERT INTO `admin_auth_group` VALUES ('29', '项目经理', '1', '1', '2');

-- ----------------------------
-- Table structure for admin_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group_access`;
CREATE TABLE `admin_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_auth_group_access
-- ----------------------------
INSERT INTO `admin_auth_group_access` VALUES ('15', '27');
INSERT INTO `admin_auth_group_access` VALUES ('15', '28');
INSERT INTO `admin_auth_group_access` VALUES ('16', '27');
INSERT INTO `admin_auth_group_access` VALUES ('16', '28');
INSERT INTO `admin_auth_group_access` VALUES ('18', '28');

-- ----------------------------
-- Table structure for admin_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_rule`;
CREATE TABLE `admin_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) DEFAULT '' COMMENT '图标',
  `menu_name` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一标识Controller/action',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` tinyint(5) NOT NULL DEFAULT '0' COMMENT '菜单ID ',
  `is_menu` tinyint(1) DEFAULT '1' COMMENT '1:是主菜单 2 否',
  `is_race_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:是 2:不是',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_auth_rule
-- ----------------------------
INSERT INTO `admin_auth_rule` VALUES ('2', '', '', '基本管理', '0', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('4', '&amp;#xe613;', 'User/index', '用户管理', '2', '1', '1', '1', '2', '');
INSERT INTO `admin_auth_rule` VALUES ('7', 'asdasd', 'asd/asdasd', '三级菜单', '4', '2', '1', '1', '2', '');
INSERT INTO `admin_auth_rule` VALUES ('14', '', '', '权限管理', '0', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('39', '&amp;#xe609;', 'Task/AddTaskType', '新增工单类型', '37', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('40', '&amp;#xe647;', 'Task/taskList', '任务总览', '37', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('42', '&amp;#xe69c;', 'Task/AbnormalTask', '我的异常任务', '2', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('20', 'asd', 'User/addUser', '添加用户', '4', '2', '1', '1', '2', '');
INSERT INTO `admin_auth_rule` VALUES ('21', '&amp;#xe624;', 'Menu/index', '菜单管理', '14', '1', '2', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('22', '&amp;#xe612;', 'AuthGroup/authGroupList', '角色管理', '14', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('23', '&amp;#xe613;', 'User/index', '用户管理', '14', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('24', '13', 'Menu/addMenu', '添加菜单', '21', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('25', '213', 'Menu/editMenu', '编辑菜单', '21', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('26', '435', 'Menu/deleteMenu', '删除菜单', '21', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('27', '13', 'Menu/viewOpt', '查看三级菜单', '21', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('28', '123', 'AuthGroup/addGroup', '添加角色', '22', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('29', '35', 'AuthGroup/editGroup', '编辑角色', '22', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('30', '345', 'AuthGroup/deleteGroup', '删除角色', '22', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('31', 'asd', 'AuthGroup/ruleGroup', '分配权限', '22', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('32', '13', 'User/addUser', '添加用户', '23', '2', '1', '1', '2', '');
INSERT INTO `admin_auth_rule` VALUES ('33', '324', 'User/editUser', '编辑用户', '23', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('34', '435', 'User/deleterUser', '删除用户', '23', '2', '1', '1', '2', '');
INSERT INTO `admin_auth_rule` VALUES ('35', '234', 'AuthGroup/giveRole', '分配角色', '23', '2', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('41', '&amp;#xe642;', 'User/Yourself', '个人信息管理', '2', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('37', '&amp;#xe637;', '', '工单管理', '0', '1', '1', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('38', '&amp;#xe637;', 'Task/index', '工单列表', '37', '1', '1', '1', '1', '');

-- ----------------------------
-- Table structure for admin_form_type
-- ----------------------------
DROP TABLE IF EXISTS `admin_form_type`;
CREATE TABLE `admin_form_type` (
  `Tid` int(3) NOT NULL,
  `title` varchar(30) NOT NULL,
  `type` int(1) NOT NULL,
  `ziduan` varchar(30) NOT NULL,
  PRIMARY KEY (`Tid`,`title`,`type`,`ziduan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_form_type
-- ----------------------------
INSERT INTO `admin_form_type` VALUES ('1', '任务摘要', '0', 'zhaiyao');
INSERT INTO `admin_form_type` VALUES ('1', '任务详情', '1', 'xiangqing');
INSERT INTO `admin_form_type` VALUES ('23', 'eqwrqerq', '0', 'wqewq');
INSERT INTO `admin_form_type` VALUES ('23', 'ewqeq', '0', 'rqr');

-- ----------------------------
-- Table structure for admin_task
-- ----------------------------
DROP TABLE IF EXISTS `admin_task`;
CREATE TABLE `admin_task` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tid` int(4) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `createid` int(4) NOT NULL,
  `exeid` int(4) NOT NULL,
  `checkid` int(4) NOT NULL,
  `time` int(15) NOT NULL,
  `exe_time` int(15) DEFAULT NULL,
  `check_time` int(15) DEFAULT NULL,
  `state` varchar(20) NOT NULL,
  `back_note` varchar(150) DEFAULT NULL,
  `check_note` varchar(150) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_task
-- ----------------------------
INSERT INTO `admin_task` VALUES ('1', '1', '中南海', '15', '16', '18', '1522850687', null, null, '', null, null, '2', '{\"user_name\":\"admin\",\"zhaiyao\":\"中南海\",\"xiangqing\":\"去维护一下中南海的电话系统\"}', null);
INSERT INTO `admin_task` VALUES ('4', '23', 'hello world!', '15', '15', '15', '1523023043', '1524235511', '1524237472', '5', '好了   请检查', '好的', '3', '{\"user_name\":\"admin\",\"wqewq\":\"hello world!\",\"rqr\":\"hello world!hello world!hello world!\"}', null);
INSERT INTO `admin_task` VALUES ('5', '1', '呼兰路办公室系统安装', '16', '15', '15', '1523026193', '1525151665', null, '3', '已完成', null, '1', '{\"zhaiyao\":\"呼兰路办公室系统安装\",\"xiangqing\":\"呼兰路办公室系统安装\"}', null);
INSERT INTO `admin_task` VALUES ('6', '1', '去看看系统有没有BUG', '15', '16', '18', '1523543452', null, null, '0', null, null, '2', '{\"zhaiyao\":\"去看看系统有没有BUG\",\"xiangqing\":\"至少找到10个bug\"}', null);
INSERT INTO `admin_task` VALUES ('7', '1', '哈哈哈', '15', '18', '16', '1523955190', null, null, '1', null, null, '1', '{\"zhaiyao\":\"哈哈哈\",\"xiangqing\":\"滚蛋\"}', null);
INSERT INTO `admin_task` VALUES ('8', '23', '哈哈哈', '15', '18', '15', '1523955222', null, null, '3', null, null, '1', '{\"wqewq\":\"哈哈哈\",\"rqr\":\"服你丹巴更让人\"}', null);
INSERT INTO `admin_task` VALUES ('9', '1', '哈哈哈g', '15', '15', '18', '1523955244', null, null, '1', null, null, '1', '{\"zhaiyao\":\"哈哈哈g\",\"xiangqing\":\"放大黄日华\"}', null);
INSERT INTO `admin_task` VALUES ('10', '1', 'hahahahha', '15', '17', '15', '1525787765', null, null, '0', null, null, '1', '{\"zhaiyao\":\"hahahahha\",\"xiangqing\":\"个好人扶危济困根火腿送花给i\"}', null);
INSERT INTO `admin_task` VALUES ('11', '1', '和她热火有特价业绩', '15', '15', '16', '1525787799', null, null, '2', null, null, '1', '{\"zhaiyao\":\"和她热火有特价业绩\",\"xiangqing\":\"还挺热就业\"}', '');
INSERT INTO `admin_task` VALUES ('12', '1', '哈哈哈g', '15', '15', '16', '1525788574', null, null, '1', null, null, '0', '{\"zhaiyao\":\"哈哈哈g\",\"xiangqing\":\"还有他法布尔雅u\"}', null);
INSERT INTO `admin_task` VALUES ('13', '1', '信息楼电子教室系统维护', '15', '18', '15', '1526014127', '1526014863', '1526015072', '5', '已解决电子教室不稳定的问题，主要是由于机房服务器出现波动，重启之后恢复正常', '已经确认过可以正常运行，后续请查找清楚原因', '0', '{\"zhaiyao\":\"信息楼电子教室系统维护\",\"xiangqing\":\"信息楼电子教室系统出现不稳定的情况，部分学生无法正常进行实验课，请前往现场完成任务\"}', null);

-- ----------------------------
-- Table structure for admin_task_list
-- ----------------------------
DROP TABLE IF EXISTS `admin_task_list`;
CREATE TABLE `admin_task_list` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `createtime` varchar(30) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `level` int(1) NOT NULL COMMENT '工单安全级别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_task_list
-- ----------------------------
INSERT INTO `admin_task_list` VALUES ('1', '系统维护工单', '1522593653', '1', '0');
INSERT INTO `admin_task_list` VALUES ('23', 'qwerty', '1522680095', '1', '0');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据编号',
  `user_name` varchar(20) NOT NULL COMMENT '登录名',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  `phone` varchar(12) DEFAULT NULL,
  `task_num` int(3) DEFAULT NULL,
  `lastlogin_time` int(11) unsigned DEFAULT NULL COMMENT '最后一次登录时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许用户登录(1是  2否)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='后台用户表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('15', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '15487549654', '2', '1526435285', '1');
INSERT INTO `admin_user` VALUES ('16', 'test', 'e10adc3949ba59abbe56e057f20f883e', '18110785363', '3', '1525787493', '1');
INSERT INTO `admin_user` VALUES ('17', 'wuyawnen', 'e10adc3949ba59abbe56e057f20f883e', '18110785363', '4', '1480668214', '1');
INSERT INTO `admin_user` VALUES ('18', 'yongchengwang', 'e10adc3949ba59abbe56e057f20f883e', '18110785363', null, '1526014146', '1');
INSERT INTO `admin_user` VALUES ('19', 'wwwyc', '2456aa80e94b616ab84948d79a26c597', '15114141214', null, '1522467716', '2');

-- ----------------------------
-- Table structure for admin_user_worktype
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_worktype`;
CREATE TABLE `admin_user_worktype` (
  `uid` int(3) NOT NULL,
  `wid` int(3) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_worktype
-- ----------------------------
