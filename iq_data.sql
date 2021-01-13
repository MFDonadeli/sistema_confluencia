-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: iq
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `estrategias`
--

LOCK TABLES `estrategias` WRITE;
/*!40000 ALTER TABLE `estrategias` DISABLE KEYS */;
INSERT INTO `estrategias` VALUES (1,'MHI1','mhi1'),(2,'MHI2','mhi2'),(19,'MHI3','mhi3'),(20,'Vituxo','vituxo'),(21,'Nova Era','novaera'),(22,'23','e23'),(23,'Milhão Maioria','mmaioria'),(24,'Milhão Minoria','mminoria'),(25,'3 vizinhos','vizinhos'),(26,'R7','r7'),(27,'Moonwalker','moonwalker'),(28,'Pró Traders','protraders'),(29,'Torres Gêmeas','torresgemeas');
/*!40000 ALTER TABLE `estrategias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `estrategias_definitions`
--

LOCK TABLES `estrategias_definitions` WRITE;
/*!40000 ALTER TABLE `estrategias_definitions` DISABLE KEYS */;
INSERT INTO `estrategias_definitions` VALUES (1,'mhi1','entering','gale1','gale2','gale2_analysis','entering_message','2','0,1','0,1,2','3','4','3','','','0,1,2','4','5','4','','','0,1,2','5','0,1,2','6','5','Minoria','false'),(2,'mhi2','entering_message','entering','gale1','gale2','gale2_analysis','3','0,1,2','0,1,2','4','5','4','','','0,1,2','5','6','5','','','0,1,2','6','0,1,2','7','6','Minoria','false'),(3,'mhi3','gale2_analysis','entering_message','entering','gale1','gale2','4','0,1,2','0,1,2','5','6','5','','','0,1,2','6','7','6','','','0,1,2','7','0,1,2','8','7','Minoria','false'),(4,'vituxo','gale2_analysis','entering_message','entering','gale1','gale2','6','0,1,2','0,1,2','7','8','7','','','0,1,2','8','9','8','','','0,1,2','9','0,1,2','10','9','Maioria','false'),(5,'mmaioria','entering','gale1','gale2','gale2_analysis','entering_message','4','0,1,2,3','0,1,2,3,4','5','6','5','','','0,1,2,3,4','6','7','6','','','0,1,2,3,4','7','0,1,2,3,4','8','7','Maioria','false'),(6,'mminoria','entering','gale1','gale2','gale2_analysis','entering_message','4','0,1,2,3','0,1,2,3,4','5','6','5','','','0,1,2,3,4','6','7','6','','','0,1,2,3,4','7','0,1,2,3,4','8','7','Minoria','false'),(7,'protraders','gale2_analysis','entering_message','entering','gale1','gale2','6','1,2,3','1,2,3','7','8','7','','','1,2,3','8','9','8','','','1,2,3','9','1,2,3','10','9','Minoria','false'),(8,'vizinhos','gale1','gale2','gale2_analysis','entering_message','entering','0','-1','0','1','2','1','','','0','2','3','2','','','0','3','0','4','3','Vela Unica','false'),(9,'e23','entering_message','entering','gale1','gale2','gale2_analysis','0','-1','0','1','2','1','','','0','2','3','2','','','0','3','0','4','3','Vela Unica','false'),(10,'r7','entering_message','entering','gale1','gale2','gale2_analysis','8','-1','0','9','10','9','','','0','10','11','10','','','0','11','0','12','11','Vela Unica','false'),(11,'novaera','gale1','gale2','gale2_analysis','entering_message','entering','4','-1','0','5','6','5','','','0','6','7','6','','','0','7','0','8','7','Vela Unica','false'),(12,'torresgemeas','gale1','gale2','gale2_analysis','entering_message','entering','3','-1','0','4','5','4','','','0','5','6','5','','','0','6','0','7','6','Vela Unica','false'),(13,'moonwalker','entering','gale1','gale2','gale2_analysis','entering_message','2','-1','0','3','4','3','','','0','4','5','4','','','0','5','0','6','5','Vela Unica','false');
/*!40000 ALTER TABLE `estrategias_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pairs`
--

LOCK TABLES `pairs` WRITE;
/*!40000 ALTER TABLE `pairs` DISABLE KEYS */;
INSERT INTO `pairs` VALUES (1,'EURUSD'),(2,'AUDCAD'),(3,'EURGBP'),(4,'USDJPY'),(5,'AUDNZD'),(6,'GBPCAD'),(7,'USDCHF'),(8,'GBPUSD'),(9,'AUDJPY'),(10,'CADJPY'),(11,'CHFJPY'),(12,'EURAUD'),(13,'NZDUSD'),(14,'AUDUSD'),(15,'EURNZD'),(16,'EURJPY'),(17,'AUDCHF'),(18,'USDNOK'),(19,'EURCAD'),(20,'CADCHF'),(21,'GBPCHF'),(22,'GBPAUD'),(23,'USDCAD'),(24,'GBPJPY'),(25,'EURUSD-OTC'),(26,'AUDCAD-OTC'),(27,'EURGBP-OTC'),(28,'EURJPY-OTC'),(29,'NZDUSD-OTC'),(30,'USDJPY-OTC'),(31,'GBPUSD-OTC'),(32,'USDCHF-OTC'),(33,'GBPJPY-OTC');
/*!40000 ALTER TABLE `pairs` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-11 18:34:58
