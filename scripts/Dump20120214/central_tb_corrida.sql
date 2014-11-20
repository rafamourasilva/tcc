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
-- Table structure for table `tb_corrida`
--

DROP TABLE IF EXISTS `tb_corrida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_corrida` (
  `id_corrida` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL DEFAULT '0',
  `ds_endereco_origem` varchar(255) NOT NULL,
  `ds_endereco_destino` varchar(255) NOT NULL,
  `nu_telefone` varchar(15) NOT NULL,
  `vl_corrida` decimal(5,2) NOT NULL,
  `dt_corrida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_corrida` char(1) NOT NULL DEFAULT 'P' COMMENT 'P = Pendente\nA = Atendido\nC = Cancelado\n',
  `id_funcionario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_corrida`,`id_cliente`),
  KEY `fk_corrida_funcionario` (`id_funcionario`),
  CONSTRAINT `fk_corrida_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_corrida`
--

LOCK TABLES `tb_corrida` WRITE;
/*!40000 ALTER TABLE `tb_corrida` DISABLE KEYS */;
INSERT INTO `tb_corrida` VALUES (1,4,'quadra 12 casa 25 valparaiso II valparaiso de goias','etapa A quadra 20 casa 30 valparaiso I valparaiso de goias','123121',3.00,'2012-02-13 23:08:32','P',118),(2,2,'quadra 12 casa 25 valparaiso II valparaiso de goias','etapa A quadra 20 casa 30 valparaiso I valparaiso de goias','36277500',3.00,'2012-02-13 23:28:57','P',118),(3,5,'end1','end2','33313434',3.00,'2012-02-13 23:30:38','P',118),(4,7,'end1','end2','82877777',3.50,'2012-02-13 23:36:56','P',118),(5,2,'quadra 12 casa 25 valparaiso II valparaiso de goias','etapa A quadra 20 casa 30 valparaiso I valparaiso de goias','36277500',3.50,'2012-02-13 23:39:14','P',118),(6,2,'end1','end2','36277500',15.00,'2012-02-13 23:42:43','P',118),(7,8,'qi 19','ceilandia sul','98765432',3.50,'2012-02-13 23:47:29','P',118),(8,9,'paranoa tes tes tes tes','asa norte tal tal tal ','61616161',5.50,'2012-02-13 23:52:34','P',118),(9,10,'end1','end2','88888888',3.50,'2012-02-14 00:56:02','P',118),(10,11,'endereco 1','endereco 2','09988990',3.50,'2012-02-14 20:38:51','P',118);
/*!40000 ALTER TABLE `tb_corrida` ENABLE KEYS */;
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
