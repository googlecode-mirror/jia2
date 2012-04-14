-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-04-14 10:02:19
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for jia2
CREATE DATABASE IF NOT EXISTS `jia2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jia2`;


-- Dumping structure for table jia2.activity
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `corporation_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activities_users1` (`user_id`),
  KEY `fk_activities_corporations1` (`corporation_id`),
  CONSTRAINT `fk_activities_corporation1` FOREIGN KEY (`corporation_id`) REFERENCES `corporation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_activities_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activity: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- Dumping structure for table jia2.activity_auth
CREATE TABLE IF NOT EXISTS `activity_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `operation_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_activity_auth_activity` (`owner_id`),
  KEY `FK_activity_auth_identity` (`identity_id`),
  KEY `FK_activity_auth_operation` (`operation_id`),
  CONSTRAINT `FK_activity_auth_activity` FOREIGN KEY (`owner_id`) REFERENCES `corporation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_activity_auth_identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_activity_auth_operation` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activity_auth: ~12 rows (approximately)
/*!40000 ALTER TABLE `activity_auth` DISABLE KEYS */;
REPLACE INTO `activity_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`) VALUES
	(13, 7, 2, 1, 1),
	(14, 7, 3, 1, 1),
	(15, 7, 10, 1, 1),
	(16, 7, 6, 1, 1),
	(17, 7, 7, 1, 1),
	(18, 7, 7, 2, 1),
	(19, 7, 7, 3, 1),
	(20, 7, 7, 4, 1),
	(21, 7, 8, 1, 1),
	(22, 7, 8, 2, 1),
	(23, 7, 8, 3, 1),
	(24, 7, 8, 4, 1);
/*!40000 ALTER TABLE `activity_auth` ENABLE KEYS */;


