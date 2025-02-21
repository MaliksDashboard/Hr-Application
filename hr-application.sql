-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2025 at 01:46 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr-application`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(191) NOT NULL,
  `location` varchar(191) NOT NULL,
  `manager_email` varchar(191) NOT NULL,
  `services_gmail` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_branch_name_unique` (`branch_name`),
  UNIQUE KEY `branches_manager_email_unique` (`manager_email`),
  UNIQUE KEY `branches_services_gmail_unique` (`services_gmail`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `location`, `manager_email`, `services_gmail`, `created_at`, `updated_at`, `latitude`, `longitude`) VALUES
(63, 'Mtaileb', 'Mtaileb, Main Road', 'mtaileb@maliks.com', 'mtaileb.orders@gmail.com', '2025-01-01 07:26:00', '2025-01-01 07:41:07', 33.92490981769786, 35.61696044099086),
(11, 'Abraj', 'Abraj Center, Furn-al-chebak', 'abraj@maliks.com', 'abrajmaliks@gmail.com', '2024-11-15 07:26:42', '2024-11-15 16:57:46', 33.86762946618272, 35.527028540989065),
(9, 'Doculand Hamra', 'Hamra - Bliss - Bank Audi Building', 'hamra@doculand.com.lb', 'doculandbliss@gmail.com', '2024-11-15 07:24:13', '2024-11-15 16:58:12', 33.89939940687008, 35.48069302564809),
(12, 'Operation Department', 'Bliss - Maliks Office 2F', 'operations@maliks.com', 'operations5@maliks.com', '2024-11-15 07:27:41', '2024-11-15 16:58:38', 33.899049331887355, 35.48144595845717),
(13, 'Ajaltoun', 'Ajaltoun - Main road', 'ajaltoun@maliks.com', 'maliksaajaltoun@gmail.com', '2024-11-15 07:28:13', '2024-11-15 16:59:13', 33.96055667030018, 35.68581002204761),
(14, 'Interior Department', 'Bliss - Maliks Office 2F', 'dania@maliks.com', 'dania@maliks.com', '2024-11-15 07:29:02', '2024-11-15 16:58:50', 33.899049331887355, 35.48144595845717),
(15, 'Spinneys Dbayeh', 'Dbayeh - Inside Spinneys', 'dbayeh@maliks.com', 'dbayehorders@gmail.com', '2024-11-15 07:29:23', '2024-11-15 07:29:23', 33.931415, 35.58836),
(16, 'Office Supplies', 'Verdun, near our branch, facing Soubra pharmacy', 'officesupplies@maliks.com', 'officesupplies@maliks.com', '2024-11-15 07:30:48', '2024-11-15 16:59:47', 33.864267819877185, 35.48682109681136),
(17, 'Verdun', 'Verdun, near Goodies, facing Sour pharmacy', 'verdun@maliks.com', 'verdunorders@gmail.com', '2024-11-15 07:31:30', '2024-11-15 17:00:06', 33.886554176857715, 35.48205989681202),
(18, 'Hamra Main Road', 'Hamra Main Road', 'hamra@maliks.com', 'hamramainroad@gmail.com', '2024-11-15 07:32:11', '2024-11-15 17:00:30', 33.8957568780546, 35.483540640990014),
(19, 'Zouk Mosbeh', 'Jeita High way , Town Center', 'jeita@maliks.com', 'zoukmosbeh@maliks.com', '2024-11-15 07:32:45', '2024-11-15 17:01:12', 33.95113356704448, 35.621564239143034),
(20, 'City Mall', 'City Mall - Doura', 'citymall@maliks.com', 'citymallorder@gmail.com', '2024-11-15 07:33:06', '2024-11-15 17:01:31', 33.89697204326296, 35.56458573914123),
(21, 'Choueifat', 'Khaldeh, mafra2 Aramoun', 'choueifat@maliks.com', 'maliks.choueifat@gmail.com', '2024-11-15 07:34:05', '2024-11-15 17:02:10', 33.79879933895064, 35.48675113913831),
(22, 'Ashrafieh', 'Facing  AUST( UPS )', 'achrafieh@maliks.com', 'maliks.achrafieh@gmail.com', '2024-11-15 07:35:01', '2024-11-15 17:02:31', 33.8840696540407, 35.52308281030539),
(23, 'Doculand Mathaf', 'Mathaf Street - Facing Grab and Go', 'mathaf@doculand.com.lb', 'mathaf.doculand@gmail.com', '2024-11-15 07:43:25', '2024-11-15 17:02:44', 33.87808595735903, 35.515579494963056),
(24, 'Le Mall Dbayeh', 'Dbayeh - Inside Le Mall', 'lemall@maliks.com', 'malikslemall@gmail.com', '2024-11-15 07:44:03', '2024-11-15 17:02:58', 33.929972610122796, 35.588701496813385),
(25, 'Kaslik', 'Kaslik main road, near USEK', 'kaslik@maliks.com', 'kaslikorders@gmail.com', '2024-11-15 07:44:41', '2024-11-15 17:03:10', 33.983556043854264, 35.61978108147303),
(26, 'Books and Pens', 'Bliss - Jean Darc Street', 'bp@maliks.com', 'malikshamra@gmail.com', '2024-11-15 07:45:13', '2024-11-15 17:03:21', 33.89911166801849, 35.48151033147032),
(27, 'LAU Upper', 'Kreitem, facing LAU Upper gate', 'upper@maliks.com', 'upperorders@gmail.com', '2024-11-15 07:46:23', '2024-11-15 17:03:33', 33.892362015748255, 35.47773929504527),
(28, 'Mansourieh', 'Mansourieh Main road inside Abed Tahan', 'mansourieh@maliks.com', 'mansouriehorders@gmail.com', '2024-11-15 07:47:01', '2024-11-15 17:03:47', 33.85878334200876, 35.55919833914029),
(29, 'Doculand Gemayzeh', 'Gemayzeh Street', 'gemayzeh@doculand.com.lb', 'ashrafiehorders@gmail.com', '2024-11-15 07:47:19', '2024-11-15 17:04:14', 33.89576488689757, 35.52081620853964),
(30, 'Bechara El Khoury', 'Bechara Khoury , next Bank Audi', 'bk@maliks.com', 'orders.mbk@gmail.com', '2024-11-15 07:47:49', '2024-11-15 17:04:33', 33.881654206036465, 35.507322925647436),
(31, 'Spinneys Jnah', 'Jnah - Inside Spinneys', 'jnah@maliks.com', 'maliksjnah@gmail.com', '2024-11-15 07:48:17', '2024-11-15 17:04:46', 33.87354792211589, 35.489685912153746),
(32, 'ABC Verdun', 'Verdun - ABC', 'abc@maliks.com', 'maliks.abc.verdun@gmail.com', '2024-11-15 07:48:42', '2024-11-15 17:04:57', 33.88457566722536, 35.48446781215402),
(33, 'Mazraa', 'Mazraa Street - Beside Mazen Pharamcy', 'mazraa@maliks.com', 'maliks.mazraa@gmail.com', '2024-11-15 07:49:00', '2024-11-15 17:05:08', 33.88023678751877, 35.492329514002535),
(34, 'Jbeil', 'Jbeil Voie 13 - Byblos intersection', 'jbeil@maliks.com', 'jbeilorders@gmail.com', '2024-11-15 07:49:29', '2024-11-15 17:05:24', 34.12391032193, 35.65347502565493),
(35, 'Naher Ibrahim', 'Naher Brahim Inside Total', 'nb.maliks@gmail.com', 'nb.maliks@gmail.com', '2024-11-15 07:50:05', '2024-11-15 17:05:38', 34.07143943367592, 35.64496507974396),
(36, 'Jounieh', 'Jounieh Highway, Beside Exotica', 'jounieh@maliks.com', 'jouniehorders@gmail.com', '2024-11-15 07:50:33', '2024-11-15 17:05:54', 34.00303738193965, 35.64762339681566),
(38, 'Doculand Dekwaneh', 'Dekwaneh - Freeway Centre', 'dekwaneh@doculand.com.lb', 'doculand.dekwaneh@gmail.com', '2024-11-15 07:51:20', '2024-11-15 17:06:30', 33.88325414066066, 35.54416020853682),
(39, 'Sin El Fill', 'Hayek / ( Habtour )  Roundabout', 'sinelfil@maliks.com', 'sinelfilorders@gmail.com', '2024-11-15 07:51:44', '2024-11-15 17:06:57', 33.87045279191207, 35.53664513552072),
(40, 'Spot C', 'Khaldeh - Spot C', 'spotc@maliks.com', 'maliks.spotc@gmail.com', '2024-11-15 07:52:08', '2024-11-15 17:07:07', 33.80226933280416, 35.49010052749353),
(41, 'Main', 'Closed now', 'main@maliks.com', 'closed@closed.com', '2024-11-15 07:52:30', '2024-11-15 17:07:20', 33.89958918070307, 35.482128867976996),
(42, 'City Center', 'Beirut City Center', 'citycenter@maliks.com', 'malikscitycenter@gmail.com', '2024-11-15 07:52:54', '2024-11-15 17:07:33', 33.86209410294096, 35.529292991341116),
(43, 'Congo', 'Congo - Africa', 'congo@maliks.com', 'congo@gmail.com', '2024-11-15 07:53:20', '2024-11-15 17:29:44', -4.7746273865084055, 11.863473907136221),
(44, 'Le Mall Saida', 'Saida - Inside Le Mall', 'saida@maliks.com', 'malikssaida1@gmail.com', '2024-11-15 07:53:46', '2024-11-15 17:07:53', 33.56349943535803, 35.38024090844675),
(45, 'WH3', 'Warehouse 3 - Jnah - near Emirates Embassy', 'wh3@maliks.com', 'wh3orders@maliks.com', '2024-11-15 07:54:23', '2024-11-15 17:08:49', 33.87127135088286, 35.48429094283791),
(46, 'Haigazian', 'Hamra- near Haigazian University', 'haigazian@maliks.com', 'haigazianorders@gmail.com', '2024-11-15 07:54:57', '2024-11-15 17:09:01', 33.896557758471076, 35.49198088155288),
(47, '3F', 'Maliks Office', 'services@maliks.com', 'malik@maliks.com', '2024-11-15 07:55:19', '2024-11-15 17:09:17', 33.89928081585926, 35.48143507962175),
(48, 'Marketing', 'Maliks Office', 'marketing@maliks.com', 'marketing@marketing.com', '2024-11-15 07:55:47', '2024-11-15 17:09:23', 33.89928081585926, 35.48143507962175),
(49, 'Accounting', 'Maliks Office', 'accounting@maliks.com', 'accounting2@maliks.com', '2024-11-15 07:56:03', '2024-11-15 17:09:33', 33.89928081585926, 35.48143507962175),
(50, 'Wh1', 'Warehouse 1 - Jnah - near Al Zahraa hospital', 'wh1@maliks.com', 'wh1orders@maliks.com', '2024-11-15 07:56:26', '2024-11-15 17:09:58', 33.86376001701288, 35.48772231899544),
(51, 'AUB', 'Bliss Street', 'aub@maliks.com', 'blissorders1@gmail.com', '2024-11-15 07:56:43', '2024-11-15 17:10:09', 33.899366552700776, 35.481710443391535),
(52, 'Doculand 3F', 'Maliks Office', 'info@doculand.com.lb', 'sales@doculand.com.lb', '2024-11-15 07:57:13', '2024-11-15 17:09:42', 33.89928081585926, 35.48143507962175),
(54, 'Services Department', 'Maliks Office', 'services4@maliks.com', 'services5@maliks.com', '2024-11-23 04:29:18', '2024-11-23 04:29:18', 33.89928081585926, 35.48143507962175),
(66, 'IT Department', '3F-Bliss', 'it@maliks.com', 'shadifarhat98@gmail.com', '2025-02-12 07:42:22', '2025-02-14 04:19:24', 33.899049331887, 35.481445958457),
(67, 'Test Branch', 'This is a test', 'mira99mahmoud@gmail.com', 'services4@maliks.com', '2025-02-14 04:20:17', '2025-02-14 04:20:17', 33.89939940687, 35.480693025648);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:18:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"Dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"Users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"Calendar & Tools\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"Vacancies\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"New Joiners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"Trasnfers/Rotation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"Promotions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"Badge Maker\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"Employees\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:8:\"Branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:6:\"Titles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:8:\"Settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:4:\"Edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:8:\"Download\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:6:\"Create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:6:\"Delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"Role And Permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:9:\"HR Member\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"HR Team Member\";s:1:\"c\";s:3:\"web\";}}}', 1740207784);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

