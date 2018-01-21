-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2018 at 11:50 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halal_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `halal_info_table`
--

DROP TABLE IF EXISTS `halal_info_table`;
CREATE TABLE IF NOT EXISTS `halal_info_table` (
  `id` int(11) NOT NULL,
  `desc_name` varchar(250) NOT NULL,
  `desc_description` varchar(500) NOT NULL,
  `logo_path` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halal_info_table`
--

INSERT INTO `halal_info_table` (`id`, `desc_name`, `desc_description`, `logo_path`) VALUES
(1, 'Image1', 'Description1', 'logo1.jpg'),
(3, 'Image3', 'Description3', 'logo3.jpg'),
(4, 'Image4', 'Description4', 'logo4.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
