-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-03-30 13:28:21
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for jia2
CREATE DATABASE IF NOT EXISTS `jia2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jia2`;


-- Dumping structure for table jia2.activities
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `corporation_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `start_time` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `address` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activities_users1` (`user_id`),
  KEY `fk_activities_corporations1` (`corporation_id`),
  CONSTRAINT `fk_activities_corporations1` FOREIGN KEY (`corporation_id`) REFERENCES `corporations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_activities_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activities: ~0 rows (approximately)
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;


-- Dumping structure for table jia2.activity_auth
CREATE TABLE IF NOT EXISTS `activity_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `option` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_activity_auth_activities` (`activity_id`),
  KEY `FK_activity_auth_identity` (`identity_id`),
  KEY `FK_activity_auth_options` (`option`),
  CONSTRAINT `FK_activity_auth_options` FOREIGN KEY (`option`) REFERENCES `options` (`id`),
  CONSTRAINT `FK_activity_auth_activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  CONSTRAINT `FK_activity_auth_identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activity_auth: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_auth` DISABLE KEYS */;
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
  CONSTRAINT `fk_activity_meta_activities1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.activity_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `content` text,
  `status` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_posts1` (`post_id`),
  KEY `fk_comments_users1` (`users_id`),
  CONSTRAINT `fk_comments_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for table jia2.corporations
CREATE TABLE IF NOT EXISTS `corporations` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社团id',
  `name` varchar(45) NOT NULL COMMENT '学校',
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_corporations_school1` (`school_id`),
  KEY `fk_corporations_users1` (`user_id`),
  CONSTRAINT `fk_corporations_school1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_corporations_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.corporations: ~0 rows (approximately)
/*!40000 ALTER TABLE `corporations` DISABLE KEYS */;
/*!40000 ALTER TABLE `corporations` ENABLE KEYS */;


-- Dumping structure for table jia2.corporation_auth
CREATE TABLE IF NOT EXISTS `corporation_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `corporation_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `option_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__identity` (`identity_id`),
  KEY `FK_corporation_auth_corporations` (`corporation_id`),
  KEY `FK_corporation_auth_options` (`option_id`),
  CONSTRAINT `FK_corporation_auth_options` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  CONSTRAINT `FK_corporation_auth_corporations` FOREIGN KEY (`corporation_id`) REFERENCES `corporations` (`id`),
  CONSTRAINT `FK__identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社团权限表';

-- Dumping data for table jia2.corporation_auth: ~0 rows (approximately)
/*!40000 ALTER TABLE `corporation_auth` DISABLE KEYS */;
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
  CONSTRAINT `fk_corporation_meta_corporations1` FOREIGN KEY (`corporation_id`) REFERENCES `corporations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社团变化表';

-- Dumping data for table jia2.corporation_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `corporation_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `corporation_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.identity
CREATE TABLE IF NOT EXISTS `identity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户身份';

-- Dumping data for table jia2.identity: ~10 rows (approximately)
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
	(10, 'participant');
/*!40000 ALTER TABLE `identity` ENABLE KEYS */;


-- Dumping structure for table jia2.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_messages_message_type1` (`type_id`),
  KEY `fk_messages_users1` (`user_id`),
  CONSTRAINT `fk_messages_message_type1` FOREIGN KEY (`type_id`) REFERENCES `message_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table jia2.message_meta
CREATE TABLE IF NOT EXISTS `message_meta` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messsage_meta_messages1` (`message_id`),
  CONSTRAINT `fk_messsage_meta_messages1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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


-- Dumping structure for table jia2.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `comment` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='操作';

-- Dumping data for table jia2.options: ~5 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
REPLACE INTO `options` (`id`, `name`, `comment`) VALUES
	(1, 'view', '查看'),
	(2, 'add', '添加'),
	(3, 'comment', '评论'),
	(4, 'edit', '编辑'),
	(5, 'delete', '删除');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;


-- Dumping structure for table jia2.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text,
  `image` varchar(45) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_post_type1` (`type_id`),
  KEY `fk_post_users1` (`user_id`),
  CONSTRAINT `fk_post_post_type1` FOREIGN KEY (`type_id`) REFERENCES `post_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.posts: ~1 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
REPLACE INTO `posts` (`id`, `type_id`, `user_id`, `content`, `image`, `time`, `status`) VALUES
	(1, 1, 5, '测试帖', NULL, NULL, NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Dumping structure for table jia2.post_auth
CREATE TABLE IF NOT EXISTS `post_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `identity_id` int(10) NOT NULL DEFAULT '0',
  `option_id` int(10) NOT NULL DEFAULT '0',
  `access` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_post_auth_users` (`user_id`),
  KEY `FK_post_auth_options` (`option_id`),
  KEY `FK_post_auth_identity` (`identity_id`),
  CONSTRAINT `FK_post_auth_identity` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`),
  CONSTRAINT `FK_post_auth_options` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  CONSTRAINT `FK_post_auth_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='帖子查看权限验证';

-- Dumping data for table jia2.post_auth: ~1 rows (approximately)
/*!40000 ALTER TABLE `post_auth` DISABLE KEYS */;
REPLACE INTO `post_auth` (`id`, `user_id`, `identity_id`, `option_id`, `access`) VALUES
	(8, 5, 9, 2, 0);
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
  CONSTRAINT `fk_post_meta_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.post_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `post_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_meta` ENABLE KEYS */;


-- Dumping structure for table jia2.post_type
CREATE TABLE IF NOT EXISTS `post_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.post_type: ~1 rows (approximately)
/*!40000 ALTER TABLE `post_type` DISABLE KEYS */;
REPLACE INTO `post_type` (`id`, `name`) VALUES
	(1, 'personal');
/*!40000 ALTER TABLE `post_type` ENABLE KEYS */;


-- Dumping structure for table jia2.provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.provinces: ~0 rows (approximately)
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;


-- Dumping structure for table jia2.schools
CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '学校',
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_school_province1` (`province_id`),
  CONSTRAINT `fk_school_province1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.schools: ~0 rows (approximately)
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;


-- Dumping structure for table jia2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一id',
  `name` varchar(45) NOT NULL COMMENT '用户实体表',
  `email` varchar(45) NOT NULL COMMENT '用户邮箱',
  `pass` varchar(45) NOT NULL COMMENT '密码',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `school_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_entity_user_type` (`type_id`),
  KEY `fk_users_province1` (`province_id`),
  KEY `fk_users_school1` (`school_id`),
  CONSTRAINT `fk_users_entity_user_type` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_province1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_school1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `pass`, `type_id`, `school_id`, `province_id`, `gender`) VALUES
	(3, 'Tuzki', 'rabbitzhang52@yahoo.com', 'e18d959268ead9d3caf501969715e3d0', 1, NULL, NULL, 1),
	(5, 'register', 'register@jia2.cn', '', 2, NULL, NULL, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table jia2.user_meta
CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL COMMENT '变化值对应的表，可以为空',
  `meta_key` int(11) NOT NULL COMMENT '变化的key可以指向任何表的索引',
  `meta_value` varchar(45) DEFAULT NULL COMMENT '可以为空',
  PRIMARY KEY (`id`),
  KEY `fk_user_meta_users1` (`users_id`),
  CONSTRAINT `fk_jia2_user_meta_jia2_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table jia2.user_meta: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
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
