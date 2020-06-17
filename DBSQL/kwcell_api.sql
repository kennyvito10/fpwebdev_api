-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 11:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwcell_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `billdetails`
--

CREATE TABLE `billdetails` (
  `billdetailid` int(10) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billdetails`
--

INSERT INTO `billdetails` (`billdetailid`, `bill_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(10, 3, 3, 1, '2020-05-30 11:03:12', '2020-05-30 11:03:12'),
(11, 4, 2, 3, '2020-06-10 04:18:45', '2020-06-10 04:18:45'),
(12, 4, 6, 2, '2020-06-11 07:05:26', '2020-06-11 07:05:26'),
(13, 5, 4, 2, '2020-06-11 08:25:48', '2020-06-11 08:25:48'),
(14, 6, 1, 1, '2020-06-11 09:12:31', '2020-06-11 09:12:31'),
(15, 7, 2, 2, '2020-06-15 06:57:09', '2020-06-15 06:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `billid` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`billid`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 4, '2020-05-30 11:03:12', '2020-05-31 00:14:36'),
(4, 2, 4, '2020-06-10 04:18:45', '2020-06-11 09:13:25'),
(5, 2, 2, '2020-06-11 08:25:48', '2020-06-11 08:25:59'),
(6, 2, 3, '2020-06-11 09:12:31', '2020-06-11 09:29:49'),
(7, 3, 4, '2020-06-15 06:57:09', '2020-06-15 06:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandid` int(10) NOT NULL,
  `brandName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandid`, `brandName`, `created_at`, `updated_at`) VALUES
(1, 'Apple', NULL, NULL),
(2, 'Samsung', NULL, NULL),
(3, 'Oppo', NULL, NULL),
(4, 'Xiaomi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2020_05_11_155523_create_addresses_table', 2),
(11, '2020_05_20_101703_create_brands_table', 2),
(12, '2020_05_20_102935_create_products_table', 2),
(13, '2020_05_21_142107_create_billdetails_table', 2),
(14, '2020_05_21_142434_create_bills_table', 2),
(15, '2020_05_21_161908_create_stats_table', 2),
(16, '2020_05_29_162710_update_users_table_add_api_token_field', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(10) NOT NULL,
  `productName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `imgUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productName`, `price`, `imgUrl`, `brand_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Oppo F11 Pro 64Gb', 2100000, 'oppof11pro.jpg', 3, 'GSM 4G', NULL, NULL),
(2, 'iPhone 11 128Gb Green', 14000000, 'ip11.jpg', 1, 'A13 Bionic Chip', '2020-05-30 08:50:44', '2020-05-30 08:50:44'),
(3, 'Samsung S20 Ultra 128Gb Cosmic Black', 15000000, 'samsungs20ultra.jpg', 2, 'Snapdragon 865', NULL, NULL),
(4, 'Xiaomi Redmi Note 8 Pro 64Gb', 4000000, 'xiaomiredminote8pro.jpg', 4, 'MTEK HELIO', NULL, NULL),
(6, 'Samsung Galaxy S20 Plus 128Gb Blue', 12000000, 's20plus.jpg', 2, 'Snapdragon 865\r\nCamera', '2020-05-30 23:57:56', '2020-05-31 01:31:04'),
(7, 'iPhone 11 Pro 256Gb Midnight Green', 16500000, 'iphone11pro.jpg', 1, 'A13 Bionic Chip\r\nTriple Camera Setup\r\n1 Autofocus Camera\r\n1 Telephoto Camera\r\n1 Wide Angle Camera', '2020-05-31 00:09:00', '2020-05-31 00:09:00'),
(8, 'iPhone 11 Pro 64Gb Gold', 16500000, '11pro.jpg', 1, 'A13 Bionic Chip\r\nTriple Camera', '2020-06-14 04:46:25', '2020-06-14 04:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `statusid` int(10) NOT NULL,
  `statusname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`statusid`, `statusname`, `created_at`, `updated_at`) VALUES
(1, 'Cart', NULL, NULL),
(2, 'Ordered', NULL, NULL),
(3, 'Delivered', NULL, NULL),
(4, 'Finished', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billdetails`
--
ALTER TABLE `billdetails`
  ADD PRIMARY KEY (`billdetailid`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`billid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`statusid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billdetails`
--
ALTER TABLE `billdetails`
  MODIFY `billdetailid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `billid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `statusid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billdetails`
--
ALTER TABLE `billdetails`
  ADD CONSTRAINT `billdetails_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`billid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`status`) REFERENCES `stats` (`statusid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brandid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
