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
-- Table structure for table `tb_cliente_telefone`
--

DROP TABLE IF EXISTS `tb_cliente_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cliente_telefone` (
  `id_cliente` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL,
  `st_cliente_telefone` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo\nI = Inativo',
  PRIMARY KEY (`id_cliente`,`id_telefone`),
  UNIQUE KEY `id_telefone_UNIQUE` (`id_telefone`),
  KEY `id_cliente_telefone` (`id_cliente`),
  KEY `id_telefone_telefone` (`id_telefone`),
  KEY `fk_cliente_telefone` (`id_cliente`),
  CONSTRAINT `fk_cliente_telefone` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_telefone_telefone` FOREIGN KEY (`id_telefone`) REFERENCES `tb_telefone` (`id_telefone`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cliente_telefone`
--

LOCK TABLES `tb_cliente_telefone` WRITE;
/*!40000 ALTER TABLE `tb_cliente_telefone` DISABLE KEYS */;
INSERT INTO `tb_cliente_telefone` VALUES (2,103,'A'),(3,104,'A'),(4,105,'A'),(5,106,'A'),(6,107,'A'),(7,108,'A'),(8,110,'A'),(9,111,'A'),(10,112,'A'),(11,114,'A');
/*!40000 ALTER TABLE `tb_cliente_telefone` ENABLE KEYS */;
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