-- Dumping structure for table jia2.activity_meta
CREATE TABLE IF NOT EXISTS `activity_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_meta_activities1` (`activity_id`),
  CONSTRAINT `fk_activity_meta_activity1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activity_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_comments_posts1` (`post_id`),
  KEY `fk_comments_users1` (`user_id`),
  CONSTRAINT `fk_comments_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.comment: ~45 rows (approximately)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
REPLACE INTO `comment` (`id`, `post_id`, `user_id`, `content`, `time`, `status`) VALUES
	(1, 15, 10, '泪流满面啊', '1333727643', 1),
	(2, 15, 10, '而黄家坎', '1333728396', 1),
	(3, 15, 10, '而黄家坎', '1333728403', 1),
	(4, 15, 10, '而啊哈同济牙科', '1333728439', 1),
	(5, 15, 10, '泪流满面啊\n\n而黄家坎\n\n而黄家坎\n\n而啊哈同济牙科', '1333728507', 1),
	(6, 15, 10, 'sjhkl;\'', '1333728533', 1),
	(7, 15, 10, '泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科', '1333728715', 1),
	(8, 14, 10, '泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科', '1333728726', 1),
	(9, 15, 10, '泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科', '1333728759', 1),
	(10, 14, 10, '泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科', '1333728764', 1),
	(11, 12, 10, '泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科', '1333728776', 1),
	(12, 12, 10, '测试第一篇帖子！！！！', '1333728781', 1),
	(13, 19, 10, '王尼玛每天早上都起来跑步,然后 CCC', '1333728941', 1),
	(14, 19, 10, '早上都起来跑步,然后 CCC ', '1333728980', 1),
	(15, 17, 11, '尼玛每天早上都起 ', '1333757784', 1),
	(16, 20, 11, '风格啊', '1333761945', 1),
	(17, 14, 11, '阿尔和他', '1333761948', 1),
	(18, 17, 11, '自己肯定能给自己回复撒', '1333761974', 1),
	(19, 20, 11, '几把', '1333806417', 1),
	(20, 21, 11, 'dd', '1333853845', 1),
	(21, 21, 11, 'gg', '1333853848', 1),
	(22, 21, 11, 'rr', '1333853850', 1),
	(23, 20, 11, 're', '1333853857', 1),
	(24, 20, 11, 'tewtw', '1333853859', 1),
	(25, 19, 11, 'rw', '1333853862', 1),
	(26, 34, 11, '回复一下看看', '1334063597', 1),
	(27, 34, 11, '个人主页', '1334063604', 1),
	(28, 34, 11, '回复', '1334063630', 1),
	(29, 15, 11, 'ceshi ', '1334065431', 1),
	(30, 35, 11, '测试ajax返回', '1334134802', 1),
	(31, 34, 11, '测试返回', '1334134851', 1),
	(32, 10, 11, '这尼玛！必须要成功！', '1334134915', 1),
	(33, 22, 11, '这尼玛什么状况！', '1334134940', 1),
	(34, 22, 11, '没见过老子刷评论！', '1334134951', 1),
	(35, 22, 11, '老子就是没见过怎么了！怎么了！', '1334134961', 1),
	(36, 35, 11, '老子来试看看ajax喃', '1334137345', 1),
	(37, 35, 11, '这种岩石爽！', '1334224276', 1),
	(38, 35, 11, '我喜欢这种的！ \'你妹啊\'', '1334239113', 1),
	(39, 35, 11, '这是个什么状况', '1334309262', 1),
	(40, 34, 11, '再试一次', '1334309330', 1),
	(41, 15, 11, '尼玛！', '1334309997', 1),
	(42, 15, 11, '', '1334310003', 1),
	(43, 15, 11, '', '1334310005', 1),
	(44, 14, 11, '这尼玛', '1334310349', 1),
	(45, 35, 11, '这尼玛是什么情况！', '1334366045', 1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Dumping structure for table jia2.comment_auth
CREATE TABLE IF NOT EXISTS `comment_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL DEFAULT '0',
  `type_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `operation_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_comment_auth_identity` (`identity_id`),
  KEY `FK_comment_auth_operation` (`operation_id`),
  KEY `FK_comment_auth_post_type` (`type_id`),
  CONSTRAINT `FK_comment_auth_identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_auth_operation` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_auth_post_type` FOREIGN KEY (`type_id`) REFERENCES `post_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.comment_auth: ~46 rows (approximately)
/*!40000 ALTER TABLE `comment_auth` DISABLE KEYS */;
REPLACE INTO `comment_auth` (`id`, `owner_id`, `type_id`, `identity_id`, `operation_id`, `access`) VALUES
	(14, 10, 1, 2, 1, 1),
	(15, 10, 1, 3, 1, 1),
	(16, 10, 1, 3, 2, 1),
	(17, 10, 1, 5, 1, 1),
	(18, 10, 1, 5, 2, 1),
	(19, 10, 1, 5, 4, 1),
	(20, 10, 1, 4, 1, 1),
	(21, 10, 1, 4, 2, 1),
	(22, 10, 1, 11, 1, 1),
	(23, 10, 1, 11, 2, 1),
	(24, 10, 1, 11, 4, 1),
	(25, 11, 1, 2, 1, 1),
	(26, 11, 1, 3, 1, 1),
	(27, 11, 1, 3, 2, 1),
	(28, 11, 1, 5, 1, 1),
	(29, 11, 1, 5, 2, 1),
	(30, 11, 1, 5, 4, 1),
	(31, 11, 1, 4, 1, 1),
	(32, 11, 1, 4, 2, 1),
	(33, 11, 1, 11, 1, 1),
	(34, 11, 1, 11, 2, 1),
	(35, 11, 1, 11, 4, 1),
	(47, 13, 1, 2, 1, 1),
	(48, 13, 1, 3, 1, 1),
	(49, 13, 1, 3, 2, 1),
	(50, 13, 1, 5, 1, 1),
	(51, 13, 1, 5, 2, 1),
	(52, 13, 1, 5, 4, 1),
	(53, 13, 1, 4, 1, 1),
	(54, 13, 1, 4, 2, 1),
	(55, 13, 1, 11, 1, 1),
	(56, 13, 1, 11, 2, 1),
	(57, 13, 1, 11, 4, 1),
	(58, 7, 3, 2, 1, 1),
	(59, 7, 3, 3, 1, 1),
	(60, 7, 3, 3, 2, 1),
	(61, 7, 3, 5, 1, 1),
	(62, 7, 3, 5, 2, 1),
	(63, 7, 3, 5, 4, 1),
	(64, 7, 3, 6, 1, 1),
	(65, 7, 3, 6, 2, 1),
	(66, 7, 3, 7, 1, 1),
	(67, 7, 3, 7, 2, 1),
	(68, 7, 3, 7, 4, 1),
	(69, 7, 3, 10, 1, 1),
	(70, 7, 3, 10, 2, 1);
/*!40000 ALTER TABLE `comment_auth` ENABLE KEYS */;


-- Dumping structure for table jia2.corporation
CREATE TABLE IF NOT EXISTS `corporation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社团id',
  `name` varchar(45) NOT NULL COMMENT '学校',
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_corporations_school1` (`school_id`),
  KEY `fk_corporations_users1` (`user_id`),
  CONSTRAINT `fk_corporations_school1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_corporations_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.corporation: ~1 rows (approximately)
