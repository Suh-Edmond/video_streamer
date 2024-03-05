-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: video_stream_db
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `file_shared_links`
--

DROP TABLE IF EXISTS `file_shared_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file_shared_links` (
                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                     `file_id` bigint unsigned NOT NULL,
                                     `shared_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `file_link` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `expire_at` timestamp NOT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_shared_links`
--

LOCK TABLES `file_shared_links` WRITE;
/*!40000 ALTER TABLE `file_shared_links` DISABLE KEYS */;
INSERT INTO `file_shared_links` VALUES (1,95,'8wnaqz5p4P','http://localhost:8000/files/95/sharer/8wnaqz5p4P/code?key=eyJpdiI6InR1UDloOWpxUmNMS2FtbE','2024-02-26 15:25:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(3,82,'14tvR8lxSD','http://localhost:8000/files/82/sharer/14tvR8lxSD/code?key=eyJpdiI6IjUzNEt4WDk2ZlFSKzZObG','2024-02-26 15:30:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(4,85,'Uyt53LCvpx','http://localhost:8000/files/85/sharer/Uyt53LCvpx/code?key=eyJpdiI6IkZiUzA2b3UvcUdSMm5YMF','2024-02-26 15:27:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(5,85,'yJxMY5tbU7','http://localhost:8000/files/85/sharer/yJxMY5tbU7/code?key=eyJpdiI6Ilc1QlFNWjFUQ3VzL0hhUV','2024-02-26 15:29:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(6,88,'o16NQMgmxQ','http://localhost:8000/files/88/sharer/o16NQMgmxQ/code?key=eyJpdiI6IkZoY0JxMUdGNUF6WGZWNj','2024-02-26 15:31:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(7,90,'jhHeqALk2o','http://localhost:8000/files/90/sharer/jhHeqALk2o/code?key=eyJpdiI6InJKcmkzRFJjMHZhQ0hIMk','2024-02-29 15:28:46','2024-02-26 15:22:46','2024-02-26 17:16:43'),(9,87,'Pdxdp2V0yZ','http://localhost:8000/files/87/sharer/Pdxdp2V0yZ/code?key=eyJpdiI6IkoxNmxMZVRRV0ZYTjE1c1','2024-02-26 15:29:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(11,88,'vggzZ6yYPS','http://localhost:8000/files/88/sharer/vggzZ6yYPS/code?key=eyJpdiI6IjNWWUhxVTUxUk9UR0EzYy','2024-02-26 15:32:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(12,84,'qz0Y5WlHBg','http://localhost:8000/files/84/sharer/qz0Y5WlHBg/code?key=eyJpdiI6Ink3Sk40T3Z2ZlZCb2tVaH','2024-02-26 15:25:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(13,87,'RApiWTlZVO','http://localhost:8000/files/87/sharer/RApiWTlZVO/code?key=eyJpdiI6InozajA1SllYaWxJRjIvL1','2024-02-26 15:28:46','2024-02-26 15:22:46','2024-02-26 15:22:46'),(27,90,'n7gL20wE39','http://localhost:8000/files/90/sharer/n7gL20wE39/code?key=eyJpdiI6IkZyTzhaWVpxNnJrMzNqNH','2024-02-26 21:56:00','2024-02-26 20:57:03','2024-02-26 20:57:03'),(31,90,'0YTbmyhFZW','http://localhost:8000/files/90/sharer/0YTbmyhFZW/code?key=eyJpdiI6Imd5cXg1aU5aYVZQZGRhSD','2024-02-21 22:11:00','2024-02-26 21:11:17','2024-02-26 21:11:17'),(37,93,'kwiYKgAQ6n','http://localhost:8000/files/93/sharer/kwiYKgAQ6n/code?key=eyJpdiI6ImdMWnk3Wm5Wb1NybTBUTV','2024-02-27 23:37:00','2024-02-26 22:38:04','2024-02-26 22:38:04'),(39,97,'CEJfRoT4kg','http://localhost:8000/files/97/sharer/CEJfRoT4kg/code?key=eyJpdiI6IkhGRUpndnpJSTZOUmRad3','2024-02-26 00:37:00','2024-02-26 23:37:54','2024-02-26 23:38:55'),(40,94,'M8vB8ZIdzu','http://localhost:8000/files/94/sharer/M8vB8ZIdzu/code?key=eyJpdiI6IjZ2dSswWUdXamNPQUFtSz','2024-02-27 01:06:00','2024-02-27 00:04:19','2024-02-27 00:04:44'),(41,90,'BujZ7pXIJk','http://localhost:8000/files/90/sharer/BujZ7pXIJk/code?key=eyJpdiI6IktEVDU4VGdNRDFEWjZWUW','2024-02-27 01:10:00','2024-02-27 00:11:03','2024-02-27 00:11:03'),(42,93,'0PMMKHKpyF','http://localhost:8000/files/93/sharer/0PMMKHKpyF/code?key=eyJpdiI6IlJZc1kwL1V3N1UxUVNoUk','2024-02-26 01:16:00','2024-02-27 00:16:56','2024-02-27 00:22:01'),(43,93,'3eVoUGOtzW','http://localhost:8000/files/93/sharer/3eVoUGOtzW/code?key=eyJpdiI6InVaTWVyeDgvMWh6VzRwc2','2024-02-27 01:30:00','2024-02-27 00:26:20','2024-02-27 00:26:20'),(44,97,'ufydJsQcJ0','http://localhost:8000/files/97/sharer/ufydJsQcJ0/code?key=eyJpdiI6ImZlVzZaOEVVVm03am9XaD','2024-02-28 01:28:00','2024-02-27 00:28:59','2024-02-27 00:28:59'),(45,85,'utVknMvJhg','http://localhost:8000/files/85/sharer/utVknMvJhg/code?key=eyJpdiI6IkpUSzE1UVRtaXVtVmI1Un','2024-02-28 01:39:00','2024-02-27 00:39:27','2024-02-27 00:39:27'),(46,82,'p4KCvN2gzV','http://localhost:8000/files/82/sharer/p4KCvN2gzV/code?key=eyJpdiI6IjQvLzdQeDNyRlZwV1RWV0','2024-02-27 01:40:00','2024-02-27 00:40:31','2024-02-27 00:40:31'),(47,102,'Fw1WgMVfn7','http://localhost:8000/files/102/sharer/Fw1WgMVfn7/code?key=eyJpdiI6ImZuMnQwWk5oWEZNTmR0dU','2024-02-27 10:53:00','2024-02-27 07:53:36','2024-02-27 07:53:36'),(49,94,'iPA5V8Zmv9','http://localhost:8000/files/94/sharer/iPA5V8Zmv9/code?key=eyJpdiI6ImJ0eGd3am5MZTdmbmdJND','2024-03-22 18:53:00','2024-03-01 17:53:42','2024-03-01 17:53:42'),(53,91,'ZCA8WNuirz','http://localhost:8000/files/91/sharer/ZCA8WNuirz/code?key=eyJpdiI6IjlzUVJLTEhEdGJiVHA5MU','2024-03-02 06:35:00','2024-03-02 05:35:14','2024-03-02 05:35:14'),(54,93,'piCpaCOWm9','http://localhost:8000/files/93/sharer/piCpaCOWm9/code?key=eyJpdiI6IjJWUTMwYkRLclQ3TjV2QU','2024-03-02 06:37:00','2024-03-02 05:37:52','2024-03-02 05:37:52'),(66,94,'yihrKAvztx','http://localhost:8000/files/94/sharer/yihrKAvztx/code?key=eyJpdiI6IkN4cW1jTm9XUzdlZm1CT0','2024-03-03 21:32:00','2024-03-03 20:33:00','2024-03-03 20:33:00'),(67,94,'56bE4FTT1Y','http://localhost:8000/files/94/sharer/56bE4FTT1Y/code?key=eyJpdiI6Ikx2bkVmM05NM0VvWGJ0Um','2024-03-03 21:36:00','2024-03-03 20:36:41','2024-03-03 20:36:41'),(68,91,'Ju0Xf6cOUj','http://localhost:8000/files/91/sharer/Ju0Xf6cOUj/code?key=eyJpdiI6IkdFNmlkczMyaWMyR3Vqcn','2024-03-03 21:37:00','2024-03-03 20:37:14','2024-03-03 20:37:14'),(69,93,'1OmU0Yxy1v','http://localhost:8000/files/93/sharer/1OmU0Yxy1v/code?key=eyJpdiI6IlVvYThqZTVmRFBiTnY5cj','2024-03-03 21:43:00','2024-03-03 20:43:09','2024-03-03 20:43:09'),(70,93,'ikMhKHjqYi','http://localhost:8000/files/93/sharer/ikMhKHjqYi/code?key=eyJpdiI6InpHZERsMm1aS3VFczBqSX','2024-03-03 21:48:00','2024-03-03 20:48:57','2024-03-03 20:48:57'),(71,93,'0DjZ2Y1z3t','http://localhost:8000/files/93/sharer/0DjZ2Y1z3t/code?key=eyJpdiI6IkJrNGU1T3ArdTllU0Rhbk','2024-02-26 21:50:00','2024-03-03 20:50:09','2024-03-03 20:50:09'),(72,93,'JSdr5Y2o0P','http://localhost:8000/files/93/sharer/JSdr5Y2o0P/code?key=eyJpdiI6IlpnWEpkU1ZSU3ZOYXlMS1','2024-03-05 21:51:00','2024-03-03 20:51:05','2024-03-03 20:51:05'),(73,93,'C66SOnnX3d','http://localhost:8000/files/93/sharer/C66SOnnX3d/code?key=eyJpdiI6IlJTckdSZGVVK1pxL0xTRD','2024-03-03 21:52:00','2024-03-03 20:52:05','2024-03-03 20:52:05'),(74,93,'eEipHO5GWb','http://localhost:8000/files/93/sharer/eEipHO5GWb/code?key=eyJpdiI6InczcTJUZ08yaEtYVDlhNE','2024-03-03 21:53:00','2024-03-03 20:54:01','2024-03-03 20:54:01'),(75,93,'1uKgcJAKmm','http://localhost:8000/files/93/sharer/1uKgcJAKmm/code?key=eyJpdiI6Ild3Qm05b3RRQ0c1eDVkT1','2024-03-03 21:56:00','2024-03-03 20:56:53','2024-03-03 20:56:53'),(76,94,'nLhudmZaZo','http://localhost:8000/files/94/sharer/nLhudmZaZo/code?key=eyJpdiI6ImxTK0lSUFZBQmlZUEM3VH','2024-03-03 21:59:00','2024-03-03 20:59:22','2024-03-03 20:59:22'),(77,93,'djGlFBquXX','http://localhost:8000/files/93/sharer/djGlFBquXX/code?key=eyJpdiI6IkNPVW5KV1VjZG5zWG94bz','2024-03-03 22:01:00','2024-03-03 21:01:03','2024-03-03 21:01:03'),(83,100,'os7E4ROqbo','http://localhost:8000/files/100/sharer/os7E4ROqbo/code?key=eyJpdiI6IjNWNjcrQjlEdGMwUUdvYk','2024-03-04 22:05:00','2024-03-03 21:05:40','2024-03-03 21:05:40'),(84,100,'RegTpgcJSQ','http://localhost:8000/files/100/sharer/RegTpgcJSQ/code?key=eyJpdiI6IlRpaEhJRTFsR3BDY2tXSj','2024-03-03 22:06:00','2024-03-03 21:07:02','2024-03-03 21:07:02'),(85,100,'BIk4vdM1fK','http://localhost:8000/files/100/sharer/BIk4vdM1fK/code?key=eyJpdiI6IjU5cm5SaDBMN1JHaEtwSW','2024-03-03 22:08:00','2024-03-03 21:08:26','2024-03-03 21:08:26'),(86,100,'PrQNoW28Ic','http://localhost:8000/files/100/sharer/PrQNoW28Ic/code?key=eyJpdiI6IjIrM1l5YzU5MzFGdnByZG','2024-02-27 22:09:00','2024-03-03 21:09:30','2024-03-03 21:09:30'),(93,91,'dExR5fVXtR','http://localhost:8000/files/91/sharer/dExR5fVXtR/code?key=eyJpdiI6ImFhQlVWa1NBdFFONWhMbF','2024-03-03 22:21:00','2024-03-03 21:21:56','2024-03-03 21:21:56'),(94,91,'VhbkOZ9mlq','http://localhost:8000/files/91/sharer/VhbkOZ9mlq/code?key=eyJpdiI6Im5zSitwZDZGc2pLZ21qRW','2024-02-26 23:24:00','2024-03-03 22:24:15','2024-03-03 22:26:44'),(95,91,'CroXALrtt7','http://localhost:8000/files/91/sharer/CroXALrtt7/code?key=eyJpdiI6ImZkREwrcU9DaldJMHc0Q1','2024-03-04 02:44:00','2024-03-03 22:44:11','2024-03-03 22:44:11'),(96,100,'8akHUb8W8s','http://localhost:8000/files/100/sharer/8akHUb8W8s/code?key=eyJpdiI6Imk1R3BJRHdVQjljVTZOZG','2024-03-04 21:33:00','2024-03-04 17:33:14','2024-03-04 17:33:14'),(97,94,'ghLvd4SOjW','http://localhost:8000/files/94/sharer/ghLvd4SOjW/code?key=eyJpdiI6ImNKUTRBZm5VZS9maU5lVX','2024-03-04 21:34:00','2024-03-04 17:34:02','2024-03-04 17:34:02'),(98,100,'ZGehbkURgt','http://localhost:8000/files/100/sharer/ZGehbkURgt/code?key=eyJpdiI6IkJGSFF0MzlrRUFWMnZqUX','2024-03-04 21:34:00','2024-03-04 17:34:44','2024-03-04 17:34:44'),(99,91,'eRlnWQA8N3','http://localhost:8000/files/91/sharer/eRlnWQA8N3/code?key=eyJpdiI6Im93Z2x1c2luVXFDVy9FND','2024-03-04 21:39:00','2024-03-04 17:39:33','2024-03-04 17:39:33'),(100,93,'nJ75J2lt4W','http://localhost:8000/files/93/sharer/nJ75J2lt4W/code?key=eyJpdiI6ImlXdVA5eXYvOUFoSzIxZX','2024-03-04 21:57:00','2024-03-04 17:57:46','2024-03-04 17:57:46'),(101,94,'hRTuBwo4nZ','http://localhost:8000/files/94/sharer/hRTuBwo4nZ/code?key=eyJpdiI6Ilh4ZTJBNk1Zblc2eGFtT3','2024-03-04 22:11:00','2024-03-04 18:11:03','2024-03-04 18:11:03'),(102,103,'pStY2oIDMg','http://localhost:8000/files/103/sharer/pStY2oIDMg/code?key=eyJpdiI6IlZuemI2RVdKMVdyOXBSQT','2024-02-25 23:12:00','2024-03-04 19:12:31','2024-03-04 19:20:24'),(103,103,'XulGVOaktf','http://localhost:8000/files/103/sharer/XulGVOaktf/code?key=eyJpdiI6IjdzZUhNczBxMnRnWk5DWm','2024-03-04 23:18:00','2024-03-04 19:19:00','2024-03-04 19:19:00'),(104,103,'iu5q81WANh','http://localhost:8000/files/103/sharer/iu5q81WANh/code?key=eyJpdiI6Im5weHlxWHVjU1lCL21ZWj','2024-03-04 23:21:00','2024-03-04 19:21:51','2024-03-04 19:21:51'),(105,107,'4tuGFHJzo1','http://localhost:8000/files/107/sharer/4tuGFHJzo1/code?key=eyJpdiI6ImI0M0VQeHY1RlBNblpVWk','2024-03-04 23:27:00','2024-03-04 19:27:35','2024-03-04 19:27:35'),(106,103,'nqoqOoRsQ9','http://localhost:8000/files/103/sharer/nqoqOoRsQ9/code?key=eyJpdiI6InB5WldGMkRaeHV1blZFRz','2024-03-05 01:13:00','2024-03-04 21:13:53','2024-03-04 21:13:53'),(107,94,'14x0zfpKJV','http://localhost:8000/files/94/sharer/14x0zfpKJV/code?key=eyJpdiI6IjVhRmhpeDFXVEpOOEdzRU','2024-03-05 16:10:00','2024-03-05 12:10:58','2024-03-05 12:10:58'),(108,90,'tYejeTZ2OM','http://localhost:8000/files/90/sharer/tYejeTZ2OM/code?key=eyJpdiI6InZuKzhLaDlGNGF3bUZ2bH','2024-03-05 16:17:00','2024-03-05 12:18:03','2024-03-05 12:18:03');
/*!40000 ALTER TABLE `file_shared_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `file_type` enum('IMAGE','VIDEO') COLLATE utf8mb4_unicode_ci NOT NULL,
                         `user_id` bigint unsigned NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `size` int NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `files_user_id_foreign` (`user_id`),
                         CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (82,'errandia_logo.jpg','IMAGE',23,'2024-02-22 13:13:31','2024-02-22 13:13:31',34763),(84,'Laravelselect2.mp4','VIDEO',23,'2024-02-22 13:16:47','2024-02-22 13:16:47',16205369),(85,'WhatsAppVideo.mp4','VIDEO',23,'2024-02-22 13:17:03','2024-02-22 13:17:03',3156853),(86,'PIC.jpg','IMAGE',26,'2024-02-22 14:32:26','2024-02-22 14:32:26',18108),(87,'mov_bbb.mp4','VIDEO',26,'2024-02-22 14:33:00','2024-02-22 14:33:00',788493),(88,'photo.jpg','IMAGE',26,'2024-02-22 16:19:27','2024-02-22 16:19:27',53680),(90,'Screenshot2023-01-05112442.png','IMAGE',4,'2024-02-22 19:46:20','2024-02-22 19:46:20',208226),(91,'Spring Boot WebFlux - Video Streaming Example _ JavaTechie.mp4','VIDEO',4,'2024-02-22 20:32:13','2024-02-22 20:32:13',25847933),(93,'wallpaper.jpg','IMAGE',4,'2024-02-22 21:56:20','2024-02-22 21:56:20',14093),(94,'errandia_logo.jpg','IMAGE',4,'2024-02-23 10:32:16','2024-02-23 10:32:16',34763),(95,'add_course_gp.png','IMAGE',28,'2024-02-23 10:50:26','2024-02-23 10:50:26',60450),(101,'offer-bg.png','IMAGE',50,'2024-02-27 07:52:37','2024-02-27 07:52:37',391206),(102,'mov_bbb.mp4','VIDEO',50,'2024-02-27 07:52:56','2024-02-27 07:52:56',788493),(103,'mov_bbb.mp4','VIDEO',4,'2024-03-04 14:24:15','2024-03-04 14:24:15',788493),(104,'MicrosoftTeams-image(5).png','IMAGE',4,'2024-03-04 15:14:33','2024-03-04 15:14:33',11602),(105,'logo.png','IMAGE',4,'2024-03-04 15:16:41','2024-03-04 15:16:41',9643),(106,'photo.jpg','IMAGE',4,'2024-03-04 15:17:21','2024-03-04 15:17:21',53680),(107,'0.jpg','IMAGE',4,'2024-03-04 19:27:14','2024-03-04 19:27:14',62770);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2024_02_06_164255_user_migration',1),(5,'2024_02_06_164453_create_files_table',1),(6,'2024_02_08_031853_update_user',1),(7,'2024_02_08_173341_update_file',2),(8,'2024_02_26_144445_create_file_shared_links_table',3),(9,'2024_02_26_152157_file_shared_links',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
                                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint unsigned NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `expires_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                          KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
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
                         `status` enum('ACTIVE','IN_ACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL,
                         `role` enum('USER','ADMIN') COLLATE utf8mb4_unicode_ci NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Leonardo Batz','etha22@gmail.com',NULL,'$2y$10$EFe6DOCE4cqjP3BSRkXCb.wJxY24M2oa6FH/ZMyCYvB1wj/tpHtUa',NULL,'2024-02-08 03:44:03','2024-02-08 03:44:03','ACTIVE','ADMIN'),(23,'Lesley Roberts','lesleyroberts@gmail.com',NULL,'$2y$10$u1sg2PVR3PbD/kjmtQRXs.IyD.kyvKexvXYciJmw5R8veVS8Ik7YW',NULL,'2024-02-22 13:12:59','2024-03-05 12:23:31','ACTIVE','USER'),(26,'Breanna Cameron','gaqu@mailinator.com',NULL,'$2y$10$XSnwaHLzFNRh2iyQsGhoDOmwdv59WpnZoO1NY/IrsdgpBUJh/VV32',NULL,'2024-02-22 14:31:38','2024-02-22 14:31:38','ACTIVE','USER'),(27,'Blaze Mays','nyjuxuj@mailinator.com',NULL,'$2y$10$g463k1i2AENpBp2G2085p.MjSxN9JSuZbFCQ2BSNDyeg8x7X9fpgq',NULL,'2024-02-22 16:26:43','2024-02-22 20:29:38','ACTIVE','USER'),(28,'Galena Sosa','sadak@mailinator.com',NULL,'$2y$10$mR3eI31uFpmiVEzm15gaX.Cr9kP0gGXDA9r.JzAA3GLCDksAiBDfC',NULL,'2024-02-23 10:49:55','2024-02-23 10:49:55','ACTIVE','USER'),(30,'Jeffrey Beer','ward.levi@hotmail.com',NULL,'$2y$10$BXQZdnSlghdPRalqo9o5VupEr9wBXStjwzEge8znfJVrTnvNW19xK',NULL,'2024-02-26 15:10:34','2024-02-26 15:10:34','ACTIVE','USER'),(31,'Prof. Loraine Wilkinson','blick.nettie@mitchell.com',NULL,'$2y$10$WMChA6VjTTIlaY1MujNxVO6pRD7EOUBVjY.7TVtC701WwxJsuUjAy',NULL,'2024-02-26 15:10:34','2024-02-26 15:10:34','IN_ACTIVE','USER'),(32,'Piper Bode','huel.gladys@bergstrom.com',NULL,'$2y$10$HSNfT0laL3mpC3PCH50AZuhnbCIyD3q9HzzHB351vOf1sokeJ3A4.',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(34,'Davin Bosco','ellie.turcotte@yahoo.com',NULL,'$2y$10$LARFjFmoeCF1iKZeO6DP1u..ZI23BsR/qPs2jjUBEyXvhYo8/epFa',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','IN_ACTIVE','USER'),(35,'Kitty Kovacek','aron.sipes@ruecker.com',NULL,'$2y$10$RrNEBHOAjuoVvJcrqFhIRONQKpm4Ia7FReqYcIN7UnAqvyEyPkW/W',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(36,'Mckayla Osinski','daphney56@rohan.net',NULL,'$2y$10$luyZe5DBtV.5M/Cgtrt13OD9s73kUE2fpvRXtWi.sh49zYssASsda',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','IN_ACTIVE','USER'),(37,'Dr. Eliane Wiza Sr.','arnaldo.thiel@kris.info',NULL,'$2y$10$7gEAzhzcBIZlMO3tivWBU.XI0HbllRX3F6bQ7oyZ6pVRUDLaNvIxS',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','IN_ACTIVE','USER'),(38,'Harvey Kub','hank54@gmail.com',NULL,'$2y$10$6pmv.Cd.SyJ3gSeR.uVb9OCxSOoaRyyzMODQ6SCAyhrR93pZoj4BS',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(39,'Kathryn Padberg III','welch.may@kihn.com',NULL,'$2y$10$K7adTOwB82S.eKbAdM6wqe45zZx5Smyb.UhCo/M3.5T2GRQIREwo2',NULL,'2024-02-26 15:10:35','2024-02-28 08:27:14','ACTIVE','USER'),(40,'Valerie Dicki','qkoch@yahoo.com',NULL,'$2y$10$soIFD/Z3JStzPrq.pQDfG.CyvkKonHcM9P5n2Hi4IWXcK949HI00G',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(41,'Emmitt Rau','leland63@yahoo.com',NULL,'$2y$10$gYOLPhxvuOMwhaXU00rr0O0KUsI6En1NL.u5/lZwEPHp7uckEcAZ.',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(42,'Solon Christiansen','ezra.zieme@nicolas.com',NULL,'$2y$10$hcmw7HtREIdoS6oZb.awnuPemQXi0P65dNv.sX4qD.Ii/6tI7VpDC',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(43,'Chet Little','waters.kenya@yahoo.com',NULL,'$2y$10$7dXym8DXVS4.uU9Q1079tO6mKcNeHQT.nL9FmyVafBGuW9CmcXZBK',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','IN_ACTIVE','USER'),(44,'Richard Keebler','mkilback@hotmail.com',NULL,'$2y$10$hH9o4T.iBzX8YVW8Dpa9WeVGdtnpaej5yukrpCnHNrp9DpgqeVzYO',NULL,'2024-02-26 15:10:35','2024-02-26 23:42:06','ACTIVE','USER'),(45,'Ruthie Parker','pfeil@yahoo.com',NULL,'$2y$10$DFnHJG.cnCN/fGqkdOZgS.JDfu1jvaG3pUg77WxFus6sz/2RnydJK',NULL,'2024-02-26 15:10:35','2024-03-04 17:51:03','IN_ACTIVE','USER'),(46,'Carlo Will','larson.yadira@medhurst.com',NULL,'$2y$10$8KUUNbGhlqWzqazJJ5SoIe/Uc4vuSvP0/GN4hjy3PZldM6qpuUjly',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','IN_ACTIVE','USER'),(47,'Jorge Paucek','cathy61@veum.biz',NULL,'$2y$10$j/w/9IxQucZaFn0b02AfwO.yaOwDGcThO/YmGA.BExkldIUmDoZNW',NULL,'2024-02-26 15:10:35','2024-02-26 15:10:35','ACTIVE','USER'),(48,'Neoma Blick','ukrajcik@gulgowski.com',NULL,'$2y$10$xIkDlHtA6fRksWoDBTP4pOtTqkyojF8hfbl2.kHSFbhrey9H.CHAu',NULL,'2024-02-26 15:10:36','2024-02-26 15:10:36','ACTIVE','USER'),(49,'Cynthia Kemmer DDS','melisa.dicki@corkery.org',NULL,'$2y$10$lgwtWB0tioBZLHmzdhd2BONvKCdboD8qeUX0Oz1gXRgP1ecXNb.am',NULL,'2024-02-26 15:10:36','2024-02-26 15:10:36','IN_ACTIVE','USER'),(50,'Hop Avila','waxapog@mailinator.com',NULL,'$2y$10$p4V71y8q75/Jh2eg2yalk.2YUY7T2Q6tmYFxyijqpZGLTd6B5N6.q',NULL,'2024-02-27 07:52:11','2024-02-27 07:52:11','ACTIVE','USER');
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

-- Dump completed on 2024-03-05 14:39:45
