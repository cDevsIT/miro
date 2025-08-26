-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2025 at 06:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miro`
--
CREATE DATABASE IF NOT EXISTS `miro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `miro`;

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `name`, `thumbnail`, `order`, `created_at`, `updated_at`) VALUES
(1, 'DC power connector', 'upload/product/accessories/Q7wTxKNPFvVO5xehV4aj1YuvcW0XYQZvDKYkOKIc.png', 1, '2025-05-16 22:13:33', '2025-05-16 22:13:33'),
(2, 'End-cap', 'upload/product/accessories/xMdkmxl5sAgBjmFfTpWgRCzaq3AvcytSDXE54lrf.png', 2, '2025-05-16 22:14:53', '2025-05-16 22:14:53'),
(3, 'L connector', 'upload/product/accessories/kgCJMaPjvnxHoey3cuWZx9NTSOwbfKjIOznQhd0D.png', 3, '2025-05-16 22:16:16', '2025-05-16 22:17:44'),
(4, 'Cross connector', 'upload/product/accessories/iruscZumtVNkY8QQaJn4E0XJUKDp1tq03RTsBaKM.png', 4, '2025-05-16 22:17:20', '2025-05-16 22:17:20'),
(5, 'L connector (Vertical)', 'upload/product/accessories/V0fCv8C0GYwi50NQHPcUnZ7vYQTe7Dnw3qOIQyYn.png', 5, '2025-05-16 22:19:08', '2025-05-16 22:19:08'),
(6, 'Straight connector', 'upload/product/accessories/6fvQXeDAta3ToEeix88zHf9lPUzgwrQl7tj95tNZ.png', 6, '2025-05-16 22:20:40', '2025-05-16 22:20:47'),
(7, 'T connector', 'upload/product/accessories/nSQA683GFYM7t5TBjbSizxwnxoNAcAxfSDKTWalR.png', 7, '2025-05-16 22:22:34', '2025-05-16 22:22:34'),
(8, 'I connector', 'upload/product/accessories/bnK6KzPCBlO1VJp59RKm9szp1QMZiaToSIzzrClW.png', 8, '2025-05-16 22:26:35', '2025-05-16 22:26:35'),
(9, 'L connector', 'upload/product/accessories/wXeGQ5bUEZV0AVl0EpLmLPxmSqk7TdIKrP29AeLz.png', 9, '2025-05-16 22:27:48', '2025-05-16 22:27:48'),
(10, 'Mounting Clip (Rotary)', 'upload/product/accessories/vlqXMqm6l1x8wuhvvmGcGfNDTnDNHbxFLABZIDVe.png', 10, '2025-05-16 22:29:52', '2025-05-16 22:29:52'),
(11, 'Mounting Clip (Fixed)', 'upload/product/accessories/rE6f909CK5bLmKCQn4BSBy6HpebvGD9mlJyeGSID.png', 11, '2025-05-16 22:31:03', '2025-05-16 22:31:03'),
(12, 'DC power connector(round)', 'upload/product/accessories/QQYuEksBqaPS62jJDpCDKdXyeUM0uke91qqvMbr7.png', 12, '2025-05-16 22:33:05', '2025-05-16 22:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `accessory_product`
--

CREATE TABLE `accessory_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `accessory_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `details`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Input Voltage', NULL, 1, '2025-05-13 21:49:48', '2025-05-13 22:26:52'),
(2, 'IP Ratings', NULL, 2, '2025-05-13 21:50:10', '2025-05-13 22:26:58'),
(3, 'Body Material', NULL, 3, '2025-05-13 22:22:53', '2025-05-13 22:22:53'),
(4, 'CRI', NULL, 4, '2025-05-13 22:23:10', '2025-05-13 22:23:10'),
(5, 'Body Color', NULL, 5, '2025-05-13 22:23:23', '2025-05-13 22:23:23'),
(6, 'Beam Angle', NULL, 6, '2025-05-13 22:23:37', '2025-05-13 22:23:42'),
(7, 'Mounting Type', NULL, 7, '2025-05-13 22:26:18', '2025-05-13 22:26:18'),
(8, 'Color Temperature (CCT)', NULL, 8, '2025-05-13 22:26:30', '2025-05-13 22:26:30'),
(9, 'Reflector Cover', NULL, 9, '2025-05-13 22:26:47', '2025-05-13 22:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

CREATE TABLE `attribute_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `blog_url` varchar(255) DEFAULT NULL,
  `type` enum('indoor','outdoor') NOT NULL DEFAULT 'indoor',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `details`, `thumbnail`, `banner`, `blog_url`, `type`, `order`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'LED Recessed Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/HeKMSBOme5mJwtnyeSWpA0rYDj0iYDEBgvLSfwyq.png', 'categories/banners/aIWEMI1zZOKu3WFj7zP6HgtCV5y2vC2jEUVo4R2k.png', '/product-blog', 'indoor', 1, '2025-05-10 21:49:49', '2025-05-11 21:00:51', NULL),
(2, 'LED Modular Recessed Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/OXbLALbEEoMukHulT13ahTlUaCkTxei4G6vhRpnl.png', 'categories/banners/afzVHbjnQpTxOsVu1iuf2TcobOcA6y6dJDHmUrgf.png', '', 'indoor', 2, '2025-05-10 21:52:11', '2025-05-10 21:52:11', NULL),
(3, 'LED Surface Mounted Luminaire', 'Designed to blend seamlessly with your space, Miro’s Surface Luminaires adjustable and fixed that bring elegance, performance, and purpose-driven illumination to every corner.', 'categories/thumbnails/4gsiQmAzJ990WBv7C5ec1HPdqRHiGPHOoI5B2b4j.png', 'categories/banners/8wFnC8gLQcL78DRM5kpw9GtUCSx4lbu2E5BUViXA.png', '', 'indoor', 3, '2025-05-10 21:53:53', '2025-05-11 20:00:48', NULL),
(4, 'Track Luminaire', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/ZecEgDYFUAMEfFXkzr7wwAdofgMld81WbUi0qP9l.png', 'categories/banners/DvuCgw1zwpmxWUxx0tP76Fr1am53RjWuiyFv7nl7.png', '', 'indoor', 4, '2025-05-10 21:56:59', '2025-05-10 22:37:42', NULL),
(5, 'LED Commercial Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/wEIEwjL2XcqihfXeeOT8o9JHSHfBPckRDsFFeZsl.png', 'categories/banners/pCuWDVwcDrXuNdKUUQlezTXxalUhvoUVNIqQpBei.png', '', 'indoor', 5, '2025-05-10 21:58:02', '2025-05-10 21:58:02', NULL),
(6, 'LED Profile Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/1KqFTEx62yD5O1X2wGAtgzoqOHD1ZTxWNbHqH5aC.png', 'categories/banners/DxkcB2T0DySB4ipAWAofUtb8MRiEXi5izWpf2IM7.png', '', 'indoor', 6, '2025-05-10 22:00:04', '2025-05-10 22:00:04', NULL),
(7, 'LED Strip Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/CTywbTFzaM4hKwQK7CnzPy6LrbcJuGJZHLT2uPAS.png', 'categories/banners/8W8ZWCAwBDs8boE7KXQsghyeHhK29DjhIkkgC1V1.png', '', 'indoor', 7, '2025-05-10 22:01:05', '2025-05-10 22:01:05', NULL),
(8, 'Drivers & Accessories', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/9CVdUglQHhADlo20YgrJWwqX7PvQS06yUGHKSPxE.png', 'categories/banners/CPUbyxMrtihB7I9G7dCB2cdJZuga1OjBTw7olZwK.png', '', 'indoor', 8, '2025-05-10 22:03:13', '2025-05-10 22:03:13', NULL),
(9, 'Adjustable Recessed Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/vqzxZ5HBQBipICfHabdH3sRJ0l05T8nQL40oeZ7j.png', 'categories/banners/th9z0os4B8Ox6DI1u0KNdKazCdgWL9Q4yU4rYb4v.png', '', 'indoor', 9, '2025-05-10 22:09:35', '2025-05-10 22:09:35', 1),
(10, 'Non- Adjustable Recessed Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/wIBRQZZ5RiRwMuJ5Ao7b8lG3nmvSP6ulAMNDprIu.png', 'categories/banners/HnwdXoTzl6Jhx9z7AeoCybALNpFUjjbIAd5HdF3g.png', '', 'indoor', 10, '2025-05-10 22:19:59', '2025-05-10 22:19:59', 1),
(11, 'Recessed Modular Accessories', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/B097bCLo2fEtnSHOaalx5zVDm7n0d4uckIo6jLML.png', 'categories/banners/tOP1p7CC0QZ3NzXqkVETkthBcNTnkZpqcD2J3e5O.png', '', 'indoor', 11, '2025-05-10 22:25:31', '2025-05-10 22:25:31', 2),
(12, 'Recessed Modular Adjustable Luminaire', 'Miro LED Recessed Luminaires provide energy-efficient, flicker-free lighting with high CRI for true color accuracy. Adjustable and durable, they seamlessly integrate into modern interiors.', 'categories/thumbnails/TF2uTbGfeP06LdWh008LWc5oFD0hl0Jb85ZhxX9l.png', 'categories/banners/tcNWmPv5tawQFaCWW3H7FabxSNfXMJogvmSgNh2D.png', '', 'indoor', 12, '2025-05-10 22:29:32', '2025-05-10 22:29:32', 2),
(13, 'Adjustable Surface Luminaire', 'Designed to blend seamlessly with your space, Miro’s Surface Luminaires adjustable and fixed that bring elegance, performance, and purpose-driven illumination to every corner.', 'categories/thumbnails/1AD37xGNg2UMd93dQxgDdibtzTizlXtYMmNSNybS.png', 'categories/banners/CH1vPbsauePMsPNdzowyrp2N0chL0PtyHUWzgDY8.png', '', 'indoor', 13, '2025-05-10 22:32:20', '2025-05-11 20:00:59', 3),
(14, 'Non- Adjustable Surface Luminaire', 'Designed to blend seamlessly with your space, Miro’s Surface Luminaires adjustable and fixed that bring elegance, performance, and purpose-driven illumination to every corner.', 'categories/thumbnails/fLncuQaQvHJLAZaN4QcNSwm5qF9tkEBtRPiCAKrE.png', 'categories/banners/zeIXpR68Lv5P507tNEp7vMyqUqjPVDPw76PXQwnp.png', '', 'indoor', 14, '2025-05-10 22:34:44', '2025-05-11 20:01:15', 3),
(15, 'High Voltage Track Luminaire', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/AMTaTDL5KrFMRo2g0nUzt0BsLV2X4XFRCzqq7MkB.png', 'categories/banners/zCRVnzQ4zR96A8qhdw4ONEkoLpWgNkD1wefvJTPs.png', '', 'indoor', 15, '2025-05-11 20:03:02', '2025-05-11 20:03:02', 4),
(16, 'LED Magnetic Track Luminaire', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/X732qyejDFprat2DAaJ4gp3vEnkNdCO7ey3EcHrl.png', 'categories/banners/gSPVtmajVj3Im4DHcwadZliMgNC4ZTdi1XmIrNgo.png', '', 'indoor', 16, '2025-05-11 20:05:13', '2025-05-11 20:05:13', 4),
(17, 'LED Mini Magnetic Track Luminaire', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/is4Nt4sVEvayH2d3Z8LMweh82we5gWRESaN0rdT4.png', 'categories/banners/b2Fb8XnrZpmwo10VIulASBq2vzEiCHKpPjFWM840.png', '', 'indoor', 16, '2025-05-11 20:06:15', '2025-05-11 20:06:15', 4),
(18, 'LED Wire Track Luminaire (Hueline Series)', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/tn8IomuRe6VvoTynGMAP2ftR1cvS5ChGUOvF7Z9w.png', 'categories/banners/w1Ptt5TkZ63rWIoFaBD1bQnQ3gF9Ah4xumFtx6uE.png', '', 'indoor', 17, '2025-05-11 20:07:49', '2025-05-11 20:07:49', 4),
(19, 'LED Wire Track Luminaire (Cloudband Series)', 'Miro Lighting offers high-CRI track systems—high-voltage, magnetic, wire, and mini—for stylish, flexible, and powerful lighting. Ideal for retail, office, and displays, with premium LED performance.', 'categories/thumbnails/QnS21lz5EZqmjQitoDnmzUBPqNzkGeAoTjZDt5PQ.png', 'categories/banners/qPoR3WyXagN7GzvPtB8SzXjfqwB0adL4YHO5hPnl.png', '', 'indoor', 18, '2025-05-11 20:09:14', '2025-05-11 20:09:14', 4),
(20, 'Surface Panel Luminaire', NULL, 'categories/thumbnails/NzjEDlp1P4THGs8vtX76zZ4aZrj9eRWi05NJoJTw.png', NULL, '', 'indoor', 19, '2025-05-11 20:11:39', '2025-05-11 20:11:39', 5),
(21, 'Highbay Luminaire', NULL, 'categories/thumbnails/E6258vPQBQWhX5FO4nL86MldGzonEJFy6kkT8jJD.png', NULL, '', 'indoor', 20, '2025-05-11 20:14:14', '2025-05-11 20:14:14', 5),
(22, 'Architectural LED Linear Luminaire', NULL, 'categories/thumbnails/qrk3TOAhRwZQLQUc9HkoVOAmsQXgWLZuzoOuSnQt.png', NULL, '', 'indoor', 21, '2025-05-11 20:15:27', '2025-05-11 20:15:40', 6),
(23, 'Customized LED Profile Luminaire', NULL, 'categories/thumbnails/vWzVpIb55qBoWHflPueSgWZyh4Sees7AzsH4fKYL.png', NULL, '', 'indoor', 22, '2025-05-11 20:17:49', '2025-05-11 20:17:49', 6),
(24, 'AC LED Strip Luminaire', NULL, 'categories/thumbnails/7TpAj1z3KS61vmAHHIZwlANAlRcTvxUtPKXcyiIK.png', NULL, '', 'indoor', 23, '2025-05-11 20:19:08', '2025-05-11 20:19:08', 7),
(25, 'DC LED Strip Luminaire', NULL, 'categories/thumbnails/GBhFyhHrKAfDTETUEbLhZfqwsGN88cLBx7JthEVR.png', NULL, '', 'indoor', 24, '2025-05-11 20:19:49', '2025-05-11 20:19:57', 7),
(26, 'Wall Mounted Light', NULL, 'categories/thumbnails/6Pv0TafPtE0HY8wZSRygylFuhwwaIaWqtaBeCtfv.png', NULL, NULL, 'outdoor', 25, '2025-05-11 21:01:55', '2025-05-11 21:02:05', NULL),
(28, 'Facade Light', NULL, 'categories/thumbnails/f1g1z9QMpX8lpCRwjsfvtYPDyHheSwNUSfQzPhWn.png', NULL, NULL, 'outdoor', 26, '2025-05-11 21:06:45', '2025-05-11 21:06:45', NULL),
(29, 'In Grounds Light', NULL, 'categories/thumbnails/20IgPlbqseLy05zwC9t5x166tszAuhFAevoW5vNX.png', NULL, NULL, 'outdoor', 27, '2025-05-11 21:07:31', '2025-05-11 21:07:31', NULL),
(30, 'Flood Light', NULL, 'categories/thumbnails/NdL0Lz64qeloXTTSnlmXjSiWQA6WxOohHzuEhDwg.png', NULL, NULL, 'outdoor', 28, '2025-05-11 21:07:56', '2025-05-11 21:08:21', NULL),
(31, 'Submersible Light', NULL, 'categories/thumbnails/MavZbRMoaHif1MhTn2DtcmQcjFa9jLCxMPf16KJh.png', NULL, NULL, 'outdoor', 29, '2025-05-11 21:09:12', '2025-05-11 21:09:12', NULL),
(32, 'Landscape Light', NULL, 'categories/thumbnails/aAoFfUiFPdkRreevWPjEzdrHNq74xZTG0UdKFYmv.png', NULL, NULL, 'outdoor', 30, '2025-05-11 21:09:37', '2025-05-12 21:01:21', NULL),
(33, 'Ceiling Mounted Light', NULL, 'categories/thumbnails/CqKYmc8qh9dbT4k4ICgyAq56c2SFYQxXmD19nhWo.png', NULL, NULL, 'outdoor', 31, '2025-05-11 21:10:02', '2025-05-11 21:10:08', NULL),
(34, 'Industrial Light', NULL, 'categories/thumbnails/MrY7H41xM5pnaT3iL9v9pjdoqvnN9FonyZxyvJ5P.png', NULL, NULL, 'outdoor', 32, '2025-05-11 21:11:42', '2025-05-11 21:11:42', NULL),
(35, 'Marker Light', NULL, 'categories/thumbnails/C4rWPoGWxh3K0pakwcOOpYBHoCQPy3SfJskGZAEc.png', NULL, NULL, 'outdoor', 33, '2025-05-11 21:12:32', '2025-05-11 21:12:32', NULL),
(36, 'Strip Light', NULL, 'categories/thumbnails/cib798NXsmCWzUhJ8zcHZkSBwKRvrXdGNCBCdUH1.png', NULL, NULL, 'outdoor', 34, '2025-05-11 21:13:10', '2025-05-11 21:13:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(35, 9, 1, NULL, NULL),
(36, 9, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `color_code`, `order`, `created_at`, `updated_at`) VALUES
(1, 'White', '#FFFFFF', 1, '2025-05-11 21:13:41', '2025-05-11 21:13:41'),
(2, 'Black', '#000000', 2, '2025-05-11 21:13:50', '2025-05-11 21:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `color_product`
--

CREATE TABLE `color_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `profession`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Rafiqul Islam', 'rumon24h@gmail.com', '$2y$12$YSnTTqlfJYf3QEk3XPW12uCyLXBclF2CE7/4fUVgJOoEwlp57JvlK', 'Architect', '01886350525', NULL, '2025-05-11 21:24:16', '2025-05-11 21:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `dimension_options`
--

CREATE TABLE `dimension_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `diagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dimension_options`
--

INSERT INTO `dimension_options` (`id`, `name`, `order`, `thumbnail`, `diagram`, `created_at`, `updated_at`) VALUES
(1, 'MIR-D401A1001-12W', 1, 'dimension-options/thumbnails/eXNVxYxFRnSsQAy7G0qn1kOjaNIGeTATseihkvVG.png', 'dimension-options/diagrams/7i2yztbCLDYTdk2bJUsaNWxG6XdzaWIjsYXnB7IE.png', '2025-05-11 21:19:03', '2025-05-30 23:36:48'),
(2, 'MIR-D401A1001-20W', 2, 'dimension-options/thumbnails/wluwaFQjhtQxRQJfI9TQEdRBOWCTCEDXxk75i3Yx.png', 'dimension-options/diagrams/x2fLdx7lDDuOiKoGKA5cG9R8sfnwenSKoxbxsN5k.png', '2025-05-11 21:19:28', '2025-05-11 21:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `dimension_option_product`
--

CREATE TABLE `dimension_option_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dimension_option_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_products`
--

CREATE TABLE `family_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `power` varchar(255) DEFAULT NULL,
  `slot` varchar(255) DEFAULT NULL,
  `dimensions_lwh` varchar(255) DEFAULT NULL,
  `dimensions_qh` varchar(255) DEFAULT NULL,
  `cut_hole_in_mm` varchar(255) DEFAULT NULL,
  `cut_hole_in_diameter` varchar(255) DEFAULT NULL,
  `mounting_type` varchar(255) DEFAULT NULL,
  `voltage` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_products`
--

INSERT INTO `family_products` (`id`, `model_no`, `power`, `slot`, `dimensions_lwh`, `dimensions_qh`, `cut_hole_in_mm`, `cut_hole_in_diameter`, `mounting_type`, `voltage`, `created_at`, `updated_at`) VALUES
(1, 'MIR-D401A1001-12W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-11 21:30:59', '2025-05-30 22:56:53'),
(2, 'MIR-D401A1001-20W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-11 21:31:41', '2025-05-30 22:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `family_product_product`
--

CREATE TABLE `family_product_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `family_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_product_product`
--

INSERT INTO `family_product_product` (`id`, `family_product_id`, `product_id`, `created_at`, `updated_at`) VALUES
(18, 1, 1, NULL, NULL),
(19, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `installation_methods`
--

CREATE TABLE `installation_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installation_methods`
--

INSERT INTO `installation_methods` (`id`, `name`, `thumbnail`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Surface Mount', 'upload/product/installation-methods/1748668382_20W.png', 1, '2025-05-30 23:13:02', '2025-05-30 23:13:02'),
(2, 'IP Ratings', 'upload/product/installation-methods/1748668892_12W.png', 2, '2025-05-30 23:21:32', '2025-05-30 23:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `installation_method_product`
--

CREATE TABLE `installation_method_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `installation_method_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installation_method_product`
--

INSERT INTO `installation_method_product` (`id`, `installation_method_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_14_create_attributes_table', 1),
(5, '2024_03_14_create_categories_table', 1),
(6, '2024_03_15_create_customers_table', 1),
(7, '2024_03_16_create_appointments_table', 1),
(8, '2024_04_08_create_messages_table', 1),
(9, '2025_05_09_064455_create_colors_table', 1),
(10, '2025_05_09_065853_create_reflector_colors_table', 1),
(11, '2025_05_09_071049_create_dimension_options_table', 1),
(12, '2025_05_09_081829_create_family_products_table', 1),
(13, '2025_05_09_083002_create_accessories_table', 1),
(14, '2025_05_09_105458_create_installation_methods_table', 1),
(15, '2025_05_09_111750_add_parent_id_to_categories_table', 1),
(16, '2025_05_09_114440_create_products_table', 1),
(17, '2025_05_09_114445_create_product_category_table', 1),
(18, '2025_05_09_114446_create_product_color_table', 1),
(19, '2025_05_09_114446_create_product_dimension_option_table', 1),
(20, '2025_05_09_114446_create_product_reflector_color_table', 1),
(21, '2025_05_09_114447_create_product_accessory_table', 1),
(22, '2025_05_09_114447_create_product_family_product_table', 1),
(23, '2025_05_09_114447_create_product_installation_method_table', 1),
(24, '2025_05_09_114502_create_product_images_table', 1),
(25, '2025_05_09_122246_add_order_to_dimension_options_table', 1),
(26, '2025_05_09_140953_create_category_product_table', 1),
(27, '2025_05_09_153713_create_color_product_table', 1),
(28, '2025_05_09_160217_create_attribute_product_table', 1),
(29, '2025_05_09_160320_create_dimension_option_product_table', 1),
(30, '2025_05_09_160400_create_family_product_product_table', 1),
(31, '2025_05_09_160439_create_accessory_product_table', 1),
(32, '2025_05_09_160517_create_installation_method_product_table', 1),
(33, '2025_05_09_160717_add_missing_pivot_tables', 1),
(34, '2025_05_10_032419_modify_dimension_options_table', 1),
(35, '2025_05_10_032741_make_dimension_options_fields_nullable', 1),
(36, '2025_05_10_033846_add_description_and_specifications_to_products_table', 1),
(37, '2025_05_10_040154_remove_description_and_specifications_from_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_suffix` varchar(255) DEFAULT NULL,
  `model_number` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `brochure` varchar(255) DEFAULT NULL,
  `view_3d` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `title_suffix`, `model_number`, `description`, `thumbnail`, `brochure`, `view_3d`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Recessed Modular Adjustable Luminaire', NULL, 'MIR-D401A1001', NULL, 'products/thumbnails/yDSHFHYIQt6p34jZ0qkL9s1jEVrEVh44TsB0vBsv.png', NULL, NULL, 1, 1, '2025-05-17 21:33:52', '2025-05-17 21:33:52'),
(2, 'dzcdx', 'xcvcxv', 'cxvcxv', NULL, 'products/thumbnails/O4Wll3mb766drBvcBBnAZJVSpnAot9THp5YURhaq.png', NULL, NULL, 1, 2, '2025-05-17 21:44:21', '2025-05-17 21:44:21'),
(3, 'dsxvdcxv', NULL, 'MIR-D401A1004', NULL, 'products/thumbnails/5kyWjFvfchVhvVAdX1dbEnch1xWwLaOWYYZAwUrg.png', NULL, NULL, 1, 0, '2025-05-30 23:41:20', '2025-05-30 23:41:20'),
(4, 'fgfdgfdgdfg', NULL, 'MIR-D401A1006', NULL, 'products/thumbnails/ekaI6FEmMuDl3VrYZK5xaSunmSiA1WBuT3ZlLMJ4.png', NULL, NULL, 1, 0, '2025-05-30 23:41:34', '2025-05-30 23:41:34'),
(5, 'sdfsdfs', NULL, 'MIR-D401A1009', NULL, 'products/thumbnails/ijagb4yx7Be1NZMfu41D6OgWExZTaTvdlXgSdhJM.png', NULL, NULL, 1, 6, '2025-05-30 23:42:59', '2025-05-30 23:42:59'),
(6, 'sdfdsf', NULL, 'MIR-D401A10011', NULL, 'products/thumbnails/C9S0nmiVDhw527zm6mbrHwqwZGtRrA0HPLLmjrPk.png', NULL, NULL, 1, 99, '2025-05-30 23:43:29', '2025-05-30 23:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_accessory`
--

CREATE TABLE `product_accessory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `accessory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_dimension_option`
--

CREATE TABLE `product_dimension_option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `dimension_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_family_product`
--

CREATE TABLE `product_family_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `family_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `order`, `created_at`, `updated_at`) VALUES
(46, 1, 'products/images/bPijudN1tjMMveyEXmZjFTSVHQTHjTfEfV8cyETh.jpg', 0, '2025-05-17 21:33:52', '2025-05-17 21:33:52'),
(47, 1, 'products/images/r0bBLg84XjjR1XJVELFooqEewSQMw74LDbfNa8k8.jpg', 1, '2025-05-17 21:33:52', '2025-05-17 21:33:52'),
(48, 1, 'products/images/UfZPXobT4qa9C5pAlfhuQWHg8LMSvscCwWgquoio.jpg', 2, '2025-05-17 21:33:52', '2025-05-17 21:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_installation_method`
--

CREATE TABLE `product_installation_method` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `installation_method_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reflector_color`
--

CREATE TABLE `product_reflector_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `reflector_color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reflector_colors`
--

CREATE TABLE `reflector_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reflector_colors`
--

INSERT INTO `reflector_colors` (`id`, `name`, `thumbnail`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Matte White', 'upload/product/reflector-color/IPLxTfZu5XjJuDajUpY8dWuMhHM1vkH0vvQMKElF.png', 1, '2025-05-11 21:17:03', '2025-05-11 21:17:03'),
(2, 'Matte Black', 'upload/product/reflector-color/O46TpseBSzbAmlL1yGuWBo0l8NDFKifh4MqnPeHt.png', 2, '2025-05-11 21:17:24', '2025-05-11 21:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gH1YMEfH5zPr3ljZCuy9yYRbNejWq78Y9tuWM1jG', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXBzdldqQWpwVzlYSHF6NnBDN1B4cXV6b3Fxa1FXQldSTWlucE4ySyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9kdWN0cz9wYWdlPTEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1748670548),
('oDbsh7QxcuhKKfNKXY8KaaqFLZCv4MGkMs5yQEVu', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEtDc3p3S0UxekhQQmFUaE53aFV4WkRPTm9aVk1uUzZFV1prcGE0ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9kdWN0cz9zZWFyY2g9Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1748753040);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'rumon2u@gmail.com', NULL, '$2y$12$GgR0XW0qnG3HIStbZgxstueZ7tJHQTanhr3m9q..NiwUO9e/mp4SO', NULL, '2025-05-10 21:31:19', '2025-05-10 21:31:19'),
(2, 'Admin User', 'rumon24h@gmail.com', NULL, '$2y$12$Reu2JFzKp1BSy8t7UJezsuJyY6LE/I9.pzAMRLUdpYmhajX64DMKi', NULL, '2025-05-17 02:05:35', '2025-05-17 02:05:35'),
(3, 'Foujia', 'foujia.fuji@gmail.com', NULL, '$2y$12$O37h7redD3fkgbAbgQeH6uM0X9YP181FuQvbfaT19TgLiUYKTPLRW', NULL, '2025-05-23 07:38:06', '2025-05-23 07:38:06'),
(5, 'Sharmin', 'sharminmeena24h@gmail.com', NULL, '$2y$12$0ueu99Eh.Q8pTohYqPfRT.mZGmKcHsJZh7fQtwh9aMdMtiZMN4wIC', NULL, '2025-05-23 07:42:51', '2025-05-23 07:42:51'),
(6, 'Zayed', 'zayedbinalam123@gmail.com', NULL, '$2y$12$NVTUUHR5MaacFVh.x/.xH.ycn2ueuk1.V9muQLaE7yhJ7xAURoN3.', NULL, '2025-05-23 07:44:22', '2025-05-23 07:44:22'),
(7, 'Meem', 'intrends.meem@gmail.com', NULL, '$2y$12$UGra1Aq/ZQ0BO95BUXcP.uj6wTsxJIx/b4.MHVSNKL9cqOhg.0IPG', NULL, '2025-05-23 07:48:26', '2025-05-23 07:48:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessory_product`
--
ALTER TABLE `accessory_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accessory_product_accessory_id_product_id_unique` (`accessory_id`,`product_id`),
  ADD KEY `accessory_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_product_attribute_id_product_id_unique` (`attribute_id`,`product_id`),
  ADD KEY `attribute_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_product_category_id_product_id_unique` (`category_id`,`product_id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_product`
--
ALTER TABLE `color_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_product_color_id_product_id_unique` (`color_id`,`product_id`),
  ADD KEY `color_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `dimension_options`
--
ALTER TABLE `dimension_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dimension_option_product`
--
ALTER TABLE `dimension_option_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dimension_option_product_dimension_option_id_product_id_unique` (`dimension_option_id`,`product_id`),
  ADD KEY `dimension_option_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `family_products`
--
ALTER TABLE `family_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_product_product`
--
ALTER TABLE `family_product_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `family_product_product_family_product_id_product_id_unique` (`family_product_id`,`product_id`),
  ADD KEY `family_product_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `installation_methods`
--
ALTER TABLE `installation_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installation_method_product`
--
ALTER TABLE `installation_method_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inst_method_prod_unique` (`installation_method_id`,`product_id`),
  ADD KEY `installation_method_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_model_number_unique` (`model_number`);

--
-- Indexes for table `product_accessory`
--
ALTER TABLE `product_accessory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_accessory_product_id_foreign` (`product_id`),
  ADD KEY `product_accessory_accessory_id_foreign` (`accessory_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_color_product_id_foreign` (`product_id`),
  ADD KEY `product_color_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_dimension_option`
--
ALTER TABLE `product_dimension_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_dimension_option_product_id_foreign` (`product_id`),
  ADD KEY `product_dimension_option_dimension_option_id_foreign` (`dimension_option_id`);

--
-- Indexes for table `product_family_product`
--
ALTER TABLE `product_family_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_family_product_product_id_foreign` (`product_id`),
  ADD KEY `product_family_product_family_product_id_foreign` (`family_product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_installation_method`
--
ALTER TABLE `product_installation_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_installation_method_product_id_foreign` (`product_id`),
  ADD KEY `product_installation_method_installation_method_id_foreign` (`installation_method_id`);

--
-- Indexes for table `product_reflector_color`
--
ALTER TABLE `product_reflector_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reflector_color_product_id_foreign` (`product_id`),
  ADD KEY `product_reflector_color_reflector_color_id_foreign` (`reflector_color_id`);

--
-- Indexes for table `reflector_colors`
--
ALTER TABLE `reflector_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `accessory_product`
--
ALTER TABLE `accessory_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attribute_product`
--
ALTER TABLE `attribute_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color_product`
--
ALTER TABLE `color_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dimension_options`
--
ALTER TABLE `dimension_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dimension_option_product`
--
ALTER TABLE `dimension_option_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_products`
--
ALTER TABLE `family_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_product_product`
--
ALTER TABLE `family_product_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `installation_methods`
--
ALTER TABLE `installation_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `installation_method_product`
--
ALTER TABLE `installation_method_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_accessory`
--
ALTER TABLE `product_accessory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_dimension_option`
--
ALTER TABLE `product_dimension_option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_family_product`
--
ALTER TABLE `product_family_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `product_installation_method`
--
ALTER TABLE `product_installation_method`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reflector_color`
--
ALTER TABLE `product_reflector_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reflector_colors`
--
ALTER TABLE `reflector_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessory_product`
--
ALTER TABLE `accessory_product`
  ADD CONSTRAINT `accessory_product_accessory_id_foreign` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accessory_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `color_product`
--
ALTER TABLE `color_product`
  ADD CONSTRAINT `color_product_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `color_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dimension_option_product`
--
ALTER TABLE `dimension_option_product`
  ADD CONSTRAINT `dimension_option_product_dimension_option_id_foreign` FOREIGN KEY (`dimension_option_id`) REFERENCES `dimension_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dimension_option_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_product_product`
--
ALTER TABLE `family_product_product`
  ADD CONSTRAINT `family_product_product_family_product_id_foreign` FOREIGN KEY (`family_product_id`) REFERENCES `family_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_product_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `installation_method_product`
--
ALTER TABLE `installation_method_product`
  ADD CONSTRAINT `installation_method_product_installation_method_id_foreign` FOREIGN KEY (`installation_method_id`) REFERENCES `installation_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `installation_method_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_accessory`
--
ALTER TABLE `product_accessory`
  ADD CONSTRAINT `product_accessory_accessory_id_foreign` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_accessory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_dimension_option`
--
ALTER TABLE `product_dimension_option`
  ADD CONSTRAINT `product_dimension_option_dimension_option_id_foreign` FOREIGN KEY (`dimension_option_id`) REFERENCES `dimension_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_dimension_option_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_family_product`
--
ALTER TABLE `product_family_product`
  ADD CONSTRAINT `product_family_product_family_product_id_foreign` FOREIGN KEY (`family_product_id`) REFERENCES `family_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_family_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_installation_method`
--
ALTER TABLE `product_installation_method`
  ADD CONSTRAINT `product_installation_method_installation_method_id_foreign` FOREIGN KEY (`installation_method_id`) REFERENCES `installation_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_installation_method_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reflector_color`
--
ALTER TABLE `product_reflector_color`
  ADD CONSTRAINT `product_reflector_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reflector_color_reflector_color_id_foreign` FOREIGN KEY (`reflector_color_id`) REFERENCES `reflector_colors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
