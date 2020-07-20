-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: stuhelp
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AboutEvent`
--

DROP TABLE IF EXISTS `AboutEvent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `AboutEvent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `EvWhen` datetime NOT NULL,
  `id_User` int NOT NULL,
  `EvType` int DEFAULT '0',
  `EvWhere` varchar(64) DEFAULT '0',
  `id_Subject` int DEFAULT NULL,
  `id_Theme` int DEFAULT NULL,
  `Keywords` text,
  `Questions` text,
  `Homework` text,
  `WhenDoHW` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AboutEvent`
--

LOCK TABLES `AboutEvent` WRITE;
/*!40000 ALTER TABLE `AboutEvent` DISABLE KEYS */;
INSERT INTO `AboutEvent` VALUES (1,'2020-07-12 18:00:00',10,1,'Кинотеатр Юность',NULL,NULL,'День рождения,праздник',NULL,NULL,'2001-05-10 00:00:00'),(2,'2001-05-08 18:30:30',10,1,'Кинотеатр Юность',NULL,NULL,'День рождения,праздник',NULL,NULL,'2001-05-10 00:00:00'),(3,'2001-05-08 18:30:30',10,1,'Кинотеатр Юность',NULL,NULL,'День рождения,праздник',NULL,NULL,'2001-05-10 00:00:00'),(4,'2001-05-08 18:30:30',10,1,'Кинотеатр Юность',NULL,NULL,'День рождения,праздник',NULL,NULL,'2001-05-10 00:00:00');
/*!40000 ALTER TABLE `AboutEvent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cities`
--

DROP TABLE IF EXISTS `Cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL DEFAULT '',
  `eng_Name` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cities`
--

LOCK TABLES `Cities` WRITE;
/*!40000 ALTER TABLE `Cities` DISABLE KEYS */;
INSERT INTO `Cities` VALUES (1,'Николаев','Mykolaiv'),(2,'Киев1','Kiev');
/*!40000 ALTER TABLE `Cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Countries`
--

DROP TABLE IF EXISTS `Countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL DEFAULT '',
  `eng_Name` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Countries`
--

LOCK TABLES `Countries` WRITE;
/*!40000 ALTER TABLE `Countries` DISABLE KEYS */;
INSERT INTO `Countries` VALUES (3,'Украина','Ukr'),(4,'Польша','Poland'),(5,'Россия','Russia'),(6,'Китай','China');
/*!40000 ALTER TABLE `Countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Discipline`
--

DROP TABLE IF EXISTS `Discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Discipline` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Discipline`
--

LOCK TABLES `Discipline` WRITE;
/*!40000 ALTER TABLE `Discipline` DISABLE KEYS */;
INSERT INTO `Discipline` VALUES (1,'Какая-то1');
/*!40000 ALTER TABLE `Discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Subject`
--

DROP TABLE IF EXISTS `Subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Subject` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_Discipline` int DEFAULT NULL,
  `Name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Subject`
--

LOCK TABLES `Subject` WRITE;
/*!40000 ALTER TABLE `Subject` DISABLE KEYS */;
INSERT INTO `Subject` VALUES (2,NULL,'Тест171');
/*!40000 ALTER TABLE `Subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Theme` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_User` int DEFAULT NULL,
  `id_Subject` int DEFAULT NULL,
  `Name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Theme`
--

LOCK TABLES `Theme` WRITE;
/*!40000 ALTER TABLE `Theme` DISABLE KEYS */;
INSERT INTO `Theme` VALUES (2,1,1,'Выш мат');
/*!40000 ALTER TABLE `Theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `University_group`
--

DROP TABLE IF EXISTS `University_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `University_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL DEFAULT '',
  `University` varchar(128) DEFAULT NULL,
  `id_ElderStudent` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `University_group`
--

LOCK TABLES `University_group` WRITE;
/*!40000 ALTER TABLE `University_group` DISABLE KEYS */;
INSERT INTO `University_group` VALUES (1,'Тест171111',NULL,NULL);
/*!40000 ALTER TABLE `University_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) DEFAULT NULL,
  `Surname` varchar(32) DEFAULT NULL,
  `Login` varchar(64) NOT NULL DEFAULT '',
  `Email` varchar(64) DEFAULT NULL,
  `PassHash` varchar(128) NOT NULL DEFAULT '',
  `PassSalt` varchar(128) NOT NULL DEFAULT '',
  `Coins` int DEFAULT NULL,
  `id_Group` int DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `id_Interface` varchar(64) DEFAULT NULL,
  `ShopInfo` varchar(64) DEFAULT NULL,
  `id_City` int DEFAULT NULL,
  `id_Country` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Вася123','Фканер','azf','111@111','222','111',10,NULL,'2020-05-05 16:00:00',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-20 20:58:07
