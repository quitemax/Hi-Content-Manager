-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.50-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema exercises
--

CREATE DATABASE IF NOT EXISTS exercises;
USE exercises;

--
-- Definition of table `checkup`
--

DROP TABLE IF EXISTS `checkup`;
CREATE TABLE `checkup` (
  `checkup_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `biceps_circumference` double NOT NULL,
  `img_front` longtext NOT NULL,
  `img_side` longtext NOT NULL,
  `waist_circumference` longtext NOT NULL,
  PRIMARY KEY (`checkup_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkup`
--

/*!40000 ALTER TABLE `checkup` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkup` ENABLE KEYS */;


--
-- Definition of table `workout`
--

DROP TABLE IF EXISTS `workout`;
CREATE TABLE `workout` (
  `workout_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `calories_burned` int(10) unsigned NOT NULL,
  `elapsed_time` time NOT NULL,
  PRIMARY KEY (`workout_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout`
--

/*!40000 ALTER TABLE `workout` DISABLE KEYS */;
INSERT INTO `workout` (`workout_id`,`date`,`calories_burned`,`elapsed_time`) VALUES 
 (1,'2011-11-22 12:00:00',997,'01:10:00'),
 (2,'2011-11-23 12:00:00',1000,'01:10:00'),
 (3,'2011-11-24 12:00:00',0,'01:10:00'),
 (4,'2011-11-26 14:00:00',0,'01:50:00'),
 (5,'2011-11-28 11:50:00',0,'01:35:00'),
 (6,'2011-11-29 11:30:00',0,'01:45:00'),
 (7,'2011-11-30 13:50:00',0,'01:25:00'),
 (8,'2011-12-01 12:30:00',0,'01:45:00'),
 (9,'2011-12-02 11:50:00',0,'01:45:00'),
 (10,'2011-12-13 11:30:10',0,'00:50:00');
/*!40000 ALTER TABLE `workout` ENABLE KEYS */;


--
-- Definition of table `workout_exercise`
--

DROP TABLE IF EXISTS `workout_exercise`;
CREATE TABLE `workout_exercise` (
  `exercise_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workout_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `elapsed_time` time NOT NULL DEFAULT '00:00:00',
  `speed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `angle` decimal(10,2) DEFAULT '0.00',
  `level` int(10) unsigned DEFAULT '0',
  `lifting_series_1_count` int(10) unsigned DEFAULT '0',
  `lifting_series_1_break` time DEFAULT '00:00:00',
  `lifting_series_2_count` int(10) unsigned DEFAULT '0',
  `lifting_series_2_break` time DEFAULT '00:00:00',
  `lifting_series_3_count` int(10) unsigned DEFAULT '0',
  `lifting_series_3_break` time DEFAULT '00:00:00',
  `lifting_series_4_count` int(10) unsigned DEFAULT '0',
  `lifting_series_4_break` time DEFAULT '00:00:00',
  `lifting_series_5_count` int(10) unsigned DEFAULT '0',
  `lifting_series_5_break` time DEFAULT '00:00:00',
  `lifting_series_6_count` int(10) unsigned DEFAULT '0',
  `lifting_series_6_break` time DEFAULT '00:00:00',
  `distance` decimal(10,2) DEFAULT '0.00',
  `lifting_series_1_weight` decimal(10,2) NOT NULL,
  `lifting_series_2_weight` decimal(10,2) NOT NULL,
  `lifting_series_3_weight` decimal(10,2) NOT NULL,
  `lifting_series_4_weight` decimal(10,2) NOT NULL,
  `lifting_series_5_weight` decimal(10,2) NOT NULL,
  `lifting_series_6_weight` decimal(10,2) NOT NULL,
  PRIMARY KEY (`exercise_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_exercise`
--

/*!40000 ALTER TABLE `workout_exercise` DISABLE KEYS */;
INSERT INTO `workout_exercise` (`exercise_id`,`workout_id`,`type_id`,`order`,`elapsed_time`,`speed`,`angle`,`level`,`lifting_series_1_count`,`lifting_series_1_break`,`lifting_series_2_count`,`lifting_series_2_break`,`lifting_series_3_count`,`lifting_series_3_break`,`lifting_series_4_count`,`lifting_series_4_break`,`lifting_series_5_count`,`lifting_series_5_break`,`lifting_series_6_count`,`lifting_series_6_break`,`distance`,`lifting_series_1_weight`,`lifting_series_2_weight`,`lifting_series_3_weight`,`lifting_series_4_weight`,`lifting_series_5_weight`,`lifting_series_6_weight`) VALUES 
 (1,2,1,0,'00:06:45','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (2,2,1,98,'00:12:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (3,2,2,99,'00:13:00','8.00','0.00',13,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (4,1,1,0,'00:06:30','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (5,1,1,98,'00:12:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (6,1,2,99,'00:18:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (7,1,3,1,'00:00:00','0.00','0.00',0,12,'00:00:30',10,'00:00:30',9,'00:00:30',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','50.00','50.00','50.00','50.00','50.00','50.00'),
 (8,1,7,2,'00:00:00','0.00','0.00',0,20,'00:00:30',18,'00:00:30',12,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','30.00','30.00','30.00'),
 (9,1,5,3,'00:00:00','0.00','0.00',0,10,'00:00:30',9,'00:00:30',8,'00:00:30',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','50.00','50.00','50.00','50.00','50.00','50.00'),
 (10,1,9,4,'00:00:00','0.00','0.00',0,18,'00:01:00',12,'00:01:00',11,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','5.00','5.00','5.00','5.00','5.00','5.00'),
 (11,1,4,5,'00:00:00','0.00','0.00',0,8,'00:01:00',7,'00:01:00',7,'00:01:00',6,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','40.00','40.00','40.00','40.00','40.00','40.00'),
 (12,1,6,6,'00:00:00','0.00','0.00',0,12,'00:01:00',11,'00:01:00',11,'00:01:00',10,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','50.00','50.00','50.00','50.00','50.00','50.00'),
 (13,2,10,1,'00:00:00','0.00','0.00',0,12,'00:00:30',11,'00:00:30',11,'00:00:30',10,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (14,2,11,2,'00:00:00','0.00','0.00',0,12,'00:00:30',11,'00:00:30',11,'00:00:30',10,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (15,2,12,3,'00:00:00','0.00','0.00',0,12,'00:00:30',12,'00:00:30',12,'00:00:30',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (16,2,13,4,'00:00:00','0.00','0.00',0,12,'00:01:00',11,'00:01:00',11,'00:01:00',11,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (17,2,14,5,'00:00:00','0.00','0.00',0,12,'00:01:00',9,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (18,2,17,6,'00:00:00','0.00','0.00',0,10,'00:01:00',8,'00:01:00',7,'00:01:00',6,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','20.00','20.00','20.00','20.00','20.00','20.00'),
 (19,3,1,0,'00:06:45','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (20,3,1,98,'00:12:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (21,3,2,99,'00:15:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (22,3,18,1,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (23,3,19,2,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (24,3,28,3,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','110.00','110.00','110.00','110.00','110.00','110.00'),
 (25,3,22,4,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','80.00','80.00','80.00','80.00','80.00','80.00'),
 (26,3,23,5,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','80.00','80.00','80.00','80.00','80.00','80.00'),
 (27,3,21,6,'00:00:00','0.00','0.00',0,12,'00:01:00',8,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','65.00','65.00','65.00','65.00','65.00','65.00'),
 (28,4,1,0,'00:06:45','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (29,4,1,98,'00:12:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (30,4,2,99,'00:18:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (31,4,24,1,'00:25:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (32,4,25,3,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (33,4,26,4,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (34,4,27,2,'00:00:00','0.00','0.00',0,12,'00:01:00',11,'00:01:00',10,'00:01:00',8,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','60.00','60.00','60.00','60.00','60.00','60.00'),
 (35,4,24,5,'00:20:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (36,5,1,0,'00:07:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','1.50','0.00','0.00','0.00','0.00','0.00','0.00'),
 (37,5,1,98,'00:12:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (38,5,2,99,'00:18:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.20','0.00','0.00','0.00','0.00','0.00','0.00'),
 (39,5,24,1,'00:20:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (40,5,5,2,'00:00:00','0.00','0.00',0,12,'00:00:45',11,'00:00:45',11,'00:00:45',10,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (41,5,4,3,'00:00:00','0.00','0.00',0,10,'00:00:45',9,'00:00:45',8,'00:00:45',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','20.00','20.00','20.00','20.00','20.00','20.00'),
 (42,5,6,4,'00:00:00','0.00','0.00',0,10,'00:00:45',8,'00:00:45',8,'00:00:45',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','50.00','50.00','50.00','50.00','50.00','50.00'),
 (43,5,7,5,'00:00:00','0.00','0.00',0,20,'00:00:45',20,'00:00:45',28,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','30.00','30.00','30.00'),
 (44,5,9,6,'00:00:00','0.00','0.00',0,18,'00:01:00',15,'00:01:00',16,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','5.00','5.00','5.00','5.00','5.00','5.00'),
 (45,5,3,7,'00:00:00','0.00','0.00',0,8,'00:00:45',7,'00:01:00',6,'00:01:00',5,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (46,6,1,0,'00:07:00','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','1.50','0.00','0.00','0.00','0.00','0.00','0.00'),
 (47,6,24,1,'00:10:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (48,6,1,97,'00:13:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.15','0.00','0.00','0.00','0.00','0.00','0.00'),
 (49,6,2,98,'00:17:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (50,6,24,99,'00:20:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (51,6,10,1,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (52,6,11,2,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (53,6,13,3,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','6.00','6.00','6.00','6.00','6.00','6.00'),
 (54,6,15,4,'00:00:00','0.00','0.00',0,10,'00:00:45',8,'00:00:45',8,'00:00:45',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','10.00','10.00','10.00','10.00','10.00','10.00'),
 (55,6,16,5,'00:00:00','0.00','0.00',0,12,'00:00:30',12,'00:00:30',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','8.00','8.00','8.00','8.00','8.00','8.00'),
 (56,6,16,6,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','17.50','17.50','17.50','17.50','17.50','17.50'),
 (57,7,1,0,'00:07:00','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','1.50','0.00','0.00','0.00','0.00','0.00','0.00'),
 (58,7,1,98,'00:13:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.15','0.00','0.00','0.00','0.00','0.00','0.00'),
 (59,7,2,99,'00:18:00','9.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.20','0.00','0.00','0.00','0.00','0.00','0.00'),
 (60,7,18,1,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (61,7,28,2,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','110.00','110.00','110.00','110.00','110.00','110.00'),
 (62,7,19,3,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (63,7,21,4,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','60.00','60.00','60.00','60.00','60.00','60.00'),
 (64,7,22,5,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','90.00','90.00','90.00','90.00','90.00','90.00'),
 (65,7,23,6,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','90.00','90.00','90.00','90.00','90.00','90.00'),
 (66,8,1,0,'00:07:00','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','1.50','0.00','0.00','0.00','0.00','0.00','0.00'),
 (67,8,24,1,'00:10:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (68,8,1,97,'00:13:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.15','0.00','0.00','0.00','0.00','0.00','0.00'),
 (69,8,2,98,'00:18:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.20','0.00','0.00','0.00','0.00','0.00','0.00'),
 (70,8,24,99,'00:20:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (71,8,0,0,'00:00:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (72,8,27,3,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',9,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','54.00','54.00','54.00','54.00','54.00','54.00'),
 (73,8,26,4,'00:00:00','0.00','0.00',0,12,'00:00:45',10,'00:00:45',10,'00:00:45',9,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (74,8,25,5,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','20.00','20.00','20.00','20.00','20.00','20.00'),
 (75,8,29,2,'00:00:00','0.00','0.00',0,12,'00:00:30',12,'00:00:30',12,'00:00:30',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (76,8,30,6,'00:00:00','0.00','0.00',0,7,'00:01:00',6,'00:01:00',6,'00:01:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','40.00','40.00','40.00','40.00','40.00','40.00'),
 (77,8,31,7,'00:00:00','0.00','0.00',0,18,'00:00:45',15,'00:00:45',15,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (78,9,1,0,'00:07:00','13.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','1.50','0.00','0.00','0.00','0.00','0.00','0.00'),
 (79,9,1,97,'00:13:00','10.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.15','0.00','0.00','0.00','0.00','0.00','0.00'),
 (80,9,2,98,'00:18:00','8.00','0.00',14,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','2.30','0.00','0.00','0.00','0.00','0.00','0.00'),
 (81,9,24,99,'00:20:00','0.00','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (82,9,32,1,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','8.00','8.00','8.00','8.00','8.00','8.00'),
 (83,9,40,2,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','20.00','20.00','20.00','20.00','20.00','20.00'),
 (84,9,34,3,'00:00:00','0.00','0.00',0,9,'00:00:45',7,'00:00:45',5,'00:00:45',6,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','25.00','25.00','25.00','25.00','25.00','25.00'),
 (85,9,35,4,'00:00:00','0.00','0.00',0,12,'00:00:45',12,'00:00:45',12,'00:00:45',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','11.25','11.25','11.25','11.25','11.25','11.25'),
 (86,10,1,0,'00:06:00','12.50','0.00',0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),
 (87,10,3,1,'00:00:00','0.00','0.00',0,12,'00:30:00',12,'00:30:00',8,'00:30:00',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','30.00','0.00','0.00'),
 (88,10,5,2,'00:00:00','0.00','0.00',0,12,'00:45:00',8,'00:45:00',8,'00:45:00',7,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','20.00','20.00','20.00','20.00','0.00','0.00'),
 (89,10,18,3,'00:00:00','0.00','0.00',0,12,'00:30:00',12,'00:30:00',12,'00:30:00',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','30.00','0.00','0.00'),
 (90,10,19,4,'00:00:00','0.00','0.00',0,12,'00:30:00',12,'00:30:00',12,'00:30:00',12,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','30.00','0.00','0.00'),
 (91,10,7,5,'00:00:00','0.00','0.00',0,20,'00:40:00',18,'00:30:00',15,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00','0.00','30.00','30.00','30.00','0.00','0.00','0.00');
/*!40000 ALTER TABLE `workout_exercise` ENABLE KEYS */;


--
-- Definition of table `workout_exercise_type`
--

DROP TABLE IF EXISTS `workout_exercise_type`;
CREATE TABLE `workout_exercise_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img` text,
  `description` text,
  `group_id` int(10) unsigned DEFAULT '0',
  `form_type` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_exercise_type`
--

/*!40000 ALTER TABLE `workout_exercise_type` DISABLE KEYS */;
INSERT INTO `workout_exercise_type` (`type_id`,`name`,`img`,`description`,`group_id`,`form_type`) VALUES 
 (1,'running','','bieg',0,0),
 (2,'orbitrek','','orbitrek',0,0),
 (3,'barbell bench press (machine)','','',0,1),
 (4,'barbell incline bench press (machine)','','',0,1),
 (5,'barbell decline bench press (machine)','','',0,1),
 (6,'butterfly','','',0,1),
 (7,'ab crunch (machine)','','',0,1),
 (8,'air bike','','',0,1),
 (9,'standard ab bench','','',0,1),
 (10,'lateral dumbbell raise','','',0,1),
 (11,'front dumbbell raise','','',0,1),
 (12,'dumbbell shrugs','','',0,1),
 (13,'dumbbell shoulder press','','',0,1),
 (14,'upper dumbbell raise','','',0,1),
 (15,'upper barbell raise','','',0,1),
 (16,'barbell shrugs behind back','','',0,1),
 (17,'lateral dumbell raise (machine)','','',0,1),
 (18,'standing leg curl (machine)','','',0,1),
 (19,'leg extensions (machine)',NULL,NULL,0,1),
 (20,'Calf Press On The Leg Press Machine ',NULL,NULL,0,1),
 (21,'Leg Press ',NULL,NULL,0,1),
 (22,'Thigh Abductor ',NULL,NULL,0,1),
 (23,'Thigh Adductor ',NULL,NULL,0,1),
 (24,'stretching',NULL,NULL,0,0),
 (25,'Leverage High Row ',NULL,NULL,0,1),
 (26,'Leverage Iso Row ',NULL,NULL,0,1),
 (27,'Close-Grip Front Lat Pulldown ',NULL,'',0,1),
 (28,'calf extensions',NULL,NULL,0,1),
 (29,'back extensions',NULL,NULL,0,1),
 (30,'Gironda Sternum Chins',NULL,NULL,0,1),
 (31,'back hyperextensions',NULL,NULL,0,1),
 (32,'Alternate Dumbbell Curl',NULL,NULL,0,1),
 (33,'Tricep Dumbbell Kickback',NULL,NULL,0,1),
 (34,'Barbell Curls',NULL,NULL,0,1),
 (35,'Cable One-arm Tricep Extension',NULL,NULL,0,1),
 (36,'Alternate Hammer Curls',NULL,NULL,0,1),
 (37,'Bench Dips',NULL,NULL,0,1),
 (38,'Concentration biceps curls',NULL,NULL,0,1),
 (39,'Decline Dumbbell Tricep Extension',NULL,NULL,0,1),
 (40,'triceps extensions (machine)',NULL,NULL,0,1);
/*!40000 ALTER TABLE `workout_exercise_type` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
