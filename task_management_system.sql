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


-- Dumping database structure for task_management_system
CREATE DATABASE IF NOT EXISTS `task_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `task_management_system`;

-- Dumping structure for table task_management_system.assigns
CREATE TABLE IF NOT EXISTS `assigns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `task_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assign_user_id_foreign` (`user_id`),
  KEY `assign_task_id_foreign` (`task_id`),
  CONSTRAINT `assign_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assign_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.assigns: ~0 rows (approximately)
REPLACE INTO `assigns` (`id`, `user_id`, `task_id`, `created_at`, `updated_at`) VALUES
	(22, 23, 33, '2025-01-22 08:37:06', '2025-01-22 08:37:06'),
	(23, 25, 34, '2025-01-22 08:37:21', '2025-01-22 08:37:21'),
	(24, 24, 37, '2025-01-22 08:37:31', '2025-01-22 08:37:31'),
	(25, 23, 36, '2025-01-22 08:37:39', '2025-01-22 08:37:39'),
	(26, 23, 38, '2025-01-22 08:38:10', '2025-01-22 08:38:10'),
	(27, 25, 35, '2025-01-22 08:39:36', '2025-01-22 08:39:36'),
	(28, 23, 39, '2025-01-22 08:39:58', '2025-01-22 08:39:58'),
	(29, 23, 41, '2025-01-22 08:53:23', '2025-01-22 08:53:23'),
	(30, 23, 42, '2025-01-22 08:53:56', '2025-01-22 08:53:56');

-- Dumping structure for table task_management_system.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.cache: ~0 rows (approximately)

-- Dumping structure for table task_management_system.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.cache_locks: ~0 rows (approximately)

-- Dumping structure for table task_management_system.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table task_management_system.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table task_management_system.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
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

-- Dumping data for table task_management_system.jobs: ~0 rows (approximately)

-- Dumping structure for table task_management_system.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table task_management_system.job_batches: ~0 rows (approximately)

-- Dumping structure for table task_management_system.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.migrations: ~3 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(4, '0001_01_01_000000_create_users_table', 1),
	(5, '0001_01_01_000001_create_cache_table', 1),
	(6, '0001_01_01_000002_create_jobs_table', 1),
	(7, '2025_01_18_091939_create_tasks_table', 2),
	(8, '2025_01_18_191813_add_role_and_user_status_to_users_table', 3),
	(9, '2025_01_19_073747_create_assign_table', 4),
	(10, '2025_01_19_184202_add_column_to_task_description_table', 5);

-- Dumping structure for table task_management_system.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table task_management_system.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Dumping data for table task_management_system.sessions: ~1 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('C1g7rL1qxLNAAsddFRiOO0WXIVIgHeDhzbMOUQ3N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjNoWDdrMk4zRXNicjBOeHAwa1M0T3ZJNkVUUGZjaHd4dFFCejVUWjIiO30=', 1737568443);

-- Dumping structure for table task_management_system.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_priority_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Todo',
  `task_started_at` timestamp NULL DEFAULT NULL,
  `task_ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `task_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.tasks: ~10 rows (approximately)
REPLACE INTO `tasks` (`id`, `task_name`, `task_priority_level`, `task_status`, `task_started_at`, `task_ended_at`, `created_at`, `updated_at`, `task_description`) VALUES
	(33, 'Build Landing Page', 'High Priority', 'Approved', '2025-01-22 08:37:53', '2025-07-22 08:53:33', '2025-01-22 08:30:01', '2025-01-22 09:18:35', 'Create a responsive and visually appealing landing page for a product or service.'),
	(34, 'Fix Broken Links', 'High Priority', 'Approved', NULL, '2025-09-22 17:21:57', '2025-01-22 08:30:14', '2025-01-22 08:30:14', 'Identify and resolve all broken or dead links on the website to improve user experience.'),
	(35, 'Implement Contact Form', 'Medium Priority', 'Approved', '2025-01-22 08:39:43', '2025-02-22 10:40:38', '2025-01-22 08:30:31', '2025-01-22 08:50:35', 'Develop and integrate a functional contact form with validation and email notifications.'),
	(36, 'Optimize Page Load Speed', 'High Priority', 'Approved', '2025-01-22 08:38:40', '2025-03-22 12:40:16', '2025-01-22 08:30:53', '2025-01-22 08:50:39', 'Enhance website performance by optimizing images, code, and server response time.'),
	(37, 'Integrate Social Media Buttons', 'Medium Priority', 'Approved', '2025-01-22 08:52:45', '2025-01-22 09:18:52', '2025-01-22 08:31:06', '2025-01-22 09:19:10', 'Add social media sharing buttons to improve content accessibility and engagement'),
	(38, 'Update Website Content', 'Low Priority', 'Approved', '2025-01-22 08:38:16', '2025-05-22 09:18:47', '2025-01-22 08:31:36', '2025-01-22 09:19:12', 'Refresh and update the website\'s text, images, and multimedia to keep content current.'),
	(39, 'Add Analytics Tracking', 'Medium Priority', 'Approved', '2025-01-22 08:40:06', '2025-02-22 09:18:56', '2025-01-22 08:32:06', '2025-01-22 09:19:13', 'Set up Google Analytics or another tracking tool to monitor website traffic and user behavior.'),
	(40, 'Create Blog Section', 'Medium Priority', 'Approved', NULL, '2025-05-22 17:22:03', '2025-01-22 08:32:22', '2025-01-22 08:32:22', 'Develop a blog feature allowing easy content management and categorization.'),
	(41, 'Implement Custom 404 Page', 'Low Priority', 'Approved', NULL, '2025-12-22 17:21:40', '2025-01-22 08:32:37', '2025-01-22 08:32:37', 'Design a creative and helpful custom 404 error page to guide users back to the website'),
	(42, 'Refactor Old Code', 'Low Priority', 'Approved', NULL, '2025-12-22 09:19:00', '2025-01-22 08:32:53', '2025-01-22 09:19:15', 'Review and refactor legacy code to improve readability, performance, and maintainability.');

-- Dumping structure for table task_management_system.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user','moderator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `user_status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_management_system.users: ~3 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `user_status`) VALUES
	(16, NULL, 'user@gmail.com', NULL, '$2y$12$jzb.zqXvXc3mpdCFZXD.Z.UWhnQwjD99O8ue9tMALZZxs/9/cpTJG', NULL, '2025-01-18 11:57:15', '2025-01-21 06:59:00', 'user', 'Active'),
	(18, NULL, 'admin@gmail.com', NULL, '$2y$12$Tce2Os5idJ3RznCqxhCaKO.7I6JUGCJV0F9oqz.Mv5odagR.6O/KG', NULL, '2025-01-19 22:24:30', '2025-01-22 08:36:08', 'admin', 'Active'),
	(23, NULL, 'sarah.smith789@gmail.com', NULL, '$2y$12$Xz9/.hqg3U.JilbrL7Kb5e6BE8qlEg5urmUT/mAkQac.Ffcsb7oPm', NULL, '2025-01-22 08:33:38', '2025-01-22 08:36:11', 'user', 'Active'),
	(24, NULL, 'michael.jones456@gmail.com', NULL, '$2y$12$lTSt2qzaNEQEjU9oG/0OR.dgBdQWLef86j2oLLqpqrqAony.8GMsG', NULL, '2025-01-22 08:33:59', '2025-01-22 08:36:13', 'user', 'Active'),
	(25, NULL, 'john.doe123@gmail.com', NULL, '$2y$12$H61ICjBKdW6nNkpV0H2xpOMw1fntT0If5.7s2QnrtzREcjC8mEvSm', NULL, '2025-01-22 08:34:19', '2025-01-22 08:36:41', 'user', 'Active'),
	(26, NULL, 'emily.brown321@gmail.com', NULL, '$2y$12$GVfjNh8GTj1yLWvkEWkWh.yyv63gAFoGH1EsXJOREDnpTzKGqaHD2', NULL, '2025-01-22 08:34:34', '2025-01-22 08:36:43', 'user', 'Active'),
	(27, NULL, 'david.wilson654@gmail.com', NULL, '$2y$12$sX56iyrwHpjjHYJgLBtqTON0N1Bt9nJpwSCIUn6ABfdaE1f5n7y5u', NULL, '2025-01-22 08:34:44', '2025-01-22 08:34:44', 'user', 'Inactive'),
	(28, NULL, 'lisa.white987@gmail.com', NULL, '$2y$12$W98.L/yPbcH4SY1.hchICugqfQJINqVXP/R3lpYC0z2J9Dh0AiUyq', NULL, '2025-01-22 08:35:01', '2025-01-22 08:35:01', 'user', 'Inactive'),
	(29, NULL, 'alex.miller654@gmail.com', NULL, '$2y$12$OQkrHj8qcJTKKX1DXa7x5eEiAWjCmfOVr.n6O75y.wemIaVp9l0zm', NULL, '2025-01-22 08:35:11', '2025-01-22 08:35:11', 'user', 'Inactive'),
	(30, NULL, 'charlotte.lee123@gmail.co', NULL, '$2y$12$oZLtlQiulfK9SE4HN3JcmemaAF5UleMS3nCFVVOVi9vlHQXeIW1tK', NULL, '2025-01-22 08:35:21', '2025-01-22 08:35:21', 'user', 'Inactive'),
	(31, NULL, 'robert.taylor890@gmail.com', NULL, '$2y$12$EEAcb9EGhHHjQg5Ic6QCKOWBvvxjFN0lNq90i61uqjkhq0JC7mSC6', NULL, '2025-01-22 08:35:35', '2025-01-22 08:35:35', 'user', 'Inactive'),
	(32, NULL, 'jennifer.martin432@gmail.com', NULL, '$2y$12$MQ8rSlhm304gZXe4sQBIr..aH7qK.DD.CNSLn3C0Fed7Gx7aWI2lC', NULL, '2025-01-22 08:35:49', '2025-01-22 08:35:49', 'user', 'Inactive');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
