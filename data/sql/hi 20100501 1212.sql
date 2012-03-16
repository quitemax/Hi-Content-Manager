-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.66a-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema gerappa_pro3
--

CREATE DATABASE IF NOT EXISTS gerappa_pro3;
USE gerappa_pro3;

--
-- Definition of table `hicms_langs`
--

DROP TABLE IF EXISTS `hicms_langs`;
CREATE TABLE `hicms_langs` (
  `hl_id` int(10) unsigned NOT NULL auto_increment,
  `hl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  `hl_is_active` tinyint(1) NOT NULL default '1',
  `hl_position` smallint(5) unsigned NOT NULL,
  `hl_description` char(100) collate utf8_polish_ci NOT NULL,
  PRIMARY KEY  (`hl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_langs`
--

/*!40000 ALTER TABLE `hicms_langs` DISABLE KEYS */;
INSERT INTO `hicms_langs` (`hl_id`,`hl_lang`,`hl_is_active`,`hl_position`,`hl_description`) VALUES 
 (1,'pl',1,1,'polski'),
 (2,'en',1,2,'angielski');
/*!40000 ALTER TABLE `hicms_langs` ENABLE KEYS */;


--
-- Definition of table `hicms_navigation_items`
--

DROP TABLE IF EXISTS `hicms_navigation_items`;
CREATE TABLE `hicms_navigation_items` (
  `hni_id` int(10) unsigned NOT NULL auto_increment,
  `hni_sys_name` char(255) collate utf8_polish_ci NOT NULL,
  PRIMARY KEY  (`hni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_navigation_items`
--

/*!40000 ALTER TABLE `hicms_navigation_items` DISABLE KEYS */;
INSERT INTO `hicms_navigation_items` (`hni_id`,`hni_sys_name`) VALUES 
 (1,'rootMenu');
/*!40000 ALTER TABLE `hicms_navigation_items` ENABLE KEYS */;


--
-- Definition of table `hicms_navigation_items_elements`
--

DROP TABLE IF EXISTS `hicms_navigation_items_elements`;
CREATE TABLE `hicms_navigation_items_elements` (
  `hnie_id` int(10) unsigned NOT NULL auto_increment,
  `hnie_tree_parent_id` int(10) unsigned NOT NULL,
  `hnie_tree_left` int(10) unsigned NOT NULL,
  `hnie_tree_right` int(10) unsigned NOT NULL,
  `hnie_tree_level` int(10) unsigned NOT NULL,
  `hnie_tree_position` int(10) unsigned NOT NULL,
  `hnie_tree_root_id` int(10) unsigned NOT NULL,
  `hnie_is_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`hnie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_navigation_items_elements`
--

/*!40000 ALTER TABLE `hicms_navigation_items_elements` DISABLE KEYS */;
INSERT INTO `hicms_navigation_items_elements` (`hnie_id`,`hnie_tree_parent_id`,`hnie_tree_left`,`hnie_tree_right`,`hnie_tree_level`,`hnie_tree_position`,`hnie_tree_root_id`,`hnie_is_active`) VALUES 
 (1,7,2,3,1,10,1,1),
 (2,7,4,5,1,10,2,1),
 (3,7,6,7,1,10,2,1),
 (4,7,8,9,1,10,3,1),
 (5,7,10,11,1,10,3,1),
 (6,7,12,13,1,10,3,1),
 (7,0,1,14,0,10,1,1);
/*!40000 ALTER TABLE `hicms_navigation_items_elements` ENABLE KEYS */;


--
-- Definition of table `hicms_navigation_items_elements_i18n`
--

DROP TABLE IF EXISTS `hicms_navigation_items_elements_i18n`;
CREATE TABLE `hicms_navigation_items_elements_i18n` (
  `hniei18n_id` int(10) unsigned NOT NULL auto_increment,
  `hniei18n_hnie_id` int(10) unsigned NOT NULL,
  `hniei18n_lang` char(2) collate utf8_polish_ci NOT NULL default 'pl',
  `hniei18n_title` char(255) collate utf8_polish_ci NOT NULL,
  `hniei18n_description` text collate utf8_polish_ci NOT NULL,
  `hniei18n_translation_is_active` tinyint(1) NOT NULL,
  PRIMARY KEY  USING BTREE (`hniei18n_id`),
  KEY `FK_hicms_navigation_items_elements_i18n_1` USING BTREE (`hniei18n_hnie_id`),
  CONSTRAINT `FK_hicms_navigation_items_elements_i18n_1` FOREIGN KEY (`hniei18n_hnie_id`) REFERENCES `hicms_navigation_items_elements` (`hnie_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_navigation_items_elements_i18n`
--

/*!40000 ALTER TABLE `hicms_navigation_items_elements_i18n` DISABLE KEYS */;
INSERT INTO `hicms_navigation_items_elements_i18n` (`hniei18n_id`,`hniei18n_hnie_id`,`hniei18n_lang`,`hniei18n_title`,`hniei18n_description`,`hniei18n_translation_is_active`) VALUES 
 (1,1,'pl','1 pl','',1),
 (2,1,'en','1en','',1),
 (3,2,'pl','adfasf','',1),
 (4,2,'en','sadf','',1),
 (5,3,'pl','werafd','',1),
 (6,3,'en','asdfa','',1),
 (7,4,'pl','sdafas','',1),
 (8,4,'en','asdfasdf','',1),
 (9,5,'pl','sdfasdf','',1),
 (10,5,'en','sdafdf','',1),
 (11,6,'pl','2 pl','2 pl desc',1),
 (12,6,'en','2 en','2 en desc',1),
 (13,7,'pl','3 pl1','1',1),
 (14,7,'en','3 en1','1',1);
/*!40000 ALTER TABLE `hicms_navigation_items_elements_i18n` ENABLE KEYS */;


--
-- Definition of table `hicms_navigation_items_i18n`
--

DROP TABLE IF EXISTS `hicms_navigation_items_i18n`;
CREATE TABLE `hicms_navigation_items_i18n` (
  `hnii18n_id` int(10) unsigned NOT NULL auto_increment,
  `hnii18n_hni_id` int(10) unsigned NOT NULL,
  `hnii18n_lang` char(2) collate utf8_polish_ci NOT NULL default 'pl',
  `hnii18n_title` char(255) collate utf8_polish_ci NOT NULL,
  `hnii18n_description` text collate utf8_polish_ci NOT NULL,
  `hnii18n_translation_is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  USING BTREE (`hnii18n_id`),
  KEY `FK_hicms_navigation_items_i18n_1` USING BTREE (`hnii18n_hni_id`),
  CONSTRAINT `FK_hicms_navigation_items_i18n_1` FOREIGN KEY (`hnii18n_hni_id`) REFERENCES `hicms_navigation_items` (`hni_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_navigation_items_i18n`
--

/*!40000 ALTER TABLE `hicms_navigation_items_i18n` DISABLE KEYS */;
INSERT INTO `hicms_navigation_items_i18n` (`hnii18n_id`,`hnii18n_hni_id`,`hnii18n_lang`,`hnii18n_title`,`hnii18n_description`,`hnii18n_translation_is_active`) VALUES 
 (1,1,'pl','menu aplikacji root','menu aplikacji root',1),
 (2,1,'en','root application menu','root application menu',1);
/*!40000 ALTER TABLE `hicms_navigation_items_i18n` ENABLE KEYS */;


--
-- Definition of table `hicms_test`
--

DROP TABLE IF EXISTS `hicms_test`;
CREATE TABLE `hicms_test` (
  `ht_id` int(10) unsigned NOT NULL auto_increment,
  `ht_is_active` tinyint(1) NOT NULL default '1',
  `ht_tree_left` int(10) unsigned NOT NULL,
  `ht_tree_right` int(10) unsigned NOT NULL,
  `ht_tree_order` int(10) unsigned NOT NULL,
  `ht_tree_level` int(10) unsigned NOT NULL,
  `ht_tree_root_id` int(10) unsigned NOT NULL,
  `ht_tree_parent_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`ht_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_test`
--

/*!40000 ALTER TABLE `hicms_test` DISABLE KEYS */;
INSERT INTO `hicms_test` (`ht_id`,`ht_is_active`,`ht_tree_left`,`ht_tree_right`,`ht_tree_order`,`ht_tree_level`,`ht_tree_root_id`,`ht_tree_parent_id`) VALUES 
 (1,1,1,6,10,0,0,0),
 (2,1,2,3,10,1,0,1),
 (3,1,4,5,20,1,0,1);
/*!40000 ALTER TABLE `hicms_test` ENABLE KEYS */;


--
-- Definition of table `hicms_test_i18n`
--

DROP TABLE IF EXISTS `hicms_test_i18n`;
CREATE TABLE `hicms_test_i18n` (
  `hti_id` int(10) unsigned NOT NULL auto_increment,
  `hti_ht_id` int(10) unsigned NOT NULL,
  `hti_lang` char(2) collate utf8_polish_ci NOT NULL default 'pl',
  `hti_title` char(255) collate utf8_polish_ci NOT NULL,
  `hti_description` text collate utf8_polish_ci NOT NULL,
  `hti_translation_is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`hti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_test_i18n`
--

/*!40000 ALTER TABLE `hicms_test_i18n` DISABLE KEYS */;
INSERT INTO `hicms_test_i18n` (`hti_id`,`hti_ht_id`,`hti_lang`,`hti_title`,`hti_description`,`hti_translation_is_active`) VALUES 
 (1,1,'pl','1 pl','',1),
 (2,1,'en','1','',1),
 (3,2,'pl','2 pl','',1),
 (4,2,'en','2','',1),
 (5,3,'pl','3 pl','',1),
 (6,3,'en','3','',1);
/*!40000 ALTER TABLE `hicms_test_i18n` ENABLE KEYS */;


--
-- Definition of table `hicms_translations_items`
--

DROP TABLE IF EXISTS `hicms_translations_items`;
CREATE TABLE `hicms_translations_items` (
  `hti_id` int(10) unsigned NOT NULL auto_increment,
  `hti_key` char(255) character set ucs2 NOT NULL,
  PRIMARY KEY  (`hti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_translations_items`
--

/*!40000 ALTER TABLE `hicms_translations_items` DISABLE KEYS */;
INSERT INTO `hicms_translations_items` (`hti_id`,`hti_key`) VALUES 
 (1,'yes'),
 (2,'no'),
 (4,'maybe'),
 (5,'propably'),
 (6,'hti_key'),
 (7,'hti_value'),
 (8,'hti_translation_is_active'),
 (9,'hti_id'),
 (10,'editTranslationsItem'),
 (11,'addTranslationItem'),
 (12,'hicmsTranslatePanel'),
 (13,'translationsItemsList'),
 (14,'elements'),
 (15,'from'),
 (16,'perPage'),
 (17,'previousPage'),
 (18,'nextPage'),
 (19,'actions'),
 (20,'add'),
 (21,'back'),
 (22,'save'),
 (23,'delete'),
 (24,'edit'),
 (25,'hni_id'),
 (26,'hni_sys_name'),
 (27,'hni_title'),
 (28,'hni_description'),
 (29,'hni_translation_is_active'),
 (30,'navigationItemsList'),
 (31,'navigationPanel'),
 (32,'navigationItem'),
 (33,'navigationElementTree'),
 (34,'addNavigationItemElement'),
 (35,'hnie_id'),
 (36,'hnie_tree_parent_id'),
 (37,'hnie_tree_position'),
 (38,'hnie_is_active'),
 (39,'hnie_title'),
 (40,'hnie_description'),
 (41,'hnie_translation_is_active'),
 (42,'editNavigationItemElement'),
 (43,'navigationItemsElementsList'),
 (44,'hicmsLangsPanel'),
 (45,'langsList'),
 (46,'addLang'),
 (47,'hl_id'),
 (48,'hl_lang'),
 (49,'hl_is_active'),
 (50,'hl_position'),
 (51,'hl_description'),
 (52,'areYouSureToDeleteThisElement'),
 (53,'areYouSureToDeleteTheseElements'),
 (58,'translationsCacheItemsList'),
 (59,'translationKey'),
 (60,'translationValue'),
 (61,'filterSubmit'),
 (62,'filterReset'),
 (63,'filters');
/*!40000 ALTER TABLE `hicms_translations_items` ENABLE KEYS */;


--
-- Definition of table `hicms_translations_items_i18n`
--

DROP TABLE IF EXISTS `hicms_translations_items_i18n`;
CREATE TABLE `hicms_translations_items_i18n` (
  `htii18n_id` int(10) unsigned NOT NULL auto_increment,
  `htii18n_hti_id` int(10) unsigned NOT NULL,
  `htii18n_lang` char(2) character set ucs2 NOT NULL default 'pl',
  `htii18n_value` text collate utf8_polish_ci NOT NULL,
  `htii18n_translation_is_active` tinyint(1) NOT NULL,
  PRIMARY KEY  USING BTREE (`htii18n_id`),
  KEY `FK_hicms_translations_items_i18n_1` (`htii18n_hti_id`),
  CONSTRAINT `FK_hicms_translations_items_i18n_1` FOREIGN KEY (`htii18n_hti_id`) REFERENCES `hicms_translations_items` (`hti_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_translations_items_i18n`
--

/*!40000 ALTER TABLE `hicms_translations_items_i18n` DISABLE KEYS */;
INSERT INTO `hicms_translations_items_i18n` (`htii18n_id`,`htii18n_hti_id`,`htii18n_lang`,`htii18n_value`,`htii18n_translation_is_active`) VALUES 
 (1,1,'pl','tak',1),
 (2,1,'en','yes',1),
 (3,2,'pl','nie',1),
 (4,2,'en','no',1),
 (7,4,'pl','może',1),
 (8,4,'en','maybe',1),
 (9,5,'pl','prawdopodobnie',1),
 (10,5,'en','propably',1),
 (11,6,'pl','klucz translacji',1),
 (12,6,'en','translation key',1),
 (13,7,'pl','wartość translacji',1),
 (14,7,'en','translation value',1),
 (15,8,'pl','translacja jest aktywna',1),
 (16,8,'en','translation is active',1),
 (17,9,'pl','ID',1),
 (18,9,'en','ID',1),
 (19,10,'pl','edycja elementu translacji',1),
 (20,10,'en','edit translation item',1),
 (21,11,'pl','dodaj element translacji',1),
 (22,11,'en','add translation item',1),
 (23,12,'pl','hicms - panel translacji ',1),
 (24,12,'en','translation panel',1),
 (25,13,'pl','lista elementów translacji',1),
 (26,13,'en','translation items list',1),
 (27,14,'pl','elementy',1),
 (28,14,'en','elements',1),
 (29,15,'pl','z',1),
 (30,15,'en','from',1),
 (31,16,'pl','ilość na stronie',1),
 (32,16,'en','elements per page',1),
 (33,17,'pl','poprzednia strona',1),
 (34,17,'en','previous page',1),
 (35,18,'pl','następna strona',1),
 (36,18,'en','next page',1),
 (37,19,'pl','akcje',1),
 (38,19,'en','actions',1),
 (39,20,'pl','dodaj',1),
 (40,20,'en','add',1),
 (41,21,'pl','z powrotem',1),
 (42,21,'en','back',1),
 (43,22,'pl','zapisz',1),
 (44,22,'en','save',1),
 (45,23,'pl','kasuj',1),
 (46,23,'en','delete',1),
 (47,24,'pl','edytuj',1),
 (48,24,'en','edit',1),
 (49,25,'pl','ID',1),
 (50,25,'en','ID',1),
 (51,26,'pl','nazwa systemowa',1),
 (52,26,'en','nazwa systemowa',1),
 (53,27,'pl','tytuł nawigacji',1),
 (54,27,'en','navigation title',1),
 (55,28,'pl','opis nawigacji',1),
 (56,28,'en','navigation description',1),
 (57,29,'pl','translacja jest aktywna',1),
 (58,29,'en','translation is active',1),
 (59,30,'pl','lista nawigacji',1),
 (60,30,'en','navigation item list',1),
 (61,31,'pl','panel nawigacji',1),
 (62,31,'en','navigation panel',1),
 (63,32,'pl','nawigacja',1),
 (64,32,'en','navigation item',1),
 (65,33,'pl','drzewo elementów nawigacji',1),
 (66,33,'en','navigation elements tree',1),
 (67,34,'pl','dodaj element nawigacji',1),
 (68,34,'en','add navigation item element',1),
 (69,35,'pl','ID',1),
 (70,35,'en','ID',1),
 (71,36,'pl','element nadrzędny',1),
 (72,36,'en','parent element',1),
 (73,37,'pl','pozycja elementu',1),
 (74,37,'en','position',1),
 (75,38,'pl','element jest aktywny',1),
 (76,38,'en','element is active',1),
 (77,39,'pl','nazwa elementu',1),
 (78,39,'en','element title',1),
 (79,40,'pl','opis elementu',1),
 (80,40,'en','element description',1),
 (81,41,'pl','translacja jest aktywna',1),
 (82,41,'en','translation is active',1),
 (83,42,'pl','edytuj element nawigacji',1),
 (84,42,'en','edit navigation item element',1),
 (85,43,'pl','lista elementów należących do edytowanego elementu nawigacji',1),
 (86,43,'en','navigation item element children list',1),
 (87,44,'pl','hicms - panel języków',1),
 (88,44,'en','hicms langs panel',1),
 (89,45,'pl','lista języków',1),
 (90,45,'en','langs list',1),
 (91,46,'pl','dodaj język',1),
 (92,46,'en','add lang',1),
 (93,47,'pl','ID',1),
 (94,47,'en','ID',1),
 (95,48,'pl','kod języka',1),
 (96,48,'en','lang code',1),
 (97,49,'pl','język jest aktywny',1),
 (98,49,'en','lang is active',1),
 (99,50,'pl','pozycja',1),
 (100,50,'en','position',1),
 (101,51,'pl','opis',1),
 (102,51,'en','description',1),
 (103,52,'pl','Czy jesteś pewien, że chcesz skasować ten element?',1),
 (104,52,'en','Are you sure you want to delete this element ?',1),
 (105,53,'pl','Czy jesteś pewien, że chcesz skasować te elementy ?',1),
 (106,53,'en','Are you sure you want to delete these elements ?',1),
 (115,58,'pl','lista elementów w cache translacji',1),
 (116,58,'en','translations cache items list',1),
 (117,59,'pl','klucz translacji',1),
 (118,59,'en','translation key',1),
 (119,60,'pl','wartość translacji',1),
 (120,60,'en','translations value',1),
 (121,61,'pl','filtruj',1),
 (122,61,'en','filter',1),
 (123,62,'pl','czyść filtr',1),
 (124,62,'en','reset filter',1),
 (125,63,'pl','filtry',1),
 (126,63,'en','filters',1);
/*!40000 ALTER TABLE `hicms_translations_items_i18n` ENABLE KEYS */;


--
-- Definition of table `hicms_users`
--

DROP TABLE IF EXISTS `hicms_users`;
CREATE TABLE `hicms_users` (
  `hu_id` int(10) unsigned NOT NULL auto_increment,
  `hu_username` char(64) NOT NULL,
  `hu_password` char(40) NOT NULL,
  `hu_hug_id` int(10) unsigned NOT NULL,
  `hu_is_super_user` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`hu_id`),
  KEY `FK_hu_hug_id` (`hu_hug_id`),
  CONSTRAINT `FK_hu_hug_id` FOREIGN KEY (`hu_hug_id`) REFERENCES `hicms_users_groups` (`hug_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hicms_users`
--

/*!40000 ALTER TABLE `hicms_users` DISABLE KEYS */;
INSERT INTO `hicms_users` (`hu_id`,`hu_username`,`hu_password`,`hu_hug_id`,`hu_is_super_user`) VALUES 
 (1,'root','76d822a59f962cfe759227f90c8ac0c980704e13',1,1);
/*!40000 ALTER TABLE `hicms_users` ENABLE KEYS */;


--
-- Definition of table `hicms_users_groups`
--

DROP TABLE IF EXISTS `hicms_users_groups`;
CREATE TABLE `hicms_users_groups` (
  `hug_id` int(10) unsigned NOT NULL auto_increment,
  `hug_sys_name` char(100) collate utf8_polish_ci NOT NULL,
  PRIMARY KEY  (`hug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `hicms_users_groups`
--

/*!40000 ALTER TABLE `hicms_users_groups` DISABLE KEYS */;
INSERT INTO `hicms_users_groups` (`hug_id`,`hug_sys_name`) VALUES 
 (1,'admin'),
 (2,'moderator');
/*!40000 ALTER TABLE `hicms_users_groups` ENABLE KEYS */;


--
-- Definition of table `mod_content_categories`
--

DROP TABLE IF EXISTS `mod_content_categories`;
CREATE TABLE `mod_content_categories` (
  `mcc_id` int(10) unsigned NOT NULL auto_increment,
  `mcc_tree_parent_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`mcc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_categories`
--

/*!40000 ALTER TABLE `mod_content_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_categories` ENABLE KEYS */;


--
-- Definition of table `mod_content_categories_properties_items`
--

DROP TABLE IF EXISTS `mod_content_categories_properties_items`;
CREATE TABLE `mod_content_categories_properties_items` (
  `mccpi_id` int(10) unsigned NOT NULL auto_increment,
  `mccpi_mcc_id` int(10) unsigned NOT NULL,
  `mccpi_mccpit_id` int(10) unsigned NOT NULL,
  `mccpi_data_type` char(20) character set ucs2 NOT NULL default 'bool',
  `mccpi_sys_name` char(255) collate utf8_polish_ci NOT NULL,
  `mccpi_position` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`mccpi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_categories_properties_items`
--

/*!40000 ALTER TABLE `mod_content_categories_properties_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_categories_properties_items` ENABLE KEYS */;


--
-- Definition of table `mod_content_categories_properties_types`
--

DROP TABLE IF EXISTS `mod_content_categories_properties_types`;
CREATE TABLE `mod_content_categories_properties_types` (
  `mccpt_id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`mccpt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_categories_properties_types`
--

/*!40000 ALTER TABLE `mod_content_categories_properties_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_categories_properties_types` ENABLE KEYS */;


--
-- Definition of table `mod_content_categories_translations`
--

DROP TABLE IF EXISTS `mod_content_categories_translations`;
CREATE TABLE `mod_content_categories_translations` (
  `mcct_id` int(10) unsigned NOT NULL auto_increment,
  `mcct_mcc_id` int(10) unsigned NOT NULL,
  `mcct_sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  PRIMARY KEY  (`mcct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_categories_translations`
--

/*!40000 ALTER TABLE `mod_content_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_categories_translations` ENABLE KEYS */;


--
-- Definition of table `mod_content_items`
--

DROP TABLE IF EXISTS `mod_content_items`;
CREATE TABLE `mod_content_items` (
  `mci_id` int(10) unsigned NOT NULL auto_increment,
  `mci_position` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`mci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_items`
--

/*!40000 ALTER TABLE `mod_content_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_items` ENABLE KEYS */;


--
-- Definition of table `mod_content_items_to_categories`
--

DROP TABLE IF EXISTS `mod_content_items_to_categories`;
CREATE TABLE `mod_content_items_to_categories` (
  `mcitc_mcc_id` int(10) unsigned NOT NULL,
  `mcitc_mci_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`mcitc_mcc_id`,`mcitc_mci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_items_to_categories`
--

/*!40000 ALTER TABLE `mod_content_items_to_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_items_to_categories` ENABLE KEYS */;


--
-- Definition of table `mod_content_items_translations`
--

DROP TABLE IF EXISTS `mod_content_items_translations`;
CREATE TABLE `mod_content_items_translations` (
  `mcit_id` int(10) unsigned NOT NULL auto_increment,
  `mcit_mc_id` int(10) unsigned NOT NULL,
  `mcit_sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  PRIMARY KEY  (`mcit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_content_items_translations`
--

/*!40000 ALTER TABLE `mod_content_items_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_content_items_translations` ENABLE KEYS */;


--
-- Definition of table `mod_menus_items`
--

DROP TABLE IF EXISTS `mod_menus_items`;
CREATE TABLE `mod_menus_items` (
  `mmi_id` int(10) unsigned NOT NULL auto_increment,
  `mmi_title` char(255) character set ucs2 NOT NULL,
  PRIMARY KEY  (`mmi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_menus_items`
--

/*!40000 ALTER TABLE `mod_menus_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_menus_items` ENABLE KEYS */;


--
-- Definition of table `mod_menus_items_elements`
--

DROP TABLE IF EXISTS `mod_menus_items_elements`;
CREATE TABLE `mod_menus_items_elements` (
  `mmie_id` int(10) unsigned NOT NULL auto_increment,
  `mmie_mmi_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`mmie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_menus_items_elements`
--

/*!40000 ALTER TABLE `mod_menus_items_elements` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_menus_items_elements` ENABLE KEYS */;


--
-- Definition of table `mod_menus_items_elements_translations`
--

DROP TABLE IF EXISTS `mod_menus_items_elements_translations`;
CREATE TABLE `mod_menus_items_elements_translations` (
  `mmiet_id` int(10) unsigned NOT NULL auto_increment,
  `mmiet_mmie_id` int(10) unsigned zerofill NOT NULL,
  `mmiet_sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  PRIMARY KEY  (`mmiet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_menus_items_elements_translations`
--

/*!40000 ALTER TABLE `mod_menus_items_elements_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_menus_items_elements_translations` ENABLE KEYS */;


--
-- Definition of table `mod_menus_items_translations`
--

DROP TABLE IF EXISTS `mod_menus_items_translations`;
CREATE TABLE `mod_menus_items_translations` (
  `mmit_id` int(10) unsigned NOT NULL auto_increment,
  `mmit_mmi_id` int(10) unsigned NOT NULL,
  `mmit_sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  PRIMARY KEY  (`mmit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_menus_items_translations`
--

/*!40000 ALTER TABLE `mod_menus_items_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_menus_items_translations` ENABLE KEYS */;


--
-- Definition of table `mod_shop_articles`
--

DROP TABLE IF EXISTS `mod_shop_articles`;
CREATE TABLE `mod_shop_articles` (
  `msa_id` int(10) unsigned NOT NULL auto_increment,
  `msa_position` smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (`msa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_shop_articles`
--

/*!40000 ALTER TABLE `mod_shop_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_shop_articles` ENABLE KEYS */;


--
-- Definition of table `mod_shop_articles_to_categories`
--

DROP TABLE IF EXISTS `mod_shop_articles_to_categories`;
CREATE TABLE `mod_shop_articles_to_categories` (
  `msatc_msc_id` int(10) unsigned NOT NULL,
  `msatc_msa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`msatc_msc_id`,`msatc_msa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_shop_articles_to_categories`
--

/*!40000 ALTER TABLE `mod_shop_articles_to_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_shop_articles_to_categories` ENABLE KEYS */;


--
-- Definition of table `mod_shop_categories`
--

DROP TABLE IF EXISTS `mod_shop_categories`;
CREATE TABLE `mod_shop_categories` (
  `msc_id` int(10) unsigned NOT NULL auto_increment,
  `msc_position` smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (`msc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `mod_shop_categories`
--

/*!40000 ALTER TABLE `mod_shop_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_shop_categories` ENABLE KEYS */;


--
-- Definition of table `service_langs`
--

DROP TABLE IF EXISTS `service_langs`;
CREATE TABLE `service_langs` (
  `sl_id` int(10) unsigned NOT NULL auto_increment,
  `sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  `sl_is_active` tinyint(1) NOT NULL default '1',
  `sl_position` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`sl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `service_langs`
--

/*!40000 ALTER TABLE `service_langs` DISABLE KEYS */;
INSERT INTO `service_langs` (`sl_id`,`sl_lang`,`sl_is_active`,`sl_position`) VALUES 
 (1,'pl',1,1),
 (2,'en',1,2);
/*!40000 ALTER TABLE `service_langs` ENABLE KEYS */;


--
-- Definition of table `service_translations_items`
--

DROP TABLE IF EXISTS `service_translations_items`;
CREATE TABLE `service_translations_items` (
  `sti_id` int(10) unsigned NOT NULL auto_increment,
  `sti_title` char(255) character set ucs2 NOT NULL,
  PRIMARY KEY  (`sti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `service_translations_items`
--

/*!40000 ALTER TABLE `service_translations_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_translations_items` ENABLE KEYS */;


--
-- Definition of table `service_translations_items_translations`
--

DROP TABLE IF EXISTS `service_translations_items_translations`;
CREATE TABLE `service_translations_items_translations` (
  `stit_id` int(10) unsigned NOT NULL auto_increment,
  `stit_sti_id` int(10) unsigned NOT NULL,
  `stit_sl_lang` char(2) character set ucs2 NOT NULL default 'pl',
  PRIMARY KEY  (`stit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `service_translations_items_translations`
--

/*!40000 ALTER TABLE `service_translations_items_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_translations_items_translations` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
