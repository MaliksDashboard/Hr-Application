-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2025 at 02:32 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;

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
(67, 'Test Branch', 'This is a test', 'mira99mahmoud@gmail.com', 'services4@maliks.com', '2025-02-14 04:20:17', '2025-02-14 04:20:17', 33.89939940687, 35.480693025648),
(68, 'Hazmieh', 'Hazmieh - Facing Pepsi', 'hazmieh@maliks.com', 'hazmiehorders@gmail.com', '2025-02-25 07:36:46', '2025-02-25 07:36:46', 33.85353543190929, 35.54116978570919),
(69, 'Books and Pens UP', '3F - Bliss', 'rima@maliks.com', 'bpup@maliks.com', '2025-02-25 16:05:08', '2025-02-25 16:05:08', 33.899049331887, 35.481445958457),
(70, 'Gizmo ABC Verdun', 'ABC Verdun', 'gizmoabc@maliks.com', 'gizmo@gizmo.com', '2025-02-25 16:05:42', '2025-02-28 12:31:16', 33.994575667225, 35.604467812154),
(71, 'Gizmo City Mall', 'City Mall Dora', 'gizmocm@maliks.com', 'gizmocm@maliks.com', '2025-02-25 16:06:19', '2025-02-25 16:06:19', 33.896972043263, 35.564585739141),
(72, 'Gizmo Le Mall  Dbayeh', 'Le Mall Dbayeh', 'gizmolm@maliks.com', 'gizmolm@maliks.com', '2025-02-25 16:06:53', '2025-02-25 16:06:53', 33.929972610123, 35.588701496813),
(73, 'Head Office', '3F - Bliss', 'test@test.com', 'test@test.com', '2025-02-25 16:07:23', '2025-02-25 16:07:23', 33.899049331887, 35.481445958457),
(74, 'Lab88', 'Hamra Main Road', 'lab88@maliks.com', 'lab88@maliks.com', '2025-02-25 16:07:52', '2025-02-25 16:07:52', 33.895756878055, 35.48354064099),
(75, 'Standby', '3F - Bliss', 'standby@maliks.com', 'standby@maliks.com', '2025-02-25 16:08:16', '2025-02-25 16:08:16', 33.899049331887, 35.481445958457),
(76, 'Trainers', '3F - Bliss', 'trainer@maliks.com', 'trainer@maliks.com', '2025-02-25 16:08:36', '2025-02-25 16:08:36', 33.899049331887, 35.481445958457),
(77, 'WH2', 'Verdun', 'wh2@maliks.com', 'wh2orders@maliks.com', '2025-02-25 16:09:12', '2025-02-25 16:09:12', 33.886554176858, 35.482059896812),
(78, 'Whole Sale', 'Jnah', 'wholesale@maliks.com', 'wholesale1@maliks.com', '2025-02-25 16:09:38', '2025-02-25 16:09:38', 33.871271350883, 35.484290942838);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:19:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"Dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:8;i:1;i:9;i:2;i:10;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"Users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"Calendar & Tools\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:8;i:1;i:9;i:2;i:10;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"Vacancies\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"New Joiners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"Trasnfers/Rotation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"Promotions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"Badge Maker\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:8;i:1;i:9;i:2;i:10;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"Employees\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:8:\"Branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:8;i:1;i:9;i:2;i:10;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:6:\"Titles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:8:\"Settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:8;i:1;i:9;i:2;i:10;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:4:\"Edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:8:\"Download\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:6:\"Create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:6:\"Delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"Role And Permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:9:\"HR Member\";s:1:\"c\";s:3:\"web\";}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:7:\"Sundays\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"HR Team Member\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:8:\"Services\";s:1:\"c\";s:3:\"web\";}}}', 1740824366);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `left_date` date DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_info_branch_id_foreign` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=455 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `name`, `branch_id`, `title`, `status`, `date_hired`, `pin_code`, `email`, `phone`, `car`, `address`, `image_path`, `created_at`, `updated_at`, `job`, `left_date`, `birthday`) VALUES
(1, 'Pamela Chamoun', 32, 'Officer', 1, '2019-07-02', '2334', 'pamelachamoun99@hotmail.com', '71067605', 'No', 'Furn Al Chebak', 'images\\pamela chamoun.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(2, 'Aya Al Kaissi', 32, 'Specialist', 1, '2021-05-25', '1620', 'ayakaissi8@gmail.com', '70/625 655', 'No', 'Baissour', 'images\\aya al kaissi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(3, 'Maha Siblini', 32, 'Supervisor', 1, '2024-04-30', '2055', '', '', 'Moto', '', 'images\\maha siblini.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(4, 'Abed Majed', 32, 'Junior Joker', 1, '2023-12-12', '2102', 'abedm7213@gmail.com', '03-039363', 'Moto', 'Aramoun', 'images\\abed majed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(5, 'Rashad Al Mohtar', 32, 'Supporter', 1, '2023-11-22', '1304', 'rashadmohtar612@gmail.com', '78-972407', 'No', 'Aramoun', 'images\\rashad al mohtar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(6, 'Leen Abou Assaf', 32, 'Team Member', 1, '2024-09-19', '1914', NULL, '78-862300', 'Moto', 'Deir Qoubel', 'images/67be11b6ed57d.png', '2025-02-24 22:00:00', '2025-02-25 16:53:43', 'Cashier', NULL, NULL),
(7, 'Amina Al Ashy', 32, 'Team Member', 1, '2024-09-07', '1428', 'aminaalashi0@gmail.com', '81-837933', 'No', 'Aramoun', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Back Office', NULL, NULL),
(8, 'Leah Shami', 32, 'Supporter', 1, '2024-08-22', '1671', 'leyashami@gmail.com', '76-023236', 'Yes', 'Aramoun', 'images\\leah shami.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(9, 'Bassim Hajj Sleiman', 32, 'Junior Services', 1, '2023-10-04', '1609', '', '76-108912', 'Moto', 'Chiyah', 'images\\bassim hajj sleiman.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(10, 'Mohamad Reslan', 11, 'Officer', 1, '2018-11-09', '2835', 'reslanmohammad50@gmail.com ', '76/014672', 'Moto', 'Hadath ', 'images\\Mohamad Reslan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(11, 'Alaa Faisal', 11, 'Supervisor', 1, '2021-04-28', '2613', 'alaafaysal597@gmail.com', ' 71 599 543', 'Yes', 'Aley', 'images\\Alaa Faisal.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(12, 'Wissam Fakhereddine', 11, 'Supporter', 1, '2023-11-08', '2818', 'wesam.fakhreddine@gmail.com', '71 208 330', 'No', 'Saadiyat', 'images\\wissam fakhereddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(13, 'Ali Chehab', 11, 'Senior Supporter  ', 1, '2013-09-24', '2093', '', '70-950642', 'Moto', 'Al Shiyah ', 'images\\ali chehab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(14, 'Faten Abozour', 11, 'Supporter', 1, '2023-06-01', '2548', 'danielakaz66@gmail.com', '71-639174', 'No', 'Choueifat', 'images\\Faten Abozour.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(15, 'Haydar Fakhreddine', 11, 'Team Member', 1, '2024-08-21', '2837', 'haydarfakhreddine051@gmail.com', '71-440732', 'Moto', 'Msaytbeh ', 'images\\Haydar Fakhreddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(16, 'Pressica Joudieh', 11, 'Junior Cashier', 1, '2024-07-04', '2186', 'pressicajoudieh@gmail.com', '70 361448', 'No', 'Aley', 'images\\Pressica Joudieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(17, 'Abed El Karim Masri', 11, 'Team Member', 1, '2024-07-03', '1583', 'abed.masrii1212@gmail.com', '71-317619', 'No', 'Sanayeh', 'images\\Abed El Karim Masri.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(18, 'Ziad Sakr', 11, 'Team Member', 1, '2024-03-18', '2239', 'zeiadsakr83@gmail.com', '71-193628', 'No', 'Choueifat', 'images\\Ziad Sakr.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(19, 'Ahmad Kharoub', 11, 'Junior Services', 1, '2023-08-04', '2659', '202212308@ua.edul.lb', '71-203770', 'No', 'Choueifat', 'images\\ahmad kharoub.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(20, 'Ahmad Habhab', 11, 'Team Member', 1, '2024-07-05', '1422', 'habhabahmad551@gmail.com', '76-723886', 'No', 'Salim Slem', 'images\\Ahmad Habhab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(21, 'Mazen Halabi', 11, 'Team Member', 1, '2024-12-02', '1014', 'mazennhalabi@gmail.com', '71-257982', 'No', 'Aramoun', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(22, 'Ourabi Fayed', 22, 'Manager', 1, '2005-07-01', '135', 'Ourabi.fayed@gmail.com', '70790941', 'Yes', 'Mazraa', 'images\\Ourabi Fayed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(23, 'Rawana Deeb', 22, 'Senior Supervisor', 1, '2020-10-01', '2819', 'ranawadeeb@gmail.com', '71 782 501', 'Yes', 'Baabda', 'images\\Rawana Deeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(24, 'Firas Khair El Deen', 22, 'Representative', 1, '2015-11-03', '2485', 'firasK.deen@gmail.com', '03/007390', 'Yes', 'Hadath', 'images\\Firas Khair El Deen.png', '2025-02-24 22:00:00', '2025-02-25 16:39:39', 'Graphic Designer', NULL, NULL),
(25, 'Paul Kazan', 22, 'Representative', 1, '2013-12-02', '2120', 'kazanpaul@hotmail.com', '70-615082', 'Yes', 'Achrafieh ', 'images\\Paul Kazan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(26, 'Farah Abdel Khalek', 22, 'Senior Supporter', 1, '2023-04-04', '2172', 'akfarah85@gmail.com', '76-435091', 'No', 'Majdel Baana', 'images\\Farah Abdel Khalek.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(27, 'Omar Al Barakeh', 22, 'Back Office', 1, '2017-03-21', '2694', 'omar-nasser-1985@hotmail.com', '70-048717', 'Moto', 'Tarik Jdideh ', 'images\\Omar Al Barakeh.png', '2025-02-24 22:00:00', '2025-02-25 16:40:11', 'Delivery', NULL, NULL),
(28, 'Fadia Yassine', 67, 'Supporter', 1, '2023-08-30', '2814', 'fadia.yassine.1@icloud.com', '70-022469', 'No', 'Tayouneh', 'images\\Fadia Yassine.png', '2025-02-24 22:00:00', '2025-02-26 06:20:27', 'Stationery Sales Force', NULL, NULL),
(29, 'Abbas Maaz', 22, 'Team Member', 1, '2023-09-11', '1519', 'abbbasmaaz@gmail.com', '71-136689', 'Moto', 'Mreiji', 'images\\abbas maaz.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(30, 'Ahmad Watwat', 22, 'Senior Supporter', 1, '2022-08-09', '1447', 'ahmadwatwat000@gmail.com', '81 639 246', 'No', 'Dinnawi', 'images\\ahmad watwat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(31, 'Nayroun Ghallab', 22, 'Team Member', 1, '2024-09-16', '2729', 'nayrounghallab816@gmail.com', '76-648342', 'No', 'Kfarmatta', 'images\\Nayroun Ghallab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(32, 'Pamela Chebly', 22, 'Team Member', 1, '2024-09-06', '1463', 'pamelachebly@gmail.com', '81-758602', 'No', 'Ein El Remmeneh', 'images\\Pamela Chebly.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Back Office', NULL, NULL),
(33, 'Imad Yousef', 22, 'Team Member', 1, '2023-05-09', '2453', 'imadyssf77@gmail.com', '81 611 756', 'No', 'Sawfar', 'images\\imad yousef.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(34, 'Aline Al Dassouki', 22, 'Team Member', 1, '2024-02-13', '1376', 'alinedassouki4@gmail.com', '76-838279', 'No', 'Madini Riyadiyi ', 'images\\Aline Al Dassouki.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(35, 'Mohamad Dia', 22, 'Supporter', 1, '2023-12-09', '1341', 'diamohamad111@gmail.com', '71-595145', 'Moto', 'Bir Hassan', 'images\\Mohamad Dia.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(36, 'Ahmad Karim Tlais', 22, 'Team Member', 1, '2024-09-11', '2076', 'ahmadkarimtleiss@gmail.com', '81-818652', 'Yes', 'Jamhour', 'images\\Ahmad Karim Tlais.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(37, 'Nazik Baddereddine', 51, 'Supervisor', 1, '2015-12-30', '2503', 'nano_alhariri_maqo@hotmail.com', '03-188253', 'Yes', 'Rihab', 'images\\nazik baddereddine.png', '2025-02-24 22:00:00', '2025-02-25 16:40:31', 'Team Leader', NULL, NULL),
(38, 'Hadi Majed', 51, 'Supporter', 1, '2023-11-28', '1134', '', '', 'Moto', '', 'images\\hadi majed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(39, 'Mohamad Al Eter', 26, 'Manager', 1, '2008-06-18', '1060', 'eter.mohammad@gmail.com', '76100031', 'Yes', '', 'images/67be119f297c6.png', '2025-02-24 22:00:00', '2025-02-25 16:53:19', 'Team Leader', NULL, NULL),
(40, 'Alaa Abdul Khalik', 26, 'Specialist', 1, '2018-06-05', '2763', 'alaa77@yahoo.com', '70/736793', 'No', 'Aramoun ', 'images\\Alaa Abdul Khalik.png', '2025-02-24 22:00:00', '2025-02-25 16:40:48', 'Computer Operator', NULL, NULL),
(41, 'Rawan Al Mir', 26, 'Supporter', 1, '2023-01-11', '2257', 'rawanelmir@icloud.com', '71-312392', 'No', 'Cornishe Al Mazraa', 'images\\Rawan Al Mir.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(42, 'Farah Haidar', 26, 'Team Member', 1, '2024-08-08', '1384', 'farahhaidar56@gmail.com', '71-254235', 'No', 'Mejdlaya', 'images\\farah haidar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(43, 'Khaled Al Hafi', 26, 'Supporter', 1, '2023-05-01', '2427', 'hafikhaled0@gmail.com', '76-140542', 'Yes', 'Aramoun', 'images\\Khaled Al Hafi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(44, 'Gia Mkahal', 26, 'Supporter', 1, '2023-01-10', '2243', 'giamkahal@gmail.com', '81-036915', 'No', 'Dahye', 'images\\Gia Mkahal.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(45, 'Jihad Fakher', 69, 'Specialist', 1, '1996-01-04', '177', '', '71 941 793', 'No', 'Batloun', 'images\\jihad fakher.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office ', NULL, NULL),
(46, 'Mahasen Rizk', 69, 'Representative', 1, '2015-10-13', '2480', 'm.rizik@icloud.com', '78-811716', 'No', 'Msaytbeh ', 'images\\Mahasen Rizk.png', '2025-02-24 22:00:00', '2025-02-25 16:41:05', 'Books', NULL, NULL),
(47, 'Hussien Daiss', 30, 'Senior Officer', 1, '2011-06-11', '1779', 'Husseindaiss@gmail.com', '70652332', 'Yes', 'Airport Road', 'images\\Hussien Daiss.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(48, 'Ibrahim Akkari', 30, 'Specialist', 1, '2019-05-01', '2360', 'ibrahim_akri@hotmail.com', '78869076', 'Moto', 'Khaldeh', 'images\\Ibrahim Akkari.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(49, 'Omar Faraj', 30, 'Senior Supporter', 1, '2024-01-22', '1183', 'omar.zolfe@gmail.com', '03-097657', 'Moto', 'Kaskas', 'images\\Omar Faraj.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(50, 'Wafic Doughan', 30, 'Supervisor', 1, '2014-09-11', '1257', 'wafic.doughan@hotmail.com', '76-704544', 'Yes', 'Madini Riyadiyi ', 'images\\Wafic Doughan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(51, 'Nadine Faysal', 30, 'Team Member', 1, '2024-07-04', '2034', 'nadinefaisal53@gmail.com', '81 932191', 'No', 'Ain Dara', 'images\\Nadine Faysal.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(52, 'Loulwa Koronfol', 30, 'Team Member', 1, '2024-11-27', '1390', 'l.kronful@gmail.com', '71-206426', 'No', 'Tarik Al Jdideh', 'images\\loulwa koronfol.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(53, 'Ahmad Dgheim', 30, 'Team Member', 1, '2024-08-21', '1321', 'ahmaddgheim3@gmail.com', '70-739145', 'No', 'Mokhayam L Borj', 'images\\ahmad dgheim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(54, 'Ali Wehbe', 30, 'Team Member', 1, '2024-07-12', '1283', 'aliwehbe2021@gmail.com', '81 823031', 'Moto', 'Basta', 'images\\Ali Wehbe.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(55, 'Mohamad Eido', 30, 'Team Member', 1, '2024-07-05', '2027', 'mhmdeido62@gmail.com', '81-801730', 'Moto', 'Ras Al Nabea', 'images\\Mohamad Eido.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(56, 'Ali Awwad', 30, 'Team Member', 1, '2024-06-27', '2827', 'alizu.awwd@gmail.com', '81-357897', 'No', 'Burj Al Barajneh', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(57, 'Marwan Barakat', 21, 'Officer', 1, '2023-05-17', '2493', '', '', 'Moto', '', 'images\\Marwan Barakat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(58, 'Maya Khodor', 21, 'Coordinator', 1, '2015-07-23', '2430', 'maya_khodor@hotmail.com', '71-326113', 'No', 'Kabreshmoun', 'images\\Maya Khodor.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(59, 'Ihab Timani', 21, 'Supervisor', 1, '2023-02-08', '2315', 'ihabtimani@hotmail.com', '70-008795', 'Yes', 'Aley', 'images\\Ihab Timani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(60, 'Rania Abi Ghannam', 21, 'Specialist', 1, '2010-12-21', '1676', 'ranialife25@hotmail.com', '71-019892', 'No', 'Aramoun', 'images\\Rania Abi Ghannam.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(61, 'Rim Al Mounla', 21, 'Specialist ', 1, '2023-01-01', '1469', 'rimmounla129@gmail.com', '76-661573', 'No', 'Bchamoun', 'images\\Rim Al Mounla.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(62, 'Hanin Mekkawi', 21, 'Senior Supporter', 1, '2022-04-01', '2035', 'hanin.mekkawi18@gmail.com', '76-634931', 'No', 'Aramoun', 'images\\Hanin Mekkawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(64, 'Daniel Akaz', 21, 'Junior Services', 1, '2022-11-02', '1981', 'danielakaz66@gmail.com', '76 169 109', 'No', 'Choueifat', 'images\\Daniel Akaz.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(65, 'Asya Ghonash', 21, 'Junior Stationery', 1, '2024-02-09', '1395', 'asyaghonash001@gmail.com', '71-223700', 'No', 'Aramoun', 'images\\Asya Ghonash.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(66, 'Jana Kahwaji', 21, 'Senior Supporter', 1, '2021-08-31', '1420', 'janakahwaji123@gmail.com', '76-402083', 'No', 'Bchamoun', 'images\\Jana Kahwaji.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(67, 'Nour Al Deeb', 21, 'Supporter', 1, '2023-02-21', '2303', 'ndeeb8623@gmail.com', '70-762005', 'No', 'Basatin', 'images\\Nour Al Deeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(68, 'Hussein Abbas', 42, 'Senior Officer', 1, '2002-05-14', '106', 'Husseinabbas008@gmail.com', '71167089', 'Yes', 'Haret hreik', 'images\\Hussein Abbas.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(69, 'Roy Merhej', 42, 'Senior Supervisor', 1, '2018-04-12', '1370', 'roy_merhej@hotmail.com', '71/245730', 'No', 'Mansourieh ', 'images\\Roy Merhej.png', '2025-02-24 22:00:00', '2025-02-25 16:41:19', 'Team Leader', NULL, NULL),
(70, 'Saaddine Hachem', 42, 'Senior Supporter', 1, '2016-12-07', '2641', 'saadhm990@gmail.com', '71-319851', 'Moto', 'Tarik Jdideh ', 'images\\Saaddine Hachem.png', '2025-02-24 22:00:00', '2025-02-25 16:47:06', 'Computer Operator', NULL, NULL),
(71, 'Hanin Ismail', 42, 'Junior Cashier', 1, '2023-04-14', '2428', 'haninismail875@gmail.com', '81-843890', 'No', 'Sarahmoul', 'images\\Hanin Ismail.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(72, 'Lewaa Ghraizy', 42, 'Supporter', 1, '2023-05-01', '2432', 'lewaa300@gmail.com', '71-822664', 'Yes', 'Btater/Aley', 'images\\Lewaa Ghraizy.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(73, 'Abir Hareb', 42, 'Senior Supporter', 1, '2022-07-20', '1534', 'hareb.abirr@gmail.com', '71-547057', 'No', 'Tahwit Al Ghadir', 'images\\Abir Hareb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(74, 'Rasha Hmadi', 42, 'Team Member', 1, '2024-08-17', '1172', NULL, '76-094105', 'Moto', 'Mrayji', 'images/67be11eea3ec2.png', '2025-02-24 22:00:00', '2025-02-25 16:54:38', 'Stationery Back Office', NULL, NULL),
(75, 'Mohamad Banna', 42, 'Senior Supporter', 1, '2022-07-20', '1529', 'mohammadbanna1998@gmail.com', '71-192941', 'Yes', 'Dahieh', 'images\\Mohamad Banna.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(76, 'Mohamad Al Hout', 42, 'Supporter', 1, '2023-03-30', '2363', 'mhmdhout444@gmail.com', '78-831785', 'Moto', 'Burj Abi Haidar', 'images\\Mohamad Al Hout.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(77, 'Mohamad Ghsein', 42, 'Junior Cashier', 1, '2023-07-08', '2647', 'mjghsein@gmail.com', '78-823997', 'No', 'Mcharafieh', 'images\\Mohamad Ghsein.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(78, 'Sara Mourawed', 42, 'Supporter', 1, '2024-04-20', '1580', 'sarahmrawed@gmail.com', '78-952982', 'No', 'Baawerta', 'images\\Sara Mourawed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(79, 'Ali Mechref', 42, 'Team Member', 1, '2024-06-12', '1006', 'alimechref6@gmail.com', '76-195897', 'Moto', 'Basta Al Tahta', 'images\\Ali Mechref.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(80, 'Fadi Khodari', 20, 'Officer', 1, '2018-09-27', '2813', 'khodaRIFADI5@GMAIL.COM ', '70/103289', 'Yes', 'Barja ', 'images\\Fadi Khodari.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(81, 'Omar Aslan', 20, 'Supervisor', 1, '2018-10-07', '2822', 'aslan.omar96@gmail.com ', '76/095750', 'No', 'Tarik Jdideh ', 'images\\Omar Aslan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(82, 'Ahmad Hamdar', 20, 'Senior Supporter', 1, '2022-12-09', '2625', 'ahmadhamdar123@outlook.com', '76-172830', 'Moto', 'Haret Hreik', 'images\\Ahmad Hamdar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(83, 'Garine Topeyan', 20, 'Team Member', 1, '2023-09-09', '2820', 'topeyangarine8@gmail.com', '81-161077', 'No', 'Dawra', 'images\\Garine Topeyan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(84, 'Sophie Milane', 20, 'Supporter', 1, '2023-08-03', '2662', 'sophie.milane1@gmail.com', '03-005407', 'No', 'Jdeideh', 'images\\Sophie Milane.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(85, 'Elie Ghantous', 20, 'Team Member', 1, '2024-02-13', '2851', 'elieghantous8@gmail.com', '81-329351', 'No', 'Burj Hammoud ', 'images\\Elie Ghantous.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(86, 'Anthony Khoury', 20, 'Supporter', 1, '2023-07-07', '2589', 'anthonykhoury04@hotmail.com', '81-427862', 'No', 'Jdeideh', 'images\\Anthony Khoury.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(87, 'Richard Rizk', 20, 'Team Member', 1, '2024-01-15', '1119', 'rrizk1234@gmail.com', '76-402444', 'Yes', 'Awkar', 'images\\Richard Rizk.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(88, 'John Tannoury', 20, 'Team Member', 1, '2024-08-16', '1229', '', '', 'Moto', '', 'images\\John Tannoury.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(89, 'Chady Nassour', 38, 'Senior Supervisor', 1, '2016-09-22', '2603', 'shadynassour@gmail.com', '03635049', 'Yes', 'Mrayji', 'images\\Chady Nassour.png', '2025-02-24 22:00:00', '2025-02-25 16:42:07', 'Team Leader', NULL, NULL),
(90, 'Ahmad Attieh', 38, 'Representative', 1, '2021-07-17', '2016', 'ahmad.atieh43@gmail.com', '03-541886', 'No', 'Aramoun ', 'images\\ahmad attieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(91, 'Shadi Mrad', 38, 'Senior Supporter', 1, '2022-10-11', '1897', 'mradshadi96@hotmail.com', '70-273255', 'Yes', 'Bchamoun', 'images\\shadi mrad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(92, 'Harout Kojanian', 38, 'Senior Supporter', 1, '2007-03-31', '860', 'harout-75@hotmail.com', '03-845386', 'No', 'Zalka', 'images\\Harout Kojanian.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(93, 'Diana Zeidan', 38, 'Team Member', 1, '2024-09-11', '1659', 'dianasir225@gmail.com', '71-166741', 'Yes', 'Araya', 'images\\Diana Zeidan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(94, 'Bassel Malaeb', 38, 'Supporter', 1, '2024-07-04', '2253', 'bassel.mlb2@gmail.com', '70-018910', 'Yes', 'Baysoor', 'images\\Bassel Malaeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(95, 'Zeina Joudieh', 29, 'Officer', 1, '2022-04-12', '1414', 'zjoudieh@gmail.com', '71-361569', 'No', 'TBA', 'images\\zeina joudieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(96, 'Rabih Matar', 29, 'Senior Graphic Designer', 1, '2010-11-01', '1646', 'mattarrabih@gmail.com', '71-193613', 'Yes', 'Mejdlaya', 'images\\rabih matar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(97, 'Roger Orfaly', 29, 'Senior Supporter', 1, '2024-03-15', '1622', 'rogerorfali2022@gmail.com', '81-946061', 'Yes', 'Jiyeh', 'images\\Roger Orfaly.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(98, 'Samah Yassin', 29, 'Senior Supporter', 1, '2021-10-13', '2524', 'ariess_01_30@hotmail.com', '70-949861', 'No', 'Ouzai', 'images\\samah yassin.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(99, 'Ali Issa', 29, 'Senior Supporter', 1, '2024-07-03', '2762', 'ali_1998@gmail.com', '81 780890', 'Moto', 'Ghobeiry', 'images\\Ali Issa.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(100, 'Hussein Wehbi', 29, 'Supporter', 1, '2023-08-26', '2204', 'husseinwehbe39@gmail.com', '03-048731', 'Moto', 'mreiji', 'images\\hussein wehbi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(101, 'Wael Haidar', 29, 'Senior Supporter', 1, '2005-10-25', '626', 'Haidar_wael@hotmail.com', '70-120924', 'Moto', 'Choueifat', 'images\\wael haidar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(102, 'Sara Harkous', 29, 'Supporter', 1, '2022-05-04', '1441', '', '', 'Moto', '', 'images\\Sara Harkous.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(103, 'Ali Eido', 29, 'Team Leader', 1, '2023-03-09', '2277', 'alikil2329@gmail.com', '76-739193', 'Moto', 'Tarik Al Jdideh', 'images\\ali eido.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(104, 'Ahmad Charafeddine', 29, 'Supporter', 1, '2022-10-11', '1949', 'ahmadcharafdin2@gmail.com', '71-126803', 'No', 'Tahwit Al Ghadir', 'images\\ahmad charafeddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(105, 'Mohammad Nazzel', 29, 'Team Member', 1, '2023-09-18', '2215', 'nazzelmohamad@icloud.com', '70-743183', 'No', 'Tahwit Al Ghadir', 'images/67be11b22b940.png', '2025-02-24 22:00:00', '2025-02-25 16:53:38', 'Services', NULL, NULL),
(106, 'Ali Ayoub', 9, 'Executive', 1, '2011-03-01', '1148', 'Aly.ayoub.86@gmail.com', '70705547', 'Yes', 'Dibbieh', 'images\\ali ayoub.png', '2025-02-24 22:00:00', '2025-02-28 04:50:54', 'Team Leader', NULL, '2000-03-10'),
(107, 'Bahaa Hamadeh', 9, 'Senior Specialist', 1, '2011-04-08', '1745', 'BahaaHamadeh@hotmail.com', '03-725979', 'Yes', 'Baakline', 'images\\bahaa hamadeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(108, 'Mostafa Rihan', 9, 'Specialist', 1, '2021-10-07', '1832', 'mostafa_rihan12@hotmail.com', '71-532456', 'No', 'Dahye', 'images\\mostafa rihan.png', '2025-02-24 22:00:00', '2025-02-28 04:51:08', 'Graphic Designer', NULL, '2000-03-21'),
(109, 'Bahaa Timani', 9, 'Representative', 1, '2015-04-22', '2371', 'bahaaaltimany@hotmail.com', '71-570196', 'NO', 'Aley', 'images\\bahaa timani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(110, 'Khalil Jureidini', 9, 'Supporter', 1, '1996-11-01', '151', 'kjureidini@hotmail.com', '03-286584', 'No', 'Ras Beirut', 'images/67be07bc73d9e.png', '2025-02-24 22:00:00', '2025-02-25 16:11:08', 'Services', NULL, NULL),
(111, 'Razan Haidar', 9, 'Supporter', 1, '2023-11-08', '2156', 'razanehaydar11@gmail.com', '76-959077', 'No', 'Dahieh', 'images\\razan haidar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(112, 'Ziad Abbas', 9, 'Supporter', 1, '2023-04-20', '1491', 'abo_samir840@hotmail.com', '70-922450', 'Moto', 'Tarik Al Jdideh', 'images\\ziad abbas.png', '2025-02-24 22:00:00', '2025-02-28 04:51:18', 'Delivery', NULL, '1977-03-16'),
(113, 'Nohad Tabbara', 9, 'Senior Supporter', 1, '2023-11-24', '1259', 'nohadtabbara78@gmail.com', '71-518715', 'Yes', 'Furn Al Chebak', 'images\\nohad tabbara.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(114, 'Abbas Zeineh', 9, 'Team Member', 1, '2024-09-13', '2345', 'abbaszeineh@icloud.com', '70-899007', 'No', 'Nwayri', 'images\\Abbas Zeineh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(115, 'Afif Raad', 9, 'Team Member', 1, '2024-09-16', '2746', 'afifraad06@gmail.com', '76-943988', 'Moto', 'Ghbayri', 'images\\Afif Raad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(116, 'Samia Buban', 23, 'Manager', 1, '1999-10-06', '238', 'srbouban@gmail.com', '71/472429', 'No', 'Naameh', 'images\\Samia Buban.png', '2025-02-24 22:00:00', '2025-02-25 16:58:36', 'Team Leader', NULL, NULL),
(117, 'Yehya Rakka', 23, 'Senior Specialist', 1, '1990-10-01', '105', '', '70-825690', 'Yes', 'Ghoubairy', 'images\\Yehya Rakka.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(118, 'Rima Ghandoura', 23, 'Senior Supporter', 1, '2024-05-14', '2538', 'rimaghandoura99@gmail.com', '70-008135', 'No', 'Hadath', 'images\\Rima Ghandoura.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(119, 'Khodor Safsouf', 23, 'Senior Supporter', 1, '2022-01-21', '1884', 'khodor.safsouf@hotmail.com', '76-083311', 'No', 'Dibieh', 'images\\Khodor Safsouf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(120, 'Hala Mokdad', 23, 'Junior Cashier', 1, '2024-08-08', '2418', '', '', 'No', '', 'images\\Hala Mokdad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(121, 'Ousama Al Masri', 23, 'Team Leader', 1, '2022-10-04', '1817', 'oussama.masri28@gmail.com', '70-764319', 'Moto', 'Kfarchima', 'images\\ousama al masri.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(122, 'Amir Ghraizi', 23, 'Senior Supporter', 1, '2023-04-24', '2416', 'ghraiziamirr@gmail.com', '78-848101', 'No', 'Aley', 'images\\Amir Ghraizi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(123, 'Cerine Hani', 23, 'Team Member', 1, '2024-05-16', '2853', 'sirine.haniii@gmail.com', '76-699641', 'No', 'Aley', 'images\\Cerine Hani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(124, 'Khaled Danaf', 23, 'Team Member', 1, '2024-05-10', '2527', 'khaleddanaf03@gmail.com', '76-513461', 'Moto', 'Baalechmay', 'images\\Khaled Danaf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(125, 'Faysal Al Saghir', 23, 'Supporter', 1, '2022-08-09', '1435', 'faysalalsaghir65@gmail.com', '76-602164', 'No', 'Khaldeh', 'images\\Faysal Al Saghir.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(126, 'Firas Chamas', 70, 'Team Member', 1, '2024-06-05', '1950', 'firas.shamas@outlook.com', '76 853 522', 'Moto', 'Chiyah', 'images/67be1201bb9b7.png', '2025-02-24 22:00:00', '2025-02-25 16:54:57', 'Stationery Sales Force', NULL, NULL),
(127, 'Sayed Abboud', 71, 'Supporter', 1, '2022-12-04', '2129', 'sayedabboud453@gmail.com', '76-060705', 'Moto', 'Dawra', 'images\\Sayed Abboud.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(128, 'Majd Chbatt', 71, 'Team Member', 1, '2024-06-22', '1536', 'shbattmajd@gmail.com', '81-836914', 'No', 'Jdeideh', 'images/67be120770896.png', '2025-02-24 22:00:00', '2025-02-25 16:55:03', 'Stationery Sales Force', NULL, NULL),
(129, 'Elie Azzi', 72, 'Supporter', 1, '2021-05-18', '2618', 'elie96@outlook.com', '70 253 837', 'Yes', 'Ain Al Remmaneh', 'images\\Elie Azzi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(130, 'Anthony Ibrahim', 72, 'Supporter', 1, '2022-09-16', '1803', 'anthonyibrahim255@gmail.com', '81-285600', 'Yes', 'Burj Hammoud ', 'images\\Anthony Ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(131, 'Ahmad Manasfi', 46, 'Supervisor', 1, '2023-10-06', '1602', 'amanasfe@hotmail.com', '70-624425', 'No', 'Salim Slem', 'images\\Ahmad Manasfi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(132, 'Ahmad Noutsi', 46, 'Senior Supporter', 1, '1997-10-01', '137', '', '70-954199', 'No', 'Mazraa', 'images\\ahmad noutsi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(133, 'Tony Khashan', 18, 'Officer', 1, '2016-12-17', '2643', 'tonykhachan@hotmail.com', '76761846', 'Yes', 'Hadath', 'images\\tony khashan.png', '2025-02-24 22:00:00', '2025-02-25 16:42:18', 'Team Leader', NULL, NULL),
(134, 'Mohamad Jalal Al Hajj', 18, 'Specialist', 1, '2019-03-20', '1691', 'mhdalhajj@hotmail.com', '71429878', 'Moto', 'Haret Hreik', 'images/67be118faae33.png', '2025-02-24 22:00:00', '2025-02-25 16:53:03', 'Computer Operator', NULL, NULL),
(135, 'Noaman Dabbous', 18, 'Supervisor', 1, '2021-10-01', '1802', 'noamand@outlook.com', '78-907708', 'No', 'Aramoun', 'images\\Noaman Dabbous.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(136, 'Fatima Al Kaaki', 18, 'Senior Supporter', 1, '2021-07-29', '2419', 'timakaaki@gmail.com', '71-772678', 'No', 'Mazraa', 'images\\Fatima Al Kaaki.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(137, 'Sarah Awad', 18, 'Senior Supporter', 1, '2023-02-05', '2278', 'awwadsarah.99@gmail.com', '76-786784', 'No', 'Chiyah', 'images\\Sarah Awad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(138, 'Ali Ismail', 18, 'Team Member', 1, '2024-11-05', '2772', 'ali_khodor_22@outlook.com', '03-739303', 'Yes', 'Tallet El Khayyat', 'images\\Ali Ismail.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(139, 'Hady Kaddoura', 18, 'Junior Cashier ', 1, '2023-10-21', '1634', 'hadyka17th81998@gmail.com', '71-402978', 'Moto', 'Barbour', 'images\\Hady Kaddoura.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(140, 'Rony Nasr', 18, 'Supporter', 1, '2023-05-09', '2462', 'ronynasr8@icloud.com', '81-790321', 'Yes', 'Abey', 'images\\Rony Nasr.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(141, 'Adnan Berjawi', 18, 'Team Member', 1, '2024-03-04', '1342', 'adnan.berjawi.y@live.com', '71-270143', 'Moto', 'Mazraa', 'images\\adnan berjawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(142, 'Faysal Jaroudi', 68, 'Senior Supervisor', 1, '2024-01-17', '1396', 'Jaroudifaysal16@gmail.com', '76806465', 'Yes', 'Tarik Al Jdideh', 'images\\Faysal Jaroudi.png', '2025-02-24 22:00:00', '2025-02-25 18:05:08', 'Team Leader', NULL, NULL),
(143, 'Mohamad Khaywe', 68, 'Specialist', 1, '2011-04-12', '1749', 'moe.khaywe@gmail.com', '03-075723', 'Moto', 'Bchamoun', 'images\\Mohamad Khaywe.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(144, 'Sami Sinno', 68, 'Supervisor', 1, '2022-10-03', '1850', 'samisinno@icloud.com', '81-095203', 'Yes', 'Mansourieh', 'images\\Sami Sinno.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(145, 'Omar Kassar', 68, 'Junior Services', 1, '2023-11-03', '1484', 'omar.kassar10@icloud.com', '71-482728', 'Yes', 'Khaldeh', 'images\\Omar Kassar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(146, 'Kassem Akil', 68, 'Supporter', 1, '2023-08-12', '2734', 'kassemakil2@gmail.com', '76-885146', 'Moto', 'Tarik Al Matar', 'images\\Kassem Akil.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(147, 'Rafic Khoury', 73, 'Manager  ', 1, '2006-06-06', '565', 'rafickhoury3@gmail.com', '71409307', 'Yes', 'Baabda', 'images\\rafic khoury.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(148, 'Naji Deeb', 73, 'Manager  ', 1, '2007-10-25', '944', 'naji.dib@gmail.com', '71-581000', 'Yes', 'Kfarmatta', 'images\\naji deeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(149, 'Rasha Faysal', 73, 'Manager', 1, '2008-09-27', '1123', '', '70-958879', 'Moto', '', 'images\\rasha faysal.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(150, 'Mahmoud Imam', 73, 'Manager', 1, '1990-12-10', '255', '', '', 'Moto', '', 'images\\mahmoud imam.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(151, 'Dalia Mayassi', 73, 'Executive', 1, '2010-10-08', '1596', 'Dmayassi@gmail.com', '70-908581', 'Yes', 'Deir Kobel', 'images\\dalia mayassi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(152, 'Nisrine Issrawi', 73, 'Manager', 1, '2001-08-06', '199', '', '', 'Moto', '', 'images\\nisrine issrawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(153, 'Ousama Malaeb', 73, 'Manager', 1, '1999-10-29', '200', 'Oussim@gmail.com', '03717483', 'Moto', 'Baissour', 'images\\ousama malaeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(154, 'Dania Ibrahim', 73, 'Executive', 1, '2001-03-16', '197', 'Daniaibrahim2234@gmail.com', '03736763', 'No', 'Kraytem', 'images\\dania ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(155, 'Lilian Zebian', 73, 'Executive', 1, '2015-08-11', '2446', 'laloush1@outlook.com', '70-862068', 'No', 'Sharoun', 'images\\lilian zebian.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(156, 'Zahra Al Oud', 73, 'Manager', 1, '1991-08-01', '178', 'Zahra.daroub@gmail.com', '03923575', 'No', 'Ain Ainoub', 'images\\zahra al oud.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(157, 'Shadi Farhat', 73, 'Senior Officer', 1, '2019-04-01', '1733', 'shadifarhat01@gmail.com', '76938653', 'Yes', 'Maamoura', 'images/67bed6404df36.jpg', '2025-02-24 22:00:00', '2025-02-28 04:39:09', 'Team Leader', NULL, '1998-03-04'),
(158, 'Ziad Saad', 73, 'Executive', 1, '2006-02-09', '684', 'Ziadsaad_78@hotmail.com', '76720009', 'Yes', 'Furn Al Chebak mar nohra baabda', 'images\\ziad saad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(159, 'Iman Hamdan', 73, 'Executive', 1, '2005-10-25', '1493', '', '', 'No', '', 'images\\iman hamdan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(160, 'Ali Yassin', 73, 'Executive', 1, '2003-02-01', '318', 'aliyassin81@gmail.com', '71480719', 'No', 'Kfour', 'images\\ali yassin.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(161, 'Norma Said', 73, 'Executive', 1, '2004-02-27', '466', 'normasaiid28@gmail.com', '70956852', 'No', 'Aley', 'images\\norma said.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(162, 'Sylvia Baaklini', 73, 'Executive', 1, '2007-04-02', '872', 'Silviabaaklini@yahoo.com', '70/489665', 'Yes', 'Achkout', 'images\\sylvia baaklini.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(163, 'Ghassan Akkawi', 73, 'Senior Officer  ', 1, '1996-09-27', '134', '', '', 'Moto', 'Al Shiyah ', 'images\\ghassan akkawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(164, 'Rabih Ghazal', 73, 'Officer', 1, '2016-09-10', '2595', 'Rabie.ghazal@yahoo.com', '71207335', 'No', 'Saida', 'images\\rabih ghazal.png', '2025-02-24 22:00:00', '2025-02-25 16:42:31', 'Team Leader', NULL, NULL),
(165, 'Kifah Ghannam', 73, 'Supervisor', 1, '2017-04-19', '2699', 'kifah.ghannam@hotmail.com', '70/956336', 'Yes', 'Kfarhim', 'images\\kifah ghannam.png', '2025-02-24 22:00:00', '2025-02-25 16:42:49', 'Team Leader', NULL, NULL),
(166, 'Mohamad Saleh', 73, 'Officer', 1, '2008-11-05', '1145', 'Mhdsaleh7@gmail.com', '70773656', 'Yes', 'Choueifat', 'images/67be120cdb51e.png', '2025-02-24 22:00:00', '2025-02-25 16:55:08', 'Team Leader', NULL, NULL),
(167, 'Ziad Kalaji', 73, 'Manager', 1, '1987-12-31', '1977', 'Ziadmaliks@gmail.com', '03814607', 'Moto', 'Verdun', 'images\\Ziad Kalaji.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(168, 'Wael Ahmadieh', 73, 'Team Leader', 1, '2006-11-24', '1248', 'wael.ahmadieh1986@gmail.com', '03-147745', 'Yes', 'Sharoun', 'images\\wael ahmadieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(169, 'Tarek Badawi', 73, 'Specialist', 1, '2016-09-16', '2598', 'Tarek-Badawi@hotmail.com', '03-897091', 'No', 'Jdeideh', 'images\\Tarek Badawi.png', '2025-02-24 22:00:00', '2025-02-25 16:43:06', 'Graphic Designer', NULL, NULL),
(170, 'Riad Labban', 73, 'Coordinator', 1, '1999-09-23', '256', '', '', 'No', 'Iklim El Kharroub', 'images\\riad labban.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(171, 'Nihal Farchoukh', 73, 'Senior Supervisor', 1, '2013-11-26', '2119', '', '', 'Yes', 'Ouzai', 'images\\nihal farchoukh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(172, 'Silva Trayji', 73, 'Specialist', 1, '2018-12-12', '2852', '', '78 948 386', 'No', 'Barbour', 'images\\silva trayji.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(173, 'Ousama Hoboubaty', 73, 'Senior Specialist', 1, '2003-02-16', '309', '', '03 954 812', 'Moto', 'Al Shiyah ', 'images\\ousama hoboubaty.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Delivery', NULL, NULL),
(174, 'Mohamad Khatib', 73, 'Specialist', 1, '2008-07-07', '1064', NULL, '03-444878', 'Moto', 'Al Shiyah ', 'images/67be1212d4b27.png', '2025-02-24 22:00:00', '2025-02-25 16:55:14', 'Back Office Delivery', NULL, NULL),
(175, 'Noura Slim', 73, 'Senior Specialist', 1, '2015-01-13', '2317', 'noura-sleem1@hotmail.com', '03-078235', 'No', 'Cornishe Al Mazraa', 'images\\noura slim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(176, 'Hiba Farchoukh', 73, 'Supervisor', 1, '2016-03-03', '2555', 'Farchoukhhiba@gmail.com', '70-665254', 'No', 'Iklim El Kharroub', 'images\\hiba farchoukh.png', '2025-02-24 22:00:00', '2025-02-25 16:43:20', 'Team Leader', NULL, NULL),
(177, 'Salman Ghraizi', 73, 'Senior Specialist', 1, '2017-04-07', '2697', 'salmanghraizi-22@hotmail.com', '71-127897', 'Yes', 'Btater/Aley', 'images\\salman ghraizi.png', '2025-02-24 22:00:00', '2025-02-25 16:43:31', 'Back Office', NULL, NULL),
(178, 'Elian Chaker', 73, 'Specialist', 1, '2021-01-05', '2216', 'chakereliane@gmail.com', '76058576', 'No', 'Mansourieh', 'images\\elian chaker.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(179, 'Nancy Bou Saab', 73, 'Specialist', 1, '2018-09-12', '2806', 'nanctabisaab@yahoo.com ', '70/726718', 'No', 'Aytat', 'images\\nancy bou saab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(180, 'Aya Malaeb', 73, 'Senior Supporter', 1, '2019-07-11', '2301', 'aya_malaeb@hotmail.com', '76658991', 'Yes', 'Karakol El Druz', 'images\\aya malaeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(181, 'Diana Aridi', 73, 'Senior Supporter', 1, '2021-07-03', '1880', 'dianasir225@gmail.com', '70-879107', 'Yes', 'Araya', 'images\\Diana Aridi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(182, 'Hanin Zahwi', 73, 'Representative', 1, '2018-09-01', '2797', 'hanine.zahwe@gmail.com ', '81/671903', 'No', 'Haret Hreik', 'images\\hanin zahwi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(183, 'Ghina Awkal', 73, 'Senior Supporter', 1, '2020-10-05', '2742', 'awkal.ghina25@gmail.com', '70 615 530', 'No', 'Aisha Bakkar ', 'images\\ghina awkal.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(184, 'Sirrine Hamoud', 73, 'Supporter', 1, '2024-08-17', '1294', 'sirinhammoud8@gmail.com', '71-563296', 'No', 'Spears', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(185, 'Wael Khalil', 73, 'Senior Supporter', 1, '2013-11-07', '2114', 'khalil_212@hotmail.com', '71-450822', 'Moto', 'Beirut ', 'images\\wael khalil.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(186, 'Hassan Ramadan', 73, 'Senior Supporter', 1, '2014-01-23', '2148', 'fox-hr-1992@hotmail.com', '71-190244', 'Moto', 'Msaytbeh ', 'images\\hassan ramadan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Delivery', NULL, NULL),
(187, 'Samir  Iskandarani', 73, 'Senior Supporter', 1, '2013-01-05', '1997', '', '76-636860', 'Moto', 'Tallet El Khayyat', 'images\\Samir  Iskandarani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(188, 'Said Bassiri', 73, 'Supporter', 1, '2024-07-04', '1873', 'baassirisaeed@gmail.com', '78-884 896', 'Yes', 'Aramoun', 'images/67be121c32b48.png', '2025-02-24 22:00:00', '2025-02-25 16:55:24', 'Back Office', NULL, NULL),
(189, 'Shadi Bazzi', 73, 'Team Member', 1, '2024-09-18', '1411', NULL, '81-702582', 'Moto', 'Al Shiyah ', 'images/67be1217eb54f.png', '2025-02-24 22:00:00', '2025-02-25 16:55:20', 'Delivery', NULL, NULL),
(190, 'Jessica Mghammes', 73, 'Senior Executive', 1, '2021-10-28', '2401', 'jessicamaghamess@gmail.com', '78-842404', 'Yes', 'Ain Al Remmeneh', 'images\\jessica mghammes.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(191, 'Raghid Mokbel', 73, 'Officer', 1, '2022-01-26', '1887', NULL, NULL, 'Moto', 'Al Shiyah ', 'images/67be1220d8eaf.png', '2025-02-24 22:00:00', '2025-02-25 16:55:28', 'Team Leader', NULL, NULL),
(192, 'Ismail Rajab', 73, 'Supervisor', 1, '2024-06-20', '2039', 'ismael.rajab05@gmail.com', '70-025915', 'Yes', 'Choueifat', 'images/67be122b96307.png', '2025-02-24 22:00:00', '2025-02-25 16:55:39', 'Team Leader', NULL, NULL),
(193, 'Loulwa Khaddaj', 73, 'Senior Supporter', 1, '2023-08-01', '2672', 'loulwazaherkhaddaj@gmail.com', '71/503560', 'No', 'Kfarmatta', 'images/67be122671ed9.png', '2025-02-24 22:00:00', '2025-02-25 16:55:34', 'Back Office', NULL, NULL),
(194, 'Nashaat Awwad', 73, 'Team Member', 1, '2023-12-12', '2725', 'nashaat.awwad21@gmail.com', '81-668401', 'No', 'Aley', 'images\\Nashaat Awwad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(195, 'Mona Karaki', 73, 'Supporter', 1, '2022-02-01', '1789', '', '', 'No', 'Iklim El Kharroub', 'images\\mona karaki.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(196, 'Bilal Rawas', 73, 'Senior Supporter', 1, '2021-03-01', '1847', '', ' 70 981 250', 'Moto', 'Al Shiyah ', 'images\\bilal rawas.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(197, 'Saeed Al Jawhary', 73, 'Junior Back Office', 1, '2024-05-24', '2280', 'saeed.jawhary99@gmail.com', '76-503075', 'Yes', 'Aramoun', 'images\\Saeed Al Jawhary.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(198, 'Ziad Yamout', 73, 'Team Member', 1, '2024-03-27', '1607', 'ziadyamout159@gmail.com', '71 139 437', 'Yes', 'Choueifat', 'images\\ziad yamout.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(199, 'Mostapha Ibrahim', 73, 'Supporter', 1, '2024-01-05', '1275', 'mostafa_ibrahim111@outlook.com', '71-126014', 'Moto', 'Tarik Al Jdideh', 'images\\Mostapha Ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(200, 'Yasser Kharaz', 73, 'Team Member', 1, '2023-12-01', '2529', '', '', 'Moto', 'Al Shiyah ', 'images\\yasser kharaz.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(201, 'Charbel Bowairy', 34, 'Executive', 1, '2006-05-18', '723', 'charbeleliasboueri@gmail.com', '03856427', 'No', 'Amchit', 'images\\Charbel Bowairy.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(202, 'Abdul Rahman Zoghbi', 34, 'Senior Supporter', 1, '2024-01-12', '1329', 'aboudizohbi184@gmail.com', '79-165236', 'No', 'Halba', 'images\\Abdul Rahman Zoghbi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(203, 'Lilian Habib', 34, 'Representative', 1, '2005-10-20', '625', '', '71-854255', 'Moto', 'Al Shiyah ', 'images\\Lilian Habib.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(204, 'Walaa Ibrahim', 34, 'Supervisor', 1, '2024-06-11', '1108', '', '', 'Moto', 'Al Shiyah ', 'images\\walaa ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(205, 'Anthony Mouaness', 34, 'Junior Stationery', 1, '2024-02-05', '1327', 'anthonymouanes@gmail.com', '71-636033', 'No', 'Jbeil', 'images\\Anthony Mouaness.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(206, 'Mayssa Nader', 34, 'Team Member', 1, '2023-09-16', '2850', 'mayssanadeher@gmail.com', '70-563182', 'No', 'Amchit', 'images\\Mayssa Nader.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(207, 'Zakhia Kamel', 34, 'Team Member', 1, '2023-09-20', '2839', 'Zakhiakamel8991@gmail.com ', '81-211354', 'No', 'Aazra', 'images\\zakhia kamel.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(208, 'Geraldo Badawi', 34, 'Senior Supporter', 1, '2023-08-09', '2692', 'geraldobadawi2@gmail.com', '76-903525', 'No', 'Jbeil', 'images\\Geraldo Badawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(209, 'Hady Lakiss', 34, 'Supporter', 1, '2024-01-16', '1122', 'lakisshady@gmail.com', '70-442029', 'No', 'Jbeil', 'images\\Hady Lakiss.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(210, 'Rhea Atallah', 34, 'Supporter', 1, '2023-10-02', '2600', 'rheaatallah@gmail.com', '79-135697', 'No', 'Jbeil', 'images\\Rhea Atallah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(211, 'Jawad Ahmad', 34, 'Team Member', 1, '2024-08-06', '1205', '', '76 793 198', 'No', 'Amchit', 'images\\Jawad Ahmad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(212, 'Maysaa Mahmoud', 36, 'Senior Officer', 1, '2007-12-01', '968', '', '', 'Moto', 'Al Shiyah ', 'images\\Maysaa Mahmoud.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(213, 'Nizar Hazim', 36, 'Supporter', 1, '2024-01-12', '1288', 'hazimxhazim@gmail.com', '71-828030', 'No', 'Akkar', 'images\\Nizar Hazim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(214, 'Elie Saliba', 36, 'Supporter', 1, '2024-09-17', '2275', 'elie5807@gmail.com', '76-762060', 'Yes', 'Jbeil', 'images/67be11cc437b9.png', '2025-02-24 22:00:00', '2025-02-25 16:54:04', 'Computer Operator', NULL, NULL),
(215, 'Perla Khoury', 36, 'Junior Cashier', 1, '2023-10-06', '2569', 'perla.khoury54@gmail.com', '70-383802', 'No', 'Kfarhbab', 'images\\Perla Khoury.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(216, 'Joe Chami', 36, 'Junior Stationery', 1, '2024-01-01', '1610', 'joechami8@gmail.com', '81-367009', 'No', 'Jounieh', 'images\\Joe Chami.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(217, 'Fouad Bou Kassem', 36, 'Team Member', 1, '2024-09-17', '2205', 'fouadboukassem@gmail.com', '76-469274', 'Yes', 'Jbeil', 'images\\Fouad Bou Kassem.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(218, 'Elissa Makhlouf', 36, 'Cashier', 1, '2023-10-06', '2262', 'elissamakhlouf12@gmail.com', '76-531922', 'No', 'Safra', 'images\\Elissa Makhlouf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(219, 'Elie Nacouzi', 36, 'Team Member', 1, '2024-08-20', '1354', 'eliegamingnacouzi@gmail.com', '71-056867', 'Yes', 'Tabarja', 'images\\Elie Nacouzi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(220, 'Jeannette Mouarkesh', 25, 'Executive', 1, '2001-10-22', '156', 'Executive738@gmail.com', '70752076', 'Yes', 'Naccache', 'images\\Jeannette Mouarkesh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(221, 'Michel Daou', 25, 'Specialist', 1, '2019-03-04', '1518', 'Mikedaou123@gmail.com', '70204177', 'No', 'Jounieh', 'images\\Michel Daou.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(222, 'Joy Ghassan', 25, 'Senior Supporter', 1, '2022-02-03', '1879', 'joya_1991@live.com', '70-214524', 'Yes', 'Adma', 'images\\Joy Ghassan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(223, 'Rackelle Semaan', 25, 'Supporter', 1, '2024-08-28', '1525', 'semaanrackelle@gmail.com', '81420274', 'No', 'Jbeil', 'images\\Rackelle Semaan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL);
INSERT INTO `employee_info` (`id`, `name`, `branch_id`, `title`, `status`, `date_hired`, `pin_code`, `email`, `phone`, `car`, `address`, `image_path`, `created_at`, `updated_at`, `job`, `left_date`, `birthday`) VALUES
(224, 'Elie Bouery', 25, 'Junior Services', 1, '2023-11-15', '1154', 'elie.cars@hotmail.com', '76-332619', 'Yes', 'Haret Sakhr', 'images\\Elie Bouery.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(225, 'Sonia Hanna', 25, 'Specialist', 1, '2014-07-07', '2608', 'sousy_12_12@hotmail.com', '70-281591', 'No', 'Nabaa', 'images\\Sonia Hanna.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(226, 'Julien Jabbour', 25, 'Team Member', 1, '2024-04-01', '1226', '', '', 'Moto', 'Al Shiyah ', 'images\\Julien Jabbour.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(227, 'Nour Hussien', 74, 'Supervisor', 1, '2022-03-16', '1917', 'husseinnour587@gmail.com', '76-726397', 'No', 'Ard Jaloul', 'images\\Nour Hussien.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(228, 'Nancy Alameddine', 74, 'Junior Cashier', 1, '2022-08-01', '1618', 'nancyalameddine9@gmail.com', '76-881287', 'No', 'Aitat', 'images\\nancy alameddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(229, 'Root Hallak', 74, 'Team Leader', 1, '2022-09-02', '1958', 'root.hallak@hotmail.com', '78-886068', 'No', 'Zarif', 'images\\Root Hallak.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(230, 'Zeinab Mzanar', 74, 'Junior Cashier', 1, '2023-10-31', '1927', 'mzanarzeiinab@gmail.com', '76-847350', 'No', 'Mar Elias', 'images\\Zeinab Mzanar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(231, 'Samer Fakher', 27, 'Senior Officer', 1, '1993-05-17', '119', 'Samerfakher2@gmail.com ', '03671503', 'Yes', 'Baysoor', 'images\\samer fakher.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(232, 'Ghenwa Hamadeh', 27, 'Representative', 1, '2010-10-26', '1625', '', '03-806828', 'No', 'Baakline', 'images\\Ghenwa Hamadeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(233, 'Hassan Anan', 27, 'Supporter', 1, '2023-05-23', '2463', 'rayan.h512@gmail.com', '71-191420', 'Moto', 'Haret Hreik', 'images\\Hassan Anan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(234, 'Sala Hassan', 27, 'Team Member', 1, '2024-09-12', '1425', 'hsala@gmail.com', '03-769797', 'No', 'Cola', 'images\\Sala Hassan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(235, 'Mohamad Sherkawi', 24, 'Officer', 1, '2010-10-12', '1608', 'moe.sherkawi@gmail.com', '70980470', 'Yes', 'Bchamoun', 'images\\Mohamad Sherkawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(236, 'Claude Haddad', 24, 'Specialist', 1, '2017-01-27', '2669', 'claudehaddad14@gmail.com', '76-807922', 'No', 'Dbayeh', 'images\\Claude Haddad.png', '2025-02-24 22:00:00', '2025-02-25 16:43:46', 'Cashier', NULL, NULL),
(237, 'Stephanie Dakkash', 24, 'Junior Stationery', 1, '2024-06-20', '1268', 'stephanie.non@hotmail.com', '71-710791', 'No', 'Bouchrieh', 'images\\stephanie dakkash.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(238, 'Hussein Abdalla', 24, 'Team Leader', 1, '2022-09-19', '1780', 'husseinabdallah98@outlook.com', '76 695 388', 'Moto', 'Mrayji', 'images\\Hussein Abdalla.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(239, 'Mohamad Ibrahim', 24, 'Supporter', 1, '2023-08-11', '2727', 'mohammadibrahim74@gmail.com', '81-278973', 'Moto', 'Antelias', 'images\\Mohamad Ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(240, 'Imane Wehbe', 24, 'Senior Supporter', 1, '2023-02-07', '2305', 'wehbeimane3@gmail.com', '71-287549', 'No', 'Biakout', 'images\\Imane Wehbe.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(241, 'Joseph El Hajj', 24, 'Supporter', 1, '2023-02-07', '2290', 'josephhajj57@gmail.com', '76-712046', 'No', 'Dik Al Mehdi', 'images\\Joseph El Hajj.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(242, 'Jean Pierre Hakim', 24, 'Junior Services', 1, '2024-02-09', '2258', 'jp.e.hakim@gmail.com', '76-419143', 'Yes', 'Bsalim ', 'images/67be12552d974.png', '2025-02-24 22:00:00', '2025-02-25 16:56:21', 'Services', NULL, NULL),
(243, 'Maroun Habchy', 24, 'Team Member', 1, '2023-11-14', '1161', 'marounhabchi123@gmail.com', '71-865031', 'Yes', 'Dbayeh', 'images\\Maroun Habchy.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(244, 'Melissa Bechara', 24, 'Junior Stationery', 1, '2024-08-08', '1405', 'melissabechara3@gmail.com', '76-820895', 'No', 'Naccache', 'images\\Melissa Bechara.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(245, 'Hussein Zeitoun', 44, 'Senior Officer', 1, '2009-06-06', '1264', 'hussein.olive@gmail.com', '70092345', 'Yes', 'Kfartebnit', 'images/67be11faafd23.png', '2025-02-24 22:00:00', '2025-02-25 16:54:50', 'Team Leader', NULL, NULL),
(246, 'Ahmad Ramadan', 44, 'Specialist', 1, '2022-05-07', '2065', 'ahmadramadan48@gmail.com', '70-062153', 'No', 'Barja', 'images\\Ahmad Ramadan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(247, 'Nazik Khalifi', 44, 'Team Leader', 1, '2022-01-14', '1707', 'nazyk.khalifeh@outlook.com', '81-337661', 'No', 'Salim Slem', 'images\\nazik khalifi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(248, 'Mohamad Al Ess', 28, 'Executive', 1, '2008-10-13', '1130', '', '', 'No', 'Moawad', 'images\\Mohamad Al Ess.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(249, 'Marie Ange Maalouf', 28, 'Supervisor', 1, '2020-10-07', '1855', 'marieangemaalouf4@gmail.com', '79 142 552', 'No', 'Sin Al Fil', 'images\\Marie Ange Maalouf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(250, 'Esther Houbeika', 28, 'Senior Supporter', 1, '2023-09-09', '2825', 'hobeika.esther@gmail.com', '03-494365', 'Yes', 'Mansourieh', 'images\\Esther Houbeika.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(251, 'Issa Faour', 28, 'Senior Supporter', 1, '2022-12-01', '2191', 'faour.010@gmail.com', '81-662106', 'No', 'Rwess', 'images\\issa faour.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(252, 'Roland Khater', 28, 'Senior Supporter', 1, '2022-10-03', '1837', 'roland.khater89@gmail.com', '76-472938', 'Yes', 'Brummana', 'images\\Roland Khater.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(253, 'Amani Madi', 28, 'Team Member', 1, '2024-10-04', '2484', 'amanimadi04@gmail.com', '71-182921', 'No', 'Aley', 'images\\Amani Madi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(254, 'Saadeh Al Aawar', 28, 'Team Member', 1, '2024-05-06', '2861', 'awarsaade@gmail.com', '70-359749', 'No', 'Mansourieh', 'images\\Saadeh Al Aawar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(255, 'Joe Chaaya', 28, 'Senior Supporter', 1, '2022-07-14', '1539', 'joe.ch.28@hotmail.com', '76-484742', 'Yes', 'Mansourieh', 'images\\Joe Chaaya.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(256, 'Reem Noueihed', 28, 'Team Member', 1, '2024-08-08', '1202', 'reemmoueihed@outlook.com', '79-183268', 'Yes', 'Ras El Maten', 'images/67be11a3c8c1a.png', '2025-02-24 22:00:00', '2025-02-25 16:53:23', 'Stationery', NULL, NULL),
(257, 'Angie Bou Trad', 28, 'Supporter', 1, '2022-09-01', '1690', 'angieboutrad@outlook.com', '76-408442', 'No', 'Mansourieh', 'images\\Angie Bou Trad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(258, 'Lynn Barakat', 28, 'Junior Cashier', 1, '2024-07-30', '1361', 'Lynnebarakat@gmail.com', '81-749113', 'No', 'Dekwaneh', 'images\\Lynn Barakat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(259, 'Mohamad Kitmitto', 33, 'Executive', 1, '2010-01-01', '1434', 'Mhmad.Kit@gmail.com', '76067925', 'Yes', 'Basta Al Fawka', 'images/67be11d76840c.png', '2025-02-24 22:00:00', '2025-02-25 16:54:15', 'Team Leader', NULL, NULL),
(260, 'Sabah Malaeb', 33, 'Specialist', 1, '2021-06-07', '2587', 'sabah.malaeb106@hotmail.com', '71/515324', 'No', 'Baissour ', 'images/67be11c605860.png', '2025-02-24 22:00:00', '2025-02-25 16:53:58', 'Graphic Designer', NULL, NULL),
(261, 'Wael Nassereddine', 33, 'Senior Representative', 1, '2012-01-11', '1878', 'Waelnasereddine@gmail.com', '71-289494', 'No', 'Haret Hreik', 'images\\wael nassereddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(262, 'Maria Al Abou', 33, 'Supervisor', 1, '2023-01-05', '2254', 'mariaalabou@gmail.com', '76-950167', 'No', 'Unesco', 'images\\Maria Al Abou.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(263, 'Rami Noureddine', 33, 'Senior Supporter', 1, '2001-11-26', '125', '', '03-461908', 'Moto', 'Al Shiyah ', 'images\\rami noureddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(264, 'Siraj Arida', 33, 'Supporter', 1, '2024-01-12', '2397', 'siraj.s.alarida@gmail.com', '70-601421', 'No', 'Aley', 'images\\siraj arida.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(265, 'Dana Itani', 33, 'Cashier', 1, '2024-09-10', '2147', 'itanidana431@gmail.com', '70-842968', 'Yes', 'Mar Elias', 'images\\Dana Itani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(266, 'Mohamad Al Chami', 33, 'Team Member', 1, '2023-11-28', '1212', 'mohammedsameh05@outlook.com', '81-848791', 'No', 'Saadiyat', 'images\\Mohamad Al Chami.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(267, 'Amani Yehya', 33, 'Supporter', 1, '2021-10-09', '2077', 'yehia2812@gmail.com', '76/645569', 'No', 'Brih', 'images\\Amani Yehya.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(268, 'Kassem Ghandour', 33, 'Junior Stationery', 1, '2023-11-17', '1928', 'kassemfouadghandour@gmail.com', '81-361906', 'Moto', 'Hadath', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(269, 'Myriam Salame', 63, 'Senior Officer', 1, '2013-07-29', '2059', '', '', 'Moto', 'Al Shiyah ', 'images\\Myriam Salame.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(270, 'Julien El Khoury', 63, 'Senior Supporter', 1, '2024-01-12', '1317', 'julienelkh@gmail.com', '70-505133', 'Yes', 'Ain Al Remmaneh', 'images\\Julien El Khoury.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(271, 'Hoda Boulos', 63, 'Specialist', 1, '2021-09-07', '1991', 'hodaboulos2000@gmail.com', '76 445 534', 'Yes', 'Kornet Al Hamra', 'images\\Hoda Boulos.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(272, 'Hady Jamil', 63, 'Supporter', 1, '2024-07-01', '2180', 'hadyjam1@gmail.com', '03-783148', 'Yes', 'Zalka ', 'images\\Hady Jamil.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(273, 'Vanessa Noun', 63, 'Supervisor', 1, '2022-11-16', '1990', 'vanessa@gmail.com', '78-960756', 'Yes', 'Jdeideh', 'images\\Vanessa Noun.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(274, 'Fouad Assaf', 63, 'Junior Services', 1, '2024-07-15', '1662', 'fouadassaf1@gmail.com', '03-907491', 'Yes', 'Dbayeh', 'images\\Fouad Assaf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(275, 'Nour Farah', 63, 'Senior Supporter', 1, '2023-07-12', '2609', 'noursf123@gmail.com', '71-772537', 'no', 'Beit Al Chaar', 'images\\Nour Farah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(276, 'Fabien Farah', 63, 'Team Member', 1, '2024-08-08', '1521', '', '', 'No', 'Iklim El Kharroub', 'images\\Fabien Farah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(277, 'Tania Ballout', 63, 'Team Member', 1, '2024-03-07', '2230', 'tatianabalout@gmail.com', '81-183641', 'No', 'Mtein', 'images\\Tania Ballout.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(278, 'Rita Maria Adas', 63, 'Supporter', 1, '2022-10-03', '1864', 'rita-maria.adas@hotmail.com', '71-284734', 'No', 'Antelias', 'images\\Rita Maria Adas.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(279, 'Peter Farah', 63, 'Supporter', 1, '2023-10-19', '1137', 'peterfarahh@hotmail.com', '71-722178', 'Yes', 'Antelias', 'images\\Peter Farah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(280, 'Hiba Hichi', 16, 'Manager', 1, '2011-04-02', '1742', NULL, NULL, 'Moto', 'Al Shiyah ', 'images/67be10ebc5063.png', '2025-02-24 22:00:00', '2025-02-25 16:50:19', 'Team Leader', NULL, NULL),
(281, 'Ahmad Ibrahim', 16, 'Specialist', 1, '2018-11-23', '2845', 'ahmad_gfx@outlook.com', '71/174383', 'Yes', 'Bshamoun ', 'images\\Ahmad Ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(282, 'Gael Haddad', 16, 'Processor', 1, '2017-04-10', '2698', 'haddadb-gael@hotmail.com', '71-081697', 'No', 'Dekwaneh', 'images\\Gael Haddad.png', '2025-02-24 22:00:00', '2025-02-25 16:43:59', 'Tele sales', NULL, NULL),
(283, 'Nouhal Sidani', 16, 'Senior Supporter', 1, '2022-01-11', '1502', 'nuhalsidani@gmail.com', '76-080536', 'Yes', 'Aramoun', 'images\\Nouhal Sidani.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(284, 'Malak Shukeir', 16, 'Representative', 1, '2017-09-01', '1158', 'malak_sh98@icloud.com', '76/946467', 'No', 'Haret Hreik', 'images\\Malak Shukeir.png', '2025-02-24 22:00:00', '2025-02-25 16:44:13', 'Tele sales', NULL, NULL),
(285, 'Alaa Khalil', 16, 'Specialist', 1, '2011-12-21', '1870', 'lebanon----1992@hotmail.com', '03-798131', 'Yes', 'Tarik Jdideh ', 'images/67be10f9b41a6.png', '2025-02-24 22:00:00', '2025-02-25 16:50:33', 'Team Leader', NULL, NULL),
(286, 'Zahraa Matar', 16, 'Coordinator', 1, '2011-06-18', '1781', 'zahraa@zahra.com', '03-487958', 'No', 'Moawad', 'images/67be1128d713e.png', '2025-02-24 22:00:00', '2025-02-25 16:51:20', 'Back Office', NULL, NULL),
(287, 'Alaa Cheikh', 16, 'Senior Supporter', 1, '2022-12-01', '2122', 'alaa.aec43@gmail.com', '71-495453', 'No', '', 'images\\Alaa Cheikh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(288, 'Dalia Barakat', 16, 'Representative', 1, '2016-07-11', '2570', 'dalia@dalia.com', '71-388530', 'No', 'Mazraa', 'images\\Dalia Barakat.png', '2025-02-24 22:00:00', '2025-02-25 16:44:40', 'Tele sales', NULL, NULL),
(289, 'Abdallah Al Mousawi', 16, 'Coordinator', 1, '2009-11-06', '1385', '', ' 71 123 681', 'Moto', 'Al Shiyah ', 'images\\Abdallah Al Mousawi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(290, 'Joumana Majed', 16, 'Senior Representative', 1, '2015-12-04', '2490', 'Joumana-m@hotmail.com', '03-804339', 'Yes', 'chouf', 'images\\Joumana Majed.png', '2025-02-24 22:00:00', '2025-02-25 16:57:31', 'Back Office', NULL, NULL),
(291, 'Wissam Al Halabi', 16, 'Specialist', 1, '2016-09-27', '2604', 'wissam@wissam.com', '79-105985', 'No', '', 'images\\Wissam Al Halabi.png', '2025-02-24 22:00:00', '2025-02-25 16:45:40', 'Van Driver', NULL, NULL),
(292, 'Khalil Askar', 16, 'Senior Representative', 1, '1991-09-16', '183', 'khalil.askar@live.com', '03-873427', 'Yes', 'Aley', 'images\\Khalil Askar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(293, 'Salim Deek', 16, 'Representative', 1, '2011-07-29', '1809', '', '70-904244', 'No', 'Ain Mreisseh', 'images\\Salim Deek.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(294, 'Samer Barakat', 16, 'Supporter', 1, '2021-05-17', '2784', 'samer.barakat.78@hotmail.com', '76 906 868', 'Moto', 'Sanayeh', 'images\\Samer Barakat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(295, 'Nizar Hamadeh', 16, 'Supporter', 1, '2021-03-26', '1253', '', '71 807 005', 'No', 'Mghayriyeh', 'images\\Nizar Hamadeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(296, 'Maya Jomaa', 16, 'Team Member', 1, '2024-07-02', '1461', 'mayajomaa@outlook.com', '76 700809', 'No', 'Salim Slem', 'images/67be113242418.png', '2025-02-24 22:00:00', '2025-02-25 16:51:30', 'Back Office', NULL, NULL),
(297, 'Ahmad Diab', 16, 'Senior Supporter', 1, '2010-07-07', '1542', 'Hamodi009@hotmail.com', '70-880638', 'Moto', 'Tarik Jdideh ', 'images\\Ahmad Diab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(298, 'Tala Fakhreddine', 16, 'Supporter', 1, '2023-02-22', '2316', 'fakhereldinetala@gmail.com', '71-165445', 'No', 'Beirut', 'images\\Tala fakhreddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(299, 'Hassan Seif Eddine', 16, 'Team Member', 1, '2024-09-10', '2341', 'sayfhassan092@gmail.com', '78-822926', 'Moto', 'Qmatiyeh', 'images/67be11396e0b8.png', '2025-02-24 22:00:00', '2025-02-25 16:51:37', 'Van Driver', NULL, NULL),
(300, 'Kifah Yehya', 16, 'Supporter', 1, '2023-05-02', '2450', 'kifah.yehya1@gmail.com', '71-920211', 'Yes', 'Benay', 'images\\Kifah Yehya.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(301, 'Fadi Al Danaf', 16, 'Specialist ', 1, '2015-04-29', '2380', 'fadi.aldanaf1986@hotmail.com', '70-508883', 'Yes', 'Baalechmay', 'images\\Fadi Al Danaf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(302, 'Shorouk Abd Alkader', 16, 'Team Member', 1, '2023-06-15', '2563', 'shouroukabdalkader@gmail.com', '81-806443', 'No', 'Aramoun', 'images\\Shorouk Abd AlKader.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(303, 'Omar Wehbe Al Masri', 16, 'Supporter', 1, '2024-05-01', '2633', 'omarwehbealmasri@gmail.com', '71-345340', 'Yes', 'Sanayeh', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(304, 'Wael Ramadan', 16, 'Senior Supporter', 1, '2012-04-13', '1937', 'Wael_Ramadan1978@hotmail.com', '76-709092', 'Yes', '', 'images\\Wael Ramadan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(305, 'Mahmoud Taha', 16, 'Team Member', 1, '2024-05-29', '2125', 'mahmoudalitaha123@gmail.com', '81-910804', 'Moto', 'Burj Abi Haidar', 'images/67be1140dc262.png', '2025-02-24 22:00:00', '2025-02-25 16:51:44', 'Stationery Warehouse', NULL, NULL),
(306, 'Georgete Tabet', 39, 'Team Member', 1, '2024-09-12', '1346', 'srgeorgettemarie@gmail.com', '70-248711', 'No', 'Ein El Remeneh', 'images\\Georgete Tabet.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Typist', NULL, NULL),
(307, 'Shadi Ghraizi', 39, 'Team Member', 1, '2024-07-16', '1645', 'shadighr765@gmail.com', '03-102932', 'Yes', 'Btater', 'images\\Shadi Ghraizi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(308, 'Mariam Tohme', 39, 'Team Member', 1, '2024-05-16', '2863', 'mariam.n.tohme@gmail.com', '70-446156', 'No', 'Furn Al Chebak', 'images/67be11d15e361.png', '2025-02-24 22:00:00', '2025-02-25 16:54:09', 'Team Leader', NULL, NULL),
(309, 'Aslan Khaddaj', 39, 'Supporter', 1, '2023-06-06', '2537', 'aslankhaddaj1998@gmail.com', '76-156051', 'Yes', 'Qabrchmoun', 'images\\Aslan Khaddaj.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(310, 'Karim Hakim', 39, 'Supporter', 1, '2024-08-22', '1415', 'karim.el.hakim2004@gmail.com', '78-969402', 'No', 'Sawfar', 'images\\Karim Hakim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(311, 'Jad Abboud', 39, 'Team Member', 1, '2024-09-02', '1606', 'jad.abboud.j.k@gmail.com', '70-588137', 'Yes', 'Dekwaneh', 'images/67be11df52e44.png', '2025-02-24 22:00:00', '2025-02-25 16:54:23', 'Cashier', NULL, NULL),
(312, 'Cezar Al Ahmadieh', 39, 'Team Member', 1, '2024-07-04', '2769', 'Ceasaralahmadieh@gmail.com', '03-038330', 'No', 'Sawfar', 'images\\Cezar Al Ahmadieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(313, 'Shadi Abou Dargham', 39, 'Manager', 1, '2006-06-02', '735', 'aboudarghamshadi@gmail.com', '03714625', 'Yes', 'Mansourieh', 'images\\Shadi Abou Dargham.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(314, 'Saher Shemas', 39, 'Senior Supervisor', 1, '2022-12-01', '2173', 'saher_shamas@outlook.com', '70-494903', 'Yes', 'Chiyah', 'images\\Saher Shemas.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(315, 'Rami El Hakim', 39, 'Coordinator', 1, '2007-09-18', '921', 'ramielhakim@hotmail.com', '03-077438', 'No', 'Mesherfy', 'images\\Rami El Hakim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(316, 'Chirine Ammar', 39, 'Officer', 1, '2007-04-13', '1492', 'Chirineamar@gmail.com', '81687807', 'No', 'Burj Al Barajneh', 'images\\Chirine Ammar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(317, 'Ismail Kadi', 39, 'Specialist', 1, '2006-01-12', '669', 'is.ka14@hotmail.com', '76-796982', 'No', 'Salim Sleem', 'images\\Ismail Kadi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Typist', NULL, NULL),
(318, 'Rita Nader', 39, 'Senior Supporter', 1, '2022-11-18', '2098', 'ritanader20102001@gmail.com', '70-530843', 'No', 'Burj Hammoud ', 'images\\Rita Nader.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(319, 'Ahmad Doueiry', 39, 'Senior Supporter', 1, '2022-03-16', '2025', 'ahmad.dwary@gmail.com', '76-395109', 'Yes', 'Tarik Jdideh ', 'images\\ahmad doueiry.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(320, 'Jinane Wehbe', 39, 'Team Member', 1, '2024-02-13', '2781', 'jina.wehbe2016@gmail.com', '76-681485', 'Yes', 'Sin Al Fil', 'images/67be11e4989e4.png', '2025-02-24 22:00:00', '2025-02-25 16:54:28', 'Cashier', NULL, NULL),
(321, 'Yehya Mashakah', 39, 'Team Member', 1, '2024-04-01', '2014', 'ymashakah@gmail.com', '76-843369', 'Moto', 'Cornishe Al Mazraa', 'images/67be11e98a3d1.png', '2025-02-24 22:00:00', '2025-02-25 16:54:33', 'Stationery Sales Force', NULL, NULL),
(322, 'Hassan Sabea', 15, 'Manager', 1, '2010-01-01', '1443', 'Hasabea@ gmail.com', '03038243', 'Moto', 'Tahwita Sayed Street', 'images\\Hassan Sabea.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(323, 'Elie Beaino', 15, 'Senior Specialist', 1, '2014-05-14', '2197', 'eliebeaino89@gmail.com', '71-160583', 'No', 'Zouk Mikhael', 'images/67be07cc64941.png', '2025-02-24 22:00:00', '2025-02-25 16:11:24', 'Graphic Designer', NULL, NULL),
(324, 'Rami Reda', 15, 'Senior Supervisor', 1, '2018-08-09', '2786', 'ridarami023@gmail.com', '76/779094', 'No', 'Ras Al Nabea', 'images\\Rami Reda.png', '2025-02-24 22:00:00', '2025-02-25 16:45:57', 'Team Leader', NULL, NULL),
(325, 'Mohamad Slim', 15, 'Specialist', 1, '2020-11-06', '1727', 'ctrlz.co@gmail.com', '03 918 497', 'Yes', 'Tripoli', 'images\\Mohamad Slim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(326, 'Nour Yammine', 15, 'Senior Supporter', 1, '2022-11-25', '2101', 'nouryammine10@gmail.com', '79-129076', 'No', 'Naher Al Kalb', 'images\\Nour Yammine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(327, 'Omar Haddarah', 15, 'Senior Supporter', 1, '2022-11-05', '1987', 'omar.haddarah.120@gmail.com', '71-379199', 'No', 'Tarik Jdideh ', 'images\\Omar Haddarah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(328, 'Mohamad Domiaty', 15, 'Senior Supporter', 1, '2012-10-20', '1971', '', '70-705941', 'Moto', 'Al Shiyah ', 'images\\Mohamad Domiaty.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(329, 'Bernard Kabboul', 15, 'Senior Supporter', 1, '2022-07-25', '1482', 'kabboul.bernard@gmail.com', '71-735198', 'No', 'Antelias', 'images\\Bernard Kabboul.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(330, 'Garine Dournayan', 15, 'Team Member', 1, '2024-10-07', '2509', 'dournayangarine@gmail.com', '76-454807', 'Moto', 'Bourj Hammoud', 'images/67be084abe544.png', '2025-02-24 22:00:00', '2025-02-25 16:13:30', 'Services', NULL, NULL),
(331, 'Lili Ghossen', 15, 'Team Member', 1, '2024-07-25', '1362', 'gholili280@gmail.com', '76-570638', 'No', 'Bouchrieh', 'images/67be0838a6a11.png', '2025-02-24 22:00:00', '2025-02-25 16:13:12', 'Cashier', NULL, NULL),
(332, 'Roberto Slim', 15, 'Team Member', 1, '2023-08-11', '2705', 'roberto.slim.2003@GMAIL.COM', '71-670996', 'Yes', 'Rawda', 'images\\Roberto Slim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(333, 'Ali Bechara', 15, 'Team Member', 1, '2024-09-18', '1694', 'alibechara211@gmail.com', '76-467816', 'Moto', 'Dahyeh', 'images/67be10c04d54a.png', '2025-02-24 22:00:00', '2025-02-25 16:49:36', 'Delivery', NULL, NULL),
(334, 'Kevin Menassa', 15, 'Team Member', 1, '2024-09-26', '1948', NULL, NULL, 'Moto', 'Al Shiyah ', 'images/67be10e161dee.png', '2025-02-24 22:00:00', '2025-02-25 16:50:09', 'Stationery Back Office', NULL, NULL),
(335, 'Richard Jabbour', 15, 'Team Member', 1, '2024-10-06', '1575', 'richard.jabbour2005@gmail.com', '81-745221', 'No', 'Awkar', 'images\\Richard Jabbour Sp Dbayeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(336, 'Maria Waked', 15, 'Supporter', 1, '2023-06-15', '2572', 'mariajwaked3@gmail.com', '81-249567', 'No', 'Naccache', 'images\\Maria Waked.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(337, 'Gio Estephan', 15, 'Junior Joker', 1, '2023-12-01', '1818', 'gioestephan@icloud.com', '76-564054', 'No', 'Sin Al Fil', 'images\\Gio Stephan Sp Dbayeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(338, 'Jean Claude Mattar', 15, 'Team Member', 1, '2023-07-12', '2610', 'jayceemattar@gmail.com', '81-993490', 'No', 'Safra', 'images\\Jean Claude Mattar.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(339, 'Jean Pierre Khoury', 15, 'Team Member', 1, '2024-07-16', '1114', NULL, NULL, 'Yes', 'Bsalim ', 'images\\Jean Pierre Khoury Sp Dbayeh.png', '2025-02-24 22:00:00', '2025-02-25 16:56:14', 'Stationery Sales Force', NULL, NULL),
(340, 'Majd Noun', 15, 'Team Member', 1, '2024-07-16', '1398', 'majdnoun25@gmail.com', '76-067766', 'No', 'Naccache', 'images\\Majd Noun Sp Dbayeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(341, 'Mickael Khoury', 15, 'Team Member', 1, '2024-08-23', '1708', 'mickealkhoury06@gmail.com', '71-898158', 'No', 'Dbayeh', 'images\\Micheal Khoury Sp Dbayeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(342, 'Diala Barakat', 31, 'Manager', 1, '2012-10-09', '1967', 'Dialab14@gmail.com', '81683911', 'Yes', 'Kfarmatta', 'images\\Diala Barakat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(343, 'Suzanne Kaedbay', 31, 'Supervisor', 1, '2022-09-15', '1531', '', '', 'Moto', 'Al Shiyah ', 'images\\Suzanne KaedBay.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(344, 'Aya Turk', 31, 'Senior Specialist', 1, '2015-07-30', '2436', 'Ayousha_turk@hotmail.com', '71-403683', 'No', 'Saida ', 'images\\Aya Turk.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(345, 'Issa Rustom', 31, 'Senior Supporter', 1, '2017-08-01', '1004', 'issa_rustom_97@hotmail.com', '76-635928', 'No', 'Zeidaniyeh', 'images\\Issa Rustom.png', '2025-02-24 22:00:00', '2025-02-25 16:46:10', 'Computer Operator', NULL, NULL),
(346, 'Mohamad Iskaf', 31, 'Senior Supporter  ', 1, '2000-03-02', '210', '', '03-936657', 'Moto', '', 'images\\Mohamad Iskaf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Delivery', NULL, NULL),
(347, 'Sarjoun Rafeh', 31, 'Supporter', 1, '2023-09-04', '2581', 'sarjounrafeh11@gmail.com', '70-846510', 'Yes', 'Bsatine', 'images\\Sarjoun Rafeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(348, 'Rayan Edelbi', 31, 'Supporter', 1, '2023-06-01', '2534', 'rayanedelbi555@gmail.com', '76-032582', 'Moto', 'Tarik Al Jdideh', 'images\\Rayan Edelbi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(349, 'Celine Ismail', 31, 'Team Member', 1, '2024-08-09', '1203', 'celineismail123@gmail.com', '', 'No', 'Iklim El Kharroub', 'images\\Celine Ismail.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(350, 'Adeeb Al Gharib', 31, 'Senior Supporter', 1, '2022-11-03', '1980', 'alghareebadeeb8@gmail.com', '81 790 007', 'No', 'Kfarmatta', 'images\\Adeeb Al Gharib.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(351, 'Jad Safsouf', 31, 'Team Member', 1, '2024-06-04', '1383', 'Jad_safsouf@hotmail.com', '76-081915', 'Moto', 'Bchamoun', 'images\\Jad Safsouf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Back Office', NULL, NULL),
(352, 'Hassan Alawieh', 31, 'Junior Joker', 1, '2023-11-11', '1189', 'alawieh246@GMAIL.COM', '76-960728', 'Yes', 'Bir Hassan', 'images\\Hassan Alawieh Sp Jnah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Joker', NULL, NULL),
(353, 'Bassel Younis', 31, 'Supporter', 1, '2023-08-29', '2441', 'bassel.younes123@gmail.com', '70-396870', 'No', 'Haret Hreik', 'images\\Bassel Younis.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(354, 'Lilas Fakhreddine', 31, 'Supporter', 1, '2024-03-15', '1616', 'lilyfakhreddine9@gmail.com', '81-250795', 'No', 'Ain Anoub', 'images\\Lilas Fakhreddine Sp Jnah.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(355, 'Hadi Shehab', 31, 'Team Member', 1, '2024-09-11', '2448', '123hadi1234hadi@gmail.com', '81-634982', 'No', 'Mrayjeh', 'images\\Hadi Chehab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(356, 'Lara Malaeb', 40, 'Supervisor', 1, '2022-12-09', '2193', 'laraa.h.malaeb@gmail.com', '70-362671', 'No', 'Beanay', 'images\\Lara Malaeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(357, 'Lidia Hamdan', 40, 'Team Leader', 1, '2022-10-14', '1953', 'lidiahamdan18@gmail.com', '76-181712', 'No', 'Hamra', 'images\\Lidia Hamdan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(358, 'Ola Fakher', 40, 'Junior Stationery', 1, '2022-10-01', '1845', 'ola.fakhr123@gmail.com', '76-476916', 'No', 'Deir Qoubel', 'images\\Ola Fakher.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(359, 'Amir Kaedbey', 40, 'Supporter', 1, '2021-09-01', '1641', 'amirkaedbey02@gmail.com', '70-836407', 'No', 'Ain Anoub', 'images\\Amir Kaedbey.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(360, 'Sara Jurdi', 40, 'Team Member', 1, '2024-02-09', '2780', 'sarajurdi916@gmail.com', '70-282654', 'No', 'Aramoun', 'images\\Sara Al Jurdi Spot C.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(361, 'Nancy Abou Ibrahim', 40, 'Team Member', 1, '2023-12-04', '1452', 'nancyalameddine9@gmail.com', '76-778113', 'No', 'Aitat', 'images\\Nancy Abou Ibrahim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(362, 'Hassan Sleiman', 75, 'Senior Specialist', 1, '2009-10-09', '1356', 'hassan_sleiman@msn.com', '71-423160', 'Yes', 'Sfeir', 'images\\hasan sleiman.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Graphic Designer', NULL, NULL),
(363, 'Hadi El Hassan', 75, 'Senior Supporter', 1, '2022-04-05', '2036', 'haddy_ab@hotmail.com', '70-988612', 'Moto', 'Basta', 'images\\hadi al hasan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(364, 'Ahmad Doughan', 75, 'Senior Representative', 1, '2015-06-16', '2398', '', '70-050879', 'Yes', 'Tarik Jdideh ', 'images\\ahmad doughan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(365, 'Adham Jawhary', 75, 'Senior Representative', 1, '2014-06-06', '2210', 'azadhazan@hotmail.com', '70-762705', 'Yes', 'Aramoun', 'images\\adham jawhary.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(366, 'Mohamad Faraj', 75, 'Specialist', 1, '2015-09-08', '2471', '', '71-858771', 'Yes', 'Borj El Barajneh', 'images\\mohamad faraj.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(367, 'Sami Kassabieh', 75, 'Supporter', 1, '2024-09-16', '2655', 'samikassabiehh@gmail.com', '76-933512', 'Yes', 'Ras El Nabeh', 'images\\Sami Kassabieh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(368, 'Zeina Ballout', 35, 'Supervisor', 1, '2006-05-30', '728', '', '', 'No', 'Jbeil', 'images\\Zeina Ballout.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(369, 'Silvana Ghyee', 35, 'Supporter', 1, '2023-12-17', '2703', 'silvana_ghieh@hotmail.com', '71-004170', 'No', 'Akkar', 'images\\Silvana Ghyee.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(370, 'Anthony Harb', 35, 'Junior Cashier', 1, '2024-03-14', '2031', 'anthonyharb2017@gmail.com', '76-190549', 'Yes', 'Jbeil', 'images\\Anthony Harb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(371, 'Mustafa Al Assir', 76, 'Senior Supervisor', 1, '2021-12-06', '2141', 'safi.assir@gmail.com', '03-190709', 'Yes', 'Saida', 'images\\ASSIR.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(372, 'Nizar Al Souri', 76, 'Senior Supervisor', 1, '2009-10-03', '1350', '', '', 'Yes', 'Haret Hreik', 'images\\nizar al souri.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(373, 'Hanaa Breish', 76, 'Senior Supervisor', 1, '2014-08-06', '2233', 'habaobano2a@hotmail.com', '76-191339', 'Yes', 'Choueifat', 'images\\hanaa breish.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(374, 'Maher Al Labban', 76, 'Senior Supporter', 1, '1998-11-23', '214', 'MaherLabban1974@gmail.com', '70-857200', 'Yes', 'Madini Riyadiyi ', 'images\\maher labban.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(375, 'Mona Nahed', 76, 'Supervisor', 1, '2004-02-03', '456', 'monaabouabdallah@gmail.com', '03-086916', 'Yes', 'Burj Hammoud ', 'images\\mona nahed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(376, 'Amin Barakat', 17, 'Manager', 1, '1987-03-16', '129', 'aminbarakat03@gmail.com', '71592423', 'Yes', 'Choueifat', 'images\\Amin Barakat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(377, 'Carine Chreif', 17, 'Supervisor', 1, '2022-02-04', '1901', 'chreifcarine62@gmail.com', '81-941435', 'No', 'Burj Al Barajneh', 'images\\Carine Chreif.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(378, 'Mirvat Charafdine', 17, 'Representative', 1, '2005-09-05', '614', '', '03-801875', 'Moto', 'Al Shiyah ', 'images\\Mirvat Charafdine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(379, 'Manal Hamza', 17, 'Senior Representative', 1, '2006-09-27', '758', '', '70-914340', 'Moto', 'Al Shiyah ', 'images\\Manal Hamza.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(380, 'Omar Khankan', 17, 'Supporter', 1, '2023-12-13', '1216', 'omarkh20172016@gmail.com', '76-976117', 'Yes', 'Noueiri', 'images\\Omar Khankan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(381, 'Alaa El Baghdadi', 17, 'Junior Cashier', 1, '2023-10-31', '1142', 'ayaalaaapple@gmail.com', '81-639409', 'No', 'Ras Al Nabea', 'images\\Alaa Al Baghdadi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(382, 'Ibrahim Kolailat', 17, 'Junior Services', 1, '2023-10-01', '2182', 'elylet.elylet@gmail.com', '70-419707', 'Moto', 'Burj Al Barajneh', 'images\\Ibrahim Kolailat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(383, 'Rida Al Gharib', 17, 'Senior Supporter', 1, '2022-11-02', '1982', 'rida.ghareeb.66@gmail.com', '70 899 878', 'No', 'Kfarmatta', 'images\\Rida Al Ghareeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(384, 'Jad Ayash', 17, 'Supporter', 1, '2022-10-04', '1807', 'jadayash11@gmail.com', '81-752303', 'Yes', 'Aramoun', 'images\\Jad Ayash.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(385, 'Khalil Chehade', 17, 'Team Member', 1, '2024-06-10', '2146', 'fatenhamoud25@gmail.com', '81-715372', 'No', 'Tayouneh', 'images\\Khalil Chehade Verdun.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(386, 'Nazira Malaeb', 50, 'Executive', 1, '2006-04-20', '716', 'nazira.malaeb@gmail.com', '71/459766', 'Yes', 'Baissour', 'images\\Nazira Malaeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(387, 'Nour Imad', 50, 'Senior Representative', 1, '2007-03-26', '843', 'nourimad2015@gmail.com', '78-883678', 'No', 'Kabreshmoun', 'images\\Nour Imad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(388, 'Raed Al Kadi', 50, 'Specialist', 1, '2006-06-30', '747', 'www_raed_747@hotmail.com', '03-441168', 'No', 'Mejdlaya', 'images\\Raed Al Kadi.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(389, 'Mahmoud Hussein', 50, 'Representative', 1, '2010-11-02', '1632', 'mahmoudhussein007@hotmail.com', '71-216821', 'No', 'Jnah', 'images\\Mahmoud Hussein.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(390, 'Howaida Shrity', 50, 'Specialist', 1, '2006-10-04', '764', 'Howaida.saso@hotmail.com', '03-045118', 'Yes', 'Abey', 'images\\Howaida Shrity.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(391, 'Mohamad Al Chami', 50, 'Senior Specialist', 1, '2003-04-08', '331', 'mohammedsameh05@outlook.com', '76 644 634', 'No', 'Saadiyat', 'images\\Mohamad Al Chami.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(392, 'Mazen Ayache', 50, 'Representative', 1, '2007-08-21', '913', '', '03-518691', 'No', 'Aisha Bakkar ', 'images\\Mazen Ayache.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(393, 'Omar Diab', 50, 'Junior Back Office', 1, '2023-03-25', '2356', 'abu3mer111.od@gmail.com', '71-291130', 'Moto', 'Burj Abou Haidar', 'images\\Omar Diab.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(394, 'Amal Saker', 50, 'Junior Back Office', 1, '2023-03-29', '2389', 'malobarake@gmail.com', '70-667943', 'No', 'Madini Riyadiyi ', 'images\\Amal Sakr.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office', NULL, NULL),
(395, 'Nehme Doghman', 50, 'Back Office', 1, '2022-10-01', '1907', '', '', 'No', 'Iklim El Kharroub', 'images\\Nehme Doghman.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(396, 'Hussein Sawli', 50, 'Team Member', 1, '2024-09-14', '2295', '', '', 'Moto', 'Al Shiyah ', 'images\\Hussein Sawli.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(397, 'Sarah Al Issa', 50, 'Team Member', 1, '2024-11-12', '1898', '', '71-379733', 'Moto', 'Al Shiyah ', 'images\\Sara Al Issa.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(398, 'Kassem Ajami', 77, 'Supervisor', 1, '2016-10-11', '2607', 'ajami-68@live.com', '03-135405', 'No', 'Al Mreyje', 'images\\kassem ajami.png', '2025-02-24 22:00:00', '2025-02-25 16:46:23', 'Team Leader', NULL, NULL),
(399, 'Pascal Al Haj', 45, 'Manager', 1, '1999-11-07', '169', 'pascal.elhajj@gmail.com', '71-230796', 'Yes', 'Kayfoun', 'images\\Pascal Al Haj.png', '2025-02-24 22:00:00', '2025-02-27 10:38:26', 'Team Leader', NULL, NULL),
(400, 'Basil Khaddaj', 45, 'Senior Supervisor', 1, '2009-01-23', '1178', 'basil_khaddaj @hotmail.com', '03421335', 'Yes', 'Kfarmatta', 'images\\Basil Khaddaj.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(401, 'Samer Assaf', 45, 'Specialist', 1, '1988-06-01', '168', '', '76 661 228', 'No', '', 'images\\Samer Assaf.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office ', NULL, NULL),
(402, 'Wissam Al-Daroub', 45, 'Coordinator', 1, '1998-11-18', '124', '', '', 'Moto', 'Al Shiyah ', 'images\\Wissam Al-Daroub.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(403, 'Mohamad Joumaa', 45, 'Specialist', 1, '1998-01-20', '123', '', '03-256508', 'No', 'Byakout', 'images\\Mohamad Joumaa.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(404, 'Marwan Al-Souri', 45, 'Specialist', 1, '1996-11-07', '120', '', '', 'Moto', 'Al Shiyah ', 'images\\marwan al souri.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(405, 'Houssein Sabra', 45, 'Senior Supporter', 1, '2019-09-20', '2573', 'houssein111@gmail.com', '', 'No', 'Iklim El Kharroub', 'images\\Houssein Sabra.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(406, 'Makram Rajeh', 45, 'Senior Representative', 1, '1998-10-01', '136', '', '70-063748', 'No', 'Baakline', 'images\\Makram Rajeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(407, 'Loay Alameh', 45, 'Supporter', 1, '2015-12-08', '2492', 'Loay-alameh@hotmail.com', '76-805374', 'No', 'Kfarhaseed', 'images\\loay alameh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(408, 'Mohamad Ossaily', 45, 'Junior Back Office', 1, '2017-12-27', '1274', 'ossailymoe@gmail.com', '70/408917', 'No', 'Jnah ', 'images\\mohamad osseily.png', '2025-02-24 22:00:00', '2025-02-25 16:46:38', 'Back Office Warehouse', NULL, NULL),
(409, 'Jamal Al-Khatib', 45, 'Supporter', 1, '2002-06-24', '274', '', '03-709695', 'Moto', 'Al Shiyah ', 'images\\Jamal Al-Khatib.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(410, 'Abed Rahim Shouman', 45, 'Supporter', 1, '2022-04-12', '2070', 'nice.love.4ever@live.com', '70-647918', 'Moto', 'Airport Road', 'images\\Abed Rahim Shouman.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(411, 'Ahmad Ayyad', 45, 'Supporter', 1, '2012-01-01', '1885', '', '03-086142', 'No', 'Haret Hreik', 'images\\Ahmad Ayyad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(412, 'Mohammad Hoss', 45, 'Supporter', 1, '2023-01-04', '2225', 'mhmdhoss765@gmail.com', '70-173855', 'No', 'Tarik Al Jdideh', 'images\\Mohd Hoss.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(413, 'Joumana Mansour', 45, 'Supporter', 1, '2011-07-02', '1794', 'joujou_swt@hotmail.com', '03-101672', 'No', '', 'images\\joumana mansour.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Back Office Warehouse', NULL, NULL),
(414, 'Mazen Sheikh', 45, 'Team Member', 1, '2024-11-28', '2105', 'mazen.sheikh23@icloud.com', '70-818908', 'Moto ', 'Tarik Al Jdideh', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(415, 'Ibrahim Sabeh', 45, 'Junior Back Office', 1, '2024-06-11', '1750', '', '', 'Moto', 'Al Shiyah ', 'images\\Ibrahim Al Sabea WH3.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(416, 'Omar Abou Daher', 45, 'Team Member', 1, '2023-06-21', '2583', 'omaraboudaher56@gmail.com', '81-711621', 'Moto', 'Burj Abi Haidar', 'images\\omar abo zaher.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(417, 'Mohamad Zeineddine', 45, 'Team Member', 1, '2023-04-01', '1481', 'mzeinedin83@gmail.com', '03-010751', 'Moto', 'Choueifat', 'images\\mohammad zeineddine.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(418, 'Rabih Deeb', 45, 'Team Member', 1, '2023-08-01', '2686', '', '70-802147', 'Moto', 'Al Shiyah ', 'images\\rabih deeb.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Porter', NULL, NULL),
(419, 'Rand Khaled', 45, 'Team Member', 1, '2024-03-12', '1812', 'ghadercell019@gmail.com', '81-838119', 'Moto', 'Tarik Al Jdideh', 'images\\Rand Khaled WH3.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(420, 'Ahmad Jarekji', 45, 'Team Member', 1, '2024-12-26', '1550', 'jarekjiahmad@gmail.com', '03-485319', 'Moto', 'Basta', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(421, 'Wafic Doughan', 78, 'Officer', 1, '2014-09-10', '2256', 'wafic.doughan@hotmail.com', '76-704544', 'Yes', 'Madini Riyadiyi ', 'images\\Wafic Doughan.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(422, 'Rana Joubaily', 78, 'Senior Supervisor', 1, '2003-10-04', '421', '', '', 'Moto', 'Al Shiyah ', 'images\\Rana Joubaily.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(423, 'Farah Bou Naim', 78, 'Specialist', 1, '2015-05-07', '2381', '', '76-022468', 'No', 'Choueifat', 'images\\Farah Bou Naim.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Tele sales', NULL, NULL),
(424, 'Mazen Saad', 78, 'Senior Supporter ', 1, '2013-04-02', '2012', 'mazen_saad73@hotmail.com', '70-939137', 'No', 'Kayfoun', 'images\\Mazen Saad.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Van Driver', NULL, NULL),
(425, 'Ali Srour', 78, 'Supporter', 1, '2024-05-30', '1374', 'alisrur@gmail.com', '71-259430', 'Yes', 'Kafaat ', 'images\\ali srour.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Outdoor Sales', NULL, NULL),
(426, 'Samir Fayed', 19, 'Officer', 1, '2019-03-28', '1726', 'sameerfayed20@gmail.com', '71 285 388', 'Yes', 'Basta AL fawka', 'images\\samir fayed.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(427, 'Chady Eid', 19, 'Senior Supporter', 1, '2021-12-02', '1442', 'chadyeid8@gmail.com', '79-188230', 'No', 'Ajaltoun', 'images\\Chady Eid.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(428, 'Elsy Farhat', 19, 'Supervisor', 1, '2023-08-26', '2362', 'elsyfarhat42@gmail.com', '70-130257', 'No', 'Zouk Mosbeh', 'images\\Elsy Farhat.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Team Leader', NULL, NULL),
(429, 'Mark Saadeh', 19, 'Supporter', 1, '2021-10-01', '1840', 'mark96.saade@gmail.com', '71-367396', 'No', 'Dbayeh', 'images\\Marc Saadeh.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(430, 'Nadine Baaklini', 19, 'Specialist', 1, '2015-03-01', '2347', '', '76-058720', 'No', '', 'images\\Nadine Baaklini.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(431, 'Celine Salem', 19, 'Junior Cashier', 1, '2024-04-01', '1514', 'celinesalem14@gmail.com', '76-889084', 'No', 'Zouk Mosbeh', 'images\\Celine Salem Zouk.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery', NULL, NULL),
(432, 'Joe Zgheib', 19, 'Junior Services', 1, '2024-01-12', '1978', 'zgheibjoe31@gmail.com', '70-586179', 'Yes', 'Zouk Mikhael', 'images\\Joe Zgheib.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(433, 'Raul Nader', 19, 'Team Member', 1, '2023-08-22', '2782', 'raulnader@gmail.com', '71-540680', 'No', 'Zouk Mosbeh', 'images\\Raul Nader Zouk.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(434, 'Giorgio Saliba', 19, 'Team Member', 1, '2024-05-07', '2768', 'giorgiosaliba9@gmail.com', '76-650037', 'Yes', 'Awkar', 'images\\Gorgio Saliba Zouk.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(435, 'Eugenie Hakim', 19, 'Team Member', 1, '2024-12-07', '2092', 'jennyhakimm@gmail.com', '79-316786', 'Yes', 'Ballouneh', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(436, 'Kassem Mohammad', 45, 'Team Member', 1, '2025-01-02', '2314', 'dragon_dangerous56@hotmail.com', '70-949114', 'Moto', 'Tarik Al Jdideh', 'images\\kassem.png', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Warehouse', NULL, NULL),
(437, 'Cynthia Asfar', 38, 'Supporter', 1, '2025-01-14', '2873', '', '', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(438, 'Ibrahim Korkomaz', 22, 'Team Member', 1, '2025-01-14', '2871', 'bob.2006korkomaz@gmail.com', '81-667768', 'No', 'Sfeir', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(439, 'Abdallah Massoud', 11, 'Team Member', 1, '2025-01-14', '2759', '', '', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(440, 'Jana Yaccoub', 24, 'Supporter', 1, '2025-01-14', '2872', '', '76-306151', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Computer Operator', NULL, NULL),
(441, 'Ahmad Zein', 11, 'Team Member ', 1, '2025-01-14', '2695', '', '', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(442, 'Andrew Ayoub', 15, 'Team Member ', 1, '2025-01-15', '2878', 'andreewayoub@outlook.com', '76-881042', 'Both', 'Dawra', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(443, 'Hadi Cheaito', 39, 'Team Member ', 1, '2025-01-15', '2879', '', '71-311153', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL);
INSERT INTO `employee_info` (`id`, `name`, `branch_id`, `title`, `status`, `date_hired`, `pin_code`, `email`, `phone`, `car`, `address`, `image_path`, `created_at`, `updated_at`, `job`, `left_date`, `birthday`) VALUES
(444, 'Reine Cherry', 32, 'Team Member ', 1, '2025-01-15', '2870', 'cherry.f.reine@gmail.com', '76-915863', 'No', 'Hadath', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(445, 'Hussein Taleb', 70, 'Team Member ', 1, '2025-01-15', '2876', 'talebhussein98@gmail.com', '81-748076', 'No', 'Jnah', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(446, 'Amir Ahmadieh', 68, 'Team Member ', 1, '2025-01-16', '2877', 'amirahmadieh777@gmail.com', '71-304397', 'No', 'Sawfar', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(447, 'Elio Rajha', 28, 'Team Member ', 1, '2025-01-16', '2875', 'rajhaelio@gmail.com', '76-146525', 'No', 'Mansourieh', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Sales Force', NULL, NULL),
(448, 'Mohammad Abo Jamous', 27, 'Team Member ', 1, '2025-01-23', '2882', '', '81-638223', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Services', NULL, NULL),
(449, 'Sima Baydoun', 23, 'Team Member ', 1, '2025-01-24', '2874', 'sab084@student.bau.edu.lb', '71-336743', 'No', 'Sodeco', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Cashier', NULL, NULL),
(450, 'Ahmad Mordaa', 42, 'Team Member ', 1, '2025-01-26', '2881', 'ahmadmordaa68@gmail.com', '71-128533', 'Moto', 'Basta', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Back Office', NULL, NULL),
(451, 'Khalil Mahassen', 33, 'Team Member ', 1, '2025-01-27', '2880', '', '70-932837', 'Moto', 'Al Shiyah ', 'images\\Default.jpg', '2025-02-24 22:00:00', '2025-02-24 22:00:00', 'Stationery Back Office', NULL, NULL),
(452, 'Test Emp', 67, 'Supervisor', 1, '2000-10-10', '90988777', 'test@testttt.com', '8937213891269', 'No', NULL, 'images/67c167adf33dd.jpg', '2025-02-26 06:21:18', '2025-02-28 05:37:18', 'Team Leader', NULL, NULL),
(454, 'Tania Khadaj', 73, 'Senior Manager', 1, '2011-10-10', '123-test', 'tania@tania.com', '71 744 077', 'Yes', 'Kfarmata', 'images/67c18c97c6c24.jpg', '2025-02-28 08:14:47', '2025-02-28 08:14:47', 'Team Leader', NULL, '1990-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_phase_progress`
--

DROP TABLE IF EXISTS `employee_phase_progress`;
CREATE TABLE IF NOT EXISTS `employee_phase_progress` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `phase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_at` date DEFAULT NULL,
  `next_phase_start_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_phase_progress_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(34, '2025_02_21_090249_add_remarks_to_new_joiner_progress', 8),
(35, '2025_02_25_180257_add_car_address_birthday_to_employee_info_table', 9),
(36, '2025_02_25_182118_update_email_phone_nullable_in_employee_info_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 'App\\Models\\User', 2),
(10, 'App\\Models\\User', 8);

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_joiner`
--

INSERT INTO `new_joiner` (`id`, `name`, `mode`, `start_date`, `job`, `created_at`, `updated_at`) VALUES
(24, 'Maher Labban', 'full-time', '2025-02-26', 'Stationery', '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(25, 'Mira Mahmoud', 'part-time', '2025-02-23', 'Graphic designer', '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
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
  `status` enum('pending','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `new_joiner_progress_new_joiner_id_foreign` (`new_joiner_id`),
  KEY `new_joiner_progress_step_id_foreign` (`step_id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_joiner_progress`
--

INSERT INTO `new_joiner_progress` (`id`, `new_joiner_id`, `step_id`, `status`, `remarks`, `completed_at`, `created_at`, `updated_at`) VALUES
(135, 25, 6, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
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
(136, 25, 8, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(137, 25, 5, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(138, 25, 7, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(139, 25, 9, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(133, 25, 1, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(134, 25, 2, 'pending', NULL, NULL, '2025-02-21 11:54:41', '2025-02-21 11:54:41'),
(132, 24, 9, 'pending', NULL, NULL, '2025-02-21 11:29:51', '2025-02-21 11:29:51'),
(119, 23, 1, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:42', '2025-02-21 11:30:02'),
(120, 23, 2, 'completed', NULL, '2025-02-20 22:00:00', '2025-02-21 11:29:42', '2025-02-21 11:57:41'),
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
) ENGINE=MyISAM AUTO_INCREMENT=402 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(320, 3, 'admin_alert', 'Shadi Farhat IT has created a transfer for Aya Al Kaissi to branch IT Department', '2025-02-17 07:48:00', 1, '2025-02-17 07:48:00', '2025-02-21 11:58:04', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
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
(322, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Kifah Ghanam with the job of Back Office.', '2025-02-18 12:13:06', 1, '2025-02-18 12:13:06', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(105, 3, 'admin_alert', 'Mira Mahmoud has created a new employee named Lara Malaeb with the job of Manager.', '2025-02-13 10:14:42', 1, '2025-02-13 10:14:42', '2025-02-13 10:18:10', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(324, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Maher Labban with the job of Services.', '2025-02-18 12:15:48', 1, '2025-02-18 12:15:48', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(321, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Kifah Ghanam with the job of Back Office.', '2025-02-18 12:13:06', 0, '2025-02-18 12:13:06', '2025-02-18 12:13:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(313, 3, 'admin_alert', 'Shadi Farhat IT has created a transfer for Aya Al Kaissi to branch IT Department', '2025-02-14 12:51:51', 1, '2025-02-14 12:51:51', '2025-02-14 12:53:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(325, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nouhad Tabara with the job of Back Office.', '2025-02-18 12:20:07', 0, '2025-02-18 12:20:07', '2025-02-18 12:20:07', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(326, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nouhad Tabara with the job of Back Office.', '2025-02-18 12:20:07', 1, '2025-02-18 12:20:07', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(327, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jinane Wehbe with the job of Cashier.', '2025-02-18 12:48:38', 0, '2025-02-18 12:48:38', '2025-02-18 12:48:38', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(328, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jinane Wehbe with the job of Cashier.', '2025-02-18 12:48:38', 1, '2025-02-18 12:48:38', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(329, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jad Abboud with the job of Cashier.', '2025-02-18 12:49:52', 0, '2025-02-18 12:49:52', '2025-02-18 12:49:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(330, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Jad Abboud with the job of Cashier.', '2025-02-18 12:49:52', 1, '2025-02-18 12:49:52', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(331, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rami Al Hakim with the job of Graphic designer.', '2025-02-18 12:51:30', 0, '2025-02-18 12:51:30', '2025-02-18 12:51:30', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(332, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rami Al Hakim with the job of Graphic designer.', '2025-02-18 12:51:30', 1, '2025-02-18 12:51:30', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(333, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Aslan Khaddaj with the job of Graphic designer.', '2025-02-18 12:52:00', 0, '2025-02-18 12:52:00', '2025-02-18 12:52:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(334, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Aslan Khaddaj with the job of Graphic designer.', '2025-02-18 12:52:00', 1, '2025-02-18 12:52:00', '2025-02-21 11:58:03', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(335, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Karim Hakim with the job of Graphic designer.', '2025-02-18 12:52:32', 0, '2025-02-18 12:52:32', '2025-02-18 12:52:32', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(336, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Karim Hakim with the job of Graphic designer.', '2025-02-18 12:52:32', 1, '2025-02-18 12:52:32', '2025-02-21 11:58:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(337, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Adam Khansa with the job of Stationery.', '2025-02-18 12:53:02', 0, '2025-02-18 12:53:02', '2025-02-18 12:53:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(338, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Adam Khansa with the job of Stationery.', '2025-02-18 12:53:02', 1, '2025-02-18 12:53:02', '2025-02-21 11:58:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(339, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Cheaito with the job of Stationery.', '2025-02-18 12:54:22', 0, '2025-02-18 12:54:22', '2025-02-18 12:54:22', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(340, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Cheaito with the job of Stationery.', '2025-02-18 12:54:22', 1, '2025-02-18 12:54:22', '2025-02-21 11:58:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(341, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Graizy with the job of Cashier.', '2025-02-18 12:55:28', 0, '2025-02-18 12:55:28', '2025-02-18 12:55:28', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(342, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Graizy with the job of Cashier.', '2025-02-18 12:55:28', 1, '2025-02-18 12:55:28', '2025-02-21 11:58:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(343, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ceasar Al Ahmadie with the job of Services.', '2025-02-18 12:56:26', 0, '2025-02-18 12:56:26', '2025-02-18 12:56:26', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(344, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ceasar Al Ahmadie with the job of Services.', '2025-02-18 12:56:26', 1, '2025-02-18 12:56:26', '2025-02-21 11:58:02', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(345, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ahmad Dwayre with the job of Services.', '2025-02-18 12:56:54', 0, '2025-02-18 12:56:54', '2025-02-18 12:56:54', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(346, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ahmad Dwayre with the job of Services.', '2025-02-18 12:56:54', 1, '2025-02-18 12:56:54', '2025-02-21 11:58:01', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(347, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Mariam Tohme with the job of Stationery.', '2025-02-18 12:57:21', 0, '2025-02-18 12:57:21', '2025-02-18 12:57:21', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(348, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Mariam Tohme with the job of Stationery.', '2025-02-18 12:57:21', 1, '2025-02-18 12:57:21', '2025-02-21 11:58:01', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(349, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rita Nader with the job of Stationery.', '2025-02-18 12:57:45', 0, '2025-02-18 12:57:45', '2025-02-18 12:57:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(350, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Rita Nader with the job of Stationery.', '2025-02-18 12:57:45', 1, '2025-02-18 12:57:45', '2025-02-21 11:58:01', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(351, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hasasn Awad with the job of Cashier.', '2025-02-18 12:58:27', 0, '2025-02-18 12:58:27', '2025-02-18 12:58:27', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(352, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hasasn Awad with the job of Cashier.', '2025-02-18 12:58:27', 1, '2025-02-18 12:58:27', '2025-02-21 11:58:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(353, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Yehya Mashakah with the job of Stationery.', '2025-02-18 12:59:04', 0, '2025-02-18 12:59:04', '2025-02-18 12:59:04', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(354, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Yehya Mashakah with the job of Stationery.', '2025-02-18 12:59:04', 1, '2025-02-18 12:59:04', '2025-02-21 11:58:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(355, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Georgette Tabett with the job of Typist.', '2025-02-18 12:59:37', 0, '2025-02-18 12:59:37', '2025-02-18 12:59:37', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(356, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Georgette Tabett with the job of Typist.', '2025-02-18 12:59:37', 1, '2025-02-18 12:59:37', '2025-02-21 11:58:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(357, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ismail Al Kadi with the job of Typist.', '2025-02-18 13:00:23', 0, '2025-02-18 13:00:23', '2025-02-18 13:00:23', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(358, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Ismail Al Kadi with the job of Typist.', '2025-02-18 13:00:23', 1, '2025-02-18 13:00:23', '2025-02-21 11:58:00', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(359, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Abou Dargham with the job of Manager.', '2025-02-18 13:01:06', 0, '2025-02-18 13:01:06', '2025-02-18 13:01:06', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(360, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Shadi Abou Dargham with the job of Manager.', '2025-02-18 13:01:06', 1, '2025-02-18 13:01:06', '2025-02-21 11:57:59', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(361, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Chirine Amar with the job of Manager.', '2025-02-18 13:01:52', 0, '2025-02-18 13:01:52', '2025-02-18 13:01:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(362, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Chirine Amar with the job of Manager.', '2025-02-18 13:01:52', 1, '2025-02-18 13:01:52', '2025-02-21 11:57:59', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(363, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Saher Shammas with the job of Manager.', '2025-02-18 13:02:45', 0, '2025-02-18 13:02:45', '2025-02-18 13:02:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(364, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Saher Shammas with the job of Manager.', '2025-02-18 13:02:45', 1, '2025-02-18 13:02:45', '2025-02-21 11:57:59', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(380, 3, 'admin_alert', 'Shadi Farhat IT has marked step \'To Interview with The HR Manager\' as completed for Dalia Mayassi.', '2025-02-21 11:57:41', 1, '2025-02-21 11:57:41', '2025-02-21 11:57:54', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(379, 3, 'admin_alert', 'Shadi Farhat IT has added Mira Mahmoud as a New Joiner Employee.', '2025-02-21 11:54:41', 1, '2025-02-21 11:54:41', '2025-02-21 11:57:54', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(367, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Majed with the job of Graphic designer.', '2025-02-19 07:16:17', 0, '2025-02-19 07:16:17', '2025-02-19 07:16:17', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(368, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Hadi Majed with the job of Graphic designer.', '2025-02-19 07:16:17', 1, '2025-02-19 07:16:17', '2025-02-21 11:57:59', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(369, 1, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nazek Baderdine with the job of Manager.', '2025-02-19 07:18:20', 0, '2025-02-19 07:18:20', '2025-02-19 07:18:20', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(370, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Nazek Baderdine with the job of Manager.', '2025-02-19 07:18:20', 1, '2025-02-19 07:18:20', '2025-02-21 11:57:58', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(371, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:28:45', 1, '2025-02-20 11:28:45', '2025-02-21 11:57:58', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(372, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:05', 1, '2025-02-20 11:31:05', '2025-02-21 11:57:58', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(373, 3, 'admin_alert', 'Shadi Farhat IT has created a new promotion for Shadi Farhat to the position of Executive.', '2025-02-20 11:31:32', 1, '2025-02-20 11:31:32', '2025-02-21 11:57:57', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(374, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:46', 1, '2025-02-20 11:31:46', '2025-02-21 11:57:56', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(375, 3, 'admin_alert', 'Shadi Farhat IT has deleted the promotion for Shadi Farhat for the title of Executive.', '2025-02-20 11:31:49', 1, '2025-02-20 11:31:49', '2025-02-21 11:57:56', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(376, 3, 'admin_alert', 'Shadi Farhat IT has created a new promotion for Shadi Farhat to the position of Executive.', '2025-02-20 11:32:02', 1, '2025-02-20 11:32:02', '2025-02-21 11:57:55', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(377, 3, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Cashier\' at ABC Verdun.', '2025-02-20 11:35:35', 1, '2025-02-20 11:35:35', '2025-02-21 11:57:54', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(378, 5, 'admin_alert', 'Mira Mahmoud has created a new vacancy for the job \'Cashier\' at ABC Verdun.', '2025-02-20 11:35:35', 1, '2025-02-20 11:35:35', '2025-02-20 12:23:40', 'user-images/WmhHso1J4vhtPcbCuc3olXZGiIDOQvSkDle2TzMy.jpg'),
(381, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Tarek Badawi, who was working as Graphic designer at Doculand Hamra.', '2025-02-25 15:50:38', 1, '2025-02-25 15:50:38', '2025-02-25 17:09:52', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(382, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Tarek Badawi with the job of Graphic designer.', '2025-02-25 15:54:16', 1, '2025-02-25 15:54:16', '2025-02-25 17:09:51', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(383, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Hadi Handam, who was working as Services at Ajaltoun.', '2025-02-25 15:54:51', 1, '2025-02-25 15:54:51', '2025-02-25 17:09:51', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(384, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Amin Barakat, who was working as Manager at Verdun.', '2025-02-25 15:54:53', 1, '2025-02-25 15:54:53', '2025-02-25 17:09:51', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(385, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Pamela Chamoun, who was working as Manager at ABC Verdun.', '2025-02-25 15:55:12', 1, '2025-02-25 15:55:12', '2025-02-25 17:09:50', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(386, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Mira, who was working as Cashier at ABC Verdun.', '2025-02-25 15:55:14', 1, '2025-02-25 15:55:14', '2025-02-25 17:09:50', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(387, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Elianne Chaker, who was working as Stationery at Jbeil.', '2025-02-25 15:55:17', 1, '2025-02-25 15:55:17', '2025-02-25 17:09:50', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(388, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Aslan Khaddaj, who was working as Graphic designer at Sin El Fill.', '2025-02-25 15:55:19', 1, '2025-02-25 15:55:19', '2025-02-25 17:09:49', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(389, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Jinane Wehbe, who was working as Cashier at Sin El Fill.', '2025-02-25 15:55:21', 1, '2025-02-25 15:55:21', '2025-02-25 17:09:49', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(390, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Jad Abboud, who was working as Cashier at Sin El Fill.', '2025-02-25 15:55:25', 1, '2025-02-25 15:55:25', '2025-02-25 17:09:49', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(391, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Adam Khansa, who was working as Stationery at Sin El Fill.', '2025-02-25 15:55:27', 1, '2025-02-25 15:55:27', '2025-02-25 17:09:48', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(397, 5, 'rotation_reminder', 'Reminder: The rotation for Test Emp at Test Branch will end on 24-03-2025.', '2025-03-24 10:22:45', 0, '2025-02-27 10:22:45', '2025-02-27 10:22:45', 'images/67becefeafcc0.png'),
(396, 3, 'admin_alert', 'Shadi Farhat IT has created a transfer for Test Emp to branch IT Department', '2025-02-26 11:20:33', 0, '2025-02-26 11:20:33', '2025-02-26 11:20:33', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(400, 3, 'admin_alert', 'Shadi Farhat IT has created a new employee named Tania Khadaj with the job of Team Leader.', '2025-02-28 08:14:47', 0, '2025-02-28 08:14:47', '2025-02-28 08:14:47', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(399, 3, 'admin_alert', 'Shadi Farhat IT has created a rotation for Test Emp to branch Test Branch', '2025-02-27 10:22:45', 0, '2025-02-27 10:22:45', '2025-02-27 10:22:45', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg'),
(401, 3, 'admin_alert', 'Shadi Farhat IT has deleted the employee named Tania Khadaj, who was working as Team Leader at Head Office.', '2025-02-28 08:15:11', 0, '2025-02-28 08:15:11', '2025-02-28 08:15:11', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(18, 'HR Member', 'web', '2025-02-20 11:50:14', '2025-02-20 11:50:14'),
(19, 'Sundays', 'web', '2025-02-28 06:48:00', '2025-02-28 06:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(8, 'Admin', 'web', '2025-02-20 08:57:47', '2025-02-20 08:57:47'),
(9, 'HR Team Member', 'web', '2025-02-20 09:15:50', '2025-02-20 09:15:50'),
(10, 'Services', 'web', '2025-02-26 06:13:16', '2025-02-26 06:13:16');

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
(1, 10),
(2, 8),
(3, 8),
(3, 9),
(3, 10),
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
(8, 10),
(9, 8),
(9, 9),
(10, 8),
(10, 9),
(10, 10),
(11, 8),
(11, 9),
(12, 8),
(12, 9),
(12, 10),
(13, 8),
(14, 8),
(14, 9),
(15, 8),
(15, 9),
(16, 8),
(17, 8),
(19, 8),
(19, 9);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9Dk2gsIT370ZALAlTW39YCILEjcv2Z0zhw5VJOZV', 5, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiMVRJOW1aOVYwb1FVbkxMS3YwRU5YT1RFV1B3YXVsdWgyekdlNWx5MSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbm90aWZpY2F0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo5OiJlbXBsb3llZXMiO2E6MjcyOntzOjEzOiJIdXNzZWluIEFiYmFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiTGlsaWFuIEhhYmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6IlplaW5hIEJhbGxvdXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxODoiU2hhZGkgQWJvdSBEYXJnaGFtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiTWF5c2FhIE1haG1vdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJJc3NhIFJ1c3RvbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjExOiJBbGkgTWVjaHJlZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ik1hemVuIEhhbGFiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6Ik1vaGFtYWQgQUwgRXRlciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTg6IkplYW4gUGllcnJlIEtob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTI6IlJpY2hhcmQgUml6ayI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6IkhhZHkgTGFraXNzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTW9oYW1hZCBBbCBFc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJQZXRlciBGYXJhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6Ik1hcm91biBIYWJjaHkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJSYXNoYSBIbWFkZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMzoiSGFzc2FuIFNhZmF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTQ6Ikhhc3NhbiBBbGF3aWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiUmVlbSBOb3VlaWhlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IkNlbGluZSBJc21haWwiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNjoiTW9oYW1hZCBBbCBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IkpvaG4gVGFubm91cnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiV2FmaWMgRG91Z2hhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiQWxpIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNjoiUmFzaGFkIEFsIE1vaHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6ODoiMiBTaGlmdHMiO2k6MTt9czoxNjoiSnVsaWVuIEVsIEtob3VyeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTozO31zOjEyOiJBaG1hZCBEZ2hlaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJBbnRob255IE1vdWFubmVzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiRWxpZSBOYWNjb3V6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6Ikx5bm4gQmFyYWthdCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTI6IkxpbGkgR2hvc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEwOiJSb3kgTWVyaGVqIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6OToiTWFqZCBOb3VuIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6IkthcmltIEhha2ltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxMzoiQW1pbmEgQWwgQXNoeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE2OiJNb2hhbWFkIEtpdG1pdHRvIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxODoiTmFuY3kgQWJvdSBJYnJhaGltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiUmltIE1vdW5sYSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJNYWhtb3VkIEhhc3NhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkJlcm5hcmQgS2FiYm91bCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6Ik9tYXIgS2Fzc2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiQ2VsaW5lIFNhbGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTM6Ik1vaGFtYWQgQmFubmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJBYmlyIEhhcmViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6Ik1hamQgU2hiYXR0IjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkpvZSBDaGFheWEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNToiQWRhbSBFbCBLY2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiUmljaGFyZCBKYWJib3VyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTA6IkphZCBBYmJvdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTozO31zOjk6IkpvZSBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTc6IkxpbGFzIEZha2hyZWRkaW5lIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTM6IkhhZHkgS2FkZG91cmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJTaGFkaSBHaHJhaXppIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRm91YWQgQXNzYWYiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoyMToiTW9oYW1hZCBKYWxhbCBBbCBIYWpqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiTWlja2FlbCBLaG91cnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJTYW1pciBGYXllZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTQ6Ik5vYW1hbiBEYWJib3VzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiQW50aG9ueSBJYnJhaGltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiR2lvIEVzdGVwaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiUm9sYW5kIEtoYXRlciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJNYXJrIFNhYWRlaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IlNhbWkgU2lubm8iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE1OiJSaXRhIE1hcmlhIEFkYXMiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMzoiU2FpZCBCYWFzc2lyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTU6Ikthc3NlbSBHaGFuZG91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IktldmluIE1lbmFzc2EiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNToiQWRlZWIgQWwgR2hhcmliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiRGFuaWVsIEFrYXoiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNDoiUmlkYSBBbCBHaGFyaWIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMzoiT21hciBIYWRkYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJWYW5lc3NhIE5vdW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiSG9kYSBCb3Vsb3MiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNDoiWWVoeWEgTWFzaGFrYWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NTtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJBaG1hZCBBdHRpZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMjoiTW9oYW1hZCBFaWRvIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiSGFuaW4gTWVra2F3aSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJIYWRpIEVsIEhhc3NhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkFtYW5pIFllaGlhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMDoiUml0YSBOYWRlciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJOb3VyIFlhbW1pbmUiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMjoiU2F5ZWQgQWJib3VkIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlNhaGVyIFNoYW1hcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTE6IkVsaWUgQmVhaW5vIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IkFkaGFtIEphd2hhcnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJXYWVsIFphaGVkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMDoiR2lhIE1rYWhhbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE1OiJFbGlzc2EgTWFraGxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJFbGllIFNhbGliYSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IlNhcmFoIEF3d2FkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiRGpvc2VwaCBFbCBIYWpqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiTm91ciBBbCBEZWViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6IkltYW5lIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMToiSWhhYiBUaW1hbmkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNDoiSWJyYWhpbSBBa2thcmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE1OiJNb2hhbWFkIEFsIEhvdXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJTaXJhaiBBcmlkYSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEzOiJMZXdhYSBHaHJhaXp5IjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6ODoiQXlhIFR1cmsiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMToiSGFkaSBTaGVoYWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IlJvbnkgTmFzciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6Ik1vaGFtYWQgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE2OiJHYXJpbmUgRG91cm5heWFuIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTI6IlJheWFuIEVkZWxiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEzOiJBc2xhbiBLaGFkZGFqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxNDoiUmltYSBHaGFuZG91cmEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMzoiRmF0ZW4gQWJvem91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6IkFudGhvbnkgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiTm91ciBGYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjk6IkVsaWUgQXp6aSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJBaG1hZCBIYW1kYXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNToiU2FhZGRpbmUgSGFjaGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTU6Ik1vaGFtbWFkIEdoc2VpbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTQ6IlNhbWkgS2Fzc2FiaWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToyO31zOjEzOiJBaG1hZCBLaGFyb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IlNvcGhpZSBNaWxhbmUiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiUm9iZXJ0byBTbGltIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6Ikthc3NlbSBBa2lsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiR2lvcmdpbyBTYWxpYmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJDZWFzYXIgQWwgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJTYXJhIEp1cmRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiSmluYW5lIFdlaGJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkZhZGkgS2hvZGFyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTt9czoxODoiV2lzc2FtIEZha2hyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiR2FyaW5lIFRvcGV5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMDoiT21hciBBc2xhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE4OiJIYXlkYXIgRmFraHJlZGRpbmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJNYXlzc2EgTmFkZXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJFbGllIEdoYW50b3VzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTE6IlNhYWRlaCBBd2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiSmFuYSBZYWFjb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTM6IkFtaXIgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJBaG1hZCBNb3JkYWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJSYW1pIEVsIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6Ik9tYXIgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE1OiJIdXNzZWluIFplaXRvdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxODoiU3RlcGhhbmllIERhY2NhY2hlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTc6IkFsaW5lIEFsIERhc3NvdWtpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ikx1bHdhIEtyb25mb2wiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJKYW5hIEthaHdhamkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMjoiQWhtYWQgSGFiaGFiIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czo5OiJDaGFkeSBFaWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJDaGlyaW5lIEFtbWFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiU2FyYSBBbCBNb3VyYXdlZCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE3OiJBYmRlbCBrYXJpbSBNYXNyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6Ik5hemlrIEtoYWxpZmVoIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6Ikh1c3NlaW4gRGFpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE4OiJNYXJpZSBBbmdlIE1hYWxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJBbGFhIEtoYWxpbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE0OiJXYWVsIE5hc2VyZGluZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IkxpZGlhIEhhbWRhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJKb2UgWmdoZWliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiQWhtYWQgRHdheXJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ik5hZGluZSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJNeXJpYW0gU2FsYW1lIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6IkRhbmEgSXRhbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJIYWR5IEphbWlsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6Iklzc2EgRmFvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJGb3VhZCBCb3UgS2Fzc2VtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiVGFuaWEgQmFsbG91dCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJIYW5hYSBCcmVpc2giO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE4OiJKZWFuIC1waWVycmUgSGFraW0iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiTmFkaW5lIEJhYWtsaW5pIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRWxzeSBGYXJoYXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJBaG1hZCBEb3VnaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNToiRmF0aW1hIEFsIEthYWtpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMToiTWF5YSBLaG9kb3IiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMzoiQmFzc2VsIFlvdW5pcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTA6IkFtYW5pIE1hZGkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE0OiJNYXJ3YW4gQmFyYWthdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE2OiJOYXppayBCYWRyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO31zOjExOiJNYXJpYSBXYWtlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IlNhcmpvdW4gUmFmZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNjoiV2lzc2FtIEFsIEhhbGFiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJUb255IEtoYWNoYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJCaWxhbCBIb21zaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE4OiJLYXJlZW0gQWwgQnRhZGRpbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJDbGF1ZGUgSGFkZGFkIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTY6Ik1vaGFtbWFkIElicmFoaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7fXM6MTA6IkFsaSBJc21haWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEwOiJSYXVsIE5hZGVyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiQW5kcmV3IEF5b3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkhhZGkgQ2hlYWl0byI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJBZGFtIEtod2Fpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJIYXNzYW4gQXdhZGEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJNb2hhbWFkIFNhbGVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBbGkgQXlvdWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJKYXdhZCBBaG1hZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6Ik5pemFyIEhhemltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQWRuYW4gWWFremFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiQXN5YSBHaG9uYXNoIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6IkZheXNhbCBKYXJvdWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiTWVsaXNzYSBCZWNoYXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxMjoiSGFzc2FuIFNhYmVhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxOToiQmFzc2ltIEhhamogU2xlaW1hbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEzOiJBeWEgQWwgS2Fpc3NpIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkxlYWggU2hhbWkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNzoiUmFuaWEgQWJpIEdoYW5uYW0iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNDoiTW9oYW1hZCBLaGF5d2UiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJSYWdoaWQgTW9rYmVsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNToiTGVlbiBBYm91IEFzc2FmIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkFobWFkIENoYXJhZmRpbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJNYWhhIFNpYmxpbmkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiQWJlZCBNYWplZCI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJNdXN0YWZhIEFsIEFzc2lyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTM6Ik1hcmlhIEFsIEFib3UiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJQYW1lbGEgQ2hhbW91biI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJQZXJsYSBFbCBLaG91cnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEzOiJSaGVhIEF0dGFsbGFoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxODoiSmVhbiBDbGF1ZGUgTWF0dGFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxNDoiR2VyYWxkbyBCYWRhd2kiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE2OiJBYmRhbGxhaCBNYXNzb3VkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTW9oYW1hZCBSZXNsYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJNYXJpYW0gVG9obWUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJSZWluZSBDaGVycnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czo5OiJFZGR5IFNhYWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjExOiJTZXJlbmEgUmFoaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IkhhZGkgWmF5YXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiQ2hhemEgU2FsZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJJc21haWwgS2FkaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkNoYXJiZWwgQm93YWlyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTk6IkFiZHVsIFJhaG1hbiBab2doYmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJNaWNoZWwgRGFvdSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJBbWlyIEthZWRiZXkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiT3Vzc2FtYSBFbCBNYXNyaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEwOiJPbGEgRmFraGVyIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IkV1Z2VuaWUgSGFraW0iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMToiSW1hZCBZb3VzdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJBbGFhIEZheXNhbCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IktoYWxpbCBNYWhhc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjExOiJMYXJhIEhkYXlmaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE0OiJNYXJ5bHlubmUgTXJhZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTY6Ikh1c3NlaW4gQWJkYWxsYWgiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IkRpYWxhIEJhcmFrYXQiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IkFobWFkIFJhbWFkYW4iO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6OToiWmlhZCBTYWtyIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJCYWhhYSBUaW1hbnkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6OToiUmFtaSBSZWRhIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJXYWVsIEFobWFkaWVoIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJIYXNzYW4gU2xlaW1hbiI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNToiU3V6YW5uZSBLYWVkQmF5IjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJGaXJhcyBTaGFtYXMiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTY6Ik1vaGFtYWQgU2hlcmthd2kiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IldhbGFhIElicmFoaW0iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNDoiTml6YXIgQWwgU291cmkiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiQW5naWUgQm91IFRyYWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiWmVpbmFiIE16YW5hciI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJSb290IEhhbGxhayI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJaaWFkIEthbGFqaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJQcmVzc2ljYSBKb3VkaWVoIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IkhhbmluIElzbWFpbCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJGaXJhcyBLaGFpciBFbGRlZW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiRXN0aGVyIEhvYmVpa2EiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiSmFkIFNhZnNvdWYiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiS2hhbGVkIEFsIEhhZmkiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBbGkgQXd3YWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiRWxpbyBSYWpoYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJOb3VybWEgU2FpaWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiTm9oYWQgVGFiYmFyYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJNb3N0YWZhIFJpaGFuIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6IlJhemFuIEhhaWRhciI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJIdXNzZWluIFdlaGJlIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6Ikhhc3NhbiBBbm5hbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJTYWJhaCBNYWxhZWIiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBZmlmIFJhYWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiWmFraGlhIEthbWVsIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6IlNpbHZhIFRyYXlqaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJMYXJhIE1hbGFlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjg6IkFsaSBFaWRvIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTA6IkFobWFkIFplaW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMToiUmF3YW5hIERlZWIiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNjoiSWJyYWhpbSBLb3Jrb21heiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO319czoxMDoic2hlZXROYW1lcyI7YTozOntpOjA7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjI7czo5OiJTYXR1cmRheXMiO31zOjE4OiJwcm9jZXNzZWRFbXBsb3llZXMiO2E6MjcyOntzOjEzOiJIdXNzZWluIEFiYmFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiTGlsaWFuIEhhYmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IlplaW5hIEJhbGxvdXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxODoiU2hhZGkgQWJvdSBEYXJnaGFtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTWF5c2FhIE1haG1vdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJJc3NhIFJ1c3RvbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJBbGkgTWVjaHJlZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6Ik1hemVuIEhhbGFiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6Ik1vaGFtYWQgQUwgRXRlciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTg6IkplYW4gUGllcnJlIEtob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IlJpY2hhcmQgUml6ayI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IkhhZHkgTGFraXNzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiTW9oYW1hZCBBbCBFc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJQZXRlciBGYXJhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6Ik1hcm91biBIYWJjaHkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJSYXNoYSBIbWFkZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMzoiSGFzc2FuIFNhZmF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTQ6Ikhhc3NhbiBBbGF3aWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiUmVlbSBOb3VlaWhlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IkNlbGluZSBJc21haWwiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNjoiTW9oYW1hZCBBbCBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IkpvaG4gVGFubm91cnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMzoiV2FmaWMgRG91Z2hhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6OToiQWxpIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiUmFzaGFkIEFsIE1vaHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6ODoiMiBTaGlmdHMiO2k6NDt9czoxNjoiSnVsaWVuIEVsIEtob3VyeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEyOiJBaG1hZCBEZ2hlaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJBbnRob255IE1vdWFubmVzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiRWxpZSBOYWNjb3V6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ikx5bm4gQmFyYWthdCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkxpbGkgR2hvc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo4O31zOjEwOiJSb3kgTWVyaGVqIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiTWFqZCBOb3VuIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IkthcmltIEhha2ltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6MTA7fXM6MTM6IkFtaW5hIEFsIEFzaHkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNjoiTW9oYW1hZCBLaXRtaXR0byI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTg6Ik5hbmN5IEFib3UgSWJyYWhpbSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IlJpbSBNb3VubGEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNDoiTWFobW91ZCBIYXNzYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJCZXJuYXJkIEthYmJvdWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjExOiJPbWFyIEthc3NhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkNlbGluZSBTYWxlbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEzOiJNb2hhbWFkIEJhbm5hIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMDoiQWJpciBIYXJlYiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJNYWpkIFNoYmF0dCI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJKb2UgQ2hhYXlhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTU6IkFkYW0gRWwgS2Nob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTU6IlJpY2hhcmQgSmFiYm91ciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEwOiJKYWQgQWJib3VkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czo5OiJKb2UgQ2hhbWkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE3OiJMaWxhcyBGYWtocmVkZGluZSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJIYWR5IEthZGRvdXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjg7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMzoiU2hhZGkgR2hyYWl6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IkZvdWFkIEFzc2FmIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MjE6Ik1vaGFtYWQgSmFsYWwgQWwgSGFqaiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6Ik1pY2thZWwgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiU2FtaXIgRmF5ZWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJOb2FtYW4gRGFiYm91cyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTU6IkFudGhvbnkgSWJyYWhpbSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkdpbyBFc3RlcGhhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IlJvbGFuZCBLaGF0ZXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMToiTWFyayBTYWFkZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJTYW1pIFNpbm5vIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNToiUml0YSBNYXJpYSBBZGFzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTM6IlNhaWQgQmFhc3NpcmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjE1OiJLYXNzZW0gR2hhbmRvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJLZXZpbiBNZW5hc3NhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTU6IkFkZWViIEFsIEdoYXJpYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTE6IkRhbmllbCBBa2F6IjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IlJpZGEgQWwgR2hhcmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ik9tYXIgSGFkZGFyYWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMjoiVmFuZXNzYSBOb3VuIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTE6IkhvZGEgQm91bG9zIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6IlllaHlhIE1hc2hha2FoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjEwO3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTI6IkFobWFkIEF0dGllaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJNb2hhbWFkIEVpZG8iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJIYW5pbiBNZWtrYXdpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IkhhZGkgRWwgSGFzc2FuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiQW1hbmkgWWVoaWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJSaXRhIE5hZGVyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTI6Ik5vdXIgWWFtbWluZSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo4O31zOjEyOiJTYXllZCBBYmJvdWQiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiU2FoZXIgU2hhbWFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjg7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRWxpZSBCZWFpbm8iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMzoiQWRoYW0gSmF3aGFyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTA6IldhZWwgWmFoZWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJHaWEgTWthaGFsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTU6IkVsaXNzYSBNYWtobG91ZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkVsaWUgU2FsaWJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiU2FyYWggQXd3YWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjE1OiJEam9zZXBoIEVsIEhhamoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJOb3VyIEFsIERlZWIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMToiSW1hbmUgV2VoYmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjExOiJJaGFiIFRpbWFuaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjE0OiJJYnJhaGltIEFra2FyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6Ik1vaGFtYWQgQWwgSG91dCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlNpcmFqIEFyaWRhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTM6Ikxld2FhIEdocmFpenkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6ODt9czo4OiJBeWEgVHVyayI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjExOiJIYWRpIFNoZWhhYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6OToiUm9ueSBOYXNyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiTW9oYW1hZCBGYXJhaiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTY6IkdhcmluZSBEb3VybmF5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxMjoiUmF5YW4gRWRlbGJpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IkFzbGFuIEtoYWRkYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aToxMDt9czoxNDoiUmltYSBHaGFuZG91cmEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxMzoiRmF0ZW4gQWJvem91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6IkFudGhvbnkgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMDoiTm91ciBGYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjk6IkVsaWUgQXp6aSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJBaG1hZCBIYW1kYXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxNToiU2FhZGRpbmUgSGFjaGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTU6Ik1vaGFtbWFkIEdoc2VpbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6IlNhbWkgS2Fzc2FiaWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo4OiIyIFNoaWZ0cyI7aTo4O31zOjEzOiJBaG1hZCBLaGFyb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTM6IlNvcGhpZSBNaWxhbmUiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMjoiUm9iZXJ0byBTbGltIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6Ikthc3NlbSBBa2lsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNDoiR2lvcmdpbyBTYWxpYmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE4OiJDZWFzYXIgQWwgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEwOiJTYXJhIEp1cmRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiSmluYW5lIFdlaGJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTI6IkZhZGkgS2hvZGFyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDt9czoxODoiV2lzc2FtIEZha2hyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiR2FyaW5lIFRvcGV5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMDoiT21hciBBc2xhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE4OiJIYXlkYXIgRmFraHJlZGRpbmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJNYXlzc2EgTmFkZXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJFbGllIEdoYW50b3VzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTE6IlNhYWRlaCBBd2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiSmFuYSBZYWFjb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTM6IkFtaXIgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEyOiJBaG1hZCBNb3JkYWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJSYW1pIEVsIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6Ik9tYXIgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJIdXNzZWluIFplaXRvdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxODoiU3RlcGhhbmllIERhY2NhY2hlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTc6IkFsaW5lIEFsIERhc3NvdWtpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6Ikx1bHdhIEtyb25mb2wiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJKYW5hIEthaHdhamkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMjoiQWhtYWQgSGFiaGFiIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJDaGFkeSBFaWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJDaGlyaW5lIEFtbWFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiU2FyYSBBbCBNb3VyYXdlZCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjE3OiJBYmRlbCBrYXJpbSBNYXNyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6Ik5hemlrIEtoYWxpZmVoIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ikh1c3NlaW4gRGFpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJNYXJpZSBBbmdlIE1hYWxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJBbGFhIEtoYWxpbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJXYWVsIE5hc2VyZGluZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6IkxpZGlhIEhhbWRhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEwOiJKb2UgWmdoZWliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQWhtYWQgRHdheXJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6Ik5hZGluZSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJNeXJpYW0gU2FsYW1lIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6IkRhbmEgSXRhbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEwOiJIYWR5IEphbWlsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6Iklzc2EgRmFvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJGb3VhZCBCb3UgS2Fzc2VtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiVGFuaWEgQmFsbG91dCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJIYW5hYSBCcmVpc2giO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE4OiJKZWFuIC1waWVycmUgSGFraW0iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNToiTmFkaW5lIEJhYWtsaW5pIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiRWxzeSBGYXJoYXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJBaG1hZCBEb3VnaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxNToiRmF0aW1hIEFsIEthYWtpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiTWF5YSBLaG9kb3IiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMzoiQmFzc2VsIFlvdW5pcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkFtYW5pIE1hZGkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJNYXJ3YW4gQmFyYWthdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE2OiJOYXppayBCYWRyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo4O31zOjExOiJNYXJpYSBXYWtlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IlNhcmpvdW4gUmFmZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNjoiV2lzc2FtIEFsIEhhbGFiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJUb255IEtoYWNoYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJCaWxhbCBIb21zaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE4OiJLYXJlZW0gQWwgQnRhZGRpbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJDbGF1ZGUgSGFkZGFkIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTY6Ik1vaGFtbWFkIElicmFoaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7fXM6MTA6IkFsaSBJc21haWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJSYXVsIE5hZGVyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMjoiQW5kcmV3IEF5b3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTI6IkhhZGkgQ2hlYWl0byI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJBZGFtIEtod2Fpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJIYXNzYW4gQXdhZGEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJNb2hhbWFkIFNhbGVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czo5OiJBbGkgQXlvdWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJKYXdhZCBBaG1hZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6Ik5pemFyIEhhemltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiQWRuYW4gWWFremFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQXN5YSBHaG9uYXNoIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IkZheXNhbCBKYXJvdWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiTWVsaXNzYSBCZWNoYXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6MTA7fXM6MTI6Ikhhc3NhbiBTYWJlYSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTk6IkJhc3NpbSBIYWpqIFNsZWltYW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiQXlhIEFsIEthaXNzaSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJMZWFoIFNoYW1pIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTc6IlJhbmlhIEFiaSBHaGFubmFtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6Ik1vaGFtYWQgS2hheXdlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiUmFnaGlkIE1va2JlbCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6IkxlZW4gQWJvdSBBc3NhZiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJBaG1hZCBDaGFyYWZkaW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMjoiTWFoYSBTaWJsaW5pIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IkFiZWQgTWFqZWQiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiTXVzdGFmYSBBbCBBc3NpciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEzOiJNYXJpYSBBbCBBYm91IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiUGFtZWxhIENoYW1vdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiUGVybGEgRWwgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiUmhlYSBBdHRhbGxhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTg6IkplYW4gQ2xhdWRlIE1hdHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjEwO31zOjE0OiJHZXJhbGRvIEJhZGF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTY6IkFiZGFsbGFoIE1hc3NvdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE0OiJNb2hhbWFkIFJlc2xhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6Ik1hcmlhbSBUb2htZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlJlaW5lIENoZXJyeSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjk6IkVkZHkgU2FhYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IlNlcmVuYSBSYWhpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMDoiSGFkaSBaYXlhdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJDaGF6YSBTYWxlaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IklzbWFpbCBLYWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiQ2hhcmJlbCBCb3dhaXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxOToiQWJkdWwgUmFobWFuIFpvZ2hiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6Ik1pY2hlbCBEYW91IjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkFtaXIgS2FlZGJleSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6MTI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiT3Vzc2FtYSBFbCBNYXNyaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEwOiJPbGEgRmFraGVyIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxMjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJFdWdlbmllIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6IkltYWQgWW91c3VmIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiQWxhYSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJLaGFsaWwgTWFoYXNzZW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiTGFyYSBIZGF5ZmkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNDoiTWFyeWx5bm5lIE1yYWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJIdXNzZWluIEFiZGFsbGFoIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MTI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiRGlhbGEgQmFyYWthdCI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiQWhtYWQgUmFtYWRhbiI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjEyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiWmlhZCBTYWtyIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJCYWhhYSBUaW1hbnkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxNjtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjk6IlJhbWkgUmVkYSI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjEyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IldhZWwgQWhtYWRpZWgiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6Ikhhc3NhbiBTbGVpbWFuIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE1OiJTdXphbm5lIEthZWRCYXkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkZpcmFzIFNoYW1hcyI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiTW9oYW1hZCBTaGVya2F3aSI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiV2FsYWEgSWJyYWhpbSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE0OiJOaXphciBBbCBTb3VyaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJBbmdpZSBCb3UgVHJhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEzOiJaZWluYWIgTXphbmFyIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlJvb3QgSGFsbGFrIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlppYWQgS2FsYWppIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTY6IlByZXNzaWNhIEpvdWRpZWgiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiSGFuaW4gSXNtYWlsIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTg6IkZpcmFzIEtoYWlyIEVsZGVlbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJFc3RoZXIgSG9iZWlrYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjExOiJKYWQgU2Fmc291ZiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJLaGFsZWQgQWwgSGFmaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IkFsaSBBd3dhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJFbGlvIFJhamhhIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ik5vdXJtYSBTYWlpZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJOb2hhZCBUYWJiYXJhIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ik1vc3RhZmEgUmloYW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiUmF6YW4gSGFpZGFyIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ikh1c3NlaW4gV2VoYmUiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiSGFzc2FuIEFubmFuIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlNhYmFoIE1hbGFlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IkFmaWYgUmFhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJaYWtoaWEgS2FtZWwiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiU2lsdmEgVHJheWppIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkxhcmEgTWFsYWViIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6ODoiQWxpIEVpZG8iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiQWhtYWQgWmVpbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJSYXdhbmEgRGVlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJJYnJhaGltIEtvcmtvbWF6IjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fX19', 1740753131);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('idpTg80UcK5bYbsx3Owkzp08xzpV57W7aU6bEioJ', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoibkpXSEZTYWZQRHJMZUdiMVRKRHR2bmFoaUtMaGpaS1NRZmhMTWhUeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbm90aWZpY2F0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo5OiJlbXBsb3llZXMiO2E6MjcyOntzOjEzOiJIdXNzZWluIEFiYmFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiTGlsaWFuIEhhYmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6IlplaW5hIEJhbGxvdXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxODoiU2hhZGkgQWJvdSBEYXJnaGFtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiTWF5c2FhIE1haG1vdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJJc3NhIFJ1c3RvbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjExOiJBbGkgTWVjaHJlZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ik1hemVuIEhhbGFiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6Ik1vaGFtYWQgQUwgRXRlciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTg6IkplYW4gUGllcnJlIEtob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTI6IlJpY2hhcmQgUml6ayI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6IkhhZHkgTGFraXNzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTW9oYW1hZCBBbCBFc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJQZXRlciBGYXJhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6Ik1hcm91biBIYWJjaHkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJSYXNoYSBIbWFkZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMzoiSGFzc2FuIFNhZmF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTQ6Ikhhc3NhbiBBbGF3aWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiUmVlbSBOb3VlaWhlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IkNlbGluZSBJc21haWwiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNjoiTW9oYW1hZCBBbCBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IkpvaG4gVGFubm91cnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiV2FmaWMgRG91Z2hhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiQWxpIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNjoiUmFzaGFkIEFsIE1vaHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6ODoiMiBTaGlmdHMiO2k6MTt9czoxNjoiSnVsaWVuIEVsIEtob3VyeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTozO31zOjEyOiJBaG1hZCBEZ2hlaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJBbnRob255IE1vdWFubmVzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiRWxpZSBOYWNjb3V6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6Ikx5bm4gQmFyYWthdCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTI6IkxpbGkgR2hvc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEwOiJSb3kgTWVyaGVqIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6OToiTWFqZCBOb3VuIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6IkthcmltIEhha2ltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxMzoiQW1pbmEgQWwgQXNoeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE2OiJNb2hhbWFkIEtpdG1pdHRvIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxODoiTmFuY3kgQWJvdSBJYnJhaGltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiUmltIE1vdW5sYSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJNYWhtb3VkIEhhc3NhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkJlcm5hcmQgS2FiYm91bCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6Ik9tYXIgS2Fzc2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiQ2VsaW5lIFNhbGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTM6Ik1vaGFtYWQgQmFubmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJBYmlyIEhhcmViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6Ik1hamQgU2hiYXR0IjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkpvZSBDaGFheWEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNToiQWRhbSBFbCBLY2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiUmljaGFyZCBKYWJib3VyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTA6IkphZCBBYmJvdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTozO31zOjk6IkpvZSBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTc6IkxpbGFzIEZha2hyZWRkaW5lIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTM6IkhhZHkgS2FkZG91cmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJTaGFkaSBHaHJhaXppIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRm91YWQgQXNzYWYiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoyMToiTW9oYW1hZCBKYWxhbCBBbCBIYWpqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiTWlja2FlbCBLaG91cnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJTYW1pciBGYXllZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTQ6Ik5vYW1hbiBEYWJib3VzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiQW50aG9ueSBJYnJhaGltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiR2lvIEVzdGVwaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiUm9sYW5kIEtoYXRlciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJNYXJrIFNhYWRlaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IlNhbWkgU2lubm8iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE1OiJSaXRhIE1hcmlhIEFkYXMiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMzoiU2FpZCBCYWFzc2lyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTU6Ikthc3NlbSBHaGFuZG91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IktldmluIE1lbmFzc2EiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNToiQWRlZWIgQWwgR2hhcmliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiRGFuaWVsIEFrYXoiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNDoiUmlkYSBBbCBHaGFyaWIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMzoiT21hciBIYWRkYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJWYW5lc3NhIE5vdW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiSG9kYSBCb3Vsb3MiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNDoiWWVoeWEgTWFzaGFrYWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NTtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJBaG1hZCBBdHRpZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMjoiTW9oYW1hZCBFaWRvIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiSGFuaW4gTWVra2F3aSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJIYWRpIEVsIEhhc3NhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkFtYW5pIFllaGlhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMDoiUml0YSBOYWRlciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJOb3VyIFlhbW1pbmUiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMjoiU2F5ZWQgQWJib3VkIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlNhaGVyIFNoYW1hcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTE6IkVsaWUgQmVhaW5vIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IkFkaGFtIEphd2hhcnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJXYWVsIFphaGVkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMDoiR2lhIE1rYWhhbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE1OiJFbGlzc2EgTWFraGxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJFbGllIFNhbGliYSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IlNhcmFoIEF3d2FkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiRGpvc2VwaCBFbCBIYWpqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiTm91ciBBbCBEZWViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6IkltYW5lIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMToiSWhhYiBUaW1hbmkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNDoiSWJyYWhpbSBBa2thcmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE1OiJNb2hhbWFkIEFsIEhvdXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJTaXJhaiBBcmlkYSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEzOiJMZXdhYSBHaHJhaXp5IjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6ODoiQXlhIFR1cmsiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMToiSGFkaSBTaGVoYWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IlJvbnkgTmFzciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6Ik1vaGFtYWQgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE2OiJHYXJpbmUgRG91cm5heWFuIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTI6IlJheWFuIEVkZWxiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEzOiJBc2xhbiBLaGFkZGFqIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxNDoiUmltYSBHaGFuZG91cmEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxMzoiRmF0ZW4gQWJvem91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6IkFudGhvbnkgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiTm91ciBGYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjk6IkVsaWUgQXp6aSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJBaG1hZCBIYW1kYXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mzt9czoxNToiU2FhZGRpbmUgSGFjaGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTU6Ik1vaGFtbWFkIEdoc2VpbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTQ6IlNhbWkgS2Fzc2FiaWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToyO31zOjEzOiJBaG1hZCBLaGFyb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IlNvcGhpZSBNaWxhbmUiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MztzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiUm9iZXJ0byBTbGltIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6Ikthc3NlbSBBa2lsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiR2lvcmdpbyBTYWxpYmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJDZWFzYXIgQWwgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJTYXJhIEp1cmRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiSmluYW5lIFdlaGJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkZhZGkgS2hvZGFyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTt9czoxODoiV2lzc2FtIEZha2hyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiR2FyaW5lIFRvcGV5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMDoiT21hciBBc2xhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE4OiJIYXlkYXIgRmFraHJlZGRpbmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJNYXlzc2EgTmFkZXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJFbGllIEdoYW50b3VzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTE6IlNhYWRlaCBBd2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMjoiSmFuYSBZYWFjb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTM6IkFtaXIgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJBaG1hZCBNb3JkYWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJSYW1pIEVsIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6Ik9tYXIgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE1OiJIdXNzZWluIFplaXRvdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxODoiU3RlcGhhbmllIERhY2NhY2hlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjM7fXM6MTc6IkFsaW5lIEFsIERhc3NvdWtpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ikx1bHdhIEtyb25mb2wiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJKYW5hIEthaHdhamkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMjoiQWhtYWQgSGFiaGFiIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czo5OiJDaGFkeSBFaWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJDaGlyaW5lIEFtbWFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiU2FyYSBBbCBNb3VyYXdlZCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE3OiJBYmRlbCBrYXJpbSBNYXNyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6Ik5hemlrIEtoYWxpZmVoIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6Ikh1c3NlaW4gRGFpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE4OiJNYXJpZSBBbmdlIE1hYWxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJBbGFhIEtoYWxpbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE0OiJXYWVsIE5hc2VyZGluZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IkxpZGlhIEhhbWRhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJKb2UgWmdoZWliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiQWhtYWQgRHdheXJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ik5hZGluZSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJNeXJpYW0gU2FsYW1lIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6IkRhbmEgSXRhbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEwOiJIYWR5IEphbWlsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTA6Iklzc2EgRmFvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJGb3VhZCBCb3UgS2Fzc2VtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiVGFuaWEgQmFsbG91dCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJIYW5hYSBCcmVpc2giO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE4OiJKZWFuIC1waWVycmUgSGFraW0iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiTmFkaW5lIEJhYWtsaW5pIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRWxzeSBGYXJoYXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJBaG1hZCBEb3VnaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNToiRmF0aW1hIEFsIEthYWtpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMToiTWF5YSBLaG9kb3IiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMzoiQmFzc2VsIFlvdW5pcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTA6IkFtYW5pIE1hZGkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE0OiJNYXJ3YW4gQmFyYWthdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE2OiJOYXppayBCYWRyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO31zOjExOiJNYXJpYSBXYWtlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IlNhcmpvdW4gUmFmZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNjoiV2lzc2FtIEFsIEhhbGFiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJUb255IEtoYWNoYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJCaWxhbCBIb21zaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE4OiJLYXJlZW0gQWwgQnRhZGRpbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJDbGF1ZGUgSGFkZGFkIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTY6Ik1vaGFtbWFkIElicmFoaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjE7fXM6MTA6IkFsaSBJc21haWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEwOiJSYXVsIE5hZGVyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiQW5kcmV3IEF5b3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkhhZGkgQ2hlYWl0byI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJBZGFtIEtod2Fpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJIYXNzYW4gQXdhZGEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJNb2hhbWFkIFNhbGVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBbGkgQXlvdWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJKYXdhZCBBaG1hZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTE6Ik5pemFyIEhhemltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQWRuYW4gWWFremFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiQXN5YSBHaG9uYXNoIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6IkZheXNhbCBKYXJvdWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiTWVsaXNzYSBCZWNoYXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxMjoiSGFzc2FuIFNhYmVhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxOToiQmFzc2ltIEhhamogU2xlaW1hbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEzOiJBeWEgQWwgS2Fpc3NpIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkxlYWggU2hhbWkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNzoiUmFuaWEgQWJpIEdoYW5uYW0iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxNDoiTW9oYW1hZCBLaGF5d2UiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJSYWdoaWQgTW9rYmVsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNToiTGVlbiBBYm91IEFzc2FmIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkFobWFkIENoYXJhZmRpbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJNYWhhIFNpYmxpbmkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiQWJlZCBNYWplZCI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJNdXN0YWZhIEFsIEFzc2lyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjE7fXM6MTM6Ik1hcmlhIEFsIEFib3UiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJQYW1lbGEgQ2hhbW91biI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJQZXJsYSBFbCBLaG91cnkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEzOiJSaGVhIEF0dGFsbGFoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxODoiSmVhbiBDbGF1ZGUgTWF0dGFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NTt9czoxNDoiR2VyYWxkbyBCYWRhd2kiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjE2OiJBYmRhbGxhaCBNYXNzb3VkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTW9oYW1hZCBSZXNsYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJNYXJpYW0gVG9obWUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJSZWluZSBDaGVycnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjE7czo5OiJTYXR1cmRheXMiO2k6NDt9czo5OiJFZGR5IFNhYWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjExOiJTZXJlbmEgUmFoaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IkhhZGkgWmF5YXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiQ2hhemEgU2FsZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJJc21haWwgS2FkaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IkNoYXJiZWwgQm93YWlyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTk6IkFiZHVsIFJhaG1hbiBab2doYmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJNaWNoZWwgRGFvdSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEyOiJBbWlyIEthZWRiZXkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjM7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiT3Vzc2FtYSBFbCBNYXNyaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjEwOiJPbGEgRmFraGVyIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjE7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IkV1Z2VuaWUgSGFraW0iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6MTt9czoxMToiSW1hZCBZb3VzdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJBbGFhIEZheXNhbCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTU6IktoYWxpbCBNYWhhc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjExOiJMYXJhIEhkYXlmaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToxO31zOjE0OiJNYXJ5bHlubmUgTXJhZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTY6Ikh1c3NlaW4gQWJkYWxsYWgiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IkRpYWxhIEJhcmFrYXQiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTM6IkFobWFkIFJhbWFkYW4iO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTozO3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6OToiWmlhZCBTYWtyIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJCYWhhYSBUaW1hbnkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6OToiUmFtaSBSZWRhIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MztzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJXYWVsIEFobWFkaWVoIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MTtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJIYXNzYW4gU2xlaW1hbiI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNToiU3V6YW5uZSBLYWVkQmF5IjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTozO31zOjEyOiJGaXJhcyBTaGFtYXMiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTY6Ik1vaGFtYWQgU2hlcmthd2kiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxO3M6OToiU2F0dXJkYXlzIjtpOjM7fXM6MTM6IldhbGFhIElicmFoaW0iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxNDoiTml6YXIgQWwgU291cmkiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiQW5naWUgQm91IFRyYWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mzt9czoxMzoiWmVpbmFiIE16YW5hciI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJSb290IEhhbGxhayI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJaaWFkIEthbGFqaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjE2OiJQcmVzc2ljYSBKb3VkaWVoIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IkhhbmluIElzbWFpbCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJGaXJhcyBLaGFpciBFbGRlZW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiRXN0aGVyIEhvYmVpa2EiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiSmFkIFNhZnNvdWYiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNDoiS2hhbGVkIEFsIEhhZmkiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBbGkgQXd3YWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiRWxpbyBSYWpoYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJOb3VybWEgU2FpaWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMzoiTm9oYWQgVGFiYmFyYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJNb3N0YWZhIFJpaGFuIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6IlJhemFuIEhhaWRhciI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEzOiJIdXNzZWluIFdlaGJlIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6Ikhhc3NhbiBBbm5hbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjEyOiJTYWJhaCBNYWxhZWIiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJBZmlmIFJhYWQiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMjoiWmFraGlhIEthbWVsIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTI6IlNpbHZhIFRyYXlqaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjExOiJMYXJhIE1hbGFlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToxO31zOjg6IkFsaSBFaWRvIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjE7fXM6MTA6IkFobWFkIFplaW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxMToiUmF3YW5hIERlZWIiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6MTt9czoxNjoiSWJyYWhpbSBLb3Jrb21heiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO319czoxMDoic2hlZXROYW1lcyI7YTozOntpOjA7czo5OiJPbmUgU2hpZnQiO2k6MTtzOjg6IjIgU2hpZnRzIjtpOjI7czo5OiJTYXR1cmRheXMiO31zOjE4OiJwcm9jZXNzZWRFbXBsb3llZXMiO2E6MjcyOntzOjEzOiJIdXNzZWluIEFiYmFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiTGlsaWFuIEhhYmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IlplaW5hIEJhbGxvdXQiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxODoiU2hhZGkgQWJvdSBEYXJnaGFtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNDoiTWF5c2FhIE1haG1vdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJJc3NhIFJ1c3RvbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJBbGkgTWVjaHJlZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6Ik1hemVuIEhhbGFiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6Ik1vaGFtYWQgQUwgRXRlciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTg6IkplYW4gUGllcnJlIEtob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IlJpY2hhcmQgUml6ayI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IkhhZHkgTGFraXNzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiTW9oYW1hZCBBbCBFc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJQZXRlciBGYXJhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6Ik1hcm91biBIYWJjaHkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJSYXNoYSBIbWFkZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMzoiSGFzc2FuIFNhZmF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTQ6Ikhhc3NhbiBBbGF3aWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiUmVlbSBOb3VlaWhlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IkNlbGluZSBJc21haWwiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNjoiTW9oYW1hZCBBbCBDaGFtaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IkpvaG4gVGFubm91cnkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMzoiV2FmaWMgRG91Z2hhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6OToiQWxpIFdlaGJlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNjoiUmFzaGFkIEFsIE1vaHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6ODoiMiBTaGlmdHMiO2k6NDt9czoxNjoiSnVsaWVuIEVsIEtob3VyeSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEyOiJBaG1hZCBEZ2hlaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJBbnRob255IE1vdWFubmVzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiRWxpZSBOYWNjb3V6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ikx5bm4gQmFyYWthdCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkxpbGkgR2hvc3NlbiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo4O31zOjEwOiJSb3kgTWVyaGVqIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiTWFqZCBOb3VuIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IkthcmltIEhha2ltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6MTA7fXM6MTM6IkFtaW5hIEFsIEFzaHkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNjoiTW9oYW1hZCBLaXRtaXR0byI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTg6Ik5hbmN5IEFib3UgSWJyYWhpbSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IlJpbSBNb3VubGEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxNDoiTWFobW91ZCBIYXNzYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJCZXJuYXJkIEthYmJvdWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjExOiJPbWFyIEthc3NhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkNlbGluZSBTYWxlbSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEzOiJNb2hhbWFkIEJhbm5hIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMDoiQWJpciBIYXJlYiI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJNYWpkIFNoYmF0dCI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJKb2UgQ2hhYXlhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTU6IkFkYW0gRWwgS2Nob3VyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTU6IlJpY2hhcmQgSmFiYm91ciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjEwOiJKYWQgQWJib3VkIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czo5OiJKb2UgQ2hhbWkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE3OiJMaWxhcyBGYWtocmVkZGluZSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJIYWR5IEthZGRvdXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjg7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMzoiU2hhZGkgR2hyYWl6aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IkZvdWFkIEFzc2FmIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MjE6Ik1vaGFtYWQgSmFsYWwgQWwgSGFqaiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6Ik1pY2thZWwgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiU2FtaXIgRmF5ZWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJOb2FtYW4gRGFiYm91cyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTU6IkFudGhvbnkgSWJyYWhpbSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkdpbyBFc3RlcGhhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTM6IlJvbGFuZCBLaGF0ZXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMToiTWFyayBTYWFkZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJTYW1pIFNpbm5vIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNToiUml0YSBNYXJpYSBBZGFzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTM6IlNhaWQgQmFhc3NpcmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjE1OiJLYXNzZW0gR2hhbmRvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJLZXZpbiBNZW5hc3NhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTU6IkFkZWViIEFsIEdoYXJpYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTE6IkRhbmllbCBBa2F6IjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IlJpZGEgQWwgR2hhcmliIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTM6Ik9tYXIgSGFkZGFyYWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMjoiVmFuZXNzYSBOb3VuIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTE6IkhvZGEgQm91bG9zIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6IlllaHlhIE1hc2hha2FoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjEwO3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTI6IkFobWFkIEF0dGllaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJNb2hhbWFkIEVpZG8iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJIYW5pbiBNZWtrYXdpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IkhhZGkgRWwgSGFzc2FuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiQW1hbmkgWWVoaWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJSaXRhIE5hZGVyIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTI6Ik5vdXIgWWFtbWluZSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo4O31zOjEyOiJTYXllZCBBYmJvdWQiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiU2FoZXIgU2hhbWFzIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjg7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiRWxpZSBCZWFpbm8iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMzoiQWRoYW0gSmF3aGFyeSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTA6IldhZWwgWmFoZWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJHaWEgTWthaGFsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTU6IkVsaXNzYSBNYWtobG91ZiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkVsaWUgU2FsaWJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiU2FyYWggQXd3YWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjE1OiJEam9zZXBoIEVsIEhhamoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJOb3VyIEFsIERlZWIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMToiSW1hbmUgV2VoYmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjExOiJJaGFiIFRpbWFuaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjE0OiJJYnJhaGltIEFra2FyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6Ik1vaGFtYWQgQWwgSG91dCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlNpcmFqIEFyaWRhIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTM6Ikxld2FhIEdocmFpenkiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6ODt9czo4OiJBeWEgVHVyayI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo2O31zOjExOiJIYWRpIFNoZWhhYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6OToiUm9ueSBOYXNyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiTW9oYW1hZCBGYXJhaiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjg7fXM6MTY6IkdhcmluZSBEb3VybmF5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxMjoiUmF5YW4gRWRlbGJpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6IkFzbGFuIEtoYWRkYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aToxMDt9czoxNDoiUmltYSBHaGFuZG91cmEiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxMzoiRmF0ZW4gQWJvem91ciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6IkFudGhvbnkgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMDoiTm91ciBGYXJhaCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjk6IkVsaWUgQXp6aSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJBaG1hZCBIYW1kYXIiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Njt9czoxNToiU2FhZGRpbmUgSGFjaGVtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTU6Ik1vaGFtbWFkIEdoc2VpbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTQ6IlNhbWkgS2Fzc2FiaWVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo4OiIyIFNoaWZ0cyI7aTo4O31zOjEzOiJBaG1hZCBLaGFyb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjg7fXM6MTM6IlNvcGhpZSBNaWxhbmUiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMjoiUm9iZXJ0byBTbGltIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6Ikthc3NlbSBBa2lsIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNDoiR2lvcmdpbyBTYWxpYmEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE4OiJDZWFzYXIgQWwgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEwOiJTYXJhIEp1cmRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiSmluYW5lIFdlaGJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTI6IkZhZGkgS2hvZGFyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDt9czoxODoiV2lzc2FtIEZha2hyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiR2FyaW5lIFRvcGV5YW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6ODt9czoxMDoiT21hciBBc2xhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE4OiJIYXlkYXIgRmFraHJlZGRpbmUiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJNYXlzc2EgTmFkZXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJFbGllIEdoYW50b3VzIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTE6IlNhYWRlaCBBd2FyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMjoiSmFuYSBZYWFjb3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTM6IkFtaXIgQWhtYWRpZWgiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEyOiJBaG1hZCBNb3JkYWEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJSYW1pIEVsIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6Ik9tYXIgRmFyYWoiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJIdXNzZWluIFplaXRvdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxODoiU3RlcGhhbmllIERhY2NhY2hlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjY7fXM6MTc6IkFsaW5lIEFsIERhc3NvdWtpIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6Ikx1bHdhIEtyb25mb2wiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJKYW5hIEthaHdhamkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMjoiQWhtYWQgSGFiaGFiIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czo5OiJDaGFkeSBFaWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJDaGlyaW5lIEFtbWFyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjY7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiU2FyYSBBbCBNb3VyYXdlZCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjE3OiJBYmRlbCBrYXJpbSBNYXNyaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6Ik5hemlrIEtoYWxpZmVoIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ikh1c3NlaW4gRGFpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE4OiJNYXJpZSBBbmdlIE1hYWxvdWYiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjExOiJBbGFhIEtoYWxpbCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE0OiJXYWVsIE5hc2VyZGluZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6IkxpZGlhIEhhbWRhbiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEwOiJKb2UgWmdoZWliIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQWhtYWQgRHdheXJlIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTM6Ik5hZGluZSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJNeXJpYW0gU2FsYW1lIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6IkRhbmEgSXRhbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEwOiJIYWR5IEphbWlsIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTA6Iklzc2EgRmFvdXIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJGb3VhZCBCb3UgS2Fzc2VtIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiVGFuaWEgQmFsbG91dCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjEyOiJIYW5hYSBCcmVpc2giO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE4OiJKZWFuIC1waWVycmUgSGFraW0iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxNToiTmFkaW5lIEJhYWtsaW5pIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiRWxzeSBGYXJoYXQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJBaG1hZCBEb3VnaGFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxNToiRmF0aW1hIEFsIEthYWtpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMToiTWF5YSBLaG9kb3IiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6NDt9czoxMzoiQmFzc2VsIFlvdW5pcyI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTA6IkFtYW5pIE1hZGkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJNYXJ3YW4gQmFyYWthdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE2OiJOYXppayBCYWRyZWRkaW5lIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo4O31zOjExOiJNYXJpYSBXYWtlZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo2O3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IlNhcmpvdW4gUmFmZWgiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNjoiV2lzc2FtIEFsIEhhbGFiaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJUb255IEtoYWNoYW4iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJCaWxhbCBIb21zaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjE4OiJLYXJlZW0gQWwgQnRhZGRpbmkiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJDbGF1ZGUgSGFkZGFkIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTY6Ik1vaGFtbWFkIElicmFoaW0iO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjg6IjIgU2hpZnRzIjtpOjQ7fXM6MTA6IkFsaSBJc21haWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEwOiJSYXVsIE5hZGVyIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMjoiQW5kcmV3IEF5b3ViIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTI6IkhhZGkgQ2hlYWl0byI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEyOiJBZGFtIEtod2Fpc3MiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEyOiJIYXNzYW4gQXdhZGEiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjEzOiJNb2hhbWFkIFNhbGVoIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czo5OiJBbGkgQXlvdWIiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJKYXdhZCBBaG1hZCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6Ik5pemFyIEhhemltIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiQWRuYW4gWWFremFuIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiQXN5YSBHaG9uYXNoIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjQ7fXM6MTQ6IkZheXNhbCBKYXJvdWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiTWVsaXNzYSBCZWNoYXJhIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6MTA7fXM6MTI6Ikhhc3NhbiBTYWJlYSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTk6IkJhc3NpbSBIYWpqIFNsZWltYW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiQXlhIEFsIEthaXNzaSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJMZWFoIFNoYW1pIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTc6IlJhbmlhIEFiaSBHaGFubmFtIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTQ6Ik1vaGFtYWQgS2hheXdlIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMzoiUmFnaGlkIE1va2JlbCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTU6IkxlZW4gQWJvdSBBc3NhZiI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJBaG1hZCBDaGFyYWZkaW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMjoiTWFoYSBTaWJsaW5pIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTA6IkFiZWQgTWFqZWQiO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiTXVzdGFmYSBBbCBBc3NpciI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEzOiJNYXJpYSBBbCBBYm91IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNDoiUGFtZWxhIENoYW1vdW4iO2E6Mzp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNToiUGVybGEgRWwgS2hvdXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiUmhlYSBBdHRhbGxhaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTg6IkplYW4gQ2xhdWRlIE1hdHRhciI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjEwO31zOjE0OiJHZXJhbGRvIEJhZGF3aSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTY6IkFiZGFsbGFoIE1hc3NvdWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjE0OiJNb2hhbWFkIFJlc2xhbiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTI6Ik1hcmlhbSBUb2htZSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlJlaW5lIENoZXJyeSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6NDtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjk6IkVkZHkgU2FhYiI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTE6IlNlcmVuYSBSYWhpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6ODt9czoxMDoiSGFkaSBaYXlhdCI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aTo0O31zOjExOiJDaGF6YSBTYWxlaCI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IklzbWFpbCBLYWRpIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxNToiQ2hhcmJlbCBCb3dhaXJ5IjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxOToiQWJkdWwgUmFobWFuIFpvZ2hiaSI7YToyOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6Ik1pY2hlbCBEYW91IjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTI6IkFtaXIgS2FlZGJleSI7YTozOntzOjk6Ik9uZSBTaGlmdCI7aToyO3M6ODoiMiBTaGlmdHMiO2k6MTI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiT3Vzc2FtYSBFbCBNYXNyaSI7YToxOntzOjk6Ik9uZSBTaGlmdCI7aToyO31zOjEwOiJPbGEgRmFraGVyIjthOjM6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo4OiIyIFNoaWZ0cyI7aToxMjtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEzOiJFdWdlbmllIEhha2ltIjthOjE6e3M6OToiT25lIFNoaWZ0IjtpOjI7fXM6MTE6IkltYWQgWW91c3VmIjthOjI6e3M6OToiT25lIFNoaWZ0IjtpOjI7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMToiQWxhYSBGYXlzYWwiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE1OiJLaGFsaWwgTWFoYXNzZW4iO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxMToiTGFyYSBIZGF5ZmkiO2E6MTp7czo5OiJPbmUgU2hpZnQiO2k6Mjt9czoxNDoiTWFyeWx5bm5lIE1yYWQiO2E6Mjp7czo5OiJPbmUgU2hpZnQiO2k6MjtzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJIdXNzZWluIEFiZGFsbGFoIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6MTI7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiRGlhbGEgQmFyYWthdCI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMzoiQWhtYWQgUmFtYWRhbiI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjEyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6OToiWmlhZCBTYWtyIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEyOiJCYWhhYSBUaW1hbnkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aToxNjtzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjk6IlJhbWkgUmVkYSI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjEyO3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6IldhZWwgQWhtYWRpZWgiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo0O3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTQ6Ikhhc3NhbiBTbGVpbWFuIjthOjI6e3M6ODoiMiBTaGlmdHMiO2k6ODtzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE1OiJTdXphbm5lIEthZWRCYXkiO2E6Mjp7czo4OiIyIFNoaWZ0cyI7aTo4O3M6OToiU2F0dXJkYXlzIjtpOjY7fXM6MTI6IkZpcmFzIFNoYW1hcyI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjg7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxNjoiTW9oYW1hZCBTaGVya2F3aSI7YToyOntzOjg6IjIgU2hpZnRzIjtpOjQ7czo5OiJTYXR1cmRheXMiO2k6Njt9czoxMzoiV2FsYWEgSWJyYWhpbSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjE0OiJOaXphciBBbCBTb3VyaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJBbmdpZSBCb3UgVHJhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo2O31zOjEzOiJaZWluYWIgTXphbmFyIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlJvb3QgSGFsbGFrIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTE6IlppYWQgS2FsYWppIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTY6IlByZXNzaWNhIEpvdWRpZWgiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6NDt9czoxMjoiSGFuaW4gSXNtYWlsIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fXM6MTg6IkZpcmFzIEtoYWlyIEVsZGVlbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJFc3RoZXIgSG9iZWlrYSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo4O31zOjExOiJKYWQgU2Fmc291ZiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE0OiJLaGFsZWQgQWwgSGFmaSI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IkFsaSBBd3dhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjEwOiJFbGlvIFJhamhhIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6Ik5vdXJtYSBTYWlpZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEzOiJOb2hhZCBUYWJiYXJhIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ik1vc3RhZmEgUmloYW4iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiUmF6YW4gSGFpZGFyIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTM6Ikh1c3NlaW4gV2VoYmUiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiSGFzc2FuIEFubmFuIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTI6IlNhYmFoIE1hbGFlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aTo0O31zOjk6IkFmaWYgUmFhZCI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjEyOiJaYWtoaWEgS2FtZWwiO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMjoiU2lsdmEgVHJheWppIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6MTE6IkxhcmEgTWFsYWViIjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjI7fXM6ODoiQWxpIEVpZG8iO2E6MTp7czo5OiJTYXR1cmRheXMiO2k6Mjt9czoxMDoiQWhtYWQgWmVpbiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjExOiJSYXdhbmEgRGVlYiI7YToxOntzOjk6IlNhdHVyZGF5cyI7aToyO31zOjE2OiJJYnJhaGltIEtvcmtvbWF6IjthOjE6e3M6OToiU2F0dXJkYXlzIjtpOjQ7fX19', 1740753137);

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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `name`, `category`, `rank`, `created_at`, `updated_at`) VALUES
(10, 'Back Office', 'employee', 9, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(9, 'Team Leader', 'manager', 8, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(8, 'Supervisor', 'manager', 7, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(7, 'Senior Supervisor', 'manager', 6, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(6, 'Officer', 'manager', 5, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(5, 'Senior Officer', 'manager', 4, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(4, 'Executive', 'manager', 3, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(3, 'Senior Executive', 'manager', 2, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(2, 'Manager', 'manager', 1, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(1, 'Senior Manager', 'manager', 0, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(11, 'Cashier', 'employee', 10, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(12, 'Coordinator', 'employee', 11, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(13, 'Junior Back Office', 'employee', 12, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(14, 'Junior Cashier', 'employee', 13, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(15, 'Junior Cashier ', 'employee', 14, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(16, 'Junior Joker', 'employee', 15, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(17, 'Junior Services', 'employee', 16, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(18, 'Junior Stationery', 'employee', 17, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(19, 'Processor', 'employee', 18, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(20, 'Representative', 'employee', 19, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(21, 'Senior Graphic Designer', 'employee', 20, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(22, 'Senior Representative', 'employee', 21, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(23, 'Senior Specialist', 'employee', 22, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(24, 'Senior Supporter', 'employee', 23, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(25, 'Specialist', 'employee', 24, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(26, 'Supporter', 'employee', 25, '2025-02-24 22:00:00', '2025-02-27 10:36:00'),
(27, 'Team Member', 'employee', 26, '2025-02-24 22:00:00', '2025-02-27 10:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `training_steps`
--

DROP TABLE IF EXISTS `training_steps`;
CREATE TABLE IF NOT EXISTS `training_steps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `step_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF',
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
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `employee_id`, `old_branch_id`, `new_branch_id`, `vacancy_id`, `transfer_start_date`, `transfer_date`, `created_by`, `type`, `rotation_duration`, `created_at`, `updated_at`) VALUES
(158, 452, 67, 66, NULL, '2025-02-26', '2025-02-26', 5, 'Transfer', NULL, '2025-02-26 11:20:33', '2025-02-26 11:20:33'),
(159, 452, 66, 67, NULL, '2025-02-27', '2025-02-27', 5, 'Rotation', '2025-03-27', '2025-02-27 10:22:45', '2025-02-27 10:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
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
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `status`, `temp_pass`) VALUES
(1, 169, 'Tarek Badawi', 'services5@maliks.com', NULL, '$2y$12$hPLgBQRZjQgJL3tEt9BiQOF7BRV1DdeccAg2MYTAmQSQADz1R6jcG', 'user-images/J9eBOicIyGJ4XzYChWxNbcH6BMl2DcOYoIjlPWAz.jpg', 'yAUwYUULBx4OKqhDxEdeajwUik4Ws6B8R2rpbAAREQG0nYgBKDr2J1h5MAre', '2025-01-20 18:27:11', '2025-02-20 09:19:55', 'active', '$2y$12$acIxBRDWSlXjOMifYn204OBuaUqGVw0xKws6tQCnbcPB0LUUTEyCu'),
(3, 454, 'Tania Khadaj', 'hr@maliks.com', NULL, '$2y$12$rGXX3cqxXQjVJlB3H.0JZeO.I0HxLHO4e5RLyqivHUH7wO6k70EQu', 'user-images/4sHVrZmMT4Gs7Bf3JWNT2p43X0kVXxv84CSNVkS9.jpg', NULL, '2025-01-22 05:53:08', '2025-02-13 06:58:58', 'active', NULL),
(5, 157, 'Shadi Farhat', 'it@maliks.com', NULL, '$2y$12$YLBF4s/PBQVEmLm./L.Olu1qFHqNkGYsIA4JbMNGfeF3rtlMu35mG', 'user-images/RbyzQssYXtH6HNnEIUFpmnfkejgXO4FiLziKQ32t.jpg', NULL, '2025-02-13 12:49:12', '2025-02-28 08:15:57', 'active', NULL),
(8, 160, 'Ali Yassin', 'services4@maliks.com', NULL, '$2y$12$8vWBe/zJWFE.SWyucW3hceNVO6K79ukbm0c2/p6S84ZZcRmyF26TG', 'user-images/M9cJgwpD97Chx5iFUx8ljrm1Dez9XQ9shSob2r2K.png', NULL, '2025-02-26 06:13:54', '2025-02-26 06:13:54', 'active', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `branch_id`, `job`, `asked_date`, `completed_date`, `status`, `is_finished`, `employee_id`, `image_path`, `remarks`, `created_at`, `updated_at`) VALUES
(84, 11, 'Graphic designer', '2025-01-19', NULL, 'high', 0, NULL, 'images/678ac3e190a6c.jpg', NULL, '2025-01-19 18:46:30', '2025-02-12 08:35:55'),
(88, 23, 'Graphic designer', '2025-01-25', NULL, 'high', 0, NULL, NULL, NULL, '2025-01-25 14:40:24', '2025-01-25 14:40:24'),
(93, 32, 'Cashier', '2025-02-20', NULL, 'high', 0, NULL, NULL, NULL, '2025-02-20 11:35:35', '2025-02-20 11:35:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
