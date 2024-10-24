-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2024 at 02:15 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysweetiepie_spbakeco`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon_products`
--

CREATE TABLE `addon_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `veriation_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `basket_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type` enum('billing','delivery') NOT NULL DEFAULT 'billing',
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `order_id`, `basket_id`, `firstname`, `lastname`, `address`, `postalcode`, `city`, `province`, `country`, `phone`, `email`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(84, 6, 11, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'delivery', 1, '2024-09-02 04:22:45', '2024-09-02 04:22:46'),
(83, 6, 11, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'billing', 1, '2024-09-02 04:22:45', '2024-09-02 04:22:46'),
(74, 5, 9, 'shefii', 'km', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'CA', '8484848484', 'shefii.indigital@gmail.com', 'delivery', 7, '2024-08-30 06:44:39', '2024-08-30 06:44:40'),
(73, 5, 9, 'shefii', 'km', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'CA', '8484848484', 'shefii.indigital@gmail.com', 'billing', 7, '2024-08-30 06:44:39', '2024-08-30 06:44:40'),
(72, 4, 8, 'Biju', 'Yohannan', 'testing', 't0a0a0', 'Abee', 'Alberta', 'CA', '2342342342', 'bijuys@gmail.com', 'delivery', 8, '2024-08-30 05:57:46', '2024-08-30 05:57:47'),
(71, 4, 8, 'Biju', 'Yohannan', 'testing', 't0a0a0', 'Abee', 'Alberta', 'CA', '2342342342', 'bijuys@gmail.com', 'billing', 8, '2024-08-30 05:57:46', '2024-08-30 05:57:47'),
(70, 3, 7, 'shefii', 'km', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'CA', '8484848484', 'shefii.indigital@gmail.com', 'delivery', 7, '2024-08-30 05:05:48', '2024-08-30 05:05:48'),
(69, 3, 7, 'shefii', 'km', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'CA', '8484848484', 'shefii.indigital@gmail.com', 'billing', 7, '2024-08-30 05:05:48', '2024-08-30 05:05:48'),
(68, 2, 6, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'delivery', 1, '2024-08-30 05:01:58', '2024-08-30 05:01:58'),
(67, 2, 6, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'billing', 1, '2024-08-30 05:01:58', '2024-08-30 05:01:58'),
(65, 1, 4, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'billing', 1, '2024-08-29 11:30:36', '2024-08-29 11:30:36'),
(66, 1, 4, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', 'CA', '6392581470', 'john@example.com', 'delivery', 1, '2024-08-29 11:30:36', '2024-08-29 11:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `affiliate_name` varchar(250) DEFAULT NULL,
  `affiliate_slug` varchar(250) DEFAULT NULL,
  `handle` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baking_instructions`
--

CREATE TABLE `baking_instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `baking` text DEFAULT NULL,
  `warming` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `picture` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `baking_instructions`
--

INSERT INTO `baking_instructions` (`id`, `master_id`, `name`, `slug`, `baking`, `warming`, `status`, `picture`, `created_at`, `updated_at`) VALUES
(4, 9, 'Savory Pies', 'savory-pies', '<h2>Step 1</h2>\r\n\r\n<p>Pre heat your oven to 400&deg;F</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 2</h2>\r\n\r\n<p>For a nice golden/brown sheen, brush your frozen pie with an egg wash or a non-dairy milk for vegan option</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 3</h2>\r\n\r\n<p>Bake the pie for 35-45 minutes for small and 50-60 minutes for a large or until the crust is golden brown.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 4</h2>\r\n\r\n<p>Enjoy your Sweetie Pie</p>', '<h2><strong>REHEATING INSTRUCTIONS</strong></h2>\r\n\r\n<p>If you have a baked pie, you can warm it up in a preheated oven at 350 degrees F for about 10 mins.</p>\r\n\r\n<p>ENJOY!</p>', 1, '6azwbZAEXtMTwYGH7gaNnMJg7Hbccz.png', '2024-08-29 04:05:33', '2024-08-29 04:05:33'),
(3, 8, 'Sweet pies', 'sweet-pies', '<h2>Step 1</h2>\r\n\r\n<p>Pre heat your oven to 400&deg;F</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 2</h2>\r\n\r\n<p>For a nice golden/brown sheen. brush your frozen pie with egg wash or non-dairy milk for vegan option<br />\r\n(Sprinkle your fruite pies with some sugar to get a little crunch)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 2</h2>\r\n\r\n<p>For a nice golden/brown sheen. brush your frozen pie with egg wash or non-dairy milk for vegan option<br />\r\n(Sprinkle your fruit pies with some sugar to get a little crunch)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 3</h2>\r\n\r\n<p>Bake the pie for 35-45 minutes for small and 50-60 minutes for a large or until the crust is golden brown.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Step 4</h2>\r\n\r\n<p>Enjoy your Sweetie Pie</p>', '<h2><strong>REHEATING INSTRUCTIONS</strong></h2>\r\n\r\n<p>If you have a baked pie, you can warm it up in a preheated oven at 350 degrees F for about 10 mins.</p>\r\n\r\n<p>ENJOY!</p>', 1, 'OpPFcXe3JptnJOqlRW18Dw0pOcsPDn.png', '2024-08-29 04:05:20', '2024-08-29 04:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `file_type` varchar(250) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `picture_small` varchar(250) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `window` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` varchar(255) DEFAULT NULL,
  `display_order` varchar(255) NOT NULL DEFAULT '1',
  `weight` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `master_id`, `file_type`, `name`, `type`, `picture`, `picture_small`, `link`, `window`, `status`, `description`, `display_order`, `weight`, `created_at`, `updated_at`) VALUES
(1, '50', 'image', 'Cookies', 'home_slider', 'WxVITk1ptmnW1miKDrZgSxigQUJ78P.png', 'bmIEUnmk7JzskJWBmB0F9PLJp6JKN0.png', NULL, 0, 1, NULL, '1', '0', '2024-08-29 02:53:02', '2024-08-29 10:47:35'),
(2, '51', 'image', 'Cakes in a Jar', 'home_slider', 'IzMZSrIkbtbK6wmGJrPyz0CosFNdY1.png', 'EP9XJOMKVvPHyaUhpMZ8yv5JooYBZK.png', NULL, 0, 1, NULL, '1', '0', '2024-08-29 02:58:03', '2024-08-29 10:46:48'),
(3, '52', 'image', 'Sweet Pies', 'home_slider', 'wM0hOJJlf8rWhTVTKQ15EudAbKMzsv.png', 'POYPyV7TnC6s1hbinBov4BfrY8a4qg.png', NULL, 0, 1, NULL, '1', '0', '2024-08-29 03:04:46', '2024-08-29 10:47:20'),
(4, '53', 'image', 'Sweet Pies', 'home_tiles', '4by3zxgDnM8ZzZtNMIljvLxV8Q6JWz.png', 'dummy.png', '/menu/sweet-pies', 0, 1, NULL, '1', '0', '2024-08-29 03:22:41', '2024-08-29 03:23:22'),
(5, '54', 'image', 'Savory Pies', 'home_tiles', 'MBUDJ3xTLLALxD6B2NVuV1yfZIpoKY.png', 'dummy.png', '/menu/savory-pies', 0, 1, NULL, '1', '0', '2024-08-29 03:23:11', '2024-08-29 03:23:11'),
(6, '55', 'image', 'Cookies', 'home_tiles', 'nawF4X9TVYMpIjmIDWsXdvT62rz3N5.png', 'dummy.png', '/menu/cookies', 0, 1, NULL, '1', '0', '2024-08-29 03:24:18', '2024-08-29 03:24:18'),
(7, '56', 'image', 'Butter Tarts', 'home_tiles', '0uFHBmIcfadyoX01uBCvhZ9FdbTVkk.png', 'dummy.png', '/menu/butter-tarts', 0, 1, NULL, '1', '0', '2024-08-29 03:24:53', '2024-08-29 03:24:53'),
(8, '57', 'image', 'Butter Tarts', 'home_top_tile', 'zvD7u03UNKhppm2XecgShPWzPnW7pl.png', 'iv7Q2rXAc2fGEZt8Dd232yOAZtCeyl.png', NULL, 0, 1, NULL, '1', '0', '2024-08-30 09:41:06', '2024-08-30 09:41:06'),
(9, '58', 'image', 'Cookies', 'home_top_tile', '6qMHWQSx8zGSHIKltPl2SKL40ACzQr.png', 'jL6BUeyHUtymcr2ifgLhWM203v2iIr.png', NULL, 0, 1, NULL, '1', '0', '2024-08-30 09:41:50', '2024-08-30 09:41:50'),
(10, '59', 'image', 'Savory Pies', 'home_top_tile', 'hb3MaSSfhd1IinDHfUwJm4OolmogjA.png', '6bNQs7Y2MdS1H8MImSdaPD3Ikfn7cg.png', NULL, 0, 1, NULL, '1', '0', '2024-08-30 09:42:16', '2024-08-30 09:46:47'),
(11, '60', 'image', 'Sweet Pies', 'home_top_tile', 'aVaA3KCxM3CMDrb6IQcEBIJvQOCRDv.png', 'mDXBSn74arhfTmj3Ylb8w9Wok9S5sT.png', NULL, 0, 1, NULL, '1', '0', '2024-08-30 09:42:36', '2024-08-30 09:42:36'),
(12, '61', 'image', 'Cupcakes', 'home_top_tile', 'h162sI7252Lb0fNyxAJlZGdp3WjyqB.png', '1P3RBUVFkBVBfd0QemS0Zz3jDuH9uw.png', NULL, 0, 1, NULL, '1', '0', '2024-08-30 09:43:10', '2024-08-30 09:43:10'),
(13, '62', 'image', 'Cake in a Jar', 'home_top_tile', 'l0BZ9IJmnxJV25kS4lVGRJhJgQJadN.png', 'O0vYdv0yrNPIkf9UqmtMUIHHEVSNgv.png', NULL, 0, 1, NULL, '1', '0', '2024-09-02 10:12:49', '2024-09-02 10:29:10'),
(14, '63', 'image', 'Baked Goods', 'home_top_tile', 'FRfBrlHvrICcpm9KjMcag9fpRt6V8o.png', 'hD0CGvWwxG8ButyK4eUhH5zE8eUe0M.png', NULL, 0, 1, NULL, '1', '0', '2024-09-03 07:26:33', '2024-09-03 07:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE `baskets` (
  `id` int(10) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `order_type` enum('pickup','delivery') NOT NULL DEFAULT 'pickup',
  `status` int(11) NOT NULL DEFAULT 0,
  `shipping_location` text DEFAULT NULL,
  `pickup_id` int(11) DEFAULT 0,
  `serve_date` date DEFAULT NULL COMMENT 'delivery date',
  `serve_time` time DEFAULT NULL COMMENT 'delivery time',
  `postal` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `sel_place` varchar(200) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `open` varchar(250) DEFAULT NULL,
  `page` varchar(250) DEFAULT NULL,
  `make_gift` int(11) DEFAULT NULL,
  `card_msg` mediumtext DEFAULT NULL,
  `special_campaign` tinyint(1) NOT NULL DEFAULT 0,
  `special_campaign_id` int(11) DEFAULT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `marketing_campaign_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `baskets`
--

INSERT INTO `baskets` (`id`, `session`, `user_id`, `email`, `order_type`, `status`, `shipping_location`, `pickup_id`, `serve_date`, `serve_time`, `postal`, `city`, `country`, `sel_place`, `remarks`, `coupon_id`, `open`, `page`, `make_gift`, `card_msg`, `special_campaign`, `special_campaign_id`, `affiliate_id`, `marketing_campaign_id`, `created_at`, `updated_at`) VALUES
(1, 'Efps23bOLHSfN5dsQvBIhkGQDUUZ44tb9v6GfIUWQP9HR', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-08-29 10:40:28', '2024-08-29 10:40:28'),
(2, '1EiOj4bYjT2ZOqzY0Ao89YR84lWf21NRAEfhoEAG1mNP1', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-08-29 10:40:32', '2024-08-29 10:40:32'),
(3, 'KCjon6JkfSMFD46DQI3jIH1YilmCDVYOR5YTf9uhwZw66', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-08-29 11:15:14', '2024-08-29 11:15:14'),
(4, 'YSGOMiF0a0t1uI8lRiGzPx012gzZ7n9U81kGIKNyQYBdk', 1, 'john@example.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes pls', NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-08-29 11:27:40', '2024-08-29 11:30:36'),
(5, 'ycsbkbtQJF3HFJStqvy2Y8PtGMFCR6oqri7PmOJXXtWY2', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 04:26:34', '2024-08-30 04:26:34'),
(6, 'g1TOmuBrfMwNxJNLyxMH4nBCglowagGeCAR6jxANI9LMQ', 1, 'john@example.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 05:00:32', '2024-08-30 05:01:58'),
(7, '49vlU0Rw9V0JV7a4BEXbwAmH408hizTV2yHAHXOCWZAxh', 7, 'shefii.indigital@gmail.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jsf jhsdf', NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 05:05:23', '2024-08-30 05:05:48'),
(8, '4dFmuFVae1DySr2TZ89qP3z9V54PZ9bumKlR9cOfMTps6', 8, 'bijuys@gmail.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 05:55:04', '2024-08-30 05:57:47'),
(9, 'DafTiAWsqCN9IiuJZLYq8sdX0YVJQte8GaZU9mki0xYXL', 7, 'shefii.indigital@gmail.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 06:44:12', '2024-08-30 06:44:40'),
(10, 'BCfCHmDMiqBRVee1umR3zzkYAZy7Bk3Zk5yaUq2utXpTp', 1, 'john@example.com', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-08-30 07:28:39', '2024-08-30 09:47:51'),
(11, '7K4VCgUXZuoTNjccjXo0vtNV9xW0Qs4IBzVGJV5I7kCHl', 1, 'john@example.com', 'delivery', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'thankyou', NULL, NULL, 0, NULL, NULL, NULL, '2024-09-02 04:08:29', '2024-09-02 04:22:46'),
(12, 'EJxQbhkFWS2QwcKEUmI6I0HND0JhKH6YiWcaP93U2TRnh', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-03 09:17:09', '2024-09-03 09:17:09'),
(13, 'fPl2kyuExx6YcVbqRaMCfAM6o1n67nlpNdU3NrYCKpdTH', NULL, '', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-13 09:46:15', '2024-09-13 09:46:15'),
(14, '1wEQ77pqj9FgcdzG7W7MSZof2TXCs6KHSDvvFgfj96DLn', 1, 'john@example.com', 'delivery', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-13 09:46:21', '2024-09-13 09:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `published_at` date DEFAULT NULL,
  `type` enum('blog','recipe') NOT NULL DEFAULT 'blog',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `blog_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category_lists`
--

CREATE TABLE `blog_category_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `type` enum('blog','recipe') NOT NULL DEFAULT 'blog',
  `parent_id` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_jobs`
--

CREATE TABLE `career_jobs` (
  `id` int(11) NOT NULL,
  `job_possition` varchar(250) NOT NULL,
  `store_id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_requests`
--

CREATE TABLE `career_requests` (
  `id` int(11) NOT NULL,
  `store_name` varchar(250) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `phone` varchar(250) NOT NULL,
  `resume` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `availability` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keyword` varchar(255) DEFAULT NULL,
  `seo_alt` varchar(255) DEFAULT NULL,
  `eligible_discount` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `master_id`, `name`, `slug`, `description`, `parent_id`, `picture`, `seo_title`, `seo_description`, `seo_keyword`, `seo_alt`, `eligible_discount`, `status`, `created_at`, `updated_at`) VALUES
(1, '567', 'Sweet Pies', 'sweet-pies', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:55:30', '2024-08-29 09:55:30'),
(2, '556', 'Quiche', 'quiche', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:55:43', '2024-08-29 09:55:43'),
(3, '557', 'Savory Pies', 'savory-pies', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:56:02', '2024-08-29 09:56:02'),
(4, '558', 'Baked Goods', 'baked-goods', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:56:15', '2024-08-29 09:56:15'),
(6, '561', 'Gift Cards', 'gift-cards', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:57:01', '2024-08-29 09:57:01'),
(13, '570', 'Cupcakes', 'cupcakes', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:58:24', '2024-08-29 09:58:24'),
(15, '559', 'Butter Tarts', 'butter-tarts', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 09:58:44', '2024-08-29 09:58:44'),
(16, '566', 'Cookies', 'cookies', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 10:50:59', '2024-08-29 10:50:59'),
(17, '563', 'Cake in a Jar', 'cake-in-a-jar', NULL, NULL, 'dummy.png', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-29 10:52:01', '2024-08-29 10:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `category_id`, `product_id`, `display_order`, `created_at`, `updated_at`) VALUES
(4, '2', '2', 0, '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(6, '2', '4', 0, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(7, '2', '5', 0, '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(8, '2', '6', 0, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(9, '3', '7', 0, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(10, '3', '8', 0, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(11, '3', '9', 0, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(12, '3', '10', 0, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(13, '3', '11', 0, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(14, '3', '12', 0, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(15, '3', '13', 0, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(16, '3', '14', 0, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(17, '3', '15', 0, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(18, '3', '16', 0, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(19, '3', '17', 0, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(20, '3', '18', 0, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(21, '3', '19', 0, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(22, '3', '20', 0, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(24, '4', '22', 0, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(25, '4', '23', 0, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(26, '4', '24', 0, '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(27, '15', '25', 0, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(28, '15', '26', 0, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(29, '15', '27', 0, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(30, '5', '28', 0, '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(31, '5', '29', 0, '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(32, '5', '30', 0, '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(33, '5', '31', 0, '2024-08-29 10:07:13', '2024-08-29 10:07:13'),
(34, '4', '32', 0, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(35, '5', '33', 0, '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(36, '5', '34', 0, '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(37, '6', '35', 0, '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(38, '7', '36', 0, '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(39, '6', '37', 0, '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(40, '6', '38', 0, '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(41, '6', '39', 0, '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(42, '8', '40', 0, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(43, '8', '41', 0, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(44, '8', '42', 0, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(45, '8', '43', 0, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(46, '8', '44', 0, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(47, '5', '45', 0, '2024-08-29 10:08:32', '2024-08-29 10:08:32'),
(48, '5', '46', 0, '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(49, '2', '47', 0, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(50, '2', '48', 0, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(51, '5', '49', 0, '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(52, '5', '50', 0, '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(53, '5', '51', 0, '2024-08-29 10:09:07', '2024-08-29 10:09:07'),
(54, '5', '52', 0, '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(55, '5', '53', 0, '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(56, '5', '54', 0, '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(57, '9', '55', 0, '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(58, '9', '56', 0, '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(59, '9', '57', 0, '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(60, '9', '58', 0, '2024-08-29 10:11:57', '2024-08-29 10:11:57'),
(61, '9', '59', 0, '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(62, '9', '60', 0, '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(63, '9', '61', 0, '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(64, '9', '62', 0, '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(65, '9', '63', 0, '2024-08-29 10:12:11', '2024-08-29 10:12:11'),
(66, '9', '64', 0, '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(67, '9', '65', 0, '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(68, '9', '66', 0, '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(69, '9', '67', 0, '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(70, '9', '68', 0, '2024-08-29 10:12:25', '2024-08-29 10:12:25'),
(71, '9', '69', 0, '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(72, '9', '70', 0, '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(73, '9', '71', 0, '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(74, '9', '72', 0, '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(75, '9', '73', 0, '2024-08-29 10:12:46', '2024-08-29 10:12:46'),
(76, '9', '74', 0, '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(77, '9', '75', 0, '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(78, '9', '76', 0, '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(79, '9', '77', 0, '2024-08-29 10:12:57', '2024-08-29 10:12:57'),
(80, '9', '78', 0, '2024-08-29 10:13:00', '2024-08-29 10:13:00'),
(81, '9', '79', 0, '2024-08-29 10:13:03', '2024-08-29 10:13:03'),
(82, '9', '80', 0, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(83, '9', '81', 0, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(85, '10', '82', 0, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(86, '10', '83', 0, '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(87, '10', '84', 0, '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(88, '10', '85', 0, '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(89, '10', '86', 0, '2024-08-29 10:13:17', '2024-08-29 10:13:17'),
(90, '10', '87', 0, '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(91, '10', '88', 0, '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(92, '10', '89', 0, '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(93, '10', '90', 0, '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(104, '1', '100', 0, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(106, '10', '102', 0, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(107, '1', '103', 0, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(108, '1', '104', 0, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(109, '1', '105', 0, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(110, '1', '106', 0, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(111, '1', '107', 0, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(112, '1', '108', 0, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(113, '1', '109', 0, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(115, '1', '111', 0, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(116, '1', '112', 0, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(117, '1', '113', 0, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(118, '1', '114', 0, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(119, '1', '115', 0, '2024-08-29 10:14:59', '2024-08-29 10:14:59'),
(120, '1', '116', 0, '2024-08-29 10:15:04', '2024-08-29 10:15:04'),
(121, '1', '118', 0, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(122, '1', '120', 0, '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(123, '1', '121', 0, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(124, '1', '122', 0, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(125, '1', '123', 0, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(127, '12', '124', 0, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(128, '12', '125', 0, '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(129, '12', '126', 0, '2024-08-29 10:15:21', '2024-08-29 10:15:21'),
(130, '12', '127', 0, '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(131, '12', '129', 0, '2024-08-29 10:15:50', '2024-08-29 10:15:50'),
(132, '12', '130', 0, '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(133, '12', '131', 0, '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(134, '12', '132', 0, '2024-08-29 10:15:58', '2024-08-29 10:15:58'),
(135, '12', '133', 0, '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(137, '12', '134', 0, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(138, '12', '135', 0, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(140, '12', '137', 0, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(141, '12', '141', 0, '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(142, '12', '142', 0, '2024-08-29 10:16:12', '2024-08-29 10:16:12'),
(143, '12', '143', 0, '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(144, '12', '144', 0, '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(146, '12', '146', 0, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(147, '12', '147', 0, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(148, '12', '148', 0, '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(149, '12', '149', 0, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(150, '12', '150', 0, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(151, '12', '151', 0, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(152, '12', '152', 0, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(153, '12', '145', 0, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(154, '1', '110', 0, '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(155, '10', '91', 0, '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(156, '12', '153', 0, '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(157, '12', '154', 0, '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(158, '12', '155', 0, '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(159, '12', '156', 0, '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(160, '12', '157', 0, '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(161, '12', '158', 0, '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(162, '12', '159', 0, '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(163, '12', '160', 0, '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(164, '12', '161', 0, '2024-08-29 10:17:59', '2024-08-29 10:17:59'),
(167, '12', '163', 0, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(168, '12', '164', 0, '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(169, '14', '167', 0, '2024-08-29 10:18:16', '2024-08-29 10:18:16'),
(170, '13', '168', 0, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(171, '12', '169', 0, '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(172, '12', '170', 0, '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(173, '12', '171', 0, '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(174, '12', '172', 0, '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(176, '12', '162', 0, '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(178, '4', '21', 0, '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(181, '2', '1', 0, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(183, '2', '3', 0, '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(191, '17', '40', 0, '2024-08-29 10:52:01', '2024-08-29 10:52:01'),
(192, '17', '41', 0, '2024-08-29 10:52:01', '2024-08-29 10:52:01'),
(193, '17', '42', 0, '2024-08-29 10:52:01', '2024-08-29 10:52:01'),
(194, '17', '43', 0, '2024-08-29 10:52:01', '2024-08-29 10:52:01'),
(195, '17', '44', 0, '2024-08-29 10:52:01', '2024-08-29 10:52:01'),
(197, '15', '174', 0, '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(208, '16', '92', 0, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(209, '16', '93', 0, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(210, '16', '94', 0, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(211, '16', '95', 0, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(212, '16', '96', 0, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(213, '16', '97', 0, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(214, '16', '98', 0, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(218, '16', '176', 0, '2024-09-13 10:38:45', '2024-09-13 10:38:45'),
(219, '16', '177', 0, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(220, '16', '178', 0, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(221, '16', '179', 0, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(222, '16', '180', 0, '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `base` varchar(255) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `city_group_id` varchar(255) DEFAULT NULL,
  `page_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `master_id`, `name`, `code`, `province`, `base`, `status`, `city_group_id`, `page_id`, `created_at`, `updated_at`) VALUES
(1, '95', 'Toronto', '0', 'ON', '0', 1, NULL, NULL, '2024-07-15 13:10:01', '2024-07-15 13:10:01'),
(10, '14', 'Ajax', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:51:15', '2023-09-21 11:10:07'),
(11, '15', 'Ancaster', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:51:25', '2023-09-21 11:10:01'),
(12, '16', 'Ashburn', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:51:33', '2023-09-21 11:09:54'),
(13, '17', 'Aurora', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:51:41', '2023-09-21 11:09:48'),
(14, '18', 'Ballantrae', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:51:51', '2023-09-21 11:09:42'),
(15, '19', 'Bolton', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:05', '2023-09-21 11:09:35'),
(16, '20', 'Bradford', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:15', '2023-09-21 11:09:28'),
(17, '21', 'Brampton', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:26', '2023-10-05 10:23:41'),
(18, '22', 'Brooklin', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:37', '2023-09-21 11:09:11'),
(19, '23', 'Brougham', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:45', '2023-09-21 11:09:13'),
(20, '24', 'Burlington', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:52:54', '2023-09-21 11:09:17'),
(21, '25', 'Caledon', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:02', '2023-09-21 11:09:20'),
(22, '26', 'Cedar Mills', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:11', '2023-09-21 11:10:20'),
(23, '27', 'Claremont', '0', 'NS', '0', 0, NULL, NULL, '2023-07-17 16:53:18', '2023-09-21 11:11:01'),
(24, '28', 'Columbus', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:26', '2023-09-21 11:10:26'),
(25, '29', 'Courtice', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:34', '2023-09-21 11:10:31'),
(26, '30', 'Concord', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:42', '2023-09-21 11:10:36'),
(27, '31', 'Dundas', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:53:52', '2023-09-21 11:10:41'),
(28, '32', 'Etobicoke', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 16:53:59', '2023-09-21 11:17:02'),
(29, '33', 'Georgetown', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:54:05', '2023-09-21 11:10:55'),
(30, '34', 'Gormley', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:54:40', '2023-09-21 11:11:06'),
(31, '35', 'Green River', '0', 'BC', '0', 0, NULL, NULL, '2023-07-17 16:54:53', '2023-09-21 11:11:11'),
(32, '36', 'Greenwood', '0', 'BC', '0', 0, NULL, NULL, '2023-07-17 16:55:03', '2023-09-21 11:11:17'),
(33, '37', 'Grimsby', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:55:16', '2023-09-21 11:11:22'),
(34, '38', 'Hamilton', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:55:23', '2023-09-21 11:11:28'),
(35, '39', 'Hampton', '0', 'NB', '0', 0, NULL, NULL, '2023-07-17 16:55:37', '2023-09-21 11:11:33'),
(36, '40', 'Holland Landing', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:55:57', '2023-09-21 11:11:38'),
(37, '41', 'Keswick', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:05', '2023-09-21 11:11:43'),
(38, '42', 'Kettleby', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:11', '2023-09-21 11:11:48'),
(39, '43', 'King City', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:18', '2023-09-21 11:11:53'),
(40, '44', 'Kleinburg', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:25', '2023-09-21 11:12:01'),
(41, '45', 'Maple', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:34', '2023-09-21 11:12:07'),
(42, '46', 'Markham', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:42', '2023-09-21 11:12:12'),
(43, '47', 'Milton', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:56:49', '2023-09-21 11:12:17'),
(44, '48', 'Mississauga', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 16:56:55', '2023-09-21 11:17:06'),
(45, '49', 'Mitchell\'s Corners', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:02', '2023-09-21 11:12:28'),
(46, '50', 'Mount Hope', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:09', '2023-09-21 11:12:33'),
(47, '51', 'Mount Albert', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:18', '2023-09-21 11:12:40'),
(48, '52', 'Musselman\'s Lake', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:25', '2023-09-21 11:12:48'),
(49, '53', 'Newmarket', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:33', '2023-09-21 11:12:53'),
(50, '54', 'Nobleton', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:57:41', '2023-09-21 11:13:00'),
(51, '55', 'North York', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 16:57:52', '2023-09-21 11:17:05'),
(52, '56', 'Oakville', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:00', '2023-09-21 11:13:12'),
(53, '57', 'Oshawa', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:07', '2023-09-21 11:13:17'),
(54, '58', 'Palgrave', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:19', '2023-09-21 11:13:22'),
(55, '59', 'Pickering', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:30', '2023-09-21 11:13:29'),
(56, '60', 'Queensville', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:41', '2023-09-21 11:13:34'),
(57, '61', 'Raglan', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:48', '2023-09-21 11:13:39'),
(58, '62', 'Richmond Hill', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:58:57', '2023-09-21 11:13:44'),
(59, '63', 'Schomberg', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:59:06', '2023-09-21 11:13:49'),
(60, '64', 'Sharon', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 16:59:15', '2023-09-21 11:13:54'),
(61, '65', 'Stewart Town', '0', 'BC', '0', 0, NULL, NULL, '2023-07-17 16:59:26', '2023-09-21 11:14:00'),
(62, '66', 'Scarborough', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 16:59:43', '2023-09-21 11:16:57'),
(63, '67', 'Stoney Creek', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:06', '2023-09-21 11:14:12'),
(64, '68', 'Stouffville', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:15', '2023-09-21 11:14:17'),
(65, '69', 'Thornhill', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:24', '2023-09-21 11:14:23'),
(66, '70', 'Toronto', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 17:00:33', '2023-09-21 11:16:59'),
(67, '71', 'Tottenham', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:40', '2023-09-21 11:14:34'),
(68, '72', 'Unionville', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:48', '2023-09-21 11:14:39'),
(69, '73', 'Uxbridge', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:00:57', '2023-09-21 11:14:45'),
(70, '74', 'Vaughan', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 17:01:04', '2023-09-21 11:17:09'),
(71, '75', 'Waterdown', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:01:12', '2023-09-21 11:14:56'),
(72, '76', 'Whitby', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:01:25', '2023-09-21 11:15:01'),
(73, '77', 'Whitevale', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:01:32', '2023-09-21 11:15:06'),
(74, '78', 'Winona', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:01:39', '2023-09-21 11:15:11'),
(75, '79', 'Woodbridge', '0', 'ON', '0', 1, NULL, NULL, '2023-07-17 17:01:46', '2023-09-21 11:17:11'),
(76, '80', 'Oak Ridges', '0', 'ON', '0', 0, NULL, NULL, '2023-07-17 17:01:54', '2023-09-21 11:15:21'),
(79, '83', 'East York', '0', 'ON', '0', 1, NULL, NULL, '2023-09-21 11:16:30', '2023-09-21 11:16:30'),
(80, '84', 'Old Toronto', '0', 'ON', '0', 1, NULL, NULL, '2023-10-05 10:19:20', '2023-10-05 10:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `email`, `phone`, `subject`, `message`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'admin@basketsinc.ca', '0633852741', 'Hi from future', 'Hey im you from future', '2024-08-29 04:13:04', '2024-08-29 08:13:04', '2024-08-29 04:13:04'),
(2, 'John', 'Doe', 'admin@basketsinc.ca', '0633852741', 'Hi', 'Hello from future', '2024-08-29 04:16:03', '2024-08-29 08:16:03', '2024-08-29 04:16:03'),
(3, 'Biju', 'Yohannan', 'bijuys@gmail.com', '2834823423', 'Just for a test', 'testing', '2024-08-29 11:07:03', '2024-08-29 15:07:03', '2024-08-29 11:07:03'),
(4, 'test', 'test', 'shefii.indigital@gmail.com', '7896541230', 'Test mail', 'testing purpose', '2024-08-30 03:18:03', '2024-08-30 07:18:03', '2024-08-30 03:18:03'),
(5, 'test', 'test', 'shefii.indigital@gmail.com', '7895456655', 'test', 'tetst', '2024-08-30 03:25:05', '2024-08-30 07:25:05', '2024-08-30 03:25:05'),
(6, 'test', 'tetst', 'shefii.indigital@gmail.com', '3473627485', 'test', 'tets', '2024-08-30 03:26:02', '2024-08-30 07:26:02', '2024-08-30 03:26:02'),
(7, 'shefii', 'km', 'shefii.indigital@gmail.com', '1545445454', 'Test New one', 'fgk dfghjhdfg jdfhgjdfgjhdgf dfjkghdhfg', '2024-08-30 04:50:04', '2024-08-30 08:50:04', '2024-08-30 04:50:04'),
(8, 'shefii', 'lm', 'shefii.indgital@gmail.com', '6514584454', 'Tetd', 'kjfg kjdfg kjfg kjndfg kljndfg', '2024-08-30 04:56:03', '2024-08-30 08:56:03', '2024-08-30 04:56:03'),
(9, 'Biju', 'Yohannan', 'bijuys@gmail.com', '8288282838', 'Testing', 'Hello', '2024-08-30 05:41:03', '2024-08-30 09:41:03', '2024-08-30 05:41:03'),
(10, 'shefii', 'km', 'shefii.indigital@gmail.com', '3546545646', 'test', 'test', '2024-08-30 06:41:03', '2024-08-30 10:41:03', '2024-08-30 06:41:03'),
(11, 'shefii', 'km', 'shefii@gmail.com', '5644645656', 'dfdsf', 'sdfsdf', '2024-08-30 07:33:03', '2024-08-30 11:33:03', '2024-08-30 07:33:03'),
(12, 'test', 'sss', 'sdf@gmail.com', '5425513516', 'sdf', 'sdf', '2024-08-30 07:39:07', '2024-08-30 11:39:07', '2024-08-30 07:39:07'),
(13, 'Cesario', 'Ginjo', 'CESARIO@INDIGITALGROUP.CA', '4169900944', 'test', 'this is a test', '2024-08-30 08:49:03', '2024-08-30 12:49:03', '2024-08-30 08:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `content_id` varchar(255) DEFAULT NULL,
  `base` varchar(255) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `page_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `master_id`, `name`, `code`, `content_id`, `base`, `status`, `page_id`, `created_at`, `updated_at`) VALUES
(1, '53', 'Canada', 'CA', NULL, '0', 1, NULL, '2023-06-15 11:16:43', '2023-06-15 11:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `country_shippings`
--

CREATE TABLE `country_shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `shipping_id` varchar(255) DEFAULT NULL,
  `charge` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_shippings`
--

INSERT INTO `country_shippings` (`id`, `province`, `country`, `shipping_id`, `charge`, `created_at`, `updated_at`) VALUES
(1, NULL, '55', '1', '0.00', '2024-07-04 09:47:19', '2024-07-04 09:47:19'),
(2, NULL, '55', '2', '0.00', '2024-07-04 09:47:31', '2024-07-04 09:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) NOT NULL,
  `master_id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `value` decimal(5,2) NOT NULL DEFAULT 0.00,
  `value_type` enum('amount','percentage') NOT NULL DEFAULT 'amount',
  `max_count` int(10) NOT NULL DEFAULT 100,
  `cur_count` int(10) NOT NULL DEFAULT 0,
  `min_sales` decimal(8,2) NOT NULL DEFAULT 0.00,
  `store_id` int(10) DEFAULT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime DEFAULT NULL,
  `availability` enum('in-store','online','all') NOT NULL DEFAULT 'in-store',
  `store_availability` enum('all','certain') NOT NULL DEFAULT 'certain',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_stores`
--

CREATE TABLE `coupon_stores` (
  `id` int(11) NOT NULL,
  `coupon_id` varchar(200) DEFAULT NULL,
  `store_id` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_prices`
--

CREATE TABLE `customer_prices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double(32,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_configrations`
--

CREATE TABLE `email_configrations` (
  `id` int(11) NOT NULL,
  `api_url` varchar(250) DEFAULT NULL,
  `api_key` mediumtext DEFAULT NULL,
  `api_method` varchar(250) DEFAULT NULL,
  `from_name` varchar(250) DEFAULT NULL,
  `from_newsletter_email` varchar(250) DEFAULT NULL,
  `from_order_email` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `question` longtext DEFAULT NULL,
  `answer` longtext DEFAULT NULL,
  `display_order` varchar(255) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `picture` varchar(200) NOT NULL,
  `share_link` text DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `the_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `block_delivery` varchar(255) DEFAULT NULL,
  `cut_off` varchar(255) DEFAULT '00:00 AM',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_timings`
--

CREATE TABLE `holiday_timings` (
  `id` int(11) NOT NULL,
  `holiday_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `online_pickup_open` time DEFAULT NULL,
  `online_pickup_close` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_products`
--

CREATE TABLE `homepage_products` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL DEFAULT 0,
  `title` text DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `homepage_products`
--

INSERT INTO `homepage_products` (`id`, `master_id`, `title`, `short_desc`, `created_at`, `updated_at`) VALUES
(1, 58, 'Our Products', 'Made With Love', '2024-08-29', '2024-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_product_lists`
--

CREATE TABLE `homepage_product_lists` (
  `id` int(11) NOT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `homepage_product_lists`
--

INSERT INTO `homepage_product_lists` (`id`, `homepage_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2245, '2024-08-29', '2024-08-29'),
(2, 1, 2257, '2024-08-29', '2024-08-29'),
(3, 1, 2248, '2024-08-29', '2024-08-29'),
(4, 1, 2250, '2024-08-29', '2024-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_variation_id` int(11) NOT NULL DEFAULT 0,
  `shipping_id` int(11) NOT NULL DEFAULT 0,
  `product_sku` varchar(250) DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `variation` varchar(250) DEFAULT NULL,
  `weight` varchar(64) DEFAULT NULL,
  `box_quantity` int(11) DEFAULT NULL,
  `item_price` double(8,2) DEFAULT NULL,
  `quantity` int(10) DEFAULT 1,
  `price_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `picture` varchar(100) DEFAULT NULL,
  `tax_percentage` varchar(11) NOT NULL DEFAULT '0',
  `parent` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `pre_order` int(11) NOT NULL DEFAULT 0,
  `customized_product` tinyint(1) DEFAULT 0,
  `customized_flavor` varchar(250) DEFAULT NULL,
  `customized_color` varchar(250) DEFAULT NULL,
  `customized_message` varchar(250) DEFAULT NULL,
  `customized_border_color` varchar(250) DEFAULT NULL,
  `customized_text_color` varchar(250) DEFAULT NULL,
  `serve_date` date DEFAULT NULL,
  `serve_time` time DEFAULT NULL,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `actual_price` double(32,2) DEFAULT NULL,
  `has_special_price` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `case_name` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `basket_id`, `product_id`, `product_variation_id`, `shipping_id`, `product_sku`, `product_name`, `variation`, `weight`, `box_quantity`, `item_price`, `quantity`, `price_amount`, `picture`, `tax_percentage`, `parent`, `note`, `pre_order`, `customized_product`, `customized_flavor`, `customized_color`, `customized_message`, `customized_border_color`, `customized_text_color`, `serve_date`, `serve_time`, `special_price_from`, `special_price_to`, `actual_price`, `has_special_price`, `created_at`, `updated_at`, `case_id`, `case_name`) VALUES
(1, 1, 105, 109, 0, 'CHRSP9F', '9 Inch Cherry Pie Frozen', '9 Inch Cherry Pie Frozen', '1100gm', 6, 16.99, 1, 101.94, 'copy_8Mw7p6COaeStyAVwnDXLN4PB22wEMN.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:40:28', '2024-08-29 10:40:28', 168, 'Case'),
(2, 2, 4, 6, 0, 'SPKQC9', '9 Inch Spanakopita Frozen / Baked', '9 Inch Spanakopita Frozen / Baked', '750gm', 6, 14.99, 1, 89.94, 'copy_NCYmmYGQI3JOtFK4UkUciqE4jzAOss.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:40:32', '2024-08-29 10:40:32', 126, 'Case'),
(5, 3, 100, 104, 0, 'APLSP9F', '9 Inch Apple Pie Frozen', '9 Inch Apple Pie Frozen', '1100gm', 6, 16.99, 1, 101.94, 'copy_MD94LxIkE6DZvrHYouyNneHwGtU7Rq.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 11:15:14', '2024-08-29 11:15:14', 165, 'Case'),
(4, 2, 120, 125, 0, 'LMNSP9', '9 Inch Lemon Pie Frozen / Baked', '9 Inch Lemon Pie Frozen / Baked', '850gm', 6, 12.99, 1, 77.94, 'copy_EhNA3Oh78hnMmVD0QrG9uk5h3J26Pl.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:40:45', '2024-08-29 10:40:45', 177, 'Case'),
(6, 4, 22, 24, 0, 'CCBBG', 'Cheesecake Bars Slab Frozen Baked ready to serve', 'Cheesecake Bars Slab Frozen Baked ready to serve', '85gm', 48, 1.50, 1, 72.00, 'copy_YEsGgeuDRLYwPOpadkHKsQdmfqUp2P.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 11:27:40', '2024-08-29 11:27:40', 144, 'Case'),
(7, 4, 21, 189, 0, 'MFNBG', 'Pack 24 Baked Muffins Baked frozen', 'Pack 24 Baked Muffins Baked frozen', '85gm', 24, 1.50, 1, 36.00, 'GETvTQNNZwGXIthleylwdOVWN3XtXR.jpeg', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-29 11:27:43', '2024-08-29 11:27:43', 185, 'Case'),
(8, 5, 120, 125, 0, 'LMNSP9', '9 Inch Lemon Pie Frozen / Baked', '9 Inch Lemon Pie Frozen / Baked', '850gm', 6, 12.99, 1, 77.94, 'copy_EhNA3Oh78hnMmVD0QrG9uk5h3J26Pl.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 04:26:34', '2024-08-30 04:26:34', 177, 'Case'),
(9, 6, 100, 104, 0, 'APLSP9F', '9 Inch Apple Pie Frozen', '9 Inch Apple Pie Frozen', '1100gm', 6, 16.99, 1, 101.94, 'copy_MD94LxIkE6DZvrHYouyNneHwGtU7Rq.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 05:00:32', '2024-08-30 05:00:32', 165, 'Case'),
(10, 7, 120, 125, 0, 'LMNSP9', '9 Inch Lemon Pie Frozen / Baked', '9 Inch Lemon Pie Frozen / Baked', '850gm', 6, 12.99, 1, 77.94, 'copy_EhNA3Oh78hnMmVD0QrG9uk5h3J26Pl.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 05:05:23', '2024-08-30 05:05:23', 177, 'Case'),
(11, 8, 6, 8, 0, 'GCVQC5', '5 Inch Goat Cheese And Vegetable Frozen / Baked', '5 Inch Goat Cheese And Vegetable Frozen / Baked', '185gm', 18, 5.99, 2, 107.82, 'copy_Ey6vnzzczC7gYWoPBDZD3CBpAXcyUn.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 05:55:04', '2024-08-30 05:55:04', 128, 'Case'),
(12, 9, 47, 49, 0, 'ACPQC5', '5 Inch Aged Cheddar and Pancetta Frozen / Baked', '5 Inch Aged Cheddar and Pancetta Frozen / Baked', '185gm', 18, 5.99, 1, 107.82, 'copy_9WUjUqOhKnG1G7O6eemW7CTBnWkGnV.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 06:44:12', '2024-08-30 06:44:12', 156, 'Case'),
(18, 11, 4, 6, 0, 'SPKQC9', '9 Inch Spanakopita Frozen / Baked', '9 Inch Spanakopita Frozen / Baked', '750gm', 6, 14.99, 1, 89.94, 'copy_NCYmmYGQI3JOtFK4UkUciqE4jzAOss.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-09-02 04:08:29', '2024-09-02 04:08:29', 126, 'Case'),
(16, 10, 7, 9, 0, 'STASV', '9 Inch  Steak and Ale Pie Frozen', '9 Inch  Steak and Ale Pie Frozen', '850gm', 6, 16.99, 2, 101.94, 'copy_wxstK3SjTXzy0Uh2SykJKnUA5bPNhi.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 09:49:33', '2024-08-30 09:50:06', 129, 'Case'),
(17, 10, 11, 13, 0, 'SBCSV', '9 Inch Spicy Beef Curry Pie Frozen', '9 Inch Spicy Beef Curry Pie Frozen', '850gm', 6, 16.99, 2, 101.94, 'copy_fPIx0HVewIxTJBvpriFaGJXSapVe7c.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-30 09:49:44', '2024-08-30 09:50:05', 133, 'Case'),
(19, 12, 24, 26, 0, 'DSQBG', 'Date Squares Baked Ready to Serve Baked /Frozen', 'Date Squares Baked Ready to Serve Baked /Frozen', '85gm', 48, 1.50, 1, 72.00, 'copy_02b1Rc8qaPG10HJRO5BRF9Q65XCgLn.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-09-03 09:17:09', '2024-09-03 09:17:09', 146, 'Case'),
(20, 13, 32, 34, 0, 'CRBBG12', 'Caramel Brownies Baked Ready to Serve Baked / Frozen', 'Caramel Brownies Baked Ready to Serve Baked / Frozen', '125gm', 48, 1.50, 1, 72.00, 'copy_t7CaYmOE2EJOXf4aCZWyEBnmOksSMH.png', '13', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-09-13 09:46:15', '2024-09-13 09:46:15', 150, 'Case');

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` longtext DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `banner1_title` text DEFAULT NULL,
  `banner1_description` longtext DEFAULT NULL,
  `banner1_image` varchar(255) DEFAULT NULL,
  `section1_title` text DEFAULT NULL,
  `section1_description` longtext DEFAULT NULL,
  `section1_button_text` varchar(255) DEFAULT NULL,
  `section1_button_link` varchar(255) DEFAULT NULL,
  `section1_image` varchar(255) DEFAULT NULL,
  `banner2_title` text DEFAULT NULL,
  `banner2_description` longtext DEFAULT NULL,
  `banner2_button_text` varchar(255) DEFAULT NULL,
  `banner2_button_link` varchar(255) DEFAULT NULL,
  `banner2_image` varchar(255) DEFAULT NULL,
  `section2_title` text DEFAULT NULL,
  `section2_description` longtext DEFAULT NULL,
  `section2_button_text` varchar(255) DEFAULT NULL,
  `section2_button_link` varchar(255) DEFAULT NULL,
  `section2_image` varchar(255) DEFAULT NULL,
  `gallery1` varchar(255) DEFAULT NULL,
  `gallery2` varchar(255) DEFAULT NULL,
  `gallery3` varchar(255) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_shippings`
--

CREATE TABLE `location_shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `shipping_id` varchar(255) DEFAULT NULL,
  `charge` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_shipping_cities`
--

CREATE TABLE `location_shipping_cities` (
  `id` int(11) NOT NULL,
  `province` varchar(10) DEFAULT NULL,
  `shipping_id` varchar(10) DEFAULT NULL,
  `charge` decimal(5,2) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menucategory_products`
--

CREATE TABLE `menucategory_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `weight` int(255) DEFAULT 0,
  `landing_page` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `master_id`, `name`, `slug`, `parent_id`, `level`, `link`, `weight`, `landing_page`, `status`, `created_at`, `updated_at`) VALUES
(1, '701', 'Our Menus', 'our-menus', NULL, NULL, '', 1, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(2, NULL, 'Cupcakes', 'cupcakes', '1', NULL, 'menu/cupcakes', 4, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(3, NULL, 'Butter Tarts', 'butter-tarts', '1', NULL, 'menu/butter-tarts', 3, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(4, NULL, 'Cookies', 'cookies', '1', NULL, 'menu/cookies', 2, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(5, NULL, 'Sweet Pies', 'sweet-pies', '1', NULL, 'menu/sweet-pies', 1, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(6, NULL, 'Savory Pies', 'savory-pies', '1', NULL, 'menu/savory-pies', 0, NULL, 1, '2024-08-29 03:57:15', '2024-08-29 03:57:15'),
(18, '706', 'Quick Links', 'quick-links', NULL, NULL, '', 1, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(19, NULL, 'Blogs', 'blogs', '18', NULL, '/blog', 5, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(20, NULL, 'Contact', 'contact', '18', NULL, '/contact', 4, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(21, NULL, 'FAQs', 'faqs', '18', NULL, 'faqs', 3, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(22, NULL, 'Shipping Policy', 'shipping-policy', '18', NULL, 'delivery-policy', 2, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(23, NULL, 'Privacy Policy', 'privacy-policy', '18', NULL, 'privacy-policy', 1, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(24, NULL, 'Terms & Conditions', 'terms-conditions', '18', NULL, 'terms-and-conditions', 0, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(25, NULL, 'Baking instructions', 'baking-instructions', '18', NULL, '/baking-instructions', 6, NULL, 1, '2024-08-29 03:57:52', '2024-08-29 03:57:52'),
(39, '739', 'Main Menu', 'main-menu', NULL, NULL, '', 1, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(40, NULL, 'Wholesale inquiry', 'wholesale-inquiry', '39', NULL, '/wholesale', 3, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(41, NULL, 'Products', 'products', '39', NULL, '#', 2, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(42, NULL, 'Baked Goods', 'baked-goods', '41', NULL, 'menu/baked-goods', 6, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(43, NULL, 'Quiche', 'quiche', '41', NULL, 'menu/quiche', 7, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(44, NULL, 'Cake in a Jar', 'cake-in-a-jar', '41', NULL, 'menu/cake-in-a-jar', 5, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(45, NULL, 'Cupcakes', 'cupcakes', '41', NULL, 'menu/cupcakes', 4, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(46, NULL, 'Cookies', 'cookies', '41', NULL, 'menu/cookies', 2, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(47, NULL, 'Butter Tarts', 'butter-tarts', '41', NULL, 'menu/butter-tarts', 3, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(48, NULL, 'Savory Pies', 'savory-pies', '41', NULL, 'menu/savory-pies', 1, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(49, NULL, 'Sweet Pies', 'sweet-pies', '41', NULL, 'menu/sweet-pies', 0, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(50, NULL, 'About Us', 'about-us', '39', NULL, '/about-us', 1, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(51, NULL, 'Home', 'home', '39', NULL, '/', 0, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45'),
(52, NULL, 'Contact us', 'contact-us', '39', NULL, '/contact', 4, NULL, 1, '2024-08-29 10:38:45', '2024-08-29 10:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `master_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `picture_small` varchar(100) DEFAULT NULL,
  `pos_icon` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `eligible_discounts` tinyint(1) NOT NULL DEFAULT 0,
  `pos_sort` int(11) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myaddresses`
--

CREATE TABLE `myaddresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `postalcode` varchar(50) NOT NULL,
  `city` varchar(150) NOT NULL,
  `province` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `base` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `myaddresses`
--

INSERT INTO `myaddresses` (`id`, `user_id`, `firstname`, `lastname`, `address`, `postalcode`, `city`, `province`, `country`, `base`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'John', 'Doe', 'Queens Park', 'M4B 2J8', 'Toronto', 'Ontario', '', '0', 1, '2024-08-29 11:27:26', '2024-08-29 11:27:26'),
(2, 7, 'shefii', 'km', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'Canada', '0', 1, '2024-08-30 05:05:01', '2024-08-30 05:05:01'),
(3, 8, 'Biju', 'Yohannan', 'testing', 't0a0a0', 'Abee', 'Alberta', 'Canada', '0', 1, '2024-08-30 05:57:04', '2024-08-30 05:57:04'),
(4, 9, 'shefii', 'kkmm', 'fxcgxdfg', '5454545', 'toronto', 'Quebec', 'Canada', '0', 1, '2024-08-30 06:53:42', '2024-08-30 06:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `mycards`
--

CREATE TABLE `mycards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name_on_card` varchar(250) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `card_exp_date` varchar(10) DEFAULT NULL,
  `card_cvv` varchar(5) DEFAULT NULL,
  `base` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutritions`
--

CREATE TABLE `nutritions` (
  `id` int(11) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `master_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_explorers`
--

CREATE TABLE `nutrition_explorers` (
  `id` int(11) NOT NULL,
  `master_product_id` int(11) NOT NULL,
  `master_variation_id` int(11) DEFAULT NULL,
  `nutrition_title` varchar(250) DEFAULT NULL,
  `nutrition_id` int(11) DEFAULT NULL,
  `nutrition_value` varchar(250) DEFAULT NULL,
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `invoice_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `paymeny_id` varchar(250) DEFAULT NULL,
  `basket_id` int(11) NOT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `taxamount` varchar(50) DEFAULT NULL,
  `grandtotal` decimal(8,2) NOT NULL,
  `shipping_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) DEFAULT NULL,
  `ipaddress` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `coupon` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discount_id` int(10) DEFAULT NULL,
  `discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `card_type` varchar(250) DEFAULT NULL,
  `reference_num` varchar(35) DEFAULT NULL,
  `transaction_id` varchar(11) DEFAULT NULL,
  `payment_status` int(10) DEFAULT 0,
  `affiliate_id` int(10) DEFAULT NULL,
  `backorder` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_backorder` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` int(10) NOT NULL,
  `billed_at` datetime DEFAULT current_timestamp(),
  `sent_at` datetime DEFAULT NULL,
  `customer_email_send` tinyint(1) NOT NULL DEFAULT 0,
  `customer_email_send_message_id` varchar(250) DEFAULT NULL,
  `store_email_send` tinyint(1) NOT NULL DEFAULT 0,
  `store_email_send_message_id` varchar(250) DEFAULT NULL,
  `tng_email_status` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `make_gift` int(11) NOT NULL DEFAULT 0,
  `greeting_card_sku` varchar(250) DEFAULT NULL,
  `card_msg` text DEFAULT NULL,
  `additional_email_id` varchar(250) NOT NULL,
  `additional_email_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `paymeny_id`, `basket_id`, `subtotal`, `taxamount`, `grandtotal`, `shipping_charge`, `user_id`, `ipaddress`, `email`, `coupon`, `discount_id`, `discount`, `discount_type`, `payment_method`, `card_type`, `reference_num`, `transaction_id`, `payment_status`, `affiliate_id`, `backorder`, `is_backorder`, `status`, `billed_at`, `sent_at`, `customer_email_send`, `customer_email_send_message_id`, `store_email_send`, `store_email_send_message_id`, `tng_email_status`, `created_at`, `updated_at`, `make_gift`, `greeting_card_sku`, `card_msg`, `additional_email_id`, `additional_email_status`) VALUES
(1, 'SWPBK2408290001', 'SWPBK202408291530366', 4, '108', '14.04', 122.04, 0.00, 1, '1.39.37.62', 'john@example.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', 'null', 'null', 1, NULL, 'No', 'No', 1, '2024-08-29 11:30:36', '2024-08-29 11:30:36', 0, '7408577753898832241', 1, '7408543969686179835', 0, '2024-08-29 11:30:36', '2024-08-29 11:32:27', 0, NULL, NULL, '', 0),
(2, 'SWPBK2408300001', 'SWPBK202408300901582', 6, '101.94', '13.2522', 115.19, 0.00, 1, '49.47.192.144', 'john@example.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', 'null', 'null', 1, NULL, 'No', 'No', 1, '2024-08-30 05:01:58', '2024-08-30 05:01:59', 0, '7408847752722927270', 1, '7408740198152117750', 0, '2024-08-30 05:01:58', '2024-08-30 05:03:14', 0, NULL, NULL, '', 0),
(3, 'SWPBK2408300002', 'SWPBK202408300905485', 7, '77.94', '10.1322', 88.07, 0.00, 7, '49.47.192.144', 'shefii.indigital@gmail.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', 'null', 'null', 1, NULL, 'No', 'No', 1, '2024-08-30 05:05:48', '2024-08-30 05:05:49', 1, '7408849629623636911', 1, '7408845403375825598', 1, '2024-08-30 05:05:48', '2024-08-30 05:07:06', 0, NULL, NULL, '', 0),
(4, 'SWPBK2408300003', 'SWPBK202408300957469', 8, '215.64', '28.0332', 243.67, 0.00, 8, '49.47.192.144', 'bijuys@gmail.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', 'null', 'null', 1, NULL, 'No', 'No', 1, '2024-08-30 05:57:47', '2024-08-30 05:57:48', 1, '7408864954066940581', 1, '7408862012014349240', 1, '2024-08-30 05:57:47', '2024-08-30 05:59:07', 0, NULL, NULL, '', 0),
(5, 'SPB2408300004', 'SPB202408301044393', 9, '107.82', '14.0166', 121.84, 0.00, 7, '49.47.192.144', 'shefii.indigital@gmail.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', 'null', 'null', 1, NULL, 'No', 'No', 1, '2024-08-30 06:44:40', '2024-08-30 06:44:41', 0, '7408878405904508448', 1, '7408875773089556364', 0, '2024-08-30 06:44:40', '2024-08-30 06:46:39', 0, NULL, NULL, '', 0),
(6, 'SPB2409020001', 'SPB2024090208224510', 11, '89.94', '11.6922', 101.63, 0.00, 1, '49.47.194.138', 'john@example.com', '', NULL, 0.00, NULL, 'credit_card', 'visa_card', '660109490015212630', '849125-0_88', 1, NULL, 'No', 'No', 1, '2024-09-02 04:22:46', '2024-09-02 04:22:47', 0, '7409914029893842417', 1, '7409957056876123870', 0, '2024-09-02 04:22:46', '2024-09-02 04:24:02', 0, NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_feedback`
--

CREATE TABLE `order_feedback` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(250) DEFAULT NULL,
  `rating` int(11) DEFAULT 1,
  `comments` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `paid_amount` varchar(20) NOT NULL,
  `cheque_no` varchar(155) DEFAULT NULL,
  `holder_name` varchar(155) DEFAULT NULL,
  `firstname` varchar(155) DEFAULT NULL,
  `lastname` varchar(155) DEFAULT NULL,
  `credit_card` varchar(155) DEFAULT NULL,
  `exp_month` varchar(10) DEFAULT NULL,
  `exp_year` varchar(10) DEFAULT NULL,
  `cvv` varchar(5) DEFAULT NULL,
  `reference_num` varchar(155) DEFAULT NULL,
  `transaction_id` varchar(155) DEFAULT NULL,
  `payment_status` varchar(155) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `banner_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `html` longtext DEFAULT NULL,
  `published` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `master_id`, `heading`, `banner_id`, `type`, `slug`, `html`, `published`, `created_at`, `updated_at`) VALUES
(1, '21', 'About us', '0', 'Page', 'about-us', '<p>Hi and Welcome to Sweetie Pie Bake Co.&nbsp;</p>\r\n\r\n<p>What started in the basement of a tiny shop at the corner&nbsp;of Harbord St. and Grace in Toronto has grown into something we never could have imagined.&nbsp;<br />\r\n<br />\r\nWe are proud to say&nbsp;we have grown a wholesale business that expands across Canada. &nbsp;Located in&nbsp;North York, we have a 15,000 square&nbsp;foot facility that houses our main commissary kitchen, our packaging and<br />\r\nproduction space, warehouse and head offices.&nbsp;<br />\r\n<br />\r\nWe supply your favourite cafes, hotels, restaurants, grocery stores with our gourmet, handcrafted pies, cookies and baked goods.&nbsp; &nbsp;<br />\r\n<br />\r\nHere at Sweetie Pie Bake Co, we have a team of dedicated&nbsp;bakers who create daily to bring you the freshest and best tasting quality made from scratch products. We also have a top-notch chef who creates our savoury and fruit fillings and an experienced dough master ensuring our pastry is of the highest quality.&nbsp;</p>\r\n\r\n<p>Our&nbsp;creations are more than just desserts; they&rsquo;re a celebration of life&rsquo;s joyous&nbsp;moments. With an array of handcrafted pies that range from classic to innovative, we invite you to experience the art of baking at its finest.<br />\r\n<br />\r\nOur award-winning pies come from the age-old tradition of using&nbsp;simple and natural ingredients. The smell&nbsp;of freshly baked pies will remind of those precious moments of times past. The taste is something you won&rsquo;t forget.</p>', '1', '2024-08-29 04:07:55', '2024-08-30 09:09:25'),
(2, '19', 'Delivery Policy', '0', 'Delivery Policy', 'delivery-policy', '<p>At our bakery, we strive to provide our customers with fast and efficient delivery options. We offer the following delivery options for our online orders:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Standard Delivery: Our standard delivery option typically takes 2-5 business days for delivery within the continental United States. Shipping costs are calculated based on the size and weight of the order.</p>\r\n	</li>\r\n	<li>\r\n	<p>Expedited Delivery: We also offer expedited delivery options for customers who need their orders delivered more quickly. Expedited delivery options may include overnight, 2-day, or 3-day shipping options. Shipping costs for expedited delivery are calculated based on the shipping speed selected, as well as the size and weight of the order.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>Please note that delivery times may vary depending on the destination and shipping carrier. We are not responsible for delays or damages caused by the shipping carrier.</p>\r\n\r\n<p>Orders will be shipped to the address provided at the time of ordering. We are not responsible for orders that are lost or stolen after delivery.</p>\r\n\r\n<p>We offer free standard shipping for orders over a certain amount. Please check our website for current promotions and shipping offers.</p>\r\n\r\n<p>If you have any questions or concerns about your order, please contact us at [contact information] and we will do our best to assist you.</p>\r\n\r\n<p>By placing an order on our website, you acknowledge that you have read and agree to our delivery policy.</p>', '1', '2024-08-29 04:08:03', '2024-08-29 04:08:03'),
(3, '20', 'FAQs', '0', 'Page', 'faqs', '<h3>1. What is Sweetie Pie?</h3>\r\n\r\n<p>Sweetie Pie is a delightful dessert company specializing in handcrafted artisan treats made with love and the finest local ingredients. From delectable pies, butter tarts, cookies and cake jars, we offer a wide array of sweet delights to satisfy your cravings.</p>\r\n\r\n<h3>2. How can I place an order with Sweetie Pie?</h3>\r\n\r\n<p>Placing an order with Sweetie Pie is easy! Simply visit our official website <strong>www.mysweetiepie.ca</strong> and browse through our mouthwatering dessert selections. Add your desired treats to the cart, proceed to checkout, and follow the prompts to provide your shipping and payment details. Once your order is confirmed, we will take care of the rest.</p>\r\n\r\n<h3>3. Where does Sweetie Pie deliver?</h3>\r\n\r\n<p>We currently deliver our sweet treats to various locations within the Greater Toronto Area. During the checkout process, you can enter your delivery address to check if we deliver to your specific area.</p>\r\n\r\n<h3>4. Can I customize my order for a special occasion?</h3>\r\n\r\n<p>Absolutely! We love adding a personal touch to your celebrations. For customized orders, such as adding personalized messages, specific decorations, or special flavors, please get in-touch with our head office.&nbsp;</p>\r\n\r\n<h3>5. How are the desserts packaged for delivery?</h3>\r\n\r\n<p>At Sweetie Pie, we take great care in packaging our desserts to ensure they arrive in perfect condition. Our eco-friendly packaging materials are chosen to protect the freshness and quality of your order during transit.</p>\r\n\r\n<h3>6. What are the delivery options and charges?</h3>\r\n\r\n<p>We offer standard shipping for all orders within the Greater Toronto Area. The shipping charges are calculated based on the order&#39;s weight, delivery destination, and selected shipping method. The applicable shipping charges will be displayed during the checkout process for your review before finalizing the order.</p>\r\n\r\n<h3>7. Can I track my order?</h3>\r\n\r\n<p><strong>Yes! Once your order is shipped, you will receive a confirmation email containing tracking details. You can use this information to monitor your order&#39;s status and estimated delivery date.</strong></p>\r\n\r\n<h3>8. What if I have dietary restrictions or allergies?</h3>\r\n\r\n<p>We understand the importance of catering to various dietary needs. While some of our desserts are made without common allergens, please note that our kitchen handles various ingredients, and cross-contamination may occur. It is the customer&#39;s responsibility to inform us of any specific allergies or dietary restrictions while placing the order.</p>\r\n\r\n<h3>9. What is your policy on returns and refunds?</h3>\r\n\r\n<p>As our products are perishable, we do not accept returns. However, if you are not satisfied with your order or experience any issues, please contact our customer support team within 24 hours of delivery or pickup. We will do our best to address your concerns and ensure your satisfaction.</p>\r\n\r\n<h3>10. How can I contact Sweetie Pie for further assistance?</h3>\r\n\r\n<p>For any additional questions, concerns, or assistance, please feel free to contact our customer support team at<strong> customerservice@mysweetiepie.ca</strong>. We are here to help and ensure your experience with Sweetie Pie is nothing short of delightful!</p>\r\n\r\n<p>At Sweetie Pie, we are passionate about delivering joy through our delectable desserts. Thank you for choosing us, and we look forward to serving you soon!</p>\r\n\r\n<p>&nbsp;</p>', '1', '2024-08-29 04:08:17', '2024-08-29 04:08:17'),
(4, '17', 'Privacy-policy', '0', 'Privacy Policy', 'privacy-policy', '<p>At Sweetie Pie, we are committed to safeguarding your privacy and ensuring the security of your personal information. This Privacy Policy outlines how we collect, use, disclose, and protect your data when you interact with our website, place orders, or engage with our services. By using our website and services, you consent to the practices described in this policy.</p>\r\n\r\n<h3>1. Information We Collect:</h3>\r\n\r\n<p>Personal Information: When you place an order or register for an account, we may collect your name, contact details (such as email address, phone number, and shipping address), and payment information to process your order and provide excellent customer service. Cookies and Tracking Technologies: We may use cookies and similar tracking technologies to enhance your browsing experience, remember your preferences, and analyze website traffic. These technologies may collect non-personal information such as IP address, browser type, and device information.</p>\r\n\r\n<h3>2. Use of Information:</h3>\r\n\r\n<p>We use the information collected to process your orders, deliver products, and provide customer support. Personal information may also be used to communicate with you regarding your order status, promotions, or relevant updates. Non-personal information collected through cookies and tracking technologies helps us improve our website&#39;s functionality and user experience.</p>\r\n\r\n<h3>3. Disclosure of Information:</h3>\r\n\r\n<p>We may share your personal information with trusted third-party service providers who assist us in processing orders, delivering products, and improving our services. These providers are bound by confidentiality agreements and are not permitted to use your information for any other purpose. We may also share your information when required by law, legal proceedings, or to protect the rights, safety, and property of Sweetie Pie and its customers.</p>\r\n\r\n<h3>4. Security:</h3>\r\n\r\n<p>We take appropriate measures to protect your personal information from unauthorized access, disclosure, or alteration. Our website uses industry-standard encryption technology (SSL) to secure your sensitive data during transmission. While we strive to protect your data, no online platform can guarantee absolute security. Hence, we cannot warrant the complete security of any information you transmit to us.</p>\r\n\r\n<h3>5. Your Choices:</h3>\r\n\r\n<p>You may choose to opt-out of promotional emails by clicking the &quot;unsubscribe&quot; link provided in the email. You can adjust your browser settings to manage or block cookies. However, this may affect certain features and functionalities of our website.</p>\r\n\r\n<h3>6. Children&#39;s Privacy:</h3>\r\n\r\n<p>Sweetie Pie does not knowingly collect personal information from children under the age of 13. If you believe that a child has provided us with their data, please contact us, and we will promptly remove the information from our records.</p>\r\n\r\n<h3>7. Updates to the Privacy Policy:</h3>\r\n\r\n<p>Sweetie Pie may update this Privacy Policy from time to time. Any significant changes will be communicated through our website or other appropriate means.If you have any questions or concerns about our Privacy Policy or how we handle your personal information, please contact us at <strong>privacy@mysweetiepie.ca</strong>. Your privacy matters to us, and we are dedicated to ensuring a secure and delightful experience with Sweetie Pie.</p>', '1', '2024-08-29 04:08:32', '2024-08-29 04:08:32'),
(5, '16', 'Shipping Policy', '0', 'Shipping Policy', 'shipping-policy', '<p>Thank you for choosing Sweetie Pie! We are committed to delivering your delectable treats with utmost care and efficiency. This Shipping Policy outlines our shipping methods, delivery times, charges, and related information to ensure a delightful experience with every order.</p>\r\n\r\n<h3>1. Shipping Methods:</h3>\r\n\r\n<p>We currently offer standard shipping for all orders within <strong>GTA</strong>. Expedited shipping options may also be available, depending on your location and the selected items.</p>\r\n\r\n<h3>2. Shipping Zones and Delivery Areas:</h3>\r\n\r\n<p>Sweetie Pie ships to most locations within <strong>GTA</strong>. Please check the delivery options available to your specific area during the checkout process.</p>\r\n\r\n<h3>3. Order Processing Time:</h3>\r\n\r\n<p>We strive to process and fulfill orders promptly. Most orders are processed within <strong>2 </strong>business days after payment confirmation. However, during peak seasons or for customized orders, processing times may be extended. Rest assured, we will communicate any delays promptly.</p>\r\n\r\n<h3>4. Delivery Time:</h3>\r\n\r\n<p><strong>Standard Delivery:</strong> Standard shipping typically takes<strong> 1-2 </strong>business days, depending on your location and local delivery schedules.</p>\r\n\r\n<p><strong>Expedited Delivery:</strong> If expedited shipping options are available, the estimated delivery time will be communicated during the checkout process.</p>\r\n\r\n<h3>5. Shipping Charges:</h3>\r\n\r\n<p>Shipping fees are calculated based on the order&#39;s weight, delivery destination, and selected shipping method. The applicable shipping charges will be displayed during the checkout process for your review before finalizing the order.</p>\r\n\r\n<h3>6. Order Tracking:</h3>\r\n\r\n<p>Once your order is shipped, you will receive a confirmation email containing tracking details. You can use this information to monitor your order&#39;s status and estimated delivery date.</p>\r\n\r\n<h3>7. Delivery Attempts and Signature Requirements:</h3>\r\n\r\n<p>For standard deliveries, our shipping partners will attempt delivery to the provided shipping address. If no one is available to receive the package, a delivery notice will be left, and re-delivery attempts will be made as per the shipping partner&#39;s policy.</p>\r\n\r\n<p>Signature requirements may apply to certain high-value orders or based on the courier&#39;s discretion.</p>\r\n\r\n<h3>8. Delivery Issues and Lost Packages:</h3>\r\n\r\n<p>In the rare event of a delayed delivery or if you suspect a lost package, please contact our customer support team immediately. We will work closely with our shipping partners to resolve the issue promptly.</p>\r\n\r\n<h3>9. Shipping Restrictions:</h3>\r\n\r\n<p>Sweetie Pie complies with all relevant shipping regulations. However, we may have specific restrictions on shipping certain products to certain locations. Please review any product-specific shipping restrictions during the checkout process.</p>\r\n\r\n<h3>10. International Shipping:</h3>\r\n\r\n<p>At present, we primarily serve customers within GTA. For international shipping inquiries, please contact our customer support team to check if shipping to your location is possible.</p>\r\n\r\n<h3>11. Packaging:</h3>\r\n\r\n<p>We take great care in packaging our treats to ensure they arrive in perfect condition. Our eco-friendly packaging materials are chosen to protect the freshness and quality of your order during transit.</p>\r\n\r\n<h3>12. Change of Shipping Address:</h3>\r\n\r\n<p>To ensure a smooth delivery process, please double-check and provide an accurate shipping address during checkout. If you need to change the shipping address after placing the order, please contact us immediately. We will do our best to accommodate address changes before the order is shipped.</p>\r\n\r\n<p>For any additional shipping-related questions or concerns, feel free to contact our customer support team at <strong>customerservice@mysweetiepie.ca</strong>. We value your satisfaction and look forward to delighting you with our swift and reliable shipping services. Enjoy your sweet treats from Sweetie Pie!</p>\r\n\r\n<p>&nbsp;</p>', '1', '2024-08-29 04:08:52', '2024-08-29 04:08:52'),
(6, '18', 'Terms and Conditions', '0', 'Terms & Conditions', 'terms-and-conditions', '<p>Welcome to Sweetie Pie! We are thrilled to offer you our delightful artisanal desserts. Before placing an order with us, please take a moment to review our Terms and Conditions outlined below:</p>\r\n\r\n<h3>1. Order Placement:</h3>\r\n\r\n<p>All orders must be placed through our official website or authorized channels. For corporate and large orders, we recommend placing your request at least 72 hours in advance to ensure availability and customization options.</p>\r\n\r\n<h3>2. Payment:</h3>\r\n\r\n<p>Payment for all orders is required in full at the time of placement. We accept major credit cards, debit cards, and other authorized payment methods.</p>\r\n\r\n<h3>3. Cancellations and Modifications:</h3>\r\n\r\n<p>Cancellations or modifications to your order can be made up to 48 hours before the scheduled delivery or pickup time. For any changes within the 48-hour window, please contact our customer support team to check availability.</p>\r\n\r\n<h3>4. Delivery and Pickup:</h3>\r\n\r\n<p>We offer both delivery and pickup options for your convenience. Delivery charges may apply based on the delivery location and order size. Delivery fees will be clearly communicated during the checkout process. Please ensure someone is available to receive the delivery at the specified address during the scheduled time.</p>\r\n\r\n<h3>5. Quality Assurance:</h3>\r\n\r\n<p>At Sweetie Pie, we take pride in the quality of our desserts. However, in the unlikely event that you are not satisfied with your order, please contact us within 24 hours of delivery or pickup, and we will gladly address your concerns.</p>\r\n\r\n<h3>6. Allergies and Dietary Restrictions:</h3>\r\n\r\n<p>We understand the importance of catering to various dietary needs. While some of our desserts are made without common allergens, please note that our kitchen handles various ingredients, and cross-contamination may occur. It is the customer&#39;s responsibility to inform us of any specific allergies or dietary restrictions while placing the order.</p>\r\n\r\n<h3>7. Customization:</h3>\r\n\r\n<p>We offer limited customization options for corporate and large orders. Please communicate your customization requests at the time of order</p>', '1', '2024-08-29 04:09:07', '2024-08-29 04:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('shefii.indigital@gmail.com', '$2y$10$6A13TYUyse/ZzHwALOV3ZeYSqC7fzMsmFNGb0//0T4LBNJyALyE5K', '2024-08-30 06:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `in_store` int(11) DEFAULT 0,
  `online` int(11) DEFAULT 0,
  `product_type` varchar(250) DEFAULT NULL,
  `has_variation` int(11) NOT NULL DEFAULT 0,
  `addon_availability` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `contents` longtext DEFAULT NULL,
  `baking_info` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `picture_small` varchar(255) DEFAULT NULL,
  `nutrition_picture` varchar(255) DEFAULT NULL,
  `ingredients_picture` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `seo_title` longtext DEFAULT NULL,
  `seo_description` longtext DEFAULT NULL,
  `seo_keyword` longtext DEFAULT NULL,
  `seo_alt` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `addon` int(11) NOT NULL DEFAULT 0,
  `gift_card` int(11) NOT NULL DEFAULT 0,
  `greeting_card` int(11) NOT NULL DEFAULT 0,
  `regular` int(11) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `cooktime` varchar(250) DEFAULT NULL,
  `energy` varchar(250) DEFAULT NULL,
  `serving` varchar(250) DEFAULT NULL,
  `seasonal_availability` tinyint(1) DEFAULT 0,
  `seasonal_show_start` datetime DEFAULT NULL,
  `seasonal_show_end` datetime DEFAULT NULL,
  `seasonal_date_start` date DEFAULT NULL,
  `seasonal_date_end` date DEFAULT NULL,
  `has_customization` tinyint(1) NOT NULL DEFAULT 0,
  `customization_color_one` text DEFAULT NULL,
  `customization_color_two` text DEFAULT NULL,
  `mark_stock_status` tinyint(1) NOT NULL DEFAULT 0,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `discount_type` enum('percentage','amount') DEFAULT NULL,
  `discount_value` int(11) DEFAULT NULL,
  `has_special_price` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `master_id`, `name`, `slug`, `availability`, `in_store`, `online`, `product_type`, `has_variation`, `addon_availability`, `description`, `contents`, `baking_info`, `picture`, `picture_small`, `nutrition_picture`, `ingredients_picture`, `tax_id`, `seo_title`, `seo_description`, `seo_keyword`, `seo_alt`, `type`, `addon`, `gift_card`, `greeting_card`, `regular`, `display_order`, `status`, `cooktime`, `energy`, `serving`, `seasonal_availability`, `seasonal_show_start`, `seasonal_show_end`, `seasonal_date_start`, `seasonal_date_end`, `has_customization`, `customization_color_one`, `customization_color_two`, `mark_stock_status`, `special_price_from`, `special_price_to`, `discount_type`, `discount_value`, `has_special_price`, `created_at`, `updated_at`) VALUES
(1, '2144', '5 Inch Jalapeno Monterey Jack Frozen / Baked', '5-inch-jalapeno-monterey-jack-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with jalapeno Monterey jack cheese, spinach and peppers mix,\r\nCome packed 18 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:03:35', '2024-08-29 10:03:35'),
(2, '2145', '9 Inch Jalapeno Monterey Jack Frozen / Baked', '9-inch-jalapeno-monterey-jack-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with jalapeno Monterey jack cheese, spinach and peppers mix,\r\nCome packed 6  to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:03:42', '2024-08-29 10:03:42'),
(3, '2146', '5 Inch Spanakopita frozen / Baked', '5-inch-spanakopita-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed spinach, fetta, and oregano.\r\nCome packed 18 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:04:34', '2024-08-29 10:04:34'),
(4, '2147', '9 Inch Spanakopita Frozen / Baked', '9-inch-spanakopita-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed spinach, fetta, and oregano.\r\nCome packed 6 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(5, '2148', '9 Inch Goat Cheese And Vegetable Frozen / Baked', '9-inch-goat-cheese-and-vegetable-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with goats cheese, spinach, and peppers.\r\nCome packed 6 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(6, '2149', '5 Inch Goat Cheese And Vegetable Frozen / Baked', '5-inch-goat-cheese-and-vegetable-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with goats cheese, spinach, and peppers.\r\nCome packed 18 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(7, '2150', '9 Inch  Steak and Ale Pie Frozen', '9-inch-steak-and-ale-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'You can taste the Guinness in this traditional Irish steak and mushroom pie. Chunks of beef, stewed for hours in dark ale until tender.\r\nComes packed frozen in 6 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(8, '2151', '5 Inch Steak and Ale Pie Frozen', '5-inch-steak-and-ale-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(9, '2152', '9 Inch Pulled Pork Pie 9 Inch Frozen', '9-inch-pulled-pork-pie-9-inch-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Pork shoulder left to marinate and slow cook all day long. Once pulled, its smothered in a smoky bbq sauce and stuffed into our flaky crust. No room for veggies in this pie!!\r\nComes packed frozen in 6 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(10, '2153', '5 Inch Pulled Pork Pie Frozen', '5-inch-pulled-pork-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(11, '2154', '9 Inch Spicy Beef Curry Pie Frozen', '9-inch-spicy-beef-curry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'An flavourful spicy beef pie made with traditional spices from India. Add some bright green peas for colour and texture. It&rsquo;s a delight to the senses.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(12, '2155', '5 Inch Spicy Beef Curry Pie Frozen', '5-inch-spicy-beef-curry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(13, '2156', '9 Inch Braised Beef Short Rib Pie Frozen', '9-inch-braised-beef-short-rib-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Braised in red wine, this fall apart short rib pie is nothing short of spectacular. Mixed with carrots, celery and onions, the flavor is outstanding. A hands down fav.\r\nComes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(14, '2157', '5 Inch Braised Beef Short Rib Pie Frozen', '5-inch-braised-beef-short-rib-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Braised in red wine, this fall apart short rib pie is nothing short of spectacular. Mixed with carrots, celery and onions, the flavor is outstanding. A hands down fav.\r\nComes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(15, '2158', '9 Inch Chicken Pot Pie Frozen', '9-inch-chicken-pot-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This traditional chicken pot pie is creamy and delicious. Hints of rosemary and thyme, peas, carrots and leeks.  an easy and delicious meal enjoyed by all.\r\nComes packed frozen in 6 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(16, '2159', '5 Inch Chicken Pot Pie Frozen', '5-inch-chicken-pot-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This traditional chicken pot pie is creamy and delicious. Hints of rosemary and thyme, peas, carrots and leeks. an easy and delicious meal enjoyed by all\r\n.Comes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(17, '2160', '9 Inch Frozen Mushroom Pot Pie Frozen', '9-inch-frozen-mushroom-pot-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Who says all savoury pies have to have meat? This creamy vegan mushroom pie is loaded with peas, carrots, mushrooms and coconut milk. A veggie version of the traditional pot pie.\r\nComes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(18, '2161', '5 Inch Frozen Mushroom Pot Pie Frozen', '5-inch-frozen-mushroom-pot-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Who says all savoury pies have to have meat? This creamy vegan mushroom pie is loaded with peas, carrots, mushrooms and coconut milk. It&rsquo;s a veggie version of the traditional pot pie.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(19, '2162', '9 Inch Frozen Soy Tikka Masala Pie Frozen', '9-inch-frozen-soy-tikka-masala-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'With a masala spice mix imported directly from India, we shred soy chunks and add them to coconut milk and red peppers to create this fun, spicy and flavor filled pie.\r\nComes packed frozen in 6 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(20, '2163', '5 Inch Soy Tikka Masala Pie Frozen', '5-inch-soy-tikka-masala-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'With a masala spice mix imported directly from India, we shred soy chunks and add them to coconut milk and red peppers to create this fun, spicy and flavor filled pie.\r\nComes packed frozen in 18 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(21, '2164', 'Pack 24 Baked Muffins Baked frozen', 'pack-24-baked-muffins-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Baked ready chocolate chip muffins Frozen packed in 24', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:16', '2024-08-29 10:06:16'),
(22, '2165', 'Cheesecake Bars Slab Frozen Baked ready to serve', 'cheesecake-bars-slab-frozen-baked-ready-to-serve', 'in-store', 0, 1, NULL, 0, NULL, 'This is what you get when apple pie and cheesecake collide. Caramel over oats, over apple pie, on top of sweet creamy cheesecake and graham cracker crust. All you can ask for?\r\nCome packed in in 12 x12 slabs baked frozen ready to serve. 3 Slabs per case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(23, '2166', 'Banana/Pumpkin Bread Loaf Frozen Baked ready', 'bananapumpkin-bread-loaf-frozen-baked-ready', 'in-store', 0, 1, NULL, 0, NULL, 'This vegan favourite is a delicious banana bread made with vegan Belgian semi sweet chocolate. It&rsquo;s the perfect breakfast or lunch time treat.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(24, '2167', 'Date Squares Baked Ready to Serve Baked /Frozen', 'date-squares-baked-ready-to-serve-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Our date squares are a classic Canadian dessert made from dates with a toasted oat topping. We use vegan butter so to ensure this treat can be enjoyed by all.\r\nComes baked/ frozen ready to serve in 12x12 slabs, 3 Slabs to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(25, '2168', 'Original Butter Tarts 24Pcs', 'original-butter-tarts-24pcs', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 24 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(26, '2169', 'Bourbon Butter Tarts 24Pcs', 'bourbon-butter-tarts-24pcs', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 24 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(27, '2170', 'Raisin Butter Tarts 24Pcs', 'raisin-butter-tarts-24pcs', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed frozen in 24 pieces', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(28, '2171', 'Iced Coffee Large 20 oz', 'iced-coffee-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(29, '2172', 'Iced Coffee Medium 16 oz', 'iced-coffee-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(30, '2173', 'Iced Lattes Large 20 oz', 'iced-lattes-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(31, '2174', 'Iced Lattes Medium 16 oz', 'iced-lattes-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:13', '2024-08-29 10:07:13'),
(32, '2175', 'Caramel Brownies Baked Ready to Serve Baked / Frozen', 'caramel-brownies-baked-ready-to-serve-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Now this is our most decadent treat Brownies are to die for!!! made with a chewy top layer and a warm gooey center it is the perfect treat.\r\nComes in 12 x12 slabs baked ready to serve, in case of three slabs ( 48 pieces )', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(33, '2176', 'Iced Flavoured Latte Large 20 oz', 'iced-flavoured-latte-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(34, '2177', 'Iced Flavoured Latte Medium 16 oz', 'iced-flavoured-latte-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(35, '2178', 'GIFT CARD $75', 'gift-card-75', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(36, '2179', 'Greeting Card', 'greeting-card', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(37, '2180', 'GIFT CARD $25', 'gift-card-25', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(38, '2181', 'GIFT CARD $50', 'gift-card-50', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(39, '2182', 'GIFT CARD $100', 'gift-card-100', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(40, '2183', 'Red Velvet  Cake Jars Frozen / Baked', 'red-velvet-cake-jars-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Red Velvet Cake single servings in this perfectly sized jar is packed full, rich in colour and taste, layered with and ever so silky cream cheese icing.\r\nComes ready to serve frozen , 6 to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(41, '2184', 'Birthday  Cake Jars Baked /Frozen', 'birthday-cake-jars-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Funfetti Cake single servings in this perfectly sized jar is packed full of moist cake layered with a Vegan frosting. This is an eggless and dairy free cake jar (Vegan)\r\nComes ready to serve frozen , 6 to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(42, '2185', 'Chocolate Fudge Cake  Jars Baked / Frozen', 'chocolate-fudge-cake-jars-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Double Fudge Cake single servings in this perfectly sized jar is packed full of moist cake layered with chocolate ganache. This is an eggless and dairy free cake jar (Vegan) Comes ready to serve frozen , 6 to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(43, '2186', 'Strawberry Shortcake Cake Jars Baked / frozen', 'strawberry-shortcake-cake-jars-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Vanilla Cake single servings in this perfectly sized jar is packed full of moist cake layered with a Vegan frosting and strawberry coulis. This is an eggless and dairy free cake jar (Vegan)  Comes ready to serve frozen , 6 to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(44, '2187', 'Carrot Cake Jars Baked / Frozen', 'carrot-cake-jars-baked-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Carrot Cake single servings in this perfectly sized jar is packed full and layered with and ever so silky cream cheese icing.  Comes ready to serve frozen , 6 to a case', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(45, '2188', 'Iced Chai Latte Medium 16 oz', 'iced-chai-latte-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:32', '2024-08-29 10:08:32'),
(46, '2189', 'Iced Chai Latte Large 20 oz', 'iced-chai-latte-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(47, '2190', '5 Inch Aged Cheddar and Pancetta Frozen / Baked', '5-inch-aged-cheddar-and-pancetta-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with aged white cheddar and crispy pancetta.  Come packed 18 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(48, '2191', '9 Inch Aged Cheddar and Pancetta Frozen / Baked', '9-inch-aged-cheddar-and-pancetta-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional French egg custard tart mixed with aged white cheddar and crispy pancetta.  Come packed 6 to a case frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(49, '2192', 'Iced Matcha Latte Medium 16 oz', 'iced-matcha-latte-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(50, '2193', 'Iced Matcha Latte Large 20 oz', 'iced-matcha-latte-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(51, '2194', 'Iced Mocha Large 20 oz', 'iced-mocha-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:09:07', '2024-08-29 10:09:07'),
(52, '2195', 'Iced Mocha Medium 16 oz', 'iced-mocha-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(53, '2196', 'Iced Americano Medium 16 oz', 'iced-americano-medium-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(54, '2197', 'Iced Americano Large 20 oz', 'iced-americano-large-20-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(55, '2198', 'Coffee 10 oz', 'coffee-10-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(56, '2199', 'Coffee 12 oz', 'coffee-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(57, '2200', 'Coffee 16 oz', 'coffee-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(58, '2201', 'Lattes 12 oz', 'lattes-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:11:57', '2024-08-29 10:11:57'),
(59, '2202', 'Lattes 16 oz', 'lattes-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(60, '2203', 'Flavour Latte 12 oz', 'flavour-latte-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(61, '2204', 'Flavour Latte 16 oz', 'flavour-latte-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(62, '2205', 'Chai Latte 12 oz', 'chai-latte-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(63, '2206', 'Chai Latte 16 oz', 'chai-latte-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:11', '2024-08-29 10:12:11'),
(64, '2207', 'Matcha Latte 12 oz', 'matcha-latte-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(65, '2208', 'Matcha Latte 16 oz', 'matcha-latte-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(66, '2209', 'Golden Milk 12 oz', 'golden-milk-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(67, '2210', 'Golden Milk 16 oz', 'golden-milk-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(68, '2211', 'London Fog 12 oz', 'london-fog-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:25', '2024-08-29 10:12:25'),
(69, '2212', 'London Fog 16 oz', 'london-fog-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(70, '2213', 'Mocha 12 oz', 'mocha-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(71, '2214', 'Mocha 16 oz', 'mocha-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(72, '2215', 'Cappuccino 10 oz', 'cappuccino-10-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(73, '2218', 'Americano 12 oz', 'americano-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:46', '2024-08-29 10:12:46'),
(74, '2219', 'Belgian Hot Chocolate 12 oz', 'belgian-hot-chocolate-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(75, '2220', 'Belgian Hot Chocolate 16 oz', 'belgian-hot-chocolate-16-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(76, '2221', 'Hot Chocolate (Kids) 10 oz', 'hot-chocolate-kids-10-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(77, '2222', 'Tea', 'tea', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:12:57', '2024-08-29 10:12:57'),
(78, '2223', 'Espresso', 'espresso', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:00', '2024-08-29 10:13:00'),
(79, '2224', 'Whipped Cream', 'whipped-cream', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:03', '2024-08-29 10:13:03'),
(80, '2217', 'Americano 10 oz', 'americano-10-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(81, '2216', 'Cappuccino 12 oz', 'cappuccino-12-oz', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(82, '2225', 'Cone Ice Cream 3 Scoop', 'cone-ice-cream-3-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(83, '2226', 'Cone Ice Cream 2 Scoop', 'cone-ice-cream-2-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(84, '2227', 'Cone Ice Cream 1 Scoop', 'cone-ice-cream-1-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(85, '2228', 'Cup Ice Cream 3 Scoop', 'cup-ice-cream-3-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(86, '2229', 'Cup Ice Cream 2 Scoop', 'cup-ice-cream-2-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:17', '2024-08-29 10:13:17'),
(87, '2230', 'Cup Ice Cream 1 Scoop', 'cup-ice-cream-1-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(88, '2231', 'Waffle Cone Ice Cream 1 Scoop', 'waffle-cone-ice-cream-1-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(89, '2232', 'Waffle Cone Ice Cream 2 Scoop', 'waffle-cone-ice-cream-2-scoop', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(90, '2233', 'Ice Cream Sammie', 'ice-cream-sammie', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(91, '2234', 'Medium Milkshake', 'medium-milkshake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:31', '2024-08-29 10:13:31'),
(92, '2238', 'Chocolate Chip Cookie Frozen Case', 'chocolate-chip-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:47', '2024-09-13 10:06:39'),
(93, '2239', 'Nutella filled Cookie Frozen Case', 'nutella-filled-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:49', '2024-09-13 10:06:56'),
(94, '2240', 'Peanut Butter Cookie Frozen Case', 'peanut-butter-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:52', '2024-09-13 10:07:13'),
(95, '2241', 'Red Velvet Cookie Frozen Case', 'red-velvet-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:54', '2024-09-13 10:07:26'),
(96, '2242', 'S\'mores Cookie Frozen Case', 'smores-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:13:57', '2024-09-13 10:07:39'),
(97, '2243', 'Oreo Cookies Frozen Case', 'oreo-cookies-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:00', '2024-09-13 10:07:50'),
(98, '2244', 'Rainbow Cookie Frozen Case', 'rainbow-cookie-frozen-case', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed 50 pieces to a case frozen', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:02', '2024-09-13 10:08:03'),
(100, '2245', '9 Inch Apple Pie Frozen', '9-inch-apple-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'When I think of our apple pie, I think of home. Layers of warm spiced apples, fragrant and delicious. All beneath our flaky light crust  like a warm hug on a cold day. Comes packed in 6 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(102, '2235', 'Large Milkshake', 'large-milkshake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(103, '2246', '5 Inch Apple Pie Frozen', '5-inch-apple-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'When I think of our apple pie, I think of home. Layers of warm spiced apples, fragrant and delicious. All beneath our flaky light crust.  like a warm hug on a cold day. Comes packed in 18 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(104, '2247', '5 Inch Cherry Pie Frozen', '5-inch-cherry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This pie has the brightest and sourest of cherries.  a feast for the eyes and the taste buds. Add a dollop of vanilla ice cream on top of a warm cherry pie, it&#39;s like a little taste of heaven.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(105, '2248', '9 Inch Cherry Pie Frozen', '9-inch-cherry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This pie has the brightest and sourest of cherries.  a feast for the eyes and the taste buds. Add a dollop of vanilla ice cream on top  a warm cherry pie, it&#39;s like a little taste of heaven. Comes packed in 6 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(106, '2249', '5 Inch Blueberry Pie Frozen', '5-inch-blueberry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Wild and Fresh is the best way to describe our Blueberry Pie. Made with wild blueberries, freshly squeezed lemon juice and a pinch of sugar, this not too sweet pie is a classic and customer fav.\r\nComes packed 18 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(107, '2250', '9 Inch Blueberry Pie Frozen', '9-inch-blueberry-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'Wild and Fresh is the best way to describe our Blueberry Pie. Made with wild blueberries, freshly squeezed lemon juice and a pinch of sugar, this not too sweet pie is a classic and customer fav. Comes packed in 6 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(108, '2251', '5 Inch Strawberry Rhubarb Pie Frozen', '5-inch-strawberry-rhubarb-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This is your Mom favourite pie! Sweet red strawberries mixed with rhubarb, the perfect amount of tart and sweet. I dare all rhubarb naysayers to try this one!\r\nComes packed 18 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(109, '2252', '9 Inch Strawberry Rhubarb Pie Frozen', '9-inch-strawberry-rhubarb-pie-frozen', 'in-store', 0, 1, NULL, 0, NULL, 'This is your Mom favourite pie! Sweet red strawberries mixed with rhubarb, the perfect amount of tart and sweet. I dare all rhubarb naysayers to try this one!\r\nComes packed in 6 per case frozen ready to bake', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(110, '2253', '9 inch Pecan Pie Frozen /Baked', '9-inch-pecan-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'This pie is traditionally a southern US favorite, but our pecan pie delights all us Northerners. Its sweet like just like us Canadians.\r\nComes packed in 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:25', '2024-08-29 10:14:25'),
(111, '2259', 'Pumpkin Pie Frozen / Baked', 'pumpkin-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'I dont care what season it is, pumpkin pie is the best. Cinnamon and allspice, smooth and creamy. Whipped cream and warm crust? This is meant to be enjoyed 365 days a year!\r\nComes packed in 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(112, '2260', '5 Inch Pumpkin Pie Frozen / Baked', '5-inch-pumpkin-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'I don\'t care what season it is, pumpkin pie is the best. Cinnamon and allspice, smooth and creamy. Whipped cream and warm crust? This is meant to be enjoyed 365 days a year!\r\nComes packed 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(113, '2261', '5 Inch Key Lime - Seasonal Frozen / Baked', '5-inch-key-lime-seasonal-frozen-baked', 'in-store', 0, 0, NULL, 0, NULL, 'As soon as summer hits you know its Key Lime Season. Made from fresh key lime juice and zest, this pie is a treat only available during the summer months, so get it while you can.\r\nComes packed 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(114, '2262', 'Key Lime -9 Inch  Seasonal Frozen / Baked', 'key-lime-9-inch-seasonal-frozen-baked', 'in-store', 0, 0, NULL, 0, NULL, 'As soon as summer hits you know its Key Lime Season. Made from fresh key lime juice and zest, this pie is a treat only available during the summer months, so get it while you can. Comes packed in 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(115, '2263', 'Peach Crumble Pie - Seasonal 5 Inch', 'peach-crumble-pie-seasonal-5-inch', 'in-store', 0, 0, NULL, 0, NULL, 'Its peach season! Suns out, crumbs out!! Our Juicy peach pie is warm, spicy and delicious. It&rsquo;s a hot take on a summer classic.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:14:59', '2024-08-29 10:14:59'),
(116, '2264', 'Peach Crumble Pie - Seasonal 9 Inch', 'peach-crumble-pie-seasonal-9-inch', 'in-store', 0, 0, NULL, 0, NULL, 'Its peach season! Suns out, crumbs out!! Our Juicy peach pie is warm, spicy and delicious. It&rsquo;s a hot take on a summer classic.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:03', '2024-08-29 10:15:03'),
(117, '2265', 'Cookie pack 6pcs', 'cookie-pack-6pcs', 'in-store', 0, 1, NULL, 0, NULL, 'Cookie pack for cookies', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(118, '2258', '5 Inch Lemon Pie Frozen / Baked', '5-inch-lemon-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Our Lemon Meringue Pie will make you pucker. Our lemon curd is made from freshly squeezed lemon juice with just a touch of sweetness to balance the sour.\r\nComes packed 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(119, '2266', 'Cookie pack 12pcs', 'cookie-pack-12pcs', 'in-store', 0, 1, NULL, 0, NULL, 'Cookie pack for cookies', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(120, '2257', '9 Inch Lemon Pie Frozen / Baked', '9-inch-lemon-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Our Lemon Meringue Pie will make you pucker. Our lemon curd is made from freshly squeezed lemon juice with just a touch of sweetness to balance the sour.\r\nComes packed in 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:13', '2024-08-29 10:15:13');
INSERT INTO `products` (`id`, `master_id`, `name`, `slug`, `availability`, `in_store`, `online`, `product_type`, `has_variation`, `addon_availability`, `description`, `contents`, `baking_info`, `picture`, `picture_small`, `nutrition_picture`, `ingredients_picture`, `tax_id`, `seo_title`, `seo_description`, `seo_keyword`, `seo_alt`, `type`, `addon`, `gift_card`, `greeting_card`, `regular`, `display_order`, `status`, `cooktime`, `energy`, `serving`, `seasonal_availability`, `seasonal_show_start`, `seasonal_show_end`, `seasonal_date_start`, `seasonal_date_end`, `has_customization`, `customization_color_one`, `customization_color_two`, `mark_stock_status`, `special_price_from`, `special_price_to`, `discount_type`, `discount_value`, `has_special_price`, `created_at`, `updated_at`) VALUES
(121, '2256', '9 Inch Chocolate Bourbon Pecan Pie Frozen / Baked', '9-inch-chocolate-bourbon-pecan-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Now this is your Dad favourite pie. Take the sweetness of our traditional pecan, add dark chocolate and a shot of bourbon! Good luck getting dad to share!\r\nComes packed in 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(122, '2255', '5 Inch Chocolate Bourbon Pecan Pie Frozen / Baked', '5-inch-chocolate-bourbon-pecan-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Now this is your Dad favourite pie. Take the sweetness of our traditional pecan, add dark chocolate and a shot of bourbon! Good luck getting dad to share!\r\nComes packed 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(123, '2254', '5 Inch Pecan Pie Frozen / Baked', '5-inch-pecan-pie-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'This pie is traditionally a southern US favorite, but our pecan pie delights all us Northerners. Its sweet like just like us Canadians.\r\nComes packed 6 per case frozen ready to serve', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(124, '2267', 'Family Day Cookie Cake Chocolate Chip', 'family-day-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Family Day Cookie. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(125, '2268', 'Family Day Cookie Cake Red Velvet', 'family-day-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Family Day Cookie. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(126, '2269', 'Family Day Cookie Cake Cookies & Cream', 'family-day-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Family Day Cookie. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:21', '2024-08-29 10:15:21'),
(127, '2270', 'Family Day Cookie Cake Funfetti', 'family-day-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Family Day Cookie. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(128, '2271', 'Oatmeal Pumpkin Spice Cookies 12', 'oatmeal-pumpkin-spice-cookies-12', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:27', '2024-08-29 10:15:27'),
(129, '2277', 'Celebrate Any Occasion Cookie Cake Red Velvet', 'celebrate-any-occasion-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Perfect for any occasion, our &quot;Celebrate Any Occasion&quot; Cookie Cake is a versatile choice. With a chocolate chip base and a blank canvas for your message, you can customize it for any event or celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:50', '2024-08-29 10:15:50'),
(130, '2278', 'Celebrate Any Occasion Cookie Cake Cookies & Cream', 'celebrate-any-occasion-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Perfect for any occasion, our &quot;Celebrate Any Occasion&quot; Cookie Cake is a versatile choice. With a chocolate chip base and a blank canvas for your message, you can customize it for any event or celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(131, '2279', 'Celebrate Any Occasion Cookie Cake Funfetti', 'celebrate-any-occasion-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Perfect for any occasion, our &quot;Celebrate Any Occasion&quot; Cookie Cake is a versatile choice. With a chocolate chip base and a blank canvas for your message, you can customize it for any event or celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(132, '2280', 'Get Well Soon Cookie Cake Chocolate Chip', 'get-well-soon-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Send warm wishes and a taste of comfort with our &quot;Get Well Soon&quot; Cookie Cake. Baked to perfection with a chocolate chip base, it&#39;s a sweet way to bring comfort to someone on the road to recovery.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:15:58', '2024-08-29 10:15:58'),
(133, '2281', 'Get Well Soon Cookie Cake Red Velvet', 'get-well-soon-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Send warm wishes and a taste of comfort with our &quot;Get Well Soon&quot; Cookie Cake. Baked to perfection with a chocolate chip base, it&#39;s a sweet way to bring comfort to someone on the road to recovery.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(134, '2282', 'Get Well Soon Cookie Cake Cookies & Cream', 'get-well-soon-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Send warm wishes and a taste of comfort with our &quot;Get Well Soon&quot; Cookie Cake. Baked to perfection with a chocolate chip base, it&#39;s a sweet way to bring comfort to someone on the road to recovery.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:04', '2024-08-29 10:16:04'),
(135, '2276', 'Celebrate Any Occasion Cookie Cake Chocolate Chip', 'celebrate-any-occasion-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Perfect for any occasion, our &quot;Celebrate Any Occasion&quot; Cookie Cake is a versatile choice. With a chocolate chip base and a blank canvas for your message, you can customize it for any event or celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(136, '2275', 'Pumpkin Pie In a Jar 4', 'pumpkin-pie-in-a-jar-4', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(137, '2283', 'Get Well Soon Cookie Cake Funfetti', 'get-well-soon-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Send warm wishes and a taste of comfort with our &quot;Get Well Soon&quot; Cookie Cake. Baked to perfection with a chocolate chip base, it&#39;s a sweet way to bring comfort to someone on the road to recovery.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(138, '2274', 'Pumpkin Pie In a Jar 8', 'pumpkin-pie-in-a-jar-8', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(139, '2273', 'Pumpkin Pie In a Jar 12', 'pumpkin-pie-in-a-jar-12', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(140, '2272', 'Oatmeal Pumpkin Spice Cookies 6', 'oatmeal-pumpkin-spice-cookies-6', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(141, '2284', 'Happy Birthday Cookie Cake Chocolate Chip', 'happy-birthday-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Happy Birthday&quot; Cookie Cake. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any birthday celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(142, '2285', 'Happy Birthday Cookie Cake Red Velvet', 'happy-birthday-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Happy Birthday&quot; Cookie Cake. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any birthday celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:12', '2024-08-29 10:16:12'),
(143, '2286', 'Happy Birthday Cookie Cake Cookies & Cream', 'happy-birthday-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Happy Birthday&quot; Cookie Cake. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any birthday celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(144, '2287', 'Happy Birthday Cookie Cake Funfetti', 'happy-birthday-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Celebrate birthdays with our classic &quot;Happy Birthday&quot; Cookie Cake. Featuring a chocolate chip base and cheerful decorations including vanilla icing and smashed oreo cookies, it&#39;s the perfect centerpiece for any birthday celebration.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(145, '2288', 'Happy Birthday Cookie Cake Funfetti', 'happy-birthday-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Funfetti', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:16:20', '2024-08-29 10:16:20'),
(146, '2295', 'Happy Birthday Cookie Cake Funfetti', 'happy-birthday-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Funfetti', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:04', '2024-08-29 10:17:04'),
(147, '2294', 'Happy Birthday Cookie Cake Cookies & Cream', 'happy-birthday-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Cookies & Cream', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(148, '2293', 'Happy Birthday Cookie Cake Red Velvet', 'happy-birthday-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Red Velvet', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(149, '2292', 'Happy Birthday Cookie Cake Chocolate Chip', 'happy-birthday-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Chocolate Chip', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(150, '2291', 'Happy Birthday Cookie Cake Cookies & Cream', 'happy-birthday-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Cookies & Cream', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(151, '2290', 'Happy Birthday Cookie Cake Red Velvet', 'happy-birthday-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Red Velvet', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(152, '2289', 'Happy Birthday Cookie Cake Chocolate Chip', 'happy-birthday-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Happy Birthday Cookie Cake Chocolate Chip', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(153, '2296', 'I LOVE YOU Cookie Cake Funfetti', 'i-love-you-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Express your love with every bite of our &quot;I LOVE YOU&quot; Cookie Cake. Made with a delicious chocolate chip base and adorned with sweet icing, this 10-inch treat is the perfect way to say those three special words.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(154, '2297', 'I LOVE YOU Cookie Cake Chocolate Chip', 'i-love-you-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Express your love with every bite of our &quot;I LOVE YOU&quot; Cookie Cake. Made with a delicious chocolate chip base and adorned with sweet icing, this 10-inch treat is the perfect way to say those three special words.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(155, '2298', 'I LOVE YOU Cookie Cake Red Velvet', 'i-love-you-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Express your love with every bite of our &quot;I LOVE YOU&quot; Cookie Cake. Made with a delicious chocolate chip base and adorned with sweet icing, this 10-inch treat is the perfect way to say those three special words.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(156, '2299', 'I LOVE YOU Cookie Cake Cookies & Cream', 'i-love-you-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Express your love with every bite of our &quot;I LOVE YOU&quot; Cookie Cake. Made with a delicious chocolate chip base and adorned with sweet icing, this 10-inch treat is the perfect way to say those three special words.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(157, '2300', 'Birth Announcement Cookie Cake Chocolate Chip', 'birth-announcement-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Welcome a new baby into the world with our Birth Announcement Cookie Cake. This charming 10-inch treat features a chocolate chip base and is decorated with adorable baby-themed designs.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(158, '2301', 'Birth Announcement Cookie Cake Red Velvet', 'birth-announcement-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Welcome a new baby into the world with our Birth Announcement Cookie Cake. This charming 10-inch treat features a chocolate chip base and is decorated with adorable baby-themed designs.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(159, '2302', 'Birth Announcement Cookie Cake Cookies & Cream', 'birth-announcement-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Welcome a new baby into the world with our Birth Announcement Cookie Cake. This charming 10-inch treat features a chocolate chip base and is decorated with adorable baby-themed designs.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(160, '2303', 'Birth Announcement Cookie Cake Funfetti', 'birth-announcement-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Welcome a new baby into the world with our Birth Announcement Cookie Cake. This charming 10-inch treat features a chocolate chip base and is decorated with adorable baby-themed designs.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(161, '2304', 'THANK YOU Cookie Cake Chocolate Chip', 'thank-you-cookie-cake-chocolate-chip', 'in-store', 0, 1, NULL, 0, NULL, 'Show your gratitude in the sweetest way possible with our &quot;THANK YOU&quot; Cookie Cake. Overflowing with chocolate chip goodness, this 10-inch delight will convey your appreciation with every scrumptious slice.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:17:59', '2024-08-29 10:17:59'),
(162, '2305', 'THANK YOU Cookie Cake Red Velvet', 'thank-you-cookie-cake-red-velvet', 'in-store', 0, 1, NULL, 0, NULL, 'Show your gratitude in the sweetest way possible with our &quot;THANK YOU&quot; Cookie Cake. Overflowing with chocolate chip goodness, this 10-inch delight will convey your appreciation with every scrumptious slice.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:02', '2024-08-29 10:18:02'),
(163, '2306', 'THANK YOU Cookie Cake Cookies & Cream', 'thank-you-cookie-cake-cookies-cream', 'in-store', 0, 1, NULL, 0, NULL, 'Show your gratitude in the sweetest way possible with our &quot;THANK YOU&quot; Cookie Cake. Overflowing with chocolate chip goodness, this 10-inch delight will convey your appreciation with every scrumptious slice.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(164, '2307', 'THANK YOU Cookie Cake Funfetti', 'thank-you-cookie-cake-funfetti', 'in-store', 0, 1, NULL, 0, NULL, 'Show your gratitude in the sweetest way possible with our &quot;THANK YOU&quot; Cookie Cake. Overflowing with chocolate chip goodness, this 10-inch delight will convey your appreciation with every scrumptious slice.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(165, '2308', 'Winter Snacks', 'winter-snacks', 'in-store', 0, 1, NULL, 0, NULL, 'S&#39;mores Caramel Corn\r\nCookies and Cream Bark\r\nMilk Chocolate Malt Balls\r\nChocolate Chip Shortbread\r\nBelgian Chocolate Seashells', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(166, '2309', 'Chocolate Lovers Bundle', 'chocolate-lovers-bundle', 'in-store', 0, 1, NULL, 0, NULL, 'Sea Salt Caramel Bark\r\nCherry Almond Bark\r\nBelgian Chocolates Sea Shells&nbsp;(4 pcs)&nbsp;\r\nBelgian Chocolate Pralines (9 pcs)', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:13', '2024-08-29 10:18:13'),
(167, '2310', 'Office Platter', 'office-platter', 'in-store', 0, 1, NULL, 0, NULL, '&nbsp;Elevate your holiday gatherings with 40 delectable pieces of pure joy. Indulge in the rich goodness of brownies, the tangy sweetness of apple cheesecake bars, the luxurious delight of red velvet cookies, the classic allure of mini butter tarts, and the perfect blend of white chocolate and cranberry in every bite of our cookies. Spread the cheer and share the joy with this delightful assortment that&#39;s sure to make your office celebration merry and bright!', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:16', '2024-08-29 10:18:16'),
(168, '2311', 'Cupcakes 24 Pices', 'cupcakes-24-pices', 'in-store', 0, 1, NULL, 0, NULL, 'Comes packed and frozen in a case of 36 assorted', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(169, '2312', 'Be Mine Heart Cookie Cake', 'be-mine-heart-cookie-cake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(170, '2313', 'Heart Cookie Cake', 'heart-cookie-cake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(171, '2314', 'Happy Valentines Day Cookie Cake', 'happy-valentines-day-cookie-cake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:27', '2024-08-29 10:18:27'),
(172, '2315', 'I Love You Heart Shaped Cookie Cake', 'i-love-you-heart-shaped-cookie-cake', 'in-store', 0, 1, NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(174, '2317', 'Biscoff Butter Tarts 24 Pcs Frozen / Baked', 'biscoff-butter-tarts-24-pcs-frozen-baked', 'in-store', 0, 1, NULL, 0, NULL, 'Biscoff Butter Tarts packed in 24 pieces , baked frozen ready to serve.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-08-29 10:56:14', '2024-08-29 10:56:14'),
(176, '2323', 'Double Chocolate Shortbread Box', 'double-chocolate-shortbread-box', 'in-store', 0, 1, NULL, 0, NULL, 'Double Chocolate Shortbread', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-09-13 10:38:14', '2024-09-13 10:38:14'),
(177, '2322', 'Chocolate Chunk Shortbread Box', 'chocolate-chunk-shortbread-box', 'in-store', 0, 1, NULL, 0, NULL, 'Chocolate Chunk Shortbread', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(178, '2321', 'Maple Pecan Shortbread Box', 'maple-pecan-shortbread-box', 'in-store', 0, 1, NULL, 0, NULL, 'Maple Pecan Shortbread', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(179, '2320', 'Lemon Shortbread Box', 'lemon-shortbread-box', 'in-store', 0, 1, NULL, 0, NULL, 'Lemon Shortbread', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(180, '2319', 'Traditional Shortbread Box', 'traditional-shortbread-box', 'in-store', 0, 1, NULL, 0, NULL, 'Traditional Shortbread', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_cases`
--

CREATE TABLE `product_cases` (
  `id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(32,2) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_cases`
--

INSERT INTO `product_cases` (`id`, `master_id`, `name`, `quantity`, `price`, `product_id`, `variation_id`, `created_at`, `updated_at`) VALUES
(87, 188, 'Case', 18, 107.82, 1, NULL, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(21, 124, 'Case', 6, 89.94, 2, NULL, '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(88, 189, 'Case', 18, 107.82, 3, NULL, '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(23, 126, 'Case', 6, 89.94, 4, NULL, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(24, 127, 'Case', 6, 89.94, 5, NULL, '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(25, 128, 'Case', 18, 107.82, 6, NULL, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(26, 129, 'Case', 6, 101.94, 7, NULL, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(27, 130, 'Case', 18, 125.82, 8, NULL, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(28, 131, 'Case', 6, 101.94, 9, NULL, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(29, 132, 'Case', 18, 125.82, 10, NULL, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(30, 133, 'Case', 6, 101.94, 11, NULL, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(31, 134, 'Case', 18, 125.82, 12, NULL, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(32, 135, 'Case', 6, 101.94, 13, NULL, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(33, 136, 'Case', 18, 125.82, 14, NULL, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(34, 137, 'Case', 6, 101.94, 15, NULL, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(35, 138, 'Case', 18, 125.82, 16, NULL, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(36, 139, 'Case', 6, 101.94, 17, NULL, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(37, 140, 'Case', 18, 125.82, 18, NULL, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(38, 141, 'Case', 6, 101.94, 19, NULL, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(39, 142, 'Case', 18, 125.82, 20, NULL, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(84, 185, 'Case', 24, 36.00, 21, NULL, '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(41, 144, 'Case', 48, 72.00, 22, NULL, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(42, 145, 'Case', 6, 77.94, 23, NULL, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(43, 146, 'Case', 48, 72.00, 24, NULL, '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(44, 147, 'Case', 24, 36.00, 25, NULL, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(45, 148, 'Case', 24, 36.00, 26, NULL, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(46, 149, 'Case', 24, 36.00, 27, NULL, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(47, 150, 'Case', 48, 72.00, 32, NULL, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(48, 151, 'Case', 6, 25.74, 40, NULL, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(49, 152, 'Case', 6, 25.74, 41, NULL, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(50, 153, 'Case', 6, 25.74, 42, NULL, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(51, 154, 'Case', 6, 25.74, 43, NULL, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(52, 155, 'Case', 6, 25.74, 44, NULL, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(53, 156, 'Case', 18, 107.82, 47, NULL, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(54, 157, 'Case', 6, 89.94, 48, NULL, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(101, 202, 'Case', 50, 72.50, 92, NULL, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(102, 203, 'Case', 50, 72.50, 93, NULL, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(103, 204, 'Case', 50, 72.50, 94, NULL, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(104, 205, 'Case', 50, 72.50, 95, NULL, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(105, 206, 'Case', 50, 72.50, 96, NULL, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(106, 207, 'Case', 50, 72.50, 97, NULL, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(107, 208, 'Case', 50, 72.50, 98, NULL, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(63, 165, 'Case', 6, 101.94, 100, NULL, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(64, 166, 'Case', 18, 125.82, 103, NULL, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(65, 167, 'Case', 18, 125.82, 104, NULL, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(66, 168, 'Case', 6, 101.94, 105, NULL, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(67, 169, 'Case', 18, 125.82, 106, NULL, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(68, 170, 'Case', 6, 101.94, 107, NULL, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(69, 171, 'Case', 18, 125.82, 108, NULL, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(70, 172, 'Case', 6, 101.94, 109, NULL, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(81, 173, 'Case', 6, 101.94, 110, NULL, '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(72, 179, 'Case', 6, 77.94, 111, NULL, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(73, 180, 'Case', 18, 107.82, 112, NULL, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(74, 181, 'Case', 18, 107.82, 113, NULL, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(75, 182, 'Case', 6, 77.94, 114, NULL, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(76, 178, 'Case', 18, 107.82, 118, NULL, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(77, 177, 'Case', 6, 77.94, 120, NULL, '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(78, 176, 'Case', 6, 101.94, 121, NULL, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(79, 175, 'Case', 18, 125.82, 122, NULL, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(80, 174, 'Case', 18, 125.82, 123, NULL, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(82, 183, 'Case', 24, 36.00, 168, NULL, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(90, 191, 'Case', 24, 42.00, 174, NULL, '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(108, 219, 'Case', 12, 58.68, 175, NULL, '2024-09-13 10:36:39', '2024-09-13 10:36:39'),
(111, 221, 'Case', 12, 58.68, 176, NULL, '2024-09-13 10:38:44', '2024-09-13 10:38:44'),
(112, 222, 'Case', 12, 58.68, 177, NULL, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(113, 223, 'Case', 12, 58.68, 178, NULL, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(114, 224, 'Case', 12, 58.68, 179, NULL, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(115, 225, 'Case', 12, 58.68, 180, NULL, '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_cities`
--

CREATE TABLE `product_cities` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'product id',
  `type` varchar(250) NOT NULL COMMENT 'thumb,main,extra',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `picture`, `product_id`, `type`, `created_at`, `updated_at`) VALUES
(383, 'QV6t3N99LpHiHIE5KfEnWUVycF1GhE.png', 1, 'Extra Image', '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(7, 'copy_qOevLa0joXXorGN1z30ZfsRuejC00B.png', 2, 'Thumbnail', '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(384, 'copy_qOevLa0joXXorGN1z30ZfsRuejC00B.png', 1, 'Thumbnail', '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(8, 'dummy.png', 2, 'Nutritional Facts', '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(389, 'copy_NCYmmYGQI3JOtFK4UkUciqE4jzAOss.png', 3, 'Thumbnail', '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(388, 'copy_XWO6KmbcfUEypXtOeJCbfZHDSWK4yx.png', 3, 'Nutritional Facts', '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(11, 'copy_NCYmmYGQI3JOtFK4UkUciqE4jzAOss.png', 4, 'Thumbnail', '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(12, 'copy_XWO6KmbcfUEypXtOeJCbfZHDSWK4yx.png', 4, 'Nutritional Facts', '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(13, 'copy_Ey6vnzzczC7gYWoPBDZD3CBpAXcyUn.png', 5, 'Thumbnail', '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(14, 'dummy.png', 5, 'Nutritional Facts', '2024-08-29 10:04:46', '2024-08-29 10:04:46'),
(15, 'copy_Ey6vnzzczC7gYWoPBDZD3CBpAXcyUn.png', 6, 'Thumbnail', '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(16, 'copy_W7y8TJQweaXreV5JzInGEK722Fbl6T.png', 6, 'Nutritional Facts', '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(17, 'copy_wxstK3SjTXzy0Uh2SykJKnUA5bPNhi.png', 7, 'Thumbnail', '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(18, 'copy_HGTBfe2eiWIAD8VycIGfgUUlF455kM.png', 7, 'Nutritional Facts', '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(19, 'copy_wxstK3SjTXzy0Uh2SykJKnUA5bPNhi.png', 8, 'Thumbnail', '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(20, 'copy_HGTBfe2eiWIAD8VycIGfgUUlF455kM.png', 8, 'Nutritional Facts', '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(21, 'copy_JWZM0olG5JUQSuPb1F7cRy5Ru2HShR.png', 9, 'Thumbnail', '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(22, 'copy_cTnOIct5E2y17LJSpGVH3wwkUYNU31.png', 9, 'Nutritional Facts', '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(23, 'copy_JWZM0olG5JUQSuPb1F7cRy5Ru2HShR.png', 10, 'Thumbnail', '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(24, 'copy_cTnOIct5E2y17LJSpGVH3wwkUYNU31.png', 10, 'Nutritional Facts', '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(25, 'copy_fPIx0HVewIxTJBvpriFaGJXSapVe7c.png', 11, 'Thumbnail', '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(26, 'copy_HHFE7v1YdBVPgfACDslqHFT02kOHvJ.png', 11, 'Nutritional Facts', '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(27, 'copy_fPIx0HVewIxTJBvpriFaGJXSapVe7c.png', 12, 'Thumbnail', '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(28, 'copy_HHFE7v1YdBVPgfACDslqHFT02kOHvJ.png', 12, 'Nutritional Facts', '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(29, 'copy_owOSVNK1fWHZaGFE11xZvd6bgHrOYD.png', 13, 'Thumbnail', '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(30, 'copy_tsUFvcOowFLaD5GGt9JCR0Z11fgaLV.png', 13, 'Nutritional Facts', '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(31, 'copy_owOSVNK1fWHZaGFE11xZvd6bgHrOYD.png', 14, 'Thumbnail', '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(32, 'copy_tsUFvcOowFLaD5GGt9JCR0Z11fgaLV.png', 14, 'Nutritional Facts', '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(33, 'copy_mNCRuLOhPdgzgHSsSaq5BDRO9p72SB.png', 15, 'Thumbnail', '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(34, 'copy_IqogaZoUsgoKXEn0BQIz7ZbIImXKLA.png', 15, 'Nutritional Facts', '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(35, 'copy_mNCRuLOhPdgzgHSsSaq5BDRO9p72SB.png', 16, 'Thumbnail', '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(36, 'copy_IqogaZoUsgoKXEn0BQIz7ZbIImXKLA.png', 16, 'Nutritional Facts', '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(37, 'copy_mbHyxTPoHcAKnBaaa4ikHNMyItGq9e.png', 17, 'Thumbnail', '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(38, 'copy_wrLNcJvcD0OcVAXTS94QlbrtNQUDhe.png', 17, 'Nutritional Facts', '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(39, 'copy_mbHyxTPoHcAKnBaaa4ikHNMyItGq9e.png', 18, 'Thumbnail', '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(40, 'copy_wrLNcJvcD0OcVAXTS94QlbrtNQUDhe.png', 18, 'Nutritional Facts', '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(41, 'copy_HEsveQRnM3RphLr94DARdypkTGiaC7.png', 19, 'Thumbnail', '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(42, 'copy_KjsMdtvdHTPIbgqMXl4GxtF75AcV9Y.png', 19, 'Nutritional Facts', '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(43, 'copy_HEsveQRnM3RphLr94DARdypkTGiaC7.png', 20, 'Thumbnail', '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(44, 'copy_KjsMdtvdHTPIbgqMXl4GxtF75AcV9Y.png', 20, 'Nutritional Facts', '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(377, 'GETvTQNNZwGXIthleylwdOVWN3XtXR.jpeg', 21, 'Thumbnail', '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(47, 'copy_YEsGgeuDRLYwPOpadkHKsQdmfqUp2P.png', 22, 'Thumbnail', '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(48, 'dummy.png', 22, 'Nutritional Facts', '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(49, 'dummy.png', 23, 'Thumbnail', '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(50, 'dummy.png', 23, 'Nutritional Facts', '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(51, 'copy_02b1Rc8qaPG10HJRO5BRF9Q65XCgLn.png', 24, 'Thumbnail', '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(52, 'dummy.png', 24, 'Nutritional Facts', '2024-08-29 10:06:34', '2024-08-29 10:06:34'),
(53, 'copy_gfPtDeHKe5KXscLwnCjnQeVzQj8gY0.png', 25, 'Thumbnail', '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(54, 'copy_jSls9R6NQKY9sNcof3BrS3Vxo27PEc.png', 25, 'Nutritional Facts', '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(55, 'copy_gfPtDeHKe5KXscLwnCjnQeVzQj8gY0.png', 26, 'Thumbnail', '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(56, 'copy_jSls9R6NQKY9sNcof3BrS3Vxo27PEc.png', 26, 'Nutritional Facts', '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(57, 'copy_gfPtDeHKe5KXscLwnCjnQeVzQj8gY0.png', 27, 'Thumbnail', '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(58, 'copy_jSls9R6NQKY9sNcof3BrS3Vxo27PEc.png', 27, 'Nutritional Facts', '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(59, 'dummy.png', 28, 'Thumbnail', '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(60, 'dummy.png', 28, 'Nutritional Facts', '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(61, 'dummy.png', 29, 'Thumbnail', '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(62, 'dummy.png', 29, 'Nutritional Facts', '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(63, 'dummy.png', 30, 'Thumbnail', '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(64, 'dummy.png', 30, 'Nutritional Facts', '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(65, 'dummy.png', 31, 'Thumbnail', '2024-08-29 10:07:14', '2024-08-29 10:07:14'),
(66, 'dummy.png', 31, 'Nutritional Facts', '2024-08-29 10:07:14', '2024-08-29 10:07:14'),
(67, 'copy_t7CaYmOE2EJOXf4aCZWyEBnmOksSMH.png', 32, 'Thumbnail', '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(68, 'copy_U0UBkuGtt8lGoH6YsD6HINjFCGy5XQ.png', 32, 'Nutritional Facts', '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(69, 'dummy.png', 33, 'Thumbnail', '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(70, 'dummy.png', 33, 'Nutritional Facts', '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(71, 'dummy.png', 34, 'Thumbnail', '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(72, 'dummy.png', 34, 'Nutritional Facts', '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(73, 'copy_RUTsqQlhVWN8zoEnvhxPPRHVaWw4NR.png', 35, 'Thumbnail', '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(74, 'dummy.png', 35, 'Nutritional Facts', '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(75, 'copy_eReUWIuAQFsQuQi4OCkZSHkfKXMlN1.png', 36, 'Thumbnail', '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(76, 'dummy.png', 36, 'Nutritional Facts', '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(77, 'copy_94j5jR1UUjiHM1c6fRX23lEvz0vs0F.png', 37, 'Thumbnail', '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(78, 'dummy.png', 37, 'Nutritional Facts', '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(79, 'copy_BrJjM7WTdvhlP8IZfHOErk2XTlqQ9k.png', 38, 'Thumbnail', '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(80, 'dummy.png', 38, 'Nutritional Facts', '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(81, 'copy_VXThJkC1qpF7Ql3ntnLLq7e4ZPHMRa.png', 39, 'Thumbnail', '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(82, 'dummy.png', 39, 'Nutritional Facts', '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(83, 'copy_2WDLzbr6rE8RLm2GmckQttFo1uSn2P.png', 40, 'Thumbnail', '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(84, 'copy_It2K8F8Q0194ALTBWVUyq0TZYz7eq5.png', 40, 'Nutritional Facts', '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(85, 'copy_Yj5BRaLxI9giE2hXwY9uzOrqzbaBiI.png', 41, 'Thumbnail', '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(86, 'dummy.png', 41, 'Nutritional Facts', '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(87, 'copy_eFZ3H8ttNpi0iu0oySwFvas8YBL08r.png', 42, 'Thumbnail', '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(88, 'copy_3MLP0NwClmlFIZIE6sBaGKJhWG7yuC.png', 42, 'Nutritional Facts', '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(89, 'copy_JRggbUr0Hs1pJeY8T3dbS0RaUWwjLc.png', 43, 'Thumbnail', '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(90, 'copy_flh9jYat9fhnBKNRkkUfNQwUxJBpoP.png', 43, 'Nutritional Facts', '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(91, 'copy_FmuhObis2J7VRwa5NWJICKefqw63EG.png', 44, 'Thumbnail', '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(92, 'copy_KGCSCe7MFuJ9YOElfiDU3u29COWCZf.png', 44, 'Nutritional Facts', '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(93, 'dummy.png', 45, 'Thumbnail', '2024-08-29 10:08:33', '2024-08-29 10:08:33'),
(94, 'dummy.png', 45, 'Nutritional Facts', '2024-08-29 10:08:33', '2024-08-29 10:08:33'),
(95, 'dummy.png', 46, 'Thumbnail', '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(96, 'dummy.png', 46, 'Nutritional Facts', '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(97, 'copy_9WUjUqOhKnG1G7O6eemW7CTBnWkGnV.png', 47, 'Thumbnail', '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(98, 'copy_Q7Lw2DXTOECntN9UIEsVBzupPfdZx1.png', 47, 'Nutritional Facts', '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(99, 'copy_9WUjUqOhKnG1G7O6eemW7CTBnWkGnV.png', 48, 'Thumbnail', '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(100, 'copy_Q7Lw2DXTOECntN9UIEsVBzupPfdZx1.png', 48, 'Nutritional Facts', '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(101, 'dummy.png', 49, 'Thumbnail', '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(102, 'dummy.png', 49, 'Nutritional Facts', '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(103, 'dummy.png', 50, 'Thumbnail', '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(104, 'dummy.png', 50, 'Nutritional Facts', '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(105, 'dummy.png', 51, 'Thumbnail', '2024-08-29 10:09:07', '2024-08-29 10:09:07'),
(106, 'dummy.png', 51, 'Nutritional Facts', '2024-08-29 10:09:08', '2024-08-29 10:09:08'),
(107, 'dummy.png', 52, 'Thumbnail', '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(108, 'dummy.png', 52, 'Nutritional Facts', '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(109, 'dummy.png', 53, 'Thumbnail', '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(110, 'dummy.png', 53, 'Nutritional Facts', '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(111, 'dummy.png', 54, 'Thumbnail', '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(112, 'dummy.png', 54, 'Nutritional Facts', '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(113, 'dummy.png', 55, 'Thumbnail', '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(114, 'dummy.png', 55, 'Nutritional Facts', '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(115, 'dummy.png', 56, 'Thumbnail', '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(116, 'dummy.png', 56, 'Nutritional Facts', '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(117, 'dummy.png', 57, 'Thumbnail', '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(118, 'dummy.png', 57, 'Nutritional Facts', '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(119, 'dummy.png', 58, 'Thumbnail', '2024-08-29 10:11:57', '2024-08-29 10:11:57'),
(120, 'dummy.png', 58, 'Nutritional Facts', '2024-08-29 10:11:58', '2024-08-29 10:11:58'),
(121, 'dummy.png', 59, 'Thumbnail', '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(122, 'dummy.png', 59, 'Nutritional Facts', '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(123, 'dummy.png', 60, 'Thumbnail', '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(124, 'dummy.png', 60, 'Nutritional Facts', '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(125, 'dummy.png', 61, 'Thumbnail', '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(126, 'dummy.png', 61, 'Nutritional Facts', '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(127, 'dummy.png', 62, 'Thumbnail', '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(128, 'dummy.png', 62, 'Nutritional Facts', '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(129, 'dummy.png', 63, 'Thumbnail', '2024-08-29 10:12:11', '2024-08-29 10:12:11'),
(130, 'dummy.png', 63, 'Nutritional Facts', '2024-08-29 10:12:12', '2024-08-29 10:12:12'),
(131, 'dummy.png', 64, 'Thumbnail', '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(132, 'dummy.png', 64, 'Nutritional Facts', '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(133, 'dummy.png', 65, 'Thumbnail', '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(134, 'dummy.png', 65, 'Nutritional Facts', '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(135, 'dummy.png', 66, 'Thumbnail', '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(136, 'dummy.png', 66, 'Nutritional Facts', '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(137, 'dummy.png', 67, 'Thumbnail', '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(138, 'dummy.png', 67, 'Nutritional Facts', '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(139, 'dummy.png', 68, 'Thumbnail', '2024-08-29 10:12:26', '2024-08-29 10:12:26'),
(140, 'dummy.png', 68, 'Nutritional Facts', '2024-08-29 10:12:26', '2024-08-29 10:12:26'),
(141, 'dummy.png', 69, 'Thumbnail', '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(142, 'dummy.png', 69, 'Nutritional Facts', '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(143, 'dummy.png', 70, 'Thumbnail', '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(144, 'dummy.png', 70, 'Nutritional Facts', '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(145, 'dummy.png', 71, 'Thumbnail', '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(146, 'dummy.png', 71, 'Nutritional Facts', '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(147, 'dummy.png', 72, 'Thumbnail', '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(148, 'dummy.png', 72, 'Nutritional Facts', '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(149, 'dummy.png', 73, 'Thumbnail', '2024-08-29 10:12:46', '2024-08-29 10:12:46'),
(150, 'dummy.png', 73, 'Nutritional Facts', '2024-08-29 10:12:47', '2024-08-29 10:12:47'),
(151, 'dummy.png', 74, 'Thumbnail', '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(152, 'dummy.png', 74, 'Nutritional Facts', '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(153, 'dummy.png', 75, 'Thumbnail', '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(154, 'dummy.png', 75, 'Nutritional Facts', '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(155, 'dummy.png', 76, 'Thumbnail', '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(156, 'dummy.png', 76, 'Nutritional Facts', '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(157, 'dummy.png', 77, 'Thumbnail', '2024-08-29 10:12:58', '2024-08-29 10:12:58'),
(158, 'dummy.png', 77, 'Nutritional Facts', '2024-08-29 10:12:58', '2024-08-29 10:12:58'),
(159, 'dummy.png', 78, 'Thumbnail', '2024-08-29 10:13:00', '2024-08-29 10:13:00'),
(160, 'dummy.png', 78, 'Nutritional Facts', '2024-08-29 10:13:01', '2024-08-29 10:13:01'),
(161, 'dummy.png', 79, 'Thumbnail', '2024-08-29 10:13:03', '2024-08-29 10:13:03'),
(162, 'dummy.png', 79, 'Nutritional Facts', '2024-08-29 10:13:04', '2024-08-29 10:13:04'),
(163, 'dummy.png', 80, 'Thumbnail', '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(164, 'dummy.png', 80, 'Nutritional Facts', '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(165, 'dummy.png', 81, 'Thumbnail', '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(166, 'dummy.png', 81, 'Nutritional Facts', '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(167, 'dummy.png', 82, 'Thumbnail', '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(168, 'dummy.png', 82, 'Thumbnail', '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(169, 'dummy.png', 82, 'Nutritional Facts', '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(170, 'dummy.png', 82, 'Nutritional Facts', '2024-08-29 10:13:07', '2024-08-29 10:13:07'),
(171, 'dummy.png', 83, 'Thumbnail', '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(172, 'dummy.png', 83, 'Nutritional Facts', '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(173, 'dummy.png', 84, 'Thumbnail', '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(174, 'dummy.png', 84, 'Nutritional Facts', '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(175, 'dummy.png', 85, 'Thumbnail', '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(176, 'dummy.png', 85, 'Nutritional Facts', '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(177, 'dummy.png', 86, 'Thumbnail', '2024-08-29 10:13:18', '2024-08-29 10:13:18'),
(178, 'dummy.png', 86, 'Nutritional Facts', '2024-08-29 10:13:18', '2024-08-29 10:13:18'),
(179, 'dummy.png', 87, 'Thumbnail', '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(180, 'dummy.png', 87, 'Nutritional Facts', '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(181, 'dummy.png', 88, 'Thumbnail', '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(182, 'dummy.png', 88, 'Nutritional Facts', '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(183, 'dummy.png', 89, 'Thumbnail', '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(184, 'dummy.png', 89, 'Nutritional Facts', '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(185, 'dummy.png', 90, 'Thumbnail', '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(186, 'dummy.png', 90, 'Nutritional Facts', '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(328, 'dummy.png', 91, 'Nutritional Facts', '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(327, 'dummy.png', 91, 'Thumbnail', '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(425, 'J6EN3LyXppWy6UgcNuCbSacuAE2X7X.jpeg', 92, 'Extra Image', '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(424, 'copy_gVpsskKL7uMlxvkTVJtyJdgRBTOJyz.png', 92, 'Thumbnail', '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(428, 'copy_9e8VmrMYxaEZ6nRNxsUJSz6OghNDt0.png', 93, 'Thumbnail', '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(427, 'LjKF2ZrNZGzBxeRIas8DtdAryQmCEU.jpeg', 93, 'Extra Image', '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(431, 'copy_MEVwXprSQfwxAqTeUiENaO7a7u5UCs.png', 94, 'Thumbnail', '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(430, 'NeXyCpC5H2FHcF3aIxhnK2nHvzc6zi.jpeg', 94, 'Extra Image', '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(434, 'copy_savloZFqhHQxXfTl6cNUOSa0Dkfhi5.png', 95, 'Thumbnail', '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(433, 'ADMdzJ5r7Ud6uaPuyhAkoqA9ekJsI6.jpeg', 95, 'Extra Image', '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(437, 'copy_JljmPxz5DNtXwJVNJs75XN2aJZNXna.png', 96, 'Thumbnail', '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(436, 'yy6XFUjGle14jPV7pBxQLfxHlFlXan.jpeg', 96, 'Extra Image', '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(440, 'copy_DCcCJLEDbzOPTLheNug9I3cxt8SYOH.png', 97, 'Thumbnail', '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(439, 'VBkA0tUF6sUUCDGIbSd0GmzZ2txy1a.jpeg', 97, 'Extra Image', '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(443, 'copy_WXIZEKCp66imlppDxuF9wmt2mdnHvz.png', 98, 'Thumbnail', '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(442, 'x6wpgfjaVUnAFBSa38yqRot0VRIuRD.jpeg', 98, 'Extra Image', '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(423, 'copy_7jCR8OUf8TiS8sZgqccjz9nWifYVdw.png', 92, 'Nutritional Facts', '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(392, '4P5lXz3mOmpn0IuKJlTJ1NONHr5yPI.jpeg', 174, 'Nutritional Facts', '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(208, 'copy_WZytGTLAJnklganlmoJvOBDyhbkP8z.png', 100, 'Nutritional Facts', '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(207, 'copy_MD94LxIkE6DZvrHYouyNneHwGtU7Rq.png', 100, 'Thumbnail', '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(391, '176DhQpxJ22WgQnvhu0SzNeUAYckFX.jpeg', 174, 'Thumbnail', '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(211, 'dummy.png', 102, 'Thumbnail', '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(212, 'dummy.png', 102, 'Nutritional Facts', '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(213, 'copy_MD94LxIkE6DZvrHYouyNneHwGtU7Rq.png', 103, 'Thumbnail', '2024-08-29 10:14:08', '2024-08-29 10:14:08'),
(214, 'copy_WZytGTLAJnklganlmoJvOBDyhbkP8z.png', 103, 'Nutritional Facts', '2024-08-29 10:14:08', '2024-08-29 10:14:08'),
(215, 'copy_8Mw7p6COaeStyAVwnDXLN4PB22wEMN.png', 104, 'Thumbnail', '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(216, 'copy_Lw2Dy2E9Vb8tjuvWUEcc0gz5PoIo8Q.png', 104, 'Nutritional Facts', '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(217, 'copy_8Mw7p6COaeStyAVwnDXLN4PB22wEMN.png', 105, 'Thumbnail', '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(218, 'copy_Lw2Dy2E9Vb8tjuvWUEcc0gz5PoIo8Q.png', 105, 'Nutritional Facts', '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(219, 'copy_l4rIfj12F3RJDabU6qrtZDYWIGGD6Y.png', 106, 'Thumbnail', '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(220, 'copy_BkGPHshbxE8c6IAlpsn3TRoK8HQVJV.png', 106, 'Nutritional Facts', '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(221, 'copy_l4rIfj12F3RJDabU6qrtZDYWIGGD6Y.png', 107, 'Thumbnail', '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(222, 'copy_BkGPHshbxE8c6IAlpsn3TRoK8HQVJV.png', 107, 'Nutritional Facts', '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(223, 'copy_fxM94i0lDgVETOjvgjhdJ1WS3VODfp.png', 108, 'Thumbnail', '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(224, 'copy_eADHLuhYah6rLWufIJ04brxcPJXica.png', 108, 'Nutritional Facts', '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(225, 'copy_fxM94i0lDgVETOjvgjhdJ1WS3VODfp.png', 109, 'Thumbnail', '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(226, 'copy_eADHLuhYah6rLWufIJ04brxcPJXica.png', 109, 'Nutritional Facts', '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(326, 'copy_lYWoI8kJomdKgeVtLYY5ag2iPfYQcf.png', 110, 'Nutritional Facts', '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(325, 'copy_C74AB6SwkbpQolFwVum7m5rrp6NEod.png', 110, 'Thumbnail', '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(229, 'copy_9BcBlDPR2wosDaSS3tBzhmU77BSIS5.png', 111, 'Thumbnail', '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(230, 'copy_o2007nLkhJBzqCcknLJEUPNuUgLVPu.png', 111, 'Nutritional Facts', '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(231, 'copy_9BcBlDPR2wosDaSS3tBzhmU77BSIS5.png', 112, 'Thumbnail', '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(232, 'copy_o2007nLkhJBzqCcknLJEUPNuUgLVPu.png', 112, 'Nutritional Facts', '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(233, 'copy_ujjJLRikJFeb2KOXhCt3H5cZPZww0m.png', 113, 'Thumbnail', '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(234, 'dummy.png', 113, 'Nutritional Facts', '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(235, 'copy_ujjJLRikJFeb2KOXhCt3H5cZPZww0m.png', 114, 'Thumbnail', '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(236, 'dummy.png', 114, 'Nutritional Facts', '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(237, 'copy_KDU7vRPGuSRJxR40jrfx5m45L69wHN.png', 115, 'Thumbnail', '2024-08-29 10:14:59', '2024-08-29 10:14:59'),
(238, 'dummy.png', 115, 'Nutritional Facts', '2024-08-29 10:15:00', '2024-08-29 10:15:00'),
(239, 'copy_KDU7vRPGuSRJxR40jrfx5m45L69wHN.png', 116, 'Thumbnail', '2024-08-29 10:15:04', '2024-08-29 10:15:04'),
(240, 'dummy.png', 116, 'Nutritional Facts', '2024-08-29 10:15:05', '2024-08-29 10:15:05'),
(243, 'copy_Anbr8HGmLBGVLKYZlxUShwhJ5c0Rly.png', 117, 'Thumbnail', '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(244, 'dummy.png', 117, 'Nutritional Facts', '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(245, 'copy_EhNA3Oh78hnMmVD0QrG9uk5h3J26Pl.png', 118, 'Thumbnail', '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(246, 'copy_PO0X6EF653fN7GwRGT02Rfcyndorbm.png', 118, 'Nutritional Facts', '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(247, 'copy_Anbr8HGmLBGVLKYZlxUShwhJ5c0Rly.png', 119, 'Thumbnail', '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(248, 'dummy.png', 119, 'Nutritional Facts', '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(249, 'copy_EhNA3Oh78hnMmVD0QrG9uk5h3J26Pl.png', 120, 'Thumbnail', '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(250, 'copy_PO0X6EF653fN7GwRGT02Rfcyndorbm.png', 120, 'Nutritional Facts', '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(251, 'copy_xrJIUEHjl8UOAcUcK9Sh273qs6PizC.png', 121, 'Thumbnail', '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(252, 'copy_l7lu1WJHZt6NuFvbjNGFOV7hHEps0o.png', 121, 'Nutritional Facts', '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(253, 'copy_xrJIUEHjl8UOAcUcK9Sh273qs6PizC.png', 122, 'Thumbnail', '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(254, 'copy_l7lu1WJHZt6NuFvbjNGFOV7hHEps0o.png', 122, 'Nutritional Facts', '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(255, 'copy_C74AB6SwkbpQolFwVum7m5rrp6NEod.png', 123, 'Thumbnail', '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(256, 'copy_lYWoI8kJomdKgeVtLYY5ag2iPfYQcf.png', 123, 'Nutritional Facts', '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(258, 'copy_5LSvHWahssCFkfUHAb3uO6OMTl1Bqh.png', 124, 'Thumbnail', '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(259, 'dummy.png', 124, 'Nutritional Facts', '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(260, 'dummy.png', 124, 'Nutritional Facts', '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(261, 'copy_5LSvHWahssCFkfUHAb3uO6OMTl1Bqh.png', 125, 'Thumbnail', '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(262, 'dummy.png', 125, 'Nutritional Facts', '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(263, 'copy_5LSvHWahssCFkfUHAb3uO6OMTl1Bqh.png', 126, 'Thumbnail', '2024-08-29 10:15:21', '2024-08-29 10:15:21'),
(264, 'dummy.png', 126, 'Nutritional Facts', '2024-08-29 10:15:22', '2024-08-29 10:15:22'),
(265, 'copy_5LSvHWahssCFkfUHAb3uO6OMTl1Bqh.png', 127, 'Thumbnail', '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(266, 'dummy.png', 127, 'Nutritional Facts', '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(298, 'copy_K1QF9AMUUt6cpTyv3mkwbdz3i81DKe.png', 128, 'Nutritional Facts', '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(297, 'copy_QLuTVzLKdVgyjo9ZGiuGnNz9Y5z0zw.png', 128, 'Thumbnail', '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(269, 'copy_VKayvDS8AkgQr5u14k8vRssw4eRL5Y.png', 129, 'Thumbnail', '2024-08-29 10:15:50', '2024-08-29 10:15:50'),
(270, 'dummy.png', 129, 'Nutritional Facts', '2024-08-29 10:15:51', '2024-08-29 10:15:51'),
(271, 'copy_VKayvDS8AkgQr5u14k8vRssw4eRL5Y.png', 130, 'Thumbnail', '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(272, 'dummy.png', 130, 'Nutritional Facts', '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(273, 'copy_VKayvDS8AkgQr5u14k8vRssw4eRL5Y.png', 131, 'Thumbnail', '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(274, 'dummy.png', 131, 'Nutritional Facts', '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(275, 'copy_z2ux1tuDc6n0xsvgQKcQw7HWN2ZtFt.png', 132, 'Thumbnail', '2024-08-29 10:15:58', '2024-08-29 10:15:58'),
(276, 'dummy.png', 132, 'Nutritional Facts', '2024-08-29 10:15:59', '2024-08-29 10:15:59'),
(277, 'copy_z2ux1tuDc6n0xsvgQKcQw7HWN2ZtFt.png', 133, 'Thumbnail', '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(278, 'dummy.png', 133, 'Nutritional Facts', '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(281, 'copy_z2ux1tuDc6n0xsvgQKcQw7HWN2ZtFt.png', 134, 'Thumbnail', '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(282, 'dummy.png', 134, 'Nutritional Facts', '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(283, 'copy_VKayvDS8AkgQr5u14k8vRssw4eRL5Y.png', 135, 'Thumbnail', '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(284, 'dummy.png', 135, 'Nutritional Facts', '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(285, 'copy_YpWk8fCcXdfYeXziZMoPMxU2JqycGy.png', 136, 'Thumbnail', '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(286, 'dummy.png', 136, 'Nutritional Facts', '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(288, 'copy_z2ux1tuDc6n0xsvgQKcQw7HWN2ZtFt.png', 137, 'Thumbnail', '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(289, 'dummy.png', 137, 'Nutritional Facts', '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(290, 'dummy.png', 137, 'Nutritional Facts', '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(291, 'copy_YpWk8fCcXdfYeXziZMoPMxU2JqycGy.png', 138, 'Thumbnail', '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(292, 'dummy.png', 138, 'Nutritional Facts', '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(293, 'copy_YpWk8fCcXdfYeXziZMoPMxU2JqycGy.png', 139, 'Thumbnail', '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(294, 'dummy.png', 139, 'Nutritional Facts', '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(295, 'copy_QLuTVzLKdVgyjo9ZGiuGnNz9Y5z0zw.png', 140, 'Thumbnail', '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(296, 'copy_K1QF9AMUUt6cpTyv3mkwbdz3i81DKe.png', 140, 'Nutritional Facts', '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(299, 'copy_ptoBS02uGyR2KIxPjMZqvSE73xeCif.png', 141, 'Thumbnail', '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(300, 'dummy.png', 141, 'Nutritional Facts', '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(301, 'copy_ptoBS02uGyR2KIxPjMZqvSE73xeCif.png', 142, 'Thumbnail', '2024-08-29 10:16:12', '2024-08-29 10:16:12'),
(302, 'dummy.png', 142, 'Nutritional Facts', '2024-08-29 10:16:13', '2024-08-29 10:16:13'),
(303, 'copy_ptoBS02uGyR2KIxPjMZqvSE73xeCif.png', 143, 'Thumbnail', '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(304, 'dummy.png', 143, 'Nutritional Facts', '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(305, 'copy_ptoBS02uGyR2KIxPjMZqvSE73xeCif.png', 144, 'Thumbnail', '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(306, 'dummy.png', 144, 'Nutritional Facts', '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(323, 'copy_g9fzw4KA2RphnBjJGK9aW7eNhanAXC.png', 145, 'Thumbnail', '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(309, 'copy_HvB4uifdAwc3hzUrSuJrpXJtx1tGQL.png', 146, 'Thumbnail', '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(310, 'dummy.png', 146, 'Nutritional Facts', '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(311, 'copy_HvB4uifdAwc3hzUrSuJrpXJtx1tGQL.png', 147, 'Thumbnail', '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(312, 'dummy.png', 147, 'Nutritional Facts', '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(313, 'copy_HvB4uifdAwc3hzUrSuJrpXJtx1tGQL.png', 148, 'Thumbnail', '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(314, 'dummy.png', 148, 'Nutritional Facts', '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(315, 'copy_HvB4uifdAwc3hzUrSuJrpXJtx1tGQL.png', 149, 'Thumbnail', '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(316, 'dummy.png', 149, 'Nutritional Facts', '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(317, 'copy_g9fzw4KA2RphnBjJGK9aW7eNhanAXC.png', 150, 'Thumbnail', '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(318, 'dummy.png', 150, 'Nutritional Facts', '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(319, 'copy_g9fzw4KA2RphnBjJGK9aW7eNhanAXC.png', 151, 'Thumbnail', '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(320, 'dummy.png', 151, 'Nutritional Facts', '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(321, 'copy_g9fzw4KA2RphnBjJGK9aW7eNhanAXC.png', 152, 'Thumbnail', '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(322, 'dummy.png', 152, 'Nutritional Facts', '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(324, 'dummy.png', 145, 'Nutritional Facts', '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(329, 'copy_gUpdqAwxWgaw0oNg69ZPOx6Qs8erFt.png', 153, 'Thumbnail', '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(330, 'dummy.png', 153, 'Nutritional Facts', '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(331, 'copy_gUpdqAwxWgaw0oNg69ZPOx6Qs8erFt.png', 154, 'Thumbnail', '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(332, 'dummy.png', 154, 'Nutritional Facts', '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(333, 'copy_gUpdqAwxWgaw0oNg69ZPOx6Qs8erFt.png', 155, 'Thumbnail', '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(334, 'dummy.png', 155, 'Nutritional Facts', '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(335, 'copy_gUpdqAwxWgaw0oNg69ZPOx6Qs8erFt.png', 156, 'Thumbnail', '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(336, 'dummy.png', 156, 'Nutritional Facts', '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(337, 'copy_svpMnPUr4o75cEngm4sutnG1WYkk3b.png', 157, 'Thumbnail', '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(338, 'dummy.png', 157, 'Nutritional Facts', '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(339, 'copy_svpMnPUr4o75cEngm4sutnG1WYkk3b.png', 158, 'Thumbnail', '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(340, 'dummy.png', 158, 'Nutritional Facts', '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(341, 'copy_svpMnPUr4o75cEngm4sutnG1WYkk3b.png', 159, 'Thumbnail', '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(342, 'dummy.png', 159, 'Nutritional Facts', '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(343, 'copy_svpMnPUr4o75cEngm4sutnG1WYkk3b.png', 160, 'Thumbnail', '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(344, 'dummy.png', 160, 'Nutritional Facts', '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(345, 'copy_nQrojtVPvS4AiShvGH5dNg6MZki00d.png', 161, 'Thumbnail', '2024-08-29 10:17:59', '2024-08-29 10:17:59'),
(346, 'dummy.png', 161, 'Nutritional Facts', '2024-08-29 10:18:00', '2024-08-29 10:18:00'),
(373, 'copy_nQrojtVPvS4AiShvGH5dNg6MZki00d.png', 162, 'Thumbnail', '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(350, 'copy_nQrojtVPvS4AiShvGH5dNg6MZki00d.png', 163, 'Thumbnail', '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(351, 'dummy.png', 163, 'Nutritional Facts', '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(352, 'dummy.png', 163, 'Nutritional Facts', '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(353, 'copy_nQrojtVPvS4AiShvGH5dNg6MZki00d.png', 164, 'Thumbnail', '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(354, 'dummy.png', 164, 'Nutritional Facts', '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(355, 'copy_PjcnnRKmlT1Kps1wbDVqrMaiwDCDsr.png', 165, 'Thumbnail', '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(356, 'dummy.png', 165, 'Nutritional Facts', '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(357, 'copy_Fzc1Ugegl7ErncH68beDdar9ecM4Ko.png', 166, 'Thumbnail', '2024-08-29 10:18:13', '2024-08-29 10:18:13'),
(358, 'dummy.png', 166, 'Nutritional Facts', '2024-08-29 10:18:14', '2024-08-29 10:18:14'),
(359, 'copy_mPKDEZenD8I2tPVvNnufjeWQhWZPSV.png', 167, 'Thumbnail', '2024-08-29 10:18:16', '2024-08-29 10:18:16'),
(360, 'dummy.png', 167, 'Nutritional Facts', '2024-08-29 10:18:17', '2024-08-29 10:18:17'),
(361, 'copy_h42vtEu8Is2DYKlag2fdT6mRi7AGUn.png', 168, 'Thumbnail', '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(362, 'dummy.png', 168, 'Nutritional Facts', '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(363, 'copy_PvqalCnHTLjVm4sFbLLZLYXSK4cUwC.png', 169, 'Thumbnail', '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(364, 'dummy.png', 169, 'Nutritional Facts', '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(365, 'copy_LPTcsK5jf6cevczBxxW4TLfNZxevMm.png', 170, 'Thumbnail', '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(366, 'dummy.png', 170, 'Nutritional Facts', '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(367, 'copy_qizNgtr4MUvc4QhEKvB1vRIPMIWR9S.png', 171, 'Thumbnail', '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(368, 'dummy.png', 171, 'Nutritional Facts', '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(369, 'dummy.png', 172, 'Thumbnail', '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(370, 'dummy.png', 172, 'Nutritional Facts', '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(426, 'copy_y8ioXQ074efAkaVoJQjKFSjuYu66xr.png', 93, 'Nutritional Facts', '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(374, 'dummy.png', 162, 'Nutritional Facts', '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(378, 'dummy.png', 21, 'Nutritional Facts', '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(385, 'copy_azjPwK26lJagiVy8I8CcOEmQgAc7JP.png', 1, 'Nutritional Facts', '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(429, 'copy_9fhqkFJza0m9hLdxAghhMHe6L5l96t.png', 94, 'Nutritional Facts', '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(432, 'copy_cUimUVvA9niQiXAnZDy7GPjTimiUOv.png', 95, 'Nutritional Facts', '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(435, 'copy_5wQNAmNe6tdJ7v5V6WXwaXvkGzeA3E.png', 96, 'Nutritional Facts', '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(438, 'copy_yB82x7G1dhsSRjL0l20Kbm3c9e6Pra.png', 97, 'Nutritional Facts', '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(441, 'copy_CeQopW6Bxq3kyxSuPofp8FkJJCxC9o.png', 98, 'Nutritional Facts', '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(451, 'JomLqtLRnrj2SLs4f9XtjorQDASkJH.jpeg', 176, 'Thumbnail', '2024-09-13 10:38:45', '2024-09-13 10:38:45'),
(450, 'pEpm9YftuqALbOPR0CuWbuiwiZxUzM.jpeg', 176, 'Nutritional Facts', '2024-09-13 10:38:45', '2024-09-13 10:38:45'),
(452, 'kUck641Rmc6yeg95DjYnZHRdQFq7Gx.jpeg', 177, 'Nutritional Facts', '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(453, 'c2GOVJk9mJ2IcAqwBfz2QbsKQ8xfpQ.jpeg', 177, 'Thumbnail', '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(454, 'B9RU2QaRalE4xLw9rlTJ2vd3wwIitS.jpeg', 178, 'Thumbnail', '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(455, 'CFO5i6zu02P2KWPjLyiYIZFpjaHuof.jpeg', 178, 'Nutritional Facts', '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(456, 'Nha5DTfS66HwQM6IW6iHoOOAjo2JQP.jpeg', 179, 'Thumbnail', '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(457, 'dYzEko4UZaNXpJ0K1loC7OWeU2l2iH.jpeg', 179, 'Nutritional Facts', '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(458, 'hOxMbXnrOZ6W3QP8fpcccChcq6GW1x.jpeg', 180, 'Nutritional Facts', '2024-09-13 10:39:34', '2024-09-13 10:39:34'),
(459, 'rMpVhqRjvTK3tahAymc6PnvJhKm4M2.jpeg', 180, 'Thumbnail', '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_images_old`
--

CREATE TABLE `product_images_old` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_pages`
--

CREATE TABLE `product_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `h1` varchar(256) DEFAULT NULL,
  `slug` varchar(256) NOT NULL,
  `seo_title` varchar(256) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `seo_keywords` varchar(256) DEFAULT NULL,
  `published` int(11) NOT NULL DEFAULT 1,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keyword` varchar(128) DEFAULT NULL,
  `keyword_slug` varchar(128) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_slug` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_pages`
--

INSERT INTO `product_pages` (`id`, `master_id`, `title`, `h1`, `slug`, `seo_title`, `seo_description`, `seo_keywords`, `published`, `company_id`, `keyword`, `keyword_slug`, `category_id`, `category_slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 3051, 'cvgjgfj fh', 'dfghfdh', 'cvgjgfj-fh', NULL, NULL, NULL, 1, 3, 'Toronto', 'toronto', 63, 'frozen', NULL, '2024-08-19 09:58:23', '2024-08-19 09:58:23'),
(2, 3054, 'cvgjgfj fh', 'dfghfdh', 'cvgjgfj-fh', NULL, NULL, NULL, 1, 3, 'Toronto', 'toronto', 64, 'packaging', 3051, '2024-08-19 09:58:27', '2024-08-19 09:58:27'),
(3, 3052, 'cvgjgfj fh', 'dfghfdh', 'cvgjgfj-fh', NULL, NULL, NULL, 1, 3, 'Ontario', 'ontario', 63, 'frozen', 3051, '2024-08-19 09:58:34', '2024-08-19 09:58:34'),
(4, 3053, 'cvgjgfj fh', 'dfghfdh', 'cvgjgfj-fh', NULL, NULL, NULL, 1, 3, 'Ontario', 'ontario', 64, 'packaging', 3051, '2024-08-19 09:58:43', '2024-08-19 09:58:43'),
(5, 3050, 'fdg', 'dfg', 'fdg', NULL, NULL, NULL, 1, 3, 'Toronto', 'toronto', 63, 'frozen', NULL, '2024-08-19 09:58:53', '2024-08-19 09:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_page_categories`
--

CREATE TABLE `product_page_categories` (
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_page_contents`
--

CREATE TABLE `product_page_contents` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `type` enum('content','product','banner','card') NOT NULL DEFAULT 'content',
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_shippings`
--

CREATE TABLE `product_shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_specializations`
--

CREATE TABLE `product_specializations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) DEFAULT NULL,
  `sku` text DEFAULT NULL,
  `variation` varchar(250) DEFAULT NULL,
  `variation_name` text DEFAULT NULL,
  `box_quantity` int(11) DEFAULT NULL,
  `in_store` int(11) DEFAULT 0,
  `online` int(11) DEFAULT 0,
  `weight` varchar(255) DEFAULT NULL,
  `in_stock` varchar(255) DEFAULT NULL,
  `stock_status` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL,
  `serving` varchar(255) DEFAULT NULL,
  `cook_time` varchar(255) DEFAULT NULL,
  `energy` varchar(255) DEFAULT NULL,
  `vegan` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `ingredients` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `special_price` double(32,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `master_id`, `product_id`, `sku`, `variation`, `variation_name`, `box_quantity`, `in_store`, `online`, `weight`, `in_stock`, `stock_status`, `price`, `serving`, `cook_time`, `energy`, `vegan`, `description`, `ingredients`, `status`, `special_price`, `created_at`, `updated_at`) VALUES
(4, 3308, 2, 'JMJQC9', NULL, '9 Inch Jalapeno Monterey Jack Frozen / Baked', 1, 0, 1, '750gm', '1', 1, 14.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(6, 3310, 4, 'SPKQC9', NULL, '9 Inch Spanakopita Frozen / Baked', 1, 0, 1, '750gm', '1', 1, 14.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(7, 3311, 5, 'GCVQC9', NULL, '9 Inch Goat Cheese And Vegetable Frozen / Baked', 1, 0, 1, '750gm', '1', 1, 14.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(8, 3312, 6, 'GCVQC5', NULL, '5 Inch Goat Cheese And Vegetable Frozen / Baked', 1, 0, 1, '185gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(9, 3313, 7, 'STASV', NULL, '9 Inch  Steak and Ale Pie Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(10, 3314, 8, 'STASVFZN', NULL, '5 Inch Steak and Ale Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(11, 3315, 9, 'PLPSV', NULL, '9 Inch Pulled Pork Pie 9 Inch Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(12, 3316, 10, 'PLPSVFZN', NULL, '5 Inch Pulled Pork Pie Frozen', 1, 0, 1, '0gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(13, 3317, 11, 'SBCSV', NULL, '9 Inch Spicy Beef Curry Pie Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(14, 3318, 12, 'SBCSVFZN', NULL, '5 Inch Spicy Beef Curry Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(15, 3319, 13, 'BBSSV', NULL, '9 Inch Braised Beef Short Rib Pie Frozen', 1, 0, 1, '0gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(16, 3320, 14, 'BBSSVFZN', NULL, '5 Inch Braised Beef Short Rib Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(17, 3321, 15, 'CPPSV', NULL, '9 Inch Chicken Pot Pie Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(18, 3322, 16, 'CPPSVFZN', NULL, '5 Inch Chicken Pot Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(19, 3323, 17, 'MPPSV', NULL, '9 Inch Frozen Mushroom Pot Pie Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(20, 3324, 18, 'MPPSVFZN', NULL, '5 Inch Frozen Mushroom Pot Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(21, 3325, 19, 'STMSV', NULL, '9 Inch Frozen Soy Tikka Masala Pie Frozen', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(22, 3326, 20, 'STMSVFZN', NULL, '5 Inch Soy Tikka Masala Pie Frozen', 1, 0, 1, '225gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(24, 3328, 22, 'CCBBG', NULL, 'Cheesecake Bars Slab Frozen Baked ready to serve', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(25, 3329, 23, 'BPBBG', NULL, 'Banana/Pumpkin Bread Loaf Frozen Baked ready', 1, 0, 1, '450gm', '1', 1, 12.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(26, 3330, 24, 'DSQBG', NULL, 'Date Squares Baked Ready to Serve Baked /Frozen', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(27, 3331, 25, 'BTTBG4', NULL, 'Original Butter Tarts 24Pcs', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(28, 3332, 26, 'BTTBG6', NULL, 'Bourbon Butter Tarts 24Pcs', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(29, 3333, 27, 'BTTBG12', NULL, 'Raisin Butter Tarts 24Pcs', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(30, 3334, 28, 'COFCDL', NULL, 'Iced Coffee Large 20 oz', 1, 0, 1, '0gm', '1', 1, 4.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(31, 3335, 29, 'COFCDM', NULL, 'Iced Coffee Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 3.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(32, 3336, 30, 'LATCDL', NULL, 'Iced Lattes Large 20 oz', 1, 0, 1, '0gm', '1', 1, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(33, 3337, 31, 'LATCDM', NULL, 'Iced Lattes Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:13', '2024-08-29 10:07:13'),
(34, 3338, 32, 'CRBBG12', NULL, 'Caramel Brownies Baked Ready to Serve Baked / Frozen', 1, 0, 1, '125gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(35, 3339, 33, 'FLVCDL', NULL, 'Iced Flavoured Latte Large 20 oz', 1, 0, 1, '0gm', '1', 1, 5.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(36, 3340, 34, 'FLVCDM', NULL, 'Iced Flavoured Latte Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 4.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(37, 3341, 35, 'GIFTCARD75', NULL, 'GIFT CARD $75', 1, 0, 1, '0gm', '1', 1, 75.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(38, 3342, 36, 'Greeting-card-001', NULL, 'Greeting Card', 1, 0, 1, '0gm', '1', 1, 25.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(39, 3343, 37, 'GIFTCARD25', NULL, 'GIFT CARD $25', 1, 0, 1, '0gm', '1', 1, 25.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(40, 3344, 38, 'GIFTCARD50', NULL, 'GIFT CARD $50', 1, 0, 1, '0gm', '1', 1, 50.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(41, 3345, 39, 'GIFTCARD100', NULL, 'GIFT CARD $100', 1, 0, 1, '0gm', '1', 1, 100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(42, 3346, 40, 'RDVCJ', NULL, 'Red Velvet  Cake Jars Frozen / Baked', 1, 0, 1, '0gm', '1', 1, 4.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(43, 3347, 41, 'BDCCJ', NULL, 'Birthday  Cake Jars Baked /Frozen', 1, 0, 1, '0gm', '1', 1, 4.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(44, 3348, 42, 'CCFCJ', NULL, 'Chocolate Fudge Cake  Jars Baked / Frozen', 1, 0, 1, '185gm', '1', 1, 4.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(45, 3349, 43, 'SBSCJ', NULL, 'Strawberry Shortcake Cake Jars Baked / frozen', 1, 0, 1, '185gm', '1', 1, 4.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(46, 3350, 44, 'CCKCJ4', NULL, 'Carrot Cake Jars Baked / Frozen', 1, 0, 1, '185gm', '1', 1, 4.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(47, 3351, 45, 'CHACDM', NULL, 'Iced Chai Latte Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:32', '2024-08-29 10:08:32'),
(48, 3352, 46, 'CHACDL', NULL, 'Iced Chai Latte Large 20 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(49, 3353, 47, 'ACPQC5', NULL, '5 Inch Aged Cheddar and Pancetta Frozen / Baked', 1, 0, 1, '185gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(50, 3354, 48, 'ACPQC9', NULL, '9 Inch Aged Cheddar and Pancetta Frozen / Baked', 1, 0, 1, '750gm', '1', 1, 14.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(51, 3355, 49, 'CDICCHMOCH16', NULL, 'Iced Matcha Latte Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(52, 3356, 50, 'CDICCHMOCH20', NULL, 'Iced Matcha Latte Large 20 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(53, 3357, 51, 'CDICCHMACH20', NULL, 'Iced Mocha Large 20 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:09:07', '2024-08-29 10:09:07'),
(54, 3358, 52, 'CDICCHMACH16', NULL, 'Iced Mocha Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(55, 3359, 53, 'CDICAMRCNO16', NULL, 'Iced Americano Medium 16 oz', 1, 0, 1, '0gm', '1', 1, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(56, 3360, 54, 'CDICAMRCNO20', NULL, 'Iced Americano Large 20 oz', 1, 0, 1, '0gm', '1', 1, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(57, 3361, 55, 'HDCFFEE10', NULL, 'Coffee 10 oz', 1, 0, 1, '0gm', '1', 1, 2.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(58, 3362, 56, 'HDCFFEE12', NULL, 'Coffee 12 oz', 1, 0, 1, '0gm', '1', 1, 2.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(59, 3363, 57, 'HDCFFEE16', NULL, 'Coffee 16 oz', 1, 0, 1, '0gm', '1', 1, 2.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(60, 3364, 58, 'HDLTTES12', NULL, 'Lattes 12 oz', 1, 0, 1, '0gm', '1', 1, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:11:57', '2024-08-29 10:11:57'),
(61, 3365, 59, 'HDLTTES16', NULL, 'Lattes 16 oz', 1, 0, 1, '0gm', '1', 1, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(62, 3366, 60, 'HDFLVLTTE12', NULL, 'Flavour Latte 12 oz', 1, 0, 1, '0gm', '1', 1, 4.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(63, 3367, 61, 'HDFLVLTTE12', NULL, 'Flavour Latte 16 oz', 1, 0, 1, '0gm', '1', 1, 5.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(64, 3368, 62, 'HDCHILTT12', NULL, 'Chai Latte 12 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(65, 3369, 63, 'HDCHILTT16', NULL, 'Chai Latte 16 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:11', '2024-08-29 10:12:11'),
(66, 3370, 64, 'HDMTHLTTE12', NULL, 'Matcha Latte 12 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(67, 3371, 65, 'HDMTHLTTE16', NULL, 'Matcha Latte 16 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(68, 3372, 66, 'HDGLDNMLK12', NULL, 'Golden Milk 12 oz', 1, 0, 1, '0gm', '1', 1, 4.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(69, 3373, 67, 'HDGLDNMLK12', NULL, 'Golden Milk 16 oz', 1, 0, 1, '0gm', '1', 1, 5.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(70, 3374, 68, 'HDLDNFOG12', NULL, 'London Fog 12 oz', 1, 0, 1, '0gm', '1', 1, 4.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:25', '2024-08-29 10:12:25'),
(71, 3375, 69, 'HDLDNFOG16', NULL, 'London Fog 16 oz', 1, 0, 1, '0gm', '1', 1, 5.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(72, 3376, 70, 'HDMOTCHA12', NULL, 'Mocha 12 oz', 1, 0, 1, '0gm', '1', 1, 6.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(73, 3377, 71, 'HDMOTCHA16', NULL, 'Mocha 16 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(74, 3378, 72, 'HDCPPCCN10', NULL, 'Cappuccino 10 oz', 1, 0, 1, '0gm', '1', 1, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(75, 3381, 73, 'HDAMRKNO12', NULL, 'Americano 12 oz', 1, 0, 1, '0gm', '1', 1, 3.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:46', '2024-08-29 10:12:46'),
(76, 3382, 74, 'HDBLHTCHLT12', NULL, 'Belgian Hot Chocolate 12 oz', 1, 0, 1, '0gm', '1', 1, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(77, 3383, 75, 'HDBLHTCHLT16', NULL, 'Belgian Hot Chocolate 16 oz', 1, 0, 1, '0gm', '1', 1, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(78, 3384, 76, 'HDHTCHVLTE10', NULL, 'Hot Chocolate (Kids) 10 oz', 1, 0, 1, '0gm', '1', 1, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(79, 3385, 77, 'HDTEA10', NULL, 'Tea', 1, 0, 1, '0gm', '1', 1, 2.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:12:57', '2024-08-29 10:12:57'),
(80, 3386, 78, 'HDESPRSS', NULL, 'Espresso', 1, 0, 1, '0gm', '1', 1, 2.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:00', '2024-08-29 10:13:00'),
(81, 3387, 79, 'HDWHPDCRM', NULL, 'Whipped Cream', 1, 0, 1, '0gm', '1', 1, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:03', '2024-08-29 10:13:03'),
(82, 3380, 80, 'HDAMRKNO10', NULL, 'Americano 10 oz', 1, 0, 1, '0gm', '1', 1, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(83, 3379, 81, 'HDCPPCCN12', NULL, 'Cappuccino 12 oz', 1, 0, 1, '0gm', '1', 1, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(85, 3388, 82, 'ICECON3', NULL, 'Cone Ice Cream 3 Scoop', 1, 0, 1, '0gm', '1', 1, 9.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(86, 3389, 83, 'ICECON2', NULL, 'Cone Ice Cream 2 Scoop', 1, 0, 1, '0gm', '1', 1, 6.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(87, 3390, 84, 'ICECON1', NULL, 'Cone Ice Cream 1 Scoop', 1, 0, 1, '0gm', '1', 1, 3.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(88, 3391, 85, 'ICECUP3', NULL, 'Cup Ice Cream 3 Scoop', 1, 0, 1, '0gm', '1', 1, 9.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(89, 3392, 86, 'ICECUP2', NULL, 'Cup Ice Cream 2 Scoop', 1, 0, 1, '0gm', '1', 1, 6.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:17', '2024-08-29 10:13:17'),
(90, 3393, 87, 'ICECUP1', NULL, 'Cup Ice Cream 1 Scoop', 1, 0, 1, '0gm', '1', 1, 3.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(91, 3394, 88, 'ICEWFFLS1', NULL, 'Waffle Cone Ice Cream 1 Scoop', 1, 0, 1, '0gm', '1', 1, 4.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(92, 3395, 89, 'ICEWFFLS2', NULL, 'Waffle Cone Ice Cream 2 Scoop', 1, 0, 1, '0gm', '1', 1, 7.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(93, 3396, 90, 'ICCSMMIE', NULL, 'Ice Cream Sammie', 1, 0, 1, '0gm', '1', 1, 7.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(104, 3408, 100, 'APLSP9F', NULL, '9 Inch Apple Pie Frozen', 1, 0, 1, '1100gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(106, 3398, 102, 'ICCLMKS', NULL, 'Large Milkshake', 1, 0, 1, '0gm', '1', 1, 8.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(107, 3409, 103, 'APLSP5F', NULL, '5 Inch Apple Pie Frozen', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(108, 3410, 104, 'CHRSP5F', NULL, '5 Inch Cherry Pie Frozen', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(109, 3411, 105, 'CHRSP9F', NULL, '9 Inch Cherry Pie Frozen', 1, 0, 1, '1100gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(110, 3412, 106, 'BBRSP5F', NULL, '5 Inch Blueberry Pie Frozen', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(111, 3413, 107, 'BBRSP59F', NULL, '9 Inch Blueberry Pie Frozen', 1, 0, 1, '1100gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(112, 3414, 108, 'SBRSP5F', NULL, '5 Inch Strawberry Rhubarb Pie Frozen', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(113, 3415, 109, 'SBRSP9F', NULL, '9 Inch Strawberry Rhubarb Pie Frozen', 1, 0, 1, '1100gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(115, 3422, 111, 'PMKSP9', NULL, 'Pumpkin Pie Frozen / Baked', 1, 0, 1, '750gm', '1', 1, 12.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(116, 3423, 112, 'PMKSP5', NULL, '5 Inch Pumpkin Pie Frozen / Baked', 1, 0, 1, '200gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(117, 3424, 113, 'KLMSP5', NULL, '5 Inch Key Lime - Seasonal Frozen / Baked', 1, 0, 0, '200gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(118, 3425, 114, 'KLMSP9', NULL, 'Key Lime -9 Inch  Seasonal Frozen / Baked', 1, 0, 0, '0gm', '1', 1, 12.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(119, 3426, 115, 'PCBSP5', NULL, 'Peach Crumble Pie - Seasonal 5 Inch', 1, 0, 0, '0gm', '1', 1, 9.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:14:59', '2024-08-29 10:14:59'),
(120, 3427, 116, 'PCBSP9', NULL, 'Peach Crumble Pie - Seasonal 9 Inch', 1, 0, 0, '0gm', '1', 1, 26.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:04', '2024-08-29 10:15:04'),
(122, 3428, 117, 'CP6PC', NULL, 'Cookie pack 6pcs', 1, 0, 1, '0gm', '1', 1, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(123, 3421, 118, 'LMNSP5', NULL, '5 Inch Lemon Pie Frozen / Baked', 1, 0, 1, '200gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(124, 3429, 119, 'CP12PC', NULL, 'Cookie pack 12pcs', 1, 0, 1, '0gm', '1', 1, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(125, 3420, 120, 'LMNSP9', NULL, '9 Inch Lemon Pie Frozen / Baked', 1, 0, 1, '850gm', '1', 1, 12.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(126, 3419, 121, 'CBPSP9F', NULL, '9 Inch Chocolate Bourbon Pecan Pie Frozen / Baked', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(127, 3418, 122, 'CBPSP5F', NULL, '5 Inch Chocolate Bourbon Pecan Pie Frozen / Baked', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(128, 3417, 123, 'PCNSP5F', NULL, '5 Inch Pecan Pie Frozen / Baked', 1, 0, 1, '250gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(130, 3430, 124, 'FDCCC10', NULL, 'Family Day Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(131, 3431, 125, 'FDCRV10', NULL, 'Family Day Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(132, 3432, 126, 'FDCCAC10', NULL, 'Family Day Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:21', '2024-08-29 10:15:21'),
(133, 3433, 127, 'FDCFD10', NULL, 'Family Day Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(135, 3440, 129, 'CAOCCRV10', NULL, 'Celebrate Any Occasion Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:50', '2024-08-29 10:15:50'),
(136, 3441, 130, 'CAOCCDC10', NULL, 'Celebrate Any Occasion Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(137, 3442, 131, 'CAOCCFC10', NULL, 'Celebrate Any Occasion Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(138, 3443, 132, 'GWSCCCC10', NULL, 'Get Well Soon Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:15:58', '2024-08-29 10:15:58'),
(139, 3444, 133, 'GWSCCRV10', NULL, 'Get Well Soon Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(141, 3445, 134, 'GWSCCDC10', NULL, 'Get Well Soon Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(142, 3439, 135, 'CAOCCCC10', NULL, 'Celebrate Any Occasion Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(143, 3438, 136, 'PMKNJR4', NULL, 'Pumpkin Pie In a Jar 4', 1, 0, 1, '0gm', '1', 1, 22.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(145, 3446, 137, 'GWSFUDC10', NULL, 'Get Well Soon Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(146, 3437, 138, 'PMKNJR8', NULL, 'Pumpkin Pie In a Jar 8', 1, 0, 1, '0gm', '1', 1, 44.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(147, 3436, 139, 'PMKNJR12', NULL, 'Pumpkin Pie In a Jar 12', 1, 0, 1, '0gm', '1', 1, 67.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(148, 3435, 140, 'CKVJOTML6', NULL, 'Oatmeal Pumpkin Spice Cookies 6', 1, 0, 1, '0gm', '1', 1, 15.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(149, 3434, 128, 'CKVJOTML12', NULL, 'Oatmeal Pumpkin Spice Cookies 12', 1, 0, 1, '0gm', '1', 1, 29.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(150, 3447, 141, 'HBGCCCC10', NULL, 'Happy Birthday Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(151, 3448, 142, 'HBGCCRV10', NULL, 'Happy Birthday Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:12', '2024-08-29 10:16:12'),
(152, 3449, 143, 'HBGCCDC10', NULL, 'Happy Birthday Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(153, 3450, 144, 'HBGCCFC10', NULL, 'Happy Birthday Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(155, 3458, 146, 'HBGFDC10', NULL, 'Happy Birthday Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(156, 3457, 147, 'HBGCCDC10', NULL, 'Happy Birthday Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(157, 3456, 148, 'HBGCCRV10', NULL, 'Happy Birthday Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(158, 3455, 149, 'HBGCCCC10', NULL, 'Happy Birthday Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(159, 3454, 150, 'HBBCCDC10', NULL, 'Happy Birthday Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(160, 3453, 151, 'HBBCCRV10', NULL, 'Happy Birthday Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(161, 3452, 152, 'HBBCCCC10', NULL, 'Happy Birthday Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(162, 3451, 145, 'HBBFCDC10', NULL, 'Happy Birthday Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(163, 3416, 110, 'PCNSP9F', NULL, '9 inch Pecan Pie Frozen /Baked', 1, 0, 1, '850gm', '1', 1, 16.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(164, 3397, 91, 'ICECMIMLKS', NULL, 'Medium Milkshake', 1, 0, 1, '0gm', '1', 1, 6.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(165, 3459, 153, 'ILYCCFC10', NULL, 'I LOVE YOU Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(166, 3460, 154, 'ILYCCCC10', NULL, 'I LOVE YOU Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(167, 3461, 155, 'ILYCCRV10', NULL, 'I LOVE YOU Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(168, 3462, 156, 'ILYCCDC10', NULL, 'I LOVE YOU Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(169, 3463, 157, 'IGCCCC10', NULL, 'Birth Announcement Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(170, 3464, 158, 'IGCCRV10', NULL, 'Birth Announcement Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(171, 3465, 159, 'IGCCDC10', NULL, 'Birth Announcement Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(172, 3466, 160, 'IGCCFUC10', NULL, 'Birth Announcement Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(173, 3467, 161, 'TYCCCC10', NULL, 'THANK YOU Cookie Cake Chocolate Chip', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:17:59', '2024-08-29 10:17:59'),
(176, 3469, 163, 'TYCCDC10', NULL, 'THANK YOU Cookie Cake Cookies & Cream', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(177, 3470, 164, 'TYCCFU10', NULL, 'THANK YOU Cookie Cake Funfetti', 1, 0, 1, '0gm', '1', 1, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(178, 3471, 165, 'WinterSnacks', NULL, 'Winter Snacks', 1, 0, 1, '0gm', '1', 1, 49.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(179, 3472, 166, 'ChocolateLoversBundle', NULL, 'Chocolate Lovers Bundle', 1, 0, 1, '0gm', '1', 1, 49.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:13', '2024-08-29 10:18:13'),
(180, 3473, 167, 'XMASOFCPLR', NULL, 'Office Platter', 1, 0, 1, '0gm', '1', 1, 89.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:16', '2024-08-29 10:18:16'),
(181, 3474, 168, 'CUPCAKESPCL12', NULL, 'Cupcakes 24 Pices', 1, 0, 1, '65gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(182, 3475, 169, 'BMHCC', NULL, 'Be Mine Heart Cookie Cake', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(183, 3476, 170, 'HCC', NULL, 'Heart Cookie Cake', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(184, 3477, 171, 'HAPVCC', NULL, 'Happy Valentines Day Cookie Cake', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(185, 3478, 172, 'ILOVEUVCC', NULL, 'I Love You Heart Shaped Cookie Cake', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(187, 3468, 162, 'TYCCRV10', NULL, 'THANK YOU Cookie Cake Red Velvet', 1, 0, 1, '0gm', '1', 1, 39.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(189, 3327, 21, 'MFNBG', NULL, 'Pack 24 Baked Muffins Baked frozen', 1, 0, 1, '85gm', '1', 1, 1.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(192, 3307, 1, 'JMJQC5', NULL, '5 Inch Jalapeno Monterey Jack Frozen / Baked', 1, 0, 1, '185gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(194, 3309, 3, 'SPKQC5', NULL, '5 Inch Spanakopita frozen / Baked', 1, 0, 1, '185gm', '1', 1, 5.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(196, 3480, 174, 'BISCUFF2024', NULL, 'Biscoff Butter Tarts 24 Pcs Frozen / Baked', 1, 0, 1, '95gm', '1', 1, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(207, 3401, 92, 'CCCCK', NULL, 'Chocolate Chip Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(208, 3402, 93, 'NTFCK', NULL, 'Nutella filled Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(209, 3403, 94, 'PNBCK', NULL, 'Peanut Butter Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(210, 3404, 95, 'RDVCK', NULL, 'Red Velvet Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(211, 3405, 96, 'SMRCK', NULL, 'S\'mores Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(212, 3406, 97, 'OROCK', NULL, 'Oreo Cookies Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(213, 3407, 98, 'RNBCK', NULL, 'Rainbow Cookie Frozen Case', 1, 0, 1, '70gm', '1', 1, 1.45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(217, 3486, 176, '012020196915', NULL, 'Double Chocolate Shortbread Box', 1, 0, 1, '175gm', '1', 1, 4.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:38:44', '2024-09-13 10:38:44'),
(218, 3485, 177, '012020196939', NULL, 'Chocolate Chunk Shortbread Box', 1, 0, 1, '175gm', '1', 1, 4.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(219, 3484, 178, '20220101713', NULL, 'Maple Pecan Shortbread Box', 1, 0, 1, '175gm', '1', 1, 4.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(220, 3483, 179, '012020196922', NULL, 'Lemon Shortbread Box', 1, 0, 1, '175gm', '1', 1, 4.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(221, 3482, 180, '012020196946', NULL, 'Traditional Shortbread Box', 1, 0, 1, '175gm', '1', 1, 4.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `base` varchar(255) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `page_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `all_products` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `master_id`, `name`, `code`, `country`, `base`, `status`, `page_id`, `price`, `all_products`, `created_at`, `updated_at`) VALUES
(1, '81', 'Ontario', 'ON', 'CA', '0', 1, NULL, NULL, '0', '2023-05-25 17:06:04', '2023-05-25 17:06:04'),
(2, '82', 'British Columbia', 'BC', 'CA', '0', 1, NULL, NULL, '0', '2023-05-25 17:06:25', '2023-05-25 17:06:25'),
(3, '83', 'Quebec', 'QC', 'CA', '0', 1, NULL, NULL, '0', '2023-05-25 17:06:41', '2023-05-25 17:06:41'),
(4, '84', 'Nova Scotia', 'NS', 'CA', '0', 1, NULL, NULL, '0', '2023-05-25 17:06:59', '2023-05-25 17:06:59'),
(5, '85', 'New Brunswick', 'NB', 'CA', '0', 1, NULL, NULL, '0', '2023-06-26 13:49:18', '2023-06-27 18:27:51'),
(6, '86', 'Manitoba', 'MB', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:28:05', '2023-06-27 18:28:05'),
(7, '87', 'Prince Edward Island', 'PE', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:28:27', '2023-06-27 18:28:27'),
(8, '88', 'Saskatchewan', 'SK', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:28:40', '2023-06-27 18:28:40'),
(9, '89', 'Alberta', 'AB', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:28:54', '2023-06-27 18:28:54'),
(10, '90', 'Newfoundland And Labrador', 'NL', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:29:06', '2023-06-27 18:29:06'),
(11, '91', 'Northwest Territories', 'NT', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:29:18', '2023-06-27 18:29:18'),
(12, '92', 'Yukon', 'YT', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:29:38', '2023-06-27 18:30:03'),
(13, '93', 'Nunavut', 'NU', 'CA', '0', 1, NULL, NULL, '0', '2023-06-27 18:29:55', '2023-06-27 18:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `redirects`
--

CREATE TABLE `redirects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_url` varchar(128) DEFAULT NULL,
  `to_url` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `order_type` varchar(50) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `charge` varchar(255) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `max_days` varchar(255) DEFAULT NULL,
  `cut_off` varchar(255) DEFAULT NULL,
  `preperation_time` varchar(20) NOT NULL DEFAULT '0',
  `info_line` varchar(255) DEFAULT NULL,
  `policy_id` varchar(255) DEFAULT NULL,
  `sunday` tinyint(4) NOT NULL DEFAULT 1,
  `monday` tinyint(4) NOT NULL DEFAULT 1,
  `tuesday` tinyint(4) NOT NULL DEFAULT 1,
  `wednesday` tinyint(4) NOT NULL DEFAULT 1,
  `thursday` tinyint(4) NOT NULL DEFAULT 1,
  `friday` tinyint(4) NOT NULL DEFAULT 1,
  `saturday` tinyint(4) NOT NULL DEFAULT 1,
  `require_date` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `master_id`, `order_type`, `name`, `slug`, `description`, `charge`, `days`, `max_days`, `cut_off`, `preperation_time`, `info_line`, `policy_id`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `require_date`, `priority`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, '36', 'delivery', 'Delivery', 'delivery', NULL, '0.00', '0', '0', '23:59:59', '0', NULL, NULL, 1, 1, 1, 1, 1, 1, 1, '1', '10', 'dummy.png', 1, '2024-07-04 09:47:19', '2024-07-04 09:47:19'),
(2, '37', 'pickup', 'Pickup', 'pickup', NULL, '0.00', '0', '0', '23:59:59', '0', NULL, NULL, 1, 1, 1, 1, 1, 1, 1, '1', '10', 'dummy.png', 1, '2024-07-04 09:47:31', '2024-07-04 09:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_rules`
--

CREATE TABLE `shipping_rules` (
  `id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `day` varchar(32) NOT NULL,
  `cutoff` varchar(32) DEFAULT NULL,
  `after_day` varchar(32) DEFAULT NULL,
  `after_time` varchar(32) DEFAULT NULL,
  `before_day` varchar(32) DEFAULT NULL,
  `before_time` varchar(32) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia_sites`
--

CREATE TABLE `socialmedia_sites` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `position` int(11) DEFAULT 1,
  `status` varchar(10) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(75) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `icon` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `store_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(250) DEFAULT NULL,
  `additional_email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `map_link` varchar(255) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `picture_icon` varchar(250) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `shipping` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_name` varchar(250) DEFAULT NULL,
  `manager_picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_images`
--

CREATE TABLE `store_images` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `postion` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_timings`
--

CREATE TABLE `store_timings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `open` varchar(255) DEFAULT NULL,
  `close` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suggested_products`
--

CREATE TABLE `suggested_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `suggested_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `master_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_name`, `description`, `type`, `status`, `master_id`, `created_at`, `updated_at`) VALUES
(1, 'HST', 'HST', 'individual', '1', 19, '2024-07-23 10:18:14', '2024-07-23 10:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `tax_values`
--

CREATE TABLE `tax_values` (
  `id` int(11) NOT NULL,
  `tax_id` varchar(250) DEFAULT NULL,
  `tax_percentage` float(10,2) NOT NULL DEFAULT 0.00,
  `province_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tax_values`
--

INSERT INTO `tax_values` (`id`, `tax_id`, `tax_percentage`, `province_id`, `created_at`, `updated_at`) VALUES
(1, '1', 13.00, 114, '2024-07-23 06:18:14', '2024-07-23 06:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `theme_code` varchar(250) DEFAULT 'theme-1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `theme_code`, `created_at`, `updated_at`) VALUES
(1, NULL, '2024-08-12 07:29:05', '2024-08-12 07:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `reset_token` varchar(250) DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `master_id`, `name`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `phone`, `address`, `postalcode`, `city`, `province`, `country`, `birthday`, `last_login`, `status`, `remember_token`, `reset_token`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'John Doe', 'John', 'Doe', 'john@example.com', NULL, '$2y$10$qt9krSzgLMeWMFIuQV34auGtQMlFVwSXBPL1t9/8LLwpPMPHs5InK', '6392581470', 'Queens Park', 'V3L 2G9', 'New Westminster', 'Ontario', 'Canada', '1900-01-10', NULL, 1, '9XWXd08evW6xVJXAqRgOpE82XumReMdjKiTgSidjeaA4LjvFLoWD2E8xatBl', NULL, '2024-07-15 09:04:03', '2024-07-15 13:04:03', '2024-07-15 13:04:03'),
(7, NULL, 'shefii km', 'shefii', 'km', 'shefii.indigital@gmail.com', NULL, '$2y$10$jbmF51sQ3fjU0l7axy0dyegoD1Jy3yoyBGUQIR/Yehz85hdGcuRSW', '8484848484', 'km', 'a0a0a0', 'Toronto', 'Ontario', 'Canada', '1997-08-15', NULL, 1, 'koQJK4DvaHgKCdEsr7BPNDsufj5VIVq1HpyidxjYC53wRCjjRLRFWyhIIFtl', NULL, '2024-08-30 05:05:03', '2024-08-30 05:05:01', '2024-08-30 05:05:03'),
(8, NULL, 'Biju Yohannan', 'Biju', 'Yohannan', 'bijuys@gmail.com', NULL, '$2y$10$nCn9WZ5hhcpCaRlAGdCDUuWvmBg7cQeG8HYMGVuI.E01IO2OKRCaC', '2342342342', 'testing', 't0a0a0', 'Abee', 'Alberta', 'Canada', '1982-08-17', NULL, 1, NULL, NULL, '2024-08-30 05:57:05', '2024-08-30 05:57:04', '2024-08-30 05:57:05'),
(9, NULL, 'shefii kkmm', 'shefii', 'kkmm', 'shefii.indigital+123@gmail.com', NULL, '$2y$10$RoetkbVAFt.c.eWqUhALbegJdtX81kVdPvmc5h6UL6BbC3dSxnmt2', '5245454545', 'fxcgxdfg', '5454545', 'toronto', 'Quebec', 'Canada', '1997-11-12', NULL, 1, NULL, NULL, '2024-08-30 06:53:44', '2024-08-30 06:53:42', '2024-08-30 06:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `variation_images`
--

CREATE TABLE `variation_images` (
  `id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'product id',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `variation_images`
--

INSERT INTO `variation_images` (`id`, `variation_id`, `picture_id`, `product_id`, `created_at`, `updated_at`) VALUES
(384, 192, 384, 1, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(383, 192, 383, 1, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(8, 4, 8, 2, '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(7, 4, 7, 2, '2024-08-29 10:04:29', '2024-08-29 10:04:29'),
(389, 194, 389, 3, '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(388, 194, 388, 3, '2024-08-29 10:40:59', '2024-08-29 10:40:59'),
(11, 6, 11, 4, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(12, 6, 12, 4, '2024-08-29 10:04:40', '2024-08-29 10:04:40'),
(13, 7, 13, 5, '2024-08-29 10:04:45', '2024-08-29 10:04:45'),
(14, 7, 14, 5, '2024-08-29 10:04:46', '2024-08-29 10:04:46'),
(15, 8, 15, 6, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(16, 8, 16, 6, '2024-08-29 10:04:51', '2024-08-29 10:04:51'),
(17, 9, 17, 7, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(18, 9, 18, 7, '2024-08-29 10:04:57', '2024-08-29 10:04:57'),
(19, 10, 19, 8, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(20, 10, 20, 8, '2024-08-29 10:05:03', '2024-08-29 10:05:03'),
(21, 11, 21, 9, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(22, 11, 22, 9, '2024-08-29 10:05:10', '2024-08-29 10:05:10'),
(23, 12, 23, 10, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(24, 12, 24, 10, '2024-08-29 10:05:15', '2024-08-29 10:05:15'),
(25, 13, 25, 11, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(26, 13, 26, 11, '2024-08-29 10:05:21', '2024-08-29 10:05:21'),
(27, 14, 27, 12, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(28, 14, 28, 12, '2024-08-29 10:05:26', '2024-08-29 10:05:26'),
(29, 15, 29, 13, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(30, 15, 30, 13, '2024-08-29 10:05:32', '2024-08-29 10:05:32'),
(31, 16, 31, 14, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(32, 16, 32, 14, '2024-08-29 10:05:37', '2024-08-29 10:05:37'),
(33, 17, 33, 15, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(34, 17, 34, 15, '2024-08-29 10:05:43', '2024-08-29 10:05:43'),
(35, 18, 35, 16, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(36, 18, 36, 16, '2024-08-29 10:05:49', '2024-08-29 10:05:49'),
(37, 19, 37, 17, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(38, 19, 38, 17, '2024-08-29 10:05:54', '2024-08-29 10:05:54'),
(39, 20, 39, 18, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(40, 20, 40, 18, '2024-08-29 10:06:00', '2024-08-29 10:06:00'),
(41, 21, 41, 19, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(42, 21, 42, 19, '2024-08-29 10:06:05', '2024-08-29 10:06:05'),
(43, 22, 43, 20, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(44, 22, 44, 20, '2024-08-29 10:06:11', '2024-08-29 10:06:11'),
(378, 189, 378, 21, '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(377, 189, 377, 21, '2024-08-29 10:25:22', '2024-08-29 10:25:22'),
(47, 24, 47, 22, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(48, 24, 48, 22, '2024-08-29 10:06:22', '2024-08-29 10:06:22'),
(49, 25, 49, 23, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(50, 25, 50, 23, '2024-08-29 10:06:28', '2024-08-29 10:06:28'),
(51, 26, 51, 24, '2024-08-29 10:06:33', '2024-08-29 10:06:33'),
(52, 26, 52, 24, '2024-08-29 10:06:34', '2024-08-29 10:06:34'),
(53, 27, 53, 25, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(54, 27, 54, 25, '2024-08-29 10:06:39', '2024-08-29 10:06:39'),
(55, 28, 55, 26, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(56, 28, 56, 26, '2024-08-29 10:06:45', '2024-08-29 10:06:45'),
(57, 29, 57, 27, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(58, 29, 58, 27, '2024-08-29 10:06:50', '2024-08-29 10:06:50'),
(59, 30, 59, 28, '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(60, 30, 60, 28, '2024-08-29 10:06:56', '2024-08-29 10:06:56'),
(61, 31, 61, 29, '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(62, 31, 62, 29, '2024-08-29 10:07:02', '2024-08-29 10:07:02'),
(63, 32, 63, 30, '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(64, 32, 64, 30, '2024-08-29 10:07:08', '2024-08-29 10:07:08'),
(65, 33, 65, 31, '2024-08-29 10:07:14', '2024-08-29 10:07:14'),
(66, 33, 66, 31, '2024-08-29 10:07:14', '2024-08-29 10:07:14'),
(67, 34, 67, 32, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(68, 34, 68, 32, '2024-08-29 10:07:19', '2024-08-29 10:07:19'),
(69, 35, 69, 33, '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(70, 35, 70, 33, '2024-08-29 10:07:25', '2024-08-29 10:07:25'),
(71, 36, 71, 34, '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(72, 36, 72, 34, '2024-08-29 10:07:31', '2024-08-29 10:07:31'),
(73, 37, 73, 35, '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(74, 37, 74, 35, '2024-08-29 10:07:36', '2024-08-29 10:07:36'),
(75, 38, 75, 36, '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(76, 38, 76, 36, '2024-08-29 10:07:42', '2024-08-29 10:07:42'),
(77, 39, 77, 37, '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(78, 39, 78, 37, '2024-08-29 10:07:48', '2024-08-29 10:07:48'),
(79, 40, 79, 38, '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(80, 40, 80, 38, '2024-08-29 10:07:53', '2024-08-29 10:07:53'),
(81, 41, 81, 39, '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(82, 41, 82, 39, '2024-08-29 10:07:59', '2024-08-29 10:07:59'),
(83, 42, 83, 40, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(84, 42, 84, 40, '2024-08-29 10:08:05', '2024-08-29 10:08:05'),
(85, 43, 85, 41, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(86, 43, 86, 41, '2024-08-29 10:08:10', '2024-08-29 10:08:10'),
(87, 44, 87, 42, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(88, 44, 88, 42, '2024-08-29 10:08:16', '2024-08-29 10:08:16'),
(89, 45, 89, 43, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(90, 45, 90, 43, '2024-08-29 10:08:21', '2024-08-29 10:08:21'),
(91, 46, 91, 44, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(92, 46, 92, 44, '2024-08-29 10:08:27', '2024-08-29 10:08:27'),
(93, 47, 93, 45, '2024-08-29 10:08:33', '2024-08-29 10:08:33'),
(94, 47, 94, 45, '2024-08-29 10:08:33', '2024-08-29 10:08:33'),
(95, 48, 95, 46, '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(96, 48, 96, 46, '2024-08-29 10:08:38', '2024-08-29 10:08:38'),
(97, 49, 97, 47, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(98, 49, 98, 47, '2024-08-29 10:08:44', '2024-08-29 10:08:44'),
(99, 50, 99, 48, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(100, 50, 100, 48, '2024-08-29 10:08:49', '2024-08-29 10:08:49'),
(101, 51, 101, 49, '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(102, 51, 102, 49, '2024-08-29 10:08:55', '2024-08-29 10:08:55'),
(103, 52, 103, 50, '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(104, 52, 104, 50, '2024-08-29 10:09:01', '2024-08-29 10:09:01'),
(105, 53, 105, 51, '2024-08-29 10:09:07', '2024-08-29 10:09:07'),
(106, 53, 106, 51, '2024-08-29 10:09:08', '2024-08-29 10:09:08'),
(107, 54, 107, 52, '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(108, 54, 108, 52, '2024-08-29 10:09:13', '2024-08-29 10:09:13'),
(109, 55, 109, 53, '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(110, 55, 110, 53, '2024-08-29 10:09:19', '2024-08-29 10:09:19'),
(111, 56, 111, 54, '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(112, 56, 112, 54, '2024-08-29 10:11:46', '2024-08-29 10:11:46'),
(113, 57, 113, 55, '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(114, 57, 114, 55, '2024-08-29 10:11:49', '2024-08-29 10:11:49'),
(115, 58, 115, 56, '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(116, 58, 116, 56, '2024-08-29 10:11:52', '2024-08-29 10:11:52'),
(117, 59, 117, 57, '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(118, 59, 118, 57, '2024-08-29 10:11:55', '2024-08-29 10:11:55'),
(119, 60, 119, 58, '2024-08-29 10:11:57', '2024-08-29 10:11:57'),
(120, 60, 120, 58, '2024-08-29 10:11:58', '2024-08-29 10:11:58'),
(121, 61, 121, 59, '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(122, 61, 122, 59, '2024-08-29 10:12:00', '2024-08-29 10:12:00'),
(123, 62, 123, 60, '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(124, 62, 124, 60, '2024-08-29 10:12:03', '2024-08-29 10:12:03'),
(125, 63, 125, 61, '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(126, 63, 126, 61, '2024-08-29 10:12:06', '2024-08-29 10:12:06'),
(127, 64, 127, 62, '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(128, 64, 128, 62, '2024-08-29 10:12:09', '2024-08-29 10:12:09'),
(129, 65, 129, 63, '2024-08-29 10:12:11', '2024-08-29 10:12:11'),
(130, 65, 130, 63, '2024-08-29 10:12:12', '2024-08-29 10:12:12'),
(131, 66, 131, 64, '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(132, 66, 132, 64, '2024-08-29 10:12:14', '2024-08-29 10:12:14'),
(133, 67, 133, 65, '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(134, 67, 134, 65, '2024-08-29 10:12:17', '2024-08-29 10:12:17'),
(135, 68, 135, 66, '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(136, 68, 136, 66, '2024-08-29 10:12:20', '2024-08-29 10:12:20'),
(137, 69, 137, 67, '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(138, 69, 138, 67, '2024-08-29 10:12:23', '2024-08-29 10:12:23'),
(139, 70, 139, 68, '2024-08-29 10:12:26', '2024-08-29 10:12:26'),
(140, 70, 140, 68, '2024-08-29 10:12:26', '2024-08-29 10:12:26'),
(141, 71, 141, 69, '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(142, 71, 142, 69, '2024-08-29 10:12:28', '2024-08-29 10:12:28'),
(143, 72, 143, 70, '2024-08-29 10:12:31', '2024-08-29 10:12:31'),
(144, 72, 144, 70, '2024-08-29 10:12:32', '2024-08-29 10:12:32'),
(145, 73, 145, 71, '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(146, 73, 146, 71, '2024-08-29 10:12:34', '2024-08-29 10:12:34'),
(147, 74, 147, 72, '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(148, 74, 148, 72, '2024-08-29 10:12:37', '2024-08-29 10:12:37'),
(149, 75, 149, 73, '2024-08-29 10:12:46', '2024-08-29 10:12:46'),
(150, 75, 150, 73, '2024-08-29 10:12:47', '2024-08-29 10:12:47'),
(151, 76, 151, 74, '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(152, 76, 152, 74, '2024-08-29 10:12:49', '2024-08-29 10:12:49'),
(153, 77, 153, 75, '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(154, 77, 154, 75, '2024-08-29 10:12:52', '2024-08-29 10:12:52'),
(155, 78, 155, 76, '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(156, 78, 156, 76, '2024-08-29 10:12:55', '2024-08-29 10:12:55'),
(157, 79, 157, 77, '2024-08-29 10:12:58', '2024-08-29 10:12:58'),
(158, 79, 158, 77, '2024-08-29 10:12:58', '2024-08-29 10:12:58'),
(159, 80, 159, 78, '2024-08-29 10:13:00', '2024-08-29 10:13:00'),
(160, 80, 160, 78, '2024-08-29 10:13:01', '2024-08-29 10:13:01'),
(161, 81, 161, 79, '2024-08-29 10:13:03', '2024-08-29 10:13:03'),
(162, 81, 162, 79, '2024-08-29 10:13:04', '2024-08-29 10:13:04'),
(163, 82, 163, 80, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(164, 82, 164, 80, '2024-08-29 10:13:05', '2024-08-29 10:13:05'),
(165, 83, 165, 81, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(166, 83, 166, 81, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(167, 85, 167, 82, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(168, 85, 168, 82, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(169, 85, 169, 82, '2024-08-29 10:13:06', '2024-08-29 10:13:06'),
(170, 85, 170, 82, '2024-08-29 10:13:07', '2024-08-29 10:13:07'),
(171, 86, 171, 83, '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(172, 86, 172, 83, '2024-08-29 10:13:09', '2024-08-29 10:13:09'),
(173, 87, 173, 84, '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(174, 87, 174, 84, '2024-08-29 10:13:12', '2024-08-29 10:13:12'),
(175, 88, 175, 85, '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(176, 88, 176, 85, '2024-08-29 10:13:15', '2024-08-29 10:13:15'),
(177, 89, 177, 86, '2024-08-29 10:13:18', '2024-08-29 10:13:18'),
(178, 89, 178, 86, '2024-08-29 10:13:18', '2024-08-29 10:13:18'),
(179, 90, 179, 87, '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(180, 90, 180, 87, '2024-08-29 10:13:20', '2024-08-29 10:13:20'),
(181, 91, 181, 88, '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(182, 91, 182, 88, '2024-08-29 10:13:23', '2024-08-29 10:13:23'),
(183, 92, 183, 89, '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(184, 92, 184, 89, '2024-08-29 10:13:26', '2024-08-29 10:13:26'),
(185, 93, 185, 90, '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(186, 93, 186, 90, '2024-08-29 10:13:29', '2024-08-29 10:13:29'),
(328, 164, 328, 91, '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(327, 164, 327, 91, '2024-08-29 10:17:11', '2024-08-29 10:17:11'),
(425, 207, 425, 92, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(424, 207, 424, 92, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(428, 208, 428, 93, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(427, 208, 427, 93, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(431, 209, 431, 94, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(430, 209, 430, 94, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(434, 210, 434, 95, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(433, 210, 433, 95, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(437, 211, 437, 96, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(436, 211, 436, 96, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(440, 212, 440, 97, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(439, 212, 439, 97, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(443, 213, 443, 98, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(442, 213, 442, 98, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(426, 208, 426, 93, '2024-09-13 10:06:56', '2024-09-13 10:06:56'),
(423, 207, 423, 92, '2024-09-13 10:06:39', '2024-09-13 10:06:39'),
(208, 104, 208, 100, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(207, 104, 207, 100, '2024-08-29 10:14:05', '2024-08-29 10:14:05'),
(392, 196, 392, 174, '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(391, 196, 391, 174, '2024-08-29 11:00:17', '2024-08-29 11:00:17'),
(211, 106, 211, 102, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(212, 106, 212, 102, '2024-08-29 10:14:07', '2024-08-29 10:14:07'),
(213, 107, 213, 103, '2024-08-29 10:14:08', '2024-08-29 10:14:08'),
(214, 107, 214, 103, '2024-08-29 10:14:08', '2024-08-29 10:14:08'),
(215, 108, 215, 104, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(216, 108, 216, 104, '2024-08-29 10:14:10', '2024-08-29 10:14:10'),
(217, 109, 217, 105, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(218, 109, 218, 105, '2024-08-29 10:14:13', '2024-08-29 10:14:13'),
(219, 110, 219, 106, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(220, 110, 220, 106, '2024-08-29 10:14:15', '2024-08-29 10:14:15'),
(221, 111, 221, 107, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(222, 111, 222, 107, '2024-08-29 10:14:18', '2024-08-29 10:14:18'),
(223, 112, 223, 108, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(224, 112, 224, 108, '2024-08-29 10:14:20', '2024-08-29 10:14:20'),
(225, 113, 225, 109, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(226, 113, 226, 109, '2024-08-29 10:14:23', '2024-08-29 10:14:23'),
(326, 163, 326, 110, '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(325, 163, 325, 110, '2024-08-29 10:17:10', '2024-08-29 10:17:10'),
(229, 115, 229, 111, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(230, 115, 230, 111, '2024-08-29 10:14:49', '2024-08-29 10:14:49'),
(231, 116, 231, 112, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(232, 116, 232, 112, '2024-08-29 10:14:52', '2024-08-29 10:14:52'),
(233, 117, 233, 113, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(234, 117, 234, 113, '2024-08-29 10:14:54', '2024-08-29 10:14:54'),
(235, 118, 235, 114, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(236, 118, 236, 114, '2024-08-29 10:14:57', '2024-08-29 10:14:57'),
(237, 119, 237, 115, '2024-08-29 10:14:59', '2024-08-29 10:14:59'),
(238, 119, 238, 115, '2024-08-29 10:15:00', '2024-08-29 10:15:00'),
(239, 120, 239, 116, '2024-08-29 10:15:04', '2024-08-29 10:15:04'),
(240, 120, 240, 116, '2024-08-29 10:15:05', '2024-08-29 10:15:05'),
(244, 122, 244, 117, '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(243, 122, 243, 117, '2024-08-29 10:15:09', '2024-08-29 10:15:09'),
(245, 123, 245, 118, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(246, 123, 246, 118, '2024-08-29 10:15:11', '2024-08-29 10:15:11'),
(247, 124, 247, 119, '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(248, 124, 248, 119, '2024-08-29 10:15:12', '2024-08-29 10:15:12'),
(249, 125, 249, 120, '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(250, 125, 250, 120, '2024-08-29 10:15:13', '2024-08-29 10:15:13'),
(251, 126, 251, 121, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(252, 126, 252, 121, '2024-08-29 10:15:14', '2024-08-29 10:15:14'),
(253, 127, 253, 122, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(254, 127, 254, 122, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(255, 128, 255, 123, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(256, 128, 256, 123, '2024-08-29 10:15:15', '2024-08-29 10:15:15'),
(258, 130, 258, 124, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(259, 130, 259, 124, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(260, 130, 260, 124, '2024-08-29 10:15:16', '2024-08-29 10:15:16'),
(261, 131, 261, 125, '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(262, 131, 262, 125, '2024-08-29 10:15:19', '2024-08-29 10:15:19'),
(263, 132, 263, 126, '2024-08-29 10:15:21', '2024-08-29 10:15:21'),
(264, 132, 264, 126, '2024-08-29 10:15:22', '2024-08-29 10:15:22'),
(265, 133, 265, 127, '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(266, 133, 266, 127, '2024-08-29 10:15:24', '2024-08-29 10:15:24'),
(298, 149, 298, 128, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(297, 149, 297, 128, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(269, 135, 269, 129, '2024-08-29 10:15:50', '2024-08-29 10:15:50'),
(270, 135, 270, 129, '2024-08-29 10:15:51', '2024-08-29 10:15:51'),
(271, 136, 271, 130, '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(272, 136, 272, 130, '2024-08-29 10:15:53', '2024-08-29 10:15:53'),
(273, 137, 273, 131, '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(274, 137, 274, 131, '2024-08-29 10:15:56', '2024-08-29 10:15:56'),
(275, 138, 275, 132, '2024-08-29 10:15:58', '2024-08-29 10:15:58'),
(276, 138, 276, 132, '2024-08-29 10:15:59', '2024-08-29 10:15:59'),
(277, 139, 277, 133, '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(278, 139, 278, 133, '2024-08-29 10:16:01', '2024-08-29 10:16:01'),
(282, 141, 282, 134, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(281, 141, 281, 134, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(283, 142, 283, 135, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(284, 142, 284, 135, '2024-08-29 10:16:05', '2024-08-29 10:16:05'),
(285, 143, 285, 136, '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(286, 143, 286, 136, '2024-08-29 10:16:06', '2024-08-29 10:16:06'),
(288, 145, 288, 137, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(289, 145, 289, 137, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(290, 145, 290, 137, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(291, 146, 291, 138, '2024-08-29 10:16:07', '2024-08-29 10:16:07'),
(292, 146, 292, 138, '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(293, 147, 293, 139, '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(294, 147, 294, 139, '2024-08-29 10:16:08', '2024-08-29 10:16:08'),
(295, 148, 295, 140, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(296, 148, 296, 140, '2024-08-29 10:16:09', '2024-08-29 10:16:09'),
(299, 150, 299, 141, '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(300, 150, 300, 141, '2024-08-29 10:16:10', '2024-08-29 10:16:10'),
(301, 151, 301, 142, '2024-08-29 10:16:12', '2024-08-29 10:16:12'),
(302, 151, 302, 142, '2024-08-29 10:16:13', '2024-08-29 10:16:13'),
(303, 152, 303, 143, '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(304, 152, 304, 143, '2024-08-29 10:16:15', '2024-08-29 10:16:15'),
(305, 153, 305, 144, '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(306, 153, 306, 144, '2024-08-29 10:16:18', '2024-08-29 10:16:18'),
(324, 162, 324, 145, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(323, 162, 323, 145, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(309, 155, 309, 146, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(310, 155, 310, 146, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(311, 156, 311, 147, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(312, 156, 312, 147, '2024-08-29 10:17:05', '2024-08-29 10:17:05'),
(313, 157, 313, 148, '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(314, 157, 314, 148, '2024-08-29 10:17:06', '2024-08-29 10:17:06'),
(315, 158, 315, 149, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(316, 158, 316, 149, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(317, 159, 317, 150, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(318, 159, 318, 150, '2024-08-29 10:17:07', '2024-08-29 10:17:07'),
(319, 160, 319, 151, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(320, 160, 320, 151, '2024-08-29 10:17:08', '2024-08-29 10:17:08'),
(321, 161, 321, 152, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(322, 161, 322, 152, '2024-08-29 10:17:09', '2024-08-29 10:17:09'),
(329, 165, 329, 153, '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(330, 165, 330, 153, '2024-08-29 10:17:38', '2024-08-29 10:17:38'),
(331, 166, 331, 154, '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(332, 166, 332, 154, '2024-08-29 10:17:41', '2024-08-29 10:17:41'),
(333, 167, 333, 155, '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(334, 167, 334, 155, '2024-08-29 10:17:44', '2024-08-29 10:17:44'),
(335, 168, 335, 156, '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(336, 168, 336, 156, '2024-08-29 10:17:46', '2024-08-29 10:17:46'),
(337, 169, 337, 157, '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(338, 169, 338, 157, '2024-08-29 10:17:49', '2024-08-29 10:17:49'),
(339, 170, 339, 158, '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(340, 170, 340, 158, '2024-08-29 10:17:51', '2024-08-29 10:17:51'),
(341, 171, 341, 159, '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(342, 171, 342, 159, '2024-08-29 10:17:54', '2024-08-29 10:17:54'),
(343, 172, 343, 160, '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(344, 172, 344, 160, '2024-08-29 10:17:57', '2024-08-29 10:17:57'),
(345, 173, 345, 161, '2024-08-29 10:17:59', '2024-08-29 10:17:59'),
(346, 173, 346, 161, '2024-08-29 10:18:00', '2024-08-29 10:18:00'),
(374, 187, 374, 162, '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(373, 187, 373, 162, '2024-08-29 10:19:06', '2024-08-29 10:19:06'),
(350, 176, 350, 163, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(351, 176, 351, 163, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(352, 176, 352, 163, '2024-08-29 10:18:05', '2024-08-29 10:18:05'),
(353, 177, 353, 164, '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(354, 177, 354, 164, '2024-08-29 10:18:08', '2024-08-29 10:18:08'),
(355, 178, 355, 165, '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(356, 178, 356, 165, '2024-08-29 10:18:11', '2024-08-29 10:18:11'),
(357, 179, 357, 166, '2024-08-29 10:18:13', '2024-08-29 10:18:13'),
(358, 179, 358, 166, '2024-08-29 10:18:14', '2024-08-29 10:18:14'),
(359, 180, 359, 167, '2024-08-29 10:18:16', '2024-08-29 10:18:16'),
(360, 180, 360, 167, '2024-08-29 10:18:17', '2024-08-29 10:18:17'),
(361, 181, 361, 168, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(362, 181, 362, 168, '2024-08-29 10:18:19', '2024-08-29 10:18:19'),
(363, 182, 363, 169, '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(364, 182, 364, 169, '2024-08-29 10:18:22', '2024-08-29 10:18:22'),
(365, 183, 365, 170, '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(366, 183, 366, 170, '2024-08-29 10:18:25', '2024-08-29 10:18:25'),
(367, 184, 367, 171, '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(368, 184, 368, 171, '2024-08-29 10:18:30', '2024-08-29 10:18:30'),
(369, 185, 369, 172, '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(370, 185, 370, 172, '2024-08-29 10:18:33', '2024-08-29 10:18:33'),
(432, 210, 432, 95, '2024-09-13 10:07:27', '2024-09-13 10:07:27'),
(429, 209, 429, 94, '2024-09-13 10:07:13', '2024-09-13 10:07:13'),
(385, 192, 385, 1, '2024-08-29 10:31:09', '2024-08-29 10:31:09'),
(435, 211, 435, 96, '2024-09-13 10:07:39', '2024-09-13 10:07:39'),
(438, 212, 438, 97, '2024-09-13 10:07:50', '2024-09-13 10:07:50'),
(441, 213, 441, 98, '2024-09-13 10:08:04', '2024-09-13 10:08:04'),
(451, 217, 451, 176, '2024-09-13 10:38:45', '2024-09-13 10:38:45'),
(450, 217, 450, 176, '2024-09-13 10:38:45', '2024-09-13 10:38:45'),
(452, 218, 452, 177, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(453, 218, 453, 177, '2024-09-13 10:38:54', '2024-09-13 10:38:54'),
(454, 219, 454, 178, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(455, 219, 455, 178, '2024-09-13 10:39:07', '2024-09-13 10:39:07'),
(456, 220, 456, 179, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(457, 220, 457, 179, '2024-09-13 10:39:16', '2024-09-13 10:39:16'),
(458, 221, 458, 180, '2024-09-13 10:39:34', '2024-09-13 10:39:34'),
(459, 221, 459, 180, '2024-09-13 10:39:34', '2024-09-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `variation_images_old`
--

CREATE TABLE `variation_images_old` (
  `id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL COMMENT 'product variation id',
  `picture` varchar(250) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'product id',
  `type` varchar(250) NOT NULL COMMENT 'thumb,main,extra',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_keys`
--

CREATE TABLE `variation_keys` (
  `id` int(11) NOT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `value` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addon_products`
--
ALTER TABLE `addon_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baking_instructions`
--
ALTER TABLE `baking_instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category_lists`
--
ALTER TABLE `blog_category_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_jobs`
--
ALTER TABLE `career_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_requests`
--
ALTER TABLE `career_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_shippings`
--
ALTER TABLE `country_shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_stores`
--
ALTER TABLE `coupon_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_prices`
--
ALTER TABLE `customer_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configrations`
--
ALTER TABLE `email_configrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday_timings`
--
ALTER TABLE `holiday_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_products`
--
ALTER TABLE `homepage_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_product_lists`
--
ALTER TABLE `homepage_product_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_shippings`
--
ALTER TABLE `location_shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menucategory_products`
--
ALTER TABLE `menucategory_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myaddresses`
--
ALTER TABLE `myaddresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mycards`
--
ALTER TABLE `mycards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutritions`
--
ALTER TABLE `nutritions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_explorers`
--
ALTER TABLE `nutrition_explorers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_feedback`
--
ALTER TABLE `order_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_cases`
--
ALTER TABLE `product_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_cities`
--
ALTER TABLE `product_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images_old`
--
ALTER TABLE `product_images_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pages`
--
ALTER TABLE `product_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_page_categories`
--
ALTER TABLE `product_page_categories`
  ADD KEY `page_id` (`page_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_page_contents`
--
ALTER TABLE `product_page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `product_shippings`
--
ALTER TABLE `product_shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_specializations`
--
ALTER TABLE `product_specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redirects`
--
ALTER TABLE `redirects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_rules`
--
ALTER TABLE `shipping_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmedia_sites`
--
ALTER TABLE `socialmedia_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_images`
--
ALTER TABLE `store_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_timings`
--
ALTER TABLE `store_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggested_products`
--
ALTER TABLE `suggested_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_values`
--
ALTER TABLE `tax_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variation_images`
--
ALTER TABLE `variation_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation_images_old`
--
ALTER TABLE `variation_images_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation_keys`
--
ALTER TABLE `variation_keys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addon_products`
--
ALTER TABLE `addon_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baking_instructions`
--
ALTER TABLE `baking_instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_category_lists`
--
ALTER TABLE `blog_category_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_jobs`
--
ALTER TABLE `career_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_requests`
--
ALTER TABLE `career_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country_shippings`
--
ALTER TABLE `country_shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_stores`
--
ALTER TABLE `coupon_stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_prices`
--
ALTER TABLE `customer_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_configrations`
--
ALTER TABLE `email_configrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday_timings`
--
ALTER TABLE `holiday_timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homepage_products`
--
ALTER TABLE `homepage_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homepage_product_lists`
--
ALTER TABLE `homepage_product_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_shippings`
--
ALTER TABLE `location_shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menucategory_products`
--
ALTER TABLE `menucategory_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myaddresses`
--
ALTER TABLE `myaddresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mycards`
--
ALTER TABLE `mycards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nutritions`
--
ALTER TABLE `nutritions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nutrition_explorers`
--
ALTER TABLE `nutrition_explorers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_feedback`
--
ALTER TABLE `order_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `product_cases`
--
ALTER TABLE `product_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `product_cities`
--
ALTER TABLE `product_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `product_images_old`
--
ALTER TABLE `product_images_old`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_pages`
--
ALTER TABLE `product_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_page_contents`
--
ALTER TABLE `product_page_contents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_shippings`
--
ALTER TABLE `product_shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_specializations`
--
ALTER TABLE `product_specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `redirects`
--
ALTER TABLE `redirects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_rules`
--
ALTER TABLE `shipping_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socialmedia_sites`
--
ALTER TABLE `socialmedia_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_images`
--
ALTER TABLE `store_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_timings`
--
ALTER TABLE `store_timings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggested_products`
--
ALTER TABLE `suggested_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_values`
--
ALTER TABLE `tax_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `variation_images`
--
ALTER TABLE `variation_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `variation_images_old`
--
ALTER TABLE `variation_images_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_keys`
--
ALTER TABLE `variation_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_page_contents`
--
ALTER TABLE `product_page_contents`
  ADD CONSTRAINT `fk_page_id` FOREIGN KEY (`page_id`) REFERENCES `product_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
