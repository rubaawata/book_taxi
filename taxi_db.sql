-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2024 at 10:42 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_a` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_b` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookings_users_FK` (`user_id`),
  KEY `bookings_service_types_FK` (`service_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `location_a`, `location_b`, `notes`, `user_id`, `service_type_id`, `status`, `created_at`) VALUES
(1, 'test', 'test', 'test', 1, 1, 'pending', '2024-03-28 14:51:06'),
(2, 'test', 'test', 'test', 1, 1, 'pending', '2024-03-28 14:51:06'),
(3, 'test', 'test', 'test1', 1, 1, 'pending', '2024-03-28 14:51:06'),
(4, 'test', 'test', 'test1', 1, 1, 'pending', '2024-03-28 14:51:06'),
(5, 'test', 'test', 'dsfsfdf', 1, 2, 'pending', '2024-03-28 14:51:06'),
(6, 'test', 'test', 'text', 1, 1, 'pending', '2024-03-28 14:51:06'),
(7, 'test', 'test', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(8, 'test', 'test', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(9, 'test', 'test', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(10, 'test', 'test', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(11, 'test', 'test', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(12, 'test', 'stest', 'test', 1, 3, 'pending', '2024-03-28 14:51:06'),
(13, 'test', 'test', 'rsdf', 1, 1, 'pending', '2024-03-28 14:51:06'),
(14, 'test', 'test', 'test', 1, 2, 'pending', '2024-03-28 14:51:06'),
(15, 'test', 'test', 'test', 1, 2, 'pending', '2024-03-28 14:51:06'),
(16, 'test', 'test', 'sdf', 1, 2, 'pending', '2024-03-28 14:51:06'),
(17, 'test', 'test', 'sdf', 1, 2, 'pending', '2024-03-28 14:51:06'),
(18, 'test', 'test', 'sdf', 1, 2, 'pending', '2024-03-28 14:51:06'),
(19, 'test', 'test', 'sdf', 1, 2, 'pending', '2024-03-28 14:51:06'),
(20, 'test', 'test', 'test', 1, 2, 'pending', '2024-03-28 14:51:06'),
(21, 'ersdf', 'sdfsdf', 'tuba', 1, 3, 'pending', '2024-03-28 14:51:06'),
(22, 'ersdf', 'sdfsdf', 'tuba', 1, 3, 'pending', '2024-03-28 14:51:06'),
(23, 'test', 'test', 'test', 1, 2, 'pending', '2024-03-28 14:51:06'),
(24, 'tesd', 'tesd', 'tesd', 1, 1, 'pending', '2024-03-28 14:51:06'),
(25, 'test', 'test', 'test', 1, 2, 'pending', '2024-03-28 14:51:06'),
(26, 'tesa', 'asd', 'sadfs', 1, 1, 'pending', '2024-03-28 14:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `phone`, `message`, `created_at`) VALUES
(1, 'text', '0946149630', 'textextexte', '2024-03-29 11:35:46'),
(2, 'dsf', '0946149630', 'sdfsdf asfasd', '2024-03-29 11:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

DROP TABLE IF EXISTS `service_types`;
CREATE TABLE IF NOT EXISTS `service_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_du` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fare` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `name_en`, `name_du`, `fare`) VALUES
(1, 'Business Class', 'Business Class', 10),
(2, 'Business Van/SUV', 'Business Van/SUV', 20),
(3, 'First Class', 'First Class', 30);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(1, 'dfs@asf.asd', '2024-03-29 11:07:33'),
(2, 'sadasd@as.asd', '2024-03-29 11:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 'test', 'test', 'test', '2024-03-28 14:51:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
