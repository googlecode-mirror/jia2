# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.9)
# Database: jia2
# Generation Time: 2012-04-22 10:13:26 +0800
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
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

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `user_id`, `corporation_id`, `name`, `start_time`, `deadline`, `address`, `comment`)
VALUES
	(1,3,7,'坑爹社团的第一个活动','1334592000','1335801600','宿舍','没啥事，就单纯搅基');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activity_auth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_auth`;

CREATE TABLE `activity_auth` (
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

LOCK TABLES `activity_auth` WRITE;
/*!40000 ALTER TABLE `activity_auth` DISABLE KEYS */;

INSERT INTO `activity_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`)
VALUES
	(13,7,2,1,1),
	(14,7,3,1,1),
	(15,7,10,1,1),
	(16,7,6,1,1),
	(17,7,7,1,1),
	(18,7,7,2,1),
	(19,7,7,3,1),
	(20,7,7,4,1),
	(21,7,8,1,1),
	(22,7,8,2,1),
	(23,7,8,3,1),
	(24,7,8,4,1);

/*!40000 ALTER TABLE `activity_auth` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activity_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_meta`;

CREATE TABLE `activity_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_meta_activities1` (`activity_id`),
  CONSTRAINT `fk_activity_meta_activity1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `content`, `time`, `status`)
VALUES
	(1,15,10,'泪流满面啊','1333727643',1),
	(2,15,10,'而黄家坎','1333728396',1),
	(3,15,10,'而黄家坎','1333728403',1),
	(4,15,10,'而啊哈同济牙科','1333728439',1),
	(5,15,10,'泪流满面啊\n\n而黄家坎\n\n而黄家坎\n\n而啊哈同济牙科','1333728507',1),
	(6,15,10,'sjhkl;\'','1333728533',1),
	(7,15,10,'泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科','1333728715',1),
	(8,14,10,'泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科','1333728726',1),
	(9,15,10,'泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科','1333728759',1),
	(10,14,10,'泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科','1333728764',1),
	(11,12,10,'泪流满面啊 而黄家坎 而黄家坎 而啊哈同济牙科','1333728776',1),
	(12,12,10,'测试第一篇帖子！！！！','1333728781',1),
	(13,19,10,'王尼玛每天早上都起来跑步,然后 CCC','1333728941',1),
	(14,19,10,'早上都起来跑步,然后 CCC ','1333728980',1),
	(15,17,11,'尼玛每天早上都起 ','1333757784',1),
	(16,20,11,'风格啊','1333761945',1),
	(17,14,11,'阿尔和他','1333761948',1),
	(18,17,11,'自己肯定能给自己回复撒','1333761974',1),
	(19,20,11,'几把','1333806417',1),
	(20,21,11,'dd','1333853845',1),
	(21,21,11,'gg','1333853848',1),
	(22,21,11,'rr','1333853850',1),
	(23,20,11,'re','1333853857',1),
	(24,20,11,'tewtw','1333853859',1),
	(25,19,11,'rw','1333853862',1),
	(26,34,11,'回复一下看看','1334063597',1),
	(27,34,11,'个人主页','1334063604',1),
	(28,34,11,'回复','1334063630',1),
	(29,15,11,'ceshi ','1334065431',1),
	(30,35,11,'测试ajax返回','1334134802',1),
	(31,34,11,'测试返回','1334134851',1),
	(32,10,11,'这尼玛！必须要成功！','1334134915',1),
	(33,22,11,'这尼玛什么状况！','1334134940',1),
	(34,22,11,'没见过老子刷评论！','1334134951',1),
	(35,22,11,'老子就是没见过怎么了！怎么了！','1334134961',1),
	(36,35,11,'老子来试看看ajax喃','1334137345',1),
	(37,35,11,'这种岩石爽！','1334224276',1),
	(38,35,11,'我喜欢这种的！ \'你妹啊\'','1334239113',1),
	(39,35,11,'这是个什么状况','1334309262',1),
	(40,34,11,'再试一次','1334309330',1),
	(41,15,11,'尼玛！','1334309997',1),
	(44,14,11,'这尼玛','1334310349',1),
	(45,35,11,'这尼玛是什么情况！','1334366045',1),
	(46,35,11,'来个中文看看！','1334565670',1),
	(47,35,11,'评论呢是否成功','1334740432',1),
	(48,35,11,'这尼玛什么状况','1334754565',1),
	(49,37,11,'我来评论一下看看喃','1334757780',1),
	(50,35,10,'测试看看','1334831622',1),
	(51,35,13,'测试看看','1334831651',1),
	(52,36,13,'我评论一个看看喃','1334917578',1),
	(53,36,11,'测试回复','1334997037',1),
	(54,36,11,'再次测试回复','1334997086',1),
	(55,36,13,'各家回复一个','1335013092',1),
	(56,36,11,'再来看看','1335013118',1),
	(57,36,11,'再来看看','1335013138',1),
	(58,35,13,'测试看看','1335013344',1),
	(59,35,13,'测试看看回复','1335013421',1),
	(60,35,13,'echo \'here\';\n   exit();','1335013502',1),
	(61,35,13,'测试看看回复','1335013518',1),
	(62,35,13,'测试看看回复','1335013590',1),
	(63,35,13,'测试看看回复','1335013629',1),
	(64,35,13,'return;','1335013721',1),
	(65,35,13,'测试看看回复','1335013737',1),
	(66,35,13,'测试看看回复','1335013757',1),
	(67,35,13,'测试看看回复','1335013806',1),
	(68,35,13,'测试看看回复','1335013826',1),
	(69,35,13,'测试看看回复','1335013950',1),
	(70,35,11,'现在老子看你还敢回复不','1335014869',1);

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comment_auth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment_auth`;

