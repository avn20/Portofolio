-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_porto
-- ------------------------------------------------------
-- Server version	8.4.2

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_17_094933_create_projects_table',2),(5,'2026_05_17_120000_make_link_proyek_nullable_on_projects_table',3),(6,'2026_05_18_102720_rename_project_columns_to_standard_names_on_projects_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'2026-05-18 05:34:35','2026-05-18 05:37:29','Ulangan Sekolah SDN TELUK DALAM 3','Ini merupakan proyek ketiga saya bersama tim saya, yaitu modulia di sini saya sebagai full-stack developer.','projects/VORtK4Jdiv5Us8yu2DBFss77wVY1tAMsbSklno9u.png','https://suj.modulia.web.id');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0cJbjGajRZAf7vpGA29B1CxNO0UEVETqbJT8VXhc',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJlb29PdE4zYkhkZU1aY3NCY2g4eEY2d1d0TFFuazFKQ1kwQ2tNT2JuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9tYXN1ayIsInJvdXRlIjoiYWRtaW4ubG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJpc19hZG1pbiI6dHJ1ZX0=',1779326875),('29ekhLYILvPuOSWHCzrgQIBEZ2AYsMyUnZJE7p2Q',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJpdzBDUDJuVjFBRkFmTEd4UjhDR3VvZ2ZNanZDb0lLcWxDMzVrSDQ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779111547),('38cOH399prhLqoIivvgodLnkdXIXlGgCegjBXICx',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJWTU42UzJIcG5aWVUyM3AwVndwQTFHMW1PSlNhOEJINXd5amQzTWtVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779106907),('49yeCN1LxWluiQjB9LDJ2Wygpg0u6k7JrTAjROLD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','eyJfdG9rZW4iOiJWT1V3OEx0NzNET2RXYkk3M3dLYjFydzFMdnFQamlBZUtuMFo3Y3IwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9tYXN1ayIsInJvdXRlIjoiYWRtaW4ubG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2NhbGUiOiJlbiJ9',1779755809),('65kqeIUCg5FhiBJXFP3U2bgJsKJREdOME8MC0Hka',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIzZXdwd3A0a3NtTk83d0JNaHhJTHgwZTFOOHNNQ2hZNGszM3ZjSUJSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9wcm9qZWN0cyIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJpc19hZG1pbiI6dHJ1ZX0=',1779326957),('65q7Ixf0WHacRUeo6hvoWb5CKotmIykKqxlBuYxz',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJiV3gyY2dNa1YydDU1STFGZkhIVlBscFRNMVZLaFBFc2VBT2xMWUpWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779113273),('6OdAKWbTSfJQzTmG4tTWIN9bDWhcaUY9JvE9TVnC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJGbGZ2OXp3VXJKTnVWZ3c0SUFWU2VjUU16TkRtM3VVTHQ1dnBvZ20xIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHMiLCJyb3V0ZSI6ImFkbWluLnByb2plY3RzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779106907),('8Qqm0xtR0iVDzMMO30xZKtqTSu2FIDo14H142wSG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJTZk5tMGxDUXRlTXY2NHJBZVpKTGV0Yzk5VTRKTVhaY1plb21NRWdqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL215cG9ydG8udGVzdFwvP2hlcmQ9cHJldmlldyIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1779113136),('9uEZGJ5UceP1GV4LTEwxw0FPQFS8kJ2JEnpqdsHd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJwa1N1VmNlVVBUNGlubkNMSE9OcUk4aVRjYkg3ZnFXZHB4bVNoTWF1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL215cG9ydG8udGVzdFwvYWRtaW5cL21hc3VrIiwicm91dGUiOiJhZG1pbi5sb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImlzX2FkbWluIjp0cnVlfQ==',1779111379),('A2atVsZ51ZS53OAuRfvNoT5DsWqD270q35K2aE9N',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJJTmtKUUtGOGtDY3MxZ004aHlYWTNFU0hPOWFsZmNMdjF6amE1SHJNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pbiIsInJvdXRlIjoiYWRtaW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779107415),('CnCh0V5gGOhLmke7hK8fTSp7HdBg6kbRa5VaOxXH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJKNVo5bHI0SVEwQWJYdkloYW9Vdk5OOERXazVrWndaRDRUZXVTMG1JIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779326829),('Ddtfnf81gRZmHs7ylx4PFPho2EBYYXtWNgtgpRL7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJEeTgydEZEQURSVGhMNVFpYko4OER0dE1qeWhnUjJDbWYyWHp6eHV6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779715396),('E1bXH2O93E32RsduM3BF0sp0CVfQFtLTAtpfzX65',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiI3WUtSUTdMdGZGSXkxWnI4OWNWOERtdnZlUEJKc1J3Z1JBTmFlN3ZGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779111639),('F49FRCjSiqPDgxqnYhsQA8jtbiA22UP4saxzYPdS',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJDVmgySEdza3RYNDY5WHpLWmNsYWdlVDBmWkRzd2FlUmtqaXFLUWpQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHNcL2NyZWF0ZSIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiaXNfYWRtaW4iOnRydWV9',1779111058),('FRMBCwxueufG2yqgoc3zrnFlce1JyiuAm0Izd2q7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJseDFLUnlWbGtxWVNPbkxTZnEyRjBNMjJKOFBzeWdrTTY1UGRZVTR0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779106906),('fxA2TlDvj2SrlVofexM9CPl0c5xzEcDt6FmgyIsa',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJCUjJySXYwZm5zNWFDbm90aVU5am1kTUdlM3Q1ZGRRTk9wVWI4RVFkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779753269),('gwtKPf40hCtSSw5aGL39D1Bxu8bAZrStuEs3E0GU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJhRUFjZTBPWmRWN1BmV2lZTW9OZmFBbG1IbkVKMG91d3V6Tm9VYktDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHMiLCJyb3V0ZSI6ImFkbWluLnByb2plY3RzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779111076),('hP1PMqVcdEq80f4MTSg7NetoUrRaxIImQgfCHjqy',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJvU2JUVGR5cDZ4ZXFxU2NnVU5IWGFKcXB0a3BpSnRZMkxmQ3M5V0ZKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9tYXN1ayIsInJvdXRlIjoiYWRtaW4ubG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779322633),('IBSjgFyzn8nNtiyuRRMmzyzLUgB2luL7YsZmJS4G',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJDdmJLbjFHWDZwaW03ZWFnTURudmhKNFRBUHBkMnY2ams0dDh1YmlsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2NhbGUiOiJlbiJ9',1779540169),('ihquoIKNI0p5rvjAYkQN4jC1Fs7bbYpjeGYrZCNp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJVZmtyejVySGRVbFZVSVlkMVBqNHo2bXZYVWdXRFNrTHliSU00YnppIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2NhbGUiOiJlbiJ9',1779715480),('IknqskQeL8XwBfwi4rXwGbOu4iiidkstByT5eNH2',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJhNnlWckdwM291b3lraElxcUdpaHhORUVFSGh6TTJPdjlZYnUzaUJJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779110690),('J5WbIPAgLNJanmRwdb70a22tSKfFfO2KMqy8zXMJ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiI5OElyVTFHOWF6TzkxaTZkajU3bWEzQ01YbWlncWxqQUpHc3VDanZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779112566),('jAjrpLcyxB1BHcfvoof0Z2sqbkf95G6MHvS5Ouat',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJtU0xycGt2a3E3NnFXcHo2OE9DMDM4Q2xFNUVkSXF4dTA3REFMSFdOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779113281),('kb9MiOrjuvXlBQUJnvc1tKZWDe7udhxaRY2Ce0DW',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJLUFE1dU5hdEY0a0t5d3dNS0pYR2FXaFhFTTU4MnNrbTUwWmtWOUhqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHNcL2NyZWF0ZSIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiaXNfYWRtaW4iOnRydWV9',1779111548),('Kilgf9ogQDuGioajlCx9h33Lfqm8Kd5gv1ZouTAm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJNNjdhZnU4TmNFdHFwdTltbWp0d2VlSU1zRTZaUVhHYU03WXRPTFBSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779106947),('lhVBfje52iGjD6Geo49xYEffZ0JlIV4Wsx0uj3DC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','eyJfdG9rZW4iOiJzVExpVGpCcmV1ZlBlcm5iSTFGOVdrTElyNjBSQ1dweFZwWGcyQUlxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9wcm9qZWN0cyIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2NhbGUiOiJlbiIsImlzX2FkbWluIjp0cnVlfQ==',1779759562),('n5C5UK3DYK8FJ8CFjlHm836khQOpNNXznuuWyksn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJkWG1ocHgzUk9WMjhpcTZodmJ3RTg4Vzd6Z01pcnoyR0gycktYM21mIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779113163),('n98mfyANgyubp5ZekyZUG0VWwttsYFCSsPQYRlJI',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJUNkY2R21lWHFZakt0T2k1U09kS2U2Wk1xNjB5SGtEMllZNkVrbXNpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOlsiX29sZF9pbnB1dCIsImVycm9ycyJdLCJuZXciOltdfSwiX29sZF9pbnB1dCI6eyJfdG9rZW4iOiJUNkY2R21lWHFZakt0T2k1U09kS2U2Wk1xNjB5SGtEMllZNkVrbXNpIn0sImVycm9ycyI6eyJkZWZhdWx0Ijp7ImZvcm1hdCI6IjptZXNzYWdlIiwibWVzc2FnZXMiOnsicGFzc3dvcmQiOlsiUGFzc3dvcmQgYWRtaW4gc2FsYWguIl19fX19',1779110703),('NHWTQ4ivATPl4jrC1qOuVS5lHowTjpq0JL6DlDwr',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJJTFA0VzB3b0hFVlhYRlZYd2xrbEdnODFESW1kNXlnOTRXMjR5NjBpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779107423),('O2g5mtC9NZtxMbN5Cfo8WhVc2QevYIH54yZONxOD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','eyJfdG9rZW4iOiJqa0lNYW5iQWxFSEg1Nml1QlhrNm9BaDBSWDdFSnMySWkybG9DSzRLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcL2FkbWluXC9tYXN1ayIsInJvdXRlIjoiYWRtaW4ubG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2NhbGUiOiJlbiJ9',1779759502),('q4IlZpH2UOyNASWjwaFavVuojzupOGWOReJxmEpG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiIxUVlvMzF4ZXR1QTdiZmpqUUlobDJJQkh0TmdTYjZmWGZmRFlxYXA1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779111037),('QNQKigA2KT4VTahBc8nZQfDvNLAHq41r0j6h755v',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJZWGJ5aFpUN1hlemZIQUxLbHluTHZUTGNmclNraFNQZVgwUnBOdHN4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779113152),('sf0hTq1uAgTrfPOUKGLMisIHJz8hlIgSYBA5HDPC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJxYTdJVmc3amFITTF2WEQ1M2JNT3lhcW5LcENEZWw2VlBianRSa1h6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL215cG9ydG8udGVzdFwvYWRtaW5cL21hc3VrIiwicm91dGUiOiJhZG1pbi5sb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImlzX2FkbWluIjp0cnVlfQ==',1779111153),('SuHVNjICuF8Y7h9vbriaSnV0Giz6Ec1eoWmytkt4',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiI1MjFKTGxPazd4cUNWZk9DUWpVZUNIeldNVEtJZW9lOVczOFlZN1BrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779110689),('t8hiU6dVyFpDb2T8YK6nGoqzqpzvV06jxp8Fy11V',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJ4S1UwdEwzenB1VmttZVdqMmF0RFdGazFKV2pNSlQ5RUJRc1IwTWJvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779537434),('u1wTcdjz9ev1H1IODDCKFSgdZNkau17IihzPZuWT',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJQTDdkcWEwZXQ5cXYxa0V0OW5IRkpXRHMzYmJHdG03eURyZDEyWjJzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHNcL2NyZWF0ZSIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiaXNfYWRtaW4iOnRydWV9',1779111640),('U4YvcNVzDsxHc2gUAMEDOBfWtwz2vn1KCLkYJUAW',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJwRms5cFdGYjlIZWFrTDBnV0hCQU5sRUxIRFFNdWc2ckFMTlVBdXNwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779322598),('VLNZ6Hl9oYg3axgYDCr5WszTUTZ1ztuOJZaBzBmL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJEaWpxRVp2VlNCb0J0WXphQkhkejlKMUh4NjVaNTlNbkRwYjlhNWpIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvamVjdHNcL2NyZWF0ZSIsInJvdXRlIjoiYWRtaW4ucHJvamVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiaXNfYWRtaW4iOnRydWV9',1779111039),('vQqXUoWRB8D2yy8bdNPwzdNNmkLQHadRmSIrh0Oa',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiI4Q3NGWXJSclRMT25JQzZHenI5RWl5dGY5b3o5MVJSbVZYbnAyZUF6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbWFzdWsiLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779111057),('wCuGJmGTpVgJeZI6719yjRcpO80QGRPcF6pRuQYx',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI1elZWRkxudW1OYXhWZ040MUpZYkZQRFlZMEkwNnk0eTZHcnRDRHR6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL215cG9ydG8udGVzdFwvYWRtaW5cL21hc3VrIiwicm91dGUiOiJhZG1pbi5sb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImlzX2FkbWluIjp0cnVlfQ==',1779111344),('Y5e6KYAn6zhhROqqh2kVPZmNwaGbbjWZ72D5jk7V',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJQNzNFQnVmOUM3UXBVd0FnTjI0akJ1eEtVR1pzaTF0VkVwckM2a28wIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779106946),('ytrmOYHVRd2Zd7VZyIPbwOK4XlIZlFFybWyr33ur',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-US) PowerShell/7.5.5','eyJfdG9rZW4iOiJkbldQazRubGxHMm9UaXBLU2NBSWpXWEdNcGRuajhWcWpCSkNQdEhhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779108512),('zbcNtqvfBK9zwda6j4BhFQy6c8akbOBCQESNYoIy',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJQckkweWpiQnlxNHZTVWJmZWJGNDg1RlYzNHdLbXNDdmxKWklQdHNzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9teXBvcnRvLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1779753269);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_porto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-12  7:59:18
