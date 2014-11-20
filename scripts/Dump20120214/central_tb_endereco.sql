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
-- Table structure for table `tb_endereco`
--

DROP TABLE IF EXISTS `tb_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `ds_endereco` varchar(150) NOT NULL,
  `nu_endereco` varchar(45) CHARACTER SET ujis DEFAULT NULL,
  `ds_cidade` varchar(180) NOT NULL,
  `ds_uf` varchar(3) NOT NULL,
  `ds_bairro` varchar(180) DEFAULT NULL,
  `ds_complemento` varchar(180) DEFAULT NULL,
  `st_endereco` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo\nI = Inativo',
  `dt_endereco` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_endereco`
--

LOCK TABLES `tb_endereco` WRITE;
/*!40000 ALTER TABLE `tb_endereco` DISABLE KEYS */;
INSERT INTO `tb_endereco` VALUES (105,'teste','teste','1','1','teste',NULL,'A','2012-02-10 12:45:42'),(106,'teste','098','1','1','teste',NULL,'A','2012-02-10 12:46:31'),(107,'teset','test','1','1','teste',NULL,'A','2012-02-10 21:17:03'),(108,'808098','08098','1','1','0808908',NULL,'A','2012-02-10 21:17:55'),(109,'lkjçlkjlkj','teste','1','1','8098098',NULL,'A','2012-02-13 23:29:46'),(110,'0980809','08098','1','1','0808908',NULL,'A','2012-02-13 23:33:19'),(111,'sdfasdfasd','090','1','1','dasd',NULL,'A','2012-02-13 23:36:16'),(112,'sdfasdfasd','08098','1','1','8098098',NULL,'A','2012-02-13 23:40:38'),(113,'qi 19 bl A sl 108','','1','1','lago sul',NULL,'A','2012-02-13 23:46:16'),(114,'qi 11 tal tal tal','','1','1','lago sul',NULL,'A','2012-02-13 23:51:56'),(115,'teset','9809','1','1','valparaiso II',NULL,'A','2012-02-14 00:55:49'),(116,'teset','098','1','1','teste',NULL,'A','2012-02-14 01:12:45'),(117,'teste','09809','1','1','teste',NULL,'A','2012-02-14 20:38:04');
/*!40000 ALTER TABLE `tb_endereco` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-02-14 19:20:14
