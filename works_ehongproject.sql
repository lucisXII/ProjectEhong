-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 มิ.ย. 2020 เมื่อ 05:03 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `works_ehongproject`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `branches`
--

CREATE TABLE `branches` (
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `branchName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `branches`
--

INSERT INTO `branches` (`br_id`, `zone_id`, `branchName`, `open_date`, `close_date`) VALUES
(1, 1, 'สำนักงานใหญ่ฮอนด้า', '2019-12-01', NULL),
(2, 2, 'สำนักงานใหญ่ยามาฮ่า', '2019-12-02', NULL),
(3, 2, 'สำนักงานใหญ่มดแดง', '2019-12-03', NULL),
(4, 3, 'สำนักงานใหญ่เวสป้า', '2019-12-04', '2020-05-01');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `checking_motorcycles`
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
-- dump ตาราง `checking_motorcycles`
--

INSERT INTO `checking_motorcycles` (`cm_id`, `m_id`, `br_id`, `user_id`, `status`, `comment`, `date`) VALUES
(4, 1, 1, 2, '1', NULL, '2020-06-12'),
(7, 2, 1, 2, '0', NULL, '2020-06-12');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `checking_spares`
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
-- dump ตาราง `checking_spares`
--

INSERT INTO `checking_spares` (`cs_id`, `s_id`, `br_id`, `user_id`, `remain`, `check`, `comment`, `date`) VALUES
(3, 1, 1, 2, 1, 1, NULL, '2020-06-03');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `checking_tools`
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
-- dump ตาราง `checking_tools`
--

INSERT INTO `checking_tools` (`ct_id`, `tool_id`, `br_id`, `user_id`, `remain`, `check`, `comment`, `date`) VALUES
(3, 1, 1, 2, 1, 0, NULL, '2020-06-12'),
(4, 2, 1, 2, 1, 1, NULL, '2020-06-12');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `concludes`
--

CREATE TABLE `concludes` (
  `cc_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `concludes`
--

INSERT INTO `concludes` (`cc_id`, `br_id`, `score`, `date`) VALUES
(1, 1, '120.50', '2020-06-01 00:00:00'),
(2, 2, '90.00', '2020-04-01 00:00:00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `costs`
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
-- dump ตาราง `costs`
--

INSERT INTO `costs` (`cost_id`, `br_id`, `user_id`, `totalamount`, `storefront`, `checkmoney`, `receipt`, `agreement`, `comment`, `date`) VALUES
(2, 1, 2, '3000.00', '1200.00', '1200.00', NULL, '#21356738', NULL, '2020-06-12');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `groups`
--

CREATE TABLE `groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `groupsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `groups`
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
-- โครงสร้างตาราง `headings`
--

CREATE TABLE `headings` (
  `hd_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `headingName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `headings`
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
-- โครงสร้างตาราง `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `migrations`
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
-- โครงสร้างตาราง `motorcycles`
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
-- dump ตาราง `motorcycles`
--

INSERT INTO `motorcycles` (`m_id`, `br_id`, `brand`, `name`, `machineNumber`, `condition`, `color`, `status`) VALUES
(1, 1, 'YMH', '2POA00', '2PO-569765', 'R', 'ดำ', '1'),
(2, 2, 'YMH', '50S100', '50P-007056', 'R', 'เขียว-ขาว', '1'),
(3, 1, 'YMH', '50S300', '50p-060727', 'R', 'นง-ขาว', '1');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('06572ec7ba16fb963da6e735d957cf3f6a59a9bc5bfa50b4f4d68a55fde39ad6a85c83b7a5167e09', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:29:50', '2020-06-01 16:29:50', '2021-06-01 23:29:50'),
('0e79441538c79b81efc70765787cce58c261980f8a37c25e89eb6145ca0d2ffb6a8d01cf0792abc9', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 06:13:20', '2020-06-03 06:13:20', '2021-06-03 13:13:20'),
('180f2a969734ea27b3ed7192221e2d12c636e74ddabe89722c1b1f1c96cfcafb114d92ddf098ba02', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:09:24', '2020-06-01 16:09:24', '2021-06-01 23:09:24'),
('2cd53f7f30788d270e918e70607375359ec14c6cdf2da4aca3dbc683bc1eeaf550a76dc5c2ef51b4', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:28:23', '2020-06-01 16:28:23', '2021-06-01 23:28:23'),
('2d7c1946cb002b917700ffef400e98b4ef4fbaf9a3b33ebd0249d02c20a32a0f83910c3a999befc9', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:12:34', '2020-06-01 17:12:34', '2021-06-02 00:12:34'),
('307d6a3a4ea26a8de2f2cf2e778cca8b4909a74426e0fe4e9156c3297e5d79da6061f7eee3b197a3', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:48:50', '2020-06-01 16:48:50', '2021-06-01 23:48:50'),
('3226fd029420c54b4d9c6dd84de9b1463f32825626fb92585bc56defd86429e52a55d83b1eccf9da', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 07:36:56', '2020-06-03 07:36:56', '2021-06-03 14:36:56'),
('32cf66eb36382376bf2b868ead0f6e13a68c02efd3bc9412c6e68e8b17afd116b0422bd233a3e009', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:27:48', '2020-06-03 04:27:48', '2021-06-03 11:27:48'),
('32ddfbc200f797f77f10e1da977a78653f8d86768f30cca5e1eaffef7bb8c60e76b1a1df0d09fa49', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:48:05', '2020-06-01 16:48:05', '2021-06-01 23:48:05'),
('351126dbd4d2b20afd86d95d92d615cfcab9671d2b3809a76e34b5cb35755c6f05a449f4e050a2d8', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:31:48', '2020-06-03 04:31:48', '2021-06-03 11:31:48'),
('35825225c3fb4e87055c5dea9b253a41e253cf8286ab53a61c9febcd4a1ce54f576a450a27ba58b1', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-10 14:21:48', '2020-06-10 14:21:48', '2021-06-10 21:21:48'),
('36455710acfe591009c5f9528215a92ff0449daa4428863fdba54630322a99d8a2cc38766cdd4731', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:31:21', '2020-06-01 17:31:21', '2021-06-02 00:31:21'),
('3756575bbfea2736bcad751ccfc5a1ea8b087d27dae37df850e94765b4ab87e874239c730d435d83', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:29:42', '2020-06-03 03:29:42', '2021-06-03 10:29:42'),
('3c34ae39d0401f30d7fd35c401d71e7933d778db4e1492388c9e62d720e4d2f590cc8bc00446a0d1', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:26:49', '2020-06-01 16:26:49', '2021-06-01 23:26:49'),
('4243bc26b4916eac91a98ebad4eeaf093e4cde574269a3f81bc4ebaebfd6b83be04bc7659ae65336', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:51:53', '2020-06-01 16:51:53', '2021-06-01 23:51:53'),
('44a7ce9880ebcccfa53f0e81dfd6f43815caaff9acd2adce6a7d195cd10d795ee08651cbf842c366', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:46:58', '2020-06-01 16:46:58', '2021-06-01 23:46:58'),
('46221427964657e25e45efef3f62fc11430aa9a2286fea3dc5c109df9da63a305e7f8d85efd07834', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:36:14', '2020-06-12 00:36:14', '2021-06-12 07:36:14'),
('47e13b328ab2c9ecf94b788ad764acbe3db28e0df30175a2239352275bb95e214a409916e2a0e46c', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:34:57', '2020-06-01 16:34:57', '2021-06-01 23:34:57'),
('4a3b2d06ad1fecd5805eeb4ee09623f9f55b068685e9812a0ee02816701dbffba3f64c60adcf8a67', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-11 23:32:58', '2020-06-11 23:32:58', '2021-06-12 06:32:58'),
('4c44725524a7e8f38d51658f642c9fbba083d7f17db574da9adbf635e85472e5e75e694ff953096e', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 15:50:31', '2020-06-01 15:50:31', '2021-06-01 22:50:31'),
('4f8f1a526e7d5b183e5e17a62e7812c6a556478d261ceb8d8fb97360cd6cdf308f7e47936e8ecaef', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:32:03', '2020-06-03 04:32:03', '2021-06-03 11:32:03'),
('5c7c3bda70012f45b4d315ca4ad0b3bf48a64e3428d7211c32cb94cfacd6f019144e6f05a5622291', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:35:04', '2020-06-12 00:35:04', '2021-06-12 07:35:04'),
('5c8db7b5b060fdc98cff3cf30a042715979823c72837d5d3e36d8643096fe4993692af5955ea86a5', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 06:12:12', '2020-06-03 06:12:12', '2021-06-03 13:12:12'),
('5e10e3014c15a18acad21b44c9479072975fa0bd11f069d078baba64f7b636acd4a1938cae37b627', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:28:38', '2020-06-03 03:28:38', '2021-06-03 10:28:38'),
('63c602367980b173db0674d97711cd3b7a415968b488c80fa9ef30da14d31217cc953deea21f85af', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:38:06', '2020-06-12 00:38:06', '2021-06-12 07:38:06'),
('729ad09fd34d5ce98aab0d590e39986500b55e324f807c1e1889de02bc3f301ec1831b5f8e8242df', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:36:22', '2020-06-01 16:36:22', '2021-06-01 23:36:22'),
('786c4a4bc8aba3b7896e3bdba32e09bfdb97f744a06178b9aba746f85360256d3d52d4904afaac1c', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 15:48:43', '2020-06-01 15:48:43', '2021-06-01 22:48:43'),
('7a51e8220a9e4a7c3dbde0b2f60601349c790fe578990502499825b2b6d983bd57f9c74027a3508a', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:28:08', '2020-06-03 03:28:08', '2021-06-03 10:28:08'),
('7b235bed981457c5711f6eedf30a128add83571bbfe280d8b49cb045e2b85d3f13ba7d07f00562e7', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:08:44', '2020-06-03 04:08:44', '2021-06-03 11:08:44'),
('82019c2f0c3c1ba2f36ba754bce440c7138fd09ca376f95149ea75dc06a320dee6c2ba0cf14ac356', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:36:37', '2020-06-12 00:36:37', '2021-06-12 07:36:37'),
('8beb27e868e33d68aa2ffb948f745384503c202eff3f51f47519fd4c390a17ccfdc8a943a61493fd', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:30:00', '2020-06-03 03:30:00', '2021-06-03 10:30:00'),
('8df7736f1ae04415673f1390aab3cd5d825546595b2872753d474e1fbf19ddd836f7fd26e2c452c4', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:23:35', '2020-06-01 17:23:35', '2021-06-02 00:23:35'),
('8ffb3414f67ba2fe8ec35d7bb0a703e1c4808f96e4a2f1bcff07b71affc17d4f9af9b9f702b1db01', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 15:55:25', '2020-06-01 15:55:25', '2021-06-01 22:55:25'),
('97b260c9c77d22441ae3a3756edded8a03211a4018f518e23f2918dc7e6110508f53bb02abe15763', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:33:10', '2020-06-03 03:33:10', '2021-06-03 10:33:10'),
('9ae89a4d454fa7b6b9792ed884f36392ce29bca35db4d632d11115bdcdda4da5db7821cdee535438', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:57:08', '2020-06-01 16:57:08', '2021-06-01 23:57:08'),
('9c0432cec67964cdff30a209c21d85feee74bb4563bce4a234e5f35eee9fa8185e62910bab2f0def', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:32:32', '2020-06-03 03:32:32', '2021-06-03 10:32:32'),
('9e01c7b345873a4456bf3da7925d1345d46a02865ebf86cef5d0096dfd27f25d6c7394ee4dcb333b', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:24:50', '2020-06-03 04:24:50', '2021-06-03 11:24:50'),
('a5046a8528bd8829c176cf52416ce332309cb532a6d8b3f839b27666dd213ad90cafb42e54f8f15b', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:03:42', '2020-06-01 17:03:42', '2021-06-02 00:03:42'),
('a50fbb514af21bec95a1a836e663afe9b7844ed7e6f834ee6b90154ae03e7fdfd00bd8939c234ecf', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:11:58', '2020-06-03 04:11:58', '2021-06-03 11:11:58'),
('b50a66603f07a20a1408883ef7937a0bba9cff6c388ccbe0933081582502630fda2459fd839bd9d0', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:35:43', '2020-06-12 00:35:43', '2021-06-12 07:35:43'),
('b83300677416f4a93ac6a430ffd7df6f296a2235dde119cedfc402f6b3880d351cf2055bbf3dfeea', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:53:46', '2020-06-01 16:53:46', '2021-06-01 23:53:46'),
('ba86a7428dbe15046a84850f52527466c73a40219ee8f69c82801d83043e1c736b676afba1f7c91e', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:38:10', '2020-06-01 16:38:10', '2021-06-01 23:38:10'),
('bb138b954227136d65fedae670a14ae0033b62310af949b9745be93b316ddf65655362da39099685', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 04:23:47', '2020-06-03 04:23:47', '2021-06-03 11:23:47'),
('bd50eb4df63ae7ea31a6a36a61edadc065ec6f5fb28be87359f9c84475894e6006414016ee5bd7f7', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:24:18', '2020-06-01 16:24:18', '2021-06-01 23:24:18'),
('c14a5ce58be3ff95b2749cdf147df5f7592959e4f8a49d3a83cce1c24de892e6acbc21eebd6069a7', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:36:58', '2020-06-03 03:36:58', '2021-06-03 10:36:58'),
('cfe74b87959ba820b1a827884d3c20668a9a28f597ca52e105ee4763bb02e82055276869b26e567d', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-12 00:32:56', '2020-06-12 00:32:56', '2021-06-12 07:32:56'),
('d27135dbe3fc5093e595d932675c8c7a826358e17b40158bb9f89672f6db91398e4903e40fcc3222', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:30:31', '2020-06-03 03:30:31', '2021-06-03 10:30:31'),
('d7f249acca5fd9455b9a98ea5468ae4d24a27c62abd5e94043855dc5f56d020b680aa53ce37d3ab9', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-04 13:09:57', '2020-06-04 13:09:57', '2021-06-04 20:09:57'),
('db7e5c9a185c7fbbc246f0eaa1b56bae3a8c6c6b170155c4e7cb2e956fad6c5d30a064da8c4f5706', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:30:45', '2020-06-01 17:30:45', '2021-06-02 00:30:45'),
('e28c10734284a809a471a4e70682a08888ddd3d93efb516a5a7308a093f83581e45b55e61fa32afe', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 17:10:32', '2020-06-01 17:10:32', '2021-06-02 00:10:32'),
('eab2a247aca1df2a459f77711efbe27521741f721da2c388cc7fa4b75c6ad1059a25e1f6f7ee483b', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 03:41:52', '2020-06-03 03:41:52', '2021-06-03 10:41:52'),
('edfd1f30917d3b05b787029b5b5cb0ff4e52fca997d3bf25b5e95d8beb262df42a5480dd9f8cf669', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-03 06:11:42', '2020-06-03 06:11:42', '2021-06-03 13:11:42'),
('fa6043166236da8ec0c44d4def34919f0f1fbe5cd8bb60990800e2987f25a54b2e069cade28a5108', NULL, 2, NULL, '[\"*\"]', 0, '2020-06-01 16:55:20', '2020-06-01 16:55:20', '2021-06-01 23:55:20');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `oauth_clients`
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
-- dump ตาราง `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'AWShGDTfRKQQWWnLNMsGN4okl5icB6M1b3jP1jy6', NULL, 'http://localhost', 1, 0, 0, '2020-05-23 08:55:36', '2020-05-23 08:55:36'),
(2, NULL, 'Laravel Password Grant Client', 'gt6yVgNqQbQk2a5sOz0uoOumEp88Ntv9lTfAHMTA', 'users', 'http://localhost', 0, 1, 0, '2020-05-23 08:55:36', '2020-05-23 08:55:36');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-23 08:55:36', '2020-05-23 08:55:36');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('0647351d0bcd10fa8d0ca3a74415b324a3b7a7b4fe2420cee4134d0c207a9fa2412f261612370fc5', '7b235bed981457c5711f6eedf30a128add83571bbfe280d8b49cb045e2b85d3f13ba7d07f00562e7', 0, '2021-06-03 11:08:44'),
('0bfe73aaecf9790735f7377f6d4cbcf8cc6e4fcf7c4ea9e4748166177cd44d5164a57032d86388c4', '44a7ce9880ebcccfa53f0e81dfd6f43815caaff9acd2adce6a7d195cd10d795ee08651cbf842c366', 0, '2021-06-01 23:46:58'),
('0fe22076f8efeb2334c02a68d898e3c0f801f85620af01cef8838f947419c5f556373d03674d05d3', '9ae89a4d454fa7b6b9792ed884f36392ce29bca35db4d632d11115bdcdda4da5db7821cdee535438', 0, '2021-06-01 23:57:08'),
('16692424545126fcb6a19ed453f73bceb0cbf786b711f16d9549b867d7063b574e0188aea77bb8c6', '8ffb3414f67ba2fe8ec35d7bb0a703e1c4808f96e4a2f1bcff07b71affc17d4f9af9b9f702b1db01', 0, '2021-06-01 22:55:25'),
('181dc36cf40a5d97f6197404174788ba2a07aca9b7355838dee08e8d8e730e68106ac4db3f8e1ba6', 'd27135dbe3fc5093e595d932675c8c7a826358e17b40158bb9f89672f6db91398e4903e40fcc3222', 0, '2021-06-03 10:30:31'),
('279cd9fb0be95ea51f516758ea252eeea2137c8c9669e16d735c67733ae8508fbe91e9ea725f397d', '307d6a3a4ea26a8de2f2cf2e778cca8b4909a74426e0fe4e9156c3297e5d79da6061f7eee3b197a3', 0, '2021-06-01 23:48:50'),
('2878e7109753f31fccf937ae601b2d830adccb0583b8a756ad2fce016454b5891084ba59698f3edd', 'b50a66603f07a20a1408883ef7937a0bba9cff6c388ccbe0933081582502630fda2459fd839bd9d0', 0, '2021-06-12 07:35:43'),
('29e6bdd0c91a76dd580d519a6d8105e481dae53c76b5e179bb2a0d13e72fc447f4b86e586af3ab22', 'b83300677416f4a93ac6a430ffd7df6f296a2235dde119cedfc402f6b3880d351cf2055bbf3dfeea', 0, '2021-06-01 23:53:46'),
('2bd669fade4feb55d8f0f65931b3d157f28ca1fc192c1b3681f6f3878ec67c6f8cf87adab149258a', 'bb138b954227136d65fedae670a14ae0033b62310af949b9745be93b316ddf65655362da39099685', 0, '2021-06-03 11:23:47'),
('2c3b0d5a62ba92d61a098fa5874ba0b2c02e811b948acf798d8cca271343400c50dc8844440e0cb7', '786c4a4bc8aba3b7896e3bdba32e09bfdb97f744a06178b9aba746f85360256d3d52d4904afaac1c', 0, '2021-06-01 22:48:44'),
('2d70097785b1cb5cec143d289bf23aca9f0388b8cb4f4bed644714c819f4703bd798edf29b6c5854', '5c8db7b5b060fdc98cff3cf30a042715979823c72837d5d3e36d8643096fe4993692af5955ea86a5', 0, '2021-06-03 13:12:12'),
('2f43495a0d658440dcd285055464ec597566d874eee5d3dd5b8bc01e3dca4ba29c1e665446aed7ce', '4f8f1a526e7d5b183e5e17a62e7812c6a556478d261ceb8d8fb97360cd6cdf308f7e47936e8ecaef', 0, '2021-06-03 11:32:03'),
('37e777140cfafc217a8d2e44e6e3060de6a9d41ad4dc17d5a892706d779e8bec639df01fb31f08db', '5c7c3bda70012f45b4d315ca4ad0b3bf48a64e3428d7211c32cb94cfacd6f019144e6f05a5622291', 0, '2021-06-12 07:35:04'),
('39a7791b1a84120e806451a46f0bce8bd49bfe0c2dd7f9022d0e4a5816e571f414b3beb851017ae3', '4c44725524a7e8f38d51658f642c9fbba083d7f17db574da9adbf635e85472e5e75e694ff953096e', 0, '2021-06-01 22:50:31'),
('3a461fc4f406cb1b3e290e457c6208fe1d21def2f9383c5ca954ed0d77fdd13f9a1516dfa628a143', '8df7736f1ae04415673f1390aab3cd5d825546595b2872753d474e1fbf19ddd836f7fd26e2c452c4', 0, '2021-06-02 00:23:35'),
('3b4558463f1f321a0fd298433d2130844339d6dda09d89b822e2a4724b89b5c39cf9f70f6a14f214', 'd7f249acca5fd9455b9a98ea5468ae4d24a27c62abd5e94043855dc5f56d020b680aa53ce37d3ab9', 0, '2021-06-04 20:09:57'),
('4670b4e61c2f631776fd99f51e07c3444162cb036213439cdea902d33e2a68f33207fa4f8766bfec', 'fa6043166236da8ec0c44d4def34919f0f1fbe5cd8bb60990800e2987f25a54b2e069cade28a5108', 0, '2021-06-01 23:55:20'),
('4a378c02e9c81b5c7d57dd65ead4b4349872de163e619461866584c9a0666d6253f0839e9ad40f0a', '5e10e3014c15a18acad21b44c9479072975fa0bd11f069d078baba64f7b636acd4a1938cae37b627', 0, '2021-06-03 10:28:38'),
('516aec6e59dfa4a367a74df3394d3416f441b3fa80847cd67a2cf5283a5b29667d1bbc0d79bacfc2', 'c14a5ce58be3ff95b2749cdf147df5f7592959e4f8a49d3a83cce1c24de892e6acbc21eebd6069a7', 0, '2021-06-03 10:36:58'),
('5259cf071f646dd7b39a71eb5f30a687b13d3f01420e341f0ab6f2704660bd81c31a5fb07e6adb0e', 'e28c10734284a809a471a4e70682a08888ddd3d93efb516a5a7308a093f83581e45b55e61fa32afe', 0, '2021-06-02 00:10:32'),
('545ac5bc322ecd6ae8a36647ebfd89b279a02b5773720a76237f68551b157643d65dad9e4688515a', 'a50fbb514af21bec95a1a836e663afe9b7844ed7e6f834ee6b90154ae03e7fdfd00bd8939c234ecf', 0, '2021-06-03 11:11:58'),
('5693d025c549e3d6be74a8a5e37570bb3d9feac5879f2482d432f0afe90c71a833fff9665d7b5954', '32cf66eb36382376bf2b868ead0f6e13a68c02efd3bc9412c6e68e8b17afd116b0422bd233a3e009', 0, '2021-06-03 11:27:48'),
('5d73e90e6e4f21134b08787b6cbe503df5791c86d149ffd8873dd021850fe3d66c966f503c889ce9', '82019c2f0c3c1ba2f36ba754bce440c7138fd09ca376f95149ea75dc06a320dee6c2ba0cf14ac356', 0, '2021-06-12 07:36:37'),
('667198b03bc2ded11f14b88303ca66466df585ac182eb3f6bc16d74882f1703ff892f438c19737ba', '3226fd029420c54b4d9c6dd84de9b1463f32825626fb92585bc56defd86429e52a55d83b1eccf9da', 0, '2021-06-03 14:36:56'),
('6aa5ea8ef363847b5f57402345429daafe9c384ffc05278a904c1f9c1c22fa09f4d5a91800ba9706', '3c34ae39d0401f30d7fd35c401d71e7933d778db4e1492388c9e62d720e4d2f590cc8bc00446a0d1', 0, '2021-06-01 23:26:49'),
('6f3c2b7184d901dcc270b673287bcc47e239a1ad2a3b47ba4c33be61260138781ecf83efd94d40a3', '63c602367980b173db0674d97711cd3b7a415968b488c80fa9ef30da14d31217cc953deea21f85af', 0, '2021-06-12 07:38:06'),
('72b15d269e87fdc395e4440f4af2284e4d3415f514cc165f833812574b1b373aa2b00890a108e193', '729ad09fd34d5ce98aab0d590e39986500b55e324f807c1e1889de02bc3f301ec1831b5f8e8242df', 0, '2021-06-01 23:36:22'),
('7414d1091c9ac079edafd7d2a5e8a48d07409dae164ad2d03a4b5f1ae039dfff464428bf874e8375', 'ba86a7428dbe15046a84850f52527466c73a40219ee8f69c82801d83043e1c736b676afba1f7c91e', 0, '2021-06-01 23:38:10'),
('7a1ebd0dd0a0daf2954884b0bbcc6fe64ba07fb8858d65cc05f07e4949d1c41b71b6f0ff0623b00c', '4a3b2d06ad1fecd5805eeb4ee09623f9f55b068685e9812a0ee02816701dbffba3f64c60adcf8a67', 0, '2021-06-12 06:32:59'),
('85438dfc2e60859f4a20b9940c270573057be32d3eeadac9d787d20b1fbb6e16645cd05213287532', '35825225c3fb4e87055c5dea9b253a41e253cf8286ab53a61c9febcd4a1ce54f576a450a27ba58b1', 0, '2021-06-10 21:21:48'),
('8b242e7480a7e9732f54fc0d3fb38f75a3cd8c1146cf81b2363d6ea2449a5e50ee317a55e1a29b77', '8beb27e868e33d68aa2ffb948f745384503c202eff3f51f47519fd4c390a17ccfdc8a943a61493fd', 0, '2021-06-03 10:30:00'),
('8e48b33a2ac650eefc8c80c7c03db3a1092ca3178cf9071c44b0a810bc651145d940ddd98006bf11', '4243bc26b4916eac91a98ebad4eeaf093e4cde574269a3f81bc4ebaebfd6b83be04bc7659ae65336', 0, '2021-06-01 23:51:53'),
('94f1dd69b48d9743841bf9afba3208ed281bf6af7ab72eae554fd23c2bd85da9a83cd81367819000', '351126dbd4d2b20afd86d95d92d615cfcab9671d2b3809a76e34b5cb35755c6f05a449f4e050a2d8', 0, '2021-06-03 11:31:48'),
('a57e0a791fcab01caf9334455f324a0ebff7874283bf0f2b0eac6e27dd7ae6eb9907c77c79996bb2', '7a51e8220a9e4a7c3dbde0b2f60601349c790fe578990502499825b2b6d983bd57f9c74027a3508a', 0, '2021-06-03 10:28:08'),
('a91b3e3248d25b866ccf0cca0bfc0b2c3416893df88af24be992c3eedba739dc10adbe1bc2a70bda', 'cfe74b87959ba820b1a827884d3c20668a9a28f597ca52e105ee4763bb02e82055276869b26e567d', 0, '2021-06-12 07:32:56'),
('ac1f2a8ba9383d070cb77ee9eba46d3ce8d179ba2491e235d0bdc6ce744887d9dd1a23340ce1bcbf', '36455710acfe591009c5f9528215a92ff0449daa4428863fdba54630322a99d8a2cc38766cdd4731', 0, '2021-06-02 00:31:21'),
('ac4cc34822689fac5d9f3f74e7a3f7ef410777db0717180bb91ace895f04b68d782ca5b3c5c76a93', 'bd50eb4df63ae7ea31a6a36a61edadc065ec6f5fb28be87359f9c84475894e6006414016ee5bd7f7', 0, '2021-06-01 23:24:18'),
('ae2cdeeca7d2dcd94bd1de751df007c255ac0e5f12cc2499a16eaba5a7b3555665b8eeb529107fc0', 'edfd1f30917d3b05b787029b5b5cb0ff4e52fca997d3bf25b5e95d8beb262df42a5480dd9f8cf669', 0, '2021-06-03 13:11:43'),
('b291f2d45f11dd0510ab15f816277c70ac804a57c8080f7b58aef8517c0180582f7f361f4b447628', 'a5046a8528bd8829c176cf52416ce332309cb532a6d8b3f839b27666dd213ad90cafb42e54f8f15b', 0, '2021-06-02 00:03:42'),
('bca4e887cf21a900ec2090d4356834451cc6f708dc55f2639b21f7c095d4c708e748e2ea3fdbbf07', '3756575bbfea2736bcad751ccfc5a1ea8b087d27dae37df850e94765b4ab87e874239c730d435d83', 0, '2021-06-03 10:29:42'),
('c220af3f599587f80082b060f17c4956e462ec1006906736286037d3764ebf10ca8676d4a50bc923', 'eab2a247aca1df2a459f77711efbe27521741f721da2c388cc7fa4b75c6ad1059a25e1f6f7ee483b', 0, '2021-06-03 10:41:52'),
('c4262d287b55c8a495e2ba874d4f71725a3555d227aa44af7afa7d8097253ec29c7d67ba2c4b18d4', '2d7c1946cb002b917700ffef400e98b4ef4fbaf9a3b33ebd0249d02c20a32a0f83910c3a999befc9', 0, '2021-06-02 00:12:34'),
('c83dee90f2a453c0418404167ff4a57f3c513eba38d8d35531c791218e8e1f67950471982860e069', '32ddfbc200f797f77f10e1da977a78653f8d86768f30cca5e1eaffef7bb8c60e76b1a1df0d09fa49', 0, '2021-06-01 23:48:05'),
('c84e13a923ee40af67f010ba28086e109b75b7831618d88dca956fd53131490c379c7b4616aaec78', '2cd53f7f30788d270e918e70607375359ec14c6cdf2da4aca3dbc683bc1eeaf550a76dc5c2ef51b4', 0, '2021-06-01 23:28:23'),
('d0066f8c2c89ba1f26d90b2f0e5519b29b9c79a248fcf431ec3dd333ecb8118b0a540f277be27c7c', '9e01c7b345873a4456bf3da7925d1345d46a02865ebf86cef5d0096dfd27f25d6c7394ee4dcb333b', 0, '2021-06-03 11:24:50'),
('d5fe4df3ed7c26b96b4a3db1faefdf4d67b77c57542ffd4309cd4fe85a5109bd8a8126b03c7dd3bd', '06572ec7ba16fb963da6e735d957cf3f6a59a9bc5bfa50b4f4d68a55fde39ad6a85c83b7a5167e09', 0, '2021-06-01 23:29:50'),
('db1380e5a86654733c4a18b2b48e5c117a832bd072a9d05c418aa623c84afe0742eb8cdba3e039e5', '9c0432cec67964cdff30a209c21d85feee74bb4563bce4a234e5f35eee9fa8185e62910bab2f0def', 0, '2021-06-03 10:32:32'),
('e3e16a1951c1467b4c605aab9521062dd9cb37bd5d9c668d3a262dca0a21f76fffb7029fab51b9b6', '97b260c9c77d22441ae3a3756edded8a03211a4018f518e23f2918dc7e6110508f53bb02abe15763', 0, '2021-06-03 10:33:10'),
('e7d9d749fadb3b4fbb947af53b28527ae3c12f8d94399fd5b467bce9c8505ee4b9672d82372caa8c', '180f2a969734ea27b3ed7192221e2d12c636e74ddabe89722c1b1f1c96cfcafb114d92ddf098ba02', 0, '2021-06-01 23:09:24'),
('f0f8af4b7654dc701be1e922021578d14628eb6ef39aa462fda706d3f09926d28ec50693d6961833', '46221427964657e25e45efef3f62fc11430aa9a2286fea3dc5c109df9da63a305e7f8d85efd07834', 0, '2021-06-12 07:36:14'),
('f5151206aa676a34308a5974fe238b0e310694e1a22c0ec7c406ae22bdb5480fe6cda4a893af98b9', '0e79441538c79b81efc70765787cce58c261980f8a37c25e89eb6145ca0d2ffb6a8d01cf0792abc9', 0, '2021-06-03 13:13:20'),
('f572f0350e9c8818b4ea883b713d177d0f481811a6f18f7fd559816db8885f03e4abfbc9d0455cb4', 'db7e5c9a185c7fbbc246f0eaa1b56bae3a8c6c6b170155c4e7cb2e956fad6c5d30a064da8c4f5706', 0, '2021-06-02 00:30:45'),
('f698c808762ca0423e74838f50cdd3e5820b8f0cc21a5aadc14a159db3b38a1c14806126fe3fb27a', '47e13b328ab2c9ecf94b788ad764acbe3db28e0df30175a2239352275bb95e214a409916e2a0e46c', 0, '2021-06-01 23:34:57');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `rate_and_scores`
--

CREATE TABLE `rate_and_scores` (
  `rs_id` bigint(20) UNSIGNED NOT NULL,
  `sh_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `spares`
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
-- dump ตาราง `spares`
--

INSERT INTO `spares` (`s_id`, `br_id`, `code`, `brand`, `name`, `remain`, `costprice`) VALUES
(1, 1, 'อล56001703', 'YMH', 'กระจกมองเลนส์สีฟ้าแบบวงรี(1ข้าง)', 1, '184.00'),
(2, 1, 'ตต56000002', 'YMH', 'กันลาย แบบตาข่ายสีดำ SPARK 155 I', 2, '91.00'),
(3, 1, 'อล55002685', 'YMH', 'กล่องหลัง ขนาด400/407/300 มม.', 1, '1122.00'),
(4, 2, 'ตต57000020', 'YMH', 'กันลายแบบตาข่าย SPARK 155 I ปี 2014 สีดำ', 2, '91.74');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `subheadings`
--

CREATE TABLE `subheadings` (
  `sh_id` bigint(20) UNSIGNED NOT NULL,
  `hd_id` bigint(20) UNSIGNED NOT NULL,
  `subheadingName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `subheadings`
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
-- โครงสร้างตาราง `tools`
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
-- dump ตาราง `tools`
--

INSERT INTO `tools` (`tool_id`, `br_id`, `code`, `name`, `remain`, `costprice`) VALUES
(1, 1, 'พม54000003', 'ชุดแต่ง Fiore', 1, '3000.00'),
(2, 1, 'สก51000001', 'หมวกกันน๊อคแถม', 5, '89.00'),
(3, 2, 'สก51000002', 'เสื้อกันลม', 10, '85.00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `totalcosts`
--

CREATE TABLE `totalcosts` (
  `tcost_id` bigint(20) UNSIGNED NOT NULL,
  `br_id` bigint(20) UNSIGNED NOT NULL,
  `totalamount` decimal(9,2) NOT NULL,
  `storefront` decimal(9,2) NOT NULL,
  `dateUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `totalcosts`
--

INSERT INTO `totalcosts` (`tcost_id`, `br_id`, `totalamount`, `storefront`, `dateUpdate`) VALUES
(1, 1, '48365.89', '2896.00', '2020-05-01 00:00:00'),
(2, 2, '5000.00', '2400.00', '2020-06-12 00:00:00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `users`
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
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `users`
--

INSERT INTO `users` (`user_id`, `name`, `address`, `phone`, `email`, `position`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Teerayut Khunsuk', 'Kalasin', '0921526980', 'teerayut@gmail.com', 'Member', 'teerayut', '$2y$10$pM0kMF5VYXp6zRywPrSpNO4hHT8syN6AXHyKcbc2jp1fNk6fPDRt6', '1', '2020-06-01 15:45:17', '2020-06-01 15:45:17');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `zones`
--

CREATE TABLE `zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zoneName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `zones`
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
  MODIFY `cm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checking_spares`
--
ALTER TABLE `checking_spares`
  MODIFY `cs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checking_tools`
--
ALTER TABLE `checking_tools`
  MODIFY `ct_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `concludes`
--
ALTER TABLE `concludes`
  MODIFY `cc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `cost_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `tcost_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