CREATE TABLE `comment_auth` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comment_auth` WRITE;
/*!40000 ALTER TABLE `comment_auth` DISABLE KEYS */;

INSERT INTO `comment_auth` (`id`, `owner_id`, `type_id`, `identity_id`, `operation_id`, `access`)
VALUES
	(14,10,1,2,1,1),
	(15,10,1,3,1,1),
	(16,10,1,3,2,1),
	(17,10,1,5,1,1),
	(18,10,1,5,2,1),
	(19,10,1,5,4,1),
	(20,10,1,4,1,1),
	(21,10,1,4,2,1),
	(22,10,1,11,1,1),
	(23,10,1,11,2,1),
	(24,10,1,11,4,1),
	(25,11,1,2,1,1),
	(26,11,1,3,1,1),
	(27,11,1,3,2,0),
	(28,11,1,5,1,1),
	(29,11,1,5,2,1),
	(30,11,1,5,4,1),
	(31,11,1,4,1,1),
	(32,11,1,4,2,1),
	(33,11,1,11,1,1),
	(34,11,1,11,2,1),
	(35,11,1,11,4,1),
	(47,13,1,2,1,1),
	(48,13,1,3,1,1),
	(49,13,1,3,2,0),
	(50,13,1,5,1,1),
	(51,13,1,5,2,1),
	(52,13,1,5,4,1),
	(53,13,1,4,1,1),
	(54,13,1,4,2,1),
	(55,13,1,11,1,1),
	(56,13,1,11,2,1),
	(57,13,1,11,4,1),
	(58,7,3,2,1,1),
	(59,7,3,3,1,1),
	(60,7,3,3,2,1),
	(61,7,3,5,1,1),
	(62,7,3,5,2,1),
	(63,7,3,5,4,1),
	(64,7,3,6,1,1),
	(65,7,3,6,2,1),
	(66,7,3,7,1,1),
	(67,7,3,7,2,1),
	(68,7,3,7,4,1),
	(69,7,3,10,1,1),
	(70,7,3,10,2,1);

/*!40000 ALTER TABLE `comment_auth` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table corporation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `corporation`;

CREATE TABLE `corporation` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `corporation` WRITE;
/*!40000 ALTER TABLE `corporation` DISABLE KEYS */;

INSERT INTO `corporation` (`id`, `name`, `school_id`, `user_id`, `avatar`, `comment`)
VALUES
	(7,'坑爹社团',1,11,'default.jpg','坑爹不解释');

/*!40000 ALTER TABLE `corporation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table corporation_auth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `corporation_auth`;

CREATE TABLE `corporation_auth` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社团权限表';

LOCK TABLES `corporation_auth` WRITE;
/*!40000 ALTER TABLE `corporation_auth` DISABLE KEYS */;

INSERT INTO `corporation_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`)
VALUES
	(15,7,2,1,1),
	(16,7,3,1,1),
	(17,7,6,1,1),
	(18,7,7,1,1),
	(19,7,8,1,1),
	(20,7,8,3,1);

/*!40000 ALTER TABLE `corporation_auth` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table corporation_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `corporation_meta`;

CREATE TABLE `corporation_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corporation_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_corporation_meta_corporations1` (`corporation_id`),
  CONSTRAINT `fk_corporation_meta_corporation1` FOREIGN KEY (`corporation_id`) REFERENCES `corporation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社团变化表';



# Dump of table identity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `identity`;

CREATE TABLE `identity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户身份';

LOCK TABLES `identity` WRITE;
/*!40000 ALTER TABLE `identity` DISABLE KEYS */;

