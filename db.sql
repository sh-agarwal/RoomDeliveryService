-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

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
-- Current Database: `db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db`;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `name` varchar(30) NOT NULL,
  `preptime` int(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `threshold` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores canteen item details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES ('coffee',1,60,40,0,10,7),('tea',1,30,50,1,5,2);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `items` blob NOT NULL,
  `quantity` blob,
  `price` blob NOT NULL,
  `total` float NOT NULL,
  `profit` float NOT NULL,
  `address` varchar(100) NOT NULL,
  `preptime` int(11) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COMMENT='Stores order info';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2019-04-28','18:04:48','test',_binary 'test',_binary 'test',_binary 'test',0,0,'test',0,0,0,'test','test'),(2,'2019-04-28','18:04:56','user_temp',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(3,'2019-04-28','18:04:23','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(4,'2019-04-28','18:04:11','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(5,'2019-04-28','18:04:31','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(6,'2019-04-28','18:04:35','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(7,'2019-04-28','18:04:38','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(8,'2019-04-28','18:04:39','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(9,'2019-04-28','18:04:40','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(10,'2019-04-28','18:04:41','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(11,'2019-04-28','18:04:42','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(12,'2019-04-28','18:04:42','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(13,'2019-04-28','18:04:43','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(14,'2019-04-28','18:04:45','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(15,'2019-04-28','18:04:46','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(16,'2019-04-28','18:04:48','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(17,'2019-04-28','18:04:51','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(18,'2019-04-28','18:04:56','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(19,'2019-04-28','18:04:57','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(20,'2019-04-28','18:04:58','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(21,'2019-04-28','18:04:59','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(22,'2019-04-28','18:04:59','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(23,'2019-04-28','18:04:00','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(24,'2019-04-28','18:04:02','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(25,'2019-04-28','18:04:03','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(26,'2019-04-28','18:34:45','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(27,'2019-04-28','18:34:47','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(28,'2019-04-28','18:36:13','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(29,'2019-04-28','18:36:15','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',0,0,'A-335',2,9480087671,0,'Mani','Mannampalli'),(30,'2019-04-28','18:43:39','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(31,'2019-04-28','18:45:34','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(32,'2019-04-28','18:45:53','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(33,'2019-04-28','18:47:00','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',15,6,'A-335',2,9480087671,0,'Mani','Mannampalli'),(34,'2019-04-28','18:47:25','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:2:\"60\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',300,180,'A-335',2,9480087671,0,'Mani','Mannampalli'),(35,'2019-04-28','18:48:51','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:1:\"0\";i:2;s:2:\"70\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',350,210,'A-335',2,9480087671,0,'Mani','Mannampalli'),(36,'2019-04-28','18:54:28','mani',_binary 'a:2:{i:1;s:6:\"coffee\";i:2;s:3:\"tea\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"0\";}',_binary 'a:2:{i:1;s:2:\"10\";i:2;s:1:\"5\";}',100,30,'A-335',2,9480087671,0,'Mani','Mannampalli');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `department` varchar(10) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `password` text,
  `email` varchar(50) DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Storing User Information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','admin',NULL,'',NULL,NULL,1,'$2y$10$YdYPRSZgP/AeypT0XMxPYeDHJa0FDB4.Po8jQpJLktDdWuK.mBkN6',NULL,NULL),('mani','Mani','Mannampalli','CSE','student','A-335',0,'$2y$10$4td4NHSoXUlGckGgUeZUreb0z5lreDyG7.BFC5nqYtkPw8go5Do32','mani.mannampalli@gmail.com',9480087671);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-28 19:04:30
