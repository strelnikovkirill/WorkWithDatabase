CREATE DATABASE  IF NOT EXISTS `pp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pp`;
-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: pp
-- ------------------------------------------------------
-- Server version	5.5.50-0ubuntu0.14.04.1

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
-- Table structure for table `Authorization_Strelnikov`
--

DROP TABLE IF EXISTS `Authorization_Strelnikov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Authorization_Strelnikov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL,
  `worker_login` char(50) CHARACTER SET utf8 NOT NULL,
  `password` char(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_id` (`worker_id`),
  KEY `worker_login` (`worker_login`),
  CONSTRAINT `Authorization_Strelnikov_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `Employee_Strelnikov` (`id`),
  CONSTRAINT `Authorization_Strelnikov_ibfk_2` FOREIGN KEY (`worker_login`) REFERENCES `Employee_Strelnikov` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Authorization_Strelnikov`
--

LOCK TABLES `Authorization_Strelnikov` WRITE;
/*!40000 ALTER TABLE `Authorization_Strelnikov` DISABLE KEYS */;
INSERT INTO `Authorization_Strelnikov` VALUES (1,1,'kirill','1234'),(2,2,'maxim','2345'),(3,3,'sergey','3456'),(4,4,'ivan','4567'),(5,5,'victor','5678'),(6,6,'maxim1','6789'),(7,7,'vladimir','7890'),(8,8,'petr','8901'),(9,9,'ivan1','9012'),(10,10,'alexey','1023'),(11,11,'mikhail','1123');
/*!40000 ALTER TABLE `Authorization_Strelnikov` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-13 20:33:41
