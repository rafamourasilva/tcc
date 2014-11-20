CREATE DATABASE  IF NOT EXISTS `central` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `central`;
-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: central
-- ------------------------------------------------------
-- Server version	5.5.15

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
-- Table structure for table `tb_colete`
--

DROP TABLE IF EXISTS `tb_colete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_colete` (
  `id_colete` int(11) NOT NULL AUTO_INCREMENT,
  `nu_colete` varchar(45) NOT NULL,
  `st_colete` tinyint(1) NOT NULL DEFAULT '1',
  `dt_colete` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_funcionario` int(11) DEFAULT NULL,
  `st_disponibilidade` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_colete`),
  KEY `fk_funcionario_colete` (`id_funcionario`),
  CONSTRAINT `fk_funcionario_colete` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_colete`
--

LOCK TABLES `tb_colete` WRITE;
/*!40000 ALTER TABLE `tb_colete` DISABLE KEYS */;
INSERT INTO `tb_colete` VALUES (46,'1',1,'2012-02-10 12:43:38',118,0),(47,'2',1,'2012-02-10 12:43:41',120,0),(48,'3',1,'2012-02-10 12:43:44',NULL,0),(49,'4',1,'2012-02-10 12:43:46',NULL,0),(50,'5',1,'2012-02-10 12:43:48',NULL,0),(51,'6',1,'2012-02-10 12:43:51',NULL,0),(52,'7',1,'2012-02-10 12:43:53',NULL,0),(53,'8',1,'2012-02-10 12:43:56',NULL,0),(54,'9',1,'2012-02-10 12:43:59',NULL,0),(55,'10',1,'2012-02-10 12:44:03',NULL,0),(56,'20',1,'2012-02-13 23:40:00',119,0),(57,'21',1,'2012-02-13 23:40:03',NULL,0),(58,'22',1,'2012-02-13 23:40:06',NULL,0);
/*!40000 ALTER TABLE `tb_colete` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-02-14 19:20:13
