-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 10:15 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ehongproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `branchName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`br_id`, `zone_id`, `branchName`, `open_date`, `close_date`) VALUES
(1, 1, 'สำนักงานใหญ่ฮอนด้า', '2019-12-01', NULL),
(2, 2, 'สำนักงานใหญ่ยามาฮ่า', '2019-12-02', NULL),
(3, 2, 'สำนักงานใหญ่มดแดง', '2019-12-03', NULL),
(4, 3, 'สำนักงานใหญ่เวสป้า', '2019-12-04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checking_motorcycles`
--

CREATE TABLE `checking_motorcycles` (
  `cm_id` bigint(20) UNSIGNED NOT NULL,
  `m_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checking_motorcycles`
--

INSERT INTO `checking_motorcycles` (`cm_id`, `m_id`, `br_id`, `user_id`, `status`, `comment`, `date`) VALUES
(1, 1, 1, 1, '1', NULL, '2020-05-01'),
(2, 3, 1, 1, '1', NULL, '2020-05-01'),
(3, 2, 2, 1, '1', NULL, '2020-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `checking_spares`
--

CREATE TABLE `checking_spares` (
  `cs_id` bigint(20) UNSIGNED NOT NULL,
  `s_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `remain` int(11) NOT NULL,
  `check` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checking_spares`
--

INSERT INTO `checking_spares` (`cs_id`, `s_id`, `br_id`, `user_id`, `remain`, `check`, `comment`, `date`) VALUES
(1, 1, 1, 1, 1, 1, NULL, '2020-05-01'),
(2, 4, 2, 1, 2, 2, NULL, '2020-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `checking_tools`
--

CREATE TABLE `checking_tools` (
  `ct_id` bigint(20) UNSIGNED NOT NULL,
  `tool_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `remain` int(11) NOT NULL,
  `check` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checking_tools`
--

INSERT INTO `checking_tools` (`ct_id`, `tool_id`, `br_id`, `user_id`, `remain`, `check`, `comment`, `date`) VALUES
(1, 1, 1, 1, 1, 1, NULL, '2020-05-01'),
(2, 3, 2, 1, 10, 10, NULL, '2020-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `concludes`
--

CREATE TABLE `concludes` (
  `cc_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `concludes`
--

INSERT INTO `concludes` (`cc_id`, `br_id`, `score`, `date`) VALUES
(1, 1, '120.50', '2020-05-01 00:00:00'),
(2, 2, '90.00', '2020-04-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `cost_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `totalamount` decimal(9,2) NOT NULL,
  `storefront` decimal(9,2) NOT NULL,
  `checkmoney` decimal(9,2) NOT NULL,
  `receipt` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agreement` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`cost_id`, `br_id`, `user_id`, `totalamount`, `storefront`, `checkmoney`, `receipt`, `agreement`, `comment`, `date`) VALUES
(1, 1, 1, '54230.21', '2345.21', '2345.21', NULL, NULL, NULL, '2020-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `groupsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `groupsName`) VALUES
(1, 'หมวดงานขาย&สต๊อกและโชว์รูม'),
(2, 'หมวดงานบริการ'),
(3, 'หมวดงานอะไหล่'),
(4, 'หมวดงานสินเชื่อ การเงิน'),
(5, 'หมวดงานบุคคล'),
(6, 'หมวดงานไอที');

-- --------------------------------------------------------

--
-- Table structure for table `headings`
--

CREATE TABLE `headings` (
  `hd_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `headingName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `headings`
--

INSERT INTO `headings` (`hd_id`, `group_id`, `headingName`) VALUES
(1, 1, '1.ความรู้ของพนักงานขาย'),
(2, 1, '2.สต๊อกสินค้า/ของแถม'),
(3, 1, '3.รถไม่พร้อมขาย/รถมือสอง'),
(4, 1, '4.สภาพโชว์รูมความสะอาดรถจักรยานยนต์'),
(5, 1, '5.ภาพลักษณ์ภายนอก/ภายใน'),
(6, 2, '1.เครื่องมือช่างเคาน์เตอร์รับรถ'),
(7, 2, '2.พื้นที่ซ่อม'),
(8, 2, '3.นายช่าง'),
(9, 2, '4.ข่าวสารด้านเทคนิค'),
(10, 3, '1.สต๊อกอะไหล่'),
(11, 3, '2.ชั้นวางอะไหล่'),
(12, 3, '3.บริเวณห้องอะไหล่'),
(13, 4, '1.เงินหน้าร้าน'),
(14, 4, '2.การใช้ใบเสร็จชั่วเสร็จคราว/และสมุดคุมทะเบียน'),
(15, 4, '3.การจัดเก็บเงินและเอกสารทางการเงิน'),
(16, 4, '4.การจัดส่งสัญญาเช่าซื้อ'),
(17, 4, '5.การทำใบน้ำฝากรถยึด'),
(18, 5, '1.อัตรากำลังคน'),
(19, 5, '2.การปฎิบัติงานของพนักงาน'),
(20, 5, '3.การรับรู้วิสัยทัศน์ ค่านิยม พันธกิจของบริษัท'),
(21, 5, '4.การแต่งกายพนักงาน'),
(22, 6, '1.ความสมบูรณ์ของอุปกรณ์คอมพิวเตอร์และอุปกรณ์สื่อสาร');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_05_19_190855_create_zones_table', 1),
(5, '2020_05_19_204008_create_concludes_table', 3),
(6, '2020_05_19_213521_create_branches_table', 4),
(7, '2020_05_19_213817_create_concludes_table', 5),
(8, '2020_05_20_234235_create_groups_table', 6),
(9, '2020_05_22_185351_create_headings_table', 7),
(10, '2020_05_22_191742_create_subheadings_table', 8),
(11, '2020_05_22_214924_create_totalcosts_table', 9),
(12, '2020_05_22_221307_create_motorcycles_table', 10),
(13, '2020_05_23_153817_create_users_table', 11),
(14, '2016_06_01_000001_create_oauth_auth_codes_table', 12),
(15, '2016_06_01_000002_create_oauth_access_tokens_table', 12),
(16, '2016_06_01_000003_create_oauth_refresh_tokens_table', 12),
(17, '2016_06_01_000004_create_oauth_clients_table', 12),
(18, '2016_06_01_000005_create_oauth_personal_access_clients_table', 12),
(19, '2020_05_24_074849_create_spares_table', 13),
(20, '2020_05_24_103233_create_tools_table', 14),
(22, '2020_05_28_222705_create_costs_table', 15),
(23, '2020_05_29_161140_create_checking_motorcycles_table', 16),
(25, '2020_05_29_165338_create_checking_tools_table', 17),
(26, '2020_05_29_170722_create_checking_spares_table', 18),
(27, '2020_05_29_172404_create_rate_and_scores_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `motorcycles`
--

CREATE TABLE `motorcycles` (
  `m_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `brand` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `machineNumber` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `condition` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `motorcycles`
--

INSERT INTO `motorcycles` (`m_id`, `br_id`, `brand`, `name`, `machineNumber`, `condition`, `color`, `status`) VALUES
(1, 1, 'YMH', '2POA00', '2PO-569765', 'R', 'ดำ', '1'),
(2, 2, 'YMH', '50S100', '50P-007056', 'R', 'เขียว-ขาว', '1'),
(3, 1, 'YMH', '50S300', '50p-060727', 'R', 'นง-ขาว', '1');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'AWShGDTfRKQQWWnLNMsGN4okl5icB6M1b3jP1jy6', NULL, 'http://localhost', 1, 0, 0, '2020-05-23 08:55:36', '2020-05-23 08:55:36'),
(2, NULL, 'Laravel Password Grant Client', 'gt6yVgNqQbQk2a5sOz0uoOumEp88Ntv9lTfAHMTA', 'users', 'http://localhost', 0, 1, 0, '2020-05-23 08:55:36', '2020-05-23 08:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-23 08:55:36', '2020-05-23 08:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_and_scores`
--

CREATE TABLE `rate_and_scores` (
  `rs_id` bigint(20) UNSIGNED NOT NULL,
  `sh_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate_and_scores`
--

INSERT INTO `rate_and_scores` (`rs_id`, `sh_id`, `br_id`, `user_id`, `score`, `date`) VALUES
(1, 60, 1, 1, '8.00', '2020-05-01'),
(2, 61, 1, 1, '1.00', '2020-05-01'),
(3, 67, 1, 1, '5.00', '2020-05-01'),
(4, 67, 2, 1, '5.00', '2020-04-30'),
(5, 60, 2, 1, '7.00', '2020-05-02'),
(6, 48, 2, 1, '2.00', '2020-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `spares`
--

CREATE TABLE `spares` (
  `s_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `code` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `brand` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `remain` int(11) NOT NULL,
  `costprice` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `spares`
--

INSERT INTO `spares` (`s_id`, `br_id`, `code`, `brand`, `name`, `remain`, `costprice`) VALUES
(1, 1, 'อล56001703', 'YMH', 'กระจกมองเลนส์สีฟ้าแบบวงรี(1ข้าง)', 1, '184.00'),
(2, 1, 'ตต56000002', 'YMH', 'กันลาย แบบตาข่ายสีดำ SPARK 155 I', 2, '91.00'),
(3, 1, 'อล55002685', 'YMH', 'กล่องหลัง ขนาด400/407/300 มม.', 1, '1122.00'),
(4, 2, 'ตต57000020', 'YMH', 'กันลายแบบตาข่าย SPARK 155 I ปี 2014 สีดำ', 2, '91.74');

-- --------------------------------------------------------

--
-- Table structure for table `subheadings`
--

CREATE TABLE `subheadings` (
  `sh_id` bigint(20) UNSIGNED NOT NULL,
  `hd_id` bigint(20) UNSIGNED NOT NULL,
  `subheadingName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subheadings`
--

INSERT INTO `subheadings` (`sh_id`, `hd_id`, `subheadingName`, `score`) VALUES
(1, 1, '1.1 พนักงานขายมีความรู้เกี่ยวกับผลิตภัณฑ์รุ่นรถที่ขาย(ทดสอบรีฟีโน่)', 1),
(2, 1, '1.2 พนักงานขายมีความรู้เกี่ยวกับเงื่อนไขการขาย การคำนวนค่าคอมมิชชั่น', 2),
(3, 1, '1.3 พนักงานขายสามารถคำนวนงวดได้', 2),
(4, 2, '2.1 สต๊อกรถสาขาเป็นปัจจุบันไม่มีรถขาดรถเกินมีเหตุผลชี้แจงได้ มีหลักฐานอ้างอิง มีเอกสารตรวจรถ', 10),
(5, 2, '2.2 ไม่มีรถในสต๊อกที่อายุเกิน 2 ปี', 3),
(6, 2, '2.3 สต๊อกของแถมเป็นปัจจุบันไม่ขาดไม่เกินมีเหตุผลชี้แจงได้ มีเอกสารตรวจของแถม', 5),
(7, 2, '2.4 ไม่มีรายการโอนย้านรถจักรยานยนต์ค้างติ๊กเกิน 2 วัน', 5),
(8, 2, '2.5 ไม่มีรายการโอนย้ายของแถม อุปกรณ์สำนักงาน สื่อการตลาด เกิน 7 วัน', 5),
(9, 3, '3.1 รถไม่พร้อมขายมีการบันทึกสถานะในระบบพร้อมระบุสาเหตุ จัดพื้นที่รถไม่พร้อมขายเป็นสัดส่วน', 5),
(10, 3, '3.2 รถมือสองในสาขาพี่พร้อมขายต้องสตาร์ทเครื่องติดทุกคัน', 5),
(11, 4, '4.1 สาขามีมุมโชว์รถรุ่นใหม่ หรือรุ่นจัดรายการ เพื่อแนะนำลูกค้า', 1),
(12, 4, '4.2 แท่นโชว์หรือรถโชว์ มีความสะอาด และสวยงาม', 1),
(13, 4, '4.3 รถจักรยานยนต์ที่อยู่ในร้านโดยรวมมีความสะอาดดูแลสม่ำเสมอ จัดเรียงสลับสีสวยงาม', 2),
(14, 4, '4.4 มีป้ายราคาขาย หรือราคาเงินดาวน์ ที่ชัดเจน เป็นระเบียงดูแล้วไม่รกตา', 2),
(15, 4, '4.5 มีบอร์ดประชาสัมพันธ์การจัดกิจกรรมของสาขา ซึ่งอยู่ในช่วงไตรมาส', 1),
(16, 4, '4.6 มีมุนน้ำดื่มให้ลูกค้า ถังน้ำดื่ม แก้วน้ำ มีความสะอาดน่าดื่ม', 1),
(17, 4, '4.7 ห้องน้ำสะอาด อ่างล้างหน้าสะอาดไม่มีคราบสกปรก ห้องน้ำไม่มีกลิ่นไม่มีหยอกไหย่', 1),
(18, 5, '5.1 บริเวณหน้าร้านมีความสะอาดไม่มีขยะ บริเวณภายนอกโชว์รูมไม่มีหญ้า', 2),
(19, 5, '5.2 มีป้ายแบรนด์เนอร์ประชาสัมพันธ์เป็นปัจจุบัน สภาพการติดตึงอ่านได้ครบ', 2),
(20, 5, '5.3 รักษาสภาพป้าย/ชื่อร้านให้อยู่ในสภาพสมบูรณ์', 1),
(21, 5, '5.4 การจัดแถวรสสลับสี แยกรุ่นชัดเจน ดูแล้วสวยงาม', 1),
(22, 5, '5.5 ดูแลกระจกภายใน ภายในร้านให้สะอาด บ่งบอกถึงการดูแลสม่ำเสมอ', 1),
(23, 5, '5.6 ติดสื่อโฆษณาตามที่บริษัทกำหนดเป็นนโยบายประจำเดือน', 1),
(24, 5, '5.7 ฝ้า เพดาน ไม่มีหยากไย่', 1),
(27, 5, '5.8 โต๊ะทำงานสะอาดและจัดเอกสารเป็นระเบียบเรียบร้อย', 1),
(28, 5, '5.9 มีมุมโบว์ชัวร์จัดในสภาพเรียบร้อย มีโบว์ชัวร์ให้ลูกค้าดู (ไม่ต้องครบรุ่น)', 1),
(29, 5, '5.10 ที่รับลูกค้า สภาพเก้าอี้โต๊ะพร้อมใช้งาน อยู่ในสภาพสะอาด', 1),
(30, 5, '5.11 มีป้ายประชาชนสัมพันธ์มดแดงฮีโร่ป้ายตั้งโต๊ะ กล่องใส่โบว์ชัวร์พร้อมใช้งาน และมีเอกสารประชาสัมพันธ์', 5),
(31, 6, '1.1 มีเอกสารควบคุมเครื่องมือช่างประจำแท่นซ่อม', 1),
(32, 6, '1.2 เครื่องมือช่างจำนวนครบตามตรงจำนวนในสต๊อก สมบูรณ์พร้อมใช้งานได้ แท่นซ่อมยกได้', 5),
(33, 6, '1.3 ตู้เครื่องมือมีความสะอาดจัดเก็บเครื่องมือเป็นระเบียบเครื่องมือไม่ชำรุด ', 1),
(34, 6, '1.4 เคาน์เตอร์รับรถ(โต๊ะช่าง) มีความสะอาดจัดเก็บเอกสารเป็นระเบียบ', 1),
(35, 7, '2.1 บริเวณพื้นที่ซ่อม แท่นซ่อม บริเวณซ่อม มีการดูแลความสะอาดสม่ำเสมอ', 1),
(36, 7, '2.2 มีถาดรองน้ำมันเครื่องเวลาซ่อม และถังเก็บน้ำมันเครื่องเก่า', 1),
(37, 8, '3.1 นายช่างสามารถเปิดปิด JOB ได้', 2),
(38, 8, '3.2 เปิด JOB งานบริการให้เป็นปัจจุบัน', 3),
(39, 9, '4.1 มีบอร์ดติดต่อข่าวสารด้านเทคนิคจักรยานยนต์', 1),
(40, 9, '4.2 มีการพิมพ์ข่าวสารด้านเทคนิคที่เป็นข้อมูลปัจจุบัน', 1),
(41, 10, '1.1 มีรายการอะไหล่ครบตามจำนวนสต๊อกไม่ขาดเกิน มีเอกสารอ้างอิง ปริ๊นสต๊อกอะไหล่', 10),
(42, 10, '1.2 มีการจัดมุมโชว์อะไหล่ พร้อมติดราคาขายปลีก', 1),
(43, 10, '1.3 ไม่มีรายการโอนย้ายอะไหล่ค้างติ๊กรับเกิน 5 วัน', 5),
(44, 11, '2.1 สาขามีชั้นสำหรับวางอะไหล่(อะไหล่ทุกชิ้นติดบาร์โค๊ด)', 2),
(45, 11, '2.2 ชั้นอะไหล่มีกล่องสำหรับใส่อะไหล่แยกตามประเภทอะไหล่ชัดเจน', 1),
(46, 12, '3.1 บริเวณห้องอะไหล่มีความสะอาดเรียบร้อย', 1),
(47, 12, '3.2 มีการจัดการเก็บกล่องอะไหล่หรือสต๊อกอะไหล่ที่ไม่ได้วางบนชั้นเป็นระเบียบ', 1),
(48, 13, '1.1 เงินหน้าร้านตรงครบตามจำนวนไม่ขาด', 10),
(49, 14, '2.1 ใบเสร็จชั่วคราวเข้าระบบครบทุกใบ', 2),
(50, 14, '2.2 มีการออกใบเสร็จเรียงตรงตามเลขที่ ไม่มีการออกข้าม', 2),
(51, 14, '2.3 มีสมุดควบคุมการใช้ใบเสร็จชั่วคราวแต่ละใบ หัวหน้าสาขาเซ็นต์รับทราบทุกใบ', 2),
(52, 14, '2.4 กรณีมีการยกเลิกชั่วคราว ให้เก็บใบเสร็จครบทั้งสามใบ', 2),
(53, 14, '2.5 สาขาจัดทำสมุดคุมทะเบียนให้ลูกค้าเซ็นต์รับถูกต้องตามแบบฟอร์มและลงข้อมูลปัจจุบัน', 2),
(54, 14, '2.6 สาขามีการโทรติดตามลูกค้าให้มารับทะเบียนและบันทึกเป็นประวัติในสัญญาทางระบบ', 2),
(55, 15, '3.1 มีการปริ๊นสรุปการรับเงินประจำวันเก็บใส่แฟ้มไว้ทุกวัน', 1),
(56, 15, '3.2 โต๊ะการเงินมีการแกะล็อคปลอดภัยในการเก็บเงิน', 1),
(57, 16, '4.1 ไม่มีสัญญาค้างส่งเกิน 15 วัน', 1),
(58, 17, '5.1 รถยึดทุกคันมีการทำใบนำฝาก', 3),
(59, 17, '5.2 ไม่มีรถยึดค้างส่งเกิน 60 วัน', 5),
(60, 18, '1.1 สาขามีอัตรากำลังคนครบตามจำนวนที่กำหนด', 8),
(61, 18, '1.2 สาขามีบอร์ดอัตรากำลังคนตามรูปแบบบริษัทฯ', 2),
(62, 19, '2.1 มีพนักงานอยู่สาขาครบในเวลางาน กรณีไม่อยู่มีเหตุผลชี้แจงได้โดยผจก.เขต', 2),
(63, 20, '3.1 พนักงานรู้ วิสัยทัศน์ ค่านิยม พันธกิจของบริษัท พร้อมอธิบายความหมายให้เข้าใจ', 3),
(64, 20, '3.2 ในสาขามีป้ายหรือสื่อ ที่พิมพ์วิสัยทัศน์และค่านิยม และพันธกิจของบริษัท', 2),
(65, 21, '4.1 พนักงานในสาขาแต่งกายถูกต้องตรงตามระเบียบ นายช่างสามรองเท้าหุ้มส้น', 3),
(66, 21, '4.2 พนักงานในสาขามีการติดบัตรพนักงานครบทุกคน', 2),
(67, 22, '1.1 คอมพิวเตอร์และอุปกรณ์ต่อพ่วง อุปกรณ์สื่อสาร มีสภาพสมบูรณ์พร้อมใช้งาน', 5),
(68, 22, '1.2 คอมพิวเตอร์ทุกเครื่องใช้งานได้เฉพาะระบบงานบริษัท (ยกเว้นสาขาที่เป็นศูนย์มาตรฐาน หรือสไกด์)', 5),
(69, 22, '1.3 ดูแลความสะอาดของคอมพิวเตอร์และอุปกรณ์ ต่อพ่วง สื่อสาร อย่างสม่ำเสมอไม่มีฝุ่นเกาะนาน', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `tool_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `code` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `remain` int(11) NOT NULL,
  `costprice` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`tool_id`, `br_id`, `code`, `name`, `remain`, `costprice`) VALUES
(1, 1, 'พม54000003', 'ชุดแต่ง Fiore', 1, '3000.00'),
(2, 1, 'สก51000001', 'หมวกกันน๊อคแถม', 5, '89.00'),
(3, 2, 'สก51000002', 'เสื้อกันลม', 10, '85.00');

-- --------------------------------------------------------

--
-- Table structure for table `totalcosts`
--

CREATE TABLE `totalcosts` (
  `tcost_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `totalamount` decimal(9,2) NOT NULL,
  `storefront` decimal(9,2) NOT NULL,
  `dateUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `totalcosts`
--

INSERT INTO `totalcosts` (`tcost_id`, `br_id`, `totalamount`, `storefront`, `dateUpdate`) VALUES
(1, 1, '48365.89', '2896.00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `address`, `phone`, `email`, `position`, `username`, `password`, `status`) VALUES
(1, 'สมศักดิ์ บุญคำ', '227/1 ตำบลยาางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ 46120', '0875563012', 'somsuk@gmail.com', 'หัวหน้าทีม', 'ีuser001', 'pass001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zoneName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zone_id`, `zoneName`) VALUES
(1, '01_สมพร'),
(2, '02_วสันต์'),
(3, '03_อ้อย'),
(4, '04_ออด'),
(5, '05_แต๋ว');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`br_id`),
  ADD KEY `branches_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `checking_motorcycles`
--
ALTER TABLE `checking_motorcycles`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `checking_motorcycles_m_id_foreign` (`m_id`),
  ADD KEY `checking_motorcycles_br_id_foreign` (`br_id`),
  ADD KEY `checking_motorcycles_user_id_foreign` (`user_id`);

--
-- Indexes for table `checking_spares`
--
ALTER TABLE `checking_spares`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `checking_spares_s_id_foreign` (`s_id`),
  ADD KEY `checking_spares_br_id_foreign` (`br_id`),
  ADD KEY `checking_spares_user_id_foreign` (`user_id`);

--
-- Indexes for table `checking_tools`
--
ALTER TABLE `checking_tools`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `checking_tools_tool_id_foreign` (`tool_id`),
  ADD KEY `checking_tools_br_id_foreign` (`br_id`),
  ADD KEY `checking_tools_user_id_foreign` (`user_id`);

--
-- Indexes for table `concludes`
--
ALTER TABLE `concludes`
  ADD PRIMARY KEY (`cc_id`),
  ADD KEY `concludes_br_id_foreign` (`br_id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `costs_br_id_foreign` (`br_id`),
  ADD KEY `costs_user_id_foreign` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `headings`
--
ALTER TABLE `headings`
  ADD PRIMARY KEY (`hd_id`),
  ADD KEY `headings_group_id_foreign` (`group_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `motorcycles_br_id_foreign` (`br_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_and_scores`
--
ALTER TABLE `rate_and_scores`
  ADD PRIMARY KEY (`rs_id`),
  ADD KEY `rate_and_scores_sh_id_foreign` (`sh_id`),
  ADD KEY `rate_and_scores_br_id_foreign` (`br_id`),
  ADD KEY `rate_and_scores_user_id_foreign` (`user_id`);

--
-- Indexes for table `spares`
--
ALTER TABLE `spares`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `spares_br_id_foreign` (`br_id`);

--
-- Indexes for table `subheadings`
--
ALTER TABLE `subheadings`
  ADD PRIMARY KEY (`sh_id`),
  ADD KEY `subheadings_hd_id_foreign` (`hd_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`tool_id`),
  ADD KEY `tools_br_id_foreign` (`br_id`);

--
-- Indexes for table `totalcosts`
--
ALTER TABLE `totalcosts`
  ADD PRIMARY KEY (`tcost_id`),
  ADD KEY `totalcosts_br_id_foreign` (`br_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `br_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checking_motorcycles`
--
ALTER TABLE `checking_motorcycles`
  MODIFY `cm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checking_spares`
--
ALTER TABLE `checking_spares`
  MODIFY `cs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checking_tools`
--
ALTER TABLE `checking_tools`
  MODIFY `ct_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `concludes`
--
ALTER TABLE `concludes`
  MODIFY `cc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `cost_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `headings`
--
ALTER TABLE `headings`
  MODIFY `hd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `motorcycles`
--
ALTER TABLE `motorcycles`
  MODIFY `m_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate_and_scores`
--
ALTER TABLE `rate_and_scores`
  MODIFY `rs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spares`
--
ALTER TABLE `spares`
  MODIFY `s_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subheadings`
--
ALTER TABLE `subheadings`
  MODIFY `sh_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `tool_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `totalcosts`
--
ALTER TABLE `totalcosts`
  MODIFY `tcost_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `zone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`zone_id`) ON DELETE CASCADE;

--
-- Constraints for table `checking_motorcycles`
--
ALTER TABLE `checking_motorcycles`
  ADD CONSTRAINT `checking_motorcycles_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_motorcycles_m_id_foreign` FOREIGN KEY (`m_id`) REFERENCES `motorcycles` (`m_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_motorcycles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `checking_spares`
--
ALTER TABLE `checking_spares`
  ADD CONSTRAINT `checking_spares_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_spares_s_id_foreign` FOREIGN KEY (`s_id`) REFERENCES `spares` (`s_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_spares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `checking_tools`
--
ALTER TABLE `checking_tools`
  ADD CONSTRAINT `checking_tools_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_tools_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`tool_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checking_tools_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `concludes`
--
ALTER TABLE `concludes`
  ADD CONSTRAINT `concludes_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE;

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `costs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `headings`
--
ALTER TABLE `headings`
  ADD CONSTRAINT `headings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE;

--
-- Constraints for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD CONSTRAINT `motorcycles_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE;

--
-- Constraints for table `rate_and_scores`
--
ALTER TABLE `rate_and_scores`
  ADD CONSTRAINT `rate_and_scores_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_and_scores_sh_id_foreign` FOREIGN KEY (`sh_id`) REFERENCES `subheadings` (`sh_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_and_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `spares`
--
ALTER TABLE `spares`
  ADD CONSTRAINT `spares_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE;

--
-- Constraints for table `subheadings`
--
ALTER TABLE `subheadings`
  ADD CONSTRAINT `subheadings_hd_id_foreign` FOREIGN KEY (`hd_id`) REFERENCES `headings` (`hd_id`) ON DELETE CASCADE;

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE;

--
-- Constraints for table `totalcosts`
--
ALTER TABLE `totalcosts`
  ADD CONSTRAINT `totalcosts_br_id_foreign` FOREIGN KEY (`br_id`) REFERENCES `branches` (`br_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
