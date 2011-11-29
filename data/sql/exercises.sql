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
-- Create schema exercise
--

CREATE DATABASE IF NOT EXISTS exercise;
USE exercise;

--
-- Definition of table `checkup`
--

DROP TABLE IF EXISTS `checkup`;
CREATE TABLE `checkup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `biceps_circumference` double NOT NULL,
  `img_front` longtext NOT NULL,
  `img_side` longtext NOT NULL,
  `waist_circumference` longtext NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `calories_burned` int(10) unsigned NOT NULL,
  `elapsed_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout`
--

/*!40000 ALTER TABLE `workout` DISABLE KEYS */;
INSERT INTO `workout` (`id`,`date`,`calories_burned`,`elapsed_time`) VALUES 
 (1,'2011-11-22 12:00:00',997,'01:10:00'),
 (2,'2011-11-23 12:00:00',1000,'01:10:00'),
 (3,'2011-11-24 12:00:00',0,'01:10:00'),
 (4,'2011-11-26 14:00:00',0,'01:50:00');
/*!40000 ALTER TABLE `workout` ENABLE KEYS */;


--
-- Definition of table `workout_exercise`
--

DROP TABLE IF EXISTS `workout_exercise`;
CREATE TABLE `workout_exercise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workout_id` int(10) unsigned NOT NULL DEFAULT '0',
  `exercise_type` int(10) unsigned NOT NULL DEFAULT '0',
  `exercise_order` int(10) unsigned NOT NULL DEFAULT '0',
  `exercise_elapsed_time` time NOT NULL DEFAULT '00:00:00',
  `exercise_speed` float NOT NULL DEFAULT '0',
  `exercise_angle` float DEFAULT '0',
  `exercise_level` int(10) unsigned DEFAULT '0',
  `exercise_lifting_weight` float DEFAULT '0',
  `exercise_lifting_series_1_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_1_break` time DEFAULT '00:00:00',
  `exercise_lifting_series_2_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_2_break` time DEFAULT '00:00:00',
  `exercise_lifting_series_3_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_3_break` time DEFAULT '00:00:00',
  `exercise_lifting_series_4_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_4_break` time DEFAULT '00:00:00',
  `exercise_lifting_series_5_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_5_break` time DEFAULT '00:00:00',
  `exercise_lifting_series_6_count` int(10) unsigned DEFAULT '0',
  `exercise_lifting_series_6_break` time DEFAULT '00:00:00',
  `exercise_distance` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_exercise`
--

