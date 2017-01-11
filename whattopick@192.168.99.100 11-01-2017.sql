# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.99.100 (MySQL 5.7.17)
# Database: whattopick
# Generation Time: 2017-01-11 16:47:39 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table champions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `champions`;

CREATE TABLE `champions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pre_6_gankability` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_6_gankability` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `champions_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `champions` WRITE;
/*!40000 ALTER TABLE `champions` DISABLE KEYS */;

INSERT INTO `champions` (`id`, `name`, `pre_6_gankability`, `post_6_gankability`)
VALUES
	(24,'Jax','4',NULL),
	(37,'Sona','4',NULL),
	(18,'Tristana',NULL,NULL),
	(110,'Varus',NULL,NULL),
	(114,'Fiora','2',NULL),
	(27,'Singed',NULL,NULL),
	(223,'Tahm Kench',NULL,NULL),
	(7,'LeBlanc','0',NULL),
	(412,'Thresh',NULL,NULL),
	(43,'Karma',NULL,NULL),
	(202,'Jhin','2',NULL),
	(68,'Rumble',NULL,NULL),
	(77,'Udyr','4',NULL),
	(64,'Lee Sin',NULL,NULL),
	(83,'Yorick',NULL,NULL),
	(38,'Kassadin',NULL,NULL),
	(15,'Sivir',NULL,NULL),
	(21,'Miss Fortune','3',NULL),
	(119,'Draven',NULL,NULL),
	(157,'Yasuo','2',NULL),
	(10,'Kayle',NULL,NULL),
	(35,'Shaco',NULL,NULL),
	(58,'Renekton',NULL,NULL),
	(120,'Hecarim',NULL,NULL),
	(105,'Fizz',NULL,NULL),
	(96,'Kog\'Maw',NULL,NULL),
	(57,'Maokai','1',NULL),
	(127,'Lissandra',NULL,NULL),
	(222,'Jinx',NULL,NULL),
	(6,'Urgot',NULL,NULL),
	(3,'Galio',NULL,NULL),
	(80,'Pantheon','4',NULL),
	(91,'Talon',NULL,NULL),
	(41,'Gangplank',NULL,NULL),
	(81,'Ezreal',NULL,NULL),
	(150,'Gnar',NULL,NULL),
	(17,'Teemo','3',NULL),
	(1,'Annie','4',NULL),
	(82,'Mordekaiser',NULL,NULL),
	(268,'Azir','3',NULL),
	(85,'Kennen','0',NULL),
	(92,'Riven',NULL,NULL),
	(31,'Cho\'Gath',NULL,NULL),
	(266,'Aatrox','4',NULL),
	(78,'Poppy','0',NULL),
	(163,'Taliyah','3',NULL),
	(420,'Illaoi','3','0'),
	(74,'Heimerdinger',NULL,NULL),
	(12,'Alistar','2',NULL),
	(5,'Xin Zhao','4',NULL),
	(236,'Lucian','2',NULL),
	(106,'Volibear','4',NULL),
	(113,'Sejuani',NULL,NULL),
	(76,'Nidalee',NULL,NULL),
	(86,'Garen',NULL,NULL),
	(89,'Leona','4',NULL),
	(238,'Zed',NULL,NULL),
	(53,'Blitzcrank','4',NULL),
	(33,'Rammus',NULL,NULL),
	(161,'Vel\'Koz',NULL,NULL),
	(51,'Caitlyn','1',NULL),
	(48,'Trundle',NULL,NULL),
	(203,'Kindred',NULL,NULL),
	(9,'Fiddlesticks',NULL,NULL),
	(133,'Quinn',NULL,NULL),
	(245,'Ekko',NULL,NULL),
	(267,'Nami',NULL,NULL),
	(50,'Swain',NULL,NULL),
	(44,'Taric',NULL,NULL),
	(134,'Syndra',NULL,NULL),
	(72,'Skarner',NULL,NULL),
	(201,'Braum','3',NULL),
	(45,'Veigar',NULL,NULL),
	(101,'Xerath',NULL,NULL),
	(42,'Corki',NULL,NULL),
	(111,'Nautilus',NULL,NULL),
	(103,'Ahri','2',NULL),
	(126,'Jayce',NULL,NULL),
	(122,'Darius',NULL,NULL),
	(23,'Tryndamere',NULL,NULL),
	(40,'Janna','0',NULL),
	(60,'Elise',NULL,NULL),
	(67,'Vayne',NULL,NULL),
	(63,'Brand','2',NULL),
	(104,'Graves',NULL,NULL),
	(16,'Soraka','2',NULL),
	(30,'Karthus',NULL,NULL),
	(8,'Vladimir','1',NULL),
	(26,'Zilean',NULL,NULL),
	(55,'Katarina',NULL,NULL),
	(102,'Shyvana',NULL,NULL),
	(19,'Warwick',NULL,NULL),
	(115,'Ziggs',NULL,NULL),
	(240,'Kled','3',NULL),
	(121,'Kha\'Zix',NULL,NULL),
	(2,'Olaf',NULL,NULL),
	(4,'Twisted Fate','2',NULL),
	(20,'Nunu',NULL,NULL),
	(107,'Rengar',NULL,NULL),
	(432,'Bard','2',NULL),
	(39,'Irelia',NULL,NULL),
	(427,'Ivern',NULL,NULL),
	(62,'Wukong',NULL,NULL),
	(22,'Ashe','3',NULL),
	(429,'Kalista',NULL,NULL),
	(84,'Akali','4',NULL),
	(254,'Vi',NULL,NULL),
	(32,'Amumu','4',NULL),
	(117,'Lulu',NULL,NULL),
	(25,'Morgana',NULL,NULL),
	(56,'Nocturne',NULL,NULL),
	(131,'Diana',NULL,NULL),
	(136,'Aurelion Sol','3',NULL),
	(143,'Zyra','2',NULL),
	(112,'Viktor',NULL,NULL),
	(69,'Cassiopeia','2',NULL),
	(75,'Nasus',NULL,NULL),
	(29,'Twitch',NULL,NULL),
	(36,'Dr. Mundo',NULL,NULL),
	(61,'Orianna',NULL,NULL),
	(28,'Evelynn',NULL,NULL),
	(421,'Rek\'Sai',NULL,NULL),
	(99,'Lux','1',NULL),
	(14,'Sion',NULL,NULL),
	(11,'Master Yi',NULL,NULL),
	(13,'Ryze',NULL,NULL),
	(54,'Malphite',NULL,NULL),
	(34,'Anivia','1',NULL),
	(98,'Shen',NULL,NULL),
	(59,'Jarvan IV',NULL,NULL),
	(90,'Malzahar',NULL,NULL),
	(154,'Zac',NULL,NULL),
	(79,'Gragas',NULL,NULL);

