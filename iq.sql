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
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estrategias`
--

DROP TABLE IF EXISTS `estrategias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estrategias` (
  `idestrategias` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idestrategias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estrategias_definitions`
--

DROP TABLE IF EXISTS `estrategias_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estrategias_definitions` (
  `id_estrategias_definitions` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_candle_0` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_candle_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_candle_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_candle_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_candle_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_entering_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_entering_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_entering` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_entering` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_entering_analysis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candle_entering_result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale1_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_gale1_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_gale1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale1_analysis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candle_gale1_result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale2_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_gale2_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_gale2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candles_for_gale2_analysis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `howmany_candles_for_gale2_analysis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candle_gale2_result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `analysis` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `against_analysis` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'false',
  PRIMARY KEY (`id_estrategias_definitions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_strategy_steps_iq_options`
--

DROP TABLE IF EXISTS `log_strategy_steps_iq_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_strategy_steps_iq_options` (
  `id_logvelas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vela_retorno` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_logvelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_strategy_steps_mt4s`
--

DROP TABLE IF EXISTS `log_strategy_steps_mt4s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_strategy_steps_mt4s` (
  `id_logvelas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_logvelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `new_table`
--

DROP TABLE IF EXISTS `new_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new_table` (
  `idnew_table` int(11) NOT NULL,
  PRIMARY KEY (`idnew_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pairs`
--

DROP TABLE IF EXISTS `pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pairs` (
  `idpairs` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idpairs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pairs_iq_option_states`
--

DROP TABLE IF EXISTS `pairs_iq_option_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pairs_iq_option_states` (
  `idlog` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payout` double(8,2) NOT NULL,
  `open` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pairs_mt4_states`
--

DROP TABLE IF EXISTS `pairs_mt4_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pairs_mt4_states` (
  `idlog` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `resultado_estrategia_iq_options`
--

DROP TABLE IF EXISTS `resultado_estrategia_iq_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultado_estrategia_iq_options` (
  `id_resultado_estrategias_iq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado_estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_resultado_estrategias_iq`),
  UNIQUE KEY `estrategia_hora_id` (`idpairs`,`datahora`,`estrategia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `resultado_estrategia_mt4s`
--

DROP TABLE IF EXISTS `resultado_estrategia_mt4s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultado_estrategia_mt4s` (
  `id_resultado_estrategias` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado_estrategia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vela_retorno` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_resultado_estrategias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `valores_iq_option_candles`
--

DROP TABLE IF EXISTS `valores_iq_option_candles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valores_iq_option_candles` (
  `id_valores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abertura` double(8,2) NOT NULL,
  `fechamento` double(8,2) NOT NULL,
  `maior_valor` double(8,2) NOT NULL,
  `menor_valor` double(8,2) NOT NULL,
  `caracteristica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_valores`),
  UNIQUE KEY `uniquedatahora` (`datahora`,`idpairs`),
  KEY `datahora` (`datahora`),
  KEY `datahorapair` (`datahora`,`idpairs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `valores_mt4_candles`
--

DROP TABLE IF EXISTS `valores_mt4_candles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valores_mt4_candles` (
  `id_valores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpairs` int(11) NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datahora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abertura` double(8,2) NOT NULL,
  `fechamento` double(8,2) NOT NULL,
  `maior_valor` double(8,2) NOT NULL,
  `menor_valor` double(8,2) NOT NULL,
  `caracteristica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_valores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-11 18:22:44