/*!40000 ALTER TABLE `workout_exercise` DISABLE KEYS */;
INSERT INTO `workout_exercise` (`id`,`workout_id`,`exercise_type`,`exercise_order`,`exercise_elapsed_time`,`exercise_speed`,`exercise_angle`,`exercise_level`,`exercise_lifting_weight`,`exercise_lifting_series_1_count`,`exercise_lifting_series_1_break`,`exercise_lifting_series_2_count`,`exercise_lifting_series_2_break`,`exercise_lifting_series_3_count`,`exercise_lifting_series_3_break`,`exercise_lifting_series_4_count`,`exercise_lifting_series_4_break`,`exercise_lifting_series_5_count`,`exercise_lifting_series_5_break`,`exercise_lifting_series_6_count`,`exercise_lifting_series_6_break`,`exercise_distance`) VALUES 
 (1,2,1,0,'00:06:45',13,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (2,2,1,98,'00:12:00',10,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (3,2,2,99,'00:13:00',8,0,13,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (4,1,1,0,'00:06:30',13,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (5,1,1,98,'00:12:00',10,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (6,1,2,99,'00:18:00',8,0,14,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (7,1,3,1,'00:00:00',0,0,0,50,12,'00:00:30',10,'00:00:30',9,'00:00:30',7,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (8,1,7,2,'00:00:00',0,0,0,30,20,'00:00:30',18,'00:00:30',12,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (9,1,5,3,'00:00:00',0,0,0,50,10,'00:00:30',9,'00:00:30',8,'00:00:30',7,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (10,1,9,4,'00:00:00',0,0,0,5,18,'00:01:00',12,'00:01:00',11,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (11,1,4,5,'00:00:00',0,0,0,40,8,'00:01:00',7,'00:01:00',7,'00:01:00',6,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (12,1,6,6,'00:00:00',0,0,0,50,12,'00:01:00',11,'00:01:00',11,'00:01:00',10,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (13,2,10,1,'00:00:00',0,0,0,6,12,'00:00:30',11,'00:00:30',11,'00:00:30',10,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (14,2,11,2,'00:00:00',0,0,0,6,12,'00:00:30',11,'00:00:30',11,'00:00:30',10,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (15,2,12,3,'00:00:00',0,0,0,6,12,'00:00:30',12,'00:00:30',12,'00:00:30',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (16,2,13,4,'00:00:00',0,0,0,6,12,'00:01:00',11,'00:01:00',11,'00:01:00',11,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (17,2,14,5,'00:00:00',0,0,0,6,12,'00:01:00',9,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (18,2,17,6,'00:00:00',0,0,0,20,10,'00:01:00',8,'00:01:00',7,'00:01:00',6,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (19,3,1,0,'00:06:45',13,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (20,3,1,98,'00:12:00',10,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (21,3,2,99,'00:15:00',8,0,14,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (22,3,18,1,'00:00:00',0,0,0,25,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (23,3,19,2,'00:00:00',0,0,0,25,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (24,3,20,3,'00:00:00',0,0,0,110,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (25,3,22,4,'00:00:00',0,0,0,80,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (26,3,23,5,'00:00:00',0,0,0,80,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (27,3,21,6,'00:00:00',0,0,0,65,12,'00:01:00',8,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (28,4,1,0,'00:06:45',13,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (29,4,1,98,'00:12:00',10,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (30,4,2,99,'00:18:00',8,0,14,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (31,4,24,1,'00:25:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (32,4,25,3,'00:00:00',0,0,0,25,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (33,4,26,4,'00:00:00',0,0,0,25,12,'00:45:00',12,'00:45:00',12,'00:45:00',12,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (34,4,27,2,'00:00:00',0,0,0,60,12,'00:01:00',11,'00:01:00',10,'00:01:00',8,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (35,4,24,5,'00:20:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (36,5,1,0,'00:07:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',2),
 (37,5,1,98,'00:12:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',2),
 (38,5,2,99,'00:18:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',2.2),
 (39,5,24,1,'00:20:00',0,0,0,0,0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (40,5,5,2,'00:00:00',0,0,0,25,12,'00:45:00',11,'00:45:00',11,'00:45:00',10,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (41,5,4,3,'00:00:00',0,0,0,20,10,'00:45:00',9,'00:45:00',8,'00:45:00',7,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (42,5,6,4,'00:00:00',0,0,0,50,10,'00:45:00',8,'00:45:00',8,'00:45:00',7,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (43,5,7,5,'00:00:00',0,0,0,30,20,'00:45:00',20,'00:45:00',28,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (44,5,9,6,'00:00:00',0,0,0,5,18,'00:01:00',15,'00:01:00',16,'00:00:00',0,'00:00:00',0,'00:00:00',0,'00:00:00',0),
 (45,5,3,7,'00:00:00',0,0,0,25,8,'00:45:00',7,'00:01:00',6,'00:01:00',5,'00:00:00',0,'00:00:00',0,'00:00:00',0);
/*!40000 ALTER TABLE `workout_exercise` ENABLE KEYS */;


--
-- Definition of table `workout_exercise_type`
--

DROP TABLE IF EXISTS `workout_exercise_type`;
CREATE TABLE `workout_exercise_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_exercise_type`
--

/*!40000 ALTER TABLE `workout_exercise_type` DISABLE KEYS */;
INSERT INTO `workout_exercise_type` (`id`,`name`,`img`,`description`) VALUES 
 (1,'running','','bieg'),
 (2,'orbitrek','','orbitrek'),
 (3,'barbell bench press (machine)','',''),
 (4,'barbell incline bench press (machine)','',''),
 (5,'barbell decline bench press (machine)','',''),
 (6,'butterfly','',''),
 (7,'ab crunch (machine)','',''),
 (8,'air bike','',''),
 (9,'standard ab bench','',''),
 (10,'lateral dumbbell raise','',''),
 (11,'front dumbbell raise','',''),
 (12,'dumbbell shrugs','',''),
 (13,'dumbbell shoulder press','',''),
 (14,'upper dumbbell raise','',''),
 (15,'upper barbell raise','',''),
 (16,'barbell shrugs behind back','',''),
 (17,'lateral dumbell raise (machine)','',''),
 (18,'standing leg curl (machine)','',''),
 (19,'leg extensions (machine)',NULL,NULL),
 (20,'Calf Press On The Leg Press Machine ',NULL,NULL),
 (21,'Leg Press ',NULL,NULL),
 (22,'Thigh Abductor ',NULL,NULL),
 (23,'Thigh Adductor ',NULL,NULL),
 (24,'stretching',NULL,NULL),
 (25,'Leverage High Row ',NULL,NULL),
 (26,'Leverage Iso Row ',NULL,NULL),
 (27,'..',NULL,NULL);
/*!40000 ALTER TABLE `workout_exercise_type` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