DROP TABLE IF EXISTS `employee_info`;
CREATE TABLE IF NOT EXISTS `employee_info` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_hired` date NOT NULL,
  `pin_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `left_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_info_branch_id_foreign` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `name`, `branch_id`, `title`, `status`, `date_hired`, `pin_code`, `email`, `phone`, `image_path`, `created_at`, `updated_at`, `job`, `left_date`) VALUES
(11, 'Ali Yassin', 54, 'Executive', 1, '2022-02-23', '318', 'aliyassin88@gmail.com', '71480719', 'images/67713a8c8fa89.jpg', '2024-12-29 10:03:24', '2025-02-18 12:14:10', 'Manager', NULL),
(12, 'Shadi Farhat', 66, 'Executive', 1, '2024-12-23', '1733', 'shadifarhat98@gmail.com', '76938653', 'images/678ac3e190a6c.jpg', '2024-12-29 10:06:22', '2025-02-12 08:46:25', 'Graphic designer', NULL),
(13, 'Elianne Chaker', 34, 'Supporter', 1, '2019-02-01', '1245', 'sales@doculand.com.lb', '71480718', 'images/67751ed18a32b.png', '2025-01-01 08:54:10', '2025-01-18 18:55:43', 'Stationery', NULL),
(22, 'Abdallah Farhat', 32, 'Representitve', 0, '2023-02-01', '215', 'abdallahfarhat01@hotmail.com', '71215913', 'images/678cdc4cf39d8.jpg', '2025-01-06 19:31:52', '2025-01-19 19:15:30', 'Stationery', '2025-01-19'),
(15, 'Mira', 32, 'Senior Manager', 1, '2024-12-11', '2030', 'maliks.services5@gmail.com', '01682001', 'images/677529365d3cf.png', '2025-01-01 09:38:30', '2025-01-25 14:38:10', 'Cashier', NULL),
(16, 'Mira Mahmoud', 54, 'Senior Officer', 1, '2021-10-10', '3456', 'miramahmoud99@gmail.com', '76672737', 'images/67b495a2d69f9.jpg', '2025-01-01 11:26:52', '2025-02-18 12:13:54', 'Cashier', NULL),
(17, 'Naji Deeb', 54, 'Senior Manager', 1, '2013-06-01', '917', 'maliks.services52@gmail.com', '016820200', 'images/677551466565f.jpg', '2025-01-01 12:29:26', '2025-01-25 14:50:33', 'Manager', NULL),
(18, 'Mustafa Al Assir', 54, 'Senior Supervisor', 1, '2024-12-06', '5555', 'mira939mahmoud@gmail.com', '769386253', 'images/6775526924e70.jpg', '2025-01-01 12:34:17', '2025-01-14 18:37:00', 'Graphic designer', NULL),
(19, 'Nizar Al Souri', 54, 'Senior Supervisor', 1, '2014-06-10', '3333', 'shad2ifarhat98@gmail.com', '726938653', 'images/6775528c9cb75.jpg', '2025-01-01 12:34:52', '2025-01-14 18:36:55', 'Back Office', NULL),
(20, 'Elianne', 54, 'Supporter', 1, '2000-10-10', '8889', 'shadifarhat938@gmail.com', '7693833653', 'images/6775532c20b4f.jpg', '2025-01-01 12:37:32', '2025-01-14 18:36:46', 'Back Office', NULL),
(24, 'Tarek Badawi', 9, 'Supporter', 1, '2017-01-04', '2429', 'tarekbadawi92@gmail.com', '81 488 593', 'images/67819a3fc5b90.jpg', '2025-01-10 20:07:59', '2025-02-19 08:29:10', 'Graphic designer', NULL),
(26, 'Tia Farhat', 54, 'Supporter', 1, '2024-10-10', '1478', 'tiafarhat@gmail.com', '76896632', 'images/6784ca5147f6b.jpg', '2025-01-13 06:07:28', '2025-02-18 12:41:40', 'Graphic designer', NULL),
(27, 'Abed Majed', 49, 'Supporter', 1, '2024-10-10', '2589', 'abed@abe.com', '71123369', 'images/6784ca893ef5a.jpg', '2025-01-13 06:10:49', '2025-02-13 07:54:36', 'Joker', NULL),
(28, 'Aya Al Kaissi', 66, 'Senior Supporter', 1, '2021-01-01', '2365', 'aya@aya.com', '71456789', 'images/6785590dab815.jpg', '2025-01-13 06:11:36', '2025-02-17 07:48:00', 'Graphic designer', NULL),
(29, 'Bassem Hajj Sleiman', 39, 'Supporter', 1, '2023-05-05', '7412', 'bassem@bassem.com', '71159753', 'images/6784cae8eddb5.JPG', '2025-01-13 06:12:25', '2025-02-19 07:55:55', 'Services', NULL),
(30, 'Hadi Handam', 13, 'Supporter', 1, '2023-10-10', '3598', 'hadi@hadi.com', '76951753', 'images/6784cb12e447f.jpg', '2025-01-13 06:13:07', '2025-02-13 12:32:40', 'Services', NULL),
(31, 'Nancy Alameddine', 39, 'Supporter', 1, '2022-10-10', '3541', 'nancy@nancy.com', '71258963', 'images/6784cb2f5f930.jpg', '2025-01-13 06:13:35', '2025-02-19 07:55:58', 'Cashier', NULL),
(32, 'Rachad Al Mohtar', 39, 'Supporter', 1, '2021-05-05', '1546', 'rachad@rachad.com', '78963321', 'images/6784cb5f47723.jpg', '2025-01-13 06:14:23', '2025-02-19 07:55:50', 'Stationery', NULL),
(33, 'Pamela Chamoun', 32, 'Officer', 1, '2018-10-10', '5461', 'pam@pam.com', '71546852', 'images/6784cb9197acf.jpg', '2025-01-13 06:15:13', '2025-01-14 18:37:11', 'Manager', NULL),
(34, 'Sabah Fadel', 39, 'Supporter', 1, '2025-01-01', '9999', 'sabah@sabah.com', '79135970', 'images/6785651b03e80.jpg', '2025-01-13 17:10:19', '2025-02-19 07:55:53', 'Cashier', NULL),
(35, 'Amin Barakat', 17, 'Manager', 1, '1988-10-10', '100', 'amin@amin.com', '78907654', 'images/6786cb296206d.jpg', '2025-01-14 18:38:02', '2025-01-14 18:38:02', 'Manager', NULL),
(36, 'Lara Malaeb', 51, 'Supervisor', 1, '2021-10-10', '2426', 'laramalaeb@gmail.com', '70362671', 'images/67ade22fd5ebf.jpg', '2025-02-13 10:14:42', '2025-02-20 11:39:26', 'Manager', NULL),
(37, 'Kifah Ghanam', 54, 'Supervisor', 1, '2016-10-10', '2961', 'kifo@kifo.com', '76234000', 'images/67b4956fda0e7.jpg', '2025-02-18 12:13:05', '2025-02-18 12:13:05', 'Back Office', NULL),
(38, 'Maher Labban', 54, 'Senior Supporter', 1, '2000-10-10', '101', 'maher@maher.com', '10191910', 'images/67b49614a5750.jpg', '2025-02-18 12:15:48', '2025-02-18 12:15:48', 'Services', NULL),
(39, 'Nouhad Tabara', 54, 'Supporter', 1, '2023-10-10', '87643', 'nouhad@nouhad.com', '87654321', 'images/67b497175d3bf.png', '2025-02-18 12:20:07', '2025-02-18 12:20:07', 'Back Office', NULL),
(40, 'Jinane Wehbe', 39, 'Supporter', 1, '2023-10-10', '76522', 'jihan@jihan.com', '81276555', 'images/67b49dc684675.jpg', '2025-02-18 12:48:38', '2025-02-18 12:48:38', 'Cashier', NULL),
(41, 'Jad Abboud', 39, 'Supporter', 1, '2025-02-10', '10999', 'jad@jad.com', '87967544', 'images/67b49e10b895f.jpg', '2025-02-18 12:49:52', '2025-02-18 12:49:59', 'Cashier', NULL),
(42, 'Rami Al Hakim', 39, 'Supporter', 1, '2000-10-10', '9888', 'rami@rami.com', '988876665', 'images/67b49e72b8c83.jpg', '2025-02-18 12:51:30', '2025-02-18 12:51:30', 'Graphic designer', NULL),
(43, 'Aslan Khaddaj', 39, 'Supporter', 1, '2023-10-10', '08765', 'aslan@aslan.com', '909875423', 'images/67b49e90010a0.jpg', '2025-02-18 12:52:00', '2025-02-18 12:52:00', 'Graphic designer', NULL),
(44, 'Karim Hakim', 39, 'Supporter', 1, '2024-10-10', '87655', 'karim@karim.com', '90891345467', 'images/67b49eb075d0d.jpg', '2025-02-18 12:52:32', '2025-02-18 12:52:32', 'Graphic designer', NULL),
(45, 'Adam Khansa', 39, 'Supporter', 1, '2024-10-10', '122222', 'adam@adam.com', '8777666555', 'images/67b49ece31934.jpg', '2025-02-18 12:53:02', '2025-02-18 12:53:02', 'Stationery', NULL),
(46, 'Hadi Cheaito', 39, 'Supporter', 1, '2024-10-10', '99800', 'hadi@hadu.com', '09876654', 'images/67b49f1eb1f29.jpg', '2025-02-18 12:54:22', '2025-02-18 12:54:22', 'Stationery', NULL),
(47, 'Shadi Graizy', 39, 'Supporter', 1, '2024-10-10', '00992211', 'shadi@adi.com', '0987654321', 'images/67b49f60da9d4.jpg', '2025-02-18 12:55:28', '2025-02-18 12:55:28', 'Cashier', NULL),
(48, 'Ceasar Al Ahmadie', 39, 'Supporter', 1, '2024-10-10', '9821333', 'cesar@cesar.com', '09123456789', 'images/67b49f9a332b0.jpg', '2025-02-18 12:56:26', '2025-02-18 12:56:26', 'Services', NULL),
(49, 'Ahmad Dwayre', 39, 'Supporter', 1, '2024-10-10', '765555', 'ahmad@ahmad.com', '08765432345', 'images/67b49fb6bfe96.jpg', '2025-02-18 12:56:54', '2025-02-18 12:56:54', 'Services', NULL),
(50, 'Mariam Tohme', 39, 'Supporter', 1, '2024-10-10', '902222', 'mariam@mariam.com', '07897654321', 'images/67b49fd1dfb4b.jpg', '2025-02-18 12:57:21', '2025-02-18 12:57:21', 'Stationery', NULL),
(51, 'Rita Nader', 39, 'Supporter', 1, '2024-10-10', '11223341', 'rita@rita.com', '0123849756', 'images/67b49fe9e3a2c.jpg', '2025-02-18 12:57:45', '2025-02-18 12:57:45', 'Stationery', NULL),
(52, 'Hasasn Awad', 39, 'Supporter', 1, '2024-10-10', '0274618', 'hasan@hasan.com', '02184746451', 'images/67b4a0138e4aa.jpg', '2025-02-18 12:58:27', '2025-02-18 12:58:27', 'Cashier', NULL),
(53, 'Yehya Mashakah', 39, 'Supporter', 1, '2024-10-10', '2455555', 'yehya@yehya.com', '0198765432123', 'images/67b4a03800883.jpg', '2025-02-18 12:59:04', '2025-02-18 12:59:04', 'Stationery', NULL),
(54, 'Georgette Tabett', 39, 'Supporter', 1, '2024-10-10', '1239457', 'georgette@georgette.com', '01293874671', 'images/67b4a059e2d89.jpg', '2025-02-18 12:59:37', '2025-02-18 12:59:37', 'Typist', NULL),
(55, 'Ismail Al Kadi', 39, 'Supporter', 1, '2024-10-10', '1093', 'ismail@ismail.com', '0156789043212', 'images/67b4a0871bedb.jpg', '2025-02-18 13:00:23', '2025-02-18 13:00:23', 'Typist', NULL),
(56, 'Shadi Abou Dargham', 39, 'Manager', 1, '2013-10-10', '713', 'shadii@shadi.com', '09876542389', 'images/67b4a0b296ad1.jpg', '2025-02-18 13:01:06', '2025-02-18 13:01:06', 'Manager', NULL),
(57, 'Chirine Amar', 39, 'Senior Supervisor', 1, '2015-10-10', '813', 'chirine@chirine.com', '076543829', 'images/67b4a0e0d047b.jpg', '2025-02-18 13:01:52', '2025-02-18 13:01:52', 'Manager', NULL),
(58, 'Saher Shammas', 39, 'Supervisor', 1, '2023-10-10', '7655', 'saher@saher.com', '017414674', 'images/67b4a11568f62.jpg', '2025-02-18 13:02:45', '2025-02-18 13:02:45', 'Manager', NULL),
(59, 'Hadi Majed', 51, 'Supporter', 1, '2023-10-10', '1134', 'hadi@hadiii.com', '789876543', 'images/67b5a15f3ae6b.png', '2025-02-19 07:16:16', '2025-02-19 07:16:16', 'Graphic designer', NULL),
(60, 'Nazek Baderdine', 51, 'Supervisor', 1, '2013-02-10', '718', 'nazek@nazek.com', '79123456', 'images/67b5a1dc18e91.png', '2025-02-19 07:18:20', '2025-02-19 07:18:20', 'Manager', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `created_at`, `updated_at`) VALUES
(7, 'Test', '2025-01-16 10:00:00', '2025-01-16 12:00:00', '2025-01-14 16:43:57', '2025-01-14 16:43:57'),
(3, 'Conference', '2025-01-18 09:00:00', '2025-01-18 17:00:00', '2025-01-13 19:31:28', '2025-01-13 19:31:28'),
(5, 'Stationery Meeting', '2025-01-20 20:23:00', '2025-01-20 23:23:00', '2025-01-14 16:23:30', '2025-01-14 16:23:30'),
(10, 'Batrouni Meeting', '2025-02-01 08:00:00', '2025-02-01 17:00:00', '2025-01-25 14:28:19', '2025-01-25 14:28:19'),
(12, 'HR Applicataion Meeting', '2025-01-30 10:00:00', '2025-01-30 12:00:00', '2025-01-26 06:41:08', '2025-01-26 06:41:08'),
(22, 'testtttt', '2025-01-21 09:00:00', '2025-01-21 10:00:00', '2025-01-26 10:22:00', '2025-01-26 10:22:00'),
(20, 'test', '2025-01-22 09:00:00', '2025-01-22 10:00:00', '2025-01-26 09:52:52', '2025-01-26 09:52:52'),
(26, 'test', '2025-02-11 13:35:00', '2025-02-11 14:00:00', '2025-02-11 09:27:50', '2025-02-11 09:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_27_204649_create_employee_info', 1),
(5, '2024_12_28_214532_create_branches_table', 1),
(6, '2025_01_12_194640_add_job_to_employee_info_table', 1),
(7, '2025_01_13_212733_create_events_table', 1),
(8, '2025_01_14_184848_create_titles_table', 1),
(9, '2025_01_16_192153_create_vacancy_table', 1),
(10, '2025_01_16_210037_update_vacancies_table', 1),
(11, '2025_01_19_084842_create_transfers_table', 1),
(12, '2025_01_19_102949_add_transfer_start_date_to_transfers_table', 1),
(13, '2025_01_19_210250_add_left_date_to_employee_info_table', 1),
(14, '2025_01_20_210212_add_image_to_users_table', 1),
(15, '2025_01_22_074055_add_status_and_role_name_to_users_table', 1),
(16, '2025_01_24_064716_add_temp_pass_to_users_table', 1),
(17, '2025_01_24_101818_create_messages_table', 1),
(18, '2025_01_26_105136_create_table_promotions', 1),
(19, '2025_02_02_085924_create_new_joiner_table', 1),
(20, '2025_02_02_102017_update_current_branch_nullable', 1),
(21, '2025_02_02_200739_create_employee_phase_progress_table', 1),
(22, '2025_02_12_090338_add_columns_to_transfers', 1),
(23, '2025_02_12_094753_update_type_column_in_transfers', 1),
(24, '2025_02_12_104931_add_rotation_duration_to_transfers', 1),
(25, '2025_02_12_111635_create_notifications_table', 1),
(26, '2025_02_12_113344_add_user_image_to_notifications', 1),
(27, '2025_02_20_071356_create_permission_tables', 1),
(28, '2025_02_20_074636_update_guard_name_default_in_roles_table', 2),
(29, '2025_02_20_101000_remove_role_name_from_users_table', 3),
(30, '2025_02_21_060822_create_training_steps_table', 4),
(31, '2025_02_21_064336_add_color_to_training_steps', 5),
(32, '2025_02_21_082801_update_new_joiner_table', 6),
(33, '2025_02_21_082941_create_new_joiner_progress_table', 7),
(34, '2025_02_21_090249_add_remarks_to_new_joiner_progress', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Role', 8),
(1, 'App\\Models\\Role', 9),
(2, 'App\\Models\\Role', 8),
(3, 'App\\Models\\Role', 8),
(3, 'App\\Models\\Role', 9),
(4, 'App\\Models\\Role', 8),
(4, 'App\\Models\\Role', 9),
(5, 'App\\Models\\Role', 8),
(5, 'App\\Models\\Role', 9),
(6, 'App\\Models\\Role', 8),
(6, 'App\\Models\\Role', 9),
(7, 'App\\Models\\Role', 8),
(7, 'App\\Models\\Role', 9),
(8, 'App\\Models\\Role', 8),
(8, 'App\\Models\\Role', 9),
(9, 'App\\Models\\Role', 8),
(9, 'App\\Models\\Role', 9),
(10, 'App\\Models\\Role', 8),
(10, 'App\\Models\\Role', 9),
(11, 'App\\Models\\Role', 8),
(11, 'App\\Models\\Role', 9),
(12, 'App\\Models\\Role', 8),
(12, 'App\\Models\\Role', 9),
(13, 'App\\Models\\Role', 8),
(14, 'App\\Models\\Role', 8),
(14, 'App\\Models\\Role', 9),
(15, 'App\\Models\\Role', 8),
(15, 'App\\Models\\Role', 9),
(16, 'App\\Models\\Role', 8),
(17, 'App\\Models\\Role', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(8, 'App\\Models\\User', 3),
(8, 'App\\Models\\User', 5),
(9, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `new_joiner`
--

DROP TABLE IF EXISTS `new_joiner`;
CREATE TABLE IF NOT EXISTS `new_joiner` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_joiner`
--

INSERT INTO `new_joiner` (`id`, `name`, `mode`, `start_date`, `job`, `created_at`, `updated_at`) VALUES
(24, 'Maher Labban', 'full-time', '2025-02-26', 'Stationery', '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(23, 'Dalia Mayassi', 'full-time', '2024-12-31', 'Stationery', '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(22, 'Silva trayji', 'part-time', '2025-02-18', 'Stationery', '2025-02-21 11:29:29', '2025-02-21 11:29:29'),
(21, 'Loulwa Khaddaj', 'part-time', '2025-02-12', 'Joker', '2025-02-21 11:29:16', '2025-02-21 11:29:16'),
(20, 'Hadi Rida', 'full-time', '2025-02-12', 'Stationery', '2025-02-21 10:09:17', '2025-02-21 10:09:17'),
(19, 'Mustafa Rihane', 'full-time', '2025-02-12', 'Graphic designer', '2025-02-21 10:05:53', '2025-02-21 10:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `new_joiner_progress`
--

DROP TABLE IF EXISTS `new_joiner_progress`;
CREATE TABLE IF NOT EXISTS `new_joiner_progress` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `new_joiner_id` bigint UNSIGNED NOT NULL,
  `step_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `new_joiner_progress_new_joiner_id_foreign` (`new_joiner_id`),
  KEY `new_joiner_progress_step_id_foreign` (`step_id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_joiner_progress`
--

INSERT INTO `new_joiner_progress` (`id`, `new_joiner_id`, `step_id`, `status`, `remarks`, `completed_at`, `created_at`, `updated_at`) VALUES
(131, 24, 7, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(118, 22, 9, 'pending', NULL, NULL, '2025-02-21 11:29:30', '2025-02-21 11:29:30'),
(117, 22, 7, 'pending', NULL, NULL, '2025-02-21 11:29:30', '2025-02-21 11:29:30'),
(116, 22, 5, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:30', '2025-02-21 11:30:34'),
(115, 22, 8, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:30', '2025-02-21 11:30:28'),
(114, 22, 6, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:30', '2025-02-21 11:30:09'),
(113, 22, 2, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:29', '2025-02-21 11:30:04'),
(112, 22, 1, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:29', '2025-02-21 11:29:55'),
(111, 21, 9, 'pending', NULL, NULL, '2025-02-21 11:29:16', '2025-02-21 11:29:16'),
(110, 21, 7, 'pending', NULL, NULL, '2025-02-21 11:29:16', '2025-02-21 11:29:16'),
(109, 21, 5, 'pending', NULL, NULL, '2025-02-21 11:29:16', '2025-02-21 11:29:16'),
(108, 21, 8, 'pending', NULL, NULL, '2025-02-21 11:29:16', '2025-02-21 11:29:16'),
(107, 21, 6, 'completed', 'Started with Nizar', '2025-02-20 22:00:00', '2025-02-21 11:29:16', '2025-02-21 11:38:59'),
(106, 21, 2, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:16', '2025-02-21 11:30:06'),
(105, 21, 1, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:16', '2025-02-21 11:29:59'),
(104, 20, 9, 'pending', NULL, NULL, '2025-02-21 10:09:17', '2025-02-21 10:09:17'),
(103, 20, 7, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:23:13'),
(102, 20, 5, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:18:18'),
(101, 20, 8, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:13:36'),
(100, 20, 6, 'completed', 'test ag', '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:13:24'),
(99, 20, 2, 'completed', 'test', '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:09:27'),
(98, 20, 1, 'completed', 'test', '2025-02-20 22:00:00', '2025-02-21 10:09:17', '2025-02-21 11:09:21'),
(97, 19, 9, 'pending', NULL, NULL, '2025-02-21 10:05:53', '2025-02-21 10:05:53'),
(96, 19, 7, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:07:03'),
(95, 19, 5, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:06:59'),
(94, 19, 8, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:06:56'),
(93, 19, 6, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:06:53'),
(92, 19, 2, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:06:51'),
(91, 19, 1, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 10:05:53', '2025-02-21 10:06:03'),
(132, 24, 9, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(119, 23, 1, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:42', '2025-02-21 11:30:02'),
(120, 23, 2, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(121, 23, 6, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(122, 23, 8, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(123, 23, 5, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(124, 23, 7, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(125, 23, 9, 'pending', NULL, NULL, '2025-02-21 11:29:42', '2025-02-21 11:29:42'),
(126, 24, 1, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(127, 24, 2, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(128, 24, 6, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(129, 24, 8, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(130, 24, 5, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notified_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `notified_at`, `is_read`, `created_at`, `updated_at`, `user_image`) VALUES
(1, 1, 'rotation_end', 'Your rotation is about to end in 3 days.', '2025-02-12 09:31:39', 1, NULL, '2025-02-13 06:18:03', '/images/Default.jpg'),
(68, 3, 'admin_alert', 'Tania Khadaj has marked the rotation of Hadi Handam as a transfer.', '2025-02-13 08:09:17', 1, '2025-02-13 08:09:17', '2025-02-13 08:09:48', 'user-images/4sHVrZmMT4Gs7Bf3JWNT2p43X0kVXxv84CSNVkS9.jpg'),
(6, 1, 'action', 'Silva created a new vaccancy for Abraj', '2025-02-12 11:30:58', 1, NULL, '2025-02-13 06:18:19', '/images/Default.jpg'),
(7, 1, 'action', 'Silva created a new employee', '2025-02-12 11:31:11', 1, NULL, '2025-02-13 06:18:18', '/images/Default.jpg'),
(8, 1, 'action', 'Loulwa  the trasnfer of Firas to Ashrafieh', '2025-02-12 11:31:36', 1, NULL, '2025-02-13 06:18:18', 'images/6784cb12e447f.jpg'),
(9, 1, 'action', 'Loulwa  the transfer of Shadi to IT Department', '2025-02-12 11:31:50', 1, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(10, 1, 'action', 'Shadi made the transfer of Shadi to IT Department', '2025-02-12 11:31:50', 1, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(11, 1, 'action', 'Ali Yassin made the transfer of Shadi to IT Department', '2025-02-12 11:31:50', 0, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(12, 1, 'action', 'Shadi made the transfer of Shadi to IT Department', '2025-02-12 11:31:50', 0, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(13, 1, 'action', 'Naji made the transfer of Shadi to IT Department', '2025-02-12 11:31:50', 0, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(14, 1, 'action', 'Malik made the transfer of Shadi to IT Department', '2025-02-14 11:31:50', 0, NULL, '2025-02-13 06:18:16', 'images/678ac3e190a6c.jpg'),
(84, 2, 'admin_alert', 'The rotation of Hadi Handam as a transfer by the Admin.', '2025-02-13 08:15:12', 1, '2025-02-13 08:15:12', '2025-02-13 08:15:43', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(83, 3, 'admin_alert', 'Tania Khadaj has marked the rotation of Hadi Handam as a transfer.', '2025-02-13 08:15:12', 1, '2025-02-13 08:15:12', '2025-02-13 08:15:36', 'user-images/4sHVrZmMT4Gs7Bf3JWNT2p43X0kVXxv84CSNVkS9.jpg'),
(67, 3, 'admin_alert', 'Mira Mahmoud has created a rotation for Hadi Handam to branch Abraj', '2025-02-13 08:04:51', 1, '2025-02-13 08:04:51', '2025-02-13 08:09:47', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(63, 2, 'rotation_reminder', 'Reminder: The rotation for Hadi Handam at Abraj will end on 13-02-2025.', '2025-02-13 08:04:51', 1, '2025-02-13 08:04:51', '2025-02-13 08:09:58', 'images/6784cb12e447f.jpg'),
(81, 3, 'admin_alert', 'Mira Mahmoud has created a rotation for Hadi Handam to branch Abraj', '2025-02-13 08:15:07', 1, '2025-02-13 08:15:07', '2025-02-13 08:15:37', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(65, 3, 'admin_alert', ' Hadi Handam is scheduled to complete rotation on 13-02-2025.', '2025-02-13 08:04:51', 1, '2025-02-13 08:04:51', '2025-02-13 08:09:47', 'images/6784cb12e447f.jpg'),
(323, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Maher Labban with the job of Services.', '2025-02-18 12:15:48', 0, '2025-02-18 12:15:48', '2025-02-18 12:15:48', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(319, 1, 'admin_alert', 'Shadi Farhat IT has created a transfer for Aya Al Kaissi to branch IT Department', '2025-02-17 07:48:00', 0, '2025-02-17 07:48:00', '2025-02-17 07:48:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(79, 3, 'admin_alert', ' Hadi Handam is scheduled to complete rotation on 13-02-2025.', '2025-02-13 08:15:07', 1, '2025-02-13 08:15:07', '2025-02-13 08:15:37', 'images/6784cb12e447f.jpg'),
(320, 3, 'admin_alert', 'Shadi Farhat IT has created a transfer for Aya Al Kaissi to branch IT Department', '2025-02-17 07:48:00', 0, '2025-02-17 07:48:00', '2025-02-17 07:48:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(77, 2, 'rotation_reminder', 'Reminder: The rotation for Hadi Handam at Abraj will end on 13-02-2025.', '2025-02-13 08:15:07', 1, '2025-02-13 08:15:07', '2025-02-13 08:15:43', 'images/6784cb12e447f.jpg'),
(85, 1, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Bechara El Khoury.', '2025-02-13 08:28:03', 0, '2025-02-13 08:28:03', '2025-02-13 08:28:03', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(86, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Bechara El Khoury.', '2025-02-13 08:28:03', 1, '2025-02-13 08:28:03', '2025-02-13 08:32:09', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(87, 1, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Bechara El Khoury.', '2025-02-13 08:32:10', 0, '2025-02-13 08:32:10', '2025-02-13 08:32:10', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(88, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Bechara El Khoury.', '2025-02-13 08:32:10', 1, '2025-02-13 08:32:10', '2025-02-13 08:34:21', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(89, 1, 'admin_alert', 'Mira Mahmoud has deleted the vacancy for Graphic designer at Bechara El Khoury.', '2025-02-13 08:32:16', 0, '2025-02-13 08:32:16', '2025-02-13 08:32:16', '/images/default.jpg'),
(90, 3, 'admin_alert', 'Mira Mahmoud has deleted the vacancy for Graphic designer at Bechara El Khoury.', '2025-02-13 08:32:16', 1, '2025-02-13 08:32:16', '2025-02-13 08:34:19', '/images/default.jpg'),
(91, 1, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:34:43', 0, '2025-02-13 08:34:43', '2025-02-13 08:34:43', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(92, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:34:43', 1, '2025-02-13 08:34:43', '2025-02-13 08:34:56', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(93, 1, 'admin_alert', 'Mira Mahmoud has deleted the vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:34:49', 0, '2025-02-13 08:34:49', '2025-02-13 08:34:49', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(94, 3, 'admin_alert', 'Mira Mahmoud has deleted the vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:34:49', 1, '2025-02-13 08:34:49', '2025-02-13 08:34:55', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(95, 1, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:35:04', 0, '2025-02-13 08:35:04', '2025-02-13 08:35:04', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(96, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:35:04', 1, '2025-02-13 08:35:04', '2025-02-13 08:36:39', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(97, 1, 'admin_alert', 'Tania Khadaj has deleted the vacancy for the job \'Graphic designer\' at Mansourieh.', '2025-02-13 08:35:10', 0, '2025-02-13 08:35:10', '2025-02-13 08:35:10', 'user-images/4sHVrZmMT4Gs7Bf3JWNT2p43X0kVXxv84CSNVkS9.jpg'),
(98, 1, 'admin_alert', 'Mira Mahmoud has created a new promotion for Abdallah Farhat to the position of Stationery.', '2025-02-13 10:04:18', 0, '2025-02-13 10:04:18', '2025-02-13 10:04:18', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(99, 3, 'admin_alert', 'Mira Mahmoud has created a new promotion for Abdallah Farhat to the position of Stationery.', '2025-02-13 10:04:18', 1, '2025-02-13 10:04:18', '2025-02-13 10:08:12', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(100, 1, 'admin_alert', 'Mira Mahmoud has deleted the promotion for Abdallah Farhat for the title of Supervisor.', '2025-02-13 10:08:00', 0, '2025-02-13 10:08:00', '2025-02-13 10:08:00', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(101, 3, 'admin_alert', 'Mira Mahmoud has deleted the promotion for Abdallah Farhat for the title of Supervisor.', '2025-02-13 10:08:00', 1, '2025-02-13 10:08:00', '2025-02-13 10:08:11', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(102, 1, 'admin_alert', 'Mira Mahmoud has created a new promotion for Abdallah Farhat to the position of Supervisor.', '2025-02-13 10:08:19', 0, '2025-02-13 10:08:19', '2025-02-13 10:08:19', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(103, 3, 'admin_alert', 'Mira Mahmoud has created a new promotion for Abdallah Farhat to the position of Supervisor.', '2025-02-13 10:08:19', 1, '2025-02-13 10:08:19', '2025-02-13 10:08:27', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(322, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Kifah Ghanam with the job of Back Office.', '2025-02-18 12:13:06', 0, '2025-02-18 12:13:06', '2025-02-18 12:13:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(105, 3, 'admin_alert', 'Mira Mahmoud has created a new employee named Lara Malaeb with the job of Manager.', '2025-02-13 10:14:42', 1, '2025-02-13 10:14:42', '2025-02-13 10:18:10', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(324, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Maher Labban with the job of Services.', '2025-02-18 12:15:48', 0, '2025-02-18 12:15:48', '2025-02-18 12:15:48', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(321, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Kifah Ghanam with the job of Back Office.', '2025-02-18 12:13:06', 0, '2025-02-18 12:13:06', '2025-02-18 12:13:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(313, 3, 'admin_alert', 'Shadi Farhat IT has created a transfer for Aya Al Kaissi to branch IT Department', '2025-02-14 12:51:51', 1, '2025-02-14 12:51:51', '2025-02-14 12:53:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(325, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nouhad Tabara with the job of Back Office.', '2025-02-18 12:20:07', 0, '2025-02-18 12:20:07', '2025-02-18 12:20:07', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(326, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nouhad Tabara with the job of Back Office.', '2025-02-18 12:20:07', 0, '2025-02-18 12:20:07', '2025-02-18 12:20:07', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(327, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jinane Wehbe with the job of Cashier.', '2025-02-18 12:48:38', 0, '2025-02-18 12:48:38', '2025-02-18 12:48:38', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(328, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jinane Wehbe with the job of Cashier.', '2025-02-18 12:48:38', 0, '2025-02-18 12:48:38', '2025-02-18 12:48:38', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(329, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jad Abboud with the job of Cashier.', '2025-02-18 12:49:52', 0, '2025-02-18 12:49:52', '2025-02-18 12:49:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(330, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jad Abboud with the job of Cashier.', '2025-02-18 12:49:52', 0, '2025-02-18 12:49:52', '2025-02-18 12:49:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(331, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rami Al Hakim with the job of Graphic designer.', '2025-02-18 12:51:30', 0, '2025-02-18 12:51:30', '2025-02-18 12:51:30', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(332, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rami Al Hakim with the job of Graphic designer.', '2025-02-18 12:51:30', 0, '2025-02-18 12:51:30', '2025-02-18 12:51:30', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(333, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Aslan Khaddaj with the job of Graphic designer.', '2025-02-18 12:52:00', 0, '2025-02-18 12:52:00', '2025-02-18 12:52:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(334, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Aslan Khaddaj with the job of Graphic designer.', '2025-02-18 12:52:00', 0, '2025-02-18 12:52:00', '2025-02-18 12:52:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(335, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Karim Hakim with the job of Graphic designer.', '2025-02-18 12:52:32', 0, '2025-02-18 12:52:32', '2025-02-18 12:52:32', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(336, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Karim Hakim with the job of Graphic designer.', '2025-02-18 12:52:32', 0, '2025-02-18 12:52:32', '2025-02-18 12:52:32', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(337, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Adam Khansa with the job of Stationery.', '2025-02-18 12:53:02', 0, '2025-02-18 12:53:02', '2025-02-18 12:53:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(338, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Adam Khansa with the job of Stationery.', '2025-02-18 12:53:02', 0, '2025-02-18 12:53:02', '2025-02-18 12:53:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(339, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Cheaito with the job of Stationery.', '2025-02-18 12:54:22', 0, '2025-02-18 12:54:22', '2025-02-18 12:54:22', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(340, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Cheaito with the job of Stationery.', '2025-02-18 12:54:22', 0, '2025-02-18 12:54:22', '2025-02-18 12:54:22', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(341, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Graizy with the job of Cashier.', '2025-02-18 12:55:28', 0, '2025-02-18 12:55:28', '2025-02-18 12:55:28', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(342, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Graizy with the job of Cashier.', '2025-02-18 12:55:28', 0, '2025-02-18 12:55:28', '2025-02-18 12:55:28', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(343, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ceasar Al Ahmadie with the job of Services.', '2025-02-18 12:56:26', 0, '2025-02-18 12:56:26', '2025-02-18 12:56:26', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(344, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ceasar Al Ahmadie with the job of Services.', '2025-02-18 12:56:26', 0, '2025-02-18 12:56:26', '2025-02-18 12:56:26', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(345, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ahmad Dwayre with the job of Services.', '2025-02-18 12:56:54', 0, '2025-02-18 12:56:54', '2025-02-18 12:56:54', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(346, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ahmad Dwayre with the job of Services.', '2025-02-18 12:56:54', 0, '2025-02-18 12:56:54', '2025-02-18 12:56:54', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(347, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Mariam Tohme with the job of Stationery.', '2025-02-18 12:57:21', 0, '2025-02-18 12:57:21', '2025-02-18 12:57:21', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(348, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Mariam Tohme with the job of Stationery.', '2025-02-18 12:57:21', 0, '2025-02-18 12:57:21', '2025-02-18 12:57:21', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(349, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rita Nader with the job of Stationery.', '2025-02-18 12:57:45', 0, '2025-02-18 12:57:45', '2025-02-18 12:57:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(350, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rita Nader with the job of Stationery.', '2025-02-18 12:57:45', 0, '2025-02-18 12:57:45', '2025-02-18 12:57:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(351, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hasasn Awad with the job of Cashier.', '2025-02-18 12:58:27', 0, '2025-02-18 12:58:27', '2025-02-18 12:58:27', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(352, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hasasn Awad with the job of Cashier.', '2025-02-18 12:58:27', 0, '2025-02-18 12:58:27', '2025-02-18 12:58:27', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(353, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Yehya Mashakah with the job of Stationery.', '2025-02-18 12:59:04', 0, '2025-02-18 12:59:04', '2025-02-18 12:59:04', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(354, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Yehya Mashakah with the job of Stationery.', '2025-02-18 12:59:04', 0, '2025-02-18 12:59:04', '2025-02-18 12:59:04', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(355, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Georgette Tabett with the job of Typist.', '2025-02-18 12:59:37', 0, '2025-02-18 12:59:37', '2025-02-18 12:59:37', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(356, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Georgette Tabett with the job of Typist.', '2025-02-18 12:59:37', 0, '2025-02-18 12:59:37', '2025-02-18 12:59:37', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(357, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ismail Al Kadi with the job of Typist.', '2025-02-18 13:00:23', 0, '2025-02-18 13:00:23', '2025-02-18 13:00:23', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(358, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ismail Al Kadi with the job of Typist.', '2025-02-18 13:00:23', 0, '2025-02-18 13:00:23', '2025-02-18 13:00:23', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(359, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Abou Dargham with the job of Manager.', '2025-02-18 13:01:06', 0, '2025-02-18 13:01:06', '2025-02-18 13:01:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(360, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Abou Dargham with the job of Manager.', '2025-02-18 13:01:06', 0, '2025-02-18 13:01:06', '2025-02-18 13:01:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(361, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Chirine Amar with the job of Manager.', '2025-02-18 13:01:52', 0, '2025-02-18 13:01:52', '2025-02-18 13:01:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(362, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Chirine Amar with the job of Manager.', '2025-02-18 13:01:52', 0, '2025-02-18 13:01:52', '2025-02-18 13:01:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(363, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Saher Shammas with the job of Manager.', '2025-02-18 13:02:45', 0, '2025-02-18 13:02:45', '2025-02-18 13:02:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(364, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Saher Shammas with the job of Manager.', '2025-02-18 13:02:45', 0, '2025-02-18 13:02:45', '2025-02-18 13:02:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(367, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Majed with the job of Graphic designer.', '2025-02-19 07:16:17', 0, '2025-02-19 07:16:17', '2025-02-19 07:16:17', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(368, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Majed with the job of Graphic designer.', '2025-02-19 07:16:17', 0, '2025-02-19 07:16:17', '2025-02-19 07:16:17', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(369, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nazek Baderdine with the job of Manager.', '2025-02-19 07:18:20', 0, '2025-02-19 07:18:20', '2025-02-19 07:18:20', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(370, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nazek Baderdine with the job of Manager.', '2025-02-19 07:18:20', 0, '2025-02-19 07:18:20', '2025-02-19 07:18:20', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(371, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:28:45', 0, '2025-02-20 11:28:45', '2025-02-20 11:28:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(372, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:05', 0, '2025-02-20 11:31:05', '2025-02-20 11:31:05', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(373, 3, 'admin_alert', 'Shadi Farhat IT has created a new promotion for Shadi Farhat to the position of Executive.', '2025-02-20 11:31:32', 0, '2025-02-20 11:31:32', '2025-02-20 11:31:32', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(374, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:46', 0, '2025-02-20 11:31:46', '2025-02-20 11:31:46', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(375, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:49', 0, '2025-02-20 11:31:49', '2025-02-20 11:31:49', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(376, 3, 'admin_alert', 'Shadi Farhat IT has created a new promotion for Shadi Farhat to the position of Executive.', '2025-02-20 11:32:02', 0, '2025-02-20 11:32:02', '2025-02-20 11:32:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(377, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Cashier\' at ABC Verdun.', '2025-02-20 11:35:35', 0, '2025-02-20 11:35:35', '2025-02-20 11:35:35', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(378, 5, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Cashier\' at ABC Verdun.', '2025-02-20 11:35:35', 1, '2025-02-20 11:35:35', '2025-02-20 12:23:40', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(2, 'Users', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(3, 'Calendar & Tools', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(4, 'Vacancies', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(5, 'New Joiners', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(6, 'Trasnfers/Rotation', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(7, 'Promotions', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(8, 'Badge Maker', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(9, 'Employees', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(10, 'Branches', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(11, 'Titles', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(12, 'Settings', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(13, 'Edit', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(14, 'Download', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(15, 'Create', 'web', '2025-02-20 05:43:32', '2025-02-20 05:43:32'),
(16, 'Delete', 'web', '2025-02-20 05:50:47', '2025-02-20 05:50:47'),
(17, 'Role And Permission', 'web', '2025-02-20 06:03:48', '2025-02-20 06:03:48'),
(18, 'HR Member', 'web', '2025-02-20 11:50:14', '2025-02-20 11:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(8, 'Admin', 'web', '2025-02-20 08:57:47', '2025-02-20 08:57:47'),
(9, 'HR Team Member', 'web', '2025-02-20 09:15:50', '2025-02-20 09:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 8),
(1, 9),
(2, 8),
(3, 8),
(3, 9),
(4, 8),
(4, 9),
(5, 8),
(5, 9),
(6, 8),
(6, 9),
(7, 8),
(7, 9),
(8, 8),
(8, 9),
(9, 8),
(9, 9),
(10, 8),
(10, 9),
(11, 8),
(11, 9),
(12, 8),
(12, 9),
(13, 8),
(14, 8),
(14, 9),
(15, 8),
(15, 9),
(16, 8),
(17, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('E99MXdoAY49hUJuuiQsCY1jEb2pPNWuisZPcK1pM', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicktsZE1rWVNHY3lsZjkxQzJRRlZybFRucER0ZjZXU2k5MkhrN1FuMSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbm90aWZpY2F0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1740145566);

-- --------------------------------------------------------

--
-- Table structure for table `table_promotions`
--

DROP TABLE IF EXISTS `table_promotions`;
CREATE TABLE IF NOT EXISTS `table_promotions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `old_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_promotions_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=483 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_promotions`
--

INSERT INTO `table_promotions` (`id`, `employee_id`, `old_title`, `new_title`, `promotion_date`, `created_at`, `updated_at`) VALUES
(61, 27, 'Conductor', 'Representative', '2024-02-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(62, 30, 'Senior Manager', 'Senior Manager', '2023-05-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(63, 34, 'Senior Officer', 'Executive', '2023-03-31', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(64, 16, 'Senior Officer', 'Manager', '2024-08-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(65, 12, 'Senior Supervisor', 'Senior Executive', '2020-10-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(66, 30, 'Conductor', 'Senior Officer', '2024-05-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(67, 23, 'Officer', 'Supporter', '2021-01-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(68, 26, 'Manager', 'Senior Manager', '2024-08-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(69, 22, 'Manager', 'Senior Executive', '2021-11-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(70, 17, 'Conductor', 'Executive', '2024-05-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(71, 35, 'Senior Officer', 'Supporter', '2020-02-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(72, 15, 'Representative', 'Representative', '2020-11-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(73, 27, 'Conductor', 'Conductor', '2022-10-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(74, 33, 'Senior Officer', 'Senior Manager', '2022-07-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(75, 11, 'Senior Supervisor', 'Senior Manager', '2020-05-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(76, 27, 'Officer', 'Senior Executive', '2023-02-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(77, 21, 'Supervisor', 'Supervisor', '2020-07-31', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(78, 30, 'Supervisor', 'Senior Officer', '2023-04-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(79, 17, 'Senior Supporter', 'Supervisor', '2023-10-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(80, 28, 'Conductor', 'Executive', '2024-06-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(81, 22, 'Supporter', 'Officer', '2021-03-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(82, 22, 'Senior Manager', 'Supervisor', '2022-01-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(83, 32, 'Senior Supporter', 'Manager', '2022-09-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(84, 22, 'Senior Supervisor', 'Executive', '2024-06-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(85, 31, 'Conductor', 'Senior Conductor', '2020-03-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(86, 29, 'Senior Executive', 'Supervisor', '2020-12-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(87, 12, 'Senior Supporter', 'Manager', '2022-10-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(88, 11, 'Senior Manager', 'Senior Officer', '2021-05-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(89, 13, 'Executive', 'Senior Supporter', '2020-02-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(90, 29, 'Senior Executive', 'Conductor', '2021-02-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(91, 16, 'Representative', 'Supervisor', '2020-04-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(92, 26, 'Senior Manager', 'Supporter', '2022-10-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(93, 35, 'Senior Executive', 'Senior Supporter', '2021-11-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(94, 35, 'Supervisor', 'Executive', '2020-11-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(95, 13, 'Supporter', 'Supporter', '2022-11-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(96, 17, 'Supervisor', 'Senior Manager', '2024-02-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(97, 35, 'Senior Executive', 'Officer', '2024-07-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(98, 13, 'Senior Executive', 'Senior Conductor', '2021-01-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(99, 31, 'Executive', 'Representative', '2022-02-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(100, 18, 'Senior Conductor', 'Senior Conductor', '2021-03-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(101, 13, 'Conductor', 'Senior Executive', '2023-10-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(102, 11, 'Senior Conductor', 'Senior Officer', '2024-03-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(103, 24, 'Supporter', 'Supporter', '2024-01-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(104, 11, 'Senior Supervisor', 'Supporter', '2020-08-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(105, 30, 'Supporter', 'Senior Supporter', '2023-07-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(106, 33, 'Senior Conductor', 'Conductor', '2023-04-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(107, 35, 'Senior Conductor', 'Senior Manager', '2022-08-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(108, 32, 'Senior Executive', 'Supporter', '2021-02-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(109, 21, 'Conductor', 'Representative', '2024-08-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(110, 33, 'Supporter', 'Supervisor', '2020-10-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(111, 16, 'Manager', 'Senior Executive', '2021-08-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(112, 25, 'Representative', 'Senior Manager', '2020-04-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(113, 14, 'Officer', 'Supervisor', '2023-11-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(114, 18, 'Senior Executive', 'Senior Conductor', '2023-11-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(115, 29, 'Supporter', 'Senior Supporter', '2021-08-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(116, 24, 'Senior Conductor', 'Conductor', '2024-04-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(117, 16, 'Manager', 'Senior Conductor', '2020-10-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(118, 30, 'Manager', 'Officer', '2023-06-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(119, 26, 'Senior Manager', 'Senior Conductor', '2024-08-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(120, 23, 'Senior Supporter', 'Senior Conductor', '2022-09-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(121, 13, 'Conductor', 'Executive', '2021-09-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(122, 15, 'Representative', 'Senior Supervisor', '2023-02-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(123, 22, 'Supervisor', 'Officer', '2021-10-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(124, 23, 'Executive', 'Officer', '2020-11-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(125, 19, 'Senior Supervisor', 'Senior Manager', '2020-04-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(126, 23, 'Representative', 'Supporter', '2020-07-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(127, 18, 'Senior Supporter', 'Senior Supervisor', '2024-07-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(128, 20, 'Supervisor', 'Officer', '2024-12-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(129, 14, 'Supervisor', 'Officer', '2021-03-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(130, 30, 'Senior Supporter', 'Manager', '2024-06-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(131, 22, 'Senior Supervisor', 'Conductor', '2020-01-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(132, 13, 'Supporter', 'Supporter', '2021-07-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(133, 26, 'Executive', 'Supervisor', '2023-04-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(134, 28, 'Executive', 'Conductor', '2021-03-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(135, 13, 'Officer', 'Senior Manager', '2021-05-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(136, 14, 'Senior Supporter', 'Senior Officer', '2022-02-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(137, 28, 'Supervisor', 'Senior Conductor', '2021-07-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(138, 18, 'Senior Executive', 'Conductor', '2020-08-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(139, 13, 'Supervisor', 'Manager', '2024-07-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(140, 24, 'Senior Manager', 'Senior Supporter', '2020-10-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(141, 24, 'Conductor', 'Senior Officer', '2021-10-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(142, 16, 'Senior Executive', 'Representative', '2022-05-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(143, 20, 'Executive', 'Senior Supporter', '2023-08-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(144, 12, 'Supporter', 'Representative', '2021-06-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(145, 18, 'Senior Supporter', 'Senior Supervisor', '2023-07-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(146, 33, 'Senior Supervisor', 'Manager', '2023-03-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(147, 25, 'Senior Executive', 'Senior Supervisor', '2023-11-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(148, 26, 'Senior Manager', 'Senior Officer', '2024-02-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(149, 25, 'Representative', 'Senior Executive', '2023-12-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(150, 15, 'Senior Manager', 'Representative', '2021-09-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(151, 14, 'Executive', 'Senior Executive', '2020-02-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(152, 15, 'Representative', 'Senior Executive', '2023-07-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(153, 32, 'Senior Supervisor', 'Conductor', '2022-02-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(154, 28, 'Senior Executive', 'Senior Officer', '2020-11-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(155, 21, 'Senior Officer', 'Executive', '2023-11-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(156, 32, 'Conductor', 'Representative', '2021-07-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(157, 31, 'Senior Supervisor', 'Senior Supervisor', '2020-11-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(158, 29, 'Supervisor', 'Conductor', '2020-03-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(159, 18, 'Representative', 'Conductor', '2024-09-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(160, 31, 'Manager', 'Senior Officer', '2020-08-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(161, 31, 'Representative', 'Senior Manager', '2020-05-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(162, 20, 'Conductor', 'Senior Supervisor', '2023-08-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(163, 31, 'Senior Conductor', 'Senior Manager', '2023-12-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(164, 22, 'Senior Executive', 'Senior Conductor', '2024-11-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(165, 14, 'Supervisor', 'Executive', '2020-12-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(166, 16, 'Supporter', 'Senior Officer', '2021-07-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(167, 22, 'Officer', 'Senior Supervisor', '2021-08-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(168, 25, 'Supervisor', 'Senior Conductor', '2022-08-31', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(169, 11, 'Manager', 'Senior Supervisor', '2020-04-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(170, 13, 'Senior Supervisor', 'Supervisor', '2020-05-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(171, 35, 'Representative', 'Senior Officer', '2023-07-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(172, 12, 'Senior Officer', 'Senior Officer', '2024-01-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(173, 30, 'Representative', 'Senior Supporter', '2021-02-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(174, 14, 'Senior Officer', 'Supporter', '2020-04-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(175, 13, 'Officer', 'Representative', '2023-05-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(176, 28, 'Executive', 'Representative', '2023-03-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(177, 33, 'Manager', 'Senior Officer', '2023-06-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(178, 19, 'Senior Manager', 'Officer', '2020-12-31', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(179, 16, 'Senior Supporter', 'Senior Manager', '2023-05-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(180, 24, 'Representative', 'Supporter', '2024-11-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(181, 29, 'Conductor', 'Senior Officer', '2024-03-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(182, 30, 'Officer', 'Supporter', '2021-09-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(183, 16, 'Senior Executive', 'Representative', '2024-11-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(184, 12, 'Senior Executive', 'Senior Executive', '2022-11-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(185, 13, 'Senior Manager', 'Executive', '2024-07-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(186, 26, 'Senior Supporter', 'Senior Supporter', '2022-03-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(187, 30, 'Representative', 'Senior Executive', '2021-03-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(188, 33, 'Senior Conductor', 'Representative', '2022-11-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(189, 19, 'Representative', 'Senior Supervisor', '2022-09-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(190, 20, 'Senior Supervisor', 'Senior Supervisor', '2020-11-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(191, 33, 'Supervisor', 'Supervisor', '2021-10-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(192, 13, 'Manager', 'Senior Officer', '2020-11-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(193, 13, 'Senior Conductor', 'Senior Executive', '2021-12-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(194, 31, 'Conductor', 'Supervisor', '2024-01-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(195, 35, 'Senior Conductor', 'Manager', '2024-07-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(196, 27, 'Representative', 'Conductor', '2022-12-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(197, 15, 'Representative', 'Senior Supervisor', '2020-06-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(198, 17, 'Supervisor', 'Senior Conductor', '2021-02-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(199, 15, 'Executive', 'Representative', '2024-06-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(200, 21, 'Senior Manager', 'Executive', '2022-06-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(201, 17, 'Manager', 'Representative', '2020-07-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(202, 31, 'Conductor', 'Conductor', '2022-06-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(203, 25, 'Supervisor', 'Senior Manager', '2024-04-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(204, 13, 'Representative', 'Officer', '2022-06-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(205, 15, 'Senior Supervisor', 'Senior Executive', '2022-03-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(206, 25, 'Senior Officer', 'Representative', '2022-10-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(207, 22, 'Supporter', 'Officer', '2021-10-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(208, 15, 'Manager', 'Senior Conductor', '2024-08-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(209, 16, 'Senior Officer', 'Representative', '2023-01-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(210, 35, 'Executive', 'Senior Supporter', '2020-08-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(211, 29, 'Senior Supervisor', 'Senior Conductor', '2023-10-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(212, 18, 'Manager', 'Manager', '2023-07-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(213, 21, 'Senior Manager', 'Senior Executive', '2023-06-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(214, 13, 'Executive', 'Senior Supporter', '2021-11-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(215, 35, 'Supervisor', 'Supporter', '2022-05-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(216, 22, 'Senior Supervisor', 'Conductor', '2021-04-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(217, 32, 'Senior Officer', 'Officer', '2022-08-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(218, 31, 'Supervisor', 'Manager', '2022-09-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(219, 29, 'Executive', 'Senior Supervisor', '2021-09-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(220, 23, 'Senior Officer', 'Supporter', '2024-10-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(221, 31, 'Senior Supervisor', 'Executive', '2022-09-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(222, 20, 'Senior Executive', 'Senior Executive', '2023-05-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(223, 26, 'Senior Supervisor', 'Supporter', '2024-02-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(224, 22, 'Representative', 'Senior Conductor', '2023-06-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(225, 14, 'Senior Officer', 'Executive', '2020-06-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(226, 28, 'Supervisor', 'Conductor', '2020-09-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(227, 26, 'Representative', 'Conductor', '2024-12-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(228, 15, 'Senior Supporter', 'Representative', '2021-10-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(229, 16, 'Supervisor', 'Manager', '2023-04-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(230, 27, 'Senior Conductor', 'Senior Supervisor', '2020-01-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(231, 19, 'Representative', 'Supervisor', '2020-10-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(232, 15, 'Manager', 'Manager', '2020-11-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(233, 34, 'Senior Executive', 'Executive', '2022-10-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(234, 20, 'Senior Supervisor', 'Officer', '2024-04-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(235, 34, 'Manager', 'Supporter', '2020-04-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(236, 31, 'Supporter', 'Senior Officer', '2020-10-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(237, 30, 'Representative', 'Conductor', '2022-12-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(238, 34, 'Senior Supervisor', 'Senior Officer', '2021-12-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(239, 33, 'Manager', 'Senior Supervisor', '2020-07-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(240, 30, 'Supervisor', 'Supporter', '2023-03-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(241, 32, 'Senior Supervisor', 'Senior Manager', '2021-11-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(242, 28, 'Officer', 'Manager', '2022-03-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(243, 23, 'Executive', 'Senior Supporter', '2021-07-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(244, 31, 'Manager', 'Supporter', '2024-04-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(245, 12, 'Senior Officer', 'Supporter', '2024-06-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(246, 25, 'Senior Conductor', 'Senior Supporter', '2022-03-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(247, 26, 'Supervisor', 'Senior Executive', '2023-03-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(248, 14, 'Executive', 'Supervisor', '2024-05-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(249, 18, 'Senior Officer', 'Supervisor', '2022-07-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(250, 15, 'Representative', 'Manager', '2024-08-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(251, 17, 'Senior Supervisor', 'Manager', '2023-03-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(252, 14, 'Senior Officer', 'Executive', '2024-08-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(253, 20, 'Senior Manager', 'Supporter', '2023-05-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(254, 16, 'Senior Executive', 'Conductor', '2023-06-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(255, 22, 'Senior Supervisor', 'Senior Supervisor', '2024-09-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(256, 12, 'Conductor', 'Executive', '2020-08-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(257, 21, 'Senior Manager', 'Supervisor', '2021-08-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(258, 32, 'Officer', 'Representative', '2021-10-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(259, 34, 'Senior Officer', 'Senior Supporter', '2024-06-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(260, 14, 'Senior Supervisor', 'Senior Executive', '2023-08-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(261, 15, 'Supporter', 'Supporter', '2024-10-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(262, 27, 'Senior Officer', 'Officer', '2023-05-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(263, 12, 'Manager', 'Senior Officer', '2020-08-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(264, 27, 'Supervisor', 'Supporter', '2023-08-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(265, 32, 'Executive', 'Senior Manager', '2023-05-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(266, 24, 'Representative', 'Supporter', '2023-12-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(267, 20, 'Senior Officer', 'Supervisor', '2022-06-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(268, 15, 'Senior Officer', 'Manager', '2020-08-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(269, 18, 'Senior Manager', 'Supporter', '2024-10-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(270, 22, 'Manager', 'Supporter', '2022-11-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(271, 32, 'Manager', 'Supervisor', '2024-03-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(272, 19, 'Manager', 'Senior Manager', '2021-10-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(273, 16, 'Supervisor', 'Officer', '2024-09-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(274, 20, 'Senior Executive', 'Senior Manager', '2021-10-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(275, 21, 'Senior Supervisor', 'Senior Conductor', '2021-10-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(276, 21, 'Senior Officer', 'Manager', '2023-03-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(277, 33, 'Conductor', 'Manager', '2024-01-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(278, 18, 'Supervisor', 'Manager', '2022-09-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(279, 13, 'Senior Supervisor', 'Supporter', '2022-04-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(280, 15, 'Senior Officer', 'Manager', '2020-11-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(281, 11, 'Officer', 'Senior Officer', '2020-03-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(282, 25, 'Senior Manager', 'Representative', '2023-01-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(283, 34, 'Senior Conductor', 'Manager', '2021-05-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(284, 20, 'Senior Officer', 'Senior Supervisor', '2020-12-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(285, 13, 'Senior Conductor', 'Supporter', '2020-03-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(286, 34, 'Representative', 'Senior Conductor', '2023-03-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(287, 15, 'Supervisor', 'Executive', '2021-08-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(288, 18, 'Conductor', 'Senior Manager', '2024-11-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(289, 23, 'Supervisor', 'Senior Supervisor', '2023-08-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(290, 30, 'Senior Officer', 'Senior Officer', '2020-04-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(291, 14, 'Senior Conductor', 'Executive', '2021-07-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(292, 26, 'Senior Supervisor', 'Manager', '2022-12-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(293, 29, 'Senior Executive', 'Senior Supervisor', '2024-10-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(294, 23, 'Executive', 'Manager', '2024-03-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(295, 35, 'Supervisor', 'Conductor', '2023-03-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(296, 29, 'Representative', 'Senior Conductor', '2022-02-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(297, 30, 'Senior Supervisor', 'Officer', '2020-01-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(298, 16, 'Supervisor', 'Senior Supporter', '2021-01-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(299, 30, 'Manager', 'Officer', '2024-01-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(300, 21, 'Manager', 'Supervisor', '2022-02-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(301, 17, 'Supporter', 'Supporter', '2020-07-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(302, 22, 'Supervisor', 'Senior Supervisor', '2020-07-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(303, 33, 'Manager', 'Officer', '2024-05-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(304, 25, 'Conductor', 'Supporter', '2024-11-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(305, 31, 'Representative', 'Conductor', '2023-03-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(306, 30, 'Senior Supervisor', 'Supporter', '2023-10-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(307, 29, 'Manager', 'Supporter', '2020-10-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(308, 16, 'Supporter', 'Senior Conductor', '2023-03-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(309, 19, 'Senior Officer', 'Senior Supervisor', '2022-11-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(310, 11, 'Representative', 'Supporter', '2021-04-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(311, 22, 'Senior Executive', 'Executive', '2024-02-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(312, 12, 'Senior Supporter', 'Manager', '2024-09-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(313, 27, 'Representative', 'Senior Conductor', '2024-09-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(314, 17, 'Senior Manager', 'Supporter', '2021-03-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(315, 35, 'Officer', 'Supporter', '2020-05-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(316, 29, 'Senior Officer', 'Officer', '2024-08-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(317, 31, 'Officer', 'Senior Supporter', '2023-03-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(318, 30, 'Senior Manager', 'Representative', '2023-02-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(319, 28, 'Senior Executive', 'Senior Executive', '2023-07-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(320, 35, 'Senior Supporter', 'Executive', '2023-03-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(321, 23, 'Supervisor', 'Senior Manager', '2022-09-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(322, 33, 'Conductor', 'Senior Supervisor', '2022-04-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(323, 16, 'Officer', 'Conductor', '2022-05-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(324, 20, 'Senior Manager', 'Senior Executive', '2024-01-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(325, 23, 'Senior Manager', 'Manager', '2021-09-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(326, 24, 'Senior Conductor', 'Senior Supervisor', '2023-01-31', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(327, 13, 'Supporter', 'Senior Executive', '2024-01-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(328, 19, 'Supporter', 'Conductor', '2020-07-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(329, 29, 'Supervisor', 'Representative', '2021-05-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(330, 34, 'Senior Manager', 'Officer', '2022-01-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(331, 29, 'Conductor', 'Senior Manager', '2020-12-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(332, 34, 'Officer', 'Manager', '2023-06-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(333, 15, 'Senior Supporter', 'Supervisor', '2024-06-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(334, 26, 'Senior Supervisor', 'Supervisor', '2023-12-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(335, 34, 'Manager', 'Executive', '2024-03-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(336, 30, 'Conductor', 'Supervisor', '2023-04-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(337, 13, 'Senior Supervisor', 'Senior Conductor', '2022-08-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(338, 11, 'Executive', 'Supporter', '2024-08-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(339, 19, 'Representative', 'Senior Conductor', '2021-08-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(340, 29, 'Officer', 'Senior Conductor', '2023-09-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(341, 20, 'Senior Executive', 'Supporter', '2020-07-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(342, 13, 'Executive', 'Executive', '2021-02-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(343, 32, 'Senior Supervisor', 'Senior Executive', '2020-10-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(344, 20, 'Conductor', 'Conductor', '2020-02-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(345, 20, 'Senior Supporter', 'Senior Supervisor', '2020-02-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(346, 11, 'Senior Executive', 'Senior Officer', '2023-12-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(347, 35, 'Officer', 'Manager', '2020-03-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(348, 25, 'Senior Conductor', 'Senior Executive', '2023-11-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(349, 21, 'Senior Officer', 'Executive', '2022-04-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(350, 17, 'Representative', 'Senior Executive', '2022-11-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(351, 34, 'Supervisor', 'Senior Conductor', '2021-04-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(352, 21, 'Senior Officer', 'Conductor', '2023-11-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(353, 14, 'Senior Supervisor', 'Supporter', '2024-03-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(354, 35, 'Senior Supporter', 'Representative', '2023-12-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(355, 23, 'Executive', 'Representative', '2022-06-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(356, 14, 'Conductor', 'Conductor', '2022-01-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(357, 23, 'Senior Supervisor', 'Senior Executive', '2024-06-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(358, 32, 'Manager', 'Senior Supporter', '2021-11-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(359, 17, 'Senior Executive', 'Manager', '2023-08-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(360, 24, 'Manager', 'Senior Manager', '2024-12-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(361, 18, 'Senior Conductor', 'Conductor', '2023-10-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(362, 19, 'Manager', 'Supervisor', '2024-04-29', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(363, 28, 'Senior Supervisor', 'Senior Supporter', '2022-10-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(364, 21, 'Manager', 'Executive', '2023-01-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(365, 21, 'Officer', 'Senior Manager', '2023-06-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(366, 18, 'Senior Officer', 'Manager', '2022-05-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(367, 12, 'Manager', 'Executive', '2024-12-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(368, 11, 'Senior Conductor', 'Officer', '2020-05-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(369, 27, 'Executive', 'Executive', '2021-06-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(370, 22, 'Officer', 'Representative', '2023-01-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(371, 15, 'Senior Supervisor', 'Executive', '2023-12-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(372, 26, 'Supervisor', 'Senior Supervisor', '2024-09-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(373, 18, 'Representative', 'Executive', '2023-07-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(374, 12, 'Senior Officer', 'Senior Supporter', '2021-08-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(375, 20, 'Conductor', 'Representative', '2021-03-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(376, 17, 'Senior Conductor', 'Manager', '2021-08-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(377, 14, 'Senior Conductor', 'Senior Supervisor', '2023-02-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(378, 15, 'Representative', 'Officer', '2022-01-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(379, 14, 'Senior Supporter', 'Conductor', '2023-06-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(380, 13, 'Senior Supervisor', 'Senior Supporter', '2020-10-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(381, 11, 'Senior Supervisor', 'Conductor', '2020-03-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(382, 31, 'Senior Executive', 'Senior Manager', '2021-03-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(383, 34, 'Conductor', 'Senior Manager', '2022-03-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(384, 12, 'Supporter', 'Senior Executive', '2020-10-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(385, 35, 'Officer', 'Senior Officer', '2020-05-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(386, 16, 'Conductor', 'Senior Supporter', '2022-09-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(387, 18, 'Representative', 'Supporter', '2023-11-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(388, 15, 'Senior Executive', 'Representative', '2022-05-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(389, 11, 'Conductor', 'Executive', '2022-09-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(390, 29, 'Senior Officer', 'Supervisor', '2024-12-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(391, 15, 'Supervisor', 'Senior Officer', '2024-11-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(392, 17, 'Supervisor', 'Manager', '2020-04-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(393, 11, 'Supervisor', 'Senior Manager', '2021-10-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(394, 11, 'Senior Supporter', 'Manager', '2023-01-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(395, 13, 'Executive', 'Conductor', '2020-09-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(396, 22, 'Senior Executive', 'Supporter', '2022-09-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(397, 27, 'Representative', 'Manager', '2024-03-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(398, 16, 'Senior Supporter', 'Senior Supervisor', '2021-09-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(399, 18, 'Senior Supporter', 'Senior Manager', '2022-04-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(400, 26, 'Supporter', 'Supervisor', '2020-12-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(401, 17, 'Executive', 'Supervisor', '2022-07-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(402, 27, 'Officer', 'Senior Executive', '2021-09-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(403, 23, 'Supervisor', 'Manager', '2023-11-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(404, 30, 'Senior Manager', 'Manager', '2022-07-20', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(405, 33, 'Senior Conductor', 'Manager', '2020-11-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(406, 11, 'Senior Executive', 'Officer', '2021-09-09', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(407, 28, 'Officer', 'Senior Executive', '2022-12-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(408, 24, 'Executive', 'Supervisor', '2020-04-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(409, 35, 'Officer', 'Supporter', '2023-08-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(410, 21, 'Manager', 'Senior Supervisor', '2024-05-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(411, 27, 'Senior Officer', 'Conductor', '2020-01-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(412, 24, 'Senior Manager', 'Officer', '2023-03-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(413, 13, 'Manager', 'Executive', '2023-07-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(414, 27, 'Executive', 'Senior Supervisor', '2024-04-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(415, 21, 'Senior Executive', 'Conductor', '2024-07-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(416, 19, 'Supervisor', 'Representative', '2022-05-01', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(417, 23, 'Senior Executive', 'Senior Supervisor', '2024-05-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(418, 24, 'Senior Supporter', 'Conductor', '2021-02-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(419, 26, 'Supervisor', 'Officer', '2024-09-10', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(420, 19, 'Senior Conductor', 'Senior Supporter', '2024-04-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(421, 24, 'Senior Supporter', 'Representative', '2024-09-24', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(422, 14, 'Senior Officer', 'Supervisor', '2020-10-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(423, 17, 'Representative', 'Representative', '2024-03-15', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(424, 17, 'Senior Supervisor', 'Senior Manager', '2020-03-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(425, 30, 'Senior Manager', 'Senior Conductor', '2021-11-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(426, 35, 'Senior Conductor', 'Senior Executive', '2022-12-30', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(427, 34, 'Supervisor', 'Supporter', '2022-02-17', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(428, 11, 'Manager', 'Senior Conductor', '2024-01-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(429, 35, 'Senior Officer', 'Senior Supervisor', '2024-09-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(430, 31, 'Supporter', 'Executive', '2023-07-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(431, 12, 'Supporter', 'Senior Manager', '2021-09-12', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(432, 12, 'Supporter', 'Senior Executive', '2022-03-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(433, 16, 'Senior Executive', 'Supervisor', '2021-10-05', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(434, 34, 'Senior Supervisor', 'Conductor', '2022-06-23', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(435, 28, 'Manager', 'Supporter', '2021-09-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(436, 25, 'Executive', 'Representative', '2024-02-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(437, 34, 'Officer', 'Representative', '2020-12-14', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(438, 12, 'Officer', 'Manager', '2020-04-03', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(439, 14, 'Conductor', 'Executive', '2024-11-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(440, 18, 'Senior Officer', 'Supporter', '2020-03-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(441, 34, 'Officer', 'Manager', '2023-05-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(442, 23, 'Senior Manager', 'Supervisor', '2021-05-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(443, 24, 'Executive', 'Senior Supporter', '2023-06-04', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(444, 16, 'Senior Officer', 'Executive', '2020-10-26', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(445, 24, 'Senior Officer', 'Senior Officer', '2020-11-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(446, 29, 'Senior Conductor', 'Executive', '2021-12-19', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(447, 17, 'Representative', 'Senior Supervisor', '2020-08-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(448, 16, 'Officer', 'Senior Supervisor', '2020-01-07', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(449, 29, 'Senior Executive', 'Supporter', '2022-09-22', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(450, 33, 'Conductor', 'Executive', '2022-04-16', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(451, 16, 'Manager', 'Senior Officer', '2023-08-25', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(452, 16, 'Senior Supervisor', 'Conductor', '2023-02-11', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(453, 18, 'Executive', 'Senior Manager', '2022-06-21', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(454, 11, 'Manager', 'Senior Manager', '2021-12-18', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(455, 20, 'Senior Supervisor', 'Executive', '2021-01-08', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(456, 20, 'Officer', 'Manager', '2024-02-02', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(457, 21, 'Officer', 'Manager', '2021-11-27', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(458, 27, 'Senior Executive', 'Senior Supervisor', '2023-02-13', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(459, 18, 'Senior Manager', 'Senior Supporter', '2022-05-06', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(460, 32, 'Conductor', 'Executive', '2022-02-28', '2025-01-26 17:59:39', '2025-01-26 17:59:39'),
(468, 12, 'Officer', 'Senior Supervisor', '2025-01-27', '2025-01-27 18:37:54', '2025-01-27 18:37:54'),
(469, 12, 'Senior Supervisor', 'Senior Officer', '2025-01-27', '2025-01-27 18:38:12', '2025-01-27 18:38:12'),
(482, 12, 'Senior Officer', 'Executive', '2025-02-20', '2025-02-20 11:32:02', '2025-02-20 11:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

DROP TABLE IF EXISTS `titles`;
CREATE TABLE IF NOT EXISTS `titles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('manager','employee') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `name`, `category`, `rank`, `created_at`, `updated_at`) VALUES
(49, 'Manager', 'manager', 1, '2025-01-17 17:50:15', '2025-02-20 11:55:41'),
(50, 'Senior Manager', 'manager', 0, '2025-01-17 17:50:18', '2025-02-20 11:55:41'),
(5, 'Senior Executive', 'manager', 2, '2025-01-14 17:14:03', '2025-02-20 11:55:41'),
(6, 'Executive', 'manager', 3, '2025-01-14 17:14:08', '2025-02-20 11:55:41'),
(7, 'Officer', 'manager', 5, '2025-01-14 17:14:17', '2025-02-20 11:55:41'),
(8, 'Senior Officer', 'manager', 4, '2025-01-14 17:14:21', '2025-02-20 11:55:41'),
(9, 'Senior Supervisor', 'manager', 6, '2025-01-14 17:16:33', '2025-02-20 11:55:41'),
(11, 'Supervisor', 'manager', 7, '2025-01-14 17:25:50', '2025-02-20 11:55:41'),
(16, 'Representitve', 'employee', 8, '2025-01-14 17:28:59', '2025-02-20 11:55:41'),
(17, 'Senior Conductor', 'employee', 9, '2025-01-14 17:29:12', '2025-02-20 11:55:41'),
(44, 'Supporter', 'employee', 12, '2025-01-14 18:08:04', '2025-02-20 11:55:41'),
(47, 'Senior Supporter', 'employee', 11, '2025-01-14 18:17:29', '2025-02-20 11:55:41'),
(46, 'Conductor', 'employee', 10, '2025-01-14 18:17:10', '2025-02-20 11:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `training_steps`
--

DROP TABLE IF EXISTS `training_steps`;
CREATE TABLE IF NOT EXISTS `training_steps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `step_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_steps`
--

INSERT INTO `training_steps` (`id`, `name`, `step_order`, `created_at`, `updated_at`, `color`) VALUES
(1, 'To Interview with Silva', 0, '2025-02-21 04:28:02', '2025-02-21 09:28:48', '#ededed'),
(2, 'To Interview with The HR Manager', 1, '2025-02-21 04:28:58', '2025-02-21 09:28:48', '#9ffeb2'),
(9, 'Ready', 6, '2025-02-21 09:58:21', '2025-02-21 09:58:21', '#ffc894'),
(5, 'God Father Training', 4, '2025-02-21 04:52:04', '2025-02-21 09:28:48', '#ff7070'),
(6, 'Started Training', 2, '2025-02-21 04:54:20', '2025-02-21 09:28:48', '#a8a8a8'),
(7, 'Training Completed', 5, '2025-02-21 04:54:58', '2025-02-21 09:28:48', '#94eaff'),
(8, 'Training Finished', 3, '2025-02-21 09:28:45', '2025-02-21 09:28:48', '#fffb94');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `old_branch_id` bigint UNSIGNED NOT NULL,
  `new_branch_id` bigint UNSIGNED NOT NULL,
  `vacancy_id` bigint UNSIGNED DEFAULT NULL,
  `transfer_start_date` date DEFAULT NULL,
  `transfer_date` date NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Transfer',
  `rotation_duration` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfers_employee_id_foreign` (`employee_id`),
  KEY `transfers_old_branch_id_foreign` (`old_branch_id`),
  KEY `transfers_new_branch_id_foreign` (`new_branch_id`),
  KEY `transfers_vacancy_id_foreign` (`vacancy_id`),
  KEY `transfers_created_by_foreign` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `employee_id`, `old_branch_id`, `new_branch_id`, `vacancy_id`, `transfer_start_date`, `transfer_date`, `created_by`, `type`, `rotation_duration`, `created_at`, `updated_at`) VALUES
(19, 24, 23, 33, 87, '2025-02-03', '2025-01-25', 2, 'Transfer', NULL, '2025-01-25 14:40:24', '2025-01-25 14:40:24'),
(27, 12, 54, 66, NULL, '2025-02-12', '2025-02-12', 1, 'Trasnfer', NULL, '2025-02-12 08:46:25', '2025-02-12 08:46:25'),
(154, 28, 67, 66, NULL, '2025-02-17', '2025-02-17', 5, 'Transfer', NULL, '2025-02-17 07:48:00', '2025-02-17 07:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `temp_pass` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `status`, `temp_pass`) VALUES
(1, 'Tarek Badawi', 'services5@maliks.com', NULL, '$2y$12$hPLgBQRZjQgJL3tEt9BiQOF7BRV1DdeccAg2MYTAmQSQADz1R6jcG', 'user-images/J9eBOicIyGJ4XzYChWxNbcH6BMl2DcOYoIjlPWAz.jpg', 'fiEWorNuGioB25M5QRXyjDrSwTtjdsajXUOU1xvFTTZuMvLIqpp6FmDLUDmv', '2025-01-20 18:27:11', '2025-02-20 09:19:55', 'active', '$2y$12$acIxBRDWSlXjOMifYn204OBuaUqGVw0xKws6tQCnbcPB0LUUTEyCu'),
(2, 'Mira Mahmoud', 'mira99mahmoud@gmail.com', NULL, '$2y$12$TWRcREdVMlM0HeC.s2xHxOaBDTQ1QITuIwIrkQJrUWnzuaeUlSnhe', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg', NULL, '2025-01-20 18:29:16', '2025-02-13 08:35:42', 'active', '$2y$12$r.wtfwZQstq65DUlLDRQLOfRGRAgivyoboiGZrJUgan0gbZLl3G4O'),
(3, 'Tania Khadaj', 'hr@maliks.com', NULL, '$2y$12$rGXX3cqxXQjVJlB3H.0JZeO.I0HxLHO4e5RLyqivHUH7wO6k70EQu', 'user-images/4sHVrZmMT4Gs7Bf3JWNT2p43X0kVXxv84CSNVkS9.jpg', NULL, '2025-01-22 05:53:08', '2025-02-13 06:58:58', 'active', NULL),
(5, 'Shadi Farhat IT', 'it@maliks.com', NULL, '$2y$12$yxlooCHbh7/QGhk3LErwKeEViH0mtlOfglwgIALgi6DBrMAB04qr6', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg', NULL, '2025-02-13 12:49:12', '2025-02-20 08:08:36', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

DROP TABLE IF EXISTS `vacancies`;
CREATE TABLE IF NOT EXISTS `vacancies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `job` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asked_date` date NOT NULL,
  `completed_date` date DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_finished` tinyint(1) NOT NULL DEFAULT '0',
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vacancies_branch_id_foreign` (`branch_id`),
  KEY `vacancies_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `branch_id`, `job`, `asked_date`, `completed_date`, `status`, `is_finished`, `employee_id`, `image_path`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 32, 'Cashier', '2025-01-16', '2025-01-16', 'high', 1, 35, 'images/6786cb296206d.jpg', NULL, '2025-01-16 19:02:04', '2025-01-16 19:27:26'),
(18, 32, 'Graphic designer', '2025-01-18', '2025-01-18', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-18 18:47:14', '2025-01-18 18:47:20'),
(4, 30, 'Manager', '2025-01-16', '2025-01-18', 'high', 1, 17, 'images/677551466565f.jpg', NULL, '2025-01-16 19:02:30', '2025-01-18 18:52:14'),
(6, 49, 'Cashier', '2025-01-16', '2025-01-18', 'low', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-16 19:11:03', '2025-01-18 19:04:51'),
(17, 20, 'Graphic designer', '2025-01-18', '2025-01-18', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-18 18:41:34', '2025-01-18 18:41:44'),
(10, 23, 'Cashier', '2025-01-16', '2025-01-18', 'high', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-16 19:11:50', '2025-01-18 18:49:05'),
(14, 9, 'Cashier', '2025-01-18', '2025-01-18', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 18:30:55', '2025-01-18 18:58:48'),
(12, 34, 'Stationery', '2025-01-16', '2025-01-18', 'low', 1, 13, 'images/67751ed18a32b.png', NULL, '2025-01-16 19:12:29', '2025-01-18 18:55:43'),
(16, 42, 'Graphic designer', '2025-01-18', '2025-01-18', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-18 18:37:46', '2025-01-18 18:37:56'),
(19, 23, 'Cashier', '2025-01-18', '2025-01-18', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:01:32', '2025-01-18 19:01:40'),
(20, 9, 'Cashier', '2025-01-18', '2025-01-18', 'high', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:06:41', '2025-01-18 19:06:50'),
(21, 13, 'Cashier', '2025-01-18', '2025-01-18', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:07:18', '2025-01-18 19:09:59'),
(22, 32, 'Cashier', '2025-01-18', '2025-01-18', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:10:10', '2025-01-18 19:11:33'),
(23, 22, 'Cashier', '2025-01-18', '2025-01-18', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:11:42', '2025-01-18 19:19:25'),
(28, 49, 'Cashier', '2025-01-18', '2025-01-19', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-18 19:27:11', '2025-01-19 08:09:09'),
(29, 30, 'Graphic designer', '2025-01-18', '2025-01-18', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-18 19:29:08', '2025-01-18 20:22:17'),
(55, 22, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 07:27:58', '2025-01-19 07:28:07'),
(52, 49, 'Joker', '2025-01-19', '2025-01-19', 'high', 1, 27, 'images/6784ca893ef5a.jpg', NULL, '2025-01-19 06:22:44', '2025-01-19 08:01:03'),
(54, 11, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 07:24:02', '2025-01-19 07:24:16'),
(56, 11, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 07:30:22', '2025-01-19 07:32:39'),
(57, 32, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 07:33:37', '2025-01-19 08:01:38'),
(58, 32, 'Cashier', '2025-01-19', '2025-01-19', 'medium', 1, 15, 'images/677529365d3cf.png', NULL, '2025-01-19 08:09:57', '2025-01-19 08:12:46'),
(59, 11, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 08:17:40', '2025-01-19 08:17:54'),
(60, 32, 'Cashier', '2025-01-19', '2025-01-19', 'medium', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 08:20:56', '2025-01-19 08:21:07'),
(61, 11, 'Graphic designer', '2025-01-19', '2025-01-19', 'high', 1, 12, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 08:22:08', '2025-01-19 08:24:54'),
(62, 32, 'Graphic designer', '2025-01-19', '2025-01-19', 'low', 1, 22, 'images/677c4bc6c63dd.png', NULL, '2025-01-19 08:24:54', '2025-01-19 08:35:31'),
(63, 33, 'Stationery', '2025-01-19', '2025-01-19', 'low', 1, 22, 'images/677c4bc6c63dd.png', NULL, '2025-01-19 08:35:31', '2025-01-19 08:38:44'),
(64, 33, 'Stationery', '2025-01-19', '2025-01-19', 'high', 1, 22, 'images/677c4bc6c63dd.png', NULL, '2025-01-19 08:40:22', '2025-01-19 08:40:34'),
(84, 11, 'Graphic designer', '2025-01-19', NULL, 'high', 0, NULL, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 18:46:30', '2025-02-12 08:35:55'),
(88, 23, 'Graphic designer', '2025-01-25', NULL, 'high', 0, NULL, NULL, NULL, '2025-01-25 14:40:24', '2025-01-25 14:40:24'),
(93, 32, 'Cashier', '2025-02-20', NULL, 'high', 0, NULL, NULL, NULL, '2025-02-20 11:35:35', '2025-02-20 11:35:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
