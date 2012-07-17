-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2012 at 10:22 
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cromos-torres`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_imageUrl1` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `album_imageUrl2` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `album_imageUrl3` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `album_imageUrl4` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `album_imageUrl5` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `collection_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `product_details` text COLLATE utf8mb4_spanish_ci,
  `product_price` double NOT NULL,
  `product_dateAdded` date NOT NULL,
  PRIMARY KEY (`album_id`),
  KEY `collection_id` (`collection_id`),
  KEY `collection_id_2` (`collection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `category_order` int(2) NOT NULL,
  `collection_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `collection_id` (`collection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_order`, `collection_id`) VALUES
(1, 'Real Madrid', 1, 1),
(2, 'F.C. Barcelona', 2, 1),
(5, 'test 2', 6, 2),
(11, 'Mundial 2010', 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `collection_year` int(4) NOT NULL,
  `collection_imageUrl` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `editorial_id` int(11) NOT NULL,
  PRIMARY KEY (`collection_id`),
  KEY `editorial_id` (`editorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collection_id`, `collection_name`, `collection_year`, `collection_imageUrl`, `editorial_id`) VALUES
(1, 'UEFA 2010', 2010, 'images/collections/UEFA_2010.jpg', 1),
(2, 'UEFA 2011', 2011, 'images/collections/UEFA_2011.jpg', 1),
(23, 'Mundial 2010', 2010, 'images/collection/mundial_2010.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `editorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `editorial_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `editorial_priority` int(11) NOT NULL,
  `editorial_imageUrl` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`editorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `editorial`
--

INSERT INTO `editorial` (`editorial_id`, `editorial_name`, `editorial_priority`, `editorial_imageUrl`) VALUES
(1, 'Panini', 1, 'images/panini.jpg'),
(2, 'mundicromo', 1, 'images/mundicromo.jpg'),
(5, 'ed. exter', 5, 'images/ed.exter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` int(1) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `product_details` text COLLATE utf8mb4_spanish_ci,
  `product_price` double NOT NULL,
  `product_dateAdded` date NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sticker`
--

CREATE TABLE IF NOT EXISTS `sticker` (
  `sticker_id` int(11) NOT NULL AUTO_INCREMENT,
  `sticker_number` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `sticker_imageUrl` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `product_details` text COLLATE utf8mb4_spanish_ci,
  `product_price` double NOT NULL,
  `product_dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sticker_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sticker`
--

INSERT INTO `sticker` (`sticker_id`, `sticker_number`, `sticker_imageUrl`, `category_id`, `product_name`, `product_details`, `product_price`, `product_dateAdded`) VALUES
(1, 'R11', 'images/sticker/1.jpg', 1, 'Cristiano Ronaldo', NULL, 11.25, '2012-07-16 22:00:00'),
(4, 'faaa', 'fdsfdsaa', 5, 'ffdsfdsfaaa', 'fdsfdsfaaa', 1.25, '2012-07-17 19:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`editorial_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sticker`
--
ALTER TABLE `sticker`
  ADD CONSTRAINT `sticker_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