/*!40000 ALTER TABLE `corporation` DISABLE KEYS */;
REPLACE INTO `corporation` (`id`, `name`, `school_id`, `user_id`, `avatar`, `comment`) VALUES
	(7, '坑爹社团', 1, 11, 'default.jpg', '坑爹不解释');
/*!40000 ALTER TABLE `corporation` ENABLE KEYS */;


-- Dumping structure for table jia2.corporation_auth
CREATE TABLE IF NOT EXISTS `corporation_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `operation_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_corporation_auth_corporation` (`owner_id`),
  KEY `FK_corporation_auth_operation` (`operation_id`),
  KEY `FK__identity` (`identity_id`),
  CONSTRAINT `FK_corporation_auth_corporation` FOREIGN KEY (`owner_id`) REFERENCES `corporation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_corporation_auth_operation` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='社团权限表';

-- Dumping data for table jia2.corporation_auth: ~6 rows (approximately)
/*!40000 ALTER TABLE `corporation_auth` DISABLE KEYS */;
REPLACE INTO `corporation_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`) VALUES
	(15, 7, 2, 1, 1),
	(16, 7, 3, 1, 1),
	(17, 7, 6, 1, 1),
	(18, 7, 7, 1, 1),
	(19, 7, 8, 1, 1),
	(20, 7, 8, 3, 1);
/*!40000 ALTER TABLE `corporation_auth` ENABLE KEYS */;


-- Dumping structure for table jia2.corporation_meta
CREATE TABLE IF NOT EXISTS `corporation_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corporation_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_corporation_meta_corporations1` (`corporation_id`),
  CONSTRAINT `fk_corporation_meta_corporation1` FOREIGN KEY (`corporation_id`) REFERENCES `corporation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社团变化表';

-- Dumping data for table jia2.corporation_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `corporation_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `corporation_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.identity
CREATE TABLE IF NOT EXISTS `identity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户身份';

-- Dumping data for table jia2.identity: ~11 rows (approximately)
/*!40000 ALTER TABLE `identity` DISABLE KEYS */;
REPLACE INTO `identity` (`id`, `name`) VALUES
	(1, 'admin'),
	(2, 'guest'),
	(3, 'register'),
	(4, 'friend'),
	(5, 'self'),
	(6, 'co_member'),
	(7, 'co_admin'),
	(8, 'co_master'),
	(9, 'blocker'),
	(10, 'participant'),
	(11, 'po_master');
/*!40000 ALTER TABLE `identity` ENABLE KEYS */;


-- Dumping structure for table jia2.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_messages_message_type1` (`type_id`),
  KEY `fk_messages_users1` (`user_id`),
  CONSTRAINT `fk_messages_message_type1` FOREIGN KEY (`type_id`) REFERENCES `message_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_messages_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.message: ~0 rows (approximately)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;


-- Dumping structure for table jia2.message_meta
CREATE TABLE IF NOT EXISTS `message_meta` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messsage_meta_messages1` (`message_id`),
  CONSTRAINT `fk_messsage_meta_message1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.message_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `message_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.message_type
