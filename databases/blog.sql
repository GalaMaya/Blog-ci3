-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for blog
DROP DATABASE IF EXISTS `blog`;
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `blog`;

-- Dumping structure for table blog.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `content` text,
  `banner` varchar(50) DEFAULT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blog.articles: ~6 rows (approximately)
REPLACE INTO `articles` (`id`, `title`, `slug`, `content`, `banner`, `attachment`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(12, 'Tes Artikel', 'tes_artikel', 'tes kontent', '98b5267a7e8ffc6e6a15c72b0eb11ed1.png', '5fb6574576165673ac153e5700648eab.pdf', 1, 8, '2025-04-10 08:45:24', '2025-04-10 08:45:24');

-- Dumping structure for table blog.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `role_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blog.users: ~4 rows (approximately)
REPLACE INTO `users` (`id`, `email`, `password`, `name`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
	(6, 'user@example.com', '$2y$10$a9MzKGdcrleSfTLKhUc0TeiqoubHZRdiNOL6mVkLuYVatvWhv1lMC', 'User', 3, 0, '2025-04-09 09:25:52', '2025-04-09 09:25:52'),
	(8, 'admin@example.com', '$2y$10$Pz76CJ4eYeJBSNBUqQHJZuD2FvVdnpnsUxPz2hXJoAz7le3wnxlsa', 'Admin', 1, 1, '2025-04-09 09:26:31', '2025-04-09 09:26:31'),
	(11, 'editor@gmail.com', '$2y$10$a1jBF6TtTIY6tuMsPEA6gOgoPq/CJAPOWUzYzPGp/ZFExqrXYpGyS', 'editor', 2, 1, '2025-04-10 07:57:21', '2025-04-10 07:57:21'),
	(12, 'user@gmail.com', '$2y$10$fp0jsbcqDqmWwZ8Wl5JkDuraOPNbQLRNpfeFeLK5sXg2LixhZxvzW', 'user', 3, 1, '2025-04-10 07:57:45', '2025-04-10 07:57:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
