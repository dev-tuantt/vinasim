-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: vinasim
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1' COMMENT '1 = visible, 0 = hidden',
  `display_order` int NOT NULL DEFAULT '0' COMMENT 'Display order (ascending)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Banner carousel on homepage';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Trang chủ (Home)','','/storage/banners/uylks0lYlMEEFYwTAWGTugUcdgXkaEJckDyV7zgA.jpg',1,0,'2026-03-30 16:31:06','2026-03-30 16:31:06'),(2,'Gói cước 4G/5G','','/storage/banners/jEbKaeMU3jsTHnva6NM5CjsKyxFucmNrfVWrsftY.jpg',1,0,'2026-03-30 16:31:25','2026-03-30 16:31:25');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Product categories';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Gói cước 4G/5G','',1,'2026-03-30 15:39:09','2026-04-06 16:11:44',NULL),(2,'Sim số đẹp','',1,'2026-03-30 15:39:09','2026-04-06 16:11:44',NULL),(3,'Sim so dep','',1,'2026-03-30 16:26:17','2026-03-30 16:26:17',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
  `attempts` tinyint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL-friendly slug (auto-generated from title)',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci COMMENT 'Summary (max 255 chars, used for preview)',
  `is_published` tinyint NOT NULL DEFAULT '1' COMMENT '0 = draft, 1 = published',
  `published_at` timestamp NULL DEFAULT NULL COMMENT 'Publish time (nullable if draft)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='News & Articles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'123 dffd fgds','hihi-do-ngopk','<p><strong>sdfasd</strong></p><blockquote><ul><li>gfhhh</li><li>fasdf</li><li>hj</li></ul></blockquote><p>dsfasdfdf</p><p>gfh fghdfghd dfghdfg</p><ol><li>gfh</li><li>hjfh</li></ol>',NULL,'123fg s',1,'2026-03-31 14:20:15','2026-03-31 14:20:15','2026-03-31 14:20:15'),(2,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(4,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan1','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(5,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan2','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(6,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan3','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(7,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan4','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(8,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan5','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(9,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan6','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(10,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan67','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(11,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan1','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan672','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(12,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan12','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan6732','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(13,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan123','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan67323','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(14,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan12223','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan673232','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(15,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan122233','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan6732323','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(16,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan1222334','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan67323234','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(17,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan12223324','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan673232234','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(18,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan123223324','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan6732332234','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(19,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan1423223324','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan64732332234','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00'),(20,'myLocal ra mat goi data 5G toc do cao danh cho nguoi dung ca nhan14232523324','mylocal-ra-mat-goi-data-5g-toc-do-cao-danh-cho-nguoi-dung-ca-nhan647323325234','<p>myLocal chinh thuc gioi thieu nhom goi cuoc 5G moi voi uu diem toc do cao, phu hop nhu cau hoc tap, giai tri va lam viec tu xa.</p><p>Nguoi dung co the dang ky nhanh, kich hoat linh hoat va theo doi uu dai ngay tren he thong cua myLocal.</p>','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80','myLocal gioi thieu nhom goi cuoc 5G moi, toi uu cho nhu cau online hang ngay va lam viec tu xa.',1,'2026-04-06 08:00:00','2026-04-06 08:00:00','2026-04-06 08:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `product_id` bigint unsigned NOT NULL,
  `order_details` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Order details (form data or JSON)',
  `status` int NOT NULL DEFAULT '1' COMMENT '1=pending, 2=processing, 3=processed, 4=completed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_orders_product` (`product_id`),
  CONSTRAINT `fk_orders_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Customer orders';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Le Van C','0901234567','levanc@example.com',1,'Dang ky goi MAX 90 cho thue bao 0901234567',2,'2026-03-27 16:26:17','2026-03-27 17:01:17'),(2,'Pham D','0901234567','phamd@example.com',3,'Mua sim dep giao gio hanh chinh',4,'2026-03-28 16:26:17','2026-04-06 17:01:19'),(3,'Nguyen Thi Ha','0987654321','ha.nguyen@example.com',2,'Dang ky ST120, nhan kich hoat qua SMS',1,'2026-03-29 16:26:17','2026-03-29 16:26:17'),(4,'Tran Minh Khoa','0931112233','khoa.tran@example.com',1,'Gia han goi MAX 90 them 1 thang',3,'2026-03-29 20:26:17','2026-03-30 06:26:17'),(5,'Do Mai Anh','0977008899','maianh@example.com',3,'Dat sim qua website, can ho tro chuyen mang',2,'2026-03-30 08:26:17','2026-03-30 14:26:17'),(6,'Vu Quang Huy','0966332211','huyvu@example.com',2,'Dang ky ST120 cho sim moi mua',1,'2026-03-30 14:26:17','2026-03-30 14:26:17');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` json DEFAULT NULL COMMENT 'specifications (JSON format)',
  `is_active` tinyint NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_category` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Products (packages, beautiful numbers)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'MAX 90','Goi cuoc data MAX 90',1,90000.00,NULL,NULL,1,'2026-03-30 16:26:17','2026-03-30 16:26:17',NULL),(2,'ST 1201','Goi cuoc data ST 1201',1,1200001.00,NULL,'{\"data\": \"\", \"duration\": \"\"}',1,'2026-03-30 16:26:17','2026-03-30 16:39:53',NULL),(3,'Sim Vip 6868','Sim so dep dong 6868',2,2500000.00,NULL,NULL,1,'2026-03-30 16:26:17','2026-04-06 16:12:48',NULL),(4,'Gói MAX90','Gói data phổ thông, phù hợp nhu cầu lướt web và mạng xã hội mỗi ngày.',1,90000.00,'https://example.com/images/goi-max90.jpg','{\"data\": \"30GB\", \"duration\": \"30 ngày\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(5,'Gói MAX150','Gói data tốc độ cao dành cho người dùng thường xuyên xem video và làm việc online.',1,150000.00,'https://example.com/images/goi-max150.jpg','{\"data\": \"60GB\", \"duration\": \"30 ngày\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(6,'Gói MAX200','Gói data dung lượng lớn cho nhu cầu streaming, hotspot và sử dụng liên tục.',1,200000.00,'https://example.com/images/goi-max200.jpg','{\"data\": \"100GB\", \"duration\": \"30 ngày\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(7,'Gói SV70','Gói data tiết kiệm dành cho học sinh, sinh viên.',1,70000.00,'https://example.com/images/goi-sv70.jpg','{\"data\": \"20GB\", \"duration\": \"30 ngày\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(8,'SIM VIP 0912345678','Sim số đẹp dễ nhớ, phù hợp kinh doanh và xây dựng thương hiệu cá nhân.',2,2500000.00,'https://example.com/images/sim-0912345678.jpg','{\"number\": \"0912345678\", \"carrier\": \"Viettel\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(9,'SIM THẦN TÀI 0399999999','Sim số đẹp đuôi cửu quý, hợp kinh doanh.',2,15000000.00,'https://example.com/images/sim-0399999999.jpg','{\"number\": \"0399999999\", \"carrier\": \"Viettel\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(10,'SIM PHÁT LỘC 0886868686','Sim lặp số đẹp, dễ đọc, dễ nhớ, phù hợp làm hotline.',2,4800000.00,'https://example.com/images/sim-0886868686.jpg','{\"number\": \"0886868686\", \"carrier\": \"Vinaphone\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL),(11,'SIM TAM HOA 0777771234','Sim số đẹp có cụm tam hoa, giá mềm, dễ tiếp cận.',2,3200000.00,'https://example.com/images/sim-0777771234.jpg','{\"number\": \"0777771234\", \"carrier\": \"Mobifone\"}',1,'2026-04-06 16:11:44','2026-04-06 16:11:44',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seos`
--

DROP TABLE IF EXISTS `seos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Identifier trang (e.g., home, pricing, about)',
  `product_id` bigint unsigned DEFAULT NULL COMMENT 'Related product (if product detail page)',
  `data_seo` text COLLATE utf8mb4_unicode_ci COMMENT 'JSON storage for SEO metadata (title, meta_description, keywords, og_image, canonical_url)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_key` (`page_key`),
  KEY `fk_seos_product` (`product_id`),
  CONSTRAINT `fk_seos_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='SEO metadata for pages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seos`
--

LOCK TABLES `seos` WRITE;
/*!40000 ALTER TABLE `seos` DISABLE KEYS */;
INSERT INTO `seos` VALUES (1,'home',NULL,'{\"title\":\"Trang chủ\",\"meta_description\":\"Trang chủ công ty viễn thông\",\"keywords\":\"1\",\"og_image\":\"1\",\"canonical_url\":\"1\"}','2026-03-30 15:39:09','2026-03-30 16:18:13'),(2,'pricing',NULL,'{\"title\":\"Gói Cước 4G\\/5G\",\"meta_description\":\"Gói cước 4G\\/5G\",\"keywords\":\"2\",\"og_image\":\"2\",\"canonical_url\":\"2\"}','2026-03-30 15:39:09','2026-03-30 16:18:22'),(3,'sim',NULL,'{\"title\":\"Sim Số Đẹp\",\"meta_description\":\"Sim số đẹp\",\"keywords\":\"3\",\"og_image\":\"3\",\"canonical_url\":\"3\"}','2026-03-30 15:39:09','2026-03-30 16:18:28'),(4,'news',NULL,'{\"title\":\"Tin Tức\",\"meta_description\":\"Tin tức\",\"keywords\":\"4\",\"og_image\":\"4\",\"canonical_url\":\"4\"}','2026-03-30 15:39:09','2026-03-30 16:18:34'),(5,'about',NULL,'{\"title\":\"Về Chúng Tôi\",\"meta_description\":\"Về chúng tôi\",\"keywords\":\"5\",\"og_image\":\"5\",\"canonical_url\":\"5\"}','2026-03-30 15:39:09','2026-03-30 16:18:44'),(6,'tracking',NULL,'{\"title\": \"Tra Cứu Đơn Hàng\", \"keywords\": null, \"og_image\": null, \"canonical_url\": null, \"meta_description\": \"Tra cứu đơn hàng\"}','2026-03-30 15:39:09','2026-03-30 15:39:09');
/*!40000 ALTER TABLE `seos` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('PeNohE3FBcciPR6Fezb243Ns7nTjG5PYYYV9Einj',2,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIxSHZ0aVVwdzVwS0VOUGJ3dTJSUVo4TFpXUmhka3Izb1BQaFEzaUtMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvYmFubmVycyIsInJvdXRlIjoiYWRtaW4uYmFubmVycyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1777908607),('WrZ3ORZsfsPHLtx7xqGOOTCTWLFdXNJCQIcYHAoW',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI1SVhBdXZRbUV2eTdQRTV0NDZiM0J2SWtmVVJLakc0YzN5d2FLM2xvIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvdHJhLWN1dS1kb24taGFuZz9waG9uZT0wOTAxMjM0NTY3Iiwicm91dGUiOiJvcmRlci10cmFja2luZyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1775495147);
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
  `role` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = admin, 2 = supporter',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Admin & supporter users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@admin.com','1','5f4dcc3b5aa765d61d8327deb882cf99','2026-03-30 15:39:09','2026-03-30 15:39:09'),(2,'admin','admin@admin','1','$2y$12$wcEvSw637QMTQE3NXGWu/OVrCd6oYy.jaXaDCmzWMTE/crx5nPW1a','2026-03-30 15:39:44','2026-03-30 15:39:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-04 22:37:26
