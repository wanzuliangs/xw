/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.53 : Database - xw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xw` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `xw`;

/*Table structure for table `x_admin` */

DROP TABLE IF EXISTS `x_admin`;

CREATE TABLE `x_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员帐号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `state` tinyint(1) DEFAULT '1' COMMENT '状态 0,1 (1为正常,1为锁定)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `x_admin` */

LOCK TABLES `x_admin` WRITE;

insert  into `x_admin`(`id`,`account`,`password`,`state`) values (1,'admin','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(3,'admins-pc','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(9,'aaaa','40be4e59b9a2a2b5dffb918c0e86b3d7',0),(10,'bbbb','40be4e59b9a2a2b5dffb918c0e86b3d7',0),(14,'sgsgsgsg','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(15,'java','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(16,'kekaka','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(17,'jakekings','40be4e59b9a2a2b5dffb918c0e86b3d7',1),(18,'wanrongrui','40be4e59b9a2a2b5dffb918c0e86b3d7',1);

UNLOCK TABLES;

/*Table structure for table `x_category` */

DROP TABLE IF EXISTS `x_category`;

CREATE TABLE `x_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '栏目名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级栏目id',
  `sort` int(11) DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='栏目表';

/*Data for the table `x_category` */

LOCK TABLES `x_category` WRITE;

insert  into `x_category`(`id`,`name`,`pid`,`sort`) values (11,'武汉',8,122),(10,'北京',0,103),(9,'湖南',0,102),(8,'湖北',0,100),(12,'荆州',8,120),(13,'赤壁',8,100),(14,'长沙',9,100),(16,'岳阳',9,100);

UNLOCK TABLES;

/*Table structure for table `x_config` */

DROP TABLE IF EXISTS `x_config`;

CREATE TABLE `x_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cfg` text COMMENT '配置信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='站点配置表';

/*Data for the table `x_config` */

LOCK TABLES `x_config` WRITE;

insert  into `x_config`(`id`,`cfg`) values (8,'{\"sitetitle\":\"网站后台管理系统\",\"img\":\"logo.gif\",\"keyword\":\"cms1\",\"desc\":\"网站后台管理系统test啊\",\"tel\":\"15336547896\",\"addr\":\"15336547896\",\"state\":\"1\",\"prompt\":\"网站正在维护中....\"}');

UNLOCK TABLES;

/*Table structure for table `x_log` */

DROP TABLE IF EXISTS `x_log`;

CREATE TABLE `x_log` (
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '登陆id',
  `ip` char(15) DEFAULT '' COMMENT '登陆ip',
  `logintime` int(10) DEFAULT '0' COMMENT '登陆时间',
  `msg` varchar(80) DEFAULT '' COMMENT '登陆信息'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登陆日志表';

/*Data for the table `x_log` */

LOCK TABLES `x_log` WRITE;

insert  into `x_log`(`uid`,`ip`,`logintime`,`msg`) values (1,'127.0.0.1',1542334979,'密码不正确'),(1,'127.0.0.1',1542334946,'登陆成功'),(1,'127.0.0.1',1542335641,'登陆成功'),(1,'127.0.0.1',1542335006,'密码不正确'),(1,'127.0.0.1',1542348341,'密码不正确'),(1,'127.0.0.1',1542348354,'密码不正确'),(1,'127.0.0.1',1542348465,'登陆成功'),(1,'127.0.0.1',1542348496,'登陆成功'),(1,'127.0.0.1',1542416418,'登陆成功'),(1,'127.0.0.1',1542435146,'登陆成功'),(1,'127.0.0.1',1542677049,'登陆成功');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