/*!40000 ALTER TABLE `champions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table junglers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `junglers`;

CREATE TABLE `junglers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `champion_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pre_6_passivity` int(255) DEFAULT NULL,
  `pre_6_activity` int(255) DEFAULT NULL,
  `pre_6_predatory` int(255) DEFAULT NULL,
  `post_6_passivity` int(255) DEFAULT NULL,
  `post_6_activity` int(255) DEFAULT NULL,
  `post_6_predatory` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `junglers` WRITE;
/*!40000 ALTER TABLE `junglers` DISABLE KEYS */;

INSERT INTO `junglers` (`id`, `champion_id`, `name`, `pre_6_passivity`, `pre_6_activity`, `pre_6_predatory`, `post_6_passivity`, `post_6_activity`, `post_6_predatory`)
VALUES
	(1,64,'Lee Sin',6,8,9,NULL,NULL,NULL),
	(2,421,'Rek\'Sai',8,8,7,NULL,NULL,NULL),
	(3,76,'Nidalee',5,6,7,NULL,NULL,NULL),
	(4,2,'Olaf',8,7,6,NULL,NULL,NULL),
	(5,62,'Wukong',7,7,5,NULL,NULL,NULL),
	(6,203,'Kindred',8,7,6,NULL,NULL,NULL),
	(7,121,'Kha\'Zix',7,7,8,NULL,NULL,NULL),
	(8,120,'Hecarim',8,8,5,NULL,NULL,NULL),
	(9,104,'Graves',9,6,7,NULL,NULL,NULL),
	(10,60,'Elise',6,9,7,NULL,NULL,NULL),
	(11,28,'Evelynn',7,8,5,NULL,NULL,NULL),
	(12,56,'Nocturne',9,5,5,NULL,NULL,NULL),
	(13,107,'Rengar',8,5,6,NULL,NULL,NULL),
	(14,80,'Pantheon',3,8,8,NULL,NULL,NULL),
	(15,35,'Shaco',8,7,5,NULL,NULL,NULL),
	(16,29,'Twitch',7,8,5,NULL,NULL,NULL),
	(17,254,'Vi',7,8,8,NULL,NULL,NULL),
	(18,427,'Ivern',8,9,5,NULL,NULL,NULL),
	(19,102,'Shyvana',9,4,8,NULL,NULL,NULL),
	(20,11,'Master Yi',9,4,3,NULL,NULL,NULL),
	(21,154,'Zac',7,8,4,NULL,NULL,NULL),
	(22,77,'Udyr',7,6,4,NULL,NULL,NULL),
	(23,266,'Aatrox',7,6,7,NULL,NULL,NULL),
	(24,32,'Amumu',7,5,3,NULL,NULL,NULL),
	(25,36,'Dr. Mundo',6,4,3,NULL,NULL,NULL);

/*!40000 ALTER TABLE `junglers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(20,'2014_10_12_000000_create_users_table',1),
	(21,'2014_10_12_100000_create_password_resets_table',1),
	(22,'2016_11_02_093319_create_champions_table',1),
	(23,'2016_11_02_164314_create_junglers_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
