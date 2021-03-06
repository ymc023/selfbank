-- MySQL dump 10.14  Distrib 5.5.50-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: selfbank
-- ------------------------------------------------------
-- Server version	5.5.50-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `selfbank_account`
--

DROP TABLE IF EXISTS `selfbank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selfbank_account` (
  `acid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acmoney` decimal(10,2) NOT NULL,
  `acclassid` int(8) NOT NULL,
  `actime` datetime NOT NULL,
  `acremark` varchar(150) DEFAULT NULL,
  `jiid` int(8) NOT NULL,
  `zhifu` int(8) NOT NULL,
  PRIMARY KEY (`acid`)
) ENGINE=InnoDB AUTO_INCREMENT=542 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `selfbank_account_class`
--

DROP TABLE IF EXISTS `selfbank_account_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selfbank_account_class` (
  `classid` int(5) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) NOT NULL,
  `classtype` int(1) NOT NULL,
  `ufid` int(8) NOT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `selfbank_user`
--

DROP TABLE IF EXISTS `selfbank_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selfbank_user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(20) NOT NULL,
  `utime` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

LOCK TABLES `selfbank_account_class` WRITE;
/*!40000 ALTER TABLE `selfbank_account_class` DISABLE KEYS */;
INSERT INTO `selfbank_account_class` VALUES (1,'网上购物',2,1),(2,'转账到卡',1,1),(3,'转账出卡',2,1),(13,'日常支出',2,1),(14,'交通费用',2,1),(15,'人情往来',2,1),(16,'景区门票',2,1),(17,'工资到账',1,1),(18,'在外面吃饭',2,1),(22,'水费',2,1),(32,'电费',2,1),(42,'燃气费',2,1),(52,'房租费',2,1); 
/*!40000 ALTER TABLE `selfbank_account_class` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `selfbank_user` WRITE;
/*!40000 ALTER TABLE `selfbank_user` DISABLE KEYS */;
INSERT INTO `selfbank_user` VALUES (1,'admin','a3175a452c7a8fea80c62a198a40f6c9','admin@selfbank.com',now());
/*!40000 ALTER TABLE `selfbank_user` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `summoney`(in fenlei int,in yue varchar(50),in userid int,out result decimal(10,2))
begin select sum(`acmoney`) INTO result from `selfbank_account` where acclassid=fenlei and actime like yue and jiid=userid; end ;;
DELIMITER ;
-- Dump completed on 2016-11-08  9:42:33