CREATE TABLE IF NOT EXISTS `message_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.message_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `message_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_type` ENABLE KEYS */;


-- Dumping structure for table jia2.operation
CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `comment` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='操作';

-- Dumping data for table jia2.operation: ~4 rows (approximately)
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;
REPLACE INTO `operation` (`id`, `name`, `comment`) VALUES
	(1, 'view', '查看'),
	(2, 'add', '添加'),
	(3, 'edit', '编辑'),
	(4, 'delete', '删除');
/*!40000 ALTER TABLE `operation` ENABLE KEYS */;


-- Dumping structure for table jia2.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `image` varchar(45) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_post_post_type1` (`type_id`),
  KEY `fk_post_users1` (`owner_id`),
  CONSTRAINT `fk_post_post_type1` FOREIGN KEY (`type_id`) REFERENCES `post_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.post: ~16 rows (approximately)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
REPLACE INTO `post` (`id`, `type_id`, `owner_id`, `title`, `content`, `image`, `time`, `status`) VALUES
	(1, 1, 5, '0', '测试帖', NULL, NULL, NULL),
	(10, 1, 10, NULL, '测试第一篇帖子！！！！', NULL, '1333508483', 1),
	(12, 1, 10, NULL, ' 测试第一篇帖子！！！！', NULL, '1333527676', 1),
	(13, 1, 10, NULL, '这尼玛，要发一个试试喃！', NULL, '1333702854', 1),
	(14, 1, 10, NULL, '帅气！灰常好！', NULL, '1333702868', 1),
	(15, 1, 10, NULL, '这个页面的大小被固定了哇~', NULL, '1333703006', 1),
	(16, 1, 11, NULL, '尼玛，晓得我叫啥子名字不！', NULL, '1333704398', 1),
	(17, 1, 11, NULL, '王尼玛每天早上都起来跑步,跑完步后在公园的凳子上睡个小觉,这天王尼玛又跑完步了,在公园的凳子上睡觉,这时来了一个基佬, 看着王尼玛长的挺俊的, 于是就把王尼玛XXX了', NULL, '1333714497', 1),
	(18, 1, 11, NULL, '这尼玛坑爹呐是吧!', NULL, '1333715483', 1),
	(19, 1, 10, NULL, '王尼玛每天早上都起来跑步,然后 CCC', NULL, '1333728932', 1),
	(20, 1, 11, NULL, '这尼玛是什么情况!', NULL, '1333760070', 1),
	(21, 1, 11, NULL, 'fgsh', NULL, '1333853832', 1),
	(22, 1, 11, NULL, 'gdgd', NULL, '1333853921', 1),
	(34, 1, 11, NULL, 'yjem', NULL, '1333900933', 1),
	(35, 1, 11, NULL, '这尼玛是神马情况！', NULL, '1334109378', 1),
	(36, 1, 13, NULL, '来发一条看看喃', NULL, '1334366637', 1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


-- Dumping structure for table jia2.post_auth
CREATE TABLE IF NOT EXISTS `post_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `operation_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_post_auth_identity` (`identity_id`),
  KEY `FK_post_auth_operation` (`operation_id`),
  KEY `FK_post_auth_user` (`owner_id`),
  CONSTRAINT `FK_post_auth_identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_auth_operation` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_auth_user` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='帖子查看权限验证';

-- Dumping data for table jia2.post_auth: ~18 rows (approximately)
/*!40000 ALTER TABLE `post_auth` DISABLE KEYS */;
REPLACE INTO `post_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`) VALUES
	(21, 10, 2, 1, 1),
	(22, 10, 3, 1, 1),
	(23, 10, 4, 1, 1),
	(24, 10, 5, 1, 1),
	(25, 10, 5, 2, 1),
	(26, 10, 5, 4, 1),
	(27, 11, 2, 1, 1),
	(28, 11, 3, 1, 1),
	(29, 11, 4, 1, 1),
	(30, 11, 5, 1, 1),
	(31, 11, 5, 2, 1),
	(32, 11, 5, 4, 1),
	(39, 13, 2, 1, 1),
	(40, 13, 3, 1, 1),
	(41, 13, 4, 1, 1),
	(42, 13, 5, 1, 1),
	(43, 13, 5, 2, 1),
	(44, 13, 5, 4, 1);
/*!40000 ALTER TABLE `post_auth` ENABLE KEYS */;


-- Dumping structure for table jia2.post_meta
CREATE TABLE IF NOT EXISTS `post_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_meta_posts1` (`post_id`),
  CONSTRAINT `fk_post_meta_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.post_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `post_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.post_type
CREATE TABLE IF NOT EXISTS `post_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.post_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `post_type` DISABLE KEYS */;
REPLACE INTO `post_type` (`id`, `name`) VALUES
	(1, 'personal'),
	(2, 'forward'),
	(3, 'activity');