INSERT INTO `identity` (`id`, `name`)
VALUES
	(1,'admin'),
	(2,'guest'),
	(3,'register'),
	(4,'follower'),
	(5,'self'),
	(6,'co_member'),
	(7,'co_admin'),
	(8,'co_master'),
	(9,'blocker'),
	(10,'participant'),
	(11,'po_master');

/*!40000 ALTER TABLE `identity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notify
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notify`;

CREATE TABLE `notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_notify_user2` (`user_id`),
  KEY `fk_notify_notify_type1` (`type_id`),
  KEY `fk_notify_user1` (`user_id`),
  KEY `fk_notify_user3` (`receiver`),
  CONSTRAINT `fk_notify_notify_type1` FOREIGN KEY (`type_id`) REFERENCES `notify_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_notify_user1` FOREIGN KEY (`receiver`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notify_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notify` WRITE;
/*!40000 ALTER TABLE `notify` DISABLE KEYS */;

INSERT INTO `notify` (`id`, `user_id`, `receiver`, `type_id`, `time`, `content`, `status`)
VALUES
	(1,11,13,3,1334997086,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=36\">http://jia2.localhost/personal/profile?post_id=36</a>',1),
	(2,11,13,3,1335013118,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=36\">http://jia2.localhost/personal/profile?post_id=36</a>',1),
	(3,11,13,3,1335013138,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=36\">http://jia2.localhost/personal/profile?post_id=36</a>',1),
	(4,13,11,3,1335013344,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(5,13,11,3,1335013421,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(6,13,11,3,1335013502,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(7,13,11,3,1335013518,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(8,13,11,3,1335013590,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(9,13,11,3,1335013629,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(10,13,11,3,1335013721,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(11,13,11,3,1335013738,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(12,13,11,3,1335013757,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(13,13,11,3,1335013806,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(14,13,11,3,1335013826,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1),
	(15,13,11,3,1335013950,'评论了你的新鲜事<a href=\"http://jia2.localhost/personal/profile?post_id=35\">http://jia2.localhost/personal/profile?post_id=35</a>',1);

/*!40000 ALTER TABLE `notify` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notify_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notify_meta`;

CREATE TABLE `notify_meta` (
  `id` int(11) NOT NULL,
  `notify_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messsage_meta_messages1` (`notify_id`),
  CONSTRAINT `fk_notify_meta_notify1` FOREIGN KEY (`notify_id`) REFERENCES `notify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table notify_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notify_type`;

CREATE TABLE `notify_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL COMMENT '字段说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notify_type` WRITE;
/*!40000 ALTER TABLE `notify_type` DISABLE KEYS */;

INSERT INTO `notify_type` (`id`, `name`, `comment`)
VALUES
	(1,'letter','站内信'),
	(2,'request','请求'),
	(3,'message','消息');

/*!40000 ALTER TABLE `notify_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table operation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `operation`;

CREATE TABLE `operation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `comment` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作';

LOCK TABLES `operation` WRITE;
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;

INSERT INTO `operation` (`id`, `name`, `comment`)
VALUES
	(1,'view','查看'),
	(2,'add','添加'),
	(3,'edit','编辑'),
	(4,'delete','删除');

/*!40000 ALTER TABLE `operation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `type_id`, `owner_id`, `title`, `content`, `image`, `time`, `status`)
VALUES
	(10,1,10,NULL,'测试第一篇帖子！！！！',NULL,'1333508483',1),
	(12,1,10,NULL,' 测试第一篇帖子！！！！',NULL,'1333527676',1),
	(13,1,10,NULL,'这尼玛，要发一个试试喃！',NULL,'1333702854',1),
	(14,1,10,NULL,'帅气！灰常好！',NULL,'1333702868',1),
	(15,1,10,NULL,'这个页面的大小被固定了哇~',NULL,'1333703006',1),
	(16,1,11,NULL,'尼玛，晓得我叫啥子名字不！',NULL,'1333704398',1),
	(17,1,11,NULL,'王尼玛每天早上都起来跑步,跑完步后在公园的凳子上睡个小觉,这天王尼玛又跑完步了,在公园的凳子上睡觉,这时来了一个基佬, 看着王尼玛长的挺俊的, 于是就把王尼玛XXX了',NULL,'1333714497',1),
	(18,1,11,NULL,'这尼玛坑爹呐是吧!',NULL,'1333715483',1),
	(19,1,10,NULL,'王尼玛每天早上都起来跑步,然后 CCC',NULL,'1333728932',1),
	(20,1,11,NULL,'这尼玛是什么情况!',NULL,'1333760070',1),
	(21,1,11,NULL,'fgsh',NULL,'1333853832',1),
	(22,1,11,NULL,'gdgd',NULL,'1333853921',1),
	(34,1,11,NULL,'yjem',NULL,'1333900933',1),
	(35,1,11,NULL,'这尼玛是神马情况！',NULL,'1334109378',1),
	(36,1,13,NULL,'来发一条看看喃',NULL,'1334366637',1),
	(37,3,7,NULL,'发起了一个活动:<a href=\"http://jia2.localhost/activity/view/1\">坑爹社团的第一个活动</a>',NULL,'1334648222',1);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_auth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_auth`;

CREATE TABLE `post_auth` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子查看权限验证';

LOCK TABLES `post_auth` WRITE;
/*!40000 ALTER TABLE `post_auth` DISABLE KEYS */;

INSERT INTO `post_auth` (`id`, `owner_id`, `identity_id`, `operation_id`, `access`)
VALUES
	(21,10,2,1,1),
	(22,10,3,1,1),
	(23,10,4,1,1),
	(24,10,5,1,1),
	(25,10,5,2,1),
	(26,10,5,4,1),
	(27,11,2,1,0),
	(28,11,3,1,1),
	(29,11,4,1,1),
	(30,11,5,1,1),
	(31,11,5,2,1),
	(32,11,5,4,1),
	(39,13,2,1,1),
	(40,13,3,1,1),
	(41,13,4,1,1),
	(42,13,5,1,1),
	(43,13,5,2,1),
	(44,13,5,4,1);

/*!40000 ALTER TABLE `post_auth` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_meta`;

CREATE TABLE `post_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL,
  `meta_key` varchar(45) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_meta_posts1` (`post_id`),
  CONSTRAINT `fk_post_meta_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table post_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_type`;

CREATE TABLE `post_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `comment` varchar(45) DEFAULT NULL COMMENT '字段说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post_type` WRITE;
/*!40000 ALTER TABLE `post_type` DISABLE KEYS */;

INSERT INTO `post_type` (`id`, `name`, `comment`)
VALUES
	(1,'personal','个人'),
	(2,'forward','转发'),
	(3,'activity','活动');

/*!40000 ALTER TABLE `post_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table province
# ------------------------------------------------------------

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;

INSERT INTO `province` (`id`, `name`)
VALUES
	(1,'四川省');

/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table school
# ------------------------------------------------------------

DROP TABLE IF EXISTS `school`;

CREATE TABLE `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '学校',
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_school_province1` (`province_id`),
  CONSTRAINT `fk_school_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;

INSERT INTO `school` (`id`, `name`, `province_id`)
VALUES
	(1,'四川大学',1),
	(2,'成都信息工程学院',1);

/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `type_id`, `school_id`, `province_id`, `avatar`, `gender`)
VALUES
	(3,'Tuzki','rabbitzhang52@yahoo.com','e18d959268ead9d3caf501969715e3d0',1,NULL,NULL,'3.jpg',1),
	(10,'zhanghui','rabbitzhang52@gmail.com','e18d959268ead9d3caf501969715e3d0',2,NULL,NULL,'default.jpg',1),
	(11,'张晖','rabbitzhang52@qq.com','e18d959268ead9d3caf501969715e3d0',2,NULL,NULL,'11.jpg',1),
	(13,'兔子张','rabbitzhang52@163.com','e18d959268ead9d3caf501969715e3d0',2,NULL,NULL,'13.jpg',1);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_meta`;

CREATE TABLE `user_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_table` varchar(45) DEFAULT NULL COMMENT '变化值对应的表，可以为空',
  `meta_key` varchar(11) NOT NULL COMMENT '变化的key可以指向任何表的索引',
  `meta_value` varchar(45) DEFAULT NULL COMMENT '可以为空',
  PRIMARY KEY (`id`),
  KEY `fk_user_meta_users1` (`user_id`),
  CONSTRAINT `fk_jia2_user_meta_jia2_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;

INSERT INTO `user_meta` (`id`, `user_id`, `meta_table`, `meta_key`, `meta_value`)
VALUES
	(2,11,'user','follower','11'),
	(4,11,'user','follower','10'),
	(5,10,'user','follower','11'),
	(7,11,'corporation','follower','7');

/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类型id',
  `name` varchar(45) NOT NULL COMMENT '类型名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;

INSERT INTO `user_type` (`id`, `name`)
VALUES
	(1,'admin'),
	(2,'register');

/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