/*!40000 ALTER TABLE `post_type` ENABLE KEYS */;


-- Dumping structure for table jia2.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.province: ~1 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
REPLACE INTO `province` (`id`, `name`) VALUES
	(1, '四川省');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;


-- Dumping structure for table jia2.school
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '学校',
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_school_province1` (`province_id`),
  CONSTRAINT `fk_school_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.school: ~2 rows (approximately)
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
REPLACE INTO `school` (`id`, `name`, `province_id`) VALUES
	(1, '四川大学', 1),
	(2, '成都信息工程学院', 1);
/*!40000 ALTER TABLE `school` ENABLE KEYS */;


-- Dumping structure for table jia2.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一id',
  `name` varchar(45) NOT NULL COMMENT '用户实体表',
  `email` varchar(45) NOT NULL COMMENT '用户邮箱',
  `pass` varchar(45) NOT NULL COMMENT '密码',
  `type_id` int(11) NOT NULL DEFAULT '2',
  `school_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT 'default.jpg',
  `gender` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_entity_user_type` (`type_id`),
  KEY `fk_users_province1` (`province_id`),
  KEY `fk_users_school1` (`school_id`),
  CONSTRAINT `fk_users_entity_user_type` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_school1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `name`, `email`, `pass`, `type_id`, `school_id`, `province_id`, `avatar`, `gender`) VALUES
	(3, 'Tuzki', 'rabbitzhang52@yahoo.com', 'e18d959268ead9d3caf501969715e3d0', 1, NULL, NULL, 'default.jpg', 1),
	(10, 'zhanghui', 'rabbitzhang52@gmail.com', 'e18d959268ead9d3caf501969715e3d0', 2, NULL, NULL, 'default.jpg', 1),
	(11, '张晖', 'rabbitzhang52@qq.com', 'e18d959268ead9d3caf501969715e3d0', 2, NULL, NULL, '11.jpg', 1),
	(13, '兔子张', 'rabbitzhang52@163.com', 'e18d959268ead9d3caf501969715e3d0', 2, NULL, NULL, '13.jpg', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table jia2.user_meta
CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL COMMENT '变化值对应的表，可以为空',
  `meta_key` varchar(11) NOT NULL COMMENT '变化的key可以指向任何表的索引',
  `meta_value` varchar(45) DEFAULT NULL COMMENT '可以为空',
  PRIMARY KEY (`id`),
  KEY `fk_user_meta_users1` (`user_id`),
  CONSTRAINT `fk_jia2_user_meta_jia2_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.user_meta: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
REPLACE INTO `user_meta` (`id`, `user_id`, `meta_table`, `meta_key`, `meta_value`) VALUES
	(2, 11, 'user', 'friend', '11'),
	(4, 11, 'user', 'friend', '10'),
	(5, 10, 'user', 'friend', '11');
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类型id',
  `name` varchar(45) NOT NULL COMMENT '类型名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.user_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
REPLACE INTO `user_type` (`id`, `name`) VALUES
	(1, 'admin'),
	(2, 'register');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
